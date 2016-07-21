<?php

class Administrator_mdl extends Person_mdl {

	private $table = 'administrators';
	/*	Determines if a given person_id is in administrators table*/	
	public function does_admin_exists($person_id)
	{
		$this->db->from($this->table);	
		$this->db->join("persons", "persons.id = ".$this->table.".person_id");
		$this->db->where($this->table.".person_id",$person_id);
		$query = $this->db->get();
		return ($query->num_rows()==1);
	}

	
}