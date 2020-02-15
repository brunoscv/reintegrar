<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Convenios extends MY_Controller {

	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Convenios_model");

		//adicione os campos da busca
		$camposFiltros["id"] = "Id";
		$camposFiltros["nome_convenio"] = "Nome Convenio";
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
					$this->db->from("convenios")->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$countConvenios = $this->db
							->select("count(id) AS quantidade")
							->from("convenios AS c")
							->get()->row();
		
		$quantidadeConvenios = $countConvenios->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', TRUE);
			$valor = $this->input->get('filtro_valor', TRUE);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->from("convenios")->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		$resultConvenios = $this->db
						->select("*")
						->from("convenios AS c")
						->limit($perPage,$offset)
						->get();
		
		$this->data['listaConvenios'] = $resultConvenios->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("convenios/index")."?";
		$config['total_rows'] = $quantidadeConvenios;
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
			
			if( $this->form_validation->run('Convenios') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				//Preenche objeto com as informações do formulário			
				$convenio = array();
				//$convenio['id'] 			  = $this->input->post('id', TRUE);
				$convenio['nome_convenio'] = $this->input->post('nome_convenio', TRUE);
				$convenio['status'] 		= 1;
				$convenio['createdAt'] 		= date("Y-m-d");
				$this->db->insert("convenios", $convenio);
	
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('convenios/index');
			}
		} 	
    }
	
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$convenio = $this->db
						->from("convenios AS c")
						->where("id", $id)->get()->row();

		if(!$convenio){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('convenios/index');
		} else {
			$this->data['item'] = $convenio;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('Convenios') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					$convenio = array();
					$convenio['id']				= $this->input->post('id', true);
					$convenio['nome_convenio']	= $this->input->post('nome_convenio', true);
					$convenio['status']			= $this->input->post('status', true);
					$convenio['updatedAt']		= date("Y-m-d");

					$this->db->where("id",$id);
					$this->db->update("convenios", $convenio);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$convenio['id']}</b> atualizado!");
					redirect('convenios/index');
				}
			}
		}
	}

	public function delete(){
		$id = $this->uri->segment(3);
		
		$convenio = $this->db
						->from("convenios AS c")
						->where("id", $id)->get()->row();
		$this->data['item'] = $convenio;
		
		if( !$convenio ){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('convenios/index');
		} else {
			$this->data['item'] = $convenio;
			
			if( $this->input->post("enviar") ){
				
				$this->db->where("id", $convenio->id);
				$this->db->delete("convenios");

				$this->session->set_flashdata("msg_success", "Registro deletado com sucesso!");
				redirect('convenios/index');
			}
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */