<?php
declare(strict_types=1);

namespace Aurora\Router;

class Route
{
    use HasMiddleware;

    protected array $params = [];
    protected ?string $name = null;
    protected ?string $url = null;

    public function __construct(
        protected array           $methods,
        protected string          $path,
        protected string          $controller,
        protected string          $action,
        protected RouteCollection $mainCollection,
        protected string          $parentPrefix,
    )
    {

    }

    public function getMethods(): array
    {
        return $this->methods;
    }

    public function getPath(): string
    {
        return $this->parentPrefix . $this->path;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        $this->mainCollection->setRouteNames($name, $this);
        return $this;
    }

    public function check(string $url, string $method): bool
    {
        $chunks = array_filter(explode('/', $this->getPath()));
        foreach ($chunks as $key => $chunk) {
            if (str_starts_with($chunk, '{')) {
                $chunk = str_replace(['{', '}'], '', $chunk);
                $attr = explode('::', $chunk);
                $this->params[$attr[0]] = null;
                $chunks[$key] = '(' . ($attr[1] ?? '\w+') . ')';
            }
        }
        $regex = '/^\/' . implode('\/', $chunks) . '$/';
        $matches = [];
        if (preg_match($regex, $url, $matches) && in_array($method, $this->methods)) {
            array_shift($matches);
            foreach ($this->params as $key => $param) {
                $this->params[$key] = array_shift($matches);
            }
            return true;
        }
        return false;
    }

    public function getUrl(mixed $params): string
    {
        if ($this->url) {
            return $this->url;
        }
        $chunks = explode('/', $this->getPath());
        foreach ($chunks as $key => $chunk) {
            if (str_starts_with($chunk, '{')) {
                $chunk = str_replace(['{', '}'], '', $chunk);
                $attr = explode('::', $chunk);
                $chunks[$key] = match (true) {
                    is_array($params) => $params[$attr[0]],
                    default => $params
                };
            }
        }
        return $this->url = implode('/', $chunks);
    }
}