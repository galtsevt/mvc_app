<?php

namespace App\Services;

use App\Models\User;
use Rakit\Validation\Validator;

class UserService
{
     public function changePassword() {
         $validator = new Validator;
         $validation = $validator->make($_REQUEST, [
             'old_password' => 'required',
             'password' => 'required|min:6',
             'confirm_password' => 'required|min:6',
         ]);
         $validation->validate();
         if ($validation->fails()) {
             session()->setFlash('errors', $validation->errors()->firstOfAll());
         } else {
             $data = $validation->getValidData();
             if($data['password'] != $data['confirm_password']) {
                 session()->setFlash('error', 'Пароли не совпадают');
             } else if (!(new User())->changePassword(auth()->user()['login'], $data['old_password'], $data['password'])) {
                 session()->setFlash('error', 'Текущий пароль указан не верно');
             } else {
                 session()->setFlash('message', 'Пароль изменен');
             }
         }
         redirect('/home');
     }
     public function changeName() {
         $validator = new Validator;
         $validation = $validator->make($_REQUEST, [
             'full_name' => 'required|min:10|max:250',
         ]);
         $validation->validate();
         if ($validation->fails()) {
             session()->setFlash('errors', $validation->errors()->firstOfAll());
         } else {
             $data = $validation->getValidData();
             (new User())->changeName($data['full_name']);
             session()->setFlash('message', 'ФИО изменено');
         }
         redirect('/home');
     }
}