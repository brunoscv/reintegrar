<?php
class Faturamento extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Faturamento_model");

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
		$perPage = '10';
		$offset = ($this->input->get("per_page")) ? $this->input->get("per_page") : "0";

		$displayed = ($this->data['admin'] != 1) ? $displayed = "style='display:none;'" : $displayed = "";
		$this->data['displayed'] = $displayed;

		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		$countFaturamento = $this->db
							->select("count(f.id) AS quantidade")
							->from("faturamento AS f")
							->get()->row();
		
		if($this->data['admin'] != 1) {
			$this->db->where("c.profissionais_id", $this->data['user_id']);
		}
		$quantidadeFaturamento = $countFaturamento->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultFaturamento = $this->db
							->select("*")
							->from("faturamento AS f")
							->limit($perPage,$offset)
							->get();
		
		if($this->data['admin'] != 1) {
			$this->db->where("c.profissionais_id", $this->data['user_id']);
		}
		$this->data['listaFaturamento'] = $resultFaturamento->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("faturamento/index")."?";
		$config['total_rows'] = $quantidadeFaturamento;
		$config['per_page'] = $perPage;
		
		$this->pagination->initialize($config);
		
		$this->data['paginacao'] = $this->pagination->create_links(); 
	}

	public function receita(){
		$perPage = '100';
		$offset = ($this->input->get("per_page")) ? $this->input->get("per_page") : "0";
		//$tipo = ($this->uri->segment(2) == "receita") ? 1 : 0;

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

		$countFaturamento = $this->db
						->select("count(f.id) AS quantidade")
						->from("faturamento AS f")
						->join("consultas as c", "f.consultas_id = c.id")
						->join("pacientes as p", "c.pacientes_id = p.id")
						->join("profissionais as pr", "c.profissionais_id = pr.id")
						->join("especialidades as e", "c.especialidades_id = e.id")
						->join("plano_procedimento as pp", "c.plano_procedimento_id = pp.id")
						->join("planos as pl", "pp.planos_id = pl.id")
						//->where("f.tipo", $tipo)
						->order_by("f.createdAt", "DESC")
						->get()->row();				
		if($this->data['admin'] != 1) {
			$this->db->where("c.profissionais_id", $this->data['user_id']);
		}
		$quantidadeFaturamento = $countFaturamento->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$data_inicio = $this->db->escape_str($this->input->get('filtro_data_inicio'));
			$data_fim 	 = $this->db->escape_str($this->input->get('filtro_data_fim'));

			if($data_inicio && $data_fim){
				//$this->db->where("data_faturamento BETWEEN","%".$valor."%");
				$this->db->where('f.createdAt >="'. formatar_data($data_inicio) . '" AND f.createdAt <="'. formatar_data($data_fim) .'"');
			}
		}
		
		$resultFaturamento = $this->db
						->select("f.id, c.id AS consultas_id, f.atendimentos_id, f.valor, f.data_faturamento, f.status, f.tipo,
								p.nome_pac, pr.nome_prof, pl.nome_plano, e.nome_espec, f.createdAt")
						->from("faturamento AS f")
						->join("consultas as c", "f.consultas_id = c.id")
						->join("pacientes as p", "c.pacientes_id = p.id")
						->join("profissionais as pr", "c.profissionais_id = pr.id")
						->join("especialidades as e", "c.especialidades_id = e.id")
						->join("plano_procedimento as pp", "c.plano_procedimento_id = pp.id")
						->join("planos as pl", "pp.planos_id = pl.id")
						//->where("f.tipo", $tipo)
						->order_by("f.createdAt", "DESC")
						->limit($perPage,$offset)
						->get();
		if($this->data['admin'] != 1) {
			$this->db->where("c.profissionais_id", $this->data['user_id']);
		}
		$this->data['listaFaturamento'] = $resultFaturamento->result();

		if( !is_null($this->input->get('busca')) ){
			$data_inicio = $this->db->escape_str($this->input->get('filtro_data_inicio'));
			$data_fim 	 = $this->db->escape_str($this->input->get('filtro_data_fim'));

			if($data_inicio && $data_fim){
				$this->db->where('f.createdAt >= "'. formatar_data($data_inicio) . '" AND f.createdAt <="'. formatar_data($data_fim) .'"');
			}
		}

		$resultValor = $this->db
				->select("sum(f.valor) as valor")
				->from("faturamento AS f")
				->join("consultas as c", "f.consultas_id = c.id")
				->join("pacientes as p", "c.pacientes_id = p.id")
				->join("profissionais as pr", "c.profissionais_id = pr.id")
				->join("especialidades as e", "c.especialidades_id = e.id")
				->join("plano_procedimento as pp", "c.plano_procedimento_id = pp.id")
				->join("planos as pl", "pp.planos_id = pl.id")
				//->where("f.tipo", $tipo)
				->get()->row();
				
				if($this->data['admin'] != 1) {
					$this->db->where("c.profissionais_id", 2);
				}
		$this->data['listaValor'] = $resultValor->valor;
		//arShow($this->data['listaValor']); exit;

		//pagination with search filters
		$this->load->library('pagination');
		$config['base_url'] 	 = ($data_inicio && $data_fim) ? site_url("faturamento/". strtolower(get_active_method()))."?filtro_data_inicio=". $data_inicio."&filtro_data_fim=". $data_fim : site_url("faturamento/" . strtolower(get_active_method()))."?";
		$config['total_rows'] 	 = $quantidadeFaturamento;
		$config['per_page'] 	 = $perPage;
		$this->pagination->initialize($config);
		$this->data['paginacao'] = $this->pagination->create_links();
	}

	public function planos(){
		$mes = date("m");
		$dia = date("d");
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultFaturamento = $this->db
									->select("f.id, p.nome_plano, SUM(f.valor) AS valor")
									->from("faturamento AS f")
									->join("consultas as c", "f.consultas_id = c.id")
									->join("planos AS p", "c.planos_id = p.id")
									->order_by("f.data_faturamento", "desc")
									->group_by("c.planos_id")
									->get();
		$this->data['listaFaturamento'] = $resultFaturamento->result();
	}

	public function especialidades(){
		$mes = date("m");
		$dia = date("d");
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultFaturamento = $this->db
									->select("f.id, e.nome_espec, SUM(f.valor) AS valor")
									->from("faturamento AS f")
									->join("consultas as c", "f.consultas_id = c.id")
									->join("especialidades AS e", "c.especialidades_id = e.id")
									->order_by("f.data_faturamento", "desc")
									->group_by("c.especialidades_id")
									->get();
		$this->data['listaFaturamento'] = $resultFaturamento->result();
	}
	
	public function profissionais(){
		$mes = date("m");
		$dia = date("d");
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultFaturamento = $this->db
									->select("f.id, pr.nome_prof, SUM(f.valor) AS valor")
									->from("faturamento AS f")
									->join("consultas as c", "f.consultas_id = c.id")
									->join("profissionais AS pr", "c.profissionais_id = pr.id")
									->order_by("f.data_faturamento", "desc")
									->group_by("c.profissionais_id")
									->get();
		$this->data['listaFaturamento'] = $resultFaturamento->result();
	}
    
    
    function criar(){
		$this->data['item'] = new stdClass();
		
		//Campos relacionados
		//caso seja necessario adicione os relacionamento aqui
		//fim Campos relacionados
		
		
		if($this->input->post('enviar')){
			
			if( $this->form_validation->run('Faturamento') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				//Preenche objeto com as informações do formulário
								
				$faturamento	= array();
				$faturamento['id'] 		= $this->input->post('id', TRUE);
				$faturamento['pacientes_id'] 		= $this->input->post('pacientes_id', TRUE);
				$faturamento['profissionais_id'] 		= $this->input->post('profissionais_id', TRUE);
				$faturamento['especialidades_id'] 		= $this->input->post('especialidades_id', TRUE);
				$faturamento['plano_procedimento_id'] 		= $this->input->post('plano_procedimento_id', TRUE);
				$faturamento['consultas_id'] 		= $this->input->post('consultas_id', TRUE);
				$faturamento['item_consulta_id'] 		= $this->input->post('item_consulta_id', TRUE);
				$faturamento['valor'] 		= $this->input->post('valor', TRUE);
				$faturamento['tipo'] 		= $this->input->post('tipo', TRUE);
				$faturamento['status'] 		= $this->input->post('status', TRUE);
				$faturamento['createdAt'] 		= $this->input->post('createdAt', TRUE);
				$faturamento['updatedAt'] 		= $this->input->post('updatedAt', TRUE);
				$this->db->insert("faturamento", $faturamento);
	
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('faturamento/index');
			}
		} 
    	
    }
    
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$faturamento = $this->db
						->from("faturamento AS m")
						->where("id", $id)->get()->row();

		if(!$faturamento){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('faturamento/index');
		} else {
			$this->data['item'] = $faturamento;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('Faturamento') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$faturamento	= array();
					$faturamento['id']	= $this->input->post('id', true);
					$faturamento['pacientes_id']	= $this->input->post('pacientes_id', true);
					$faturamento['profissionais_id']	= $this->input->post('profissionais_id', true);
					$faturamento['especialidades_id']	= $this->input->post('especialidades_id', true);
					$faturamento['plano_procedimento_id']	= $this->input->post('plano_procedimento_id', true);
					$faturamento['consultas_id']	= $this->input->post('consultas_id', true);
					$faturamento['item_consulta_id']	= $this->input->post('item_consulta_id', true);
					$faturamento['valor']	= $this->input->post('valor', true);
					$faturamento['tipo']	= $this->input->post('tipo', true);
					$faturamento['status']	= $this->input->post('status', true);
					$faturamento['createdAt']	= $this->input->post('createdAt', true);
					$faturamento['updatedAt']	= $this->input->post('updatedAt', true);

					$this->db->where("id",$id);
					$this->db->update("faturamento",$faturamento);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$faturamento->id}</b> atualizado!");
					redirect('faturamento/index');
				}
			}
		}
	}
	
	public function delete($id){
		$id = $this->uri->segment(3);
		
		$faturamento = $this->db
						->from("faturamento AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $faturamentoindex;
		
		if( !$faturamento ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('faturamento/index');
		} else {
			$this->data['item'] = $faturamentoindex;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", $faturamento->id);
				$this->db->delete("faturamento");
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('faturamentoindex');
			}
		}
	}

	public function tipo_unused() {
		//arShow($this->data['listaFaturamento']); exit;

		// $valorMensalPorTipo = $this->db
		// 					  ->select("sum(f.valor) as valor")
		// 					  ->from("faturamento AS f")
		// 					  ->join("consultas as c", "f.consultas_id = c.id")
		// 					  ->join("pacientes as p", "c.pacientes_id = p.id")
		// 					  ->join("profissionais as pr", "c.profissionais_id = pr.id")
		// 					  ->join("especialidades as e", "c.especialidades_id = e.id")
		// 					  ->join("plano_procedimento as pp", "c.plano_procedimento_id = pp.id")
		// 					  ->join("planos as pl", "pp.planos_id = pl.id")
		// 					  ->where("f.tipo", $tipo)
		// 					  ->get();
		
		// if($this->data['admin'] != 1) {
		// 	$this->db->where("c.profissionais_id", $this->data['user_id']);
		// }
		// $this->data['valorMensalPorTipo'] = $valorMensalPorTipo->result();

		// $valorDiarioPorTipo = $this->db
		// 					  ->select("sum(f.valor) as valor")
		// 					  ->from("faturamento AS f")
		// 					  ->join("consultas as c", "f.consultas_id = c.id")
		// 					  ->join("pacientes as p", "c.pacientes_id = p.id")
		// 					  ->join("profissionais as pr", "c.profissionais_id = pr.id")
		// 					  ->join("especialidades as e", "c.especialidades_id = e.id")
		// 					  ->join("plano_procedimento as pp", "c.plano_procedimento_id = pp.id")
		// 					  ->join("planos as pl", "pp.planos_id = pl.id")
		// 					  ->where("f.tipo", $tipo)
		// 					  ->get();
		
		// if($this->data['admin'] != 1) {
		// 	$this->db->where("c.profissionais_id", $this->data['user_id']);
		// }
		// $this->data['valorDiarioPorTipo'] = $valorDiarioPorTipo->result();
		
		// if($tipo == 1) {
		// 	$this->data['tipo'] = "Receita";
		// 	$this->data['color'] = "style ='color:green'";
		// } else {
		// 	$this->data['tipo'] = "Despesa";
		// 	$this->data['color'] = "style ='color:red'";
		// }
	}
}

/* End of file Faturamentos.php */
/* Location: ./system/application/controllers/Faturamentos.php */