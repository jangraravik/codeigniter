<?php

class Persons_mdl extends CI_Model
{
	private $table = 'persons';

	/* Inserts or updates a person if does not exist */
	public function save_person($person_data) {		
		$this->db->insert($this->table,$person_data);
		$person_data['newid'] = $this->db->insert_id();
		return $person_data['newid'];
	}
}