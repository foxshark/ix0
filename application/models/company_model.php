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
		*   get the currently active company for a user
		*	note: this could be phased out in the future to allow for multiple active companies
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
	
	
	
	
	// work in progress
	// see: http://heybigname.com/2009/08/28/how-to-write-a-better-model-in-code-igniter/
	// and: http://blog.builtbyprime.com/php/a-guide-to-generic-code-igniter-models
	
	
	/*
	*  returns false if the $data array does not contain all of the keys assigned by the $required array.
	*/
	function _required($required, $data)
	{
		foreach($required as $field) if(!isset($data[$field])) return false;
		return true;
	}
	
	function _default($defaults, $options)
	{
		return array_merge($defaults, $options);
	}
	
	/*function exampleFunction($options = array())
	{
		// required values
		if(!$this->_required(array('userEmail'), $options)) return false;
	
		// default values
		$options = $this->_default(array('userStatus' => 'active'), $options);
	}*/
	
	function newgetCompany($options = array())
	{
		// default values
		$default = array(
			'company_id' => $this->session->userdata('company_id'),
			'limit' => 1			
			);
		$options = $this->_default($default, $options);	
		
	}
	
}