<?php
class Especialidades_model extends CI_Model{
	
	public $table = "especialidades";

	public function __construct() {
		parent::__construct();
	}
	
	public function getEspecialidades() {
		return $this->db->query(" SELECT * 
		                          FROM especialidades ")
						->result();
	}
}