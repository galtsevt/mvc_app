<?php

namespace App\Controllers;

use App\Services\AuthService;
use JetBrains\PhpStorm\NoReturn;

class AuthController extends Controller
{

    public function __construct(private readonly AuthService $service = new AuthService())
    {
        parent::__construct();
        if (auth()->isAuthUser()) {
            redirect('/');
        }
    }

    public function login(): bool|string
    {
        $data = [
            'title' => 'Авторизация',
        ];
        return $this->render->layout('clean')->render('auth/login', $data);
    }

    #[NoReturn] public function auth()
    {
        $this->service->auth();
    }

    public function registration(): bool|string
    {
        $data = [
            'title' => 'Регистрация',
        ];
        return $this->render->layout('clean')->render('auth/registration', $data);
    }

    #[NoReturn] public function reg()
    {
        $this->service->reg();
    }
}