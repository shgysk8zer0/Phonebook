<?php
namespace Index;

const MANIFEST = './package.json';

require_once './functions.php';
set_include_path(realpath('classes') . PATH_SEPARATOR . dirname(__DIR__));
spl_autoload_register('spl_autoload');
spl_autoload_extensions('.php');

\shgysk8zer0\DOM\HTML::$echoOnExit = true;

set_exception_handler(function(\Exception $e)
{
	header('Content-Type: text/plain');
	exit($e);
});

\Functions\load('head', 'body');

