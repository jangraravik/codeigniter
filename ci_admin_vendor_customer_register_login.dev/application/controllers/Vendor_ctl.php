<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once('interfaces/Profile_interface_ctl.php');
class Vendor_ctl extends MY_Controller implements Profile_interface_ctl
{

	private $table = 'vendors';
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('vendor_login') === TRUE){
			redirect('login', 'refresh');
		}
		$this->load->model(['person_mdl','vendor_mdl']);
	}

	public function index()
	{
		$this->dashboard();
	}

	public function dashboard()
	{
		$id = $this->session->userdata('vendor_id');
		$data['name'] = $this->vendor_mdl->getFullNameById($id);
		$data['lastLoggedOn'] = $this->vendor_mdl->getLastLoggedById($this->table,$id);
		$this->load->view('vendor/dashboard',$data);
	}

	public function logout()
	{
		$setLoggedIn = array('isonline' => 0);
		$this->db->where('person_id', $this->session->userdata('vendor_id'));
		$this->db->update($this->table, $setLoggedIn);		
		$this->session->unset_userdata(['vendor_login', 'vendor_id']);
		$this->session->set_flashdata('msgs', 'You are logged out');
		redirect('login', 'refresh');
	}



}
