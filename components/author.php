<?php
namespace Components\Author;
return function(\shgysk8zer0\DOM\HTML $dom)
{
	$id = \Lib\Functions\filename(__FILE__) . '_dialog';
	$manifest = \Lib\Functions\json_decode_file(\Constants\MANIFEST);
	$gravatar = new \shgysk8zer0\Gravatar\URL($manifest->author->email, 128);

	$dialog = $dom->body->append('dialog', null, [
		'id' => $id,
		'itemscope' => null,
		'itemtype'  => 'https://schema.org/Person'
	]);

	$dialog->append('button', null, ['data-close' => "#{$id}"]);
	$dialog->append('br');

	$dialog->append('p', $manifest->author->name, ['itemprop' => 'name']);

	$dialog->append('img', null, [
		'width'    => $gravatar->s,
		'height'   => $gravatar->s,
		'src'      => $gravatar,
		'alt'      => $manifest->author->name,
		'itemprop' => 'image'
	]);

	$dialog->append('br');
	$dialog->append('a', $manifest->author->email, [
		'href'     => "mailto:{$manifest->author->email}?subject={$manifest->name}",
		'itemprop' => 'email'
	]);
};
