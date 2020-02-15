<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Dashboard_model");
		
		//adicione os campos da busca
		$camposFiltros["pr.nome_prof"] = "Nome Cliente";
		$camposFiltros["pr.area"] = "Área Desejada";

		$this->data['campos']    = $camposFiltros;
	}

	public function index(){
		$countAtendimentos = $this->db
			->select("count(id) AS quantidade")
			->from("atendimentos_sessoes AS as")
			->where("presenca", 1)
			->get()->row();
		$quantidadeMenus = $countAtendimentos->quantidade;
		$this->data['qtd_atd'] = $quantidadeMenus;

		//arShow($this->data['qtd_atd']); exit;
		
	}

	public function get_consultas_calendario($data) {
		// Recupera as consultas geradas da data atual.
		$result = array();
		
		$resultItemConsulta = $this->db
			->select("fr.id, fr.consultas_id as cod_consulta, 
				      h.desc_horario, ds.desc_dia_semana, p.nome_pac, pr.nome_prof, fr.status, fr.createdAt as data, fr.presenca")
			->from("frequencias as fr")
			->join("horarios as h", "fr.horarios_id = h.id")
			->join("dias_semana as ds", "fr.dias_semana_id = ds.id")
			->join("consultas as c", "fr.consultas_id = c.id")
			->join("pacientes as p", "c.pacientes_id = p.id")
			->join("profissionais as pr", "c.profissionais_id = pr.id")
			->where(array("fr.createdAt" => $data, "fr.status" => 1))
			->order_by("fr.horarios_id", "ASC")
			->get();
		
		$result['sucesso'] = true;
		$result['listaItemConsulta'] = $resultItemConsulta->result();

		header('Content-Type: application/json');
		echo json_encode($result);
		exit;
		//arShow($this->data['listaItemConsulta']); exit;
	}

	public function get_count_consultas_calendario($ano, $mes) {
		// Verifica se existe consultas geradas para a dia atual ou dia escolhido
		// clausula like tem o 'after' que tem a intencão de fazer a busca (2018-05%)
		// que irá trazer todos as consultas do mês
		$query = $this->db
		    ->select("count(fr.id) as quantidade, fr.createdAt")
			->from("frequencias as fr")
			->like("fr.createdAt", "$ano-$mes", "after")
			->group_by("fr.createdAt")
			->get();

		$countConsultas = array();
		
		foreach ($query->result() as $key => $value) {
			//gambiarra para reconhecer se o dia do mês tem um ou dois digitos
			//para fazer o substr corretamente
			$digito_dia_consulta = substr($value->createdAt, 8,1);				
				if ($digito_dia_consulta == '0') {
					$countConsultas[substr($value->createdAt, 9,1)] = $value->quantidade . " consulta(s).";				
				}
				elseif ($digito_dia_consulta > '0') {
					$countConsultas[substr($value->createdAt, 8,2)] = $value->quantidade . " consulta(s).";
				}
		}
		return $countConsultas;
		
	}
	public function calendario($ano = null, $mes = null) {

		$config = array(
			'start_day' => 'monday',
			'day_type' => 'long',
			'show_next_prev' => true,
			'next_prev_url' => base_url() . 'dashboard/calendario',
			'template' => '
			{table_open}<table class="calendar" style="margin-bottom:3.4em;">{/table_open}
				{heading_row_start}
						<tr class="cal_heading">
				{/heading_row_start}
			    {heading_previous_cell}
			    		<th class="cal_prev"><a href="{previous_url}">&lt;&lt;</a></th>
			    {/heading_previous_cell}
			    {heading_title_cell}
			    	<th class="cal_month" colspan="{colspan}">{heading}</th>
			    {/heading_title_cell}
			    {heading_next_cell}
			    	<th class="cal_next"><a href="{next_url}">&gt;&gt;</a></th>
			   	{/heading_next_cell}
        		{heading_row_end}
        			</tr>
        		{/heading_row_end}
			    
			    {week_day_cell}
			    	<th class="day_header">{week_day}</th>
			    {/week_day_cell}
			    
			    {cal_row_start}<tr class="days">{/cal_row_start}
			    {cal_cell_start}<td class="day">{/cal_cell_start}

			    
			    {cal_cell_content}
			    	<div class="day_listing">{day}</div>
			    	<div class="cal_content"><div id="'.$ano.'-'.$mes.'-{day}" class="day_ext">{content}</div></div>
			    {/cal_cell_content}
			    {cal_cell_content_today}
			    	<div class="today"><div class="day_listing" data_day={day}>{day}</div>
			    		<div class="cal_content"><div id="'.$ano.'-'.$mes.'-{day}" class="day_ext">{content}</div></div>
			    	</div>
			    {/cal_cell_content_today}
			    
			    {cal_cell_no_content}
			    	<div class="day_listing">{day}</div>&nbsp;
			    {/cal_cell_no_content}
			    
			    {cal_cell_no_content_today}
			    	<div class="today">
			    		<div class="day_listing">{day}</div>
			    	</div>
			    {/cal_cell_no_content_today}
		    {table_close}</table>{/table_close}'
		);

		$this->load->library("calendar", $config);

		$countConsultas = $this->get_count_consultas_calendario($ano, $mes); 

		$this->data['calendario'] = $this->calendar->generate($ano, $mes, $countConsultas);
	}
	public function gerarConsultas() {
		//carregue os MODELs necessários aqui
		$dia_semana = date("w");
		$mes = date("m");
		$data_atual = date('Y-m-d');

		$consultaStatus = $this->db
				->from("frequencias AS f")
				->where(array("f.createdAt" => date("Y-m-d"),
							"f.status" => 1))
				->get()->row();
		$result = array();
		
		if($consultaStatus){
			$result['sucesso'] = false;
		} else {
			
			$resultConsultaDia = array();
			$resultConsultaDia = $this->db
							->select("h.id as horarios_id, ds.id as dias_semana_id, ic.id as item_consulta_id, c.id as consultas_id")
							->from("item_consulta AS ic")
							->join("horarios_profissionais as hp", "ic.horarios_id = hp.id")
							->join("horarios as h", "hp.horarios_id = h.id")
							->join("dias_semana as ds", "ic.dia_semana_id = ds.id")
							->join("periodo_consulta as pc", "ic.periodo_consulta_id = pc.id")
							->join("consultas as c", "ic.consultas_id = c.id")
							->where(array("ic.dia_semana_id" => $dia_semana,
											"month(pc.data)" => $mes,
											"ic.status" => 1))
							->get();
			if($resultConsultaDia->num_rows()) {
				$new_consulta = $resultConsultaDia->result();

				foreach ($new_consulta as $row => $consulta) {
					$inserirConsulta['horarios_id'] 	 = $consulta->horarios_id;
					$inserirConsulta['dias_semana_id']   = $consulta->dias_semana_id;
					$inserirConsulta['item_consulta_id'] = $consulta->item_consulta_id;
					$inserirConsulta['consultas_id'] 	 = $consulta->consultas_id;
					$inserirConsulta['data'] 		     = NULL;
					$inserirConsulta['presenca'] 		 = 0;
					$inserirConsulta['status'] 			 = 1;
					$inserirConsulta['createdAt'] 		 = date("Y-m-d");
					$inserirConsulta['updatedAt'] 		 = NULL;

					// arShow($inserirConsulta); exit;
					$this->db->insert("frequencias", $inserirConsulta);
				}
			}
    		$result['sucesso'] = true;
    		$result['consultas_abertas'] = $this->consultas_abertas();
    	}

	  	header('Content-Type: application/json');
		echo json_encode($result);
		exit;
	}

	public function consultas_abertas(){
		//carregue os MODELs necessários aqui
		$dia_semana_id = date("w", strtotime(date('Y-m-d')));
		$periodo_consulta_id = date("m");

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
						  "fr.status" => 1,
						  "fr.presenca" => 0))
			->order_by("fr.horarios_id", "ASC")
			->get()->result();
		
	return $resultItemConsulta;

	}

	public function calendario_profissionais() {
		$periodo_consulta_id = date("m");
		$profissional_id = $this->uri->segment(3);
		
		$resultAgendaConsulta = $this->db
			->select("ic.id, h.desc_horario, ds.desc_dia_semana, pc.data, ic.status, c.id as cod_consulta, p.nome_pac, pr.nome_prof, e.nome_espec, pl.nome_plano")
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

	public function calendar() {}
	public function eventos() {

		$eventos = array(
			array(
				'id' 	=> 1,
				'title' => 'Teste1',
				'start' => '2018-06-14T14:30:00',
				'end'	=> '2018-06-14T18:00:00'
			),
			array(
				'id' 	=> 2,
				'title' => 'Teste2',
				'start' => '2018-06-08T14:30:00',
				'end'	=> '2018-06-08T18:00:00'
			),
			array(
				'id' 	=> 3,
				'title' => 'Teste3',
				'start' => '2018-06-02T14:30:00',
				'end'	=> '2018-06-02T18:00:00'
			),
		);
		echo json_encode($eventos);
	}

	public function get_count_consultas($ano=null, $mes=null) {
		
		$auery = array();
		$query = $this->db
		    ->select("count(fr.id) as title, fr.createdAt as start, fr.createdAt as end")
			->from("frequencias as fr")
			->like("fr.createdAt", "$ano-$mes", "after")
			->group_by("fr.createdAt")
			->get();

		header('Content-Type: application/json');
		echo json_encode($query->result());
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
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */