<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profissionais extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Conselhos_model");
		$this->load->model("Especialidades_model");
		$this->load->model("Estados_model");
		$this->load->model("Profissionais_model");
		
		//adicione os campos da busca
		$camposFiltros["p.id"] = "Cod.";
		$camposFiltros["p.nome_prof"] = "Nome";

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
		$countProfissionais = $this->db
							->select("count(p.id) AS quantidade")
							->from("profissionais AS p")
							->join("especialidades AS e", "p.especialidades_id = e.id")
							->join("conselhos AS c", "p.conselhos_id = c.id")
							->join("estados AS est", "p.estados_id = est.id")
							->get()->row();
		$quantidadeProfissionais = $countProfissionais->quantidade;
		
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultProfissionais = $this->db
									->select("p.*, e.nome_espec, est.uf, c.nome_conselho")
									->from("profissionais AS p")	
									->join("especialidades AS e", "p.especialidades_id = e.id")
									->join("conselhos AS c", "p.conselhos_id = c.id")
									->join("estados AS est", "p.estados_id = est.id")
									->order_by("p.nome_prof", "ASC")
									->limit($perPage,$offset)
									->get();
		
		$this->data['listaProfissionais'] = $resultProfissionais->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("profissionais/index")."?";
		$config['total_rows'] = $quantidadeProfissionais;
		$config['per_page'] = $perPage;
		
		$this->pagination->initialize($config);
		
		$this->data['paginacao'] = $this->pagination->create_links(); 
	}
    
    function criar(){
		$this->data['item'] = new stdClass();
		
		//Campos relacionados
		//caso seja necessario adicione os relacionamentos aqui
		$conselhos = $this->Conselhos_model->getConselhos();
		$this->data['listaConselhos'] = array();
		$this->data['listaConselhos'][''] = "Selecione um Conselho";
		foreach ($conselhos as $conselho) {
			$this->data['listaConselhos'][$conselho->id] = $conselho->nome_conselho;
		}
		$especialidades = $this->Especialidades_model->getEspecialidades();
		$this->data['listaEspecialidades'] = array();
		$this->data['listaEspecialidades'][''] = "Selecione uma Especialidade";
		foreach ($especialidades as $especialidade) {
			$this->data['listaEspecialidades'][$especialidade->id] = $especialidade->nome_espec;
		}
		$estados = $this->Estados_model->getEstados();
		$this->data['listaEstados'] = array();
		$this->data['listaEstados'][''] = "Selecione o Estado do Conselho";
		foreach ($estados as $estado) {
			$this->data['listaEstados'][$estado->id] = $estado->uf;
		}
		//fim Campos relacionados
			
		if($this->input->post('enviar')){	
			if( $this->form_validation->run('Profissionais') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {		
				//Preenche objeto com as informações do formulário			
				$profissionais	= array();
				$profissionais['nome_prof'] 		= $this->input->post('nome_prof', TRUE);
				$profissionais['telefone_prof'] 	= $this->input->post('telefone_prof', TRUE);
				$profissionais['especialidades_id'] = $this->input->post('especialidades_id', TRUE);
				$profissionais['conselhos_id']		= $this->input->post('conselhos_id', TRUE);
				$profissionais['num_conselho_prof'] = $this->input->post('num_conselho_prof', TRUE);
				$profissionais['estados_id'] 		= $this->input->post('estados_id', TRUE);
				$profissionais['status'] 			= 1;
				$profissionais['createdAt'] 		= date("Y-m-d");
				
				$this->db->insert("profissionais", $profissionais);
				// $profissionais['id'] 				= $this->input->post('id', TRUE);
				// $profissionais['telefone_prof'] 	= $this->input->post('telefone_prof', TRUE);
				// $profissionais['email_prof'] 		= $this->input->post('email_prof', TRUE);
				// $profissionais['carteira_prof'] 	= $this->input->post('carteira_prof', TRUE);
				// $profissionais['rg_prof'] 			= $this->input->post('rg_prof', TRUE);
				// $profissionais['cpf_prof'] 			= $this->input->post('cpf_prof', TRUE);
				
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('profissionais/index');
			}
		} 
    }
    
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$profissionais = $this->db
						->from("profissionais AS m")
						->where("id", $id)->get()->row();
		
		//Campos relacionados
		//caso seja necessario adicione os relacionamentos aqui
		$conselhos = $this->Conselhos_model->getConselhos();
		$this->data['listaConselhos'] = array();
		foreach ($conselhos as $conselho) {
			$this->data['listaConselhos'][$conselho->id] = $conselho->nome_conselho;
		}
		$especialidades = $this->Especialidades_model->getEspecialidades();
		$this->data['listaEspecialidades'] = array();
		foreach ($especialidades as $especialidade) {
			$this->data['listaEspecialidades'][$especialidade->id] = $especialidade->nome_espec;
		}
		$estados = $this->Estados_model->getEstados();
		$this->data['listaEstados'] = array();
		foreach ($estados as $estado) {
			$this->data['listaEstados'][$estado->id] = $estado->uf;
		}
		//fim Campos relacionados

		if(!$profissionais){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('profissionais/index');
		} else {
			$this->data['item'] = $profissionais;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('Profissionais') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$profissionais	= array();
					$profissionais['nome_prof'] 		= $this->input->post('nome_prof', TRUE);
					$profissionais['telefone_prof'] 	= $this->input->post('telefone_prof', TRUE);
					$profissionais['especialidades_id'] = $this->input->post('especialidades_id', TRUE);
					$profissionais['conselhos_id']		= $this->input->post('conselhos_id', TRUE);
					$profissionais['num_conselho_prof'] = $this->input->post('num_conselho_prof', TRUE);
					$profissionais['estados_id'] 		= $this->input->post('estados_id', TRUE);
					$profissionais['status'] 			= 1;
					$profissionais['updatedAt'] 		= date("Y-m-d");

					$this->db->where("id",$id);
					$this->db->update("profissionais",$profissionais);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$id}</b> atualizado!");
					redirect('profissionais/index');
				}
			}
		}
	}
	
	public function delete($id){
		$id = $this->uri->segment(3);
		
		$profissionais = $this->db
						->from("profissionais AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $profissionais;

		//Campos relacionados
		//caso seja necessario adicione os relacionamentos aqui
		$conselhos = $this->Conselhos_model->getConselhos();
		$this->data['listaConselhos'] = array();
		foreach ($conselhos as $conselho) {
			$this->data['listaConselhos'][$conselho->id] = $conselho->nome_conselho;
		}
		$especialidades = $this->Especialidades_model->getEspecialidades();
		$this->data['listaEspecialidades'] = array();
		foreach ($especialidades as $especialidade) {
			$this->data['listaEspecialidades'][$especialidade->id] = $especialidade->nome_espec;
		}
		$estados = $this->Estados_model->getEstados();
		$this->data['listaEstados'] = array();
		foreach ($estados as $estado) {
			$this->data['listaEstados'][$estado->id] = $estado->uf;
		}
		//fim Campos relacionados
		
		if( !$profissionais ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('profissionais/index');
		} else {
			$this->data['item'] = $profissionais;
			if( $this->input->post("enviar") ){
				$this->db->where("id", $profissionais->id);
				$this->db->delete("profissionais");
				
				$this->session->set_flashdata("msg_success", "Registro deletado com sucesso!");
				redirect('profissionais/index');
			}
		}
	}
}

/* End of file Profissionaises.php */
/* Location: ./system/application/controllers/Profissionaises.php */