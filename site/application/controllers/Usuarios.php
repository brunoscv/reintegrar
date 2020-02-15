<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends MY_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->_auth();
		
		$this->data['campos'] = array(
			'u.nome' => 'Nome',
			'u.email' => 'E-mail'
		);
		
	}
	
	public function usuarioExiste(){
		header('Content-Type: application/json');
		
		$this->load->model("Usuarios_model");
		$result['data'] = ($this->Usuarios_model->usuarioExiste($this->input->get("usuario"),  $this->input->get('id'))) ? false : true;						
		echo json_encode($result['data']);	
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
		if( !hasPerfil(1) ){
			$this->db->where("id >",1);
		}
		$countUsuarios = $this->db
							->select("count(u.id) AS quantidade")
							->from("usuarios AS u")
							->get()->row();
		
		$quantidadeUsuarios = $countUsuarios->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		if( !hasPerfil(1) ){
			$this->db->where("id >",1);
		}
		$resultUsuarios = $this->db
									->select("*")
									->from("usuarios AS u")
									->limit($perPage,$offset)
									->get();
		
		$this->data['listaUsuarios'] = $resultUsuarios->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("usuarios/index")."?";
		$config['total_rows'] = $quantidadeUsuarios;
		$config['per_page'] = $perPage;
		
		$this->pagination->initialize($config);
		
		$this->data['paginacao'] = $this->pagination->create_links(); 
	}
	
	public function criar(){
		$this->load->model("Perfis_model");
		
		$this->data['item'] = (object) array();
		$this->data['item']->perfis = array();
		$this->data['listaPerfis'] = $this->Perfis_model->listaPerfis();
		
		if( $this->input->post("enviar") ){
			if( $this->form_validation->run('Usuarios') === FALSE ){
				$this->data['msg_error'] = validation_errors("<p>","</p>");
			} else {
				$usuario = array();
				$usuario['usuario'] = strtolower($this->input->post("usuario",TRUE));
				$usuario['nome'] 	= $this->input->post("nome",TRUE);
				$usuario['email'] 	= $this->input->post("email",TRUE);
				$usuario['senha'] 	= $this->encrypt->encode($this->input->post("senha",TRUE));
				$usuario['createdAt'] 	= date("Y-m-d H:i:s");
				
				$this->db->insert("usuarios", $usuario);
				if( $this->input->post("perfis") ){
					$usuario['id'] = $this->db->insert_id(); //pega o ultimo id inserido no BD
					
					$perfis = $this->input->post("perfis");
					foreach($perfis as $perfil){
						$usuario_perfil = array();
						$usuario_perfil['usuarios_id']  = $usuario['id'];
						$usuario_perfil['perfis_id'] = $perfil; 
						$this->db->insert("usuarios_perfis", $usuario_perfil);
					}

				}
				
				$this->session->set_flashdata("msg_success", "Usuário adicionado com sucesso!");
				redirect('usuarios/index');
			}
		}
	
	}
	
	public function editar(){
		$this->load->model("Perfis_model");
		$this->load->model("Usuarios_model");
		
		$id = $this->uri->segment(3);
		if( !hasPerfil(1) ){
			$this->db->where("id > ",1);
		}
		
		$usuario = $this->db
						->from("usuarios AS m")
						->where("id", $id)->get()->row();
		if( !$usuario ){
			$this->session->set_flashdata("msg_error", "Usuário não encontrado!");
			redirect('usuarios/index');
		} else {
			$this->data['item'] = &$usuario;
			$this->data['item']->perfis = $this->Usuarios_model->getPerfisId($usuario->id);
			$this->data['listaPerfis'] = $this->Perfis_model->listaPerfis();
			
			if( $this->input->post("enviar") ){
				if( $this->form_validation->run('Usuarios') === FALSE ){
					$this->data['msg_error'] = validation_errors();
				} else {
					$usuario = array();
					$usuario['id'] 		= $id; 
					$usuario['usuario'] = strtolower($this->input->post("usuario",TRUE));
					$usuario['nome'] 	= $this->input->post("nome",TRUE);
					$usuario['email'] 	= $this->input->post("email",TRUE);
					$usuario['updatedAt'] 	= date("Y-m-d H:i:s");
					
					if( $this->input->post("senha") ){
						$usuario['senha'] 	= $this->encrypt->encode($this->input->post("senha",TRUE));
					}
					
					$this->db->where("id", $usuario['id']);
					$this->db->update("usuarios", $usuario);
					
					if( $this->input->post("perfis") ){
						$this->db->where("usuarios_id",$usuario["id"]);
						$this->db->delete("usuarios_perfis");
						
						$perfis = $this->input->post("perfis");
						foreach($perfis as $perfil){
							$usuario_perfil = array();
							$usuario_perfil['usuarios_id']  = $usuario['id'];
							$usuario_perfil['perfis_id'] = $perfil; 
							$this->db->insert("usuarios_perfis", $usuario_perfil);
						}

					}
					
					$this->session->set_flashdata("msg_success", "Usuário ".$usuario['usuario']." editado com sucesso!");
					redirect('usuarios/index');
				}
			}
		}
	}

	public function delete(){
		$id = $this->uri->segment(3);
		
		$usuario = $this->db
						->from("usuarios")
						->where("id", $id)->get()->row();
		if( !$usuario ){
			$this->session->set_flashdata("msg_error", "Usuário não encontrado!");
			redirect('usuarios/index');
		} else {
			$this->data['item'] = &$usuario;
			if( $this->input->post("enviar") ){
					
				$this->db->where("id", $usuario->id);
				$this->db->delete("usuarios");
				$this->session->set_flashdata("msg_success", "Usuário adicionado com sucesso!");
				redirect('usuarios/index');
			}
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */