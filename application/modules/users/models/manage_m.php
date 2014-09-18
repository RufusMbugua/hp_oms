<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_m extends CI_Model {

	function assign_user_to_project($user_id){
		$data = array(
			'user_id' => $user_id,
			'project_id' => $this->input->post('project_id'),
			'usps_date_added' => time(),
		);
		$query = $this->db->insert('users_projects', $data);
		if($query){
			if($this->db->affected_rows() === 1){
				return true;
			}else{
				if($this->db->affected_rows() === 0){
					return false;
				}else{
					log_message('error', $this->db->affected_rows().' returned in the assign_user_to_project() query in Manage_m.');
					return false;
				}
			}
		}else{
			log_message('error', 'The assign_user_to_project() query in Manage_m did not run.');
			return false;
		}
	}

}