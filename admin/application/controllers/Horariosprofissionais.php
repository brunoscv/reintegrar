<?php
class HorariosProfissionais extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("HorariosProfissionais_model");
		$this->load->model("Profissionais_model");
		$this->load->model("Horarios_model");
		$this->load->model("DiasSemana_model");
		
		//adicione os campos da busca
		// $camposFiltros["h.id"] = "id";
		// $camposFiltros["h.status"] = "status";
		// $camposFiltros["h.createdAt"] = "createdAt";
		// $camposFiltros["h.updatedAt"] = "updatedAt";
		// $camposFiltros["h.horarios_id"] = "horarios_id";
		// $camposFiltros["h.dias_semana_id"] = "dias_semana_id";
		// $camposFiltros["h.profissionais_id"] = "profissionais_id";
		 $camposFiltros["p.nome_prof"] = "Profissional";

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
		$countHorariosProfissionais = $this->db
							->select("count(h.id) AS quantidade")
							->from("horarios_profissionais AS h")
							->join("horarios as hr", "h.horarios_id = hr.id")
							->join("dias_semana as ds", "h.dias_semana_id = ds.id")
							->join("profissionais as p", "h.profissionais_id = p.id")
							->get()->row();
		$quantidadeHorariosProfissionais = $countHorariosProfissionais->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultHorariosProfissionais = $this->db
									->select("h.id, h.status, h.createdAt, hr.desc_horario, ds.desc_dia_semana, p.nome_prof")
									->from("horarios_profissionais AS h")
									->join("horarios as hr", "h.horarios_id = hr.id")
									->join("dias_semana as ds", "h.dias_semana_id = ds.id")
									->join("profissionais as p", "h.profissionais_id = p.id")
									->order_by("h.id", "desc")
									->limit($perPage,$offset)
									->get();
		
		$this->data['listaHorariosProfissionais'] = $resultHorariosProfissionais->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("horarios_profissionais/index")."?";
		$config['total_rows'] = $quantidadeHorariosProfissionais;
		$config['per_page'] = $perPage;
		
		$this->pagination->initialize($config);
		
		$this->data['paginacao'] = $this->pagination->create_links(); 
	}
    
    function criar(){
		$this->data['item'] = new stdClass();
		
		//Campos relacionados
		//caso seja necessario adicione os relacionamento aqui
		$horarios = $this->Horarios_model->getHorarios();
		$this->data['listaHorarios'] = array();
		$this->data['listaHorarios'][''] = "Selecione um Horário";
		foreach ($horarios as $horario) {
			$this->data['listaHorarios'][$horario->id] = $horario->desc_horario;
		}
		$diasSemana = $this->DiasSemana_model->getDiaSemana();
		$this->data['listaDias'] = array();
		$this->data['listaDias'][''] = "Selecione um Dia da Semana";
		foreach ($diasSemana as $dia) {
			$this->data['listaDias'][$dia->id] = $dia->desc_dia_semana;
		}
		$profissionais = $this->Profissionais_model->getProfissionais();
		$this->data['listaProfissionais'] = array();
		$this->data['listaProfissionais'][''] = "Selecione um Profissional";
		foreach ($profissionais as $profissional) {
			$this->data['listaProfissionais'][$profissional->id] = $profissional->nome_prof;
		}
		//fim Campos relacionados
		
		
		if($this->input->post('enviar')){
			
			if( $this->form_validation->run('HorariosProfissionais') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				//Preenche objeto com as informações do formulário
								
				$horarioProfissionai	= array();
				// $horarioProfissionai['id'] 		= $this->input->post('id', TRUE);
				$status 		  = $this->input->post('status', TRUE);
				$createdAt 		  = $this->input->post('createdAt', TRUE);
				$updatedAt 		  = $this->input->post('updatedAt', TRUE);
				$horarios_id 	  = $this->input->post('horarios_id', TRUE);
				$dias_semana_id   = $this->input->post('dias_semana_id', TRUE);
				$profissionais_id = $this->input->post('profissionais_id', TRUE);
				
				
				foreach ($horarios_id as $key => $horario) {
					
					$horarioProfissionai['status'] 			 = 1;
					$horarioProfissionai['createdAt'] 		 = date("Y-m-d");
					$horarioProfissionai['horarios_id'] 	 = $horario;
					$horarioProfissionai['dias_semana_id'] 	 = $dias_semana_id;
					$horarioProfissionai['profissionais_id'] = $profissionais_id;

					$this->db->insert("horarios_profissionais", $horarioProfissionai);

				}
	
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('horariosprofissionais/index');
			}
		} 
    	
    }

     public function gerarHorariosPorProfissional($profissional_id, $horario_id, $dia_semana_id) {
		// $consulta_id = $this->uri->segment(3);
		$dia_vencimento = date("d");
		$data_atual = date('Y-m-d');

		$mensalidade = $this->db
						->from("periodo_consulta AS c")
						->where("consultas_id", $consulta_id)
						->get()->result();
		
		foreach ($mensalidade as $key => $mensalidade) {
							
				foreach ($dia_semana_id as $key => $dia) {
					
					$frequencia['horarios_id'] 			= $horario_id;
					$frequencia['dia_semana_id'] 		= $dia;
					$frequencia['status'] 				= 1;
					$frequencia['periodo_consulta_id'] 	= $mensalidade->id;
					$frequencia['consultas_id'] 		= $consulta_id;
					$frequencia['createdAt'] 			= date("Y-m-d");

					$this->db->insert("item_consulta", $frequencia);

				}
		}
		
		return $frequencia;
    }

    public function horarios_profissionais() {
		$profissionais_id = $this->uri->segment(3);

		//Pega os horarios dos profissionais que estão cadastrados na tabela de horarios
		$resultHorariosProfissionais = array();
		$resultHorariosProfissionais = $this->HorariosProfissionais_model->getHorariosProfissional($profissionais_id);

		$rs = array();
		$result = array();
		foreach ($resultHorariosProfissionais as $key => $result) {
			$rs[$result->nome_prof][$result->desc_dia_semana][] = $result;
		}

		$this->data['listaHorarios'] = $rs;
	}
    
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$horarioProfissionai = $this->db
						->from("horarios_profissionais AS m")
						->where("id", $id)->get()->row();

		//Campos relacionados
		//caso seja necessario adicione os relacionamento aqui
		$horarios = $this->Horarios_model->getHorarios();
		$this->data['listaHorarios'] = array();
		$this->data['listaHorarios'][''] = "Selecione um Horário";
		foreach ($horarios as $horario) {
			$this->data['listaHorarios'][$horario->id] = $horario->desc_horario;
		}
		$diasSemana = $this->DiasSemana_model->getDiaSemana();
		$this->data['listaDias'] = array();
		$this->data['listaDias'][''] = "Selecione um Dia da Semana";
		foreach ($diasSemana as $dia) {
			$this->data['listaDias'][$dia->id] = $dia->desc_dia_semana;
		}
		$profissionais = $this->Profissionais_model->getProfissionais();
		$this->data['listaProfissionais'] = array();
		$this->data['listaProfissionais'][''] = "Selecione um Profissional";
		foreach ($profissionais as $profissional) {
			$this->data['listaProfissionais'][$profissional->id] = $profissional->nome_prof;
		}
		//fim Campos relacionados

		if(!$horarioProfissionai){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('horariosprofissionais/index');
		} else {
			$this->data['item'] = $horarioProfissionai;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('HorariosProfissionais') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$horarioProfissionai	= array();
					$status 		  = $this->input->post('status', TRUE);
					$createdAt 		  = $this->input->post('createdAt', TRUE);
					$updatedAt 		  = $this->input->post('updatedAt', TRUE);
					$horarios_id 	  = $this->input->post('horarios_id', TRUE);
					$dias_semana_id   = $this->input->post('dias_semana_id', TRUE);
					$profissionais_id = $this->input->post('profissionais_id', TRUE);

						foreach ($horarios_id as $key => $horario) {
					
							$horarioProfissionai['status'] 			 = 1;
							$horarioProfissionai['updatedAt'] 		 = date("Y-m-d");
							$horarioProfissionai['horarios_id'] 	 = $horario;
							$horarioProfissionai['dias_semana_id'] 	 = $dias_semana_id;
							$horarioProfissionai['profissionais_id'] = $profissionais_id;

							$this->db->where("id",$id);
							$this->db->update("horarios_profissionais",$horarioProfissionai);
						}

				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$horarioProfissionai->id}</b> atualizado!");
					redirect('horariosprofissionais/index');
				}
			}
		}
	}
	
	public function delete($id){
		$id = $this->uri->segment(3);
		
		$horarioProfissionai = $this->db
						->from("horarios_profissionais AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $horarioProfissionai;
		
		if( !$horarioProfissionai ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('horariosprofissionais/index');
		} else {
			$this->data['item'] = $horarioProfissionai;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", $horarioProfissionai->id);
				$this->db->delete("horarios_profissionais");
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('horariosprofissionaisindex');
			}
		}
	}
}

/* End of file Horarios_profissionaises.php */
/* Location: ./system/application/controllers/Horarios_profissionaises.php */