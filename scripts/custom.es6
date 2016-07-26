import * as Loader from './load.es6';
import polyfill from './std-js/polyfills.es6';
import {supportsAsClasses} from './std-js/support_test.es6';
import $ from './std-js/zq.es6';

supportsAsClasses('svg', 'audio', 'video', 'picture', 'canvas', 'menuitem',
'details', 'dialog', 'dataset', 'HTMLimports', 'classList', 'connectivity',
'visibility', 'notifications', 'ApplicationCache', 'indexedDB',
'localStorage', 'sessionStorage', 'CSSgradients', 'transitions',
'animations', 'CSSvars', 'CSSsupports', 'CSSmatches', 'querySelectorAll',
'workers', 'promises', 'ajax', 'FormData');

polyfill();

$(window).load(function() {
	if (! ('HTMLDetailsElement' in window)) {
		$('details > summary').click(Loader.toggleDetails);
	}

	$('[data-show-modal]').click(Loader.openModal);

	$('[data-close]').click(Loader.closeModal);
});
