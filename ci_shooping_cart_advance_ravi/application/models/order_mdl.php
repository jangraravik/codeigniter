<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Order_mdl extends CI_Model {

	public function add_customer($data)
	{
		$this->db->insert('customers', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;		
	}
	
	public function add_customer_order($data)
	{
		$this->db->insert('customer_orders', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
	public function add_customer_order_details($data)
	{
		$this->db->insert('customer_order_details', $data);
	}

}