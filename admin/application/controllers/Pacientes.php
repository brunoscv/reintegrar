<?php
class Pacientes extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Pacientes_model");
		$this->load->model("Planos_model");
		
		//adicione os campos da busca
		//$camposFiltros["p.id"] = "Codigo";
		$camposFiltros["p.nome_pac"] = "Nome";
		// $camposFiltros["p.email_pac"] = "Email";
		// $camposFiltros["p.telefone_pac"] = "Telefone";
		// $camposFiltros["p.status"] = "Status";
		// $camposFiltros["p.createdAt"] = "createdAt";
		// $camposFiltros["p.updatedAt"] = "updatedAt";

		$this->data['campos']    = $camposFiltros;
	}
	
	function index(){
		$perPage = '30';
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
		$countPacientes = $this->db
							->select("count(p.id) AS quantidade")
							->from("pacientes AS p")
							->get()->row();
		$quantidadePacientes = $countPacientes->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultPacientes = $this->db
									->select("*")
									->from("pacientes AS p")
									->order_by("p.id", "desc")
									->limit($perPage,$offset)
									->get();
		$this->data['listaPacientes'] = $resultPacientes->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("pacientes/index")."?";
		$config['total_rows'] = $quantidadePacientes;
		$config['per_page'] = $perPage;
		
		$this->pagination->initialize($config);
		
		$this->data['paginacao'] = $this->pagination->create_links(); 
	}
    
    function criar(){
		$this->data['item'] = new stdClass();
		
		//Campos relacionados
		//caso seja necessario adicione os relacionamento aqui
		$planos = $this->Planos_model->getPlanos();
		$this->data['listaPlanos'] = "Escolha um Plano de Saúde";
		$this->data['listaPlanos'] = array();
		foreach ($planos as $plano) {
			$this->data['listaPlanos'][$plano->id] = $plano->nome_plano;
		}
		//fim Campos relacionados
		
		
		if($this->input->post('enviar')){
			
			if( $this->form_validation->run('Pacientes') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				//Preenche objeto com as informações do formulário
								
				$paciente	= array();
				//$paciente['id'] 		= $this->input->post('id', TRUE);
				$paciente['nome_pac'] 		= $this->input->post('nome_pac', TRUE);
				$paciente['filiacao'] 		= $this->input->post('filiacao', TRUE);
				$paciente['data_nasc'] 		= formatar_data($this->input->post('data_nasc', TRUE));
				$paciente['email_pac'] 		= $this->input->post('email_pac', TRUE);
				$paciente['rg'] 			= $this->input->post('rg', TRUE);
				$paciente['cpf'] 			= $this->input->post('cpf', TRUE);
				$paciente['carteira'] 		= $this->input->post('carteira', TRUE);
				$paciente['telefone_pac'] 	= $this->input->post('telefone_pac', TRUE);
				$paciente['telefone_pac2'] 	= $this->input->post('telefone_pac2', TRUE);
				$paciente['telefone_pac_fixo'] 	= $this->input->post('telefone_pac_fixo', TRUE);
				$paciente['planos_id'] 	= $this->input->post('planos_id', TRUE);
				$paciente['status'] 		= 1;
				$paciente['createdAt'] 		= date("Y-m-d");
				$this->db->insert("pacientes", $paciente);
	
				$this->data['msg_success'] = $this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('pacientes/index');
			}
		} 
    	
    }
    
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$planos = $this->Planos_model->getPlanos();
		$this->data['listaPlanos'] = array();
		foreach ($planos as $plano) {
			$this->data['listaPlanos'][$plano->id] = $plano->nome_plano;
		}

		$paciente = $this->db
						->from("pacientes AS m")
						->where("id", $id)->get()->row();

		if(!$paciente){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('pacientes/index');
		} else {
			$this->data['item'] = $paciente;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('Pacientes') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$paciente	= array();
					// $paciente['id']	= $this->input->post('id', true);
					$paciente['nome_pac'] 		= $this->input->post('nome_pac', TRUE);
					$paciente['filiacao'] 		= $this->input->post('filiacao', TRUE);
					$paciente['data_nasc'] 		= formatar_data($this->input->post('data_nasc', TRUE));
					$paciente['email_pac'] 		= $this->input->post('email_pac', TRUE);
					$paciente['rg'] 			= $this->input->post('rg', TRUE);
					$paciente['cpf'] 			= $this->input->post('cpf', TRUE);
					$paciente['carteira'] 		= $this->input->post('carteira', TRUE);
					$paciente['telefone_pac'] 	= $this->input->post('telefone_pac', TRUE);
					$paciente['telefone_pac2'] 	= $this->input->post('telefone_pac2', TRUE);
					$paciente['telefone_pac_fixo'] 	= $this->input->post('telefone_pac_fixo', TRUE);
					$paciente['planos_id'] 	= $this->input->post('planos_id', TRUE);
					$paciente['status'] 		= 1;
					$paciente['updatedAt']		= date("Y-m-d");

					$this->db->where("id",$id);
					$this->db->update("pacientes",$paciente);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$paciente->id}</b> atualizado!");
					redirect('pacientes/index');
				}
			}
		}
	}

	public function ver(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$paciente = array();
		$paciente = $this->db
						->select("p.nome_pac, p.filiacao, p.data_nasc, p.email_pac, p.telefone_pac, p.telefone_pac2, p.telefone_pac_fixo, pl.nome_plano")
						->from("pacientes AS p")
						->join("planos as pl", "p.planos_id = pl.id")
						->where("p.id", $id)->get()->row();

		if(!$paciente){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('pacientes/index');
		} else {
			$this->data['paciente'] = $paciente;
		}
	}
	
	public function delete($id){
		$id = $this->uri->segment(3);
		
		$paciente = $this->db
						->from("pacientes AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $paciente;
		
		if( !$paciente ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('pacientes/index');
		} else {
			$this->data['item'] = $paciente;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", $paciente->id);
				$this->db->delete("pacientes");
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('pacientesindex');
			}
		}
	}
}

/* End of file Pacienteses.php */
/* Location: ./system/application/controllers/Pacienteses.php */