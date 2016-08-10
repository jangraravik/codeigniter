<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Auto Build Database tables
|--------------------------------------------------------------------------
*/

$config['errorlog']['table_name'] = 'app_errorlog';
$config['errorlog']['auto_build_db'] = TRUE;


/*
|--------------------------------------------------------------------------
| Auto Fix Database tables
|--------------------------------------------------------------------------
*/
$config['errorlog']['auto_fix_db'] = TRUE;