<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects_m extends CI_Model {

	public function create_project()
	{
		$data = array(
			'project_name' => $this->input->post('project_name'),
			'project_description' => $this->input->post('project_description'),
			'project_url' => $this->input->post('project_url'),
			'project_date_added' => time(),
		);
		$query = $this->db->insert('projects', $data);
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
					log_message('error', $this->db->affected_rows().' returned in the create_project() query in Projects_m.');
					return FALSE;
				}
			}
		}
		else
		{
			log_message('error', 'The create_project() query in Projects_m did not run.');
			return FALSE;
		}
	}

	public function update_project($id)
	{
		$data = array(
			'project_name' => $this->input->post('project_name'),
			'project_description' => $this->input->post('project_description'),
			'project_url' => $this->input->post('project_url'),
			'project_last_updated' => time(),
		);
		$this->db->where('project_id', $id);
		$query = $this->db->update('projects', $data);
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
					log_message('error', $this->db->affected_rows().' returned in the update_project() query in Projects_m.');
					return FALSE;
				}
			}
		}
		else
		{
			log_message('error', 'The update_project() query in Projects_m did not run.');
			return FALSE;
		}
	}

	public function delete_project($id)
	{
		$this->db->where('project_id', $id);
		$query = $this->db->delete('projects');
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
					log_message('error', $this->db->affected_rows().' returned in the delete_project() query in Projects_m.');
					return FALSE;
				}
			}
		}
		else
		{
			log_message('error', 'The delete_project() query in Projects_m did not run.');
			return FALSE;
		}
	}

	public function get_project($id)
	{
		$query = $this->db->get_where('projects', array('project_id'=>$id));
		if($query){
			if($query->num_rows() === 1)
			{
				return $query->row();
			}
			else
			{
				if($query->num_rows() === 0)
				{
					return FALSE;
				}
				else
				{
					log_message('error', $query->num_rows().' returned in the get_project() query in Projects_m.');
					return FALSE;
				}
			}
		}
		else
		{
			log_message('error', 'The get_project() query in Projects_m did not run.');
			return FALSE;
		}
	}

	public function get_projects()
	{
		$query = $this->db->get('projects');
		if($query){
			if($query->num_rows() > 0)
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
					log_message('error', $query->num_rows().' returned in the get_projects() query in Projects_m.');
					return FALSE;
				}
			}
		}
		else
		{
			log_message('error', 'The get_projects() query in Projects_m did not run.');
			return FALSE;
		}
	}

}