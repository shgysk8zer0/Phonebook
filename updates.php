<?php
namespace Updates;

namespace HashCheck;
use \Lib\Functions as Funcs;
use \shgysk8zer0\Core as Core;
use \shgysk8zer0\Core_API as API;
use \shgysk8zer0\DOM as DOM;

require_once './constants.php';

if (in_array(PHP_SAPI, ['cli', 'cli-server'])) {
	require_once './lib/functions.php';
}

Funcs\init_assert();
Funcs\php_version_check('5.6');
Funcs\autoloader(['./classes']);

date_default_timezone_set(\Constants\TIMEZONE);

Core\Console::getInstance()->asErrorHandler()->asExceptionHandler();
$header = Core\Headers::getInstance();
$resp = new \stdClass();
$pdo = Core\PDO::load(\Constants\CONFIG);
$updates = $pdo->prepare('SELECT `id` FROM `contacts` WHERE `updated` > :timestamp;');
$updates->timestamp = 0;
$header->content_type = 'application/json';
exit(json_encode($updates->execute()->getResults()));
