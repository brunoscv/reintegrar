<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['Permissoes'] = array(
							array(
								'field' => "id",
								'label' => "id",
								'rules' => ""
									),
							array(
								'field' => "metodos_id",
								'label' => "metodos_id",
								'rules' => "required"
									),
							array(
								'field' => "usuarios_id",
								'label' => "usuarios_id",
								'rules' => "required"
									),
);

/* End of file permissoes.php */
/* Location: ./system/application/config/form_validation/permissoes.php */