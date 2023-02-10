<?php

namespace App\Router\Methods;

use http\Exception;

class Get extends AbstractMethod
{
    /**
     * @throws \Exception
     */
    public function check(): array|bool
    {
        if($route = $this->valid()) {
            if($_SERVER['REQUEST_METHOD'] === 'GET') {
                return $route;
            }
        }
        return false;
    }
}