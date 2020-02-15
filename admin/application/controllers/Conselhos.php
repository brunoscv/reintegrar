<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Conselhos extends MY_Controller {

	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Conselhos_model");

		//adicione os campos da busca
		$camposFiltros["id"] = "Id";
		$camposFiltros["nome_conselho"] = "Nome Conselho";
		$this->data['campos']    = $camposFiltros;
	}
	
	public function index(){
		$perPage = '10';
		$offset = ($this->input->get("per_page")) ? $this->input->get("per_page") : "0";
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', TRUE);
			$valor = $this->input->get('filtro_valor', TRUE);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->from("conselhos")->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$countConselhos = $this->db
							->select("count(id) AS quantidade")
							->from("conselhos AS c")
							->get()->row();
		
		$quantidadeConselhos = $countConselhos->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', TRUE);
			$valor = $this->input->get('filtro_valor', TRUE);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->from("conselhos")->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		$resultConselhos = $this->db
						->select("*")
						->from("conselhos AS c")
						->limit($perPage,$offset)
						->get();
		
		$this->data['listaConselhos'] = $resultConselhos->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("conselhos/index")."?";
		$config['total_rows'] = $quantidadeConselhos;
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
			
			if( $this->form_validation->run('Conselhos') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				//Preenche objeto com as informações do formulário			
				$conselho = array();
				//$conselho['id'] 			  = $this->input->post('id', TRUE);
				$conselho['nome_conselho'] = $this->input->post('nome_conselho', TRUE);
				$conselho['status'] 		= 1;
				$conselho['createdAt'] 		= date("Y-m-d");
				$this->db->insert("conselhos", $conselho);
	
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('conselhos/index');
			}
		} 	
    }
	
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$conselho = $this->db
						->from("conselhos AS c")
						->where("id", $id)->get()->row();

		if(!$conselho){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('conselhos/index');
		} else {
			$this->data['item'] = $conselho;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('Conselhos') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$conselho = array();
					$conselho['id']				= $this->input->post('id', true);
					$conselho['nome_conselho']	= $this->input->post('nome_conselho', true);
					$conselho['status']			= $this->input->post('status', true);
					$conselho['updatedAt']		= date("Y-m-d");

					$this->db->where("id",$id);
					$this->db->update("conselhos", $conselho);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$conselho['id']}</b> atualizado!");
					redirect('conselhos/index');
				}
			}
		}
	}

	public function delete(){
		$id = $this->uri->segment(3);
		
		$conselho = $this->db
						->from("conselhos AS c")
						->where("id", $id)->get()->row();
		$this->data['item'] = $conselho;
		
		if( !$conselho ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('conselhos/index');
		} else {
			$this->data['item'] = $conselho;
			
			if( $this->input->post("enviar") ){
				
				$this->db->where("id", $conselho->id);
				$this->db->delete("conselhos");

				$this->session->set_flashdata("msg_success", "Registro deletado com sucesso!");
				redirect('conselhos/index');
			}
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */