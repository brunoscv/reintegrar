<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['PeriodoConsulta'] = array(
							array(
								'field' => "id",
								'label' => "Id",
								'rules' => ""
									),
							array(
								'field' => "data",
								'label' => "Data Atendimento",
								'rules' => "required"
									),
							array(
								'field' => "status",
								'label' => "Status",
								'rules' => ""
									),
							array(
								'field' => "consultas_id",
								'label' => "Cod. Consulta",
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

/* End of file periodoconsulta.php */
/* Location: ./system/application/config/form_validation/periodoconsulta.php */