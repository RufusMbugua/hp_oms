<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('projects_m');
	}

	public function create()
	{
		$this->form_validation->set_rules('project_name', 'Project Name', 'trim|required');
		$this->form_validation->set_rules('project_description', 'Project Description', 'trim|required');
		$this->form_validation->set_rules('project_url', 'Project URL', 'trim|required|prep_url');
		if(!$this->input->post('create_project_btn') || $this->form_validation->run() == FALSE)
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

	public function manage($id, $action)
	{
		if(!is_numeric($id))
		{
			die('Numeric value expected in ID.');
		}
		else
		{
			switch ($action) {
				case 'update':
					$this->_update($id);
					break;
				
				case 'delete':
					$this->_delete($id);
					break;
				
				default:
					die('Could not process your request');
					break;
			}

		}
	}

	public function view($flag)
	{
		if(is_numeric($flag))
		{
			$project = $this->projects_m->get_project($flag);
			if($project)
			{
				echo 'The '.$project->project_name.' Project <pre>';
				print_r($project);
				echo '</pre>';
			}
			else
			{
				die('Could not get project');
			}
		}
		elseif($flag === 'all')
		{
			$projects = $this->projects_m->get_projects();
			if($projects)
			{
				echo 'All Projects <pre>';
				print_r($projects);
				echo '</pre>';
			}
			else
			{
				die('Could not get projects or none have been added yet');
			}
		}
		else
		{
			die('Could not process your request');
		}
	}

	function _update($id)
	{
    	$project = $this->projects_m->get_project($id);
    	if(is_object($project))
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
				$update_project = $this->projects_m->update_project($project->project_id);
				if($update_project)
				{
					redirect('projects/manage/'.$id.'/update', 'refresh');
				}
				else
				{
					die('Could not update project.');
				}
			}
    	}
    	else
    	{
			die('The project with the ID <b>'.$id.'</b> was not found.');
    	}
	}

	function _delete($id=NULL)
	{
		if(is_null($id) || !is_numeric($id))
		{
			die('Numeric value expected in ID.');
		}
		else
		{
	    	$project = $this->projects_m->get_project($id);
	    	if(is_object($project))
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
	    	else
	    	{
				die('The project with the ID <b>'.$id.'</b> was not found.');
	    	}
		}
	}

    public function template($data) {
        $this->load->module('template');
        $this->template->index($data);
    }

}