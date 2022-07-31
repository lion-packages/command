<?php

namespace LionCommand\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\{ InputInterface, InputArgument };
use Symfony\Component\Console\Output\OutputInterface;
use LionCommand\Functions\{ FILES, ClassPath };

class MiddlewareCommand extends Command {

	protected static $defaultName = 'new:middleware';
	private string $default_path = "app/Http/Middleware/";

	protected function initialize(InputInterface $input, OutputInterface $output) {
		$output->writeln("<comment>Creating middleware...</comment>");
	}

	protected function interact(InputInterface $input, OutputInterface $output) {

	}

	protected function configure() {
		$this->setDescription(
			'Command required for the creation of new Middleware'
		)->addArgument(
			'middleware', InputArgument::REQUIRED, '', null
		);
	}

	protected function execute(InputInterface $input, OutputInterface $output) {
		$list = ClassPath::export(
			$this->default_path,
			$input->getArgument('middleware')
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

		$output->writeln("<info>Middleware created successfully</info>");
		return Command::SUCCESS;
	}

}