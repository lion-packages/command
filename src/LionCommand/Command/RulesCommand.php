<?php

namespace LionCommand\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\{ InputInterface, InputArgument };
use Symfony\Component\Console\Output\OutputInterface;
use LionCommand\Functions\{ FILES, ClassPath };

class RulesCommand extends Command {

    protected static $defaultName = "new:rule";
    private string $default_path = "app/Rules/";

    protected function initialize(InputInterface $input, OutputInterface $output) {
        $output->writeln("<comment>Creating rule...</comment>");
    }

    protected function interact(InputInterface $input, OutputInterface $output) {

    }

    protected function configure() {
        $this->setDescription(
            'Command required for rule creation'
        )->addArgument(
            'rule', InputArgument::REQUIRED, '', null
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $list = ClassPath::export(
            $this->default_path,
            $input->getArgument('rule')
        );

        $url_folder = lcfirst(str_replace("\\", "/", $list['namespace']));
        FILES::folder($url_folder);

        ClassPath::create($url_folder, $list['class']);
        ClassPath::add("<?php\r\n\n");
        ClassPath::add("namespace {$list['namespace']};\r\n\n");
        ClassPath::add("use LionSecurity\Validation;\r\n");
        ClassPath::add("use App\Traits\DisplayErrors;\r\n\n");
        ClassPath::add("class {$list['class']} {\r\n\n");
        ClassPath::add("\tuse DisplayErrors;\n\n");
        ClassPath::add("\tpublic function __construct() {\r\n\n\t}\r\n\n");
        ClassPath::add("\tpublic function passes(): " . $list['class'] . " {\r\n");
        ClassPath::add("\t\t" . '$this->validation = Validation::validate(' . "\n");
        ClassPath::add("\t\t\t(array) request, []\n");
        ClassPath::add("\t\t)->data;\n\n");
        ClassPath::add("\t\t" . 'return $this;' . "\n");
        ClassPath::add("\t}\r\n\n}");
        ClassPath::force();
        ClassPath::close();

        $output->writeln("<info>Rule created successfully</info>");
        return Command::SUCCESS;
    }

}