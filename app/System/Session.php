<?php

namespace App\System;

class Session
{
    private static $object;

    private function __construct() {
        session_start();
    }

    public static function getInstance(): ?Session
    {
        if(!self::$object) {
            self::$object = new self();
        }
        return self::$object;
    }

    public function setFlash($key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function hasError($key): bool
    {
        if (isset($_SESSION['errors'][$key])) {
            return true;
        }
        return false;
    }
    public function getError($key): ?string
    {
        if (isset($_SESSION['errors'][$key])) {
            $value = $_SESSION['errors'][$key];
            unset($_SESSION['errors'][$key]);
            return $value;
        }
        return null;
    }

    public function getFlash($key): string|array|null
    {
        if (isset($_SESSION[$key])) {
            $value = $_SESSION[$key];
            unset($_SESSION[$key]);
            return $value;
        }
        return null;
    }

    public function get($key): ?string
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }

    public function destroy($key): bool
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
            return true;
        }
        return false;
    }
}