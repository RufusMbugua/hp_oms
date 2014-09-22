<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('projects_m');
	}

	public function create()
	{
		if($this->input->post('create_project_btn'))
		{
			$create_project = $this->projects_m->create_project();
			if($create_project)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
	}

	public function update($id)
	{
		if(is_null($id) || !is_numeric($id))
		{
			return FALSE;
		}
		else
		{
			$update_project = $this->projects_m->update_project($id);
			if($update_project)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
	}

	public function delete($id=NULL)
	{
		if(is_null($id) || !is_numeric($id))
		{
			return FALSE;
		}
		else
		{
			$delete_project = $this->projects_m->delete_project($id);
			if($delete_project)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
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
					return $projects;
				}
				else
				{
					return FALSE;
				}
				break;

			case 'project':
				if(is_null($id) || !is_numeric($id))
				{
					# Show error
				}
				else
				{
					$project = $this->projects_m->get_project($id);
					if($project)
					{
						return $project;
					}
					else
					{
						return FALSE;
					}
				}
				break;

			default:
				# Show error
				break;
		}
	}

}