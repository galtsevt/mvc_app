<?php
declare(strict_types=1);

namespace Aurora\Framework\DI;

use Aurora\Framework\Exceptions\CanNotBeCalledExeption;
use Aurora\Framework\Exceptions\NotFoundException;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    const TYPE_MAIN = 'main';
    const TYPE_SINGLETON = 'singleton';

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

    public function get(string $id): ?object
    {
        if (!$this->has($id)) {
            throw new NotFoundException("Container not found with id '{$id}'");
        } else if ($this->container[$id]['value'] instanceof \Closure) {
            $object = $this->make($this->container[$id]);
            if ($this->container[$id]['type'] === self::TYPE_SINGLETON) {
                $this->container[$id]['value'] = $object;
            }
            return $object;
        }

        return $this->container[$id]['value'];
    }

    public function make(array $object): mixed
    {
        if ($object['value'] instanceof \Closure) {
            return $object['value']();
        }
        return null;
    }

    /**
     * @throws CanNotBeCalledExeption
     */
    public function call(array|callable $callable, array $arguments = []): mixed
    {
        if (is_array($callable)) {
            return (new $callable[0])->{$callable[1]}(...$arguments);
        } else if ($callable instanceof \Closure) {
            return $callable($arguments);
        }
        return throw new CanNotBeCalledExeption('Object cannot be called');
    }

    public function has(string $id): bool
    {
        return isset($this->container[$id]);
    }

    public function bind(string $id, mixed $value, string $type = 'main'): static
    {
        $this->container[$id] = [
            'id' => $id,
            'value' => $value,
            'type' => $type,
        ];
        return $this;
    }

    public function singleton(string $id, mixed $value): static
    {
        $this->bind($id, $value, self::TYPE_SINGLETON);
        return $this;
    }

    private function __clone()
    {

    }
}