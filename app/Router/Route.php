<?php

namespace App\Router;

use App\Router\Methods\AbstractMethod;
use App\Router\Methods\Get;
use App\Router\Methods\Post;

class Route
{
    private static array $routes;

    public static function post(string $url, array $callback): AbstractMethod
    {
        $post = self::$routes[] = (new Post())->create($url, $callback);
        return $post;
    }

    public static function get(string $url, array $callback): AbstractMethod
    {
        self::$routes[] = $post = (new Get())->create($url, $callback);
        return $post;
    }

    public static function findRoute(): bool | AbstractMethod
    {
        foreach (self::$routes as $route) {
            if ($route = $route->check()) {
                return $route;
            }
        }
        return false;
    }

    public static function getRoutes(): array
    {
        return self::$routes;
    }
}