<?php
class Menus_model extends CI_Model{
	
	public function getMenusRecursivo(){
		$listaMenus = $this->db->query("SELECT id, menus_id, descricao FROM menus ORDER BY descricao ASC")->result();
		return $this->_arranjaMenu($listaMenus);
	}
	
	public function getMenusByPerfis($perfisId){
		if( count($perfisId) == 0 ){
			return FALSE;
		}
		
		$this->db->select("m.*")
				->from("menus AS m")
				->join("perfis_menus AS pm","pm.menus_id = m.id","inner")
				->group_by("m.id")
				->order_by("m.descricao");
		
		foreach($perfisId as $perfil){
			$this->db->or_where('pm.perfis_id = ',$perfil);
		}
		return $listaMenus = $this->db->get()->result();
	}
	
	public function _arranjaMenu($menus, $menuPai = FALSE){
		$ordenada = array();
		if( is_array($menus) ){
			foreach( $menus as $i => $current ){
				if( $menuPai == FALSE && empty($current->menus_id) ){
					unset($menus[$i]);
					$current->filhos = $this->_arranjaMenu($menus, $current->id);
					$ordenada[] = $current;
				} else{
					if( $current->menus_id == $menuPai ){
						unset($menus[$i]);
						$current->filhos = $this->_arranjaMenu($menus, $current->id);
						$ordenada[] = $current;
					}
				}
			}
			return $ordenada;
		}
		return FALSE;
	}
	
}