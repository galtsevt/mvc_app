<?php

namespace Aurora\Framework\Facades;

class View extends Facade
{
    /**
     * @method static string render(string $template, array $data = [])
     * @method static \Aurora\View\View addNamespace(string $namespace, string $path)
     */
    protected static function getRoot(): object
    {
        return DI::get(\Aurora\View\View::class);
    }
}