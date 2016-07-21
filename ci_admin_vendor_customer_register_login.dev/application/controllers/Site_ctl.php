<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_ctl extends MY_Controller {
	
	public function __construct(){
		parent:: __construct();
		$this->output->enable_profiler(FALSE);
		$this->load->model('site_mdl');
	}
	
	public function index(){
		$this->home();
	}

	public function register(){
		redirect('account/register');
	}	

	public function login(){
		redirect('account/login');
	}

	public function logout(){
		redirect('account/logout');
	}		
	
	public function home(){
		$this->load->view('site/home');	
	}
	
	public function switch_lang($setMyLang = "") {
		$setMyLang = ($setMyLang != "") ? $setMyLang : "english";
		$this->session->set_userdata('site_lang', $setMyLang);
		redirect($_SERVER['HTTP_REFERER']);
	}	
	
	public function show_404(){
		$this->output->set_status_header('404');
		$this->load->view('404');
	}	

}