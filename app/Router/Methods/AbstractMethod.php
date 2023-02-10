<?php
namespace App\Router\Methods;

abstract class AbstractMethod
{
    protected string $name = '';
    protected string $url;
    protected array $callback;

    public function create(string $url, array $callback): static
    {
        $this->url = $url;
        $this->callback = $callback;
        return $this;
    }

    public function valid(): array|bool
    {
        $requestUrl = explode('/', $_SERVER['REQUEST_URI']);
        $url = explode('/', $this->url);
        array_shift($requestUrl);
        array_shift($url);
        $parameters = [];
        if (count($url) != count($requestUrl)) return false;
        for ($i = 0; $i <= (count($url) - 1); $i++) {
            if ($url[$i] != $requestUrl[$i]) {
                if (strlen($url[$i]) > 0 && $url[$i][0] == '{') {
                    $key = str_replace(['{', '}'], '', $url[$i]);
                    $parameters[$key] = $requestUrl[$i];
                }  else {
                    return false;
                }
            }
        }
        return [
            'callback' => $this->callback,
            'parameters' => $parameters,
        ];
    }


}