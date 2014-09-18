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

	public function create_project(){
		// Array of data. !!--> Include project roles

	}

	public function update_project($project_id, $project_data){

	}

}