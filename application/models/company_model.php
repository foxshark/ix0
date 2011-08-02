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
		
	function getCompany($company_id)
	{
		$result = "";
		
		$this->db->where('id', $company_id); 
		$query = $this->db->get($this->_table_company);
		foreach ($query->result() as $row)
		{
			$result = get_object_vars($row);
		}
		
		//echo $this->db->last_query();pre_print_r($result);die();
		
		return $result;
	}
	
	function getActiveCompanyID($user_id)
	{
		/*
			get the currently active company for a user
		*/
		
		$result = "";
		
		$this->db->select('id');
		$this->db->where('user_id', $user_id);
		$this->db->where('active', 1);
		
		// fail safe in case we end up with multiple active companies
		$this->db->limit(1);
		$this->db->order_by('created desc');
		
		$query = $this->db->get($this->_table_company);
		foreach ($query->result() as $row)
		{
			$result = $row->id;
		}
		
		//echo $this->db->last_query();pre_print_r($result);die();
		
		return $result;
	}
	
}