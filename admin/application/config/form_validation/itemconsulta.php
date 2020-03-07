<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['ItemConsulta'] = array(
							array(
								'field' => "id",
								'label' => "Id",
								'rules' => ""
									),
							array(
								'field' => "horarios_id",
								'label' => "",
								'rules' => "required"
									),
							array(
								'field' => "dia_semana_id",
								'label' => "Dia Semana",
								'rules' => "required"
									),
							array(
								'field' => "status",
								'label' => "Status",
								'rules' => ""
									),
							array(
								'field' => "periodo_consulta_id",
								'label' => "Periodo Consuta",
								'rules' => ""
									),
							array(
								'field' => "consultas_id",
								'label' => "Cod Consulta",
								'rules' => ""
									),
							array(
								'field' => "createdAT",
								'label' => "createdAT",
								'rules' => ""
									),
							array(
								'field' => "updatedAt",
								'label' => "updatedAt",
								'rules' => ""
									),
);

/* End of file itemconsulta.php */
/* Location: ./system/application/config/form_validation/itemconsulta.php */