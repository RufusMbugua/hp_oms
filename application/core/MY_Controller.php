<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* The MX_Controller class is autoloaded as required */
class MY_Controller extends MX_Controller{

	public $user;

	function __construct() {
        parent::__construct();
        $this->em = $this->doctrine->em;

        $this->load->library('ion_auth');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

        $this->load->helper('form_helper');

        $this->user = $this->ion_auth->user()->row();
    }


    public function check_for_login($current_page, $restricted_pages)
    {
		if(in_array($current_page, $restricted_pages) && !$this->ion_auth->logged_in())
		{
			redirect('users/login', 'refresh');
		}elseif(!in_array($current_page, $restricted_pages) && $this->ion_auth->logged_in())
		{
			die('You cannot view the <b>'.str_replace('_', ' ', $current_page).'</b> page while logged in.');
		}
    }
}