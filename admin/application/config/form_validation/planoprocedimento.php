<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['PlanoProcedimento'] = array(
							array(
								'field' => "id",
								'label' => "Codigo",
								'rules' => ""
									),
							array(
								'field' => "valor",
								'label' => "Valor",
								'rules' => "required"
									),
							array(
								'field' => "status",
								'label' => "Status",
								'rules' => ""
									),
							array(
								'field' => "planos_id",
								'label' => "Planos",
								'rules' => "required"
									),
							array(
								'field' => "especialidades_id",
								'label' => "Especialidades",
								'rules' => "required"
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

/* End of file planoprocedimento.php */
/* Location: ./system/application/config/form_validation/planoprocedimento.php */