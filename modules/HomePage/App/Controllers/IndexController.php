<?php

namespace Aurora\Modules\HomePage\App\Controllers;

use Aurora\Framework\Facades\RouteCollector;
use Aurora\Framework\Facades\View;

class IndexController
{
    public function main(): string
    {
        return View::render('home::index');
    }

    public function test($string, $string2): string
    {
        dd($string, $string2);
    }
}