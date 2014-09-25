<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_m extends CI_Model {

	public function add_to_project($id){
		$data = array(
			'user_id' => $id,
			'project_id' => $this->input->post('project_id'),
			'user_role' => $this->input->post('user_role'),
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

	public function get_user_projects($id)
	{
		$this->db->select('projects.project_id, projects.project_name, projects.project_url, groups.name as user_role, ')
			->from('users_projects')
			->where('users_projects.user_id', $id)
			->join('users', 'users.id = users_projects.user_id')
			->join('users_groups', 'users_groups.user_id = users.id')
			->join('groups', 'groups.id = users_groups.group_id')
			->join('projects', 'projects.project_id = users_projects.project_id');
		$query = $this->db->get();
		if($query)
		{
			if($query->num_rows() === 1)
			{
				return $query->result();
			}
			else
			{
				if($query->num_rows() === 0)
				{
					return FALSE;
				}
				else
				{
					log_message('error', $query->num_rows().' returned in the get_user_projects() query in Users_m.');
					return FALSE;
				}
			}
		}
		else
		{
			log_message('error', 'The get_user_projects() query in Users_m did not run.');
			return FALSE;
		}
	}

}