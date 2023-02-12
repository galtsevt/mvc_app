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
        try {
            if ($route = Route::findRoute()) {
                return $route->run();
            }
        } catch (Exception $e) {
            // возможно потом запишем в логи
            echo $e;
            exit;
        }
        $this->response(404);
        return '404 not found';
    }

    private function response(int $code): void
    {
        http_response_code(404);
    }
}