<?php

namespace LionCommand\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\{ InputInterface, InputArgument };
use Symfony\Component\Console\Output\OutputInterface;

class MiddlewareCommand extends Command {

	protected static $defaultName = 'create:middleware';

	protected function initialize(InputInterface $input, OutputInterface $output) {
		echo("Initializing... \n\r");
	}

	protected function interact(InputInterface $input, OutputInterface $output) {

	}

	protected function configure(): void {
		$this->setDescription(
			'Command required for the creation of new Middleware.'
		)->addArgument(
			'middleware', InputArgument::REQUIRED, '', null
		);
	}

	protected function execute(InputInterface $input, OutputInterface $output) {
		$default_path = "app/Http/Middleware/";
		$middleware = $input->getArgument('middleware');
		$output->writeln("New middleware created: {$middleware}");
		return Command::SUCCESS;
	}

}