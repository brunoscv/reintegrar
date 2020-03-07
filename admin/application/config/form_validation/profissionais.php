<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['Profissionais'] = array(
							array(
								'field' => "id",
								'label' => "Codigo",
								'rules' => ""
									),
							array(
								'field' => "nome_prof",
								'label' => "Nome",
								'rules' => "required"
									),
							array(
								'field' => "telefone_prof",
								'label' => "Telefone",
								'rules' => ""
									),
							array(
								'field' => "email_prof",
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
							array(
								'field' => "especialidades_id",
								'label' => "especialidades_id",
								'rules' => ""
									),
);

/* End of file profissionais.php */
/* Location: ./system/application/config/form_validation/profissionais.php */