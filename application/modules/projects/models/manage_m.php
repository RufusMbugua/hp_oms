<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_m extends CI_Model {

	public function create_project_category(){
		$data = array(
			'pct_name' => $this->input->post('category_name'),
			'pct_description' => $this->input->post('category_description'),
			'pct_date_added' => time(),
		);
		$query = $this->db->insert('project_categories', $data);
		if($query){
			if($this->db->affected_rows() === 1){
				return true;
			}else{
				if($this->db->affected_rows() === 0){
					return false;
				}else{
					log_message('error', $this->db->affected_rows().' returned in the create_project_category() query in Manage_m.');
					return false;
				}
			}
		}else{
			log_message('error', 'The create_project_category() query in Manage_m did not run.');
			return false;
		}
	}

	public function update_project_category($category_id){
		$data = array(
			'pct_name' => $this->input->post('category_name'),
			'pct_description' => $this->input->post('category_description'),
			'pct_last_updated' => time(),
		);
		$this->db->where('pct_id', $category_id);
		$query = $this->db->update('project_categories', $data);
		if($query){
			if($this->db->affected_rows() === 1){
				return true;
			}else{
				if($this->db->affected_rows() === 0){
					return false;
				}else{
					log_message('error', $this->db->affected_rows().' returned in the update_project_category() query in Manage_m.');
					return false;
				}
			}
		}else{
			log_message('error', 'The update_project_category() query in Manage_m did not run.');
			return false;
		}
	}

	public function create_project(){
		$data = array(
			'project_name' => $this->input->post('project_name'),
			'project_description' => $this->input->post('project_description'),
			'project_url' => $this->input->post('project_url'),
			'pct_id' => $this->input->post('project_category'),
			'project_date_added' => time(),
		);
		$query = $this->db->insert('projects', $data);
		if($query){
			if($this->db->affected_rows() === 1){
				return true;
			}else{
				if($this->db->affected_rows() === 0){
					return false;
				}else{
					log_message('error', $this->db->affected_rows().' returned in the create_project() query in Manage_m.');
					return false;
				}
			}
		}else{
			log_message('error', 'The create_project() query in Manage_m did not run.');
			return false;
		}
	}

	public function update_project($project_id){
		$data = array(
			'project_name' => $this->input->post('project_name'),
			'project_description' => $this->input->post('project_description'),
			'project_url' => $this->input->post('project_url'),
			'pct_id' => $this->input->post('project_category'),
			'project_last_updated' => time(),
		);
		$this->db->where('project_id', $project_id);
		$query = $this->db->update('projects', $data);
		if($query){
			if($this->db->affected_rows() === 1){
				return true;
			}else{
				if($this->db->affected_rows() === 0){
					return false;
				}else{
					log_message('error', $this->db->affected_rows().' returned in the update_project() query in Manage_m.');
					return false;
				}
			}
		}else{
			log_message('error', 'The update_project() query in Manage_m did not run.');
			return false;
		}
	}

	public function get_projects(){
		$query = $this->db->get('projects');
		if($query){
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				if($query->num_rows() === 0){
					return false;
				}else{
					log_message('error', $query->num_rows().' returned in the get_projects() query in Manage_m.');
					return false;
				}
			}
		}else{
			log_message('error', 'The get_projects() query in Manage_m did not run.');
			return false;
		}
	}

	public function get_project($project_id){
		$where_clause = array('project_id'=>$project_id);
		$query = $this->db->get_where('projects', $where_clause);
		if($query){
			if($query->num_rows() === 1){
				return $query->row();
			}else{
				if($query->num_rows() === 0){
					return false;
				}else{
					log_message('error', $query->num_rows().' returned in the get_project() query in Manage_m.');
					return false;
				}
			}
		}else{
			log_message('error', 'The get_project() query in Manage_m did not run.');
			return false;
		}
	}

}