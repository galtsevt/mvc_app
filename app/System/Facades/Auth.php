<?php
namespace App\System\Facades;
class Auth
{
    private static $object = null;
    private ?array $user = null;

    private function __construct() {
        if($token = session()->get('remember_token')) {
            $this->user = (new \App\Models\User())->checkAuth($token);
        }
    }

    public static function getInstance(): ?Auth
    {
        if(!self::$object) {
            self::$object = new self();
        }
        return self::$object;
    }

    public function isAuthUser(): bool
    {
        if($this->user) {
            return true;
        }
        return false;
    }

    public function user(): ?array
    {
        if($this->user) {
            return $this->user;
        }
        return null;
    }
}