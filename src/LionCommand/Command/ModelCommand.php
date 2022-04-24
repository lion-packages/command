<?php

namespace LionCommand\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\{ InputInterface, InputArgument };
use Symfony\Component\Console\Output\OutputInterface;

class ModelCommand extends Command {

	protected static $defaultName = 'create:model';

	protected function initialize(InputInterface $input, OutputInterface $output) {
		echo("Initializing... \n\r");
	}

	protected function interact(InputInterface $input, OutputInterface $output) {

	}

	protected function configure(): void {
		$this->setDescription(
			'Command required for the creation of new Models.'
		)->addArgument(
			'model', InputArgument::REQUIRED, '', null
		);
	}

	protected function execute(InputInterface $input, OutputInterface $output) {
		$default_path = "app/Models/";
		$model = $input->getArgument('model');
		$output->writeln("New model created: {$model}");
		return Command::SUCCESS;
	}

}