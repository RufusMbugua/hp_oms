<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
	}

	public function create()
	{
		if(!$this->input->post('create_user_btn'))
		{
	        $data['contentView'] = 'users/forms/create_user_form';
	        $data['title'] = 'Create User';
	        $this->template($data);
	    }
	    else
	    {
			$username = strtolower($this->input->post('surname'));
			$password = '12345678';
			$email = $this->input->post('email_address');
			$additional_data = array(
				'surname' => $this->input->post('surname'),
				'other_names' => $this->input->post('other_names'),
				'gender' => $this->input->post('gender'),
				'birthday' => $this->input->post('birthday'),
				'phone' => $this->input->post('phone'),
			);
			$create_user = $this->ion_auth->register($username, $password, $email, $additional_data);
			if($create_user)
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
	}

	public function update($id)
	{
		if(is_null($id) || !is_numeric($id))
		{
			die('Numeric value expected in ID.');
		}
		else
		{
			$this->input->post('surname');
			$this->input->post('other_names');
			$this->input->post('gender');
			$this->input->post('birthday');
			$this->input->post('phone');

			if(!$this->input->post('update_user_btn'))
			{
		        $data['contentView'] = 'users/forms/update_user_form';
		        $data['title'] = 'Update User';
		        $data['user'] = $this->ion_auth->user($id)->row();
		        $this->template($data);
		    }
		    else
		    {
				$data = array(
					'surname' => $this->input->post('surname'),
					'other_names' => $this->input->post('other_names'),
					'gender' => $this->input->post('gender'),
					'birthday' => $this->input->post('birthday'),
					'phone' => $this->input->post('phone'),
				);
				$update_user = $this->ion_auth->update($id, $data);
				if($update_user)
				{
					redirect('users/update/'.$id);
				}
				else
				{
					$errors = $this->ion_auth->errors();
					die($errors);
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
			$delete_user = $this->ion_auth->delete_user($id);
			if($delete_user)
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
	}

	public function activate($id)
	{
		if(is_null($id) || !is_numeric($id))
		{
			die('Numeric value expected in ID.');
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

	public function login()
	{
		
	}

	public function forgot_password()
	{
		
	}

	public function reset_password($code)
	{
		
	}

	public function change_password()
	{
		
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

    public function template($data) {
        $this->load->module('template');
        $this->template->index($data);
    }

}