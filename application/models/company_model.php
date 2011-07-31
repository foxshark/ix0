<?php

class Company_model extends Model {

	function __construct()
	{
		parent::__construct();
		
		// Tables being used:
		//$this->_table_project 		= "project";
		//$this->_table_project_tag 	= "project_tag";
		//$this->_table_tags 			= "tags";
		$this->_table_company 			= "company";
		
		//$this->load->model('tag_model','_tag');
		//$this->config->load('taglvl');
	}
		
	function getCompany($user_id)
	{
		/* 			
			get company info for one user
		*/
		
		$result = "";
		
		$this->db->where('user_id', $user_id); 
		$query = $this->db->get($this->_table_company);
		foreach ($query->result() as $row)
		{
			$result = get_object_vars($row);
		}
		
		//echo $this->db->last_query();pre_print_r($result);die();
		
		return $result;
	}
	
}