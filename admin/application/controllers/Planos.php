<?php
class Planos extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Planos_model");
		
		//adicione os campos da busca
		$camposFiltros["p.id"] = "Codigo";
		$camposFiltros["p.nome_plano"] = "Nome";
		$camposFiltros["p.telefone_plano"] = "Telefone";
		$camposFiltros["p.email_plano"] = "Email";
		$camposFiltros["p.status"] = "Status";
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
		$countPlanos = $this->db
							->select("count(p.id) AS quantidade")
							->from("planos AS p")
							->get()->row();
		$quantidadePlanos = $countPlanos->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$resultPlanos = $this->db
									->select("*")
									->from("planos AS p")
									->order_by("p.id", "desc")
									->limit($perPage,$offset)
									->get();
		
		$this->data['listaPlanos'] = $resultPlanos->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("planos/index")."?";
		$config['total_rows'] = $quantidadePlanos;
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
			
			if( $this->form_validation->run('Planos') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				//Preenche objeto com as informações do formulário
								
				$plano	= array();
				//$plano['id'] 				= $this->input->post('id', TRUE);
				$plano['nome_plano'] 		= $this->input->post('nome_plano', TRUE);
				$plano['telefone_plano'] 	= $this->input->post('telefone_plano', TRUE);
				$plano['email_plano'] 		= $this->input->post('email_plano', TRUE);
				$plano['status'] 			= 1;
				$plano['createdAt'] 		= date("Y-m-d");
				$this->db->insert("planos", $plano);
	
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('planos/index');
			}
		} 
    	
    }
    
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$plano = $this->db
						->from("planos AS m")
						->where("id", $id)->get()->row();

		if(!$plano){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('planos/index');
		} else {
			$this->data['item'] = $plano;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('Planos') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$plano	= array();
					$plano['id']				= $this->input->post('id', true);
					$plano['nome_plano']		= $this->input->post('nome_plano', true);
					$plano['telefone_plano']	= $this->input->post('telefone_plano', true);
					$plano['email_plano']		= $this->input->post('email_plano', true);
					$plano['status']			= 1;
					$plano['updatedAt']			= date("Y-m-d");

					$this->db->where("id",$id);
					$this->db->update("planos",$plano);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$plano->id}</b> atualizado!");
					redirect('planos/index');
				}
			}
		}
	}
	
	public function delete($id){
		$id = $this->uri->segment(3);
		
		$plano = $this->db
						->from("planos AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = $plano;
		
		if( !$plano ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('planos/index');
		} else {
			$this->data['item'] = $plano;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", $plano->id);
				$this->db->delete("planos");
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('planosindex');
			}
		}
	}
}

/* End of file Planoses.php */
/* Location: ./system/application/controllers/Planoses.php */