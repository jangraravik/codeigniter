<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
        
	## Log Error via error_handler()
	  trigger_error("Custom Error via trigger.", E_USER_ERROR);
	  trigger_error("Custom Warning via trigger.", E_USER_WARNING);
	  trigger_error("Custom Notice via trigger.", E_USER_NOTICE);


	## Log Error via exception_handler()
	  $date['a'] = 1;
		if (empty($date['a'])) {
			throw new Exception('No input value is provided.', E_USER_WARNING);
		} 

	$this->load->view('welcome_message',$date);
	}
	
}
