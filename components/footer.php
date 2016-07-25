<?php
namespace Components\Footer;

return function(\shgysk8zer0\DOM\HTML $dom)
{
	$manifest = \Lib\Functions\json_decode_file(\Constants\MANIFEST);

	$footer = $dom->body->append('footer');

	$footer->append('button', 'Contact', [
		'data-show-modal' => '#author_dialog'
	]);

	$footer->append('p', '&copy; ' . date('Y'));

	$footer->append('a', null, [
		'href'   => $manifest->repository->url,
		'target' => '_blank'
	])->append('svg', null, [
		'width'  => \Constants\ICON_SIZE,
		'height' => \Constants\ICON_SIZE
	])->append('use', null, [
		'xlink:href' => 'images/icons.svg#github'
	]);

	$footer->append('a', null, [
		'href'   => $manifest->bugs->url,
		'target' => '_blank'
	])->append('svg', null, [
		'width'  => \Constants\ICON_SIZE,
		'height' => \Constants\ICON_SIZE
	])->append('use', null, [
		'xlink:href' => 'images/icons.svg#issue-opened'
	]);

	\Lib\Functions\load('author');
};
