<?php
namespace Columns;
use \Lib\Functions as Funcs;
use \shgysk8zer0\Core as Core;

require_once './constants.php';
require_once './lib/functions.php';

Funcs\init_assert();
Funcs\php_version_check(\Constants\MIN_PHP_VERSION);
Funcs\autoloader(['./classes']);
date_default_timezone_set(\Constants\TIMEZONE);

function reduce_cols(\stdClass $carry, \stdClass $col)
{
	$item = new \stdClass();
	$item->type = preg_replace('/\(\d+\)$/', null, $col->Type);
	$item->length = preg_match('/\D+/', $col->Type)
		? (int)preg_replace('/\D+/', null, $col->Type)
		: null;
	$item->{'null'} = $col->{'Null'} === 'YES';
	$item->key = $col->Key;
	$item->default = $col->Default;
	$item->extra = $col->Extra;
	$carry->{$col->Field} = $item;
	return $carry;
}

$pdo = Core\PDO::load(\Constants\CREDS);
$headers = Core\Headers::getInstance();
$headers->content_type = 'application\json';
$cols = $pdo('DESCRIBE `contacts`;');
$cols = array_reduce($cols, __NAMESPACE__ . '\reduce_cols', new \stdClass());
echo json_encode($cols, JSON_PRETTY_PRINT);
