<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Products_mdl extends CI_Model {

	public function get_all_products()
	{
		$query = $this->db->get_where('products',array('is_online'=>1));
		return $query->result_array();
	}

	public function get_product_info($id){
		$result = $this->db->get_where('products',array('id'=>$id))->row_array();
		return $result;
	}

	public function get_product_options($id){
		$results = $this->db->get_where('product_options',array('product_id'=>$id))->result_array();
		return $results;
	}

	public function get_product_colors($id){
		$results = $this->db->get_where('product_colors',array('product_id'=>$id))->result_array();
		return $results;
	}	

	public function get_color_name_by_id($id){
		$result = $this->db->get_where('product_option_color',array('id'=>$id))->row_array();
		return $result['color'];
	}

	public function get_product_sizes($id){
		$results = $this->db->get_where('product_sizes',array('product_id'=>$id))->result_array();
		return $results;
	}

	public function get_size_name_by_id($id){
		$result = $this->db->get_where('product_option_size',array('id'=>$id))->row_array();
		return $result['size'];
	}	
}
