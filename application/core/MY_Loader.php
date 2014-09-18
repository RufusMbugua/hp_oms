<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH."third_party/MX/Loader.php";

class MY_Loader extends MX_Loader {

	function __construct() {
		parent::__construct();
	}

	public function template($data =null) {

		if(!is_null($data)){
			$this->load->module('template');
			$this->template->index($data);
		}else{			
			show_error('No $data parsed to template');
		}

	}
}