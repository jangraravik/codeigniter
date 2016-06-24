<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function index()
	{
		$this->load->view('product_list');
	}	
	public function productload(){	
		//echo "search more";
		$offset = is_numeric($_POST['offset']) ? $_POST['offset'] : die();
		$postnumbers = is_numeric($_POST['number']) ? $_POST['number'] : die();
		$this->db->select('*');
		$this->db->from('users');
		$this->db->limit($postnumbers,$offset);
		$query = $this->db->get();	
		$data = $query->result_array();
		foreach($data as $row){
			$content = substr(strip_tags($row['bio']), 0, 500);
			echo '<h1><a href="'.$row['id'].'">'.$row['firstname'].'</a></h1><hr />';
			echo '<p>'.$content.'...</p><hr />';			
		}
	}
}
