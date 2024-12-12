<?php

namespace Aurora\Framework\Core;

use Aurora\Framework\Core\Traits\ConsoleOutput;

class Console
{
    use ConsoleOutput;

    /**
     * @var Command[]
     */
    protected array $commands = [];

    public function __construct(array $commands)
    {
        foreach ($commands as $command) {
            $this->commands[] = new $command($this);
        }
    }

    public function getCommands(): array
    {
        return $this->commands;
    }

    public function run(): void
    {
        $argv = $_SERVER['argv'];
        array_shift($argv);
        $command = $this->searchCommand($argv);

        if ($command) {
            $command->handle();
            exit;
        }

        $this->print('Command not found', 'error');
        exit;
    }

    protected function searchCommand(array $argv): ?Command
    {
        if ($argv[0] == '--help') {
            $argv = ['help'];
        }

        foreach ($this->commands as $command) {
            if ($this->match($argv, $command)) {
                return $command;
            }
        }

        return null;
    }

    protected function match(array $argv, Command $command): bool|array
    {
        $commandSignature = explode(' ', $command->getSignature());
        $args = [];
        $commandArguments = array_filter($argv, fn($arg) => !str_starts_with($arg, '-'));
        if (count($commandArguments) !== count($commandSignature)) {
            return false;
        }

        foreach ($commandArguments as $index => $value) {
            if (preg_match('~\{[a-z]}~ui', $commandSignature[$index])) {
                $argName = str_replace(['{', '}'], '', $commandSignature[$index]);
                $args[$argName] = $value;
            } else if ($commandSignature[$index] != $value) {
                return false;
            }
        }

        $options = array_filter($argv, fn($arg) => str_starts_with($arg, '-'));
        foreach ($options as $option) {
            $option = explode('=', $option, 2);
            $opts[$option[0]] = $option[1] ?? null;
        }

        return [$args, $opts ?? []];
    }
}