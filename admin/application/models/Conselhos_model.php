<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Conselhos_model extends CI_Model {
	
	public $table = "conselhos";

	public function __construct() {
		parent::__construct();
	}
	public function getConselhos() {
		return $this->db->query(" SELECT * 
		                          FROM conselhos ")
						->result();
	}
}