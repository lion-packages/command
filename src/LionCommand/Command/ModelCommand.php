<?php

namespace LionCommand\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\{ InputInterface, InputArgument };
use Symfony\Component\Console\Output\OutputInterface;
use LionCommand\Functions\{ FILES, ClassPath };

class ModelCommand extends Command {

	protected static $defaultName = 'new:model';
	private string $default_path = "app/Models/";

	protected function initialize(InputInterface $input, OutputInterface $output) {
		$output->writeln("<comment>Creating model...</comment>");
	}

	protected function interact(InputInterface $input, OutputInterface $output) {

	}

	protected function configure() {
		$this->setDescription(
			'Command required for the creation of new Models.'
		)->addArgument(
			'model', InputArgument::REQUIRED, '', null
		);
	}

	protected function execute(InputInterface $input, OutputInterface $output) {
		$list = ClassPath::export(
			$this->default_path,
			$input->getArgument('model')
		);

		$url_folder = lcfirst(str_replace("\\", "/", $list['namespace']));
		FILES::folder($url_folder);

		ClassPath::create($url_folder, $list['class']);
		ClassPath::add("<?php\r\n\n");
		ClassPath::add("namespace {$list['namespace']};\r\n\n");
		ClassPath::add("use App\Models\Model; \r\n");
		ClassPath::add("use LionSql\Drivers\MySQLDriver as Builder;\r\n\n");
		ClassPath::add("class {$list['class']} extends Model {\r\n\n");
		ClassPath::add("\tpublic function __construct() {\r\n\t\t" . '$this->init();' . "\r\n\t}");
		ClassPath::add("\r\n\n}");
		ClassPath::force();
		ClassPath::close();

		$output->writeln("<info>Model created successfully</info>");
		return Command::SUCCESS;
	}

}