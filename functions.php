<?php

namespace Functions;
const COMP_DIR = './components';

function json_decode_file($file, $assoc = false)
{
	static $files = array();
	if (array_key_exists($file, $files)) {
		return $files[$file];
	} else if (file_exists($file)) {
		$files[$file] = json_decode(file_get_contents($file), $assoc);
		return $files[$file];
	} else {
		throw new \Exception(sprintf('File "%s" not found in %s', $file, __FUNCTION__));
	}
}

function filename($file)
{
	$ext = pathinfo($file, PATHINFO_EXTENSION);
	return basename($file, ".$ext");
}

function load()
{
	array_map(__NAMESPACE__ . '\load_script', func_get_args());
}

function load_script($script)
{
	static $args = null;
	if (is_null($args)) {
		$args = array(
			\shgysk8zer0\DOM\HTML::getInstance(),
			\shgysk8zer0\Core\Headers::getInstance()
		);
	}

	$ret = require_once COMP_DIR . DIRECTORY_SEPARATOR . "{$script}.php";

	if (is_callable($ret)) {
		call_user_func_array($ret, $args);
	}
}
