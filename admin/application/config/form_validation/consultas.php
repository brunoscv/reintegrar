<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['Consultas'] = array(
	array(
		'field' => "pacientes_id",
		'label' => "Paciente",
		'rules' => "required"
	),
	array(
		'field' => "especialidades_id",
		'label' => "Especialidades",
		'rules' => "required"
	),
	array(
		'field' => "profissionais_id",
		'label' => "Profissionais",
		'rules' => "required"
	),
	array(
		'field' => "planos_id",
		'label' => "Planos",
		'rules' => "required"
	),
	array(
		'field' => "horarios_id",
		'label' => "Horarios",
		'rules' => "required"
	),
	array(
		'field' => "dias_semana_id",
		'label' => "Dia Semana",
		'rules' => "required"
	),
);

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
		'rules' => "required"
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
/* End of file consultas.php */
/* Location: ./system/application/config/form_validation/consultas.php */