<?php

declare(strict_types=1);

use Lion\Command\ExampleCommand;
use Lion\Command\Kernel;
use PHPUnit\Framework\TestCase;

class ExampleCommandTest extends TestCase
{
    private ExampleCommand $exampleCommand;

    public function testExecute(): void
    {
        $output = ['Example command'];
        $this->assertSame($output, (new Kernel())->execute('php lion example', false));
    }

    public function setUp(): void
    {
        $this->exampleCommand = new ExampleCommand();
    }
}
