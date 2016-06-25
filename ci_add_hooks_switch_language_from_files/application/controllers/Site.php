<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->output->enable_profiler(TRUE);
	}

	public function index()
	{
		$this->home();
	}

	public function home()
	{
		$this->load->view('home');
	}

	public function about()
	{
		$this->load->view('about');
	}

	public function services()
	{
		$this->load->view('services');
	}

	public function contact()
	{
		$this->load->view('contact');
	}
}
