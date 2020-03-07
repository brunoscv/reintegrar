<?php
class Profissionais extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Profissionais_model");
		$this->load->model("Especialidades_model");
		
		//adicione os campos da busca
		// $camposFiltros["p.id"] = "Codigo";
		$camposFiltros["p.nome_prof"] = "Nome";
		// $camposFiltros["p.telefone_prof"] = "Telefone";
		// $camposFiltros["p.email_prof"] = "Email";
		// $camposFiltros["p.status"] = "Status";
		// $camposFiltros["p.createdAt"] = "createdAt";
		// $camposFiltros["p.updatedAt"] = "updatedAt";
		// $camposFiltros["p.especialidades_id"] = "especialidades_id";

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
									->select("p.id, p.nome_prof, p.telefone_prof, p.email_prof, e.nome_espec, p.status, p.createdAt")
									->from("profissionais AS p")
									->join("especialidades AS e", "p.especialidades_id = e.id")
									->order_by("p.id", "desc")
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
		//caso seja necessario adicione os relacionamento aqui
			$especialidades = $this->Especialidades_model->getEspecialidades();
			$this->data['listaEspecialidades'] = array();
			$this->data['listaEspecialidades'][''] = "Selecione uma Especialidade";
			foreach ($especialidades as $especialidade) {
				$this->data['listaEspecialidades'][$especialidade->id] = $especialidade->nome_espec;
			}
		//fim Campos relacionados
		
		
		if($this->input->post('enviar')){
			
			if( $this->form_validation->run('Profissionais') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				//Preenche objeto com as informações do formulário
								
				$profissionai	= array();
				//$profissionai['id'] 		= $this->input->post('id', TRUE);
				$profissionai['nome_prof'] 			= $this->input->post('nome_prof', TRUE);
				$profissionai['telefone_prof'] 		= $this->input->post('telefone_prof', TRUE);
				$profissionai['email_prof'] 		= $this->input->post('email_prof', TRUE);
				$profissionai['status'] 			= 1;
				$profissionai['createdAt'] 			= date("Y-m-d");
				$profissionai['especialidades_id'] 	= $this->input->post('especialidades_id', TRUE);
				
				$this->db->insert("profissionais", $profissionai);

				//insere os horarios em branco para o profissional recém cadastrado
				$profissionais_id = $this->db->insert_id();
				$this->setHorariosProfissionais($profissionais_id);

				$this->data['msg_success'] = $this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('profissionais/index');
			}
		} 
    	
    }
    
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$profissionai = $this->db
						->from("profissionais AS m")
						->where("id", $id)->get()->row();

		//Campos relacionados
		//caso seja necessario adicione os relacionamento aqui
			$especialidades = $this->Especialidades_model->getEspecialidades();
			$this->data['listaEspecialidades'] = array();
			foreach ($especialidades as $especialidade) {
				$this->data['listaEspecialidades'][$especialidade->id] = $especialidade->nome_espec;
			}
		//fim Campos relacionados

		if(!$profissionai){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('profissionais/index');
		} else {
			$this->data['item'] = $profissionai;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('Profissionais') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$profissionai	= array();
					$profissionai['id']					= $this->input->post('id', true);
					$profissionai['nome_prof']			= $this->input->post('nome_prof', true);
					$profissionai['telefone_prof']		= $this->input->post('telefone_prof', true);
					$profissionai['email_prof']			= $this->input->post('email_prof', true);
					$profissionai['status']				= 1;
					$profissionai['updatedAt']			= date("Y-m-d");
					$profissionai['especialidades_id']	= $this->input->post('especialidades_id', true);

					$this->db->where("id",$id);
					$this->db->update("profissionais",$profissionai);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$profissionai->id}</b> atualizado!");
					redirect('profissionais/index');
				}
			}
		}
	}
	
	public function delete($id){
		$id = $this->uri->segment(3);
		
		$profissionai = $this->db
						->from("profissionais AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $profissionai;
		
		if( !$profissionai ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('profissionais/index');
		} else {
			$this->data['item'] = $profissionai;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", $profissionai->id);
				$this->db->delete("profissionais");
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('profissionaisindex');
			}
		}
	}

	/* Dependent Functions */

	public function setHorariosProfissionais($profissionais_id) {
		
		$dias_semana = $this->db
							->select("id, desc_dia_semana, status, createdAt")
							->from("dias_semana as ds")
							->where("status", 1)
							->get()->result();
		$horarios = $this->db
						 ->select("id, desc_horario, status, createdAt")
						 ->from("horarios as h")
						 ->where("status", 1)
						 ->get()->result();

		$horario_profissional = array();
		foreach ($dias_semana as $key => $dia) {
			foreach ($horarios as $key => $horario) {
				$horario_profissional["profissionais_id"] 	= $profissionais_id;
				$horario_profissional["dias_semana_id"] 	= $dia->id;
				$horario_profissional["horarios_id"]		= $horario->id;
				$horario_profissional["status"] 			= 0;
				$horario_profissional["createdAt"] 			= date("Y-m-d");

				$this->db->insert("horarios_profissionais", $horario_profissional);

			}
		}
	}

	public function dia_semana() {
		$profissionais_id = $this->uri->segment(3);

		$profissionais = $this->db
							  ->select("p.id, p.nome_prof, e.nome_espec")
							  ->from("profissionais as p")
							  ->join("especialidades as e", "p.especialidades_id = e.id", "inner" )
							  ->where("p.id", $profissionais_id)
							  ->get()->result();
		$this->data['profissionais'] = $profissionais;
		
		$dias_semana = $this->db
							->select("id, desc_dia_semana, status, createdAt")
							->from("dias_semana as ds")
							->where("status", 1)
							->get()->result();
		$this->data["listaDias"] = $dias_semana;

		$this->data["profissionais_id"] = $profissionais_id; 
	}

	public function horarios() {
		$profissionais_id = $this->uri->segment(3);
		$dias_semana_id   = $this->uri->segment(4);
		
		$profissionais = $this->db
							  ->select("p.id, p.nome_prof, e.nome_espec")
							  ->from("profissionais as p")
							  ->join("especialidades as e", "p.especialidades_id = e.id", "inner" )
							  ->where("p.id", $profissionais_id)
							  ->get()->result();
		$this->data['profissionais'] = $profissionais;

		$horarios = $this->db
							->select("hp.id, hp.profissionais_id, hp.dias_semana_id, ds.desc_dia_semana, 
									hp.horarios_id, h.desc_horario, hp.status, hp.createdAt")
							->from("horarios_profissionais as hp")
							->join("dias_semana as ds", "hp.dias_semana_id = ds.id")
							->join("horarios as h", "hp.horarios_id = h.id")
							->where(array("profissionais_id" => $profissionais_id,
											"dias_semana_id" => $dias_semana_id))
							->get()->result();
		$this->data["listaHorarios"] = $horarios;

		$this->data["profissionais_id"] = $profissionais_id; 
	}

	public function salvarHorarioProfissional(){
		//carregue os MODELs necessários aqui
		$horarios_id = $this->uri->segment(3);

		$horario = $this->db
						->from("horarios_profissionais AS hp")
						->where("hp.id", $horarios_id)
						->get()->row();
		$status = $horario->status;

		$result = array();
		$result['sucesso'] = false;

		$this->data['itemHorarioProfissional'] = $horario;
		
		$horarioProfissional	= array();
		//Preenche objeto com as informações do formulário				
		// $turmaAluno['id'] 		= $this->input->post('id', TRUE);
		//$horarioProfissional['matriculas_id'] 	= $frequencia->matriculas_id;		
		$horarioProfissional['updatedAt'] 	 	= date("Y-m-d H:i:s");

		if(!$horario){
			$result['sucesso'] = true;
		} else {
			if ($status == 1){
				$horarioProfissional['status']	= 0;
			} else {
				$horarioProfissional['status']	= 1;
			}
			$this->db->where("id", $horarios_id);
			$this->db->update("horarios_profissionais", $horarioProfissional);
			
			$result['sucesso'] = $horarioProfissional;
		}

		header('Content-Type: application/json');
		echo json_encode($result);
		exit;
	}

	/* End of Dependent Functions */
}

/* End of file Profissionaises.php */
/* Location: ./system/application/controllers/Profissionaises.php */