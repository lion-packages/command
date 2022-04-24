<?php

namespace LionCommand\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\{ InputInterface, InputArgument };
use Symfony\Component\Console\Output\OutputInterface;

class ExampleCommand extends Command {

	protected static $defaultName = 'hello';

	protected function initialize(InputInterface $input, OutputInterface $output) {

	}

	protected function interact(InputInterface $input, OutputInterface $output) {

	}

	protected function configure(): void {
		$this->setDescription('Saludar.');
	}

	protected function execute(InputInterface $input, OutputInterface $output) {
		$output->writeln("Hola mundo");
		return Command::SUCCESS;
	}

}