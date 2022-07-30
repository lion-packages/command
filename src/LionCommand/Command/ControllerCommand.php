<?php

namespace LionCommand\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\{ InputInterface, InputArgument };
use Symfony\Component\Console\Output\OutputInterface;
use LionCommand\Functions\{ FILES, ClassPath };

class ControllerCommand extends Command {

	protected static $defaultName = 'new:controller';
	private string $default_path = "app/Http/Controllers/";

	protected function initialize(InputInterface $input, OutputInterface $output) {
		$output->writeln("<comment>Creating controller...</comment>");
	}

	protected function interact(InputInterface $input, OutputInterface $output) {

	}

	protected function configure() {
		$this->setDescription(
			'Command required for the creation of new Controllers.'
		)->addArgument(
			'controller', InputArgument::REQUIRED, '', null
		);
	}

	protected function execute(InputInterface $input, OutputInterface $output) {
		$list = ClassPath::export(
			$this->default_path,
			$input->getArgument('controller')
		);

		$url_folder = lcfirst(str_replace("\\", "/", $list['namespace']));
		FILES::folder($url_folder);

		ClassPath::create($url_folder, $list['class']);
		ClassPath::add("<?php\r\n\n");
		ClassPath::add("namespace {$list['namespace']};\r\n\n");
		ClassPath::add("class {$list['class']} {\r\n\n");
		ClassPath::add("\tpublic function __construct() {\r\n\n\t}\r\n\n}");
		ClassPath::force();
		ClassPath::close();

		$output->writeln("<info>Controller created successfully</info>");
		return Command::SUCCESS;
	}

}