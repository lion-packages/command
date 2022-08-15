<?php

namespace LionCommand;

use Symfony\Component\Console\Application;

class SystemCommand {

	private static Application $application;

	private function __construct() {

	}

	public static function init(array $commands = []) {
		self::$application = new Application('Lion-Command', 'v2.3');
		self::addCommand($commands);
		self::$application->run();
	}

	private static function addCommand($commands) {
		if (count($commands) > 0) {
			foreach ($commands as $key => $command) {
				self::$application->add(new $command());
			}
		}
	}

}