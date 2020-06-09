<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menus extends MY_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->_auth();
		
		$this->data['campos'] = array(
			'm.descricao' => 'Descrição',
			'm.url' => 'Url'
		);
		
	}
	
	public function index(){
		$perPage = '10';
		$offset = ($this->input->get("per_page")) ? $this->input->get("per_page") : "0";
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		$countMenus = $this->db
							->select("count(id) AS quantidade")
							->from("menus m")
							->get()->row();
		
		$quantidadeMenus = $countMenus->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		$resultMenus = $this->db
									->select("m.*, menupai.descricao as pai")
									->from("menus m")
									->join("menus AS menupai","menupai.id = m.menus_id","left")
									->limit($perPage,$offset)
									->get();
		
		$this->data['listaMenus'] = $resultMenus->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("menus/index")."?";
		$config['total_rows'] = $quantidadeMenus;
		$config['per_page'] = $perPage;
		
		$this->pagination->initialize($config);
		
		$this->data['paginacao'] = $this->pagination->create_links(); 
	}
	
	public function criar(){
		$this->data['item'] = (object) array();
		if( $this->input->post("enviar") ){
			if( $this->form_validation->run('Menus') === FALSE ){
				$this->data['msg_error'] = validation_errors("<p>","</p>");
			} else {
				$menu = array();
				if( $this->input->post("menus_id") )
					$menu['menus_id'] = strtolower($this->input->post("menus_id",TRUE));
					
				$menu['descricao'] 	= $this->input->post("descricao",TRUE);
				$menu['url'] 		= $this->input->post("url",TRUE);
				$menu['icone'] 		= $this->input->post("icone",TRUE);
				$menu['createdAt'] 	= date("Y-m-d H:i:s");
				
				$this->db->insert("menus", $menu);
				
				$this->session->set_flashdata("msg_success", "Menu adicionado com sucesso!");
				redirect('menus/index');
			}
		}
	
	}
	
	public function editar(){
		$id = $this->uri->segment(3);
		
		$menu = $this->db
						->select("m.*, menupai.descricao AS pai")
						->from("menus AS m")
						->join("menus AS menupai","menupai.id = m.menus_id","left")
						->where("m.id", $id)->get()->row();
		if( !$menu ){
			$this->session->set_flashdata("msg_error", "Menu não encontrado!");
			redirect('menus/index');
		} else {
			$this->data['item'] = &$menu;
			if( $this->input->post("enviar") ){
				if( $this->form_validation->run('Menus') === FALSE ){
					$this->data['msg_error'] = validation_errors();
				} else {
					$menu = array();
					$menu['id'] 		= $id; 
					if( $this->input->post("menus_id") )
						$menu['menus_id'] = strtolower($this->input->post("menus_id",TRUE));
						
					$menu['descricao'] 	= $this->input->post("descricao",TRUE);
					$menu['url'] 		= $this->input->post("url",TRUE);
					$menu['icone'] 		= $this->input->post("icone",TRUE);
					$menu['updatedAt'] 	= date("Y-m-d H:i:s");
					
					$this->db->where("id", $menu['id']);
					$this->db->update("menus", $menu);
					$this->session->set_flashdata("msg_success", "Menu {$menu[descricao]} editado com sucesso!");
					redirect('menus/index');
				}
			}
		}
	}

	public function delete(){
		$id = $this->uri->segment(3);
		
		$menu = $this->db
						->select("m.*, menupai.descricao AS pai")
						->from("menus AS m")
						->join("menus AS menupai","menupai.id = m.menus_id","left")
						->where("m.id", $id)->get()->row();
		if( !$menu ){
			$this->session->set_flashdata("msg_error", "Menu não encontrado!");
			redirect('usuarios/index');
		} else {
			$this->data['item'] = &$menu;
			if( $this->input->post("submit") ){
					
				$this->db->where("id", $menu->id);
				$this->db->delete("menus");
				$this->session->set_flashdata("msg_success", "Menu excluído com sucesso!");
				redirect('menus/index');
			}
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */