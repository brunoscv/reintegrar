<?php

class Calendarios_model extends CI_Model
{
	public $table = "";

	public function __construct()
	{
		parent::__construct();
	}

	public function getHorarios() {
		return $this->db->query(" SELECT * 
								  FROM horarios
								  ORDER BY desc_horario ASC")
						->result();
	}
	
}
