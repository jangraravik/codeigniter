<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'site_ctl';
$route['register'] = 'site_ctl/register';
$route['login'] = 'site_ctl/login';
$route['logout'] = 'site_ctl/logout';

$route['account/index'] = 'account_ctl/index';
$route['account/register'] = 'account_ctl/register';
$route['account/reset'] = 'account_ctl/reset';
$route['account/login'] = 'account_ctl/login';
$route['account/logout'] = 'account_ctl/logout';


$route['administrator'] = 'administrator_ctl';
$route['administrator/dashboard'] = 'administrator_ctl/dashboard';
$route['administrator/logout'] = 'administrator_ctl/logout';


$route['vendor'] = 'vendor_ctl';
$route['vendor/dashboard'] = 'vendor_ctl/dashboard';
$route['vendor/logout'] = 'vendor_ctl/logout';


$route['customer'] = 'customer_ctl';
$route['customer/dashboard'] = 'customer_ctl/dashboard';
$route['customer/logout'] = 'customer_ctl/logout';

$route['404_override'] = 'site_ctl/show_404';
$route['translate_uri_dashes'] = FALSE;