<?php

declare(strict_types=1);

namespace LionCommand\Class;

use LionCommand\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExampleCommand extends Command
{
	public function configure(): void
	{
		$this
			->setName('example')
			->setDescription('Custom description');
	}

	public function execute(InputInterface $input, OutputInterface $output): int
	{
		$output->writeln("Example command");
		return Command::SUCCESS;
	}
}
