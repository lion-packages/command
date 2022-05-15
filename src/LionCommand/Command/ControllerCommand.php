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
		echo("Creating controller...\r\n");
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
		ClassPath::add("use App\Http\Controllers\Controller;\r\n\n");
		ClassPath::add("class {$list['class']} extends Controller {\r\n\n");
		ClassPath::add("	public function __construct() { \r\n");
		ClassPath::add('		$this->init();' . " \r\n");
		ClassPath::add("	}\r\n\n }");
		ClassPath::force();
		ClassPath::close();

		$output->writeln("Controller created successfully.");
		return Command::SUCCESS;
	}

}