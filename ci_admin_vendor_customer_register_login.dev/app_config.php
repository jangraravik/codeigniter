<?php

if ( basename( $_SERVER['PHP_SELF'] ) === basename(__FILE__) ) { die("ERROR - It's an Invalid Request"); };

date_default_timezone_set('Asia/Kolkata');
/*
For:
India ............. Asia/Kolkata
Eastern ........... America/New_York
Central ........... America/Chicago
Mountain .......... America/Denver
Mountain no DST ... America/Phoenix
Pacific ........... America/Los_Angeles
Alaska ............ America/Anchorage
Hawaii ............ America/Adak
Hawaii no DST ..... Pacific/Honolulu
*/


/* SITE GLOBAL VALUES */
define('DOMAIN',$_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']);
define("SITE_GOOGLE_VERIFICATION","");
define("SITE_GOOGLE_ANALYTICS","XXXXXXXXX");



/* DATABASE VALUES 
set CI_ENV in .htaccess file at root

Development (Localhost)
<IfModule mod_env.c>
    SetEnv CI_ENV development
</IfModule>

Testing (Your Local Server)
<IfModule mod_env.c>
    SetEnv CI_ENV testing
</IfModule>

Production (Remote Server)
<IfModule mod_env.c>
    SetEnv CI_ENV production
</IfModule>
*/
define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');
switch(ENVIRONMENT){
	case 'development':
		define("DB_HOST",'localhost:3366');
		define("DB_USER",'root');
		define("DB_PASS",'root');
		define("DB_NAME",'ci_admin_vendor_customer_register_login');
	break;
	case 'testing':
		define("DB_HOST",'value');
		define("DB_USER",'value');
		define("DB_PASS",'value');
		define("DB_NAME",'value');
	break;	
	case 'production':
		define("DB_HOST",'value');
		define("DB_USER",'value');
		define("DB_PASS",'value');
		define("DB_NAME",'value');
	break;
	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		exit('The application SERVER TYPE is not set correctly.');
		exit(1);
}