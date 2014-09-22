<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_m extends CI_Model {

	public function create_project()
	{
		$this->input->post('project_name');
		$this->input->post('project_description');
		$this->input->post('project_url');
	}

	public function update_project($id)
	{
		$this->input->post('project_name');
		$this->input->post('project_description');
		$this->input->post('project_url');
	}

	public function delete_project($id)
	{

	}

	public function get_project($id)
	{

	}

	public function get_projects()
	{

	}

}