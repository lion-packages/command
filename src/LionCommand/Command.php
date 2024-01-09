<?php

declare(strict_types=1);

namespace Lion\Command;

use Symfony\Component\Console\Command\Command as CommandSymfony;

abstract class Command extends CommandSymfony
{
    /**
     * Add a color to text for errors
     * */
    public function errorOutput(string $message): string
    {
        return "\033[0;31m{$message}\033[0m";
    }

    /**
     * Add a color to the text for when a process finishes successfully
     * */
    public function successOutput(string $message): string
    {
        return "\033[0;32m{$message}\033[0m";
    }

    /**
     * Add a color to text to display a warning
     * */
    public function warningOutput(string $message): string
    {
        return "\033[0;33m{$message}\033[0m";
    }

    /**
     * Add a color to text to display information
     * */
    public function infoOutput(string $message): string
    {
        return "\033[0;36m{$message}\033[0m";
    }

    /**
     * Add a purple color to the text
     * */
    public function purpleOutput(string $message): string
    {
        return "\033[0;95m{$message}\033[0m";
    }
}
