<?php

class Project_model extends Model {

	// create a sample object out patient info
	function Project_model ()
	{
		parent::Model();
		
		// Tables being used:
		$this->_users	= 'users';
		$this->_grid_square	= 'grid_square';
	}
	
	function getUserOverview($id=0)
	{
		$data = array();
		
		$data[] = array("tag"=>"Android", "lvl"=>6, "progress"=>12, "goal"=>175);
		$data[] = array("tag"=>"Facebook", "lvl"=>3, "progress"=>8, "goal"=>50);
		$data[] = array("tag"=>"Photo Share", "lvl"=>3, "progress"=>0, "goal"=>0);
		$data[] = array("tag"=>"Cloud", "lvl"=>2, "progress"=>3, "goal"=>25);
		// hide real data, usefake data
		/*
		$this->db->where('id', $id); 
		$query = $this->db->get($this->_users);
		
		$user = array();
		foreach ($query->result() as $row)
		{
			$user = get_object_vars($row);
		}	
		*/
		
		return $data;
	}
	
}