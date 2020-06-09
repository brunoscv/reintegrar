<?php
class DiasSemana extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("DiasSemana_model");
		
		//adicione os campos da busca
		$camposFiltros["d.id"] = "Id";
		$camposFiltros["d.desc_dia_semana"] = "Dia Semana";
		$camposFiltros["d.status"] = "Status";
		$camposFiltros["d.createdAt"] = "createdAt";
		$camposFiltros["d.updatedAt"] = "updatedAt";

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
		$countDiasSemana = $this->db
							->select("count(d.id) AS quantidade")
							->from("dias_semana AS d")
							->get()->row();
		$quantidadeDiasSemana = $countDiasSemana->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultDiasSemana = $this->db
									->select("*")
									->from("dias_semana AS d")
									->limit($perPage,$offset)
									->get();
		
		$this->data['listaDiasSemana'] = $resultDiasSemana->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("dias_semana/index")."?";
		$config['total_rows'] = $quantidadeDiasSemana;
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
			
			if( $this->form_validation->run('DiasSemana') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				//Preenche objeto com as informações do formulário
								
				$dia	= array();
				$dia['id'] 		= $this->input->post('id', TRUE);
				$dia['desc_dia_semana'] 		= $this->input->post('desc_dia_semana', TRUE);
				$dia['status'] 		= $this->input->post('status', TRUE);
				$dia['createdAt'] 		= $this->input->post('createdAt', TRUE);
				$dia['updatedAt'] 		= $this->input->post('updatedAt', TRUE);
				$this->db->insert("dias_semana", $dia);
	
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('diassemana/index');
			}
		} 
    	
    }
    
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$dia = $this->db
						->from("dias_semana AS m")
						->where("id", $id)->get()->row();

		if(!$dia){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('diassemana/index');
		} else {
			$this->data['item'] = $dia;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('DiasSemana') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$dia	= array();
					$dia['id']	= $this->input->post('id', true);
					$dia['desc_dia_semana']	= $this->input->post('desc_dia_semana', true);
					$dia['status']	= $this->input->post('status', true);
					$dia['createdAt']	= $this->input->post('createdAt', true);
					$dia['updatedAt']	= $this->input->post('updatedAt', true);

					$this->db->where("id",$id);
					$this->db->update("dias_semana",$dia);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$dia->id}</b> atualizado!");
					redirect('diassemana/index');
				}
			}
		}
	}
	
	public function delete($id){
		$id = $this->uri->segment(3);
		
		$dia = $this->db
						->from("dias_semana AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $dia;
		
		if( !$dia ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('diassemana/index');
		} else {
			$this->data['item'] = $dia;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", $dia->id);
				$this->db->delete("dias_semana");
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('diassemanaindex');
			}
		}
	}
}

/* End of file Dias_semanas.php */
/* Location: ./system/application/controllers/Dias_semanas.php */