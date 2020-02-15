{?php
class <?php echo ucfirst(camelCase($modulo)); ?> extends MY_Controller {
	public $data;<?php $qAlias = substr($modulo,0,1); ?>
	
	function __construct(){
		parent::__construct();
		$this->_auth();
		
		$this->load->model("<?php echo ucfirst(camelCase($modulo)); ?>_model");
		
		//adicione os campos da busca
		<?php foreach($camposLista as $campo): ?>
		$camposFiltros["<?php echo $qAlias;?>.<?php echo $campo['name']; ?>"] = "<?php echo utf8_encode($campo['field'])?>";
		<?php endforeach;?>

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
		$count<?php echo ucfirst(camelCase($modulo)); ?> = $this->db
							->select("count(<?php echo $qAlias; ?>.id) AS quantidade")
							->from("<?php echo $modulo; ?> AS <?php echo $qAlias; ?>")
							->get()->row();
		$quantidade<?php echo ucfirst(camelCase($modulo)); ?> = $count<?php echo ucfirst(camelCase($modulo)); ?>->quantidade;
		
		if( !is_null($this->input->get('busca')) ){
			$campo = $this->input->get('filtro_field', true);
			$valor = $this->input->get('filtro_valor', true);

			if($campo && $valor){
				if( array_key_exists($campo, $this->data['campos']) ){
					$this->db->where("{$campo} LIKE","%".$valor."%");
				}
			}
		}
		
		$result<?php echo ucfirst(camelCase($modulo)); ?> = $this->db
									->select("*")
									->from("<?php echo $modulo; ?> AS <?php echo $qAlias; ?>")
									->limit($perPage,$offset)
									->get();
		
		$this->data['lista<?php echo ucfirst(camelCase($modulo)); ?>'] = $result<?php echo ucfirst(camelCase($modulo)); ?>->result();
		
		$this->load->library('pagination');
		$config['base_url'] = site_url("<?php echo strtolower($modulo); ?>/index")."?";
		$config['total_rows'] = $quantidade<?php echo ucfirst(camelCase($modulo)); ?>;
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
			
			if( $this->form_validation->run('<?php echo ucfirst(camelCase($modulo)); ?>') === FALSE || !empty($this->data['msg_error']) ){
				$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
			} else {
				
				//Preenche objeto com as informações do formulário
				<?php $objeto = "\$" . camelSingular($modulo); ?>
				
				<?php echo $objeto; ?>	= array();
				<?php foreach($camposForm as $campo):?>
				<?php if($campo['tipo'] == "datetime"): ?>
					<?php echo $objeto; ?>['<?php echo $campo['name']; ?>'] 		= _date($this->input->post('<?php echo $campo['name']; ?>', TRUE), "Y-m-d H:i:s");
				<?php else: ?>
					<?php echo $objeto; ?>['<?php echo $campo['name']; ?>'] 		= $this->input->post('<?php echo $campo['name']; ?>', TRUE);
				<?php endif;?>
				<?php endforeach; ?>
				$this->db->insert("<?php echo $modulo; ?>", <?php echo $objeto; ?>);
	
				$this->data['msg_success'] = $this->session->set_flashdata("msg_success", "Registro adicionado com sucesso!");
				redirect('<?php echo strtolower(camelCase($modulo)); ?>/index');
			}
		} 
    	
    }
    
	public function editar(){
		$id = $this->uri->segment(3);
		
		//Campos relacionados
		//caso seja necessario adicione os relacionamento aqui
		//fim Campos relacionados
		

		<?php echo $objeto; ?> = $this->db
						->from("<?php echo $modulo; ?> AS m")
						->where("id", $id)->get()->row();

		if(!<?php echo $objeto; ?>){
			$this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('<?php echo strtolower(camelCase($modulo)); ?>/index');
		} else {
			$this->data['item'] = <?php echo $objeto; ?>;
			if( $this->input->post('enviar') ){
				if( $this->form_validation->run('<?php echo ucfirst(camelCase($modulo)); ?>') === FALSE ){
					$this->data['msg_error'] = (!empty($this->data['msg_error'])) ? $this->data['msg_error'] : validation_errors("<p>","</p>");
				} else {
					
					<?php echo $objeto; ?>	= array();
					<?php foreach($camposForm as $campo):?>
						<?php echo $objeto; ?>['<?php echo $campo['name']; ?>']	= $this->input->post('<?php echo $campo['name']; ?>', true);
					<?php endforeach; ?>

					$this->db->where("id",$id);
					$this->db->update("<?php echo $modulo; ?>",<?php echo $objeto; ?>);
				
					$this->data['msg_success'] = $this->session->set_flashdata("msg_success", "Registro <b>#{<?php echo $objeto; ?>->id}</b> atualizado!");
					redirect('<?php echo strtolower(camelCase($modulo)); ?>/index');
				}
			}
		}
	}
	
	public function delete($id){
		$id = $this->uri->segment(3);
		
		<?php echo $objeto; ?> = $this->db
						->from("<?php echo $modulo; ?> AS m")
						->where("id", $id)->get()->row();
		$this->data['item'] = <?php echo $objeto; ?>;
		
		if( !<?php echo $objeto; ?> ){
			$this->data['msg_error'] = $this->session->set_flashdata("msg_error", "Registro não encontrado!");
			redirect('<?php echo strtolower(camelCase($modulo)); ?>/index');
		} else {
			$this->data['item'] = <?php echo $objeto; ?>;
			
			if( $this->input->post("enviar") ){
				$this->db->where("id", <?php echo $objeto; ?>->id);
				$this->db->delete("<?php echo $modulo; ?>");
				
				$this->data['msg_success'] = $this->session->set_flashdata("msg_success", "Registro excluido com sucesso!");
				redirect('<?php echo strtolower(camelCase($modulo)); ?>/index');
			}
		}
	}
}

/* End of file <?php echo ucfirst(plural($modulo)); ?>.php */
/* Location: ./system/application/controllers/<?php echo ucfirst(plural($modulo)); ?>.php */