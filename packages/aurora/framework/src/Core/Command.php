<?php

namespace Aurora\Framework\Core;

use Aurora\Framework\Core\Traits\ConsoleOutput;

abstract class Command
{
    use ConsoleOutput;

    protected string $signature;
    protected string $description;

    public function __construct(protected Console $console)
    {

    }

    abstract public function handle();

    public function getSignature(): string
    {
        return $this->signature;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}