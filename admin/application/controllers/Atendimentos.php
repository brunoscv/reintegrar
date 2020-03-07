<?php
class Atendimentos extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Atendimentos_model");

		$this->data['user_id'] = $this->session->userdata('userdata')['profissionais_id'];
		$this->data['admin']   = $this->session->userdata('userdata')['principal'];
		
		//adicione os campos da busca
		$camposFiltros["f.id"] 					  = "Id";
		$camposFiltros["f.pacientes_id"] 		  = "Pacientes";
		$camposFiltros["f.profissionais_id"] 	  = "Profissionais";
		$camposFiltros["f.especialidades_id"] 	  = "Especialidades";
		$camposFiltros["f.plano_procedimento_id"] = "Plano/Proced";
		$camposFiltros["f.consultas_id"] 		  = "Consultas";
		$camposFiltros["f.item_consulta_id"] 	  = "Item Consulta";
		$camposFiltros["f.valor"] 				  = "Valor";
		$camposFiltros["f.tipo"] 				  = "Tipo Faturamento";
		$camposFiltros["f.status"] 				  = "Status";
		$camposFiltros["f.createdAt"] 			  = "Criado";
		$camposFiltros["f.updatedAt"] 			  = "Modificado";
		$this->data['campos']    				  = $camposFiltros;
	}
	
	public function index(){
		$perPage = '100';
		$offset = ($this->input->get("per_page")) ? $this->input->get("per_page") : "0";

		$displayed = ($this->data['admin'] != 1) ? $displayed = "style='display:none;'" : $displayed = "";
		$this->data['displayed'] = $displayed;


		if($this->data['admin'] != 1) {
			$this->data['principal'] = $this->data['admin'];
		}
		if( !is_null($this->input->get('busca')) ){
			$data_inicio = $this->db->escape_str($this->input->get('filtro_data_inicio'));
			$data_fim 	 = $this->db->escape_str($this->input->get('filtro_data_fim'));

			if($data_inicio && $data_fim){
				$this->db->where('f.createdAt >= "'. formatar_data($data_inicio) . '" AND f.createdAt <="'. formatar_data($data_fim) .'"');
			}
		}

		$countAtendimentos = $this->db
						->select("count(f.id) AS quantidade")
						->from("faturamento AS f")
						->join("consultas as c", "f.consultas_id = c.id")
						->join("horarios_consulta as hc", "hc.consultas_id = c.id")
						->join("horarios as hr", "hc.horarios_id = hr.id")
						->join("pacientes as p", "c.pacientes_id = p.id")
						->join("profissionais as pr", "c.profissionais_id = pr.id")
						->join("especialidades as e", "c.especialidades_id = e.id")
						->join("plano_procedimento as pp", "c.plano_procedimento_id = pp.id")
						->join("planos as pl", "pp.planos_id = pl.id")
						->order_by("f.createdAt", "DESC")
						->get()->row();				
		if($this->data['admin'] != 1) {
			$this->db->where("c.profissionais_id", $this->data['user_id']);
		}
		$quantidadeAtendimentos = $countAtendimentos->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$data_inicio = $this->db->escape_str($this->input->get('filtro_data_inicio'));
			$data_fim 	 = $this->db->escape_str($this->input->get('filtro_data_fim'));

			if($data_inicio && $data_fim){
				//$this->db->where("data_faturamento BETWEEN","%".$valor."%");
				$this->db->where('f.createdAt >="'. formatar_data($data_inicio) . '" AND f.createdAt <="'. formatar_data($data_fim) .'"');
			}
		}
		
		$resultAtendimentos = $this->db
						->select("f.id, c.id AS consultas_id, f.atendimentos_id, hr.desc_horario, f.valor, f.data_faturamento, f.status, f.tipo,
								p.nome_pac, pr.nome_prof, pl.nome_plano, e.nome_espec, f.createdAt")
						->from("faturamento AS f")
						->join("consultas as c", "f.consultas_id = c.id")
						->join("horarios_consulta as hc", "hc.consultas_id = c.id")
						->join("horarios as hr", "hc.horarios_id = hr.id")
						->join("pacientes as p", "c.pacientes_id = p.id")
						->join("profissionais as pr", "c.profissionais_id = pr.id")
						->join("especialidades as e", "c.especialidades_id = e.id")
						->join("plano_procedimento as pp", "c.plano_procedimento_id = pp.id")
						->join("planos as pl", "pp.planos_id = pl.id")
						->order_by("f.createdAt DESC, hr.id ASC")
						->limit($perPage,$offset)
						->get();
		if($this->data['admin'] != 1) {
			$this->db->where("c.profissionais_id", $this->data['user_id']);
		}
		$this->data['listaAtendimentos'] = $resultAtendimentos->result();

		//pagination with search filters
		$this->load->library('pagination');
		$config['base_url'] 	 = ($data_inicio && $data_fim) ? site_url("atendimentos/". strtolower(get_active_method()))."?filtro_data_inicio=". $data_inicio."&filtro_data_fim=". $data_fim : site_url("atendimentos/" . strtolower(get_active_method()))."?";
		$config['total_rows'] 	 = $quantidadeAtendimentos;
		$config['per_page'] 	 = $perPage;
		$this->pagination->initialize($config);
		$this->data['paginacao'] = $this->pagination->create_links();
	}

	
}

/* End of file Atendimentos.php */
/* Location: ./system/application/controllers/Atendimentos.php */