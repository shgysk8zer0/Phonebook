<?php
namespace Components\Body;
return function(\shgysk8zer0\DOM\HTML $dom)
{
	$manifest = \Functions\json_decode_file(\Index\MANIFEST);
	$details = $dom->body->append('details');
	$details->append('summary', 'output');
	$details->append('pre', \htmlentities(print_r($manifest, true)));
	\Functions\load('footer');
};
