<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function create()
	{
		$this->input->post('surname');
		$this->input->post('other_names');
		$this->input->post('gender');
		$this->input->post('birthday');
		$this->input->post('email_address');
		$this->input->post('phone');
	}

	public function update($id)
	{
		if(is_null($id) || !is_numeric($id))
		{
			# Show error
		}
		else
		{
			$this->input->post('surname');
			$this->input->post('other_names');
			$this->input->post('gender');
			$this->input->post('birthday');
			$this->input->post('phone');
			# Update user
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
			# Delete user
		}
	}

	public function activate($id)
	{
		if(is_null($id) || !is_numeric($id))
		{
			# Show error
		}
		else
		{
			# Activate user
		}
	}

	public function deactivate($id)
	{
		if(is_null($id) || !is_numeric($id))
		{
			# Show error
		}
		else
		{
			# Deactivate user
		}
	}

	public function view($flag, $id=NULL)
	{
		switch($flag)
		{
			case 'all':
				# Show all users
				break;

			case 'user':
				if(is_null($id) || !is_numeric($id))
				{
					# Show error
				}
				else
				{
					# Show user profile
				}
				break;

			default:
				# Show error
				break;
		}
	}

	public function assign_group($id)
	{
		if(is_null($id) || !is_numeric($id))
		{
			# Show error
		}
		else
		{
			# Assign group
		}
	}

	public function update_group_assignment($flag, $id)
	{
		if(is_null($id) || !is_numeric($id))
		{
			# Show error
		}
		else
		{
			switch($flag)
			{
				case 'add':
					# Add to passed group
					break;

				case 'remove':
					# Remove from passed group
					break;

				default:
					# Show error
					break;
			}
		}
	}

	public function assign_project($id)
	{
		if(is_null($id) || !is_numeric($id))
		{
			# Show error
		}
		else
		{
			# Assign user to passed project
			# If user alerdy in other project, alert (needs confirmation). If not, just assign
		}
	}

}