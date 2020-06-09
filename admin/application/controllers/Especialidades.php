<?php
class Especialidades extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Especialidades_model");
		
		//adicione os campos da busca
		$camposFiltros["e.id"] = "Codigo";
		$camposFiltros["e.nome_espec"] = "Nome";
		$camposFiltros["e.status"] = "Status";
		$camposFiltros["e.createdAt"] = "createdAt";
		$camposFiltros["e.updatedAt"] = "updatedAt";

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
		$countEspecialidades = $this->db
							->select("count(e.id) AS quantidade")
							->from("especialidades AS e")
							->get()->row();
		$quantidadeEspecialidades = $countEspecialidades->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultEspecialidades = $this->db
									->select("*")
									->from("especialidades AS e")
									->limit($perPage,$offset)
									->get();
		
		$this->data['listaEspecialidades'] = $resultEspecialidades->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("especialidades/index")."?";
		$config['total_rows'] = $quantidadeEspecialidades;
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
			
			if( $this->form_validation->run('Especialidades') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				//Preenche objeto com as informações do formulário
								
				$especialidade	= array();
				//$especialidade['id'] 		= $this->input->post('id', TRUE);
				$especialidade['nome_espec'] 		= $this->input->post('nome_espec', TRUE);
				$especialidade['status'] 			= 1;
				$especialidade['createdAt'] 		= date("Y-m-d");
				$this->db->insert("especialidades", $especialidade);
	
				$this->data['msg_error'] = $this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('especialidades/index');
			}
		} 
    	
    }
    
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$especialidade = $this->db
						->from("especialidades AS m")
						->where("id", $id)->get()->row();

		if(!$especialidade){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('especialidades/index');
		} else {
			$this->data['item'] = $especialidade;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('Especialidades') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$especialidade	= array();
					$especialidade['id']		 = $this->input->post('id', true);
					$especialidade['nome_espec'] = $this->input->post('nome_espec', true);
					$especialidade['status']	 = 1;
					$especialidade['updatedAt']	 = date("Y-m-d");

					$this->db->where("id",$id);
					$this->db->update("especialidades",$especialidade);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$especialidade->id}</b> atualizado!");
					redirect('especialidades/index');
				}
			}
		}
	}
	
	public function delete($id){
		$id = $this->uri->segment(3);
		
		$especialidade = $this->db
						->from("especialidades AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $especialidade;
		
		if( !$especialidade ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('especialidades/index');
		} else {
			$this->data['item'] = $especialidade;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", $especialidade->id);
				$this->db->delete("especialidades");
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('especialidadesindex');
			}
		}
	}
}

/* End of file Especialidadeses.php */
/* Location: ./system/application/controllers/Especialidadeses.php */