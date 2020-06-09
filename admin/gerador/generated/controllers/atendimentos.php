<?php
class Atendimentos extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Atendimentos_model");
		
		//adicione os campos da busca
				$camposFiltros["a.id"] = "Cod.";
				$camposFiltros["a.consultas_id"] = "Cod. Consulta";
				$camposFiltros["a.qtd_atendimentos"] = "Qtd Atendimentos";
				$camposFiltros["a.freq_atendimentos"] = "Freq. Atendimentos";
				$camposFiltros["a.data_ref"] = "Data Ref.";
				$camposFiltros["a.status"] = "Status";
				$camposFiltros["a.createdAt"] = "Criado";
				$camposFiltros["a.updatedAt"] = "Modificado";
		
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
		$countAtendimentos = $this->db
							->select("count(a.id) AS quantidade")
							->from("atendimentos AS a")
							->get()->row();
		$quantidadeAtendimentos = $countAtendimentos->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultAtendimentos = $this->db
									->select("*")
									->from("atendimentos AS a")
									->limit($perPage,$offset)
									->get();
		
		$this->data['listaAtendimentos'] = $resultAtendimentos->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("atendimentos/index")."?";
		$config['total_rows'] = $quantidadeAtendimentos;
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
			
			if( $this->form_validation->run('Atendimentos') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				//Preenche objeto com as informações do formulário
								
				$atendimento	= array();
													$atendimento['id'] 		= $this->input->post('id', TRUE);
																	$atendimento['consultas_id'] 		= $this->input->post('consultas_id', TRUE);
																	$atendimento['qtd_atendimentos'] 		= $this->input->post('qtd_atendimentos', TRUE);
																	$atendimento['freq_atendimentos'] 		= $this->input->post('freq_atendimentos', TRUE);
																	$atendimento['data_ref'] 		= $this->input->post('data_ref', TRUE);
																	$atendimento['status'] 		= $this->input->post('status', TRUE);
																	$atendimento['createdAt'] 		= $this->input->post('createdAt', TRUE);
																	$atendimento['updatedAt'] 		= $this->input->post('updatedAt', TRUE);
												$this->db->insert("atendimentos", $atendimento);
	
				$this->data['msg_success'] = $this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('atendimentos/index');
			}
		} 
    	
    }
    
	public function editar(){
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
	
	public function delete($id){
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
}

/* End of file Atendimentoses.php */
/* Location: ./system/application/controllers/Atendimentoses.php */