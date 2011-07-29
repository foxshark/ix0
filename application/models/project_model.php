<?php

class Project_model extends Model {

	function __construct()
	{
		parent::__construct();
		
		// Tables being used:
		$this->_table_project = 		"project";
		$this->_table_project_tag =		"project_tag";
		
		$this->load->model('tag_model','_tag');
		
	}
	
	function addProjectTag($project_id, $tag_id)
	{
		// insert new row for project tag in db
				
		//return $data;
	}
	
	function getProjectBasic($id)
	{
		/*
			get project names and associated tags
			(multiple projects)
		*/
		
		// trying to make this function work for both a single project or multiple projects
		if(!is_array($id)){
			$id = array($id);
		}
		
		// get basic project info
		$result = array();
		$this->db->where_in('id', $id); 
		$query = $this->db->get($this->_table_project);
		foreach ($query->result() as $row)
		{
			$p_ids[] = $row->id;
			$result[] = get_object_vars($row);
		}
		
		if(count($result)===1)
		{
			$result	= $result[0];
		}
		
		//echo $this->db->last_query();		
		//pre_print_r($result);
		//die();
		
		// get project tags
		$this->db->select('tag_id AS id, lvl, turns_to_complete, completed');
		$this->db->where_in('project_id', $p_ids);
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
		
		return $result;
	}
	
	function getProjectFull($id)
	{
		/* 
			get project basics + get goals, completed, valueation, etc.
			(single project)
		*/
		
		// get the basic project info
		$result = $this->getProjectBasic($id);
		
		// pull more detailed info
		
		
		return $result;
	}
	
	function getAllProjects($company_id)
	{
		/* 			
			get basic info for all projects assigned to a company id			
		*/
		
		// get all project ids (hardcoded for now)
		$project_ids = array(1);
		
		// get project tags for each project
		$result[] = $this->getProjectBasic($project_ids);
		//pre_print_r($result);
		//die();
		return $result;
		
	}
	
}