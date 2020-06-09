
<?php
class Consultas extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Consultas_model");
		$this->load->model("Planoprocedimento_model");
		$this->load->model("Especialidades_model");
		$this->load->model("Pacientes_model");
		$this->load->model("Profissionais_model");
		$this->load->model("Horarios_model");
		$this->load->model("Diassemana_model");
		$this->load->model("Horariosprofissionais_model");
		$this->load->model("Planos_model");
		
		//adicione os campos da busca
		//$camposFiltros["pl.nome_plano"] = "Proc./Plano";
		$camposFiltros["p.nome_pac"] 	= "Paciente";
		$camposFiltros["e.nome_espec"] 	= "Especialidade";
		$camposFiltros["pr.nome_prof"] 	= "Profissional";

		$this->data['campos']    = $camposFiltros;
	}

	public function index(){
		$perPage = '25';
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
		$countConsultas = $this->db
							->select("count(c.id) AS quantidade")
							->from("consultas AS c")
							->join("pacientes AS p", "c.pacientes_id = p.id")
							->join("planos AS pl", "c.planos_id = pl.id")
							->join("especialidades AS e", "c.especialidades_id = e.id")
							->join("profissionais AS pr", "c.profissionais_id = pr.id")
							->where("c.tipo", 1)
							->order_by("c.id", "DESC")
							->get()->row();
		$quantidadeConsultas = $countConsultas->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultConsultas = $this->db
								->select("c.id, c.status, pl.nome_plano, e.nome_espec, p.nome_pac, 
								          pr.nome_prof, c.createdAt")
								->from("consultas AS c")
								->join("pacientes AS p", "c.pacientes_id = p.id")
								->join("planos AS pl", "c.planos_id = pl.id")
								->join("especialidades AS e", "c.especialidades_id = e.id")
								->join("profissionais AS pr", "c.profissionais_id = pr.id")
								->where("c.tipo", 1)
								->order_by("c.id", "DESC")
								->limit($perPage,$offset)
								->get();
		
		$this->data['listaConsultas'] = $resultConsultas->result();

		// arShow($this->data['listaConsultas']);exit;
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("consultas/index")."?";
		$config['total_rows'] = $quantidadeConsultas;
		$config['per_page'] = $perPage;
		
		$this->pagination->initialize($config);
		
		$this->data['paginacao'] = $this->pagination->create_links(); 
	}
    
  	public function criar(){
		$this->data['item'] = new stdClass();

		//Campos relacionados
		//caso seja necessario adicione os relacionamento aqui
		$especialidades = $this->Especialidades_model->getEspecialidades();
		$this->data['listaEspecialidades'] = array();
		$this->data['listaEspecialidades'][''] = "Selecione uma Especialidade";
		foreach ($especialidades as $especialidade) {
			$this->data['listaEspecialidades'][$especialidade->id] = $especialidade->nome_espec;
		}
		$pacientes = $this->Pacientes_model->getPacientes();
		$this->data['listaPacientes'] = array();
		$this->data['listaPacientes'][''] = "Pesquise por um Paciente";
		foreach ($pacientes as $paciente) {
			$this->data['listaPacientes'][$paciente->id] = $paciente->nome_pac;
		}
		$planos = $this->Planos_model->getPlanos();
		$this->data['listaPlanos'] = array();
		$this->data['listaPlanos'][''] = "Selecione um Convênio";
		foreach ($planos as $plano) {
			$this->data['listaPlanos'][$plano->id] = $plano->nome_plano;
		}
		$horarios = $this->Horarios_model->getHorarios();
		$this->data['listaHorarios'] = array();
		$this->data['listaHorarios'][''] = "Selecione um Horário";
		foreach ($horarios as $horario) {
			$this->data['listaHorarios'][$horario->id] = $horario->desc_horario;
		}

		$dias = $this->DiasSemana_model->getDiaSemana();
		$this->data['listaDiaSemana'] = array();
		$this->data['listaDiaSemana'][''] = "Selecione um Dia da Semana";
		foreach ($dias as $dia) {
			$this->data['listaDiaSemana'][$dia->id] = $dia->desc_dia_semana;
		}
		//fim Campos relacionados
		
		if( $this->input->post('enviar') ){
			if( $this->form_validation->run('Consultas') === FALSE ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				$consulta								= array();
			//$consulta['id']							= $this->input->post('id', true);
				$consulta['pacientes_id']				= $this->input->post('pacientes_id', true);
				$consulta['especialidades_id']			= $this->input->post('especialidades_id', true);
				$consulta['profissionais_id']			= $this->input->post('profissionais_id', true);
				$consulta['planos_id']					= $this->input->post('planos_id', true);
				$plano = $this->db
						->select("id")
						->from("plano_procedimento")
						->where(array("especialidades_id" => $consulta['especialidades_id'], 
								"planos_id" => $consulta['planos_id']))
						->get()->result();
				//$consulta['valor'] 									= $plano[0]->id;
				$consulta['plano_procedimento_id'] 		= $plano[0]->id;
				$data_inicio							= formatar_data($this->input->post('data_inicio', true));
				$consulta['data_inicio'] 				= $data_inicio;
				$consulta['data_fim']	 				= NULL;
				$consulta['observacoes']				= $this->input->post('observacoes', true);
				$consulta['tipo'] 						= 1;
				$consulta['status']						= 1;
				$consulta['createdAt']					= date("Y-m-d H:i:s");
				$this->db->insert("consultas",$consulta);
				$consulta_id 												= $this->db->insert_id();

				//criar 24meses de datas já programadas
				$this->gerar_periodo_consultas($consulta_id, $data_inicio);
				//de acordo com os dias da semana escolhidos
				$dias_semana_id							= $this->input->post('dias_semana_id', true);
				$horarios_id							= $this->input->post('horarios_id', true);
				
				// pega os periodos ja salvos no banco
				// depois pra cada periodo pega os inputs de horarios e dia da semana
				// $periodo 								= array();
				// $periodo 								= $this->db->from('periodo_consulta')->where('consultas_id', $consulta_id)->get()->result();
				// foreach ($periodo as $key => $p) {
				// 	if(!empty($dias_semana_id)){
				// 		for($i = 0; $i < count($dias_semana_id); $i++){
				// 			for($j = 0; $j < count($horarios_id); $j++){
				// 				se a possicao do array que indica o dia da semana for igual ao do horario
				// 				entao ele pega as informacoes e salva no banco
				// 				ex: array([dia_semana] => [0]=> 1, [horario]=> [0] => 5)
				// 				salva o dia e horarios com os indices iguais
				// 				if($i == $j){
				// 					$horarios 							= array();
				// 					$horarios['consultas_id'] 			= $consulta_id;
				// 					$horarios['dia_semana_id'] 			= $dias_semana_id[$i];
				// 					$horarios['horarios_id'] 			= $horarios_id[$j];
				// 					$horarios['periodo_consulta_id'] 	= $p->id;
				// 					$horarios['status'] 				= 1;
				// 					$horarios['createdAt'] 				= date("Y-m-d");
									
				// 					//insere aqui
				// 					$this->db->insert("item_consulta",$horarios);
								
				// 				} 
				// 			}
				// 		}	
				// 	}
				// }

				$horarios = array();
				for($i = 0; $i < count($dias_semana_id); $i++){
					if(!empty($dias_semana_id[$i])){
						$horariosConsulta['dia_semana_id'] 	= $dias_semana_id[$i];
						$horariosConsulta['horarios_id'] 	= $horarios_id[$i];
						$horariosConsulta['status'] 		= 1;
						$horariosConsulta['atendimento'] 	= 0;
						$horariosConsulta['consultas_id'] 	= $consulta_id;
						$horariosConsulta['updatedAt'] 		= date("Y-m-d");
						
						$this->db->insert("horarios_consulta",$horariosConsulta);
					} 
				}
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('consultas/index');
			}
		}
  	}
    
	public function editar(){
		$id = $this->uri->segment(3);

		//Campos relacionados
		//caso seja necessario adicione os relacionamento aqui
		$pacientes = $this->Pacientes_model->getPacientes();
		$this->data['listaPacientes'] = array();
		foreach ($pacientes as $paciente) {
			$this->data['listaPacientes'][$paciente->id] = $paciente->nome_pac;
		}
		$especialidades = $this->Especialidades_model->getEspecialidades();
		$this->data['listaEspecialidades'] = array();
		foreach ($especialidades as $especialidade) {
			$this->data['listaEspecialidades'][$especialidade->id] = $especialidade->nome_espec;
		}
		$profissionais = $this->Profissionais_model->getProfissionais();
		$this->data['listaProfissionais'] = array();
		foreach ($profissionais as $profissional) {
			$this->data['listaProfissionais'][$profissional->id] = $profissional->nome_prof;
		}
		$planos = $this->Planos_model->getPlanos();
		$this->data['listaPlanos'] = array();
		foreach ($planos as $plano) {
			$this->data['listaPlanos'][$plano->id] = $plano->nome_plano;
		}
		
		$horarios = $this->Horarios_model->getHorarios();
		$this->data['listaHorarios'] = array();
		foreach ($horarios as $horario) {
			$this->data['listaHorarios'][$horario->id] = $horario->desc_horario;
		}

		$dias = $this->DiasSemana_model->getDiaSemana();
		$this->data['listaDiaSemana'] = array();
		foreach ($dias as $dia) {
			$this->data['listaDiaSemana'][$dia->id] = $dia->desc_dia_semana;
		}
		//fim Campos relacionados

		$consulta = array();
		$consulta = $this->db
						 ->from("consultas AS c")
						 ->where("c.id", $id)
					     ->get()->row();

		$horarios_consulta = array();
		$horarios_consulta = $this->db
						 ->select("hc.id as horario_consulta, hc.dia_semana_id, hc.horarios_id")
						 ->from("horarios_consulta AS hc")
						 ->where(array("hc.consultas_id" => $id, "hc.status" => 1))
						 ->get()->result();
		
		//Para cada horario que tiver salvo no banco
		//criar um campo na view complementando o array de consulta.
		foreach ($horarios_consulta as $key => $value) {
			$consulta->horarios = $horarios_consulta;	
		} 

		//arShow($horarios_consulta); exit;
		//com o indice "horarios" e os valores dos horarios e dia da semana da consulta.

		if(!$consulta){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('consultas/index');
		} else {
			$this->data['item'] = &$consulta;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('Consultas') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$consulta						= array();
					// $consulta['id']				= $this->input->post('id', true);
					$consulta['pacientes_id']		= $this->input->post('pacientes_id', true);
					$consulta['especialidades_id']	= $this->input->post('especialidades_id', true);
					$consulta['profissionais_id']	= $this->input->post('profissionais_id', true);
					$consulta['planos_id']			= $this->input->post('planos_id', true);
					// $valor = $this->db
					// 			  ->select("valor")
					// 			  ->from("plano_procedimento")
					// 			  ->where(array("especialidades_id" => $consulta['especialidades_id'], 
					// 							  "planos_id" => $consulta['planos_id']))
					// 			  ->get()->result();
					// $consulta['valor'] 				= $valor[0]->valor;
					$consulta['observacoes']		= $this->input->post('observacoes', true);
					$consulta['status']				= 1;
					$consulta['updatedAt']			= date("Y-m-d");

					//arShow($consulta); exit;
	
					$this->db->where("id",$id);
					$this->db->update("consultas",$consulta);
	
					$dias_semana_id		= $this->input->post('dias_semana_id', true);
					$horarios_id		= $this->input->post('horarios_id', true);
	
					if(!empty($dias_semana_id)){
						$this->db->where("consultas_id", $id);
						$this->db->delete("horarios_consulta");
						
						$horarios = array();
						for($i = 0; $i < count($dias_semana_id); $i++){
							if(!empty($dias_semana_id[$i])){
								$horarios['dia_semana_id'] 	= $dias_semana_id[$i];
								$horarios['horarios_id'] 	= $horarios_id[$i];
								$horarios['atendimento'] 	= 0;
								$horarios['status'] 		= 1;
								$horarios['consultas_id'] 	= $id;
								$horarios['updatedAt'] 		= date("Y-m-d");
								
								$this->db->insert("horarios_consulta",$horarios);
							} 
						}
					}

					$this->session->set_flashdata("msg_success", "Registro <b># {$consulta->id}</b> atualizado!");
					redirect('consultas/index');
				}
			}
		}
	}
	  
	public function delete($id){
		$id = $this->uri->segment(3);
		
		$consulta = $this->db
						->from("consultas AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $consulta;
		
		if( !$consulta ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('consultas/index');
		} else {
			$this->data['item'] = $consulta;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", $consulta->id);
				$this->db->delete("consultas");
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('consultas/index');
			}
		}
	}
	
	/* Dependent Functions */
	public function pacientes(){
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
			if( $this->form_validation->run('Pacientes') === FALSE ){
				$this->data['msg_error'] = validation_errors("<p>","</p>");
			} else {	
				//Preenche objeto com as informações do formulário				
				//$paciente['id'] 			    = $this->input->post('id', TRUE);
				$paciente	= array();
				$paciente['nome_pac'] 			= $this->input->post('nome_pac', TRUE);
				$paciente['filiacao'] 			= $this->input->post('filiacao', TRUE);
				$paciente['data_nasc'] 			= formatar_data($this->input->post('data_nasc', TRUE));
				$paciente['rg_cpf'] 			= $this->input->post('rg_cpf', TRUE);
				$paciente['email_pac'] 			= $this->input->post('email_pac', TRUE);
				$paciente['telefone_pac'] 		= $this->input->post('telefone_pac', TRUE);
				$paciente['telefone_pac2'] 		= $this->input->post('telefone_pac2', TRUE);
				$paciente['telefone_pac_fixo'] 	= $this->input->post('telefone_pac_fixo', TRUE);
				$paciente['matricula'] 			= $this->input->post('matricula', TRUE);
				$paciente['planos_id'] 			= $this->input->post('planos_id', TRUE);
				$paciente['status'] 			= 1;
				$paciente['createdAt'] 			= date("Y-m-d");
				
				$this->db->insert("pacientes", $paciente);

				$this->data['msg_success'] = $this->session->set_flashdata("msg_success", "Paciente adicionado com sucesso!");
				redirect('consultas/buscar');
			}
		}
  	}

	public function buscar_profissionais() {
    	$especialidades_id = $this->input->post("especialidades_id");
    	
    	$profissionais = $this->Profissionais_model->getProfissionaisPorEspecialidade($especialidades_id);
		
		$option = "";
		foreach ($profissionais as $profissional) {
			//$profissional->id == 4 ? $selected = "selected" : $selected = "";
			// $option .= "<option value='$profissional->id' $selected>$profissional->nome_prof</option>";
			$option .= "<option value='$profissional->id' $selected>$profissional->nome_prof</option>";
    	}
    	echo $option;
	}
	
	public function buscar_planos() {
		$especialidades_id = $this->input->post("especialidades_id");
		
		$planos = $this->Planos_model->getPlanosPorEspecialidade($especialidades_id);
		$option = "<option value='0'>Escolha um Convênio</option>";
			foreach ($planos as $plano) {
				$option .= "<option value='$plano->id'>$plano->nome_plano</option>";
			}
		echo $option;
  	}

	public function buscar_horarios_disponiveis() {
		$profissionais_id	= $this->input->post("profissionais_id");

		$horarios_disponiveis = $this->Consultas_model->get_horarios_profissionais($profissionais_id);
		$result = array();
		if(!$horarios_disponiveis){
			$result['sucesso'] = false;
		} else {
    	$result['sucesso'] = true;
    	$result['horarios_disponiveis'] = $horarios_disponiveis;
    	$this->data['listaHorarios'] 	= $horarios_disponiveis;
    	}

	  	header('Content-Type: application/json');
		echo json_encode($result);
		exit;
	}

  	public function gerar_periodo_consultas($consulta_id, $data_inicio) {
		$dia_vencimento = date("d", strtotime($data_inicio));
		//$data_atual = date('Y-m-d');

		$consulta = $this->db
						->from("consultas AS c")
						->where("id", $consulta_id)
						->get()->result();

		foreach ($consulta as $consulta) {
    		
			$i=0;
			while ($i <= 24 ) {
					$qtd_dias[] = date("t", strtotime("$data_inicio + {$i} month"));

					if ($dia_vencimento <= 28) {
							$ano_mes[] = explode("-", date('Y-m-' . $dia_vencimento, strtotime("{$data_inicio} + {$i} month")));

					} else {
							$data_inicio = date('Y-m-01');
							$data_corrente = date('Y-m-d', strtotime("{$data_inicio} + {$i} month"));
							$num_dias = date('t', strtotime($data_corrente));
							if ($dia_vencimento > $num_dias) {
									$ano_mes[] = explode("-", date('Y-m', strtotime($data_corrente)) . "-" . $num_dias);

							} else {
									$ano_mes[] = explode("-", date('Y-m', strtotime($data_corrente)) . "-" . $dia_vencimento);
							}
					}
			$i++;
			$periodoConsulta['consultas_id'] 					= $consulta->id;
			$periodoConsulta['status'] 		 					= 1;

				foreach ($ano_mes as $key => $dados) {
					$periodoConsulta['data']	    			= "$dados[0]" . "-" . "$dados[1]" . "-" ."$dados[2]";
					$periodoConsulta['dia_vencimento']			= $dados[2];
				}

			$periodoConsulta['createdAt'] 	 				= date("Y-m-d H:i:s");
			$this->db->insert("periodo_consulta", $periodoConsulta);
			}
		}
		return $periodoConsulta;
	}

  	public function gerar_frequencias($consulta_id, $periodo, $horario, $dia_semana) {
		$item							= array();
		$item['consultas_id'] 			= $consulta_id;
		$item['horarios_id'] 			= $horario;
		$item['dia_semana_id'] 			= $dia_semana;
		$item['periodo_consulta_id'] 	= $periodo;
		$item['status'] 				= 1;
		$item['createdAt'] 				= date("Y-m-d");
		$this->db->insert("item_consulta", $item);
  	}

	public function gerar_atendimentos(){}

	public function weeks_in_month($month, $year) {
		// Start of month
		$start = mktime(0, 0, 0, $month, 1, $year);
		// End of month
		$end = mktime(0, 0, 0, $month, date('t', $start), $year);

		// Start week
		$start_week = date('W', $start);
		// End week
		$end_week = date('W', $end);
			if ($end_week < $start_week) { 
				// Month wraps
				return ((52 + $end_week) - $start_week) + 1;
			}
			return ($end_week - $start_week) + 1;
	}

	public function set_horario_consulta_vazio($consultas_id, $dia_semana_id, $horarios_id) {

		$result = array();
		$horarioVazio = array();
		if(!$consultas_id){
			$result['sucesso'] = false;
		} else {
			$horarioVazio['consultas_id'] 	= $consultas_id;
			$horarioVazio['dia_semana_id'] 	= $dia_semana_id;
			$horarioVazio['horarios_id'] 	= $horarios_id;
			$horarioVazio['atendimento'] 	= 0;
			$horarioVazio['status'] 		= 1;
			$horarioVazio['createdAt'] 		= date('Y-m-d');
			
			$this->db->insert("horarios_consulta", $horarioVazio);
			$ultimo_id = $this->db->insert_id();
			$result['horario_id'] = $ultimo_id;
			$result['sucesso'] = true;
    	}

	  	header('Content-Type: application/json');
		echo json_encode($result);
		exit;
	}

	public function delete_horario($id) {
		$result = array();
		$horario_consulta = $this->db->from("horarios_consulta")->where("id", $id)->get()->row();

		if(!$horario_consulta) {
			$result['sucesso'] = false;
		} else {
			$result['id'] = $id;
			$result['status'] = 0;
			
			$this->db->where("id",$id);
			$this->db->update("horarios_consulta",$result);

			$result['sucesso'] = true;
		}
		header('Content-Type: application/json');
		echo json_encode($result);
		exit;
	}

	public function mudar_status_consulta($consultas_id, $status) {
		
		$result = array();
		$consulta = array();
		$consulta = $this->db->from("consultas AS c")->where("c.id", $consultas_id)->get()->row();
		
		if(!$consulta){
			$result['sucesso'] = false;
		} else {
			$itemConsulta			   	= array();
			$itemConsulta['updatedAt'] 	= date("Y-m-d");
			
			if($status == 1) {
				$itemConsulta['status']	= 0;
				
				$this->db->where("id",$consultas_id);
				$this->db->update("consultas", $itemConsulta);
				$this->db->update("horarios_consulta", $itemConsulta);
			} else {
				$itemConsulta['status'] = 1;
				
				$this->db->where("id",$consultas_id);
				$this->db->update("consultas", $itemConsulta);
				$this->db->update("horarios_consulta", $itemConsulta);
			}

			$result['sucesso'] = true;
			$result['status'] = $itemConsulta;
		}
		header('Content-Type: application/json');
		echo json_encode($result);
		exit;
	}

	public function criar_reposicao() { 
		$this->data['item'] = new stdClass();

		//Campos relacionados
		//caso seja necessario adicione os relacionamento aqui
		$especialidades = $this->Especialidades_model->getEspecialidades();
		$this->data['listaEspecialidades'] = array();
		$this->data['listaEspecialidades'][''] = "Selecione uma Especialidade";
		foreach ($especialidades as $especialidade) {
			$this->data['listaEspecialidades'][$especialidade->id] = $especialidade->nome_espec;
		}
		$pacientes = $this->Pacientes_model->getPacientes();
		$this->data['listaPacientes'] = array();
		$this->data['listaPacientes'][''] = "Pesquise por um Paciente";
		foreach ($pacientes as $paciente) {
			$this->data['listaPacientes'][$paciente->id] = $paciente->nome_pac;
		}
		$planos = $this->Planos_model->getPlanos();
		$this->data['listaPlanos'] = array();
		$this->data['listaPlanos'][''] = "Selecione um Convênio";
		foreach ($planos as $plano) {
			$this->data['listaPlanos'][$plano->id] = $plano->nome_plano;
		}
		$horarios = $this->Horarios_model->getHorarios();
		$this->data['listaHorarios'] = array();
		$this->data['listaHorarios'][''] = "Selecione um Horário";
		foreach ($horarios as $horario) {
			$this->data['listaHorarios'][$horario->id] = $horario->desc_horario;
		}

		$dias = $this->DiasSemana_model->getDiaSemana();
		$this->data['listaDiaSemana'] = array();
		$this->data['listaDiaSemana'][''] = "Selecione um Dia da Semana";
		foreach ($dias as $dia) {
			$this->data['listaDiaSemana'][$dia->id] = $dia->desc_dia_semana;
		}
		//fim Campos relacionados
		
		if( $this->input->post('enviar') ){
			if( $this->form_validation->run('Consultas') === FALSE ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				$consulta								= array();
			//$consulta['id']							= $this->input->post('id', true);
				$consulta['pacientes_id']				= $this->input->post('pacientes_id', true);
				$consulta['especialidades_id']			= $this->input->post('especialidades_id', true);
				$consulta['profissionais_id']			= $this->input->post('profissionais_id', true);
				$consulta['planos_id']					= $this->input->post('planos_id', true);
				$plano = $this->db
						->select("id")
						->from("plano_procedimento")
						->where(array("especialidades_id" => $consulta['especialidades_id'], 
								"planos_id" => $consulta['planos_id']))
						->get()->result();
				//$consulta['valor'] 									= $plano[0]->id;
				$consulta['plano_procedimento_id'] 		= $plano[0]->id;
				$data_inicio							= formatar_data($this->input->post('data_inicio', true));
				$consulta['data_inicio'] 				= $data_inicio;
				$consulta['data_fim']	 				= NULL;
				$consulta['observacoes']				= $this->input->post('observacoes', true);
				$consulta['tipo'] 						= 2;
				$consulta['status']						= 1;
				$consulta['createdAt']					= date("Y-m-d H:i:s");
				$this->db->insert("consultas", $consulta);
				$consulta_id 												= $this->db->insert_id();

				//criar 24meses de datas já programadas
				$this->gerar_periodo_consultas($consulta_id, $data_inicio);
				//de acordo com os dias da semana escolhidos
				$dias_semana_id							= $this->input->post('dias_semana_id', true);
				$horarios_id							= $this->input->post('horarios_id', true);
				
				// pega os periodos ja salvos no banco
				// depois pra cada periodo pega os inputs de horarios e dia da semana
				// $periodo 								= array();
				// $periodo 								= $this->db->from('periodo_consulta')->where('consultas_id', $consulta_id)->get()->result();
				// foreach ($periodo as $key => $p) {
				// 	if(!empty($dias_semana_id)){
				// 		for($i = 0; $i < count($dias_semana_id); $i++){
				// 			for($j = 0; $j < count($horarios_id); $j++){
				// 				se a possicao do array que indica o dia da semana for igual ao do horario
				// 				entao ele pega as informacoes e salva no banco
				// 				ex: array([dia_semana] => [0]=> 1, [horario]=> [0] => 5)
				// 				salva o dia e horarios com os indices iguais
				// 				if($i == $j){
				// 					$horarios 							= array();
				// 					$horarios['consultas_id'] 			= $consulta_id;
				// 					$horarios['dia_semana_id'] 			= $dias_semana_id[$i];
				// 					$horarios['horarios_id'] 			= $horarios_id[$j];
				// 					$horarios['periodo_consulta_id'] 	= $p->id;
				// 					$horarios['status'] 				= 1;
				// 					$horarios['createdAt'] 				= date("Y-m-d");
									
				// 					//insere aqui
				// 					$this->db->insert("item_consulta",$horarios);
								
				// 				} 
				// 			}
				// 		}	
				// 	}
				// }

				$horarios = array();
				for($i = 0; $i < count($dias_semana_id); $i++){
					if(!empty($dias_semana_id[$i])){
						$horariosConsulta['dia_semana_id'] 	= $dias_semana_id[$i];
						$horariosConsulta['horarios_id'] 	= $horarios_id[$i];
						$horariosConsulta['status'] 		= 1;
						$horariosConsulta['atendimento'] 	= 0;
						$horariosConsulta['consultas_id'] 	= $consulta_id;
						$horariosConsulta['updatedAt'] 		= date("Y-m-d");
						
						$this->db->insert("horarios_consulta",$horariosConsulta);
					} 
				}
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('consultas/reposicao');
			}
		}
	}

	public function reposicao(Type $var = null) {
		$perPage = '25';
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
		$countConsultas = $this->db
							->select("count(c.id) AS quantidade")
							->from("consultas AS c")
							->join("pacientes AS p", "c.pacientes_id = p.id")
							->join("planos AS pl", "c.planos_id = pl.id")
							->join("especialidades AS e", "c.especialidades_id = e.id")
							->join("profissionais AS pr", "c.profissionais_id = pr.id")
							->where("c.tipo", 2)
							->order_by("c.id", "DESC")
							->get()->row();
		$quantidadeConsultas = $countConsultas->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultConsultas = $this->db
				->select("c.id, c.status, pl.nome_plano, e.nome_espec, p.nome_pac, 
							pr.nome_prof, c.createdAt")
				->from("consultas AS c")
				->join("pacientes AS p", "c.pacientes_id = p.id")
				->join("planos AS pl", "c.planos_id = pl.id")
				->join("especialidades AS e", "c.especialidades_id = e.id")
				->join("profissionais AS pr", "c.profissionais_id = pr.id")
				->where("c.tipo", 2)
				->order_by("c.id", "DESC")
				->limit($perPage,$offset)
				->get();
		$this->data['listaConsultas'] = $resultConsultas->result();

		// arShow($this->data['listaConsultas']);exit;
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("consultas/reposicao")."?";
		$config['total_rows'] = $quantidadeConsultas;
		$config['per_page'] = $perPage;
		
		$this->pagination->initialize($config);
		
		$this->data['paginacao'] = $this->pagination->create_links(); 
	}
	
	public function periodos() {
		$consultas_id = $this->uri->segment(3);

		// Recupera as consultas geradas da data atual.
		$resultConsultas = $this->db
			->select("c.id, p.nome_pac, pr.nome_prof, e.nome_espec, pl.nome_plano, hc.id AS horario_consulta_id, hr.id AS horario_id, hr.desc_horario, hc.dia_semana_id, ds.desc_dia_semana, hc.status, NOW() AS data")
			->from("consultas AS c")
			->join("pacientes AS p", "c.pacientes_id = p.id")
			->join("horarios_consulta AS hc", "hc.consultas_id = c.id")
			->join("dias_semana AS ds", "hc.dia_semana_id = ds.id")
			->join("horarios AS hr", "hc.horarios_id = hr.id")
			->join("profissionais AS pr", "c.profissionais_id = pr.id")
			->join("especialidades AS e", "c.especialidades_id = e.id")
			->join("planos AS pl", "c.planos_id = pl.id")
			->where(array("hc.consultas_id" => $consultas_id, "c.status" => 1))
			->order_by("hr.id", "ASC")
			->get()->result();
		$this->data['listaConsultas'] = $resultConsultas;
	}

	public function atendimentos() {
		$consultas_id = $this->uri->segment(3);
		
		$consulta = $this->db
			->select("c.id, p.nome_pac, pr.nome_prof, e.nome_espec, pl.nome_plano")
			->from("consultas AS c")
			->join("pacientes AS p", "c.pacientes_id = p.id")
			->join("profissionais AS pr", "c.profissionais_id = pr.id")
			->join("especialidades AS e", "c.especialidades_id = e.id")
			->join("planos AS pl", "c.planos_id = pl.id")
			->where("c.id", $consultas_id)
			->get()->result();
		
		if(!$consulta) {
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('consultas/index');
		} else {
			$resultConsultas = $this->db
				->select("c.id, p.nome_pac, pr.nome_prof, e.nome_espec, pl.nome_plano, hr.id AS horario_id, hr.desc_horario, a.dias_semana_id, ds.desc_dia_semana, a.data_presenca, f.valor, a.status, a.presenca, NOW() AS data")
				->from("atendimentos AS a")
				->join("consultas AS c", "a.consultas_id = c.id")
				->join("pacientes AS p", "c.pacientes_id = p.id")
				->join("profissionais AS pr", "c.profissionais_id = pr.id")
				->join("especialidades AS e", "c.especialidades_id = e.id")
				->join("dias_semana AS ds", "a.dias_semana_id = ds.id")
				->join("horarios AS hr", "a.horarios_id = hr.id")
				->join("planos AS pl", "c.planos_id = pl.id")
				->join("faturamento AS f", "f.atendimentos_id = a.id")
				->where("a.consultas_id", $consultas_id)
				->get()->result();
			$this->data['listaConsultas'] = $resultConsultas;
			$this->data['consultas'] = $consulta;

		//arShow($this->data['listaConsultas']); exit;
		}
	}

	public function faltas() {
		$consultas_id = $this->uri->segment(3);
		
		$horarios = $this->Horarios_model->getHorarios();
		$this->data['listaHorarios'] = array();
		foreach ($horarios as $horario) {
			$this->data['listaHorarios'][$horario->id] = $horario->desc_horario;
		}

		$dias = $this->DiasSemana_model->getDiaSemana();
		$this->data['listaDiaSemana'] = array();
		foreach ($dias as $dia) {
			$this->data['listaDiaSemana'][$dia->id] = $dia->desc_dia_semana;
		}

		$consulta = array();
		$consulta = $this->db
			->select("c.id, p.nome_pac, pr.nome_prof, e.nome_espec, pl.nome_plano")
			->from("consultas AS c")
			->join("pacientes AS p", "c.pacientes_id = p.id")
			->join("profissionais AS pr", "c.profissionais_id = pr.id")
			->join("especialidades AS e", "c.especialidades_id = e.id")
			->join("planos AS pl", "c.planos_id = pl.id")
			->where("c.id", $consultas_id)
			->get()->result();
		
		if(!$consulta) {
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('consultas/index');
		} else {
			if( $this->input->post('enviar') ){
				$atendimento = array();
				$atendimento['consultas_id']	= $consultas_id;
				$atendimento['dias_semana_id']	= $this->input->post('dias_semana_id', true);
				$atendimento['horarios_id']		= $this->input->post('horarios_id', true);
				$atendimento['presenca']		= 0;
				$atendimento['data_presenca']	= formatar_data($this->input->post('data_presenca', true));
				$atendimento['status']			= 1;
				$atendimento['createdAt']		= date("Y-m-d");

				//arShow($atendimento); exit;
				$this->db->insert("atendimentos",$atendimento);
				$atendimentos_id = $this->db->insert_id();
				//Insere dados do faturamento do atendimento
				$faturamento = array();
				$faturamento['consultas_id'] 	 = $consultas_id;
				$faturamento['atendimentos_id']  = $atendimentos_id;
				$faturamento['valor']			 = 0.00;
				//$faturamento['valor'] 			 = $valor[0]->valor;
				$faturamento['tipo'] 			 = 1;
				$faturamento['data_faturamento'] = date("Y-m-d H:i:s");
				$faturamento['status'] 			 = 1;
				$faturamento['createdAt'] 		 = date("Y-m-d");
				
				$sql_faturamentos = $this->db->insert("faturamento", $faturamento);

				if($sql_faturamentos) {
					$this->session->set_flashdata("msg_success", "Falta registrada com sucesso!");
					redirect('consultas/atendimentos/'. $consultas_id);
				}
			}
			
			$this->data['consultas'] = $consulta;
		}

		//$this->load->view('consultas/ajax/faltas');
	}



	public function profissionais($id = false) {
		$resultConsultas = $this->db
			->select("c.id, c.status, pr.id AS profissional_id, p.id AS paciente_id, pl.nome_plano, e.nome_espec, p.nome_pac, 
						pr.nome_prof, c.createdAt")
			->from("consultas AS c")
			->join("pacientes AS p", "c.pacientes_id = p.id")
			->join("planos AS pl", "c.planos_id = pl.id")
			->join("especialidades AS e", "c.especialidades_id = e.id")
			->join("profissionais AS pr", "c.profissionais_id = pr.id")
			->where("pr.id", $id)
			->order_by("c.id", "DESC")
			->get();
		
		$this->data['listaConsultas'] = $resultConsultas->result();
	}

	public function editar_pacientes() {
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);
		$profissional_id = $this->uri->segment(4);

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
			redirect('consultas/profissionais/' . $profissional_id);
		} else {
			$this->data['item'] = $paciente;
			$this->data['listaProfissionais'] = $profissional_id;
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
					redirect('consultas/profissionais/' . $profissional_id);
				}
			}
		}
	}


	public function relatorio_total_pdf() {
		$rs = "45.00";
		$valor_total = "45.00";


 		$data['mensalidade'] 	= $rs;
 		$data['valor_total'] 	= $valor_total;
		$data['base_url'] 	= site_url();

 		$this->load->library('pdf');
		$this->pdf->load_view('modulos/consultas/relatorio_total_pdf', $data);
		$this->pdf->set_paper('letter', 'landscape');
		$this->pdf->render();
		$this->pdf->stream("relatorio_total_" . $rs . ".pdf");

	}
	/* End of Dependent Functions */
}

/* End of file Consultases.php */
/* Location: ./system/application/controllers/Consultases.php */