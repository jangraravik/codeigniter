<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Products_ctl extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('products_mdl');
	}

	public function index(){
		$this->all();
	}
	
	public function all()
	{	
		$data['title'] = 'All Products';
		$data['products'] = $this->products_mdl->get_all_products();
		$this->load->view('products', $data);
	}	
}