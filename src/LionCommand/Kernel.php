<?php

declare(strict_types=1);

namespace LionCommand;

use Symfony\Component\Console\Application;

class Kernel
{
	private Application $application;

    public function __construct()
    {
        $this->application = new Application();
    }

    public function getApplication(): Application
    {
        return $this->application;
    }

    public function setApplication(Application $application): Kernel
    {
        $this->application = $application;
        return $this;
    }

    /** 
     * @param Command[] $commands
     * */
    public function commands(array $commands): void
    {
        foreach ($commands as $key => $command) {
            $this->application->add(new $command);
        }
    }

    public function run(): void
    {
        $this->application->run();
    }

    public function execute(string $command, bool $index = true, int $salt = 1): array
    {
        $data = [];

        if ($index) {
            $salt_str = "";
            
            for ($i = 0; $i < $salt; $i++) { 
                $salt_str .= "../";
            }

            exec("cd {$salt_str} && {$command}", $data);
            return $data;    
        }

        exec($command, $data);
        return $data;
    }
}