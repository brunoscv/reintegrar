<?php
class Permissoes extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Permissoes_model");
		$this->load->model("Usuarios_model");
		
		//adicione os campos da busca
		$camposFiltros["p.id"] = "id";
		$camposFiltros["p.metodos_id"] = "metodos_id";
		$camposFiltros["p.usuarios_id"] = "usuarios_id";

		$this->data['campos']    = $camposFiltros;
	}
	
	function index(){
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
		$countPermissoes = $this->db
							->select("count(p.id) AS quantidade")
							->from("permissoes AS p")
							->get()->row();
		$quantidadePermissoes = $countPermissoes->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultPermissoes = $this->db
									->select("p.id, p.metodos_id, m.classe, m.metodo, p.usuarios_id, u.nome")
									->from("permissoes AS p")
									->join("metodos AS m", "m.id = p.metodos_id", "inner")
									->join("usuarios AS u", "u.id = p.usuarios_id", "inner")
									->limit($perPage,$offset)
									->get();
		$this->data['listaPermissoes'] = $resultPermissoes->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("permissoes/index")."?";
		$config['total_rows'] = $quantidadePermissoes;
		$config['per_page'] = $perPage;
		
		$this->pagination->initialize($config);
		
		$this->data['paginacao'] = $this->pagination->create_links(); 
	}
    
    function criar(){
		$this->data['item'] = new stdClass();
		
		//Campos relacionados
		$usuarios = $this->Permissoes_model->getUsuarios();
		$this->data['listaUsuarios'] = array();
		$this->data['listaUsuarios'][''] = "Selecione um Usuário";
		foreach ($usuarios as $usuario) {
			$this->data['listaUsuarios'][$usuario->id] = $usuario->nome;
		}

		$classes = $this->Permissoes_model->getClasse();
		$this->data['listaClasses'] = array();
		$this->data['listaClasses'][''] = "Selecione um Controller";
		foreach ($classes as $classe) {
			$this->data['listaClasses'][$classe->id] = ucfirst($classe->classe) . " - " . ucfirst($classe->metodo);
		}
		//caso seja necessario adicione os relacionamento aqui
		//fim Campos relacionados
		
		if($this->input->post('enviar')){
			
			if( $this->form_validation->run('Permissoes') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				//Preenche objeto com as informações do formulário						
				$permissoe	= array();
				//$permissoe['id'] 		= $this->input->post('id', TRUE);
				$permissoe['metodos_id'] 		= $this->input->post('metodos_id', TRUE);
				$permissoe['usuarios_id'] 		= $this->input->post('usuarios_id', TRUE);
				$this->db->insert("permissoes", $permissoe);
	
				$this->data['msg_success'] = $this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('permissoes/index');
			}
		} 
    	
    }
    
	// public function editar(){
	// 	//carregue os MODELs necessários aqui
	// 	$id = $this->uri->segment(3);

	// 	$usuario = $this->db
	// 					->from("usuarios AS m")
	// 					->where("id", $id)->get()->row();

	// 	if(!$usuario){
	// 		$this->data['msg_error'] = $this->session->set_flashdata("msg_error", "Usuário não encontrado!");
	// 		redirect('usuarios/index');
	// 	} else {
			
	// 		$this->data['listClasses'] = $this->Permissoes_model->getClasses();
	// 		$permissoe = array();
	// 		$permissoe = $this->db
	// 					->from("permissoes AS m")
	// 					->where("usuarios_id", $id)->get()->row();
	// 		$permissoe->classe = $this->Permissoes_model->getClassesId($permissoe->usuarios_id);
			
	// 		$this->data['item'] = &$permissoe;
	// 		$this->data['usuario'] = $usuario;
	// 		if( $this->input->post('enviar') ){
	// 			if( $this->form_validation->run('Perfis') === FALSE ){
	// 				$this->data['msg_error'] = validation_errors();
	// 			} else {
	// 				if( $this->input->post("classes") ){
	// 					$classes = $this->input->post("classes");
						
	// 					$this->db->where("usuarios_id", $id);
	// 					$this->db->delete("permissoe");
	// 					foreach($classes as $classe){
	// 						$permissoe_usuario = array();
	// 						$permissoe_usuario['metodos_id']  = $classe;
	// 						$permissoe_usuario['usuarios_id'] = $id; 
	// 						$this->db->insert("permissoes", $permissoe_usuario);
	// 					}
	// 				}
					
	// 				$this->data['msg_success'] = $this->session->set_flashdata("msg_success", "permissoe {$permissoe[usuarios_id]} editado com sucesso!");
	// 				redirect('perfis/index');
	// 			}
	// 		}
	// 	}
	// }
	
	public function editar() {
		redirect('permissoes/index');
	}
	public function delete($id){
		$id = $this->uri->segment(3);
		
		$permissoe = $this->db
						->from("permissoes AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $permissoe;
		
		if( !$permissoe ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('permissoes/index');
		} else {
			$this->data['item'] = $permissoe;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", $permissoe->id);
				$this->db->delete("permissoes");
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('permissoes/index');
			}
		}
	}
}

/* End of file Permissoeses.php */
/* Location: ./system/application/controllers/Permissoeses.php */