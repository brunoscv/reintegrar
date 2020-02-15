<?php

class Estados_model extends CI_Model
{
	public $table = "estados";

	public function __construct()
	{
		parent::__construct();
	}

	public function getEstados() {
		return $this->db->query(" SELECT * 
		                          FROM estados ")
						->result();
	}
	
}
