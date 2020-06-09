<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Controllerhook
{

	public function __construct() {
		$this->CI =& get_instance();
	}

	public function preController(){ }

	public function postController() {
		$this->loadView();
	}

	private function loadView(){
		if( $this->CI->output->get_output() != "" ){
			return;
		}
		
		if(strtolower(get_active_class()) == "rest"){
			return;
		}
		
		$fileModule = strtolower(get_active_class()) . _DS_ . get_active_method() . '.php';
		if( file_exists(APPPATH .'views'. _DS_ . MODULE._DS_.$fileModule) ){
			if(IS_AJAX)
			{
				if( file_exists(FCPATH . APPPATH .'views'. _DS_ . MODULE . _DS_ . strtolower(get_active_class()) . _DS_ . 'ajax' . _DS_ . get_active_method() . '.php') )
					$fileModule = strtolower(get_active_class()) . _DS_ . 'ajax' . _DS_ . get_active_method() . '.php';
				$this->CI->load->view(MODULE._DS_.$fileModule, $this->CI->data);
			}
			else
			{
				$this->CI->load->view(HEADER_TEMPLATE, $this->CI->data);
				$this->CI->load->view(MODULE._DS_.$fileModule, $this->CI->data);
				$this->CI->load->view(FOOTER_TEMPLATE, $this->CI->data);
			}
		}
	}
}