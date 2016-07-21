<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once('interfaces/Profile_interface_ctl.php');
class Customer_ctl extends MY_Controller implements Profile_interface_ctl
{

	private $table = 'customers';
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('customer_login') === TRUE){
			redirect('login', 'refresh');
		}
		$this->load->model(['person_mdl','customer_mdl']);
	}

	public function index()
	{
		$this->dashboard();
	}

	public function dashboard()
	{
		$id = $this->session->userdata('customer_id');
		$data['name'] = $this->customer_mdl->getFullNameById($id);
		$data['lastLoggedOn'] = $this->customer_mdl->getLastLoggedById($this->table,$id);
		$this->load->view('site/customer/dashboard',$data);
	}

	public function logout()
	{
		$setLoggedIn = array('isonline' => 0);
		$this->db->where('person_id', $this->session->userdata('customer_id'));
		$this->db->update($this->table, $setLoggedIn);			
		$this->session->unset_userdata(['customer_login', 'customer_id']);
		$this->session->set_flashdata('msgs', 'You are logged out');
		redirect('login', 'refresh');
	}



}
