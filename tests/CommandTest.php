<?php

declare(strict_types=1);

namespace Tests;

use Lion\Command\Command;
use Lion\Test\Test;

class CommandTest extends Test
{
    private const string TEST = 'Test';
    private const string ERROR_OUTPUT = "\033[0;31mTest\033[0m";
    private const string SUCCESS_OUTPUT = "\033[0;32mTest\033[0m";
    private const string WARNING_OUTPUT = "\033[0;33mTest\033[0m";
    private const string INFO_OUTPUT = "\033[0;36mTest\033[0m";
    private const string PURPLE_OUTPUT = "\033[0;95mTest\033[0m";

    private Command $customCommand;

    public function setUp(): void
    {
        $this->customCommand = new class extends Command {
        };
    }

    public function testErrorOutput(): void
    {
        $this->assertSame(self::ERROR_OUTPUT, $this->customCommand->errorOutput(self::TEST));
    }

    public function testSuccessOutput(): void
    {
        $this->assertSame(self::SUCCESS_OUTPUT, $this->customCommand->successOutput(self::TEST));
    }

    public function testWarningOutput(): void
    {
        $this->assertSame(self::WARNING_OUTPUT, $this->customCommand->warningOutput(self::TEST));
    }

    public function testInfoOutput(): void
    {
        $this->assertSame(self::INFO_OUTPUT, $this->customCommand->infoOutput(self::TEST));
    }

    public function testPurpleOutput(): void
    {
        $this->assertSame(self::PURPLE_OUTPUT, $this->customCommand->purpleOutput(self::TEST));
    }
}
