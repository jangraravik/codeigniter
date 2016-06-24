<?php

class User_mdl extends CI_Model {

	function insert($dataUser = array()) {
		$this->db->insert('users', $dataUser);
	}
	function cleanTable()
	{
		$this->db->truncate('users');
	}
	function getAllUser()
	{
		$query = $this->db->get('users');
		return $query->result();
	}
}