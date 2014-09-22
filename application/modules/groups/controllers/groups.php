<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
	}

	public function create()
	{
		if(!$this->input->post('create_group_btn'))
		{
	        $data['contentView'] = 'groups/forms/create_group_form';
	        $data['title'] = 'Create Group';
	        $this->template($data);
	    }
	    else
	    {
			$group_name = $this->input->post('group_name');
			$group_description = $this->input->post('group_description');

			$create_group = $this->ion_auth->create_group($group_name, $group_description);
			if(!$create_group)
			{
				return FALSE;
			}
			else
			{
				return TRUE;
			}
	    }
	}

	public function update($id)
	{
		if(!$this->input->post('update_group_btn'))
		{
	        $data['contentView'] = 'groups/forms/update_group_form';
	        $data['title'] = 'Update Group';
	        $data['group_info'] = $this->view('group', $id);
	        $this->template($data);
	    }
	    else
	    {
			if(is_null($id) || !is_numeric($id))
			{
				return FALSE;
			}
			else
			{
				$group_name = $this->input->post('group_name');
				$group_description = $this->input->post('group_description');
				
				$update_group = $this->ion_auth->update_group($id, $group_name, $group_description);
				if($update_group)
				{
					return TRUE;
				}
				else
				{
					return FALSE;
				}
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
			$delete_group = $this->groups_m->delete_group($id);
			if($update_group)
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
				$groups = $this->ion_auth->groups()->result();
				if($groups)
				{
					return $groups; 
				}
				else
				{
					return FALSE;
				}
				break;

			case 'group':
				if(is_null($id) || !is_numeric($id))
				{
					return FALSE;
				}
				else
				{
					$group = $this->ion_auth->group($id)->result();
					if(is_array($group))
					{
						return $group;
					}
					else
					{
						return FALSE;
					}
				}
				break;

			default:
				return FALSE;
				break;
		}
	}

    public function template($data) {
        $this->load->module('template');
        $this->template->index($data);
    }

}