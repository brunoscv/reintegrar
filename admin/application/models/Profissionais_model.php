<?php
class Profissionais_model extends CI_Model{
	
	public $table = "profissionais";

	public function __construct() {
		parent::__construct();
	}

	public function getProfissionais() {
		return $this->db->query(" SELECT * FROM profissionais ")
						->result();
	}
	
}