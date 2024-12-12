<?php

namespace Aurora\Framework\Core;

use Aurora\Framework\Facades\RouteCollector;
use Aurora\Framework\Facades\View;
use Closure;

abstract class Module
{
    protected string $name = 'module';

    abstract public function register(): void;

    abstract public function boot(): void;

    public function registerResources(): void
    {
        $this->registerRoutes('/routes/web.php');
        $this->registerTemplates('/resources/templates', $this->name);
    }

    protected function registerRoutes(string $path): void
    {
        if (is_file($routePath = $this->getPath() . $path)) {
            $routesCallback = include_once $this->getPath() . $path;
            if ($routesCallback instanceof Closure) {
                RouteCollector::group([], $routesCallback);
            }
        }
    }

    protected function registerTemplates(string $path, $namespace): void
    {
        View::addNamespace($namespace, $this->getPath() . $path);
    }

    protected function getPath(): string
    {
        $reflector = new \ReflectionClass($this);
        return dirname($reflector->getFileName());
    }
}