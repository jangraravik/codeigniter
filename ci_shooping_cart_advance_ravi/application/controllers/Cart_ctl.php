<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cart_ctl extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('products_mdl');
	}

	public function index()
	{
		$this->show();
	}

	public function show()
	{	
		$data['title'] = 'Shopping Cart';
		if (!$this->cart->contents()){
			$data['message'] = '<p>Your cart is empty!</p>';
		} else {
			$data['message'] = $this->session->flashdata('message');
		}
		$this->load->view('cart', $data);
	}

	public function add()
	{
		$dataProduct = $this->products_mdl->get_product_info($this->input->post('id'));
		$add_item = array(
			'id' => $dataProduct['id'],
			'name' => $dataProduct['name'],
			'price' => $this->input->post('price'),
			'qty' => $this->input->post('qty')
		);
		
		if(isset($_POST['options'])) {
			$add_item['options'] = $_POST['options'];		
		}
		$this->cart->insert($add_item);
	redirect('cart');
	}

	function update(){
		$cart_info =  $this->input->post('cart');
		foreach( $cart_info as $id => $cart){
			$data = array(
						'rowid' => $cart['rowid'],
						'qty' => $cart['qty']
						);
		$this->cart->update($data);
		}
	redirect('cart');
	}

	function remove($rowid) {
		if ($rowid === "all"){
			$this->cart->destroy();
		} else {
			$data = array(
						'rowid' => $rowid,
						'qty' => 0
						);
			$this->cart->update($data);
		}
	redirect('cart');
	}


}