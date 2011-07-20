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
	
	function getStaffTagsOnly($company_id=0)
	{
		$staff = $this->_getCompanyStaff($company_id);
		// get staff
		$this->db->select('staff_tag.*, tags.name AS tname, project_tag.lvl AS tlvl');
		$this->db->join('project_tag', 'project_tag.tag_id = staff_tag.tag_id', 'left');
		$this->db->join('tags', 'tags.id = staff_tag.tag_id', 'left');
		$this->db->where_in('staff_id', array_keys($staff)); 
		$this->db->order_by('project_tag.lvl', 'desc');
		$this->db->order_by('tags.name', 'asc');
		$query = $this->db->get($this->_staff_tag);

		$tag = array();
		foreach ($query->result() as $row)
		{
			$tag[$row->tag_id] = array(
				"name"		=>$row->tname,
				"lvl"		=>!empty($row->tlvl) ? $row->tlvl : 0,
				"goal" 		=> 10,
				"progress"	=> 3);
		}
		//pre_print_r($this->db->last_query());
		//pre_print_r($tag); die;	
		return $tag;
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