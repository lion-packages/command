<?php 

namespace Test;

use LionCommand\Class\ExampleCommand;
use LionCommand\Kernel;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;

class KernelTest extends TestCase
{
	private Kernel $kernel;

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
		$this->kernel->commands([ExampleCommand::class]);
		$this->assertTrue($this->kernel->getApplication()->has('example'));
	}

	public function testExecute(): void
	{
		$output = ['Example command'];
		$this->assertSame($output, $this->kernel->execute('php lion example', false));
	}

	public function testExecuteForIndex(): void
	{
		$output = ['Example command'];
		$this->assertSame($output, $this->kernel->execute('cd html/ && echo "Example command"'));
	}

	public function setUp(): void
	{
		$this->kernel = new Kernel();
	}
}