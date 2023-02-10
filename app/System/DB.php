<?php

namespace App\System;

use PDO;

class DB
{
    private static $object = null;
    private PDO $pdo;
    private function __construct() {
        $dsn = 'mysql:host='.settings('db_host').';dbname='.settings('db_name').';charset='.settings('db_charset');
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->pdo = new PDO($dsn, settings('db_user'), settings('db_password'), $opt);
    }

    public static function getConnect(): PDO
    {
        if(!self::$object) {
            self::$object = new self();
        }
        return self::$object->pdo;
    }

}