<?php
declare(strict_types=1);

namespace Aurora\Router;

use Aurora\Router\Exceptions\RouteNotFoundException;


/**
 * @property array{prefix: string} $params
 */
class RouteCollection
{
    use HasMiddleware;

    protected array $collection;
    protected array $routeNames;

    public function __construct(
        protected array            $params = [],
        protected ?string          $parentPrefix = null,
        protected ?RouteCollection $mainCollection = null
    )
    {

    }

    public function addRoute(array $methods, string $path, string $controller, string $action): Route
    {
        $route = new Route($methods, $path, $controller, $action, $this->mainCollection ?? $this, $this->getPrefix());
        $this->collection[] = $route;
        return $route;
    }

    public function addCollection(RouteCollection $collection): RouteCollection
    {
        $this->collection[] = $collection;
        return $collection;
    }

    public function get(string $path, string $controller, string $action): Route
    {
        return $this->addRoute(['GET'], $path, $controller, $action);
    }

    public function post(string $path, string $controller, string $action): Route
    {
        return $this->addRoute(['POST'], $path, $controller, $action);
    }

    public function patch(string $path, string $controller, string $action): Route
    {
        return $this->addRoute(['PATCH'], $path, $controller, $action);
    }

    public function put(string $path, string $controller, string $action): Route
    {
        return $this->addRoute(['PUT'], $path, $controller, $action);
    }

    public function delete(string $path, string $controller, string $action): Route
    {
        return $this->addRoute(['DELETE'], $path, $controller, $action);
    }

    public function any(string $path, string $controller, string $action): Route
    {
        return $this->addRoute(['GET', 'POST', 'DELETE', 'PUT', 'PATCH'], $path, $controller, $action);
    }

    public function group(array $params, callable $callback): RouteCollection
    {
        $this->collection[] = $routerGroup = new RouteCollection(
            $params,
            parentPrefix: $this->getPrefix(),
            mainCollection: $this->mainCollection ?? $this,
        );
        $callback($routerGroup);
        return $routerGroup;
    }

    public function collection(callable $callback): static
    {
        ($callback)($this);
        return $this;
    }

    public function getPrefix(): ?string
    {
        return $this->parentPrefix . ($this->params['prefix'] ?? '');
    }

    public function getCollection(): array
    {
        return $this->collection;
    }

    public function setRouteNames(string $name, Route $route): static
    {
        $this->routeNames[$name] = $route;
        return $this;
    }

    /**
     * @throws RouteNotFoundException
     */
    public function getUrlFromRouteName(string $name, mixed $params): string
    {
        if (isset($this->routeNames[$name])) {
            return $this->routeNames[$name]->getUrl($params);
        }
        return throw new RouteNotFoundException('There is no route named "' . $name . '"');
    }
}