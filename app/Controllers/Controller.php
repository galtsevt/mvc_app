<?php

namespace App\Controllers;

use App\System\Render;

class Controller
{
    protected Render $render;

    public function __construct()
    {
        $this->render = new Render();
        $this->render->layout('main');
    }

}