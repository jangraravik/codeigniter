<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        
        //trigger_error("User error via trigger.", E_USER_ERROR);
        //trigger_error("Warning error via trigger.", E_USER_WARNING);
        //trigger_error("Notice error via trigger.", E_USER_NOTICE);
        //echo $this->inverse(5) . "\n";
        //echo $this->inverse(0) . "\n";		
		$this->load->view('welcome_message');
	}

    public function inverse($x)
    {
        if (!$x) {
            throw new Exception('Error: Division by zero.', E_USER_ERROR);
        } else {
            return 1/$x;
        }
    }	
}
