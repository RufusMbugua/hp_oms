<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$restricted_pages = array('create', 'update', 'delete', 'manage', 'change_password', 'view', 'logout');
		$current_page = $this->uri->segment(2);

		$this->check_for_login($current_page, $restricted_pages);

		$this->load->model('users_m');
	}

	public function create()
	{
		$this->form_validation->set_rules('surname', 'Surname', 'trim|required');
		$this->form_validation->set_rules('other_names', 'Other Names', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('birthday', 'Birthday', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required|is_numeric|exact_length[10]|is_unique[users.phone]');
		$this->form_validation->set_rules('email_address', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		if(!$this->input->post('create_user_btn') || $this->form_validation->run() == FALSE)
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
				
				case 'activate':
					$this->_activate($id);
					break;
				
				case 'deactivate':
					$this->_deactivate($id);
					break;
				
				case 'add_to_group':
					$this->_add_to_group($id);
					break;
				
				case 'remove_from_group':
					$this->_remove_from_group($id);
					break;
				
				case 'add_to_project':
					$this->_add_to_project($id);
					break;
				
				case 'remove_from_project':
					$this->_remove_from_project($id);
					break;
				
				default:
					die('Could not process your request');
					break;
			}

		}
	}

	public function login()
	{
		$this->form_validation->set_rules('email_address', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('account_password', 'Password', 'required');
		if(!$this->input->post('login_user_btn') || $this->form_validation->run() == FALSE)
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
				// Shows your profile // redirect('users/view/user/'.$this->user->user_id, 'refresh');
				redirect('users/view/me', 'refresh');
			}
			else
			{
				$errors = $this->ion_auth->errors();
				die($errors);
			}
	    }
	}

	public function logout()
	{
		$this->ion_auth->logout();
		redirect('users/login', 'refresh');
	}

	public function forgot_password()
	{
		$this->form_validation->set_rules('email_address', 'Email', 'required|valid_email');
		if(!$this->input->post('forgot_password_btn') || $this->form_validation->run() == FALSE)
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
				$this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[8]|max_length[50]');
				$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');
				if(!$this->input->post('reset_password_btn') || $this->form_validation->run() == FALSE)
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

	public function view($flag)
	{
		if(is_numeric($flag))
		{
			$user = $this->ion_auth->user($flag)->row();
			if(is_object($user))
			{
				if($user->user_id === $this->user->user_id)
				{
					echo '<legend>My Profile</legend>';
				}
				else
				{
					echo '<legend>'.$user->surname.' '.$user->other_names.'</legend>';
				}
				echo '<pre>';
				print_r($user);
				echo '</pre>';

				$user_groups = $this->ion_auth->get_users_groups($user->user_id)->result();
				echo '<legend>Group In</legend>';
				echo '<pre>';
				print_r($user_groups);
				echo '</pre>';
				die();
			}
			else
			{
				die('User with the ID <b>'.$flag.'</b> was not found.');
			}
		}
		elseif(is_string($flag))
		{
			switch ($flag) {
				case 'all':
					$users = $this->ion_auth->users()->result();
					if(is_array($users))
					{
						echo '<legend>All Users</legend>';
						echo '<pre>';
						print_r($users);
						echo '</pre>';
						die();
					}
					else
					{
						die('Users not found.');
					}
					break;
				
				case 'me':
					echo '<legend>'.$this->user->surname.' '.$this->user->other_names.'</legend>';
					echo '<pre>';
					print_r($this->user);
					echo '</pre>';

					$user_groups = $this->ion_auth->get_users_groups($this->user->user_id)->result();
					echo '<legend>Group In</legend>';
					echo '<pre>';
					print_r($user_groups);
					echo '</pre>';

					die();
					break;
				
				default:
					# code...
					break;
			}
		}
		else
		{
			die('Could not process request');
		}
	}

	function _update($id)
	{
		if(!is_numeric($id))
		{
			die('Numeric value expected in ID.');
		}
		else
		{
			$user = $this->ion_auth->user($id)->row();
			if(is_object($user))
			{
				$this->form_validation->set_rules('surname', 'Surname', 'trim|required');
				$this->form_validation->set_rules('other_names', 'Other Names', 'trim|required');
				$this->form_validation->set_rules('gender', 'Gender', 'required');
				$this->form_validation->set_rules('birthday', 'Birthday', 'trim|required');
				
				$phone = $this->input->post('phone');
				if($phone && ($phone !== $user->phone))
				{
					$this->form_validation->set_rules('phone', 'Phone', 'trim|required|is_numeric|exact_length[10]|is_unique[users.phone]');
				}

				if(!$this->input->post('update_user_btn') || $this->form_validation->run() == FALSE)
				{
			        $data['contentView'] = 'users/forms/update_user_form';
			        $data['title'] = 'Update User';
			        $data['user'] = $user;
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
						redirect('users/manage/'.$id.'/update');
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
				die('User with the ID <b>'.$id.'</b> was not found.');
			}
		}
	}

	function _delete($id=NULL)
	{
		if(!is_numeric($id))
		{
			die('Numeric value expected in ID.');
		}
		else
		{
			$user = $this->ion_auth->user($id)->row();
			if(is_object($user))
			{
				$delete_user = $this->ion_auth->delete_user($user->id);
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
			else
			{
				die('User with the ID <b>'.$id.'</b> was not found.');
			}
		}
	}

	function _activate($id)
	{
		$user = $this->ion_auth->user($id)->row();
		if(is_object($user))
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
		else
		{
			die('User with the ID <b>'.$id.'</b> was not found.');
		}
	}

	function _deactivate($id)
	{
		$user = $this->ion_auth->user($id)->row();
		if(is_object($user))
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
		else
		{
			die('User with the ID <b>'.$id.'</b> was not found.');
		}
	}

	function _add_to_group($id)
	{
		if(!$this->input->post('add_to_group_btn'))
		{
	        $data['contentView'] = 'users/forms/add_to_group_form';
	        $data['title'] = 'Add to Group';
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
				die('User added to group!');
			}
			else
			{
				$errors = $this->ion_auth->errors();
				die($errors);
			}
		}
	}

	function _remove_from_group($id)
	{
		if(!$this->input->post('remove_from_group_btn'))
		{
	        $data['contentView'] = 'users/forms/remove_from_group_form';
	        $data['title'] = 'Remove from Group';
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
				die('User removed from group!');
			}
			else
			{
				$errors = $this->ion_auth->errors();
				die($errors);
			}
		}
	}

	function _add_to_project($id)
	{
		$this->load->model('projects/projects_m');
		if(!$this->input->post('add_to_project_btn'))
		{
	        $data['contentView'] = 'users/forms/add_to_project_form';
	        $data['title'] = 'Add to Project';
	        $data['user'] = $this->ion_auth->user($id)->row();
	        $data['projects_info'] = $this->projects_m->get_projects();
	        $this->template($data);
	    }
	    else
	    {
	    	$add_to_project = $this->users_m->add_to_project($id);
	    	if($add_to_project)
	    	{
	    		die('User added to project');
	    	}
	    	else
	    	{
	    		die('Could not add user to project');
	    	}
		}
	}

	function _remove_from_project($id)
	{
		$this->load->model('projects/projects_m');
		if(!$this->input->post('remove_from_project_btn'))
		{
	        $data['contentView'] = 'users/forms/remove_from_project_form';
	        $data['title'] = 'Remove from Project';
	        $data['user'] = $this->ion_auth->user($id)->row();
	        $data['projects_info'] = $this->projects_m->get_projects();
	        $this->template($data);
	    }
	    else
	    {
	    	$add_to_project = $this->users_m->add_to_project($id);
	    	if($add_to_project)
	    	{
	    		die('User removed from project');
	    	}
	    	else
	    	{
	    		die('Could not remove user from project');
	    	}
		}
	}

    public function template($data) {
        $this->load->module('template');
        $this->template->index($data);
    }

}