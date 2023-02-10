<?php

namespace App\Controllers;

use JetBrains\PhpStorm\NoReturn;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!auth()->isAuthUser()) {
            redirect('/');
        }
    }

    #[NoReturn] public function logout()
    {
        session()->destroy('remember_token');
        redirect('/');
    }

    public function home()
    {
        $data = [
            'title' => 'Личный кабинет',
        ];
        return $this->render->render('user/home', $data);
    }

    #[NoReturn] public function change_password()
    {

    }
}