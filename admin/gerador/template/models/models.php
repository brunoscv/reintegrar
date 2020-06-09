{?php

class <?php echo ucfirst(camelCase($modulo)); ?>_model extends CI_Model
{
	public $table = "<?php echo strtolower($modulo)?>";

	public function __construct()
	{
		parent::__construct();
	}
	
}
