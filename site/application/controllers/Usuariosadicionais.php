<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuariosadicionais extends MY_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->_auth();
		
		$this->data['campos'] = array(
			'u.nome' => 'Nome',
			'u.email' => 'E-mail'
		);

		$this->clientes_id = (@$this->data['userdata']['clientes_id']) ? @$this->data['userdata']['clientes_id'] : $this->input->get("clientes_id");
		
		$this->data['clienteAtual'] = $this->db->select("id, nome_empresa")
			->from("clientes")
			->where("id", $this->clientes_id)
			->get()->row();
		
		if( !$this->data['clienteAtual'] ){
			redirect("/");
		} else {
			$clienteId = @$this->data['userdata']['clientes_id'];
			if( !empty($clientes_id) && $$this->data['clienteAtual']->id <> $this->clientes_id ){
				$this->session->set_flashdata("msg_error", "Você não ter permissão para editar estes usuários!");
				redirect("/");
			}
		}
		//verifica se o cliente existe, em caso negativo, faz um redirect;
	}
	
	public function usuarioExiste(){
		header('Content-Type: application/json');
		
		$this->load->model("Usuariosadicionais_model");
		$result['data'] = ($this->Usuariosadicionais_model->usuarioExiste($this->input->get("usuario"),  $this->input->get('id'))) ? false : true;						
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
		$countUsuarios = $this->db
							->select("count(u.id) AS quantidade")
							->from("usuarios AS u")
							->where("clientes_id IS NOT NULL")
							->where("principal", FALSE)
							->where("clientes_id", $this->clientes_id)
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
		
		$resultUsuarios = $this->db
			->select("*")
			->from("usuarios AS u")
			->where("clientes_id IS NOT NULL")
			->where("principal", FALSE)
			->where("clientes_id", $this->clientes_id)
			->limit($perPage,$offset)
			->get();
		
		$this->data['listaUsuarios'] = $resultUsuarios->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("usuariosadicionais/index")."?clientes_id=".$this->clientes_id."&";
		$config['total_rows'] = $quantidadeUsuarios;
		$config['per_page'] = $perPage;
		
		$this->pagination->initialize($config);
		
		$this->data['paginacao'] = $this->pagination->create_links(); 
	}
	
	public function criar(){

		$this->data['item'] = (object) array();
		$this->data['item']->perfis = array();

		$this->load->model("Clientes_model");
		$this->data['listaClientes'] = resultToOptions($this->Clientes_model->listaTodos(),"id","nome_empresa");
		
		if( $this->input->post("enviar") ){
			if( $this->form_validation->run('Usuariosadicionais') === FALSE ){
				$this->data['msg_error'] = validation_errors("<p>","</p>");
			} else {

				$usuario = array();
				$usuario['usuario'] = strtolower($this->input->post("usuario",TRUE));
				$usuario['nome'] 	= $this->input->post("nome",TRUE);
				$usuario['email'] 	= $this->input->post("email",TRUE);
				$usuario['senha'] 	= $this->encrypt->encode($this->input->post("senha",TRUE));
				$usuario['createdAt'] 	= date("Y-m-d H:i:s");
				$usuario['clientes_id'] = $this->clientes_id;
				$usuario['principal']	= FALSE;
				
				$this->db->insert("usuarios", $usuario);
				$this->db->insert('usuarios_perfis', array('usuarios_id' => $this->db->insert_id(), 'perfis_id' => 3));
				
				$this->session->set_flashdata("msg_success", "Usuário adicionado com sucesso!");
				
				redirect('usuariosadicionais/index/?clientes_id='.$this->clientes_id);
			}
		}
	
	}
	
	public function editar(){
		$this->load->model("Usuariosadicionais_model");

		$this->load->model("Clientes_model");
		$this->data['listaClientes'] = resultToOptions($this->Clientes_model->listaTodos(),"id","nome_responsavel");
		
		$id = $this->uri->segment(3);
		
		$usuario = $this->db
			->from("usuarios")
			->where("clientes_id IS NOT NULL")
			->where("clientes_id", $this->clientes_id)
			->where("principal", FALSE)
			->where("id", $id)->get()->row();

		if( !$usuario ){
			$this->session->set_flashdata("msg_error", "Usuário não encontrado!");
			redirect('usuariosadicionais/index/?clientes_id='.$this->clientes_id);

		} else {
			$this->data['item'] = &$usuario;
			
			if( $this->input->post("enviar") ){
				if( $this->form_validation->run('Usuariosadicionais') === FALSE ){
					$this->data['msg_error'] = validation_errors();
				} else {

					$usuario = array();
					$usuario['usuario'] = strtolower($this->input->post("usuario",TRUE));
					$usuario['nome'] 	= $this->input->post("nome",TRUE);
					$usuario['email'] 	= $this->input->post("email",TRUE);
					$usuario['senha'] 	= $this->encrypt->encode($this->input->post("senha",TRUE));
					$usuario['createdAt'] 	= date("Y-m-d H:i:s");
					$usuario['clientes_id'] = $this->clientes_id;

					$this->db->where("id", $id);
					$this->db->update("usuarios", $usuario);
					
					$this->session->set_flashdata("msg_success", "Usuário ".$usuario['usuario']." editado com sucesso!");
					redirect('usuariosadicionais/index/?clientes_id='.$this->clientes_id);
				}
			}
		}

		

	}

	public function delete(){
		$id = $this->uri->segment(3);
		
		$usuario = $this->db
			->from("usuarios")
			->where("clientes_id IS NOT NULL")
			->where("id", $id)
			->where("principal", FALSE)
			->where("clientes_id", $this->clientes_id)
			->get()->row();
		if( !$usuario ){
			$this->session->set_flashdata("msg_error", "Usuário não encontrado!");
			redirect('usuariosadicionais/index/?clientes_id='.$this->clientes_id);
		} else {
			$this->data['item'] = &$usuario;
			if( $this->input->post("enviar") ){
					
				$this->db->where("id", $usuario->id)
							->where("clientes_id", $this->clientes_id);
				$this->db->delete("usuarios");
				$this->session->set_flashdata("msg_success", "Usuário adicionado com sucesso!");
				redirect('usuariosadicionais/index/?clientes_id='.$this->clientes_id);
			}
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */