<?php
class Audition{
	public function __construct(){
		return;
	}

	public function initialize(){

	}

	public function audit($sql){
		$CI =& get_instance();
		$rs = $CI->db->simple_query("SELECT 1");

		if( preg_match("/^(INSERT|DELETE|UPDATE)/", trim($sql)) ){
			$usuario_id = $CI->data['userdata']['id'];
			$sql = $CI->db->escape($sql);
			$url = $CI->db->escape(current_url());
			$datetime = date("Y-m-d H:i:s");
			$CI->db->simple_query("INSERT INTO audit (usuario_id, query, url, createdAt) VALUES ('1', $sql, $url, '$datetime' );");
		}
	}
}
?>