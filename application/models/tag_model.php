<?php

class Tag_model extends Model {

	function __construct()
	{
		parent::__construct();
		
		// Tables being used:
		$this->_table_tag =		"tags";		
	}
	
	function getTags($array)
	{
		$result = array();
		$this->db->where_in('id', $array); 
		$query = $this->db->get($this->_table_tag);
		foreach ($query->result() as $row)
		{
			$result[$row->id] = get_object_vars($row);
		}
		
		return $result;
		
	}
	
}