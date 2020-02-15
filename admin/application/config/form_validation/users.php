<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['Users'] = array(
							array(
								'field' => "id",
								'label' => "Id",
								'rules' => ""
									),
							array(
								'field' => "usuario",
								'label' => "email_valid",
								'rules' => "required"
									),
							array(
								'field' => "senha",
								'label' => "Senha",
								'rules' => "required"
									),
							array(
								'field' => "email",
								'label' => "Email",
								'rules' => "required"
									),
							array(
								'field' => "cidades_id",
								'label' => "cidades_id",
								'rules' => ""
									),
							array(
								'field' => "estados_id",
								'label' => "estados_id",
								'rules' => ""
									),
);


$config['Users/editar'] = array(
							array(
								'field' => "id",
								'label' => "Id",
								'rules' => ""
									),
							array(
								'field' => "usuario",
								'label' => "Usuario",
								'rules' => "required"
									),
							array(
								'field' => "senha",
								'label' => "Senha",
								'rules' => ""
									),
							array(
								'field' => "email",
								'label' => "Email",
								'rules' => "required|valid_email"
									),
							array(
								'field' => "cidades_id",
								'label' => "cidades_id",
								'rules' => ""
									),
							array(
								'field' => "estados_id",
								'label' => "estados_id",
								'rules' => ""
									),
);

/* End of file users.php */
/* Location: ./system/application/config/form_validation/users.php */