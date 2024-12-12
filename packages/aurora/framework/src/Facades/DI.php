<?php
declare(strict_types=1);

namespace Aurora\Framework\Facades;

use Aurora\Framework\DI\Container;

/**
 * @method static bool has(string $id)
 * @method static object get(string $id)
 * @method static Container bind(string $id, mixed $value, string $type)
 * @method static Container singleton(string $id, mixed $value)
 */
class DI extends Facade
{

    protected static function getRoot(): object
    {
        return Container::getInstance();
    }
}