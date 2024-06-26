<?php

namespace Aurora\Framework\Facades;

use Aurora\Framework\Router\RouteCollection;

/**
 * @method static RouteCollection collection($callback)
 * @method static RouteCollection group($callback)
 */
class RouteCollector extends Facade
{

    protected static function getRoot(): object
    {
        return DI::get(RouteCollection::class);
    }
}