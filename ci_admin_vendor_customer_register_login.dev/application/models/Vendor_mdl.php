<?php

class Vendor_mdl extends Person_mdl {

	private $table = 'vendors';
	/*	Determines if a given person_id is in Vendors table*/	
	public function does_vendor_exists($person_id)
	{
		$this->db->from($this->table);
		$this->db->join("persons", "persons.id = ".$this->table.".person_id");
		$this->db->where($this->table.".person_id",$person_id);
		$query = $this->db->get();
		return ($query->num_rows()==1);
	}

	public function save_vendor(&$person_data, &$vendor_data,$vendor_id=false)
	{		
		$success = FALSE;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		if(parent::save_person($person_data,$vendor_id)){
			if (!$vendor_id or !$this->does_person_exists($vendor_id)){
				$vendor_data['person_id'] = $vendor_id = $person_data['person_id'];
				$this->db->insert($this->table,$vendor_data);
			} else {
				$this->db->where('person_id', $vendor_id);
				$this->db->update($this->table,$vendor_data);
			}
		}
		$this->db->trans_complete();		
		if ($this->db->trans_status() === FALSE){
			$success = FALSE;
		} else {
			$success = TRUE;
		}
	return $success;
	}

}