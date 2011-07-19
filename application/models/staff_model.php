<?php

class Staff_model extends Model {

	// create a sample object out patient info
	function Staff_model ()
	{
		parent::Model();
		
		// Tables being used:
		$this->_staff		= 'staff';
		$this->_staff_tag	= 'staff_tag';
	}
	
	function getUserOverview($id=0)
	{
		$data = $this->_getStaffAndSkill($id);
		
		return $data;
	}
	
	function _getStaffAndSkill($company_id=0)
	{
		$staff = $this->_getCompanyStaff($company_id);
		// get staff
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
	
	function _getCompanyStaff($company_id=0)
	{
		$this->db->where('company', $company_id); 
		$query = $this->db->get($this->_staff);

		$staff = array();
		foreach ($query->result() as $row)
		{
			$staff[$row->id] = get_object_vars($row);
		}
		return $staff;
	}
	
}