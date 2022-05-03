<?php

namespace LionCommand;

use Symfony\Component\Console\Application;
use LionCommand\Command\{ ControllerCommand, ModelCommand, MiddlewareCommand, CommandsCommand, ExampleCommand, CapsuleCommand };

class SystemCommand {

	private static Application $application;

	private function __construct() {

	}

	public static function init(array $commands = []) {
		self::$application = new Application('Lion-Command', '1.3');

		array_push($commands,
			ControllerCommand::class,
			ModelCommand::class,
			MiddlewareCommand::class,
			CommandsCommand::class,
			CapsuleCommand::class
		);
		self::addCommand($commands);

		self::$application->run();
	}

	private static function addCommand($commands) {
		if (count($commands) > 0) {
			foreach ($commands as $key => $command) {
				self::$application->add(new $command);
			}
		}
	}

}