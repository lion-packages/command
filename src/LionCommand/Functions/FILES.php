<?php

namespace LionCommand\Functions;

class FILES {

	public function __construct() {

	}

	private static function response(string $status, ?string $message = null, array $data = []): object {
		return (object) [
			'status' => $status,
			'message' => $message,
			'data' => $data
		];
	}

	public static function folder(string $path): object {
		$path = self::replace($path);

		$requestExist = self::exist($path);
		if ($requestExist->status === 'error') {
			if (mkdir($path, 0777, true)) {
				return self::response('success');
			} else {
				return self::response('error', "Directory '{$path}' not created");
			}
		} else {
			return self::response('success');
		}
	}

	public static function exist(string $path): object {
		if (!file_exists($path)) {
			return self::response('error', "The file/folder '{$path}' does not exist.");
		}

		return self::response('success');
	}

	public static function replace(string $value): string {
		$value = str_replace("á", "á", $value);
		$value = str_replace("é", "é", $value);
		$value = str_replace("í", "í", $value);
		$value = str_replace("ó", "ó", $value);
		$value = str_replace("ú", "ú", $value);
		$value = str_replace("ñ", "ñ", $value);
		$value = str_replace("Ã¡", "á", $value);
		$value = str_replace("Ã©", "é", $value);
		$value = str_replace("Ã", "í", $value);
		$value = str_replace("Ã³", "ó", $value);
		$value = str_replace("Ãº", "ú", $value);
		$value = str_replace("Ã±", "ñ", $value);
		$value = str_replace("Ã", "á", $value);
		$value = str_replace("Ã‰", "é", $value);
		$value = str_replace("Ã", "í", $value);
		$value = str_replace("Ã“", "ó", $value);
		$value = str_replace("Ãš", "ú", $value);
		$value = str_replace("Ã‘", "ñ", $value);
		$value = str_replace("&aacute;", "á", $value);
		$value = str_replace("&eacute;", "é", $value);
		$value = str_replace("&iacute;", "í", $value);
		$value = str_replace("&oacute;", "ó", $value);
		$value = str_replace("&uacute;", "ú", $value);
		$value = str_replace("&ntilde;", "ñ", $value);

		return $value;
	}

}