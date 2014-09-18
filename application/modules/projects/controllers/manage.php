<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('html');
	}

	public function index(){
		// Projects dashboard where all project actions can be triggered from
    }

	public function new_category(){

	}

	public function edit_category($category_id){

	}

	public function create_project(){

	}

	public function update_project($project_id){

	}

}