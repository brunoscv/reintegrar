<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rest extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}
	
	public function loadCidades(){
		header('Content-Type: application/json');
		
		$listaCidades = array(); 
		$listaCidades[0]['text'] = "Selecione uma cidade";
		$listaCidades[0]['id'] = "";

		if( $this->input->get("estado_id") ){
			$this->load->model("Estados_model");
			if( $cidades = $this->Estados_model->listaCidadesPorEstado($this->input->get("estado_id")) ){
				foreach($cidades as $k=>$cidade){
					$k++;
					$listaCidades[$k]['text'] = $cidade->nome;
					$listaCidades[$k]['id'] = $cidade->id;
				}
			}
		}
		$result['data'] = $listaCidades;
		echo json_encode($result);
	}

	public function upload(){
		$config['upload_path'] = FCPATH . '/public/uploads/'.date("Y/m");
		if( !is_dir($config['upload_path']) ){
			mkdir($config['upload_path'], 0777, TRUE);
		}
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= 2*1024;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		header('Content-Type: application/json');
		if ( !$this->upload->do_upload("file") )
		{
			$error = array('error' => $this->upload->display_errors());
			echo '{"error":true, "message":'.json_encode($this->upload->display_errors()).'}';
		} else {
			$data = array('upload_data' => $this->upload->data());
			$data['upload_data']['file_name'] = date("Y/m/") . $data['upload_data']['file_name'];
			echo '{"sucesso":true, "arquivo":'.json_encode($data['upload_data']).'}';
		}
		exit;
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */