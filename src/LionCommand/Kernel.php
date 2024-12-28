<?php

declare(strict_types=1);

namespace Lion\Command;

use Symfony\Component\Console\Application;

/**
 * Adds functions to execute commands, allows you to create an Application
 * object to run applications with your custom commands
 *
 * @package Lion\Command
 */
class Kernel
{
    /**
     * [Initializes an application object to add commands]
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
     * @param Application $application [Application object]
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
     * @param  array<string> $commands [List of Command classes]
     *
     * @return void
     */
    public function commands(array $commands): void
    {
        foreach ($commands as $command) {
            $this->application->add(new $command());
        }
    }

    /**
     * Add assigned commands from an array
     *
     * @param  array<Command> $commands [List of Command classes]
     *
     * @return void
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
     */
    public function run(): void
    {
        $this->application->run();
    }

    /**
     * Run commands either within a public in the project root
     *
     * @param  string $command [Command to execute]
     * @param  bool $index [indicates whether it is in 'public/index.php' or in
     * the root of the project]
     * @param  int $salt [Number of times to be returned in a '../' directory]
     *
     * @return array
     */
    public function execute(string $command, bool $index = true, int $salt = 1): array
    {
        $data = [];

        if ($index) {
            $salt_str = '';

            for ($i = 0; $i < $salt; $i++) {
                $salt_str .= '../';
            }

            exec("cd {$salt_str} && {$command}", $data);

            return $data;
        }

        exec($command, $data);

        return $data;
    }
}
