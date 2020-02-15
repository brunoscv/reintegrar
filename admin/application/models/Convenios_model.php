<?php
class Convenios_model extends CI_Model{
	
	public $table = "convenios";

	public function __construct() {
		parent::__construct();
	}

	public function getConvenios() {
		return $this->db->query(" SELECT *
								  FROM convenios")
						->result();
	}
	
}