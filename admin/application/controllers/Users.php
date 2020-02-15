<?php
class Users extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Users_model");
		
		//adicione os campos da busca
		$camposFiltros["u.id"] = "Id";
		$camposFiltros["u.usuario"] = "Usuário";
		$camposFiltros["u.senha"] = "Senha";
		$camposFiltros["u.email"] = "Email";
		$camposFiltros["u.cidades_id"] = "cidades_id";
		$camposFiltros["u.estados_id"] = "estados_id";

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
		$countUsers = $this->db
							->select("count(u.id) AS quantidade")
							->from("users AS u")
							->join("cidades AS c", "c.id = u.cidades_id", "left")
							->join("estados AS e", "e.id = u.estados_id", "left")
							->get()->row();
		$quantidadeUsers = $countUsers->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultUsers = $this->db
							->select("u.id, u.usuario, u.email, c.nome AS cidade, e.sigla")
							->from("users AS u")
							->join("cidades AS c", "c.id = u.cidades_id", "left")
							->join("estados AS e", "e.id = u.estados_id", "left")
							->limit($perPage,$offset)
							->get();

		$this->data['listaUsers'] = $resultUsers->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("users/index")."?";
		$config['total_rows'] = $quantidadeUsers;
		$config['per_page'] = $perPage;
		
		$this->pagination->initialize($config);
		
		$this->data['paginacao'] = $this->pagination->create_links(); 
	}
    
    public function listaCidades() {
    	$this->data['item'] = new stdClass();
    	$estados_id = $this->input->post("estados_id");
		
    	$result['listaCidades'] = $this->Users_model->listaCidadesPorEstados($estados_id);
    	
		header('Content-Type: application/json', true);
		echo json_encode($result);
    	exit;
    }

    function criar(){
		$this->data['item'] = new stdClass();
		
		$result = array();
		$result['cidade'] = false;
		
		//Campos relacionados
		//caso seja necessario adicione os relacionamento aqui
		$estados = $this->Users_model->listaEstados();
		$this->data['listaEstados'] = array();
		$this->data['listaEstados'][''] = 'Selecione um Estado';
		foreach ($estados as $estado) {
			$this->data['listaEstados'][$estado->id] = $estado->nome;
		}
			$this->data['listaCidades'] = array();
			$this->data['listaCidades'][''] = "Selecione uma Cidade";
		//fim Campos relacionados
		
		if($this->input->post('enviar')){
			//Imagem do Usuário
			if($_FILES['imagem']['name']){
					//Upload e Configurações do Envio das imagens
					$config['upload_path'] = './public/uploads/usuarios/';
					$config['allowed_types'] = 'jpg|png';
					$config['max_size']     = '10000';

		            $this->load->library('upload', $config);
		            
		            if(!$this->upload->do_upload('imagem')){
		               	$this->data['msg_error'] = $this->upload->display_errors();
		            } else {           	
		            	$this->data['arquivo_data']  = $this->upload->data();
	            	}
            } else {

            }
			
			if( $this->form_validation->run('Users') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				//Preenche objeto com as informações do formulário		
				$user	= array();
				$user['usuario'] 		= strtolower($this->input->post("usuario",TRUE));
				$user['email'] 		    = $this->input->post('email', TRUE);
				$user['estados_id'] 	= $this->input->post('estados', TRUE);
				$user['cidades_id'] 	= $this->input->post('cidades', TRUE);
				if($this->input->post("senha")) {
					$user['senha'] 		= $this->encrypt->encode($this->input->post("senha",TRUE));
				}

				if(@$this->data['arquivo_data']['raw_name']) {
					$user["imagem"] = $this->data['arquivo_data']['raw_name'].$this->data['arquivo_data']['file_ext'];
				}
				else {
					$user["imagem"] = $this->input->post("imagem") ? $this->input->post("imagem") : NULL;
				}

				$this->db->insert("users", $user);
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('users/index');
			}
		} 
    	
    }
    
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$user = $this->db
						->from("users AS m")
						->where("id", $id)->get()->row();
		
		$estados = $this->Users_model->listaEstados();
		$this->data['listaEstados'] = array();
		$this->data['listaEstados'][''] = 'Selecione um Estado';
		foreach ($estados as $estado) {
			$this->data['listaEstados'][$estado->id] = $estado->nome;
		}

		$cidades = $this->Users_model->listaCidadesPorEstados($user->estados_id);
		$this->data['listaCidades'] = array();
		$this->data['listaCidades'][''] = "Selecione uma Cidade";
		foreach ($cidades as $cidade) {
			$this->data['listaCidades'][$cidade->id] = $cidade->nome;
		}

		if(!$user){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('users/index');
		} else {
			$this->data['item'] = $user;
			if( $this->input->post('enviar') ){

				//Imagem do Usuário
				if($_FILES['imagem']['name']){
					//Upload e Configurações do Envio das imagens
					$config['upload_path'] = './public/uploads/usuarios/';
					$config['allowed_types'] = 'jpg|png';
					$config['max_size']     = '10000';

		            $this->load->library('upload', $config);
		            

		            if(!$this->upload->do_upload('imagem')){
		               	$this->data['msg_error'] = $this->upload->display_errors();
		            } else {           	
		            	$this->data['arquivo_data']  = $this->upload->data();
	            	}
	            } else {

            	}
            
				if( $this->form_validation->run('Users/editar') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$user	= array();
					$user['usuario']	= $this->input->post('usuario', true);
					if($this->input->post("senha")) {
						$user['senha']	= $this->encrypt->encode($this->input->post("senha",TRUE));
					}
					$user['email']	= $this->input->post('email', true);
					$user['cidades_id']	= $this->input->post('cidades', true);
					$user['estados_id']	= $this->input->post('estados', true);

					if(@$this->data['arquivo_data']['raw_name']) {
						$user["imagem"] = $this->data['arquivo_data']['raw_name'].$this->data['arquivo_data']['file_ext'];
					}
					else {
						$user["imagem"] = $this->input->post("imagem") ? $this->input->post("imagem") : NULL;
					}
					

					$this->db->where("id",$id);
					$this->db->update("users",$user);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$user->id}</b> atualizado!");
					redirect('users/index');
				}
			}
		}
	}
	
	public function delete($id){
		$id = $this->uri->segment(3);
		
		$user = $this->db
						->from("users AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $user;
		
		if( !$user ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('users/index');
		} else {
			$this->data['item'] = $user;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", $user->id);
				$this->db->delete("users");
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('users/index');
			}
		}
	}
}

/* End of file Userses.php */
/* Location: ./system/application/controllers/Userses.php */