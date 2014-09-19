<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function create()
	{
		$this->input->post('project_name');
		$this->input->post('project_description');
		$this->input->post('project_url');
	}

	public function update($id)
	{
		if(is_null($id) || !is_numeric($id))
		{
			# Show error
		}
		else
		{
			$this->input->post('project_name');
			$this->input->post('project_description');
			$this->input->post('project_url');
			# Update project
		}
	}

	public function delete($id=NULL)
	{
		if(is_null($id) || !is_numeric($id))
		{
			# Show error
		}
		else
		{
			# Delete project
		}
	}

	public function view($flag, $id=NULL)
	{
		switch($flag)
		{
			case 'all':
				# Show all projects
				break;

			case 'project':
				if(is_null($id) || !is_numeric($id))
				{
					# Show error
				}
				else
				{
					# Show project profile
				}
				break;

			default:
				# Show error
				break;
		}
	}

}