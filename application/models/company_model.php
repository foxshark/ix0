<?php

class Company_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		
		// tables being used
		$this->_table_company = "company";
	}
		
	function getCompany($company_id=false)
	{
		// if no ID passed, assume current user's active company
		if(!$company_id){ $company_id = $this->session->userdata('company_id'); }
		
		$result = "";
		
		if($company_id)
		{
					
			$this->db->where('id', $company_id); 
			$query = $this->db->get($this->_table_company);
			foreach ($query->result() as $row)
			{
				$result = get_object_vars($row);
			}
		}
		
		return $result;
	}
	
	function getActiveCompanyID($user_id=false)
	{
		/*
			get the currently active company for a user
			note: this could be phased out in the future to allow for multiple active companies
		*/
		
		// if no ID passed, assume current logged in user
		if(!$user_id){ $user_id = $this->tank_auth->get_user_id(); }
		
		$result = "";
		
		if($user_id)
		{	
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
		}
		
		return $result;
		
	}
	
}