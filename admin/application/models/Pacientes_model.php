<?php
class Pacientes_model extends CI_Model{
	
	public $table = "pacientes";

	public function __construct() {
		parent::__construct();
	}
	
	public function getPacientes() {
		return $this->db->query(" SELECT * FROM pacientes ")
						->result();
	}

	public function getStatus() {
		return $this->db->query(" SELECT * FROM status ")
						->result();
	}
}