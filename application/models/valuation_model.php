<?php

class Valuation_model extends CI_Model {

	// create a sample object out patient info
	function __construct()
	{
		parent::__construct();
		
		// Tables being used:
		$this->_staff		= 'staff';
		$this->_staff_tag	= 'staff_tag';
		$this->_cevent		= 'company_event';
	}
	
	function getCompanyTotal($id = 0)
	{
		if($id == 0) $id = $this->session->userdata('company_id');
		$this->db->where('company_id', $id); 
		$this->db->limit(1);
		$this->db->order_by("created", "desc");
		$query	= $this->db->get($this->_cevent);
		$row	= get_object_vars(array_pop($query->result()));
		
		return $row;
	}
	
	function getCompanyHistory($days=7)
	{
		$this->db->select('staff_tag.*, tags.name');
		$this->db->join('tags', 'tags.id = staff_tag.tag_id', 'left');
		$this->db->where_in('staff_id', array_keys($staff)); 
		$query = $this->db->get($this->_staff_tag);


		foreach ($query->result() as $row)
		{
			$staff[$row->staff_id]['tag'][$row->tag_id] = get_object_vars($row);
		}
		//pre_print_r($this->db->last_query());
		//pre_print_r($staff); die;	
		return $staff;
	}
	
	function staff_valuation($tag_id, $tag_lvl)
	{
		return rand(10, 100);
	}
	
	function currentTagValuation($tags)
	{
		$total = 0;
		foreach($tags as $tag)
		{
			$total += rand(10,100)/100;
		}
		return $total;
		
	}
	
	
	
	
	/* 
	 *	new generic functions by jk for calculating, updating, and gettting valuations
	 *	- the goal here is only run calculations/updates when absolutely necessary, otherwise we can just pull from the db
	 *  
	 */
	 
	function calculateTagValuation($id)
	{
		// this is the root of all other valuations.
		// use twitter, some other APIs to get our new number
		
		// for now, just do a random change from the last valuation
		// $options = array('table'=>'tag','id'=>$id);
		// $val = $this->viewLastValuation($options);
		// $val = (mt_rand(0,1)==1) ? $val += mt_rand(0,100) : $val -= mt_rand(0,100);
		
		// just don't let it be less than 1
		// if($val <= 0) $val = 1;
	}
	
	//function calculateValuation($options = staff, company, project)
	
	//function updateValuation(table,id,valuation)
	
	// can be used to get the last updated valuation for company, project, staff, or tag
	function viewValuation($options=array())
	{
		// required values
		if(!$this->_crud->_required(array('table','id'), $options)) return false;
		
		// default values
		$default = array(
			'limit' => 1
			);
		$options = $this->_crud->_default($default, $options);
		
		$this->db->select('valuation, created');
		$this->db->where($options['table'].'_id', $options['id']);
		$this->db->limit($options['limit']);
		$this->db->order_by('created desc');		
		
		$query = $this->db->get($options['table'].'_event');		
		$result = $query->result_array();
		if($options['limit']==1) $result = $result[0];
		
		return $result;
	}	 
	 
}