<?php

namespace App;

use App\Router\Route;
use Exception;

class App
{
    /**
     * @throws Exception
     */
    public function run()
    {
        if ($route = Route::findRoute()) {
        $controller = new $route['callback'][0]();
            return call_user_func_array([$controller, $route['callback'][1]], $route['parameters']);
        }
        $this->response(404);
        return '404 not found';
    }

    private function response(int $code): void
    {
        http_response_code(404);
    }
}