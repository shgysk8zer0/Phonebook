<?php
namespace Components\Body;
use \Lib\Functions as Funcs;

return function(\shgysk8zer0\DOM\HTML $dom)
{
	$manifest = Funcs\json_decode_file(\Constants\MANIFEST);
	$details = $dom->body->append('details');
	$details->append('summary', 'output');
	$details->append('pre', \htmlentities(print_r($manifest, true)));
	Funcs\load('footer');
};
