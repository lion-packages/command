<?php 

declare(strict_types=1);

namespace Test;

use LionCommand\Command;
use PHPUnit\Framework\TestCase;

class CommandTest extends TestCase
{
	private $customCommand;

	public function testErrorOutput(): void
	{
		$this->assertSame("\033[0;31mTest\033[0m", $this->customCommand->errorOutput('Test'));
	}

	public function testSuccessOutput(): void
	{
		$this->assertSame("\033[0;32mTest\033[0m", $this->customCommand->successOutput('Test'));
	}

	public function testWarningOutput(): void
	{
		$this->assertSame("\033[0;33mTest\033[0m", $this->customCommand->warningOutput('Test'));
	}

	public function testInfoOutput(): void
	{
		$this->assertSame("\033[0;36mTest\033[0m", $this->customCommand->infoOutput('Test'));
	}

	public function testPurpleOutput(): void
	{
		$this->assertSame("\033[0;95mTest\033[0m", $this->customCommand->purpleOutput('Test'));
	}

	public function setUp(): void
	{
		$this->customCommand = new class extends Command {};
	}
}