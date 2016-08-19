<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Order_ctl extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('order_mdl');
	}

	public function index()
	{	
		$data['title'] = 'Billing';
		$this->load->view('order', $data);
	}
	
	public function save_customer_order()
	{
		$customer = array(
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'address' => $this->input->post('address'),
						'phone' => $this->input->post('phone')
						);
		
		$newCustId = $this->order_mdl->add_customer($customer);
		$custId = array(
						'customer_id' => $newCustId,
						'order_total' => $this->cart->total()
						);
		
		$newOdrId = $this->order_mdl->add_customer_order($custId);
		if ($cart = $this->cart->contents()){
			foreach ($cart as $item){
				$ordered_item_detail= array(
									'customer_order_id' => $newOdrId,
									'product_id' => $item['id'],
									'quantity' => $item['qty'],
									'price' => $item['price']
				);
			$this->order_mdl->add_customer_order_details($ordered_item_detail);
			}
		}
		echo "<p>Thank You '".$customer['name']."'<br>your order has been placed!</p>";
		echo "<a href=".base_url('products').">Go back</a>";
	}
}