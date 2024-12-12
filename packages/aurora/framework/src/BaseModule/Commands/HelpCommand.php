<?php

namespace Aurora\Framework\BaseModule\Commands;

use Aurora\Framework\Core\Command;

class HelpCommand extends Command
{
    protected string $signature = 'help';
    protected string $description = 'Help command';

    public function handle(): void
    {
        $this->print('Welcome to Aurora!');
        $this->print('This command helps you to manage your application:');
        foreach ($this->console->getCommands() as $command) {
            $this->print($command->getSignature(), 'success', false);
            $this->print('               ', newLine: false);
            $this->print($command->getDescription());
        }
    }
}