<?php
namespace Index;
use \Lib\Functions as Funcs;
use \shgysk8zer0\Core as Core;
use \shgysk8zer0\DOM as DOM;

const VERSION = '0.0.0';

require_once './constants.php';
require_once './lib/functions.php';

Funcs\init_assert();
Funcs\php_version_check(\Constants\MIN_PHP_VERSION);
Funcs\autoloader(['./classes']);
date_default_timezone_set(\Constants\TIMEZONE);

assert('file_exists(\Constants\CREDS)', "Database credentials not found.");

if (! Funcs\is_cli()) {
	Core\Console::getInstance()->asErrorHandler()->asExceptionHandler();
	DOM\HTML::$echoOnExit = true;
	Funcs\load('head', 'body');
	$pdo = Core\PDO::load(\Constants\CREDS);
		$all = $pdo(
		'SELECT
		`displayName` as `name`,
		`associatedNumbers` as `tel`,
		`allLines` as `full text`
		FROM `contacts`;'
	);
	$hash = md5(json_encode($all));
	Core\Console::getInstance()->log($hash);
}

