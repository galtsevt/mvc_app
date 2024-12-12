<?php

namespace Aurora\Framework\Core;

use Aurora\Framework\BaseModule\BaseModule;
use Aurora\Framework\Facades\DI;
use Aurora\Router\Dispatcher;
use Aurora\Router\Exceptions\NotFoundException;
use Aurora\Router\RouteCollection;
use Aurora\View\View;
use Throwable;

class Application
{
    protected array $modulesContainer;
    protected array $commandsContainer;

    public function __construct(protected array $modules = [])
    {
        DI::singleton(RouteCollection::class, fn() => new RouteCollection());
        DI::singleton(View::class, fn() => new View());
        $this->modules[] = BaseModule::class;
    }


    public function isConsole(): bool
    {
        return php_sapi_name() === 'cli';
    }

    /**
     * @throws NotFoundException
     */
    public function run(): void
    {
        try {
            foreach ($this->modules as $module) {
                $this->modulesContainer[] = $this->registerModule($module);
            }

            $dispatcher = new Dispatcher(DI::get(RouteCollection::class), $_SERVER['REQUEST_URI'], 'GET');
            $route = $dispatcher->dispatch();
            echo DI::call([$route->getController(), $route->getAction()], $route->getParams());
        } catch (Throwable $e) {
            echo \Aurora\Framework\Facades\View::render('base-module::errorTrace', compact('e'));
        }
    }

    public function runConsole(): void
    {
        foreach ($this->modules as $module) {
            $moduleObject = $this->registerModule($module);
            if (method_exists($moduleObject, 'commands')) {
                $commands = array_merge($moduleObject->commands(), $commands ?? []);
            }
            $this->modulesContainer[] = $moduleObject;
        }

        $console = new Console($commands ?? []);
        $console->run();
    }

    protected function registerModule(string $module): Module
    {
        $module = new $module();
        $module->register();
        $module->registerResources();
        return $module;
    }

}