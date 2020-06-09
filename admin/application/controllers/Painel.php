<?php
class Painel extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Painel_model");
		
		//adicione os campos da busca
		$camposFiltros["h.id"] = "Id";
		$camposFiltros["h.desc_horario"] = "Horário";
		$camposFiltros["h.status"] = "Status";
		$camposFiltros["h.createdAt"] = "createdAt";
		$camposFiltros["h.updatedAt"] = "updatedAt";

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
		$countHorarios = $this->db
							->select("count(h.id) AS quantidade")
							->from("horarios AS h")
							->get()->row();
		$quantidadeHorarios = $countHorarios->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultHorarios = $this->db
									->select("*")
									->from("horarios AS h")
									->limit($perPage,$offset)
									->get();
		
		$this->data['listaHorarios'] = $resultHorarios->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("horarios/index")."?";
		$config['total_rows'] = $quantidadeHorarios;
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
			
			if( $this->form_validation->run('Horarios') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				//Preenche objeto com as informações do formulário
								
				$horario	= array();
				$horario['id'] 		= $this->input->post('id', TRUE);
				$horario['desc_horario'] 		= $this->input->post('desc_horario', TRUE);
				$horario['status'] 		= $this->input->post('status', TRUE);
				$horario['createdAt'] 		= $this->input->post('createdAt', TRUE);
				$horario['updatedAt'] 		= $this->input->post('updatedAt', TRUE);
				$this->db->insert("horarios", $horario);
	
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('horarios/index');
			}
		} 
    	
    }
    
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$horario = $this->db
						->from("horarios AS m")
						->where("id", $id)->get()->row();

		if(!$horario){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('horarios/index');
		} else {
			$this->data['item'] = $horario;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('Horarios') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$horario	= array();
					$horario['id']	= $this->input->post('id', true);
					$horario['desc_horario']	= $this->input->post('desc_horario', true);
					$horario['status']	= $this->input->post('status', true);
					$horario['createdAt']	= $this->input->post('createdAt', true);
					$horario['updatedAt']	= $this->input->post('updatedAt', true);

					$this->db->where("id",$id);
					$this->db->update("horarios",$horario);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$horario->id}</b> atualizado!");
					redirect('horarios/index');
				}
			}
		}
	}
	
	public function delete($id){
		$id = $this->uri->segment(3);
		
		$horario = $this->db
						->from("horarios AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $horario;
		
		if( !$horario ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('horarios/index');
		} else {
			$this->data['item'] = $horario;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", $horario->id);
				$this->db->delete("horarios");
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('horariosindex');
			}
		}
	}
}

/* End of file Horarioses.php */
/* Location: ./system/application/controllers/Horarioses.php */