<?php
class ItemConsulta extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("ItemConsulta_model");
		
		//adicione os campos da busca
		$camposFiltros["i.id"] = "Id";
		$camposFiltros["i.horarios_id"] = "Horário";
		$camposFiltros["i.dia_semana_id"] = "Dia Semana";
		$camposFiltros["i.status"] = "Status";
		$camposFiltros["i.periodo_consulta_id"] = "Periodo Consuta";
		$camposFiltros["i.consultas_id"] = "Cod Consulta";
		$camposFiltros["i.createdAT"] = "createdAT";
		$camposFiltros["i.updatedAt"] = "updatedAt";

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
		$countItemConsulta = $this->db
							->select("count(i.id) AS quantidade")
							->from("item_consulta AS i")
							->get()->row();
		$quantidadeItemConsulta = $countItemConsulta->quantidade;
		
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
									->select("*")
									->from("item_consulta AS i")
									->limit($perPage,$offset)
									->get();
		
		$this->data['listaItemConsulta'] = $resultItemConsulta->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("item_consulta/index")."?";
		$config['total_rows'] = $quantidadeItemConsulta;
		$config['per_page'] = $perPage;
		
		$this->pagination->initialize($config);
		
		$this->data['paginacao'] = $this->pagination->create_links(); 
	}
    
    function criar(){
		$this->data['item'] = new stdClass();
		
		//Campos relacionados
		//caso seja necessario adicione os relacionamento aqui
		//fim Campos relacionados
		
		
		if($this->input->post('enviar')){
			
			if( $this->form_validation->run('ItemConsulta') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				//Preenche objeto com as informações do formulário
								
				$itemconsulta	= array();
				$itemconsulta['id'] 		= $this->input->post('id', TRUE);
				$itemconsulta['horarios_id'] 		= $this->input->post('horarios_id', TRUE);
				$itemconsulta['dia_semana_id'] 		= $this->input->post('dia_semana_id', TRUE);
				$itemconsulta['status'] 		= $this->input->post('status', TRUE);
				$itemconsulta['periodo_consulta_id'] 		= $this->input->post('periodo_consulta_id', TRUE);
				$itemconsulta['consultas_id'] 		= $this->input->post('consultas_id', TRUE);
				$itemconsulta['createdAT'] 		= $this->input->post('createdAT', TRUE);
				$itemconsulta['updatedAt'] 		= $this->input->post('updatedAt', TRUE);
				$this->db->insert("item_consulta", $itemconsulta);
	
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('itemconsulta/index');
			}
		} 
    	
    }

    function ver(){
		$periodo_consulta_id = $this->uri->segment(3);

		$resultItemConsulta = $this->db
								->select("ic.id, h.desc_horario, ds.desc_dia_semana, pc.data, ic.status, c.id as cod_consulta,
		 							      p.nome_pac, pr.nome_prof, e.nome_espec, pl.nome_plano, ic.periodo_consulta_id")
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
								->where("ic.periodo_consulta_id", $periodo_consulta_id)
								->get();
		$this->data['listaItemConsulta'] = $resultItemConsulta->result();
    }

  public function presenca_consulta(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$consultaStatus = $this->db
				->from("frequencias AS f")
				->where("f.id",$id)
				->get()->row();
		$result = array();
		
		if(!$consultaStatus){
			$result['sucesso'] = false;
		} else {
			$this->data['item'] = $consultaStatus;
			
			$frequencia	= array();
			$frequencia['id']	= $id;
				if ($consultaStatus->presenca == 1){
					$frequencia['presenca']	= 0;
				} else {
					$frequencia['presenca']	= 1;
				}
			$frequencia['updatedAt'] = date("Y-m-d");
			$this->db->where("id", $id);
			$this->db->update("frequencias",$frequencia);

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

	public function ausencia_consulta(){
		//carregue os MODELs necessários aqui
		$periodo_consulta_id = $this->uri->segment(3);
		$id = $this->uri->segment(4);

		$item = $this->db
					->select("ic.id, h.desc_horario, h.id as horarios_id, ds.id as dia_semana_id, ds.desc_dia_semana, pc.data, ic.status, 		c.id as cod_consulta, c.valor, p.id as paciente_id, pr.id as profissional_id, e.id as especialidade_id,
								pl.id as plano_id , pp.id as plano_procedimento_id,
						      p.nome_pac, pr.nome_prof, e.nome_espec, pl.nome_plano, ic.periodo_consulta_id")
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
					->where(array("ic.periodo_consulta_id" => $periodo_consulta_id,
								  "ic.id" => $id))
					->get()->result();
		if(!$item){
			$this->data['msg_error'] = $this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('consultas/index');
		} else {
			$this->data['item'] = $item;
			if( $this->input->post('enviar') ){
				//FAZER A MSG DE ERRO SE JÁ TIVER UMA DATA IGUAL NA HORA DE MARCAR A CONSULTA
					$itemconsulta	= array();
					// $itemconsulta['id']						= $item->id;
					$itemconsulta['horarios_id']			= $item[0]->horarios_id;
					$itemconsulta['dias_semana_id']			= $item[0]->dia_semana_id;
					$itemconsulta['status']					= 0;
					$data									= $this->input->post("data", true);
					$itemconsulta['data']					= formatar_data($data);
					$itemconsulta['item_consulta_id']		= $item[0]->id;
					$itemconsulta['consultas_id']			= $item[0]->cod_consulta;
					$itemconsulta['createdAt']				= date("Y-m-d");

					//checkar se há algum registro na tabela de prensenças naquele mesmo dia
					//da tentativa
					$frequencia = $this->db
										->from("frequencias")
										->where(array("data" => $itemconsulta['data'],
													  "item_consulta_id" => $id))
										->get()->row();
					if($frequencia) {
						$this->data['msg_error'] = $this->session->set_flashdata("msg_error", "Já existe uma ausência para essa consulta. Por favor acesse o Menu de Frequecias!");
						redirect("dashboard/");
					} else {
						$this->db->insert("frequencias",$itemconsulta);

						//Insere na tabela de faturamento os dados da consulta
							$faturamento = array();							
							$faturamento["pacientes_id"] 	 		= $item[0]->paciente_id;
							$faturamento["profissionais_id"] 		= $item[0]->profissional_id;
							$faturamento["especialidades_id"] 		= $item[0]->especialidade_id;
							$faturamento["plano_procedimento_id"] 	= $item[0]->plano_procedimento_id;
							$faturamento["consultas_id"]		 		= $item[0]->cod_consulta;
							$faturamento["item_consulta_id"] 		= $item[0]->id;
							$faturamento["valor"] 			 		= $item[0]->valor;
							$faturamento["tipo"] 			 		= 2;
							$faturamento["status"] 			 		= 0;
							$faturamento["createdAt"] 		 		= date("Y-m-d");

							$this->db->insert("faturamento",$faturamento);
						
						//Colocar o status do item como 1, para indicar que aquela consulta aconteceu
						// $statusItemConsulta = array();
						// $statusItemConsulta["status"] = 1;
						// $this->db->where("id",$id);
						// $this->db->update("item_consulta",$statusItemConsulta);
						//naquele periodo correto
						$this->data['msg_success'] = $this->session->set_flashdata("msg_success", "Ausência do paciente cadastrada com sucesso!");
						redirect("dashboard/");
					}
			}
		}
	}

	public function gerarFaturamento() {
		
	}
    
   
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$itemconsulta = $this->db
						->from("item_consulta AS m")
						->where("id", $id)->get()->row();

		if(!$itemconsulta){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('itemconsulta/index');
		} else {
			$this->data['item'] = $itemconsulta;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('ItemConsulta') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$itemconsulta	= array();
					$itemconsulta['id']	= $this->input->post('id', true);
					$itemconsulta['horarios_id']	= $this->input->post('horarios_id', true);
					$itemconsulta['dia_semana_id']	= $this->input->post('dia_semana_id', true);
					$itemconsulta['status']	= $this->input->post('status', true);
					$itemconsulta['periodo_consulta_id']	= $this->input->post('periodo_consulta_id', true);
					$itemconsulta['consultas_id']	= $this->input->post('consultas_id', true);
					$itemconsulta['createdAT']	= $this->input->post('createdAT', true);
					$itemconsulta['updatedAt']	= $this->input->post('updatedAt', true);

					$this->db->where("id",$id);
					$this->db->update("item_consulta",$itemconsulta);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$itemconsulta->id}</b> atualizado!");
					redirect('itemconsulta/index');
				}
			}
		}
	}
	
	public function delete($id){
		$id = $this->uri->segment(3);
		
		$itemconsulta = $this->db
						->from("item_consulta AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $itemconsulta;
		
		if( !$itemconsulta ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('itemconsulta/index');
		} else {
			$this->data['item'] = $itemconsulta;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", $itemconsulta->id);
				$this->db->delete("item_consulta");
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('itemconsultaindex');
			}
		}
	}
}

/* End of file Item_consultas.php */
/* Location: ./system/application/controllers/Item_consultas.php */