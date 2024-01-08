<?php

declare(strict_types=1);

namespace Lion\Command;

use Symfony\Component\Console\Application;

class Kernel
{
    private Application $application;

    public function __construct()
    {
        $this->application = new Application();
    }

    /**
     * Returns the current Application object
     * */
    public function getApplication(): Application
    {
        return $this->application;
    }

    /**
     * Change the current Application object
     * */
    public function setApplication(Application $application): Kernel
    {
        $this->application = $application;

        return $this;
    }

    /**
     * Add assigned commands from an array
     * */
    public function commands(array $commands): void
    {
        foreach ($commands as $command) {
            $this->application->add(new $command);
        }
    }

    /**
     * Run the current application
     * */
    public function run(): void
    {
        $this->application->run();
    }

    /**
     * Run commands either within a public in the project root
     * */
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
