<?php

namespace App\Services;

use App\Models\User;
use JetBrains\PhpStorm\NoReturn;
use Rakit\Validation\Validator;

class AuthService
{
    #[NoReturn] public function auth(): void
    {
        $validator = new Validator;
        $validation = $validator->make($_REQUEST, [
            'login' => 'required',
            'password' => 'required|min:6',
        ]);
        $validation->validate();
        if ($validation->fails()) {
            session()->setFlash('errors', $validation->errors()->firstOfAll());
        } else {
            $data = $validation->getValidData();
            if ((new User())->login($data['login'], $data['password'])) {
                redirect('/home');
            }
            session()->setFlash('error', 'Данные не верны');
            redirect('/login');
        }
    }

    #[NoReturn] public function reg(): void
    {
        $validator = new Validator;
        $validation = $validator->make($_REQUEST, [
            'login' => 'required',
            'full_name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6',
        ]);
        $validation->validate();
        if ($validation->fails()) {
            session()->setFlash('errors', $validation->errors()->firstOfAll());
        } else {
            $data = $validation->getValidData();
            $user = new User();
            if (!$user->checkLogin($data['login'])) {
                $error = 'Логин занят';
            } else if ($data['password'] != $data['confirm_password']) {
                $error = 'Пароли не совпадают';
            }
            if (!isset($error)) {
                $user->create($data);
            } else {
                session()->setFlash('error', $error);
            }
        }
        redirect('/registration');
    }
}