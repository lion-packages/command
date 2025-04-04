<?php

declare(strict_types=1);

namespace Tests;

use InvalidArgumentException;
use Lion\Command\Command;
use Lion\Command\Kernel;
use Lion\Test\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestWith;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use PHPUnit\Framework\Attributes\Test as Testing;
use Tests\Providers\KernelProviderTrait;

class KernelTest extends Test
{
    use KernelProviderTrait;

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

                return parent::SUCCESS;
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

    /**
     * @param string $command
     * @param int $depth
     * @param array{
     *     command: string,
     *     depth: int,
     *     return: array<int, string>
     * } $return
     *
     * @return void
     */
    #[Testing]
    #[DataProvider('executeProvider')]
    public function execute(string $command, int $depth, array $return): void
    {
        $this->createDirectory('./storage/files/');

        $this->createImage();

        $this->assertSame($return, $this->kernel->execute($command, $depth));

        $this->rmdirRecursively('./storage');
    }

    #[Testing]
    #[TestWith(['depth' => -1])]
    #[TestWith(['depth' => -2])]
    #[TestWith(['depth' => -3])]
    #[TestWith(['depth' => -4])]
    public function executeWithDepthNegative(int $depth): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage('Expected a positive integer');

        $this->kernel->execute('ls', $depth);
    }
}
