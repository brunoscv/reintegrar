<?php

/**
 * Conta
 * 
 * This class has been auto-generated by the Code Igniter Generator Framework
 * 
 */
class DiasSemana_model extends CI_Model
{
	public $table = "dias_semana";

	public function __construct()
	{
		parent::__construct();
	}

	public function getDiaSemana() {
		return $this->db->query(" SELECT * 
								  FROM dias_semana")
						->result();
	}
	
}
