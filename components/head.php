<?php
namespace Components\Head;
return function(\shgysk8zer0\DOM\HTML $dom, \shgysk8zer0\Core\Headers $headers)
{
	$manifest = \Functions\json_decode_file(\Index\MANIFEST);
	$dom->head->append('title', $manifest->name);
	$dom->head->append('meta', null, [
		'name'    => 'description',
		'content' => $manifest->description
	]);
	$dom->head->append('script', null, [
		'src'   => 'scripts/custom.js',
		'async' => null
	]);
	$dom->head->append('meta', null, [
		'name'    => 'keywords',
		'content' => join(', ', $manifest->keywords)
	]);
	$dom->head->append('link', null, [
		'rel'   => 'icon',
		'type'  => 'image/svg+xml',
		'sizes' => 'any',
		'href'  => 'images/appicons/any.svg'
	]);
	$dom->head->append('link', null, [
		'rel'   => 'stylesheet',
		'href'  => 'stylesheets/styles/styles.css',
		'media' => 'all'
	]);
};
