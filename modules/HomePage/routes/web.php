<?php

use Aurora\Router\RouteCollection;

return function (RouteCollection $router) {
    $router->get('/', \Aurora\Modules\HomePage\App\Controllers\IndexController::class, 'main');
    $router->get('/test/{string}/{string2}', \Aurora\Modules\HomePage\App\Controllers\IndexController::class, 'test');
};