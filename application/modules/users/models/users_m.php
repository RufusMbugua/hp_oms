<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_m extends CI_Model {

	public function add_to_project($id){
		$data = array(
			'user_id' => $id,
			'project_id' => $this->input->post('project_id'),
			'usps_date_added' => time(),
		);
		$query = $this->db->insert('users_projects', $data);
		if($query)
		{
			if($this->db->affected_rows() === 1)
			{
				return TRUE;
			}
			else
			{
				if($this->db->affected_rows() === 0)
				{
					return FALSE;
				}
				else
				{
					log_message('error', $this->db->affected_rows().' returned in the add_to_project() query in Users_m.');
					return FALSE;
				}
			}
		}
		else
		{
			log_message('error', 'The add_to_project() query in Users_m did not run.');
			return FALSE;
		}
	}

}