<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function create()
	{
		$this->input->post('group_name');
		$this->input->post('group_description');
	}

	public function update($id)
	{
		if(is_null($id) || !is_numeric($id))
		{
			# Show error
		}
		else
		{
			$this->input->post('group_name');
			$this->input->post('group_description');
			# Update group
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
			# Delete group
		}
	}

	public function view($flag, $id=NULL)
	{
		switch($flag)
		{
			case 'all':
				# Show all groups
				break;

			case 'group':
				if(is_null($id) || !is_numeric($id))
				{
					# Show error
				}
				else
				{
					# Show group profile
				}
				break;

			default:
				# Show error
				break;
		}
	}

}