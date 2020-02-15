<?php
class Usuariosadicionais_model extends CI_Model{
	public function usuarioExiste($usuario, $id){
		$this->db->select("usuario");
		$this->db->from("usuarios");
		$this->db->where("usuario", $usuario);
		if( $id ){
			$this->db->where("id <>", $id);	
		}
		return $this->db->get()->row();
	}

	public function getUsuario($usuario){
		$this->db->select("*");
		$this->db->from("usuarios");
		$this->db->where("usuario", $usuario);
		return $this->db->get()->row();
	}

	public function getPerfisId($usuarioId){
		$query = "SELECT * FROM usuarios_perfis WHERE usuarios_id = '".$this->db->escape_str($usuarioId)."'";
		$result = $this->db->query($query);
		
		$listaPerfis = array();
		foreach($result->result() as $perfil){
			$listaPerfis[] = $perfil->perfis_id;
		}
		return $listaPerfis;
	}
}
?>