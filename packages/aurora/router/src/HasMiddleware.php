<?php
declare(strict_types=1);

namespace Aurora\Router;

trait HasMiddleware
{
    protected array $middlewares = [];

    public function middleware(array|string $middleware): static
    {
        foreach ((array)$middleware as $middlewareClass) {
            $this->middlewares[] = $middlewareClass;
        }
        return $this;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}