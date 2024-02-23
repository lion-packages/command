<?php

declare(strict_types=1);

namespace Test;

use Lion\Command\Command;
use Lion\Command\Kernel;
use Lion\Test\Test;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class KernelTest extends Test
{
    const OUTPUT = ['Example command'];

    private Kernel $kernel;
    private object $customClass;

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

    public function testConstruct(): void
    {
        $kernel = new Kernel();

        $this->assertInstanceOf(Kernel::class, $kernel);
        $this->assertInstanceOf(Application::class, $kernel->getApplication());
    }

    public function testGetApplication(): void
    {
        $this->kernel->setApplication(new Application());

        $this->assertInstanceOf(Application::class, $this->kernel->getApplication());
    }

    public function testSetApplication(): void
    {
        $this->assertSame($this->kernel, $this->kernel->setApplication(new Application()));
        $this->assertInstanceOf(Application::class, $this->kernel->getApplication());
    }

    public function testCommands(): void
    {
        $this->kernel->commands([$this->customClass::class]);

        $this->assertTrue($this->kernel->getApplication()->has('example'));
    }

    public function testCommandsOnObjects(): void
    {
        $this->kernel->commandsOnObjects([$this->customClass]);

        $this->assertTrue($this->kernel->getApplication()->has('example'));
    }

    public function testExecute(): void
    {
        $this->assertSame(self::OUTPUT, $this->kernel->execute('cd html/ && echo "Example command"'));
    }
}
