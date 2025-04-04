<?php

declare(strict_types=1);

namespace Lion\Command;

use Exception;
use InvalidArgumentException;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;

/**
 * Adds functions to execute commands, allows you to create an Application
 * object to run applications with your custom commands
 *
 * @package Lion\Command
 */
class Kernel
{
    /**
     * [An Application is the container for a collection of commands]
     *
     * @var Application $application
     */
    private Application $application;

    /**
     * [Class constructor]
     */
    public function __construct()
    {
        $this->application = new Application();
    }

    /**
     * Returns the current Application object
     *
     * @return Application
     */
    public function getApplication(): Application
    {
        return $this->application;
    }

    /**
     * Change the current Application object
     *
     * @param Application $application [An Application is the container for a
     * collection of commands]
     *
     * @return Kernel
     */
    public function setApplication(Application $application): Kernel
    {
        $this->application = $application;

        return $this;
    }

    /**
     * Add assigned commands from an array
     *
     * @param array<int, string> $commands [List of Command classes]
     *
     * @return void
     */
    public function commands(array $commands): void
    {
        foreach ($commands as $className) {
            /** @var Command $command */
            $command = new $className();

            $this->application->add($command);
        }
    }

    /**
     * Add assigned commands from an array
     *
     * @param array<int, Command> $commands [List of Command classes]
     *
     * @return void
     *
     * @infection-ignore-all
     */
    public function commandsOnObjects(array $commands): void
    {
        foreach ($commands as $command) {
            $this->application->add($command);
        }
    }

    /**
     * Run the current application
     *
     * @return void
     *
     * @throws Exception
     */
    public function run(): void
    {
        $this->application->run();
    }

    /**
     * Executes a terminal command, optionally from a relative directory
     *
     * @param string $command [The command to execute]
     * @param int $depth [How many levels up to go in the filesystem if using a
     * relative path (default: 1)]
     *
     * @return array<int, string> [The output of the executed command as an
     * array of lines]
     *
     * @throws InvalidArgumentException [If the number is negative]
     *
     * @infection-ignore-all
     */
    public function execute(string $command, int $depth = 0): array
    {
        if ($depth < 0) {
            throw new InvalidArgumentException('Expected a positive integer', 500);
        }

        $fullCommand = $depth > 0 ? 'cd ' . escapeshellarg(str_repeat('../', $depth)) . ' && ' . $command : $command;

        exec($fullCommand, $output);

        return $output;
    }
}
