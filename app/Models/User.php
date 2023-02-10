<?php

namespace App\Models;

class User extends Model
{
    protected string $table_name = 'users';

    public function create($data)
    {
        $sth = $this->db->prepare('INSERT INTO ' . $this->table_name . ' SET `login` = :login, `full_name` = :full_name, `remember_token` = :remember_token, `email` = :email, `password` = :password');
        $sth->execute([
            'login' => $data['login'],
            'full_name' => $data['full_name'],
            'remember_token' => random_bytes(25) . time(),
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        ]);
        return $this->login($data['login'], $data['password']);
    }

    public function login($login, $password)
    {
        $stmt = $this->db->prepare('SELECT * FROM ' . $this->table_name . ' WHERE login = ?');
        $stmt->execute([$login]);
        $user = $stmt->fetch();
        if (password_verify($password, $user['password'])) {
            session()->setFlash('remember_token', $user['remember_token']);
            return $user;
        }
        return false;
    }

    public function checkLogin($login): bool
    {
        $stmt = $this->db->prepare('SELECT * FROM ' . $this->table_name . ' WHERE login = ?');
        $stmt->execute([$login]);
        $user = $stmt->fetch();
        if (!$user) {
            return true;
        }
        return false;
    }

    public function checkAuth($remember_token)
    {
        $stmt = $this->db->prepare('SELECT * FROM ' . $this->table_name . ' WHERE remember_token = ?');
        $stmt->execute([$remember_token]);
        $user = $stmt->fetch();
        if ($user) {
            return $user;
        }
        return false;
    }

    public function changePassword($login, $password, $new_password): bool
    {
        if ($this->login($login, $password)) {
            $sth = $this->db->prepare('UPDATE ' . $this->table_name . ' SET `password` = :password WHERE `id` = :id');
            $sth->execute([
                'password' => password_hash($new_password, PASSWORD_DEFAULT),
                'id' => auth()->user()['id'],
            ]);
            return true;
        }
        return false;
    }

    public function changeName($full_name): bool
    {
            $sth = $this->db->prepare('UPDATE ' . $this->table_name . ' SET `full_name` = :full_name WHERE `id` = :id');
            $sth->execute([
                'full_name' => $full_name,
                'id' => auth()->user()['id'],
            ]);
            return true;
    }

}