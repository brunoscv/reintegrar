<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['Atendimentos'] = array(
							array(
								'field' => "id",
								'label' => "Cod.",
								'rules' => ""
									),
							array(
								'field' => "consultas_id",
								'label' => "Cod. Consulta",
								'rules' => ""
									),
							array(
								'field' => "qtd_atendimentos",
								'label' => "Qtd Atendimentos",
								'rules' => "required"
									),
							array(
								'field' => "freq_atendimentos",
								'label' => "Freq. Atendimentos",
								'rules' => "required"
									),
							array(
								'field' => "data_ref",
								'label' => "Data Ref.",
								'rules' => "required"
									),
							array(
								'field' => "status",
								'label' => "Status",
								'rules' => ""
									),
							array(
								'field' => "createdAt",
								'label' => "Criado",
								'rules' => ""
									),
							array(
								'field' => "updatedAt",
								'label' => "Modificado",
								'rules' => ""
									),
);

/* End of file atendimentos.php */
/* Location: ./system/application/config/form_validation/atendimentos.php */