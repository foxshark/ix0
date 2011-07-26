<?php

class Project_model extends Model {

	function __construct()
	{
		parent::__construct();
		
		// Tables being used:
		$this->_table_project = 		"project";
		$this->_table_project_tag =		"project_tag";
		
		$this->load->model('tag_model','_tag');
		$this->config->load('taglvl');
	}
	
	function addProjectTag($project_id, $tag_id)
	{
		$data = array("company_id"	=> $this->session->userdata('id'),
			"project_id"		=> $project_id,
			"tag_id"		=> $tag_id,
			"lvl"			=> 1,
			"turns_to_complete"	=> $this->config->item('tag_1')
		);
		
		$this->db->insert($this->_table_project_tag, $data);
		//return $data;
	}
	
	function getProjectOverview($id)
	{
		// get basic project info
		$result = array();
		$tags	= array();
		
		$this->db->where('id', $id); 
		$query = $this->db->get($this->_table_project);
		foreach ($query->result() as $row)
		{
			$result = get_object_vars($row);
		}
		
		// get project tags
		if(!empty($result)){
			$this->db->select('tag_id AS id, lvl, turns_to_complete, completed');
			$this->db->where('project_id', $result['id']);
			$this->db->order_by('lvl', 'desc');
			$query = $this->db->get($this->_table_project_tag);
			foreach ($query->result() as $row)
			{
				$tags[$row->id] = $row->id;
				$result['tags'][$row->id] = get_object_vars($row);
			}
		
			// use tag model to get tag info
			$tags = $this->_tag->getTags($tags);
		
			foreach($result['tags'] as $k => $v)
			{
				$result['tags'][$k] += $tags[$k];
			
				// hard code goal/progress
				$result['tags'][$k]['goal'] = 10;
				$result['tags'][$k]['progress'] = 3;
			}
		}		
		return $result;
	}
	
}