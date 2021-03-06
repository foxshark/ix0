<?php

class Staff_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->model('valuation_model','_value');		
		$this->load->model('crud_model','_crud');
		
		// Tables being used:
		$this->_staff		= 'staff';
		$this->_staff_tag	= 'staff_tag';
		$this->_tag			= 'tag';
	}
	
	function getUserOverview($id=0)
	{
		$data = $this->_getStaffAndSkill($id);
		
		return $data;
	}
	
	function getStaffDetails($company_id)
	{
		$data = $this->_getStaffAndSkill($company_id);
		return $data;
	}
	
	function getStaffTagsOnly($company_id=0, $min_lvl=0)
	{
		$staff = $this->_getCompanyStaff($company_id);
		if(!empty($staff)) {
			// get staff
			$this->db->select('staff_tag.*, '.$this->_tag.'.name AS tname, project_tag.lvl AS tlvl');
			$this->db->join('project_tag', 'project_tag.tag_id = staff_tag.tag_id', 'left');
			$this->db->join($this->_tag, $this->_tag.'.id = staff_tag.tag_id', 'left');
			$this->db->where_in('staff_id', array_keys($staff)); 
			if($min_lvl > 0)
			{
				$this->db->where('project_tag.lvl >=', $min_lvl);
			}
			$this->db->order_by('project_tag.lvl', 'desc');
			$this->db->order_by($this->_tag.'.name', 'asc');
			$query = $this->db->get($this->_staff_tag);
	
			$tag = array();
			foreach ($query->result() as $row)
			{
				$tag[$row->tag_id] = array(
					"id"		=>$row->tag_id,
					"name"		=>$row->tname,
					"lvl"		=>!empty($row->tlvl) ? $row->tlvl : 0,
					"goal" 		=> 10,
					"progress"	=> 3);
			}
			//pre_print_r($this->db->last_query());
			//pre_print_r($tag); die;	
			return $tag;
		} else {
			return array();
		}
	}
	
	function _getStaffAndSkill($company_id=0)
	{
		$staff = $this->_getCompanyStaff($company_id);
		// get staff
		if(!empty($staff)) {
		$this->db->select('staff_tag.*, '.$this->_tag.'.name');
		$this->db->join($this->_tag, $this->_tag.'.id = staff_tag.tag_id', 'left');
		$this->db->where_in('staff_id', array_keys($staff)); 
		$query = $this->db->get($this->_staff_tag);


		foreach ($query->result() as $row)
		{
			$staff[$row->staff_id]['tag'][$row->tag_id] = get_object_vars($row);
		}
		//pre_print_r($this->db->last_query());
		//pre_print_r($staff); die;	
		return $staff;
		} else {
			return array();
		} 
	}
	
	function _getStaffbyID($options = array())
	{
		// require staff id in the options
		if(!$this->_crud->_required(array('id'), $options)) return false;
		
		// don't get tags, unless requested in the options
		$options = $this->_crud->_default(array('tags' => FALSE), $options);
		
		$data = $this->_crud->get('staff',$where=array('id'=>$options['id']),true);
		
		if($options['tags']){
			$this->db->select('staff_tag.*, '.$this->_tag.'.name');
			$this->db->join($this->_tag, $this->_tag.'.id = staff_tag.tag_id', 'left');
			$this->db->where('staff_id', $options['id']);
			$query = $this->db->get($this->_staff_tag);	
			foreach($query->result() as $row){
				$data['tags'][$row->tag_id] = get_object_vars($row);
			}
		}
		
		return $data;
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
	
	function getFreeStaff()
	{
		// see if there are fewer than 10 free staff
		$staff = count($this->_getCompanyStaff(0));

		//generate new if so
		if($staff <10)
		{
			$this->_generateHires(10-$staff);
		} 
		
		//find people
		return $this->_getStaffAndSkill(0);
	}
	
	function _generateHires($num)
	{

		for($x=0; $x<$num; $x++)
		{
			$tag_id		= rand(1,20);
			$tag_lvl	= rand(1, 6);
			$s = array("name"	=> $this->_getName(),
				"company"	=> 0,
				"worth"		=> $this->_value->staff_valuation($tag_id, $tag_lvl));
			$this->db->insert($this->_staff, $s);
			
			$t = array("staff_id"	=> $this->db->insert_id(),
				"tag_id"	=> $tag_id,
				"tag_lvl"	=> $tag_lvl);
			$this->db->insert($this->_staff_tag, $t);
		}
	}
	
	function _getName()
	{
		$raw_names = "Jacob Isabella Ethan Sophia Michael Emma Jayden Olivia William Ava Alexander Emily Noah Abigail Daniel Madison Aiden Chloe Anthony Mia";
		$names = explode(" ", $raw_names);
		return $names[rand(1, count($names))]; 
	}
	
	function hireStaff($options = array())
	{
		// required values
		if(!$this->_crud->_required(array('id'), $options)) return false;
	
		// default values
		$default = array(
			'company' => $this->session->userdata('company_id'),
			'hire_date' => date("Y-m-d H:i:s")
		);
		$data = $this->_crud->_default($default, $options);
		
		// hard code in that it must be an unemployed person
		$where = array('id' => $data['id'], 'company' => 0);
		
		$id = $this->_crud->update($this->_staff,$where,$data);
		
		return $id;
		
		/*$data = array(	"company"	=>$this->session->userdata('company_id'),
						"hire_date"	=>date("Y-m-d H:i:s"));
		$this->db->where('id', $id);
		$this->db->where('company', 0); // hard code in that it must be an un employed person
		$this->db->update($this->_staff, $data); */
	}
	
	function getTotalOutput()
	{
		$co_id	= $this->session->userdata('company_id');

		$this->db->select('staff_tag.*');
		$this->db->join('staff', 'staff.id = staff_tag.staff_id', 'left');
		$this->db->where('staff.company', $co_id); 
		$query = $this->db->get($this->_staff_tag);
		
		//echo $this->db->last_query();
		
		$tag	= array();
		$staff	= array();
		foreach ($query->result() as $row)
		{
			if(!isset($tag[$row->tag_id]['output'])) $tag[$row->tag_id]['output'] = 0;
			$tag[$row->tag_id]['output']			+= $this->config->item("s_tag_".$row->tag_lvl);
			$tag[$row->tag_id]['staff'][$row->staff_id]	= $row->tag_lvl;
			$tag[$row->tag_id]['points'][$row->staff_id]	= $row->tag_points;
		}

		return $tag;

	}
	
	function advanceStaffTag($tag, $out, $turns)
	{
		foreach($out['staff'] as $id=>$lvl)
		{
			$data = array("staff_id"=>$id,
				"tag_id"=>$tag,
				"tag_points"=>(($lvl*$turns)+$out['points'][$id])
				);
			if($this->config->item('su_tag_'.($lvl+1)) < $data["tag_points"])
			{
				$data["tag_points"]	= 0;
				$data["tag_lvl"]	= $lvl+1;

			}
			$this->db->where("tag_id", $tag);
			$this->db->where("staff_id", $id);
			$this->db->update($this->_staff_tag,$data);

		}
//		pre_print_r(array($tag, $turns, $out)); die;	
	}

}