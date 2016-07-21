<?php

class Customer_mdl extends Person_mdl {

	private $table = 'customers';
	/*	Determines if a given person_id is in Customers table*/	
	public function does_customer_exists($person_id)
	{
		$this->db->from($this->table);
		$this->db->join("persons", "persons.id = ".$this->table.".person_id");
		$this->db->where($this->table.".person_id",$person_id);
		$query = $this->db->get();
		return ($query->num_rows()==1);
	}

	function save_customer(&$person_data, &$customer_data,$customer_id=false)
	{		
		$success = FALSE;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		if(parent::save_person($person_data,$customer_id)){
			if (!$customer_id or !$this->does_person_exists($customer_id)){
				$customer_data['person_id'] = $customer_id = $person_data['person_id'];
				$this->db->insert($this->table,$customer_data);
			} else {
				$this->db->where('person_id', $customer_id);
				$this->db->update($this->table,$customer_data);
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