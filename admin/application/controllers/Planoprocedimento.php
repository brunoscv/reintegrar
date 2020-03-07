<?php
class PlanoProcedimento extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("PlanoProcedimento_model");
		$this->load->model("Especialidades_model");
		$this->load->model("Planos_model");
		
		//adicione os campos da busca
		$camposFiltros["p.id"] = "Codigo";
		$camposFiltros["p.valor"] = "Valor";
		$camposFiltros["p.status"] = "Status";
		$camposFiltros["p.planos_id"] = "Planos";
		$camposFiltros["p.especialidades_id"] = "Especialidades";
		$camposFiltros["p.createdAt"] = "createdAt";
		$camposFiltros["p.updatedAt"] = "updatedAt";

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
		$countPlanoProcedimento = $this->db
							->select("count(p.id) AS quantidade")
							->from("plano_procedimento AS p")
							->join("planos as pl", "p.planos_id = pl.id")
							->join("especialidades as e", "p.especialidades_id = e.id")
							->get()->row();
		$quantidadePlanoProcedimento = $countPlanoProcedimento->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultPlanoProcedimento = $this->db
									->select("p.id, p.valor, p.status, pl.nome_plano, e.nome_espec, p.createdAt")
									->from("plano_procedimento AS p")
									->join("planos as pl", "p.planos_id = pl.id")
									->join("especialidades as e", "p.especialidades_id = e.id")
									->order_by("p.id", "desc")
									->limit($perPage,$offset)
									->get();
		
		$this->data['listaPlanoProcedimento'] = $resultPlanoProcedimento->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("planoprocedimento/index")."?";
		$config['total_rows'] = $quantidadePlanoProcedimento;
		$config['per_page'] = $perPage;
		
		$this->pagination->initialize($config);
		
		$this->data['paginacao'] = $this->pagination->create_links(); 
	}
    
    function criar(){
		$this->data['item'] = new stdClass();
		
		//Campos relacionados
		//caso seja necessario adicione os relacionamento aqui
		$planos = $this->Planos_model->getPlanos();
		$this->data['listaPlanos'] = array();
		foreach ($planos as $plano) {
			$this->data['listaPlanos'][$plano->id] = $plano->nome_plano;
		}

		$especialidades = $this->Especialidades_model->getEspecialidades();
		$this->data['listaEspecialidades'] = array();
		foreach ($especialidades as $especialidade) {
			$this->data['listaEspecialidades'][$especialidade->id] = $especialidade->nome_espec;
		}
		//fim Campos relacionados
		
		
		if($this->input->post('enviar')){
			
			if( $this->form_validation->run('PlanoProcedimento') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				//Preenche objeto com as informações do formulário
								
				$planoprocedimento	= array();
				// $planoprocedimento['id'] 			= $this->input->post('id', TRUE);
				$planoprocedimento['valor'] 			= formatar_moeda($this->input->post('valor', TRUE));
				$planoprocedimento['status'] 			= 1;
				$planoprocedimento['planos_id'] 		= $this->input->post('planos_id', TRUE);
				$planoprocedimento['especialidades_id'] = $this->input->post('especialidades_id', TRUE);
				$planoprocedimento['createdAt'] 		= date("Y-m-d");
				$this->db->insert("plano_procedimento", $planoprocedimento);
	
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('planoprocedimento/index');
			}
		} 
    	
    }
    
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$planoprocedimento = $this->db
						->from("plano_procedimento AS m")
						->where("id", $id)->get()->row();

		//Campos relacionados
		//caso seja necessario adicione os relacionamento aqui
		$planos = $this->Planos_model->getPlanos();
		$this->data['listaPlanos'] = array();
		foreach ($planos as $plano) {
			$this->data['listaPlanos'][$plano->id] = $plano->nome_plano;
		}

		$especialidades = $this->Especialidades_model->getEspecialidades();
		$this->data['listaEspecialidades'] = array();
		foreach ($especialidades as $especialidade) {
			$this->data['listaEspecialidades'][$especialidade->id] = $especialidade->nome_espec;
		}
		//fim Campos relacionados

		if(!$planoprocedimento){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('planoprocedimento/index');
		} else {
			$this->data['item'] = $planoprocedimento;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('PlanoProcedimento') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$planoprocedimento	= array();
					$planoprocedimento['id']				= $this->input->post('id', true);
					$planoprocedimento['valor']				= formatar_moeda($this->input->post('valor', true));
					$planoprocedimento['status']			= 1;
					$planoprocedimento['planos_id']			= $this->input->post('planos_id', true);
					$planoprocedimento['especialidades_id']	= $this->input->post('especialidades_id', true);
					$planoprocedimento['updatedAt']			= date("Y-m-d");

					$this->db->where("id",$id);
					$this->db->update("plano_procedimento",$planoprocedimento);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$planoprocedimento->id}</b> atualizado!");
					redirect('planoprocedimento/index');
				}
			}
		}
	}
	
	public function delete($id){
		$id = $this->uri->segment(3);
		
		$planoprocedimento = $this->db
						->from("plano_procedimento AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $planoprocedimento;
		
		if( !$planoprocedimento ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('planoprocedimento/index');
		} else {
			$this->data['item'] = $planoprocedimento;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", $planoprocedimento->id);
				$this->db->delete("plano_procedimento");
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('planoprocedimento/index');
			}
		}
	}
}

/* End of file Plano_procedimentos.php */
/* Location: ./system/application/controllers/Plano_procedimentos.php */