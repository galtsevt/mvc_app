<?php

namespace Aurora\Framework\BaseModule;

use Aurora\Framework\BaseModule\Commands\HelpCommand;
use Aurora\Framework\Core\Module;

class BaseModule extends Module
{
    protected string $name = "base-module";

    public function register(): void
    {
        // TODO: Implement register() method.
    }

    public function boot(): void
    {
        // TODO: Implement boot() method.
    }

    public function commands(): array
    {
        return [
            HelpCommand::class,
        ];
    }
}