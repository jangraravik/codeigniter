<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once('interfaces/Profile_interface_ctl.php');
class Administrator_ctl extends MY_Controller implements Profile_interface_ctl
{

	private $table = 'administrators';
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('admin_login') === TRUE){
			redirect('login', 'refresh');
		}
		$this->load->model(['person_mdl','administrator_mdl']);
	}

	public function index()
	{
		$this->dashboard();
	}

	public function dashboard()
	{
		$id = $this->session->userdata('admin_id');
		$data['name'] = $this->administrator_mdl->getFullNameById($id);
		$data['lastLoggedOn'] = $this->administrator_mdl->getLastLoggedById($this->table,$id);
		$this->load->view('administrator/dashboard',$data);
	}

	public function logout()
	{
		$setLoggedIn = array('isonline' => 0);
		$this->db->where('person_id', $this->session->userdata('admin_id'));
		$this->db->update($this->table, $setLoggedIn);		
		$this->session->unset_userdata(['admin_login', 'admin_id']);
		$this->flash->success('Successfully logged out');
		redirect('account/login', 'refresh');
	}	
}