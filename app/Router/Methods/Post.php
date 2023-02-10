<?php
namespace App\Router\Methods;


class Post extends AbstractMethod
{

    public function check(): array|bool
    {
        if($route = $this->valid()) {
            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                return $route;
            }
        }
        return false;
    }
}