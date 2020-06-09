<?php

class Painel_model extends CI_Model
{
	public $table = "painel";

	public function __construct()
	{
		parent::__construct();
	}

	public function get_atendimentos() {
		return $this->db->query(" SELECT * 
								  FROM atendimentos")
						->result();
	}
	
}
