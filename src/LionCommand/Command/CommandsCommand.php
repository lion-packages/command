<?php

namespace LionCommand\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\{ InputInterface, InputArgument };
use Symfony\Component\Console\Output\OutputInterface;
use LionCommand\Functions\{ FILES, ClassPath };

class CommandsCommand extends Command {

	protected static $defaultName = "new:command";
	private string $default_path = "app/Console/";

	protected function initialize(InputInterface $input, OutputInterface $output) {
		echo("Creating command... \r\n");
	}

	protected function interact(InputInterface $input, OutputInterface $output) {

	}

	protected function configure() {
		$this->setDescription(
			'Command required for the creation of new Commands.'
		)->addArgument(
			'new-command', InputArgument::REQUIRED, '', null
		);
	}

	protected function execute(InputInterface $input, OutputInterface $output) {
		$list = ClassPath::export(
			$this->default_path,
			$input->getArgument('new-command')
		);

		$url_folder = lcfirst(str_replace("\\", "/", $list['namespace']));
		FILES::folder($url_folder);

		ClassPath::create($url_folder, $list['class']);
		ClassPath::add("<?php \r\n\n");
		ClassPath::add("namespace {$list['namespace']}; \r\n\n");
		ClassPath::add("use Symfony\Component\Console\Command\Command; \r\n");
		ClassPath::add("use Symfony\Component\Console\Input\{ InputInterface, InputArgument }; \r\n");
		ClassPath::add("use Symfony\Component\Console\Output\OutputInterface; \r\n\n");
		ClassPath::add("class {$list['class']} extends Command { \r\n\n");
		ClassPath::add('	protected static $defaultName = "";' . "\r\n");
		ClassPath::add('	private string $default_path = "";' . "\r\n\n");
		ClassPath::add('	protected function initialize(InputInterface $input, OutputInterface $output) {' . "\r\n\n");
		ClassPath::add("	} \r\n\n");
		ClassPath::add('	protected function interact(InputInterface $input, OutputInterface $output) {' . "\r\n\n");
		ClassPath::add("	} \r\n\n");
		ClassPath::add("	protected function configure() { \r\n");
		ClassPath::add('		$this->setDescription("")->addArgument("", InputArgument::REQUIRED, "", null);' . "\r\n");
		ClassPath::add("	} \r\n\n");
		ClassPath::add('	protected function execute(InputInterface $input, OutputInterface $output) {' . "\r\n");
		ClassPath::add('		$output->writeln("");' . "\r\n");
		ClassPath::add('		return Command::SUCCESS;' . "\r\n");
		ClassPath::add("	} \r\n\n");
		ClassPath::add("}");
		ClassPath::force();
		ClassPath::close();

		$output->writeln("Command created successfully.");
		return Command::SUCCESS;
	}

}