<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends MY_Controller {

	public function __construct(){
		parent::__construct();
		
		//$this->_auth();
		
		$this->data['campos'] = array(
			'u.nome' => 'Nome',
			'u.email' => 'E-mail'
		);
		
    }

    public function index($id = null) {
       $this->data['user_id'] = $id;
    }
}