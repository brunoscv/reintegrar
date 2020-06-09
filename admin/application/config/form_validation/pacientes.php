<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['Pacientes'] = array(
							array(
								'field' => "id",
								'label' => "Codigo",
								'rules' => ""
									),
							array(
								'field' => "nome_pac",
								'label' => "Nome",
								'rules' => "required"
									),
							array(
								'field' => "email_pac",
								'label' => "Email",
								'rules' => ""
									),
							array(
								'field' => "telefone_pac",
								'label' => "Telefone",
								'rules' => ""
									),
							array(
								'field' => "status",
								'label' => "Status",
								'rules' => ""
									),
							array(
								'field' => "createdAt",
								'label' => "createdAt",
								'rules' => ""
									),
							array(
								'field' => "updatedAt",
								'label' => "updatedAt",
								'rules' => ""
									),
);

/* End of file pacientes.php */
/* Location: ./system/application/config/form_validation/pacientes.php */