<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']	= 'site';
$route['/']						= 'site/home';
$route['about']					= 'site/about';
$route['services']				= 'site/services';
$route['contact']				= 'site/contact';
$route['404_override']			= '';
$route['translate_uri_dashes'] = FALSE;
