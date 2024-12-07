<?php
declare(strict_types=1);

namespace Aurora\Router;

use Aurora\Router\Exceptions\NotFoundException;

class Dispatcher
{

    public function __construct(
        protected RouteCollection $routeCollection,
        protected string          $uri,
        protected string          $method
    )
    {

    }

    /**
     * @throws NotFoundException
     */
    public function dispatch(): Route
    {
        if (!($route = $this->findRoute($this->routeCollection))) {
            return throw new NotFoundException('Route not found');
        }
        return $route;
    }

    protected function findRoute(RouteCollection $collection, array $middlewares = []): ?Route
    {
        $middlewares = array_merge($collection->getMiddlewares(), $middlewares);
        foreach ($collection->getCollection() as $route) {
            if ($route instanceof Route && $route->check($this->uri, $this->method)) {
                return $route;
            } else if ($route instanceof RouteCollection && (is_null($route->getPrefix()) || str_starts_with($this->uri, $route->getPrefix())) &&
                ($findRoute = $this->findRoute($route, $middlewares)) instanceof Route) {
                return $findRoute->middleware($middlewares);
            }
        }
        return null;
    }


}