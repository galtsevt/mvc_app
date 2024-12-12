<?php

namespace Aurora\Framework\Core\Traits;

trait ConsoleOutput
{
    protected function print(string $message, string $type = null, bool $newLine = true): void
    {
        echo match ($type) {
                'success' => "\033[42m$message\033[0m",
                'error' => "\033[101m$message\033[0m",
                default => $message,
            } . ($newLine ? PHP_EOL : null);
    }
}