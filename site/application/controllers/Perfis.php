<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perfis extends MY_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->_auth();
		
		$this->data['campos'] = array(
			'p.nome' => 'Descrição',
		);
		
	}
	
	public function index(){
		$perPage = '10';
		$offset = ($this->input->get("per_page")) ? $this->input->get("per_page") : "0";
		
		$countPerfis = $this->db
							->select("count(id) AS quantidade")
							->from("perfis")
							->get()->row();
		
		$quantidadePerfis = $countPerfis->quantidade;
		
		$resultPerfis = $this->db
							->select("*")
							->from("perfis")
							->limit($perPage,$offset)
							->get();
		
		$this->data['listaPerfis'] = $resultPerfis->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("perfis/index")."?";
		$config['total_rows'] = $quantidadePerfis;
		$config['per_page'] = $perPage;
		
		$this->pagination->initialize($config);
		
		$this->data['paginacao'] = $this->pagination->create_links(); 
	}
	
	public function criar(){
		$this->data['item'] = (object) array();
		$this->data['item']->menus = array();
		
		$this->load->model("Menus_model");
		$this->data['listaMenus'] = $this->Menus_model->getMenusRecursivo();
		
		if( $this->input->post("enviar") ){
			if( $this->form_validation->run('Perfis') === FALSE ){
				$this->data['msg_error'] = validation_errors("<p>","</p>");
			} else {
				$perfil = array();
				$perfil['descricao'] 	= $this->input->post("descricao",TRUE);
				$perfil['createdAt'] 	= date("Y-m-d H:i:s");
				
				$this->db->insert("perfis", $perfil);
				if( $this->input->post("menus") ){
					$perfil['id'] = $this->db->insert_id(); //pega o ultimo id inserido no BD
					$menus = $this->input->post("menus");
					foreach($menus as $menu){
						$perfil_menu = array();
						$perfil_menu['menus_id']  = $menu;
						$perfil_menu['perfis_id'] = $perfil['id']; 
						$this->db->insert("perfis_menus", $perfil_menu);
					}
				}
				
				$this->session->set_flashdata("msg_success", "Usuário adicionado com sucesso!");
				redirect('perfis/index');
			}
		}
	
	}
	
	public function editar(){
		$id = $this->uri->segment(3);
		
		$perfil = $this->db
						->from("perfis AS m")
						->where("id", $id)->get()->row();
		if( !$perfil ){
			$this->session->set_flashdata("msg_error", "Perfil não encontrado!");
			redirect('usuarios/index');
		} else {
			$this->load->model("Perfis_model");
			$this->load->model("Menus_model");
			
			$this->data['listaMenus'] = $this->Menus_model->getMenusRecursivo();
			$perfil->menus = $this->Perfis_model->getMenusId($perfil->id);
			
			$this->data['item'] = &$perfil;
			if( $this->input->post("enviar") ){
				if( $this->form_validation->run('Perfis') === FALSE ){
					$this->data['msg_error'] = validation_errors();
				} else {
					$perfil = array();
					$perfil['id'] 			= $id;
					$perfil['descricao'] 	= $this->input->post("descricao",TRUE);
					$perfil['updatedAt'] 	= date("Y-m-d H:i:s");
					
					$this->db->where("id", $perfil['id']);
					$this->db->update("perfis", $perfil);
					
					if( $this->input->post("menus") ){
						$menus = $this->input->post("menus");
						
						$this->db->where("perfis_id", $perfil['id']);
						$this->db->delete("perfis_menus");
						foreach($menus as $menu){
							$perfil_menu = array();
							$perfil_menu['menus_id']  = $menu;
							$perfil_menu['perfis_id'] = $perfil['id']; 
							$this->db->insert("perfis_menus", $perfil_menu);
						}
					}
					
					$this->session->set_flashdata("msg_success", "Perfil {$perfil[descricao]} editado com sucesso!");
					redirect('perfis/index');
				}
			}
		}
	}

	public function delete(){
		$id = $this->uri->segment(3);

		$perfil = $this->db
						->from("perfis")
						->where("id", $id)->get()->row();
		if( !$perfil ){
			$this->session->set_flashdata("msg_success", "Perfil não encontrado!");
			redirect('usuarios/index');
		} else {
			$this->data['item'] = $perfil;
			if( $this->input->post("enviar") ){
				
				$this->db->where("perfis_id", $perfil->id);
				$this->db->delete("perfis_menus");					
				
				$this->db->where("id", $perfil->id);
				$this->db->delete("perfis");
				
				$this->session->set_flashdata("msg_success", "Perfil removido com sucesso!");
				redirect('perfis/index');
			}
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */