<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Financeiro extends MY_Controller {

	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
        $this->load->model("Financeiro_model");
        $this->load->model("Profissionais_model");
	}
	
	public function index(){
		
		$resultFinanceiro = $this->db->select("f.*, p.nome_prof")->from("financeiro AS f")->join("profissionais AS p", "f.profissional_id = p.id")->get();
        $this->data['listaFinanceiro'] = $resultFinanceiro->result();
		
        $this->load->library('pagination');
        
		$config['base_url'] = site_url("conselhos/index")."?";
	}
	
	function criar(){
		$this->data['item'] = new stdClass();
		
		//Campos relacionados
        //caso seja necessario adicione os relacionamento aqui
        $profissionais = $this->Profissionais_model->getProfissionais();
		$this->data['listaProfissionais'] = array();
		$this->data['listaProfissionais'][''] = "Escolha um Profissional";
		foreach ($profissionais as $profissionais) {
			$this->data['listaProfissionais'][$profissionais->id] = $profissionais->nome_prof;
		}
		//fim Campos relacionados
		
		if($this->input->post('enviar')){
			
			if( $this->form_validation->run('Financeiro') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				//Preenche objeto com as informações do formulário			
				$financeiro = array();
				//$financeiro['id'] 			  = $this->input->post('id', TRUE);
                $financeiro['profissional_id']  = $this->input->post('profissional_id', TRUE);
                $financeiro['data_nota']        = formatar_data($this->input->post('data_nota', TRUE));
                $financeiro['valor_nota']       = $this->input->post('valor_nota', TRUE);
                $financeiro['qtd_atendimentos'] = $this->input->post('qtd_atendimentos', TRUE);
				$financeiro['status'] 		    = 1;
                $financeiro['createdAt'] 	    = date("Y-m-d");
                
				$this->db->insert("financeiro", $financeiro);
	
				$this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('financeiro/index');
			}
		} 	
    }
	
	public function editar(){
		//carregue os MODELs necessários aqui
		$id = $this->uri->segment(3);

		$financeiro = $this->db->from("financeiro AS f")->where("id", $id)->get()->row();
        
        $profissionais = $this->Profissionais_model->getProfissionais();
        $this->data['listaProfissionais'] = array();
        foreach ($profissionais as $profissionais) {
            $this->data['listaProfissionais'][$profissionais->id] = $profissionais->nome_prof;
        }

		if(!$financeiro){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('financeiro/index');
		} else {
			$this->data['item'] = $financeiro;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('Financeiro') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					//Preenche objeto com as informações do formulário			
                    $financeiro = array();
                    //$financeiro['id'] 			  = $this->input->post('id', TRUE);
                    $financeiro['profissional_id']  = $this->input->post('profissional_id', TRUE);
                    $financeiro['data_nota']        = formatar_data($this->input->post('data_nota', TRUE));
                    $financeiro['valor_nota']       = $this->input->post('valor_nota', TRUE);
                    $financeiro['qtd_atendimentos'] = $this->input->post('qtd_atendimentos', TRUE);
                    $financeiro['status'] 		    = 1;
                    $financeiro['createdAt'] 	    = date("Y-m-d");

					$this->db->where("id",$id);
					$this->db->update("financeiro", $financeiro);
				
					$this->session->set_flashdata("msg_success", "Registro <b>#{$financeiro['id']}</b> atualizado!");
					redirect('financeiro/index');
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