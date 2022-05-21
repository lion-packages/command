<?php

namespace LionCommand\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\{ InputInterface, InputArgument };
use Symfony\Component\Console\Output\OutputInterface;

class ServerCommand extends Command {

	protected static $defaultName = "server";

	protected function initialize(InputInterface $input, OutputInterface $output) {

	}

	protected function interact(InputInterface $input, OutputInterface $output) {

	}

	protected function configure() {
		$this->setDescription("created command to start server locally");
	}

	protected function execute(InputInterface $input, OutputInterface $output) {
		shell_exec("php -S localhost:4004");
		return Command::SUCCESS;
	}

}