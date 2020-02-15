<?php
class Perfis_model extends CI_Model{
		
	//encontra a lista de menus pelo id do perfil
	public function getMenusId($perfilId){
		
		$query = "SELECT * FROM perfis_menus WHERE perfis_id = '".$this->db->escape_str($perfilId)."'";
		$result = $this->db->query($query);
		
		$listaMenus = array();
		foreach($result->result() as $menu){
			$listaMenus[] = $menu->menus_id;
		}
		return $listaMenus;
	}
	
	public function listaPerfis(){
		$q = "";
		if( !hasPerfil(1) ){
			$q = "WHERE id <> 1";
		}
		$query = "SELECT * FROM perfis $q ORDER BY descricao ASC";
		return $this->db->query($query)->result();
	}
	
}