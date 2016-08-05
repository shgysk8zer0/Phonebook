<?php
namespace Index;
use \Lib\Functions as Funcs;
use \shgysk8zer0\Core as Core;
use \shgysk8zer0\DOM as DOM;

require_once './constants.php';
require_once './lib/functions.php';

Funcs\php_version_check(\Constants\MIN_PHP_VERSION);
date_default_timezone_set(\Constants\TIMEZONE);
Funcs\autoloader(['./classes']);
Funcs\init_assert();
assert(
	'file_exists(\Constants\CREDS)',
	sprintf("Database credentials not found. Create '%s'.", \Constants\CREDS)
);

if (! Funcs\is_cli()) {
	Core\Console::getInstance()->asErrorHandler()->asExceptionHandler();
	DOM\HTML::$echoOnExit = true;
	Funcs\load('head', 'body');
}
