<?php

class Project_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		
		// Tables being used:
		$this->_table_project = 		"project";
		$this->_table_project_tag =		"project_tag";
		$this->_table_tags =			"tags";
		
		$this->load->model('tag_model','_tag');
		$this->load->model('staff_model','_staff');
		$this->load->model('crud_model','_crud');
		$this->config->load('taglvl');
	}
	
	function checkForMyOutstandingProjects()
	{
//	$result['tags'][$k]['next_turn']	= (60*60) - (time() - $row->turns_timer);
		$this->db->where('company_id', $this->session->userdata('company_id')); 
		$this->db->where('turns_timer <', time() - (60*60));
		$query = $this->db->get($this->_table_project_tag);
		if(!empty($query))
		{
			$output = $this->_staff->getTotalOutput();
			foreach ($query->result() as $row)
			{
				$this->_advanceProjectTag(get_object_vars($row), $output);
			}
		}

	}
	
	function _advanceProjectTag($tag, $output)
	{
		$turns_completed		= floor((time() - $tag['turns_timer']) / (60*60));
		$seconds_completed		= $turns_completed * 60 * 60;
		$per_turn_output		= $output[$tag['tag_id']]['output'];
		$units_completed 		= $per_turn_output * $turns_completed;
		$tag['turns_to_complete']	-= $units_completed;
//		pre_print_r(array($turns_completed, $units_completed,$output));
		if($tag['turns_to_complete'] <1)
		{
			$tag['lvl']++;
			$tag['turns_to_complete']	= 0;
		}

		$data = array('lvl'=>$tag['lvl'], 'turns_to_complete'=>$tag['turns_to_complete'], 'turns_timer'=>$tag['turns_timer']+$seconds_completed);
		
		//pre_print_r($data);
		$this->db->where('id', $tag['id']);
		$this->db->update($this->_table_project_tag, $data);
		//pre_print_r($tag);
	}
	

	function getCompanyProjects($company_id=false)
	{
		/* 			
			get basic info for all projects assigned to a company id		
		*/
		
		// if no ID passed, assume current user's active company
		if(!$company_id){ $company_id = $this->session->userdata('company_id'); }
		
		$result = array();
		
		if($company_id)
		{		
			$this->db->where('company_id', $company_id); 
			$query = $this->db->get($this->_table_project);
			foreach ($query->result() as $row)
			{
				$result[$row->id] = get_object_vars($row);
			}
		}
		
		return $result;
	}
	
	function getProjectDetails($project_id)
	{
		/* 
			get project basics + get goals, completed, valuation, etc.
			(single project)
		*/
		
		// get project name, dates
		$this->db->where('id', $project_id);
		$query = $this->db->get($this->_table_project);
		foreach ($query->result() as $row)
		{
			$result = get_object_vars($row);
		}
		
		$result['tags'] = array();
		
		// get the tags assigned to this project as well as info about each tag
//		$this->db->select('lvl,turns_to_complete,completed,tag_id,name,valuation,tag_category,updated,created');
		$this->db->select();
		$this->db->join($this->_table_tags, $this->_table_project_tag.'.tag_id = '.$this->_table_tags.'.id');
		$this->db->where('project_id',$project_id);
		$this->db->order_by('turns_to_complete');
		$query = $this->db->get($this->_table_project_tag);
		foreach($query->result() as $row)
		{
			$row->next_turn	= (60*60) - (time() - $row->turns_timer);
			$row->goal	= $this->config->item('tag_'.($row->lvl+1));
			$row->progress	= $this->config->item('tag_'.($row->lvl+1)) - $row->turns_to_complete;
			
			if($row->turns_to_complete<1)
			{
			$row->goal	= 0;
			$row->progress	= 0;			
			}
			
			$result['tags'][] = get_object_vars($row);
		}
		
//		pre_print_r($result); die();
		
		return $result;
	}
	
	function getAvailableTags($company_id, $project_id=false)
	{
		$result = $this->_staff->getStaffTagsOnly($company_id);
		if(!$project_id)
		{ 		
			$project = $this->getProjectDetails($project_id);
			// remove tags that are already in progress
			foreach($project['tags'] as $k => $v)
			{
				if(array_key_exists($v['tag_id'],$result) && $v['turns_to_complete'] > 0)
				{
					unset($result[$v['tag_id']]);
				}
			}
		}
//		pre_print_r($result); die;
		return $result;
	}
	
	function addProjectTag($company_id, $project_id, $tag_id)
	{
		$data = array(
			"company_id"		=> $company_id,
			"project_id"		=> $project_id,
			"tag_id"		=> $tag_id,
			"lvl"			=> 0,
			"turns_to_complete"	=> $this->config->item('tag_1'),
			"turns_timer"		=> time(),
			"completed"		=> date("Y-m-d H:i:s")
			);
		
		$this->db->insert($this->_table_project_tag, $data);
		//return $data;
	}
	
	function addProject($options = array())
	{
		// required values
		if(!$this->_crud->_required(array('name'), $options)) return false;
	
		// default values
		$default = array(
			'company_id' => $this->session->userdata('company_id'),
			'updated' => date("Y-m-d H:i:s"),
			'created' => date("Y-m-d H:i:s")
		);
		$data = $this->_crud->_default($default, $options);
		
		//pre_print_r($options);
		$id = $this->_crud->insert('project',$data);
		return $id;
	}
	
	/* replaced by getProjectDetails
	function getProjectBasic($id)
	{
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
	}*/
	
	/* replaced by getProjectDetails
	function getProjectFull($id)
	{
		// get the basic project info
		$result = $this->getProjectBasic($id);
		
		// pull more detailed info
		
		
		return $result;
	}*/
	
	/* replaced by getCompanyProjects
	function getAllProjects($company_id)
	{
		// get all project ids (hardcoded for now)
		//$project_ids = array(1);
		$this->db->where('company_id', $company_id); 
		$query = $this->db->get($this->_table_project);
		
		// get project tags for each project
		$result[] = $this->getProjectBasic($project_ids);
		pre_print_r($result);
		die();
		return $result;
		
	}*/
	
}