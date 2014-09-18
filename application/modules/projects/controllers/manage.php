<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('manage_m');

		$this->load->library('ion_auth');

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
	}

	public function index(){
		// Projects dashboard where all project actions can be triggered from
    }

	public function create_category(){
		$this->form_validation->set_rules('category_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('category_description', 'Description', 'trim|required');
		
		if(!$this->input->post('create_category_btn') && $this->form_validation->run() == false){
			// Show the form
		}else{
			$create_category = $this->manage_m->create_project_category();
			if($create_category){
				// Return confirmation
			}else{
				// Return error response
			}
		}
	}

	public function update_category($category_id){
		$this->form_validation->set_rules('category_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('category_description', 'Description', 'trim|required');
		
		if(!$this->input->post('update_category_btn') && $this->form_validation->run() == false){
			// Show the form
		}else{
			$update_category = $this->manage_m->update_project_category($category_id);
			if($update_category){
				// Return confirmation
			}else{
				// Return error response
			}
		}
	}

	public function create_project(){
		$this->form_validation->set_rules('project_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('project_description', 'Description', 'trim|required');
		$this->form_validation->set_rules('project_url', 'URL', 'trim|required');
		$this->form_validation->set_rules('project_category', 'Category', 'required');
		
		if(!$this->input->post('create_project_btn') && $this->form_validation->run() == false){
			// Show the form
		}else{
			$create_project = $this->manage_m->create_project();
			if($create_project){
				// Return confirmation
			}else{
				// Return error response
			}
		}
	}

	public function update_project($project_id){
		$this->form_validation->set_rules('project_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('project_description', 'Description', 'trim|required');
		$this->form_validation->set_rules('project_url', 'URL', 'trim|required');
		$this->form_validation->set_rules('project_category', 'Category', 'required');
		
		if(!$this->input->post('update_project_btn') && $this->form_validation->run() == false){
			// Show the form
		}else{
			$update_project = $this->manage_m->update_project($project_id);
			if($update_project){
				// Return confirmation
			}else{
				// Return error response
			}
		}
	}

	public function view_projects(){
		$projects = $this->manage_m->get_projects();
		// Return projects
	}

	public function view_project($project_id){
		$project = $this->manage_m->get_project($project_id);
		// Return project
	}

}