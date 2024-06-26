<?php
declare(strict_types=1);

namespace Aurora\Framework\DI;

use Aurora\Framework\Exceptions\NotFoundException;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    protected array $container = [];

    protected static ?ContainerInterface $instance = null;

    private function __construct()
    {

    }

    public static function getInstance(): ?ContainerInterface
    {
        if (self::$instance === null) {
            self::$instance = new Container();
        }
        return self::$instance;
    }

    public function get(string $id)
    {
        if (!isset($this->container[$id])) {
            throw new NotFoundException("Container not found with id '{$id}'");
        } else if ($this->container[$id] instanceof \Closure) {
            return ($this->container[$id])();
        }

        return $this->container[$id];
    }

    public function has(string $id): bool
    {
        return isset($this->container[$id]);
    }

    public function bind(string $id, mixed $value): static
    {
        $this->container[$id] = $value;
        return $this;
    }

    private function __clone()
    {

    }
}