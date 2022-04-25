<?php

namespace LionCommand\Functions;

class ClassPath {

	private static $content;

	public function __construct() {

	}

	public static function export(string $default_path, string $class_name) {
		$namespace = "";
		$separate = explode("/", "{$default_path}{$class_name}");
		$count = count($separate);
		$list = [];

		foreach ($separate as $key => $part) {
			if ($key === ($count - 1)) {
				$list = [
					'namespace' => $namespace,
					'class' => ucwords($part)
				];
			} elseif ($key === ($count - 2)) {
				$namespace.= ucwords("$part");
			} else {
				$namespace.= ucwords("$part\\");
			}
		}

		return $list;
	}

	public static function create($url_folder, $class) {
		self::$content = fopen("{$url_folder}/{$class}.php", "w+b");
	}

	public static function add(string $line) {
		fwrite(self::$content, $line);
	}

	public static function force() {
		fflush(self::$content);
	}

	public static function close() {
		fclose(self::$content);
	}

}