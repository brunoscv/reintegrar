<?php
class Calendarios extends MY_Controller {
	public $data;	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("Calendarios_model");
		$this->load->model("Profissionais_model");

		//adiciona os dados do login para fazer as visualizacoes de informacoes
		$this->data['user_id']  = $this->session->userdata('userdata')['profissionais_id'];
		$this->data['admin'] 	= $this->session->userdata('userdata')['principal'];
		
		//adicione os campos da busca
		// $camposFiltros["p.id"] = "Profissional";
		// $this->data['campos']    = $camposFiltros;
	}
	
	public function index(){

		$profissionais_id = ($this->input->get('profissionais_id', true)) ? $this->input->get('profissionais_id', true) : $this->data['user_id'];
		
		$profissionais = ($this->data['admin'] != 1) ? $this->db->select("id, nome_prof")->from("profissionais AS p")->where("id", $this->data['user_id'])->get()->result() : $this->db->select("id, nome_prof")->from("profissionais AS p")->get()->result();
		foreach ($profissionais as $p) {
			$this->data['listaProfissionais'][$p->id] = $p->nome_prof;
		}

		$consultas = array();
		$consultas = $this->db
				->select("hc.id, p.nome_pac, hr.desc_horario, hc.dia_semana_id")
				->from("consultas AS c")
				->join("pacientes AS p", "c.pacientes_id = p.id")
				->join("horarios_consulta AS hc", "hc.consultas_id = c.id")
				->join("horarios as hr", "hc.horarios_id = hr.id")
				->where(array("c.profissionais_id" => $profissionais_id, "c.status" => 1))
				->get()->result();
		
		if($consultas) {	
			foreach ($consultas as $i) {
				$c[] = array(
					'id' => $i->id,
					'title' => $i->nome_pac,
					'dow' => '[' . $i->dia_semana_id . ']',
					'start' => $i->desc_horario,
					//transforma a hora de entrada da consulta para adicionar 30min a essa conta.
					//assim o inicio e termino da consulta fica definido
					'end' => date('H:i', strtotime($i->desc_horario) + 60*30),
				);	
			}
			$this->data['data'] = $c;
		} else {
			$c[] = array(
				'id' => '',
				'title' => '',
				'dow' => '[]',
				'start' =>'',
				//transforma a hora de entrada da consulta para adicionar 30min a essa conta.
				//assim o inicio e termino da consulta fica definido
				'end' => '',
			);
			$this->data['data'] = $c;
		}
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
	
	public function get_consultas() {
	// 	$profissionais_id = $this->uri->segment(3);
	// 	$result = array();

	// 	$profissional = $this->db->from("profissionais AS p")->where("p.id", $profissionais_id)->get()->result();
		
	// 	$c = array();
	// 	$consultas = array();
	// 	$consultas = $this->db
	// 							->select("hc.id, p.nome_pac, hr.desc_horario, hc.dia_semana_id")
	// 							->from("consultas AS c")
	// 							->join("pacientes AS p", "c.pacientes_id = p.id")
	// 							->join("horarios_consulta AS hc", "hc.consultas_id = c.id")
	// 							->join("horarios as hr", "hc.horarios_id = hr.id")
	// 							->where(array("c.profissionais_id" => $profissionais_id, "c.status" => 1))
	// 							->get()->result();
			
	// 	foreach ($consultas as $i) {
	// 		$c[] = array(
	// 			'id' => $i->id,
	// 			'title' => $i->nome_pac,
	// 			'dow' => '[' . $i->dia_semana_id . ']',
	// 			'start' => $i->desc_horario,
	// 			//transforma a hora de entrada da consulta para adicionar 30min a essa conta.
	// 			//assim o inicio e termino da consulta fica definido
	// 			'end' => date('H:i', strtotime($i->desc_horario) + 60*30),
	// 		);	
	// 	}

	// 	$this->data['data'] = $c;
	// 	header('Content-Type: application/json');
	// 	echo json_encode($c);
	// 	exit;
	}
}

/* End of file Horarioses.php */
/* Location: ./system/application/controllers/Horarioses.php */