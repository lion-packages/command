<?php

declare(strict_types=1);

namespace Tests;

use Lion\Command\Command;
use Lion\Command\Kernel;
use Lion\Test\Test;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use PHPUnit\Framework\Attributes\Test as Testing;

class KernelTest extends Test
{
    private const array OUTPUT = [
        'Example command',
    ];

    private Kernel $kernel;
    private Command $customClass;

    public function setUp(): void
    {
        $this->kernel = new Kernel();

        $this->customClass = new class extends Command {
            protected function configure(): void
            {
                $this
                    ->setName('example')
                    ->setDescription('Custom description');
            }

            protected function execute(InputInterface $input, OutputInterface $output): int
            {
                $output->writeln('Example command');

                return Command::SUCCESS;
            }
        };

        $this->kernel->commands([$this->customClass::class]);
    }

    #[Testing]
    public function construct(): void
    {
        $kernel = new Kernel();

        $this->assertInstanceOf(Kernel::class, $kernel);
        $this->assertInstanceOf(Application::class, $kernel->getApplication());
    }

    #[Testing]
    public function getApplication(): void
    {
        $this->kernel->setApplication(new Application());

        $this->assertInstanceOf(Application::class, $this->kernel->getApplication());
    }

    #[Testing]
    public function setApplication(): void
    {
        $this->assertSame($this->kernel, $this->kernel->setApplication(new Application()));
        $this->assertInstanceOf(Application::class, $this->kernel->getApplication());
    }

    #[Testing]
    public function commands(): void
    {
        $this->kernel->commands([$this->customClass::class]);

        $this->assertTrue($this->kernel->getApplication()->has('example'));
    }

    #[Testing]
    public function commandsOnObjects(): void
    {
        $this->kernel->commandsOnObjects([$this->customClass]);

        $this->assertTrue($this->kernel->getApplication()->has('example'));
    }

    #[Testing]
    public function execute(): void
    {
        $this->assertSame(self::OUTPUT, $this->kernel->execute('echo "Example command"'));
    }
}
