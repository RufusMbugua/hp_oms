<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH."third_party/MX/Loader.php";

class MY_Loader extends MX_Loader {

	function __construct() {
		parent::__construct();
	}
	/**
	 *template
	 *
	 * Acts as a simple way load a view within a template
	 *
	 * @access	public
	 * @param	$data
	 *
	 *		@example :
	 *			$data['contentView'] = 'users/login_form';
	 *      	$data['title'] = 'Access Account';
	 *
	 * @return	bool
	 * @usage 	$this->load->template($data);
	 *
	 **/
	public function template($data =null) {

		if(is_null($data)){
			show_error('No $data parsed to template');
			return false;

		}else{			
			$this->load->module('template');
			$this->template->index($data);

			return true;
		}

	}
}