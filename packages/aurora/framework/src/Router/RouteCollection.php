<?php

namespace Aurora\Framework\Router;

class RouteCollection
{
    protected array $collection;

    public function __construct(
        protected ?string $prefix = null
    )
    {

    }

    public function addRoute(array $methods, string $path, string $controller, string $action): Route
    {
        $route = new Route($methods, $path, $controller, $action);
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

    public function group(callable $callback): RouteCollection
    {
        $this->collection[] = $routerGroup = new RouteCollection();
        $callback($routerGroup);
        return $routerGroup;
    }

    public function collection(callable $callback): static
    {
        ($callback)($this);
        return $this;
    }

    public function prefix(string $prefix): static
    {
        $this->prefix = $prefix;
        return $this;
    }
}