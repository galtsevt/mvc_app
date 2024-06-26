<?php

namespace Aurora\Framework\Router;

trait HasMiddleware
{
    protected array $middlewares = [];

    public function middleware(array|string $middleware): static
    {
        $this->middlewares = is_array($middleware) ? $middleware : [$middleware];
        return $this;
    }
}