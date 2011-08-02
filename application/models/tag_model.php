<?php

class Tag_model extends Model {

	function __construct()
	{
		parent::__construct();
		
		// Tables being used:
		$this->_table_tag =		"tags";		
	}
	
	function getTags($array=array())
	{
		$result = array();
		if(!empty($array)){
			$this->db->where_in('id', $array); 
		}
		$query = $this->db->get($this->_table_tag);
		foreach ($query->result() as $row)
		{
			$result[$row->id] = get_object_vars($row);
		}
		
		return $result;
		
	}
	
	function getTag($t=0)
	// this will retun one tag in a non-nested array
	{
		$tag = array();
		if($t>0)
		{
		$this->db->where('id', $t); 
		$query = $this->db->get($this->_table_tag);
		foreach ($query->result() as $row)
		{
			$tag = get_object_vars($row);
		}		
		} else {
			$tag = $this->_getBlankTag();
		}
		return $tag;
	}
	
	function _getBlankTag()
	{
		return array(
			'id' 		=> 0,
			'name'		=> "",
			'valuation'	=> 0,
			'tag_category'	=> 0);	
	}

	function updateTag($id=0)
	{
		if($id > 0)
		{
			$this->db->where("id",$id);
			$this->db->update($this->_table_tag, $_POST);
		} else {
			$this->db->insert($this->_table_tag, $_POST);
		}
	}	
}