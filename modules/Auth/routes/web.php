<?php

use App\Controllers\AuthController;
use Aurora\Router\RouteCollection;

return function (RouteCollection $router) {
    $router->post('/auth/{mm}/login/{auth}', AuthController::class, 'login');
    $router->get('/category/{mm::\d+}/post/{auth::\d+}', AuthController::class, 'login');
};