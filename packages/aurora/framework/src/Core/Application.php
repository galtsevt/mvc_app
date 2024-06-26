<?php

namespace Aurora\Framework\Core;

class Application
{
    protected array $modulesContainer;

    public function __construct(protected array $modules = [])
    {

    }

    public function run()
    {
        foreach ($this->modules as $module) {
            $this->modulesContainer[] = $this->registerModule($module);
        }
    }

    protected function registerModule(string $module): Module
    {
        $module = new $module();
        $module->registerResources();
        $module->register();
        return $module;
    }
}