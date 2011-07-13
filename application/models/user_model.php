<?php

class User_model extends Model {

	// create a sample object out patient info
	function User_model ()
	{
		parent::Model();
		
		// Tables being used:
		$this->_users	= 'users';
		$this->_grid_square	= 'grid_square';
	}
	
	function buyTroops($troops = 0, $user = array())
	{
		if(empty($user))
		{
			return false;
		}
		
		$ballance = $user['account'] - ($troops * 10);
		if($ballance >= 0)
		{
			//pre_print_r(array($user, $troops, $ballance));
			$this->_update_account($user['id'], $ballance);
			//die;
			return true;
		} else {
			return false;
		}
		
	}
	
	function _update_account($id = 0, $ballance = 0)
	{
		$data = array(
               'account' => $ballance
            );
		$this->db->where('id', $id);
		$this->db->update($this->_users, $data); 
		//pre_print_r("account updated to :".$ballance); die;
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
		
	function _cashIn($user)
	{
		$hours_since_cashed = floor((time() - strtotime($user['last_cash_in'])) / 3600);
		if($hours_since_cashed > 0)
		{
			$tot_resources = $this->get_total_resources($user['id']);	
			$user['account'] += ($tot_resources * $hours_since_cashed);
			
			$this->db->where('id', $user['id']);
			$this->db->update($this->_users, array("last_cash_in"=>date("Y-m-d H:i:s"), "account"=>$user['account'])); 
		}
		return $user['account'];
	}
	
	function get_total_resources($id)
	{
		$total = 0;
		$this->db->where('owner_id', $id); 
		$query = $this->db->get($this->_grid_square);
		
		foreach ($query->result() as $row)
		{
			$total += $row->resource_value;
		}
		return $total;
	}
	
	function spendMoney($user, $cost)
	{
		$new_cash = $user['account'] - $cost;
		$this->_update_account($user['id'], $new_cash);
	}
	
	function takeMoney($atk_user, $def_user, $loot)
	{
		$sum_win	= $atk_user['account'] + $loot;
		$sum_loose	= $def_user['account'] - $loot;
		$this->_update_account($atk_user['id'], $sum_win);
		$this->_update_account($def_user['id'], $sum_loose);
	}
		
}
	
/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */