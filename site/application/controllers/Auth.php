<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}
	
	public function login(){
		if( $this->input->post("enviar") !== FALSE ){
			$this->load->model("Usuarios_model");
			if( $usuario = $this->Usuarios_model->getUsuario($this->input->post("usuario")) ){
				if( $this->encrypt->decode($usuario->senha) == $this->input->post("senha", TRUE) ){
					$usuario->perfis = $this->Usuarios_model->getPerfisId($usuario->id);
					#$usuario->setores = $this->Usuarios_model->getSetoresId($usuario->id);
					
					$usuarioLogado = array();
					$usuarioLogado['id'] 	= $usuario->id;
					$usuarioLogado['nome'] 	= $usuario->nome;
					$usuarioLogado['usuario'] 	= $usuario->usuario;
					$usuarioLogado['perfis'] 	= $usuario->perfis;
					$usuarioLogado['setores'] 	= $usuario->setores;
					$usuarioLogado['clientes_id'] = $usuario->clientes_id;
					
					$this->session->set_userdata('userdata',$usuarioLogado);
					
					$urlRedirect = "/";
					if( $this->input->post("r") ){
						$urlRedirect = base64_decode($this->input->post("r",TRUE));	
					}
					
					redirect($urlRedirect); 
				} 
			}
			$this->data['msg_error'] = "Usuário/Senha incorretos";
		}
		$this->load->view("modulos/auth/login");
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect("auth/login");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */