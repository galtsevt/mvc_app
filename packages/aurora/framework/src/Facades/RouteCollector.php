<?php

namespace Aurora\Framework\Facades;

use Aurora\Router\RouteCollection;

/**
 * @method static RouteCollection collection($callback)
 * @method static RouteCollection group(array $params, $callback)
 * @method static string getUrlFromRouteName(string $name, mixed $params)
 */
class RouteCollector extends Facade
{

    protected static function getRoot(): object
    {
        return DI::get(RouteCollection::class);
    }
}