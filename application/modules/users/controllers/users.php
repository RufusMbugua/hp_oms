<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {

	public function __construct(){
		parent::__construct();

/*		
		if(($this->uri->segment(2) !== 'login' || $this->uri->segment(2) !== 'logout') && !$this->ion_auth->logged_in()){
			// One should be logged in to access this page
		}
*/

		$this->load->model('users_m');

		$this->load->library('ion_auth');

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		$this->load->helper('form_helper');
	}

	public function index(){
		// Show users dashboard. From here, all manage functionalities are triggered
    }

	public function login(){
		$this->form_validation->set_rules('email_address', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('account_password', 'Password', 'trim|required');

		if(!$this->input->post('login_btn') || $this->form_validation->run() == false){
	        $data['contentView'] = 'users/login_form';
	        $data['title'] = 'Access Account';
	        $this->template($data);
		}else{
			die('Login processing....');
			$email = $this->input->post('email_address');
			$password = $this->input->post('account_password');

			$login_user = $this->ion_auth->login($email, $password);
			if($login_user){
				// Redirect to particular page?
			}else{
				$login_errors = $this->ion_auth->errors();
				$this->session->set_flashdata('login_response', $login_errors);
				redirect('users/login', 'refresh');
			}
		}
    }

	public function create_group(){
		$this->form_validation->set_rules('group_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('group_description', 'Description', 'trim|required');

		if(!$this->input->post('create_group_btn') || $this->form_validation->run() == false){
	        $data['contentView'] = 'users/create_group_form';
	        $data['title'] = 'Create Group';
	        $this->template($data);
		}else{
			$group_name = $this->input->post('group_name');
			$group_description = $this->input->post('group_description');

			$create_group = $this->ion_auth->create_group($group_name, $group_description);
			if($create_group){
				$this->session->set_flashdata('create_group_response', '<div class="alert alert-success">Group Created</div>');
				redirect('users/create_group', 'refresh');
			}else{
				$create_group_errors = $this->ion_auth->errors();
				$this->session->set_flashdata('create_group_response', $create_group_errors);
				redirect('users/create_group', 'refresh');
			}
		}
	}

	public function update_group($group_id=false){
		if($group_id === false){
			show_error('The group ID required to update group!');
		}else{
			$group_info = $this->ion_auth->group($group_id)->result();

			$this->form_validation->set_rules('group_name', 'Name', 'trim|required');
			$this->form_validation->set_rules('group_description', 'Description', 'trim|required');

			if(!$this->input->post('update_group_btn') || $this->form_validation->run() == false){
		        $data['contentView'] = 'users/update_group_form';
		        $data['title'] = 'Update Group';
		        $data['group_info'] = $group_info;
		        $this->template($data);
			}else{
				$group_name = $this->input->post('group_name');
				$group_description = $this->input->post('group_description');

				$update_group = $this->ion_auth->update_group($group_id, $group_name, $group_description);
				if($update_group){
					$this->session->set_flashdata('update_group_response', '<div class="alert alert-success">Group Updated</div>');
					redirect('users/update_group/'.$group_id, 'refresh');
				}else{
					$update_group_errors = $this->ion_auth->errors();
					$this->session->set_flashdata('update_group_response', $update_group_errors);
					redirect('users/update_group/'.$group_id, 'refresh');
				}
			}
		}
	}

	public function create_user(){
		$this->form_validation->set_rules('surname', 'Surname', 'trim|required');
		$this->form_validation->set_rules('other_names', 'Other Names', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('birthday', 'Birthday', 'required');
		$this->form_validation->set_rules('sub_county', 'Sub County', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'trim}required|is_numeric|exact_length[12]|is_unique[users.phone]');
		$this->form_validation->set_rules('email_address', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		if(!$this->input->post('create_user_btn') || $this->form_validation->run() == false){
	        $data['contentView'] = 'users/create_user_form';
	        $data['title'] = 'Create Group';
	        $this->template($data);
		}else{
			$username = 'user_';
			$password = hash('sha256', uniqid(rand().time(), true));
			$email = $this->input->post('email_address');
			$additional_data = array(
				'surname' => $this->input->post('surname'),
				'other_names' => $this->input->post('other_names'),
				'other_names' => $this->input->post('other_names'),
				'gender' => $this->input->post('gender'),
				'sub_county_id' => $this->input->post('sub_county'),
				'birthday' => $this->input->post('birthday'),
				'phone' => $this->input->post('phone'),
			);

			$group = $this->input->post('assigned_group');

			$create_user = $this->ion_auth->register($username, $password, $email, $additional_data, $group);
			if($create_user){
				$new_user = $this->ion_auth->user($create_user)->result();
				if($auto_activate = $this->input->post('auto_active')){
					$activate_user = $this->ion_auth->activate($new_user->user_id, $new_user->activation_code);
					if($activate_user){
						// Return confirmation/user information $new_user
					}else{
						$activate_user_errors = $this->ion_auth->errors();
						// Return the errors
					}
				}else{
				// Return confirmation
				}
			}else{
				$create_user_errors = $this->ion_auth->errors();
				// Return the errors
			}
		}
	}

	public function activation($my_action, $user_id){
		switch ($my_action) {
			case 'activate':
				if(is_numeric($user_id)){
					$activate_user = $this->ion_auth->activate($user_id);
					if($activate_user){
						// Return confirmation
					}else{
						$activate_user_errors = $this->ion_auth->errors();
						// Return the errors
					}
				}else{
					// Return error. Invalid user ID. IDs should only be numeric
				}
				break;

			case 'deactivate':
				if(is_numeric($user_id)){
					$deactivate_user = $this->ion_auth->deactivate($user_id);
					if($deactivate_user){
						// Return confirmation
					}else{
						$deactivate_user_errors = $this->ion_auth->errors();
						// Return the errors
					}
				}else{
					// Return error. Invalid user ID. IDs should only be numeric
				}
				break;

			default:
				// Return error! Unable to process your action
				break;
		}
	}

	public function update_user($user_id){
		$user = $this->ion_auth->user($user_id)->row();

		$this->form_validation->set_rules('surname', 'Surname', 'trim|required');
		$this->form_validation->set_rules('other_names', 'Other Names', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('sub_county', 'Sub County', 'required');
		$this->form_validation->set_rules('birthday', 'Birthday', 'required');
		
		if($this->input->post('phone') && $user->phone !== $this->input->post('phone')){
			$this->form_validation->set_rules('phone', 'Phone', 'trim}required|is_numeric|exact_length[12]|is_unique[users.phone]');
		}

		if(!$this->input->post('update_user_btn') && $this->form_validation->run() == false){
			// Show the form
		}else{
			$id = $user_id;
			$data = array(
				'surname' => $this->input->post('surname'),
				'other_names' => $this->input->post('other_names'),
				'other_names' => $this->input->post('other_names'),
				'gender' => $this->input->post('gender'),
				'sub_county_id' => $this->input->post('sub_county'),
				'birthday' => $this->input->post('birthday'),
			);

			if($this->input->post('phone')){
				$data['phone'] = $this->input->post('phone');
			}

			$update_user = $this->ion_auth->update($user_id, $data);
			if($update_user){
				// Return confirmation
			}else{
				$update_user_errors = $this->ion_auth->errors();
				// Return the errors
			}
		}
	}

	public function assign_user($user_id){
		/*
			The user is assigned according to the role he/she is currently playing.
			Change role to assign to project in new role
		*/
		$this->form_validation->set_rules('project_id', 'Project', 'required');
		
		if(!$this->input->post('assign_user_btn') && $this->form_validation->run() == false){
			// Show the form
		}else{
			$assign_user = $this->users_m->assign_user_to_project($user_id);
			if($assign_user){
				// Return confirmation
			}else{
				// Return error response
			}
		}
	}

	public function user($user_id){
		$user = $this->ion_auth->user($user_id)->row();
		if(is_object($user)){
			// Return the user information
		}else{
			$user_errors = $this->ion_auth->errors();
			// Return the errors
		}
	}

	public function users($group_id=false){
		if($group_id !== false && is_numeric($group_id)){
			$users = $this->ion_auth->users($group_id)->result();
		}else{
			// Get all the users
			$users = $this->ion_auth->users()->result();
		}

		if(is_object($users)){
			// Return the users information
		}else{
			// Return error. Users (for the group) were not found
		}
	}

	public function promotion($my_action, $group_id, $user_id){
		switch ($my_action) {
			case 'promote':
				if(is_numeric($group_id) && is_array($user_id)){
					$maintenance = $this->ion_auth->remove_from_group(NULL, $user_id); // Remove from all groups before adding to new group
					if($maintenance){
						$promote_user = $this->ion_auth->add_to_group($group_id, $user_id);
						if($promote_user){
							// Return confirmation
						}else{
							$promote_user_errors = $this->ion_auth->errors();
							// Return the errors
						}
					}else{
						$maintenance_errors = $this->ion_auth->errors();
						// Return the errors
					}
				}else{
					// Return error. Invalid user ID or group ID.
				}
				break;

			case 'demote':
				if(is_numeric($group_id) && is_array($user_id)){
					$maintenance = $this->ion_auth->remove_from_group(NULL, $user_id); // Remove from all groups before adding to new group
					if($maintenance){
						$demote_user = $this->ion_auth->remove_from_group($group_id, $user_id);
						if($demote_user){
							// Return confirmation
						}else{
							$demote_user_errors = $this->ion_auth->errors();
							// Return the errors
						}
					}else{
						$maintenance_errors = $this->ion_auth->errors();
						// Return the errors
					}
				}else{
					// Return error. Invalid user ID or group ID.
				}
				break;

			default:
				// Return error! Unable to process your action
				break;
		}
	}

    public function template($data) {
        $this->load->module('template');
        $this->template->index($data);
    }
}