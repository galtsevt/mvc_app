<?php

namespace App\Router\Methods;

abstract class AbstractMethod
{
    protected string $name = '';
    protected string $url;
    protected array $callback;

    protected array $parameters;

    public function create(string $url, array $callback): static
    {
        $this->url = $url;
        $this->callback = $callback;
        return $this;
    }

    public function valid(): static|bool
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
                } else {
                    return false;
                }
            }
        }
        $this->parameters = $parameters;
        return $this;
    }

    // На будущее
    public function setName($name): static
    {
        $this->name = $name;
        return $this;
    }

    public function run($data = [])
    {
        $params = array_merge($this->parameters, $data);
        $controller = new $this->callback[0]();
        return call_user_func_array([$controller, $this->callback[1]], $params);
    }

}