<?php

namespace Aurora\Framework\Router;

class Route
{
    public function __construct(
        protected array  $methods,
        protected string $path,
        protected string $controller,
        protected string $action,
    )
    {

    }

    public function getMethods(): array
    {
        return $this->methods;
    }
}