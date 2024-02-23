<?php

declare(strict_types=1);

namespace Lion\Command;

use Symfony\Component\Console\Command\Command as CommandSymfony;

/**
 * Extends the functions of the Command class to format messages with different
 * colors
 *
 * @author Lion-Packages <lion.packages@gmail.com>
 *
 * @package Lion\Command
 */
abstract class Command extends CommandSymfony
{
    /**
     * Add a color to text for errors
     *
     * @param  string $message [Message to change its color]
     *
     * @return string
     */
    public function errorOutput(string $message): string
    {
        return "\033[0;31m{$message}\033[0m";
    }

    /**
     * Add a color to the text for when a process finishes successfully
     *
     * @param  string $message [Message to change its color]
     *
     * @return string
     */
    public function successOutput(string $message): string
    {
        return "\033[0;32m{$message}\033[0m";
    }

    /**
     * Add a color to text to display a warning
     *
     * @param  string $message [Message to change its color]
     *
     * @return string
     */
    public function warningOutput(string $message): string
    {
        return "\033[0;33m{$message}\033[0m";
    }

    /**
     * Add a color to text to display information
     *
     * @param  string $message [Message to change its color]
     *
     * @return string
     */
    public function infoOutput(string $message): string
    {
        return "\033[0;36m{$message}\033[0m";
    }

    /**
     * Add a purple color to the text
     *
     * @param  string $message [Message to change its color]
     *
     * @return string
     */
    public function purpleOutput(string $message): string
    {
        return "\033[0;95m{$message}\033[0m";
    }
}
