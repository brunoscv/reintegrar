<?php
class PeriodoConsulta extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("PeriodoConsulta_model");
		
		//adicione os campos da busca
		$camposFiltros["p.id"] = "Id";
		$camposFiltros["p.data"] = "Data Atendimento";
		$camposFiltros["p.status"] = "Status";
		$camposFiltros["p.consultas_id"] = "Cod. Consulta";
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
		$countPeriodoConsulta = $this->db
							->select("count(p.id) AS quantidade")
							->from("periodo_consulta AS p")
							->get()->row();
		$quantidadePeriodoConsulta = $countPeriodoConsulta->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultPeriodoConsulta = $this->db
									->select("*")
									->from("periodo_consulta AS p")
									->limit($perPage,$offset)
									->get();
		
		$this->data['listaPeriodoConsulta'] = $resultPeriodoConsulta->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("periodoconsulta/index")."?";
		$config['total_rows'] = $quantidadePeriodoConsulta;
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
			
			if( $this->form_validation->run('PeriodoConsulta') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				//Preenche objeto com as informações do formulário
								
				$periodoConsulta	= array();
				$periodoConsulta['id'] 		= $this->input->post('id', TRUE);
				$periodoConsulta['data'] 		= $this->input->post('data', TRUE);
				$periodoConsulta['status'] 		= $this->input->post('status', TRUE);
				$periodoConsulta['consultas_id'] 		= $this->input->post('consultas_id', TRUE);
				$periodoConsulta['createdAt'] 		= $this->input->post('createdAt', TRUE);
				$periodoConsulta['updatedAt'] 		= $this->input->post('updatedAt', TRUE);
				$this->db->insert("periodo_consulta", $periodoConsulta);
	
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('periodoconsulta/index');
			}
		} 
    	
    }

    function ver(){
		$consulta_id = $this->uri->segment(3);
		
		$resultConsultas = $this->db
								->select("pc.id, pc.consultas_id, pr.nome_prof, p.nome_pac, pl.nome_plano, e.nome_espec, pp.valor, pc.dia_vencimento, pc.data, pc.status, pc.createdAt")
								->from("periodo_consulta AS pc")
								->join("consultas as c", "pc.consultas_id = c.id")
								->join("pacientes as p", "c.pacientes_id = p.id")
								->join("profissionais as pr", "c.profissionais_id = pr.id")
								->join("especialidades as e", "pr.especialidades_id = e.id")
								->join("plano_procedimento as pp", "c.plano_procedimento_id = pp.id")
								->join("planos as pl", "pp.planos_id = pl.id")
								->where("pc.consultas_id", $consulta_id)
								->get();
		$this->data['listaPeriodo'] = $resultConsultas->result();

		//Campos relacionados
		//caso seja necessario adicione os relacionamento aqui
		// $planos = $this->Matriculas_model->getPlanos();
		// $this->data['listaPlanos'] = array();
		// $this->data['listaPlanos'][''] = "Selecione um Plano";
		// foreach ($planos as $plano) {
		// 	$this->data['listaPlanos'][$plano->id] = $plano->descricao;
		// }
		//Fim dos campos relacionados
    }
    
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$periodoConsulta = $this->db
						->from("periodo_consulta AS m")
						->where("id", $id)->get()->row();

		if(!$periodoConsulta){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('periodoconsulta/index');
		} else {
			$this->data['item'] = $periodoConsulta;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('PeriodoConsulta') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$periodoConsulta	= array();
					$periodoConsulta['id']	= $this->input->post('id', true);
					$periodoConsulta['data']	= $this->input->post('data', true);
					$periodoConsulta['status']	= $this->input->post('status', true);
					$periodoConsulta['consultas_id']	= $this->input->post('consultas_id', true);
					$periodoConsulta['createdAt']	= $this->input->post('createdAt', true);
					$periodoConsulta['updatedAt']	= $this->input->post('updatedAt', true);

					$this->db->where("id",$id);
					$this->db->update("periodo_consulta",$periodoConsulta);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$periodoConsulta->id}</b> atualizado!");
					redirect('periodoconsulta/index');
				}
			}
		}
	}
	
	public function delete($id){
		$id = $this->uri->segment(3);
		
		$periodoConsulta = $this->db
						->from("periodo_consulta AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $periodoConsulta;
		
		if( !$periodoConsulta ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('periodoconsulta/index');
		} else {
			$this->data['item'] = $periodoConsulta;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", $periodoConsulta->id);
				$this->db->delete("periodo_consulta");
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('periodoconsultaindex');
			}
		}
	}
}

/* End of file Periodo_consultas.php */
/* Location: ./system/application/controllers/Periodo_consultas.php */