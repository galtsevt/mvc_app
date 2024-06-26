<?php
declare(strict_types=1);

namespace Aurora\Framework\Facades;

use RuntimeException;

abstract class Facade
{
    abstract protected static function getRoot(): object;

    public static function __callStatic($method, $args): mixed
    {
        $instance = static::getRoot();
        if (!$instance) {
            throw new RuntimeException('A facade root has not been set.');
        }
        return ($instance->$method)(...$args);
    }
}