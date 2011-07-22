<?php

class User_model extends Model {

	// create a sample object out patient info
	function User_model ()
	{
		parent::Model();
		
		// Tables being used:
		$this->_users	= 'users';
	}
	
	function getUserArrayInfo($id_arr = array())
	{
		$data = array();
		if(!empty($id_arr)){
			$this->db->where_in('id', $id_arr); 
			$query = $this->db->get($this->_users);
			
			$user = array();
			foreach ($query->result() as $row)
			{
				$data[$row->id] = get_object_vars($row);
			}	
		
		}
		return $data;
	}
	
	function getUserInfo($id=0)
	{
		$data = array();

		$this->db->where('id', $id); 
		$query = $this->db->get($this->_users);
		
		$user = array();
		foreach ($query->result() as $row)
		{
			$user = get_object_vars($row);
		}	
		
		$user['account'] = $this->_cashIn($user);
		return $user;
	}
	
	function getMyStats()
	{
		$id = $this->session->userdata('id');
		$data = $this->getUserInfo($id);
		$data['tot_resource']	= $this->get_total_resources($id);
		return $data;
	}	
}
	
/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */