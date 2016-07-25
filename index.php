<?php
namespace Index;
use \Lib\Functions as Funcs;

require_once './constants.php';

if (in_array(PHP_SAPI, ['cli', 'cli-server'])) {
	require_once './lib/functions.php';
}

Funcs\init_assert();
Funcs\php_version_check('5.6');
Funcs\autoloader(['classes', '..', './config']);

date_default_timezone_set(\Constants\TIMEZONE);

\shgysk8zer0\Core\Console::getInstance()->asErrorHandler()->asExceptionHandler();
\shgysk8zer0\DOM\HTML::$echoOnExit = true;
Funcs\load('head', 'body');
