<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['HorariosProfissionais'] = array(
							array(
								'field' => "id",
								'label' => "id",
								'rules' => ""
									),
							array(
								'field' => "status",
								'label' => "status",
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
								'field' => "horarios_id",
								'label' => "horarios_id",
								'rules' => "required"
									),
							array(
								'field' => "dias_semana_id",
								'label' => "dias_semana_id",
								'rules' => "required"
									),
							array(
								'field' => "profissionais_id",
								'label' => "profissionais_id",
								'rules' => "required"
									),
);

/* End of file horariosprofissionais.php */
/* Location: ./system/application/config/form_validation/horariosprofissionais.php */