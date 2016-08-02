<?php
namespace Status;
use \Lib\Functions as Funcs;
use \shgysk8zer0\Core as Core;

require_once './constants.php';
require_once './lib/functions.php';

error_reporting(0);
Funcs\init_assert();
Funcs\php_version_check(\Constants\MIN_PHP_VERSION);
Funcs\autoloader(['./classes']);
date_default_timezone_set(\Constants\TIMEZONE);
Core\Headers::getInstance()->content_type = 'application/json';

$package = Funcs\json_decode_file('./package.json');

try {
	$pdo = Core\PDO::load('dne');
} catch (\Exception $e) {
	$pdo = new \stdClass();
	$pdo->connected = false;
}

exit(json_encode([
	'name'         => $package->name,
	'version'      => $package->version,
	'db connected' => $pdo->connected,
	'debug mode'   => \Constants\DEBUG
]));

