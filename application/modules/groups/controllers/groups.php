<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->ion_auth->logged_in())
		{
			redirect('users/login', 'refresh');
		}
	}

	public function create()
	{
		$this->form_validation->set_rules('group_name', 'Group Name', 'trim|required|is_unique[groups.name]');
		$this->form_validation->set_rules('group_description', 'Group Description', 'trim|required');
		if(!$this->input->post('create_group_btn') || $this->form_validation->run() == FALSE)
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
				$errors = $this->ion_auth->errors();
				die($errors);
			}
			else
			{
				die('Group created!');
			}
	    }
	}

	public function update($id)
	{
		$group = $this->ion_auth->group($id)->result();

		if(is_array($group))
		{
			$this->form_validation->set_rules('group_name', 'Group Name', 'trim|required|is_unique[groups.name]');
			$this->form_validation->set_rules('group_description', 'Group Description', 'trim|required');
			if(!$this->input->post('update_group_btn') || $this->form_validation->run() == FALSE)
			{
		        $data['contentView'] = 'groups/forms/update_group_form';
		        $data['title'] = 'Update Group';
		        $data['group_info'] = $group;
		        $this->template($data);
		    }
		    else
		    {
				if(!is_numeric($id))
				{
					die('Numeric value expected in ID.');
				}
				else
				{
					$group_name = $this->input->post('group_name');
					$group_description = $this->input->post('group_description');
					
					$update_group = $this->ion_auth->update_group($id, $group_name, $group_description);
					if($update_group)
					{
						die('Group updated!');
					}
					else
					{
						$errors = $this->ion_auth->errors();
						die($errors);
					}
				}
			}
		}
		else
		{
			die('Group not found');
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
			$group = $this->ion_auth->group($id)->result();
			if(count($group) !== 0)
			{
				$delete_group = $this->ion_auth->delete_group($id);
				if($delete_group)
				{
					$messages = $this->ion_auth->messages();
					die($messages);
				}
				else
				{
					$errors = $this->ion_auth->errors();
					die($errors);
				}
			}
			else
			{
				die('Group not found');
			}
		}
	}

	public function view($flag, $id=NULL)
	{
		switch($flag)
		{
			case 'all':
				$groups = $this->ion_auth->groups()->result();
				if(count($groups) !== 0)
				{
					echo '<pre>';
					print_r($groups); 
				}
				else
				{
					die('No groups found');
				}
				break;

			case 'group':
				if(is_null($id) || !is_numeric($id))
				{
					die('Numeric value expected in ID.');
				}
				else
				{
					$group = $this->ion_auth->group($id)->result();
					if(count($group) !== 0)
					{
						echo '<pre>';
						print_r($group); 
					}
					else
					{
						die('Group not found.');
					}
				}
				break;

			default:
				die('Could not process request.');
				break;
		}
	}

    public function template($data) {
        $this->load->module('template');
        $this->template->index($data);
    }

}