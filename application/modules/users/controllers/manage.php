<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('ion_auth');

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
	}

	public function index(){
		// Show users dashboard. From here, all manage functionalities are triggered
    }

	public function create_group(){
		$this->form_validation->set_rules('group_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('group_description', 'Description', 'trim|required');
		if(!$this->input->post('create_group_btn') && $this->form_validation->run() == false){
			// Show the form
		}else{
			$group_name = $this->input->post('group_name');
			$group_description = $this->input->post('group_description');

			$create_group = $this->ion_auth->create_group($group_name, $group_description);
			if($create_group){
				$new_group = $this->ion_auth->group($create_group)->result();
				// Return group information
			}else{
				$create_group_errors = $this->ion_auth->errors_array();
				// Return the errors
			}
		}
	}

	public function update_group($group_id){
		$this->form_validation->set_rules('group_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('group_description', 'Description', 'trim|required');
		if(!$this->input->post('update_group_btn') && $this->form_validation->run() == false){
			// Show the form
		}else{
			$group_name = $this->input->post('group_name');
			$group_description = $this->input->post('group_description');

			$update_group = $this->ion_auth->update_group($group_id, $group_name, $group_description);
			if($update_group){
				// Return confirmation
			}else{
				$update_group_errors = $this->ion_auth->errors_array();
				// Return the errors
			}
		}
	}

	public function create_user(){
		$this->form_validation->set_rules('surname', 'Surname', 'trim|required');
		$this->form_validation->set_rules('other_names', 'Other Names', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('sub_county', 'Sub County', 'required');
		$this->form_validation->set_rules('birthday', 'Birthday', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'trim}required|is_numeric|exact_length[12]|is_unique[users.phone]');
		$this->form_validation->set_rules('email_address', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		if(!$this->input->post('create_user_btn') && $this->form_validation->run() == false){
			// Show the form
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
						$activate_user_errors = $this->ion_auth->errors_array();
						// Return the errors
					}
				}else{
				// Return confirmation
				}
			}else{
				$create_user_errors = $this->ion_auth->errors_array();
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
						$activate_user_errors = $this->ion_auth->errors_array();
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
						$deactivate_user_errors = $this->ion_auth->errors_array();
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
				$update_user_errors = $this->ion_auth->errors_array();
				// Return the errors
			}
		}
	}

	public function assign_user($user_id){
		// Assign a user to a project
	}

	public function user($user_id){
		$user = $this->ion_auth->user($user_id)->row();
		if(is_object($user)){
			// Return the user information
		}else{
			$user_errors = $this->ion_auth->errors_array();
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
							$promote_user_errors = $this->ion_auth->errors_array();
							// Return the errors
						}
					}else{
						$maintenance_errors = $this->ion_auth->errors_array();
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
							$demote_user_errors = $this->ion_auth->errors_array();
							// Return the errors
						}
					}else{
						$maintenance_errors = $this->ion_auth->errors_array();
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

    public function template($data){
    	// Show the various views
    }

}