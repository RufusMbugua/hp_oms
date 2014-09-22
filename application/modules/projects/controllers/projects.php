<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('projects_m');
	}

	public function create()
	{
		if(!$this->input->post('create_project_btn'))
		{
	        $data['contentView'] = 'projects/forms/create_project_form';
	        $data['title'] = 'Create Project';
	        $this->template($data);
	    }
	    else
	    {
			$create_project = $this->projects_m->create_project();
			if($create_project)
			{
				die('Project created.');
			}
			else
			{
				die('Could not create project.');
			}
	    }
	}

	public function update($id)
	{
		if(is_null($id) || !is_numeric($id))
		{
			die('Numeric value expected in ID.');
		}
		else
		{
			if(!$this->input->post('update_project_btn'))
			{
		        $data['contentView'] = 'projects/forms/update_project_form';
		        $data['title'] = 'Update Project';
		        $data['project'] = $this->projects_m->get_project($id);
		        $this->template($data);
		    }
		    else
		    {
				$update_project = $this->projects_m->update_project($id);
				if((bool) $update_project)
				{
					redirect('projects/update/'.$id, 'refresh');
				}
				else
				{
					die('Could not update project details');
				}
		    }
		}
	}

	public function delete($id=NULL)
	{
		if(is_null($id) || !is_numeric($id))
		{
			die('Numeric value expected in ID.');
		}
		else
		{
			$delete_project = $this->projects_m->delete_project($id);
			if($delete_project)
			{
				die('Project deleted');
			}
			else
			{
				die('Could not delete project!');
			}
		}
	}

	public function view($flag, $id=NULL)
	{
		switch($flag)
		{
			case 'all':
				$projects = $this->projects_m->get_projects();
				if($projects)
				{
					echo '<pre>';
					print_r($projects);
				}
				else
				{
					die('Could not get projects or none are listed');
				}
				break;

			case 'project':
				if(is_null($id) || !is_numeric($id))
				{
					die('Numeric value expected in ID.');
				}
				else
				{
					$project = $this->projects_m->get_project($id);
					if($project)
					{
						echo '<pre>';
						print_r($project);
					}
					else
					{
						die('Could not get project');
					}
				}
				break;

			default:
				die('Could not process your request');
				break;
		}
	}

    public function template($data) {
        $this->load->module('template');
        $this->template->index($data);
    }

}