<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("ItemConsulta_model");
		$this->load->model("Profissionais_model");
		
		//adicione os campos da busca
		$camposFiltros["pr.nome_prof"] = "Nome Profissional";

		$this->data['campos']    = $camposFiltros;
	}

	public function index(){
		
		$dia_semana_id = date("w", strtotime(date('Y-m-d')));
		$periodo_consulta_id = date("m");

		//Campos relacionados 
		//Insira aqui os dados das tabelas externas
		$profissionais = $this->Profissionais_model-> getProfissionaisPorConsulta($dia_semana_id);
		$this->data['listaProfissionais'] = array();
		foreach ($profissionais as $profissional) {
			$this->data['listaProfissionais'][$profissional->id] = $profissional->nome_prof;
		}

		// $resultItemConsulta = $this->db
		// 					->select("ic.id, h.desc_horario, ds.desc_dia_semana, pc.data, ic.status, c.id as cod_consulta,
		// 						      p.nome_pac, pr.nome_prof, e.nome_espec, pl.nome_plano, ic.periodo_consulta_id")
		// 					->from("item_consulta AS ic")
		// 					->join("horarios_profissionais as hp", "ic.horarios_id = hp.id")
		// 					->join("horarios as h", "hp.horarios_id = h.id")
		// 					->join("dias_semana as ds", "ic.dia_semana_id = ds.id")
		// 					->join("periodo_consulta as pc", "ic.periodo_consulta_id = pc.id")
		// 					->join("consultas as c", "ic.consultas_id = c.id")
		// 					->join("pacientes as p", "c.pacientes_id = p.id")
		// 					->join("profissionais as pr", "c.profissionais_id = pr.id")
		// 					->join("especialidades as e", "pr.especialidades_id = e.id")
		// 					->join("plano_procedimento as pp", "c.plano_procedimento_id = pp.id")
		// 					->join("planos as pl", "pp.planos_id = pl.id")
		// 					->where(array("ic.dia_semana_id" => $dia_semana_id,
		// 								  "month(pc.data)" => $periodo_consulta_id,
		// 								  "c.profissionais_id" => 8,
		// 								  "ic.status" => 1))
		// 					->order_by("h.id", "ASC")
		// 					->get();

		$perPage = '50';
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
			->select("count(fr.id) as quantidade")
			->from("frequencias as fr")
			->join("horarios as h", "fr.horarios_id = h.id")
			->join("dias_semana as ds", "fr.dias_semana_id = ds.id")
			->join("consultas as c", "fr.consultas_id = c.id")
			->join("pacientes as p", "c.pacientes_id = p.id")
			->join("profissionais as pr", "c.profissionais_id = pr.id")
			->where(array("fr.dias_semana_id" => $dia_semana_id,
						  "month(fr.createdAt)" => $periodo_consulta_id,
						  "fr.createdAt" => date("Y-m-d"),
						  // "c.profissionais_id" => 8,
						  "fr.status" => 1))
			->order_by("fr.horarios_id", "ASC")
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

		$resultItemConsulta = $this->db
			->select("fr.id, fr.consultas_id as cod_consulta, 
				      h.desc_horario, ds.desc_dia_semana, p.nome_pac, pr.nome_prof, fr.status, fr.createdAt as data, fr.presenca")
			->from("frequencias as fr")
			->join("horarios as h", "fr.horarios_id = h.id")
			->join("dias_semana as ds", "fr.dias_semana_id = ds.id")
			->join("consultas as c", "fr.consultas_id = c.id")
			->join("pacientes as p", "c.pacientes_id = p.id")
			->join("profissionais as pr", "c.profissionais_id = pr.id")
			->where(array("fr.dias_semana_id" => $dia_semana_id,
						  "month(fr.createdAt)" => $periodo_consulta_id,
						  "fr.createdAt" => date("Y-m-d"),
						  // "c.profissionais_id" => 8,
						  "fr.status" => 1))
			->order_by("fr.horarios_id", "ASC")
			->limit($perPage,$offset)
			->get();
		
		$this->data['listaItemConsulta'] = $resultItemConsulta->result();

		$this->load->library('pagination');
		$config['base_url'] = site_url("dashboard/index")."?";
		$config['total_rows'] = $quantidadeConsultas;
		$config['per_page'] = $perPage;
		
		$this->pagination->initialize($config);
		
		$this->data['paginacao'] = $this->pagination->create_links(); 

		// arShow($this->data['listaItemConsulta']);exit;

		// $resultItemConsultaPresente = $this->db
		// 						->select("f.id, h.desc_horario, ds.desc_dia_semana, p.nome_pac, pr.nome_prof, 
		// 							     c.id as cod_consulta, e.nome_espec, pl.nome_plano, f.data, f.status")
		// 						->from("frequencias AS f")
		// 						->join("horarios as h", "f.horarios_id = h.id")
		//  						->join("dias_semana as ds", "f.dias_semana_id = ds.id")
		//  						->join("item_consulta as ic", "f.item_consulta_id = ic.id")
		//  						->join("consultas as c", "f.consultas_id = c.id")
		// 						->join("pacientes as p", "c.pacientes_id = p.id")
		// 						->join("profissionais as pr", "c.profissionais_id = pr.id")
		// 						->join("especialidades as e", "pr.especialidades_id = e.id")
		// 						->join("plano_procedimento as pp", "c.plano_procedimento_id = pp.id")
		// 						->join("planos as pl", "pp.planos_id = pl.id")
		// 						->where(array("month(f.data)" => $periodo_consulta_id,
		// 									   "f.status" => 1))
		// 						->get();
		// $this->data['listaItemConsultaPresente'] = $resultItemConsultaPresente->result();


		// $resultItemConsultaAusente = $this->db
		// 						->select("f.id, h.desc_horario, ds.desc_dia_semana, p.nome_pac, pr.nome_prof, 
		// 							     c.id as cod_consulta, e.nome_espec, pl.nome_plano, f.data, f.status")
		// 						->from("frequencias AS f")
		// 						->join("horarios as h", "f.horarios_id = h.id")
		//  						->join("dias_semana as ds", "f.dias_semana_id = ds.id")
		//  						->join("item_consulta as ic", "f.item_consulta_id = ic.id")
		//  						->join("consultas as c", "f.consultas_id = c.id")
		// 						->join("pacientes as p", "c.pacientes_id = p.id")
		// 						->join("profissionais as pr", "c.profissionais_id = pr.id")
		// 						->join("especialidades as e", "pr.especialidades_id = e.id")
		// 						->join("plano_procedimento as pp", "c.plano_procedimento_id = pp.id")
		// 						->join("planos as pl", "pp.planos_id = pl.id")
		// 						->where(array("month(f.data)" => $periodo_consulta_id,
		// 									   "f.status" => 0))
		// 						->get();
		// $this->data['listaItemConsultaAusente'] = $resultItemConsultaAusente->result();

	}

	public function agendamento() {
		$periodo_consulta_id = date("m");
		$profissional_id = $this->uri->segment(3);
		
		$resultAgendaConsulta = $this->db
							->select("ic.id, h.desc_horario, ds.desc_dia_semana, pc.data, ic.status, c.id as cod_consulta,
								      p.nome_pac, pr.nome_prof, e.nome_espec, pl.nome_plano")
							->from("item_consulta AS ic")
							->join("horarios_profissionais as hp", "ic.horarios_id = hp.id")
							->join("horarios as h", "hp.horarios_id = h.id")
							->join("dias_semana as ds", "ic.dia_semana_id = ds.id")
							->join("periodo_consulta as pc", "ic.periodo_consulta_id = pc.id")
							->join("consultas as c", "ic.consultas_id = c.id")
							->join("pacientes as p", "c.pacientes_id = p.id")
							->join("profissionais as pr", "c.profissionais_id = pr.id")
							->join("especialidades as e", "pr.especialidades_id = e.id")
							->join("plano_procedimento as pp", "c.plano_procedimento_id = pp.id")
							->join("planos as pl", "pp.planos_id = pl.id")
							->where(array("month(pc.data)" => $periodo_consulta_id,
											"pr.id" => $profissional_id))
							->order_by("ds.id ASC, h.id ASC")
							->get()->result();
		

		//Traz os resultados separados por Dia da Semana e Profissional
		$agenda = array();
		foreach ($resultAgendaConsulta as $result) {
			$agenda[$result->desc_dia_semana][$result->nome_prof][] = $result;
		}

		
		$this->data['listaAgendaConsulta'] = $agenda;

		$this->data['profissional_id'] = $profissional_id;
	}

	public function turmas_completas() {
		$semana_id = $this->uri->segment(3);

		//Pega as turmas de acordo com o dia da semana passado na view (segunda, terça...)
		$resultTurma = array();
		$resultTurma = $this->Financeiro_model->getTodasTurmas($semana_id);

		$rs = array();
		foreach ($resultTurma as $key => $result) {
			$rs[$result->desc_dia_semana][$result->id][] = $result;
		}

		$this->data["listaTurmas"] = $rs;
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
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */