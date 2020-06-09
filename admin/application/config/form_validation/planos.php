<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['Planos'] = array(
							array(
								'field' => "id",
								'label' => "Codigo",
								'rules' => ""
									),
							array(
								'field' => "nome_plano",
								'label' => "Nome",
								'rules' => "required"
									),
							array(
								'field' => "telefone_plano",
								'label' => "Telefone",
								'rules' => ""
									),
							array(
								'field' => "email_plano",
								'label' => "Email",
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

/* End of file planos.php */
/* Location: ./system/application/config/form_validation/planos.php */