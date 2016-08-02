<?php
namespace GetAll;

use \Lib\Functions as Funcs;
use \shgysk8zer0\Core as Core;
use \shgysk8zer0\Core_API\Abstracts\HTTPStatusCodes as Status;

require_once './constants.php';
require_once './lib/functions.php';

Funcs\init_assert();
Funcs\php_version_check(\Constants\MIN_PHP_VERSION);
Funcs\autoloader(['./classes']);
date_default_timezone_set(\Constants\TIMEZONE);

if (array_key_exists('timestamp', $_GET)) {
	try {
		$pdo = Core\PDO::load(\Constants\CREDS);
		if (! $pdo->connected) {
			throw new \Exception('Database not connected');
		}
	} catch(\Exception $e) {
		http_response_code(Status::INTERNAL_SERVER_ERROR);
		exit($e->getMessage());
	}

	$datetime = gmdate(\DateTime::W3C, $_GET['timestamp']);;
	$headers = Core\Headers::getInstance();
	$query = $pdo->prepare(
		'SELECT *
		FROM `contacts`
		WHERE `updated` > :datetime;'
	);

	$query->datetime = $datetime;
	$headers->content_type = 'application/json';
	echo json_encode($query->execute()->getResults(), JSON_PRETTY_PRINT);
} else {
	http_response_code(Status::BAD_REQUEST);
}

