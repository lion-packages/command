<?php

namespace LionCommand\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\{ InputInterface, InputArgument };
use Symfony\Component\Console\Output\OutputInterface;
use LionCommand\Functions\FILES;

class ControllerCommand extends Command {

	protected static $defaultName = 'create:controller';

	protected function initialize(InputInterface $input, OutputInterface $output) {
		echo("Initializing... \n\r");
	}

	protected function interact(InputInterface $input, OutputInterface $output) {

	}

	protected function configure(): void {
		$this->setDescription(
			'Command required for the creation of new Controllers.'
		)->addArgument(
			'path', InputArgument::REQUIRED, '', null
		)->addArgument(
			'controller', InputArgument::REQUIRED, '', null
		);
	}

	protected function execute(InputInterface $input, OutputInterface $output) {
		$default_path = "app/Http/Controllers/";
		$path = $input->getArgument('path');
		$controller = $input->getArgument('controller');

		FILES::folder("{$default_path}{$path}");

		$output->writeln("New controller created: {$default_path}{$path}{$controller}.php");
		return Command::SUCCESS;
	}

}