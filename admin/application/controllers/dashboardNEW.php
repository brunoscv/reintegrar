<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		//adiciona os dados do login para fazer as visualizacoes de informacoes
		$this->data['user_id']  = $this->session->userdata('userdata')['profissionais_id'];
		$this->data['admin'] 	= $this->session->userdata('userdata')['principal'];

		//adicione os campos da busca
		$camposFiltros["pr.nome_prof"] = "Nome Profissional";
		$this->data['campos']    	   = $camposFiltros;
	}

	public function index(){
		$dia_semana_id = date("w", strtotime(date('Y-m-d')));

		$perPage = '100';
		$offset = ($this->input->get("per_page")) ? $this->input->get("per_page") : "0";

		if($this->data['admin'] != 1) {
			$this->data['displayed'] = "style='display:none;'";
		} else {
			$this->data['displayed'] = "";
		}

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
			->select("count(c.id) as quantidade")
			->from("consultas AS c")
			->join("pacientes AS p", "c.pacientes_id = p.id")
			->join("horarios_consulta AS hc", "hc.consultas_id = c.id")
			->join("dias_semana AS ds", "hc.dia_semana_id = ds.id")
			->join("horarios AS hr", "hc.horarios_id = hr.id")
			->join("profissionais AS pr", "c.profissionais_id = pr.id")
			->join("especialidades AS e", "c.especialidades_id = e.id")
			->join("planos AS pl", "c.planos_id = pl.id")
			->where(array("hc.dia_semana_id" => $dia_semana_id, "c.status" => 1))
			->get()->row();
		
		if($this->data['admin'] != 1) {
			$this->db->where("c.profissionais_id", $this->data['user_id']);
		}
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

		// Recupera as consultas geradas da data atual.
		$resultConsultas = $this->db
			->select("c.id, p.nome_pac, pr.nome_prof, e.nome_espec, pl.nome_plano, hc.id AS horario_consulta_id, hr.id AS horario_id, hr.desc_horario, hc.dia_semana_id, ds.desc_dia_semana, NOW() AS data")
			->from("consultas AS c")
			->join("pacientes AS p", "c.pacientes_id = p.id")
			->join("horarios_consulta AS hc", "hc.consultas_id = c.id")
			->join("dias_semana AS ds", "hc.dia_semana_id = ds.id")
			->join("horarios AS hr", "hc.horarios_id = hr.id")
			->join("profissionais AS pr", "c.profissionais_id = pr.id")
			->join("especialidades AS e", "c.especialidades_id = e.id")
			->join("planos AS pl", "c.planos_id = pl.id")
			->where(array("hc.dia_semana_id" => $dia_semana_id, "c.status" => 1, "c.tipo" => 1, "hc.atendimento" => 0))
			->order_by("hr.desc_horario", "ASC")
			->get()->result();
		
		if($this->data['admin'] != 1) {
			$this->db->where("c.profissionais_id", $this->data['user_id']);
		}
		$this->data['listaConsultas'] = $resultConsultas;

		// Recupera as consultas geradas da data atual.
		$resultReposicoes = $this->db
			->select("c.id, p.nome_pac, pr.nome_prof, e.nome_espec, hc.id AS horario_consulta_id, hr.id AS horario_id, hr.desc_horario, hc.dia_semana_id, ds.desc_dia_semana, NOW() AS data")
			->from("consultas AS c")
			->join("pacientes AS p", "c.pacientes_id = p.id")
			->join("horarios_consulta AS hc", "hc.consultas_id = c.id")
			->join("dias_semana AS ds", "hc.dia_semana_id = ds.id")
			->join("horarios AS hr", "hc.horarios_id = hr.id")
			->join("profissionais AS pr", "c.profissionais_id = pr.id")
			->join("especialidades AS e", "c.especialidades_id = e.id")
			->where(array("hc.dia_semana_id" => $dia_semana_id, "c.status" => 1, "c.tipo" => 2, "hc.atendimento" => 0))
			->order_by("hr.id", "ASC")
			->get()->result();
		
		if($this->data['admin'] != 1) {
			$this->db->where("c.profissionais_id", $this->data['user_id']);
		}
		$this->data['listaReposicoes'] = $resultReposicoes;

		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}

		$countConsultasRealizadas = $this->db
			->select("count(c.id) as quantidade")
			->from("consultas AS c")
			->join("pacientes AS p", "c.pacientes_id = p.id")
			->join("horarios_consulta AS hc", "hc.consultas_id = c.id")
			->join("dias_semana AS ds", "hc.dia_semana_id = ds.id")
			->join("horarios AS hr", "hc.horarios_id = hr.id")
			->join("profissionais AS pr", "c.profissionais_id = pr.id")
			->join("especialidades AS e", "c.especialidades_id = e.id")
			->join("faturamento as f", "f.consultas_id = c.id")
			->join("atendimentos as atd", "f.consultas_id = atd.consultas_id")
			->where(array("hc.dia_semana_id" => $dia_semana_id, "c.status" => 1))
			->get()->row();
			
		if($this->data['admin'] != 1) {
			$this->db->where("c.profissionais_id", $this->data['user_id']);
		}
		$quantidadeConsultasRealizadas = $countConsultasRealizadas->quantidade;

		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}

		// Recupera as consultas geradas da data atual.
		$resultConsultasRealizadas = $this->db
			->select("c.id, p.nome_pac, pr.nome_prof, atd.data_presenca, f.createdAt, e.nome_espec, hc.id AS horario_consulta_id, hr.id AS horario_id, hr.desc_horario, hc.dia_semana_id, ds.desc_dia_semana, f.tipo, hc.updatedAt AS data")
			->from("consultas AS c")
			->join("pacientes AS p", "c.pacientes_id = p.id")
			->join("horarios_consulta AS hc", "hc.consultas_id = c.id")
			->join("dias_semana AS ds", "hc.dia_semana_id = ds.id")
			->join("horarios AS hr", "hc.horarios_id = hr.id")
			->join("profissionais AS pr", "c.profissionais_id = pr.id")
			->join("especialidades AS e", "c.especialidades_id = e.id")
			->join("faturamento as f", "f.consultas_id = c.id")
			->join("atendimentos as atd", "f.atendimentos_id = atd.id")
			->where(array("hc.dia_semana_id" => $dia_semana_id, "c.status" => 1, "atd.data_presenca"=> date("Y-m-d"), "hc.atendimento" => 1))
			->group_by("hc.id")
			->order_by("hr.id", "ASC")
			->get()->result();

			//arShow($resultConsultasRealizadas); exit; 
		
		if($this->data['admin'] != 1) {
			$this->db->where("c.profissionais_id", $this->data['user_id']);
		}
		$this->data['listaConsultasRealizadas'] = $resultConsultasRealizadas;

		//arShow($this->data['listaConsultasRealizadas']);exit;
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("dashboard/index")."?";
		$config['total_rows'] = $quantidadeConsultas;
		$config['per_page'] = $perPage;
		
		$this->pagination->initialize($config);
		
		$this->data['paginacao'] = $this->pagination->create_links(); 
	}

	public function salvar_atendimentos($consultas_id, $dias_semana_id, $horarios_id, $horario_consulta_id, $status_faturamento) {
		
		$result = array();
		$consulta = array();
		$consulta = $this->db->from("consultas AS c")->where("c.id", $consultas_id)->get()->result();
		if(!$consulta) {
			$result['sucesso'] = false;
		} else {
			$atendimento 					= array();
			$atendimento["consultas_id"] 	= $consultas_id;
			$atendimento["dias_semana_id"] 	= $dias_semana_id;
			$atendimento["horarios_id"] 	= $horarios_id;
			$status_faturamento == 1 ? $atendimento["presenca"] = 1 : $atendimento["presenca"] = 0;
			$atendimento["data_presenca"] 	= date("Y-m-d");
			$atendimento["status"] 			= 1;
			$atendimento["createdAt"] 		= date("Y-m-d");
			
			$sql_atendimentos = $this->db->insert("atendimentos", $atendimento);
			$atendimentos_id = $this->db->insert_id();

			$horarioAtendimento = array();
			$horarioAtendimento['atendimento'] = 1;
			$horarioAtendimento['updatedAt']   = date("Y-m-d");
			$this->db->where("id", $horario_consulta_id);
			$this->db->update("horarios_consulta", $horarioAtendimento);

			if(!$sql_atendimentos){
				$result['sucesso'] = false;
			} else {
				//Insere dados do faturamento do atendimento
				$faturamento = array();
				$faturamento['consultas_id'] 	 = $consultas_id;
				$faturamento['atendimentos_id']  = $atendimentos_id;
				$valor = $this->db
						->select("valor")
						->from("plano_procedimento")
						->where(array("especialidades_id" => $consulta[0]->especialidades_id, 
										"planos_id" => $consulta[0]->planos_id))
						->get()->result();
				$status_faturamento == 0 ? $faturamento['valor'] = 0.00 : $faturamento['valor'] = $valor[0]->valor;
				//$faturamento['valor'] 			 = $valor[0]->valor;
				//status do faturamento, se faltou, desmarcou ou esteve presente
				$faturamento['tipo'] 			 = $status_faturamento;
				$faturamento['data_faturamento'] = date("Y-m-d H:i:s");
				$faturamento['status'] 			 = 1;
				$faturamento['createdAt'] 		 = date("Y-m-d");
				$result['sucesso'] = $faturamento;
				
				$sql_faturamentos = $this->db->insert("faturamento", $faturamento);
				
				if(!$sql_faturamentos){
				} else {
				// Recupera as consultas geradas da data atual.
				$resultConsultas = $this->db
				->select("c.id, p.nome_pac, pr.nome_prof, hr.id AS horario_id, hr.desc_horario, hc.dia_semana_id, ds.desc_dia_semana, NOW() AS data")
				->from("consultas AS c")
				->join("pacientes AS p", "c.pacientes_id = p.id")
				->join("horarios_consulta AS hc", "hc.consultas_id = c.id")
				->join("dias_semana AS ds", "hc.dia_semana_id = ds.id")
				->join("horarios AS hr", "hc.horarios_id = hr.id")
				->join("profissionais AS pr", "c.profissionais_id = pr.id")
				->where(array("hc.dia_semana_id" => $dias_semana_id, "c.status" => 1))
				->order_by("hr.id ASC")
				->get();
				$this->data['listaConsultas'] = $resultConsultas->result();
				
				$result['sucesso'] = true;
				$result['consultas'] = $this->data['listaConsultas'];
				}
			}
		}
		header('Content-Type: application/json');
		echo json_encode($result);
		exit;
	}

	public function alterarSenha(){
		$this->load->model("Usuarios_model");
		$rules = array(
				array(
					'field' => "senha_antiga",
					'label' => "Senha Antiga",
					'rules' => "required"
						),
				array(
					'field' => "nova_senha",
					'label' => "",
					'rules' => "required"
						)
				);
		$this->form_validation->set_rules($rules);
		if($this->input->post('enviar')){
			
			if( $this->form_validation->run() === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				if( $usuario = $this->Usuarios_model->getUsuarioById($this->data['userdata']['id']) ){
					if( $this->encrypt->decode($usuario->senha) == $this->input->post("senha_antiga", TRUE) ){
						$user = array();
						$user['senha'] = $this->encrypt->encode( $this->input->post("nova_senha") );
						$user['updatedAt'] = date("Y-m-d H:i:s");

						$this->db->where("id", $usuario->id);
						$this->db->update("usuarios", $user);

						$this->session->set_flashdata("msg_success", "Senha atualizada com sucesso");
						redirect("dashboard/alterarSenha");
					} else {
						$this->data['msg_error'] = "Senha Incorreta";	
					}
				} else {
					echo $this->db->last_query();exit;
					$this->data['msg_error'] = "Usuário não encontrado";
				}
			}
		}
	}

	public function salvar_reposicoes($consultas_id, $dias_semana_id, $horarios_id, $horario_consulta_id) {
		
		$result = array();
		$consulta = array();
		$consulta = $this->db->from("consultas AS c")->where("c.id", $consultas_id)->get()->result();
		if(!$consulta) {
			$result['sucesso'] = false;
		} else {
			$atendimento 					= array();
			$atendimento["consultas_id"] 	= $consultas_id;
			$atendimento["dias_semana_id"] 	= $dias_semana_id;
			$atendimento["horarios_id"] 	= $horarios_id;
			$atendimento["presenca"] 		= 1;
			$atendimento["data_presenca"] 	= date("Y-m-d");
			$atendimento["status"] 			= 1;
			$atendimento["createdAt"] 		= date("Y-m-d");
			
			$sql_atendimentos = $this->db->insert("atendimentos", $atendimento);
			$atendimentos_id = $this->db->insert_id();

			$horarioAtendimento = array();
			$horarioAtendimento['atendimento'] = 1;
			$horarioAtendimento['status'] = 0;
			
			$this->db->where("id", $horario_consulta_id);
			$this->db->update("horarios_consulta", $horarioAtendimento);

			if(!$sql_atendimentos){
				$result['sucesso'] = false;
			} else {
				//Insere dados do faturamento do atendimento
				$faturamento = array();
				$faturamento['consultas_id'] 	 = $consultas_id;
				$faturamento['atendimentos_id']  = $atendimentos_id;
				$valor = $this->db
						->select("valor")
						->from("plano_procedimento")
						->where(array("especialidades_id" => $consulta[0]->especialidades_id, 
										"planos_id" => $consulta[0]->planos_id))
						->get()->result();
				$faturamento['valor'] 			 = $valor[0]->valor;
				$faturamento['tipo'] 			 = 1;
				$faturamento['data_faturamento'] = date("Y-m-d H:i:s");
				$faturamento['status'] 			 = 1;
				$faturamento['createdAt'] 		 = date("Y-m-d");
				$result['sucesso'] = $faturamento;
				
				$sql_faturamentos = $this->db->insert("faturamento", $faturamento);

				$consultaReposicao['status'] = 0;
				$this->db->where("id", $consultas_id);
				$this->db->update("consultas", $consultaReposicao);
				
				if(!$sql_faturamentos){
				} else {
				// Recupera as consultas geradas da data atual.
				$resultConsultas = $this->db
				->select("c.id, p.nome_pac, pr.nome_prof, hr.id AS horario_id, hr.desc_horario, hc.dia_semana_id, ds.desc_dia_semana, NOW() AS data")
				->from("consultas AS c")
				->join("pacientes AS p", "c.pacientes_id = p.id")
				->join("horarios_consulta AS hc", "hc.consultas_id = c.id")
				->join("dias_semana AS ds", "hc.dia_semana_id = ds.id")
				->join("horarios AS hr", "hc.horarios_id = hr.id")
				->join("profissionais AS pr", "c.profissionais_id = pr.id")
				->where(array("hc.dia_semana_id" => $dias_semana_id, "c.status" => 1))
				->order_by("hr.id", "ASC")
				->get();
				$this->data['listaConsultas'] = $resultConsultas->result();
				
				$result['sucesso'] = true;
				$result['consultas'] = $this->data['listaConsultas'];
				}
			}
		}
		header('Content-Type: application/json');
		echo json_encode($result);
		exit;
	}

	public function atendimentos_realizados(){
		
		$dia_semana_id = date("w", strtotime(date('Y-m-d')));
		
		$perPage = '100';
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

		$countConsultasRealizadas = $this->db
			->select("count(c.id) as quantidade")
			->from("consultas AS c")
			->join("pacientes AS p", "c.pacientes_id = p.id")
			->join("horarios_consulta AS hc", "hc.consultas_id = c.id")
			->join("horarios as hr", "hc.horarios_id = hr.id")
			->where(array("hc.dia_semana_id" => $dia_semana_id, "c.status" => 1))
			->get()->row();
		$quantidadeConsultasRealizadas = $countConsultasRealizadas->quantidade;

		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}

		// Recupera as consultas geradas da data atual.
		$resultConsultasRealizadas = $this->db
			->select("c.id, p.nome_pac, pr.nome_prof, e.nome_espec, hc.id AS horario_consulta_id, hr.id AS horario_id, hr.desc_horario, hc.dia_semana_id, ds.desc_dia_semana, NOW() AS data")
			->from("consultas AS c")
			->join("pacientes AS p", "c.pacientes_id = p.id")
			->join("horarios_consulta AS hc", "hc.consultas_id = c.id")
			->join("dias_semana AS ds", "hc.dia_semana_id = ds.id")
			->join("horarios AS hr", "hc.horarios_id = hr.id")
			->join("profissionais AS pr", "c.profissionais_id = pr.id")
			->join("especialidades AS e", "c.especialidades_id = e.id")
			->where(array("hc.dia_semana_id" => $dia_semana_id, "c.status" => 1, "c.tipo" => 1, "hc.atendimento" => 1))
			->order_by("hr.id", "ASC")
			->get()->result();

		$this->data['listaConsultasRealizadas'] = $resultConsultasRealizadas;
		//arShow($this->data['listaConsultas']);exit;
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("dashboard/index")."?";
		$config['total_rows'] = $quantidadeConsultasRealizadas;
		$config['per_page'] = $perPage;
		
		$this->pagination->initialize($config);
		
		$this->data['paginacao'] = $this->pagination->create_links(); 
	}

	public function atualizar_atendimentos() {
		$result = array();
		$dia_semana_id = date("w", strtotime(date('Y-m-d')));

		// Recupera as consultas geradas da data atual.
		$resultConsultasRealizadas = $this->db
		->select("c.id, p.nome_pac, pr.nome_prof, hc.id AS horario_consulta_id, hr.id AS horario_id, hr.desc_horario, hc.dia_semana_id, ds.desc_dia_semana, hc.updatedAt AS data")
		->from("consultas AS c")
		->join("pacientes AS p", "c.pacientes_id = p.id")
		->join("horarios_consulta AS hc", "hc.consultas_id = c.id")
		->join("dias_semana AS ds", "hc.dia_semana_id = ds.id")
		->join("horarios AS hr", "hc.horarios_id = hr.id")
		->join("profissionais AS pr", "c.profissionais_id = pr.id")
		->where(array("hc.dia_semana_id" => $dia_semana_id, "c.status" => 1, "c.tipo" => 1, "hc.atendimento" => 1))
		->order_by("hr.id", "ASC")
		->get();

		$this->data['listaConsultasRealizadas'] = $resultConsultasRealizadas->result();
		$result['sucesso'] = true;
		$result['atendimentos'] = $this->data['listaConsultasRealizadas'];
		//arShow($result['atendimentos']);exit;
		
		header('Content-Type: application/json');
		echo json_encode($result);
		exit;
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */