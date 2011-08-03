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
}