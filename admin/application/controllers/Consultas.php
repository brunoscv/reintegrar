<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Consultas extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
        $this->load->model("Consultas_model");
        $this->load->model("Pacientes_model");
        $this->load->model("Profissionais_model");
		
		//adicione os campos da busca
        //$camposFiltros["c.id"] = "Cod.";
        $camposFiltros["p.nome_pac"] = "Paciente";
		$camposFiltros["pr.nome_prof"] = "Profissional";
		$camposFiltros["e.nome_espec"] = "Especialidade";
		
		$this->data['campos']    = $camposFiltros;
	}
	
	function index(){
		$user_id = $this->session->userdata('userdata')['id'];
		$admin = $this->session->userdata('userdata')['principal'];

		//arShow($this->session->userdata());exit;
		$perPage = '10';
		$offset = ($this->input->get("per_page")) ? $this->input->get("per_page") : "0";

		$countConsultas = $this->db
							->select("count(c.id) AS quantidade")
                            ->from("consultas AS c")
                            ->join("pacientes as p", "c.pacientes_id = p.id")
							->join("profissionais as pr", "c.profissionais_id = pr.id")
							->join("especialidades as e", "pr.especialidades_id = e.id")
							->get()->row();

		if( !is_null($this->input->get('filtro_valor')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}

		if($admin != 1) {
			$this->db->where("c.profissionais_id", $user_id);
		}
		$quantidadeConsultas = $countConsultas->quantidade;

		
		$resultConsultas = $this->db
                            ->select("c.*, pr.nome_prof, p.nome_pac, e.nome_espec")
                            ->from("consultas AS c")
                            ->join("pacientes AS p", "c.pacientes_id = p.id")
							->join("profissionais AS pr", "c.profissionais_id = pr.id")
							->join("especialidades AS e", "pr.especialidades_id = e.id")
                            ->limit($perPage,$offset)
                            ->get();

		if( !is_null($this->input->get('filtro_field')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}

		if($admin != 1) {
			$this->db->where("c.profissionais_id", $user_id);
		}
		$this->data['listaConsultas'] = $resultConsultas->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("consultas/index")."?";
		$config['total_rows'] = $quantidadeConsultas;
		$config['per_page'] = $perPage;
		
		$this->pagination->initialize($config);
		
		$this->data['paginacao'] = $this->pagination->create_links(); 
	}
    
    function criar_consultas(){
		$this->data['item'] = new stdClass();
		
		//Campos relacionados
        //caso seja necessario adicione os relacionamento aqui
        $pacientes = $this->Pacientes_model->getPacientes();
		$this->data['listaPacientes'] = array();
		$this->data['listaPacientes'][''] = "Escolha um Paciente";
		foreach ($pacientes as $pacientes) {
			$this->data['listaPacientes'][$pacientes->id] = $pacientes->nome_pac;
        }
        $profissionais = $this->Profissionais_model->getProfissionais();
		$this->data['listaProfissionais'] = array();
		$this->data['listaProfissionais'][''] = "Escolha um Profissional";
		foreach ($profissionais as $profissionais) {
			$this->data['listaProfissionais'][$profissionais->id] = $profissionais->nome_prof;
		}
		//fim Campos relacionados
		
		if($this->input->post('enviar')){
			
			if( $this->form_validation->run('Consultas') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				//Preenche objeto com as informações do formulário		
				$consulta	= array();
                //$consulta['id'] 		        = $this->input->post('id', TRUE);
                $consulta['pacientes_id'] 		= $this->input->post('pacientes_id', TRUE);
                $consulta['profissionais_id'] 	= $this->input->post('profissionais_id', TRUE);
                $consulta['status'] 		    = 1;
                $consulta['createdAt'] 		    = date("Y-m-d");
                
                $this->db->insert("consultas", $consulta);
                $consultas_id = $this->db->insert_id();
                
                //Insere os dados do atendimento na tabela de atendimeentos
                $atendimento['consultas_id']        = $consultas_id;
                $atendimento['qtd_atendimentos'] 	= $this->input->post('qtd_atendimentos', TRUE);
				$atendimento['freq_atendimentos'] 	= $this->input->post('freq_atendimentos', TRUE);
				$atendimento['data_inicio'] 		= formatar_data($this->input->post('data_inicio', TRUE));
				$atendimento['data_fim'] 			= formatar_data($this->input->post('data_fim', TRUE));
                $atendimento['data_ref'] 	        = date("Y-m-d");
                $atendimento['status'] 	            = 1;
                $atendimento['createdAt'] 	        = date("Y-m-d");

                $this->db->insert("atendimentos", $atendimento);
                $atendimentos_id = $this->db->insert_id();

                $this->gerarAtendimentos($consultas_id, $atendimentos_id);
	
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('consultas/index');
			}
		} 
	}

	public function editar_consultas(){
		$id = $this->uri->segment(3);
		
		//Campos relacionados
		//caso seja necessario adicione os relacionamento aqui
		//fim Campos relacionados
		

		$consulta = $this->db
						->from("consultas AS m")
						->where("id", $id)->get()->row();

		if(!$consulta){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('consultas/index');
		} else {
			$this->data['item'] = $consulta;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('Consultas') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$consulta	= array();
                    //$consulta['id']	= $this->input->post('id', true);
                    $consulta['pacientes_id']	    = $this->input->post('pacientes_id', true);
                    $consulta['profissionais_id']	= $this->input->post('profissionais_id', true);
                    $consulta['status']	            = $this->input->post('status', true);
                    $consulta['createdAt']	        = $this->input->post('createdAt', true);
                    $consulta['updatedAt']	        = $this->input->post('updatedAt', true);
					
					$this->db->where("id",$id);
					$this->db->update("consultas",$consulta);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$consulta->id}</b> atualizado!");
					redirect('consultas/index');
				}
			}
		}
	}
	
	public function delete_consultas($id){
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
				
				$this->session->set_flashdata("msg_success", "Registro excluido com sucesso!");
				redirect('consultas/index');
			}
		}
	}
	
	public function atendimentos($consultas_id = null){
	
		$perPage = '10';
		$offset = ($this->input->get("per_page")) ? $this->input->get("per_page") : "0";

		$countAtendimentos = $this->db
			->select("count(a.id) AS quantidade")
			->from("atendimentos AS a")
			->join("consultas AS c", "a.consultas_id = c.id")
			->join("pacientes AS p", "c.pacientes_id = p.id")
			->join("profissionais AS pr", "c.profissionais_id = pr.id")
			->get()->row();


		if( !is_null($this->input->get('filtro_field')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		if($consultas_id) {
			$this->db->where("consultas_id", $consultas_id);
		}
		$quantidadeAtendimentos = $countAtendimentos->quantidade;


		$resultAtendimentos = $this->db
			->select("a.id, c.id AS consultas_id, p.nome_pac, pr.nome_prof, a.qtd_atendimentos, a.freq_atendimentos, a.data_inicio, a.data_fim, a.status, a.createdAt")
			->from("atendimentos AS a")
			->join("consultas AS c", "a.consultas_id = c.id")
			->join("pacientes AS p", "c.pacientes_id = p.id")
			->join("profissionais AS pr", "c.profissionais_id = pr.id")
			->limit($perPage,$offset)
			->get();
		
		if( !is_null($this->input->get('filtro_field')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		if($consultas_id) {
			$this->db->where("consultas_id", $consultas_id);
		}
		$this->data['listaAtendimentos'] = $resultAtendimentos->result();
		

		$this->load->library('pagination');
		$config['base_url'] = site_url("consultas/atendimentos")."?";
		$config['total_rows'] = $quantidadeAtendimentos;
		$config['per_page'] = $perPage;
		$this->pagination->initialize($config);
		
		$this->data['paginacao'] = $this->pagination->create_links(); 
	}

	public function renovar_atendimentos($consultas_id, $atendimentos_id){
		$consultas_id = $this->uri->segment(3);
		$atendimentos_id = $this->uri->segment(4);
		$itemSessao = array();
		$itemSessao['status'] = 0;
		$this->db->where(array("as.consultas_id" => $consultas_id, "as.atendimentos_id" => $atendimentos_id, "as.status" => 1));
		$this->db->update("atendimentos_sessoes AS as", $itemSessao);

		$atendimento = array();
        $atendimento = $this->db
						->from("atendimentos AS a")
						->where("id", $atendimentos_id)
                        ->get()->result();
        //arShow($atendimento); exit;
            
        for ($i=1; $i <= $atendimento[0]->qtd_atendimentos ; $i++) {
            $atendimentosSessoes = array();
            $atendimentosSessoes['atendimentos_id'] 	= $atendimentos_id;
            $atendimentosSessoes['data_ref'] 		    = date("Y-m-d");
			$atendimentosSessoes['consultas_id'] 		= $consultas_id;
			$atendimentosSessoes['presenca'] 		 	= 0;
            $atendimentosSessoes['status'] 		 		= 1;
			$atendimentosSessoes['createdAt'] 	 		= date("Y-m-d");
			
			//arShow($atendimentosSessoes);
			
			$this->db->insert("atendimentos_sessoes", $atendimentosSessoes);
			
        }
	}

    public function gerarAtendimentos($consultas_id, $atendimentos_id) {
        $atendimento = array();
        $atendimento = $this->db
						->from("atendimentos AS a")
						->where("id", $atendimentos_id)
                        ->get()->result();
        //arShow($atendimento); exit;
            
        for ($i=1; $i <= $atendimento[0]->qtd_atendimentos ; $i++) {
            $atendimentosSessoes = array();
            $atendimentosSessoes['atendimentos_id'] 	= $atendimentos_id;
            $atendimentosSessoes['data_ref'] 		    = date("Y-m-d");
			$atendimentosSessoes['consultas_id'] 		= $consultas_id;
			$atendimentosSessoes['presenca'] 		 	= 0;
            $atendimentosSessoes['status'] 		 		= 1;
			$atendimentosSessoes['createdAt'] 	 		= date("Y-m-d");
			
            $this->db->insert("atendimentos_sessoes", $atendimentosSessoes);
        }
        return $atendimentosSessoes;     
	}	

    private function _inserir_atendimentos_realizados() {

	}
	
	function criar_atendimentos(){
		$this->data['item'] = new stdClass();
		
		//Campos relacionados
		//caso seja necessario adicione os relacionamento aqui
		//fim Campos relacionados

		if($this->input->post('enviar')){
			if( $this->form_validation->run('Atendimentos') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				//Preenche objeto com as informações do formulário			
				$atendimento = array();
				$atendimento['id'] 				  = $this->input->post('id', TRUE);
				$atendimento['consultas_id'] 	  = $this->input->post('consultas_id', TRUE);
				$atendimento['qtd_atendimentos']  = $this->input->post('qtd_atendimentos', TRUE);
				$atendimento['freq_atendimentos'] = $this->input->post('freq_atendimentos', TRUE);
				$atendimento['data_ref'] 		  = $this->input->post('data_ref', TRUE);
				$atendimento['status'] 			  = $this->input->post('status', TRUE);
				$atendimento['createdAt'] 		  = $this->input->post('createdAt', TRUE);
				$atendimento['updatedAt'] 		  = $this->input->post('updatedAt', TRUE);
			
				$this->db->insert("atendimentos", $atendimento);
                $atendimentos_id = $this->db->insert_id();

                $this->gerarAtendimentos($consultas_id, $atendimentos_id);
	
				$this->data['msg_success'] = $this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('atendimentos/index');
			}
		}   	
  	}
    
	public function editar_atendimentos(){
		$id = $this->uri->segment(3);
		
		//Campos relacionados
		//caso seja necessario adicione os relacionamento aqui
		//fim Campos relacionados
		

		$atendimento = $this->db
						->from("atendimentos AS m")
						->where("id", $id)->get()->row();

		if(!$atendimento){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('atendimentos/index');
		} else {
			$this->data['item'] = $atendimento;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('Atendimentos') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$atendimento	= array();
											$atendimento['id']	= $this->input->post('id', true);
											$atendimento['consultas_id']	= $this->input->post('consultas_id', true);
											$atendimento['qtd_atendimentos']	= $this->input->post('qtd_atendimentos', true);
											$atendimento['freq_atendimentos']	= $this->input->post('freq_atendimentos', true);
											$atendimento['data_ref']	= $this->input->post('data_ref', true);
											$atendimento['status']	= $this->input->post('status', true);
											$atendimento['createdAt']	= $this->input->post('createdAt', true);
											$atendimento['updatedAt']	= $this->input->post('updatedAt', true);
					
					$this->db->where("id",$id);
					$this->db->update("atendimentos",$atendimento);
				
					$this->data['msg_success'] = $this->session->set_flashdata("msg_success", "Registro <b>#{$atendimento->id}</b> atualizado!");
					redirect('atendimentos/index');
				}
			}
		}
	}
	
	public function delete_atendimentos($id){
		$id = $this->uri->segment(3);
		
		$atendimento = $this->db
						->from("atendimentos AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $atendimento;
		
		if( !$atendimento ){
			$this->data['msg_error'] = $this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('atendimentos/index');
		} else {
			$this->data['item'] = $atendimento;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", $atendimento->id);
				$this->db->delete("atendimentos");
				
				$this->data['msg_success'] = $this->session->set_flashdata("msg_success", "Registro excluido com sucesso!");
				redirect('atendimentos/index');
			}
		}
	}

	public function sessoes($consultas_id = null, $atendimentos_id = null){
	
		$perPage = '20';
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
		if(!$consultas_id) {
			$countAtendimentosSessoes = 
				$this->db
					 ->select("count(as.id) AS quantidade")
					 ->from("atendimentos_sessoes AS as")
					//  ->join("consultas AS c", "a.consultas_id = c.id")
					//  ->join("pacientes AS p", "c.pacientes_id = p.id")
					//  ->join("profissionais AS pr", "c.profissionais_id = pr.id")
					->where("as.status", 1)
					->get()->row();
		} else {
			$countAtendimentosSessoes = 
				$this->db
					 ->select("count(as.id) AS quantidade")
					 ->from("atendimentos_sessoes AS as")
					//  ->join("consultas AS c", "a.consultas_id = c.id")
					//  ->join("pacientes AS p", "c.pacientes_id = p.id")
					//  ->join("profissionais AS pr", "c.profissionais_id = pr.id")
					 ->where(array("as.consultas_id" => $consultas_id, "as.atendimentos_id" => $atendimentos_id, "as.status" => 1))
					 ->get()->row();
		}
		$quantidadeAtendimentosSessoes = $countAtendimentosSessoes->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		if(!$consultas_id) {
			$resultAtendimentosSessoes = 
				$this->db
					 ->select("as.id, c.id AS consultas_id, as.atendimentos_id, p.nome_pac, pr.nome_prof, as.data_atendimento, as.presenca, as.status, as.createdAt")
					//  ->select("*")
					 ->from("atendimentos_sessoes AS as")
					 ->join("consultas AS c", "as.consultas_id = c.id")
					 ->join("pacientes AS p", "c.pacientes_id = p.id")
					 ->join("profissionais AS pr", "c.profissionais_id = pr.id")
					 ->where("as.status", 1)
					 ->limit($perPage,$offset)
					 ->get();
		} else {
			$resultAtendimentosSessoes = 
				$this->db
					 ->select("as.id, c.id AS consultas_id, as.atendimentos_id, p.nome_pac, pr.nome_prof, as.data_atendimento, as.presenca, as.status, as.createdAt")
					 ->from("atendimentos_sessoes AS as")
					 ->join("consultas AS c", "as.consultas_id = c.id")
					 ->join("pacientes AS p", "c.pacientes_id = p.id")
					 ->join("profissionais AS pr", "c.profissionais_id = pr.id")
					 ->where(array("as.consultas_id" => $consultas_id, "as.atendimentos_id" => $atendimentos_id, "as.status" => 1))
					 ->limit($perPage,$offset)
					 ->get();
		}
		$this->data['listaAtendimentos'] = $resultAtendimentosSessoes->result();
		
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("consultas/sessoes/". $consultas_id . "/" . $atendimentos_id)."?";
		$config['total_rows'] = $quantidadeAtendimentosSessoes;
		$config['per_page'] = $perPage;
		$this->pagination->initialize($config);
		
		$this->data['paginacao'] = $this->pagination->create_links(); 
	}

	public function mudar_presenca_consulta($sessoes_id, $presenca, $data_atendimento) {
		
		$result = array();
		$sessoes = array();
		$sessoes = $this->db->from("atendimentos_sessoes AS as")->where("id", $sessoes_id)->get()->row();
		
		if(!$sessoes){
			$result['sucesso'] = false;
		} else {
			$itemSessao			   			= array();
			$itemSessao['updatedAt'] 		= date("Y-m-d");
			$itemSessao['data_atendimento'] = str_replace('%20', ' ', $data_atendimento);
			
			if($presenca == 1) {
				$itemSessao['presenca']	= 0;
				
				$this->db->where("id",$sessoes_id);
				$this->db->update("atendimentos_sessoes", $itemSessao);
			} else {
				$itemSessao['presenca'] = 1;
				
				$this->db->where("id",$sessoes_id);
				$this->db->update("atendimentos_sessoes", $itemSessao);
			}

			$result['sucesso'] = true;
			$result['presenca'] = $itemSessao;
			//$result['data_atendimento'] = $data_atendimento;
		}
		header('Content-Type: application/json');
		echo json_encode($result);
		exit;
	}	
}

/* End of file Consultases.php */
/* Location: ./system/application/controllers/Consultases.php */