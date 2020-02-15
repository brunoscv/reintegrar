<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['Consultas'] = array(
							array(
								'field' => "id",
								'label' => "Cod.",
								'rules' => ""
									),
							array(
								'field' => "pacientes_id",
								'label' => "Paciente",
								'rules' => "required"
									),
							array(
								'field' => "profissionais_id",
								'label' => "Profissional",
								'rules' => "required"
									),
							array(
								'field' => "qtd_atendimentos",
								'label' => "Qtd. Atendimentos",
								'rules' => "required"
									),
							array(
								'field' => "freq_atendimentos",
								'label' => "Freq. Atendimentos",
								'rules' => "required"
									),
							array(
								'field' => "data_inicio",
								'label' => "Inicio",
								'rules' => "required"
									),
							array(
								'field' => "data_fim",
								'label' => "Fim",
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

/* End of file consultas.php */
/* Location: ./system/application/config/form_validation/consultas.php */