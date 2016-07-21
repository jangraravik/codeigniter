<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account_ctl extends MY_Controller{

	public function __construct()
	{
		parent::__construct();
        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Sat, 8 Jul 1986 05:00:00 GMT");
        //$this->load->model(array('customer_mdl','vendor_mdl'));
	}

	public function index()
	{
		if ($this->session->userdata('admin_login') === TRUE){
			redirect('administrator/dashboard', 'refresh');
		}
		if ($this->session->userdata('vendor_login') === TRUE){
			redirect('vendor/dashboard', 'refresh');
		}
		if ($this->session->userdata('customer_login') === TRUE){
			redirect('customer/dashboard', 'refresh');
		}
	}


	public function register()
	{
		if($this->input->post('actRegister')){
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters("<span>","</span>");
			if($this->form_validation->run('register')){
				if($this->input->post('reg_type') === 'customer'){
					//echo 'Register as Customer '.test($_POST);
				$customer_id = -1;
				$person_data = array(
								'first_name'=>$this->input->post('first_name'),
								'last_name'=>$this->input->post('last_name'),
								'email'=>$this->input->post('email'),
								'addedon'=>time());
				$customer_data = array(
								'username'=>$this->input->post('email'),
								'password'=>md5($this->input->post('password')),
								'status'=>1);
				$this->customer_mdl->save_customer($person_data,$customer_data,$customer_id);
				} /* end reg customer */

				if($this->input->post('reg_type') === 'vendor'){
					//echo 'Register New Vendor <br>'.test($_POST);
				$vendor_id = -1;
				$person_data = array(
								'first_name'=>$this->input->post('first_name'),
								'last_name'=>$this->input->post('last_name'),
								'email'=>$this->input->post('email'),
								'addedon'=>time());
				$vendor_data = array(
								'username'=>$this->input->post('email'),
								'password'=>md5($this->input->post('password')),
								'status'=>1);
				$this->vendor_mdl->save_vendor($person_data,$vendor_data,$vendor_id);					
				} /* end reg vendor */

				redirect('account/login', 'refresh');
			}
		}
	$this->load->view('site/register');
	}

	public function reset()
	{
		echo "Reset account password";//$this->load->view('site/reset');
	}

	public function login()
	{
		$this->index();		
		if($this->input->post('actLogin')){
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters("<span>","</span>");
			if($this->form_validation->run('login')){
				$user = $this->input->post('username');
				$pass = $this->input->post('password');
				$pass = md5($pass);
				$isLoginValid = $this->validateLogin($user,$pass);
				if($isLoginValid){
					$this->flash->success('Successfully logged in');
					redirect('account/index', 'refresh');
				} else {
				//echo validation_errors();exit;	
					$this->flash->error('Invalid login Credentials or Account is not active.');
					//$this->session->set_userdata('msgs',array('msgsText'=>'Invalid login Credentials or Account is not active','msgsClass'=>'alert-danger'));
				}
			}
		}
	//$this->flash->awesome('This is a %s %s', array('awesome', 'message'));		
	//$this->flash->info('Please enter your login details');
	$this->load->view('site/login');
	}

   
    private function validateLogin($thisuser,$thispass)
    {
    	$credential = array('username' => $thisuser, 'password' => $thispass, 'status' => 1, 'isonline' => 0);

		// Checking login credential if admin
		$query = $this->db->get_where('administrators', $credential);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$this->session->set_userdata('admin_login', TRUE);
			$this->session->set_userdata('admin_id', $row->person_id);
			$setLoggedIn = array('isonline' => 1, 'last_logged_on' => date('Y-m-d h:i:s'));
			$this->db->where('person_id', $this->session->userdata('admin_id'));
			$this->db->update('administrators', $setLoggedIn);
		return TRUE;
		}

		// Checking login credential if vendor
		$query = $this->db->get_where('vendors', $credential);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$this->session->set_userdata('vendor_login', TRUE);
			$this->session->set_userdata('vendor_id', $row->person_id);
			$setLoggedIn = array('isonline' => 1, 'last_logged_on' => date('Y-m-d h:i:s'));
			$this->db->where('person_id', $this->session->userdata('vendor_id'));
			$this->db->update('vendors', $setLoggedIn);			
		return TRUE;
		}

		// Checking login credential if customer
		$query = $this->db->get_where('customers', $credential);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$this->session->set_userdata('customer_login', TRUE);
			$this->session->set_userdata('customer_id', $row->person_id);
			$setLoggedIn = array('isonline' => 1, 'last_logged_on' => date('Y-m-d h:i:s'));
			$this->db->where('person_id', $this->session->userdata('customer_id'));
			$this->db->update('customers', $setLoggedIn);				
		return TRUE;
		}
	return FALSE;
    }





}