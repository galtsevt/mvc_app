<?php

namespace App\Controllers;

class IndexController extends Controller
{
     public function index(): bool|string
     {
         return $this->render->layout('main')->render('index');
     }
}