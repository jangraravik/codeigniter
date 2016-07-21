<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['display_override'][] = array(
	'class'  	=> 'Develbar',
	'function' 	=> 'debug',
	'filename' 	=> 'Develbar.php',
	'filepath' 	=> 'third_party/DevelBar/hooks'
);

$hook['post_controller_constructor'] = array(
    'class'    => 'site_lang_switcher_hook',
    'function' => 'site_language_switch',
    'filename' => 'site_lang_switcher_hook.php',
    'filepath' => 'hooks'
);

