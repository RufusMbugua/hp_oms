<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends MX_Controller {

	function __construct()
	{

	}
  
	public function index()
	{
		$this->load->view("index");
	}
	
}

/* End of file calendar.php */
/* Location: ./application/modules/calendar/calendar.php */