<?php

class Person_mdl extends MY_Model
{
	private $table = 'persons';
	
	/* Determines whether the given person exists */
	public function does_person_exists($person_id){
		$this->db->from($this->table);	
		$this->db->where($this->table.".id",$person_id);
		$query = $this->db->get();
	return ($query->num_rows()==1);
	}

	/* Inserts or updates a person if does not exist */
	public function save_person(&$person_data,$person_id=false) {		
		if (!$person_id or !$this->does_person_exists($person_id)) {
			if ($this->db->insert('persons',$person_data)){
				$person_data['person_id']=$this->db->insert_id();
			return true;
			}
		return false;
		}
		$this->db->where('id', $person_id);
	return $this->db->update($this->table,$person_data);
	}

	public function getFullNameById($id){
		$this->db->select("CONCAT(first_name, ' ', last_name) AS full_name");
		$this->db->from($this->table);
		$this->db->where('id', $id);
		$result = $this->db->get();
		$data = $result->row_array();
		return $data['full_name'];
	}

	public function getLastLoggedById($tbl,$id){
		$this->db->select("last_logged_on");
		$this->db->from($tbl);
		$this->db->where('person_id', $id);
		$result = $this->db->get();
		$data = $result->row_array();
		return $data['last_logged_on'];
	}	
}