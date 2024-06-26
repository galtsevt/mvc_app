<?php

namespace Aurora\Framework\Router;

class Dispatcher
{

    public function __construct(protected RouteCollection $routeCollection)
    {

    }

    public function collection($callback): static
    {
        ($callback)($this->routeCollection);
        return $this;
    }



    public function dispatch(): Route {

    }
}