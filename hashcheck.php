<?php
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

if (isset($header->hash)) {
	$pdo = Core\PDO::load(\Constants\CONFIG);
	$all = $pdo(
		'SELECT
			`displayName` as `name`,
			`associatedNumbers` as `tel`,
			`allLines` as `full text`
		FROM `contacts`;'
	);
	$hash = md5(json_encode($all));
	if ($header->hash === $hash) {
		http_response_code(API\Abstracts\HTTPStatusCodes::NOT_MODIFIED);
		$resp->status = 'Not modified';
	} else {
		http_response_code(API\Abstracts\HTTPStatusCodes::RESET_CONTENT);
	}
} else {
	http_response_code(API\Abstracts\HTTPStatusCodes::PRECONDITION_FAILED);
}
Core\Console::getInstance()->table($pdo('DESCRIBE `contacts`;'));
if ($header->accept === 'application/json') {
	$header->content_type = 'application/json';
	exit(json_encode($resp));
}
