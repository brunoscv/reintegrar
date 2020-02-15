<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pacientes extends MY_Controller {

	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Pacientes_model");
		$this->load->model("Convenios_model");

		//adicione os campos da busca
		$camposFiltros["id"] = "Id";
		$camposFiltros["nome_pac"] = "Nome Paciente";
		$this->data['campos']    = $camposFiltros;
	}
	
	public function index(){
		$perPage = '25';
		$offset = ($this->input->get("per_page")) ? $this->input->get("per_page") : "0";
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', TRUE);
			$valor = $this->input->get('filtro_valor', TRUE);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->from("pacientes")->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$countPacientes = $this->db
							->select("count(p.id) AS quantidade")
							->from("pacientes AS p")
							->join("convenios as c", "p.convenios_id = c.id")
							->get()->row();
		$quantidadePacientes = $countPacientes->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', TRUE);
			$valor = $this->input->get('filtro_valor', TRUE);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->from("pacientes")->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		$resultPacientes = $this->db
								->select("p.*, c.nome_convenio")
								->from("pacientes AS p")
								->join("convenios as c", "p.convenios_id = c.id")
								->order_by("p.nome_pac", "ASC")
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
		$convenios = $this->Convenios_model->getConvenios();
		$this->data['listaConvenios'] = array();
		$this->data['listaConvenios'][''] = "Escolha um Convenio";
		foreach ($convenios as $convenio) {
			$this->data['listaConvenios'][$convenio->id] = $convenio->nome_convenio;
		}
		$status = $this->Pacientes_model->getStatus();
		$this->data['listaStatus'] = array();
		foreach ($status as $s) {
			$this->data['listaStatus'][$s->valor] = $s->descricao;
		}
		//fim Campos relacionados
		
		if($this->input->post('enviar')){
			
			if( $this->form_validation->run('Pacientes') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				//Preenche objeto com as informações do formulário			
				$paciente	= array();
				// $paciente['id'] 		= $this->input->post('id', TRUE);
				$paciente['nome_pac'] 				= $this->input->post('nome_pac', TRUE);
				$paciente['telefone_pac'] 			= $this->input->post('telefone_pac', TRUE);
				$paciente['telefonedois_pac'] 		= $this->input->post('telefonedois_pac', TRUE);
				$paciente['carteira_pac'] 			= $this->input->post('carteira_pac', TRUE);
				$paciente['convenios_id'] 			= $this->input->post('convenios_id', TRUE);	
				$paciente['data_nasc'] 				= formatar_data($this->input->post('data_nasc', TRUE));
				$paciente['nome_responsavel'] 		= $this->input->post('nome_responsavel', TRUE);
				$paciente['cep_pac'] 				= $this->input->post('cep_pac', TRUE);
				$paciente['endereco_pac'] 			= $this->input->post('endereco_pac', TRUE);
				$paciente['numero_pac'] 			= $this->input->post('numero_pac', TRUE);
				$paciente['bairro_pac'] 			= $this->input->post('bairro_pac', TRUE);
				$paciente['complemento_pac'] 		= $this->input->post('complemento_pac', TRUE);
				$paciente['cidade_pac'] 			= $this->input->post('cidade_pac', TRUE);
				$paciente['uf_pac'] 				= $this->input->post('uf_pac', TRUE);
				$paciente['status'] 				= $this->input->post('status', TRUE);
				$paciente['createdAt'] 				= date("Y-m-d");
				$this->db->insert("pacientes", $paciente);
	
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('pacientes/index');
			}
		} 	
  }
	
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$paciente = $this->db
						->from("pacientes AS p")
						->where("id", $id)->get()->row();
						
		//Campos relacionados
		//caso seja necessario adicione os relacionamento aqui
		$convenios = $this->Convenios_model->getConvenios();
		$this->data['listaConvenios'] = array();
		foreach ($convenios as $convenio) {
			$this->data['listaConvenios'][$convenio->id] = $convenio->nome_convenio;
		}
		$status = $this->Pacientes_model->getStatus();
		$this->data['listaStatus'] = array();
		foreach ($status as $s) {
			$this->data['listaStatus'][$s->valor] = $s->descricao;
		}
		//fim Campos relacionados

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
					// $paciente['id']							= $this->input->post('id', true);
					$paciente['nome_pac'] 			= $this->input->post('nome_pac', TRUE);
					$paciente['telefone_pac'] 		= $this->input->post('telefone_pac', TRUE);
					$paciente['carteira_pac'] 		= $this->input->post('carteira_pac', TRUE);
					$paciente['telefonedois_pac'] 	= $this->input->post('telefonedois_pac', TRUE);
					$paciente['convenios_id'] 		= $this->input->post('convenios_id', TRUE);	
					$paciente['data_nasc'] 			= formatar_data($this->input->post('data_nasc', TRUE));
					$paciente['nome_responsavel'] 	= $this->input->post('nome_responsavel', TRUE);
					$paciente['cep_pac'] 			= $this->input->post('cep_pac', TRUE);
					$paciente['endereco_pac'] 		= $this->input->post('endereco_pac', TRUE);
					$paciente['numero_pac'] 		= $this->input->post('numero_pac', TRUE);
					$paciente['bairro_pac'] 		= $this->input->post('bairro_pac', TRUE);
					$paciente['complemento_pac'] 	= $this->input->post('complemento_pac', TRUE);
					$paciente['cidade_pac'] 		= $this->input->post('cidade_pac', TRUE);
					$paciente['uf_pac'] 			= $this->input->post('uf_pac', TRUE);
					$paciente['status'] 			= $this->input->post('status', TRUE);
					$paciente['updatedAt']			= date("Y-m-d");

					$this->db->where("id", $id);
					$this->db->update("pacientes", $paciente);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$id}</b> atualizado!");
					redirect('pacientes/index');
				}
			}
		}
	}

	public function delete(){
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
				$this->data['msg_success'] = $this->session->set_flashdata("msg_success", "Registro deletado com sucesso!");
				redirect('pacientes/index');
			}
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */