<?php

use App\Controllers\AuthController;
use Aurora\Framework\Router\RouteCollection;

return function(RouteCollection $router) {
    $router->post('/auth/login', AuthController::class, 'login');
};