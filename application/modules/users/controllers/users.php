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
			$activate_user = $this->ion_auth->activate($id);
			if($activate_user)
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

	public function deactivate($id)
	{
		if(is_null($id) || !is_numeric($id))
		{
			die('Numeric value expected in ID.');
		}
		else
		{
			$deactivate_user = $this->ion_auth->deactivate($id);
			if($deactivate_user)
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

	public function login()
	{
		if(!$this->input->post('login_user_btn'))
		{
	        $data['contentView'] = 'users/forms/login_form';
	        $data['title'] = 'Login';
	        $this->template($data);
	    }
	    else
	    {
			$identity = $this->input->post('email_address');
			$password = $this->input->post('account_password');
			$login_user = $this->ion_auth->login($identity, $password);
			if($login_user)
			{
				$user = $this->ion_auth->user()->row();
				$messages = $this->ion_auth->messages();
				echo $messages.'<pre>';
				print_r($user);
				die();
			}
			else
			{
				$errors = $this->ion_auth->errors();
				die($errors);
			}
	    }
	}

	public function forgot_password()
	{
		if(!$this->input->post('forgot_password_btn'))
		{
	        $data['contentView'] = 'users/forms/forgot_password_form';
	        $data['title'] = 'Forgot Password';
	        $this->template($data);
	    }
	    else
	    {
			$identity = $this->ion_auth->where('email', strtolower($this->input->post('email_address')))->users()->row();
			if($identity)
			{
				$forgot_password = $this->ion_auth->forgotten_password($identity->email);
				if($forgot_password)
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
				die('User not found');
			}
		}
	}

	public function reset_password($code = NULL)
	{
		if($code)
		{
			$user = $this->ion_auth->forgotten_password_check($code);
			if($user)
			{
				if(!$this->input->post('reset_password_btn'))
				{
			        $data['contentView'] = 'users/forms/reset_password_form';
			        $data['title'] = 'Reset Password';
			        $this->template($data);
				}
				else
				{
					$reset_password = $this->ion_auth->reset_password($user->email, $this->input->post('new_password'));

					if($reset_password)
					{
						$messages = $this->ion_auth->messages();
						die($messages);
						// $this->logout();
					}
					else
					{
						$errors = $this->ion_auth->errors();
						die($errors);
					}
				}
			}
			else
			{
				die('Invalid code!');
			}
		}
		else{
			show_404();
		}
	}

	public function change_password()
	{
		# Should be logged in
		$user = $this->ion_auth->user()->row();

		if(!$this->input->post('change_password_btn'))
		{
	        $data['contentView'] = 'users/forms/change_password_form';
	        $data['title'] = 'Change Password';
	        $this->template($data);
	    }
	    else
	    {
			$change_password = $this->ion_auth->change_password($user->email, $this->input->post('old_password'), $this->input->post('new_password'));
			if($change_password)
			{
				$messages = $this->ion_auth->messages();
				die($messages);
				// $this->logout();
			}
			else
			{
				$errors = $this->ion_auth->errors();
				die($errors);
			}
	    }
	}

	public function view($flag, $id=NULL, $action=NULL)
	{
		switch($flag)
		{
			case 'all':
				$users = $this->ion_auth->users()->row();

				echo '<pre>';
				print_r($users);
				die();
				break;

			case 'user':
				if(is_null($id) || !is_numeric($id))
				{
					die('Numeric value expected in ID.');
				}
				else
				{
					switch($action)
					{
						case 'view':
							echo '<pre>';
							print_r($user);
							die();
							break;
						case 'assign_group':
							$this->_assign_group($id);
							break;
						default:
							die('Could not process your request');
							break;
					}
					$user = $this->ion_auth->user($id)->row();
					
				}
				break;

			default:
				die('Could not process your request');
				break;
		}
	}

	function _assign_group($id)
	{
		if(is_null($id) || !is_numeric($id))
		{
			die('Numeric value expected in ID.');
		}
		else
		{
			if(!$this->input->post('assign_group_btn'))
			{
		        $data['contentView'] = 'users/forms/assign_group_form';
		        $data['title'] = 'Assign Group';
		        $data['user'] = $this->ion_auth->user($id)->row();
		        $data['groups_info'] = $this->ion_auth->groups()->result();
		        $this->template($data);
		    }
		    else
		    {
		    	$group_id = $this->input->post('group_id');
				$user_groups = $this->ion_auth->get_users_groups($id)->result();

				if(count($user_groups) !== 0)
				{
					# Remove user from groups
					foreach($user_groups as $user_group)
					{
						$this->ion_auth->remove_from_group($user_group->id, $id);
					}
				}

				$assign_group = $this->ion_auth->add_to_group($group_id, $id);
				if($assign_group)
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