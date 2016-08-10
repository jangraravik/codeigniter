<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	public function __construct(){

		parent:: __construct();
	}

	public function index()
	{
		//$this->tracking->on();
		$this->tracking->log('User on Home page');
		echo "Home Page";
	}

	public function about()
	{
		$this->tracking->log('User on about page');
		echo "About Page";
	}

	public function services()
	{
		$this->tracking->on('User on services page');
		echo "Services Page";
	}	

	public function support()
	{
		$this->tracking->on('User on support page');
		echo "Suppport Page";
	}	

	public function contact()
	{
		$this->tracking->on('User on contact page');
		echo "Contact Page";
	}

	public function login(){
		$this->session->set_userdata('user_id',123456);
		$this->tracking->on('User logged in');
		echo "User Logged In: ".$this->session->userdata('user_id');
	}
	public function logout(){
		$this->tracking->on('User logged out');
		$this->session->unset_userdata('user_id');
		echo "User Logged Out";
	}
}