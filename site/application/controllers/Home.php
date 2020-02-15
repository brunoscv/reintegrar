<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	public $data;	
	function __construct(){
		parent::__construct();
	}

	public function index(){ 

		//$this->data['categories'] = $this->getCategories();

	}

	public function getEvents($var = null) {
		//$url = "https://jsonplaceholder.typicode.com/posts/42";
		//header('Content-type: application/json');

		$file = array();
		$file = json_decode(file_get_contents(FCPATH . '/public/events.json'), true);
		
		$events = array();
		foreach ( $file as $event ){
			$events = $event;
		}
		return $events;
	}

	public function getCategories($var = null){
		//$url = "https://jsonplaceholder.typicode.com/posts/42";
		//header('Content-type: application/json');

		$file = array();
		$file = json_decode(file_get_contents(FCPATH . '/public/categories.json'), true);
		
		$categories = array();
		foreach ( $file as $category ){
			$categories = $category;
		}
		return $categories;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */