<?php

class Frac_Grid_model extends Model {

	// create a sample object out patient info
	function Frac_Grid_model ()
	{
		parent::Model();
		
		// Tables being used:
		$this->_grid	= 'grid_square';
		$this->_user	= 'users';
		$this->_fgrid	= 'frac_grid';
		$this->_urank	= 'user_rank';
	}

	function getAllSquares($latMin = 0, $latMax=10, $lonMin=0, $lonMax=10)
	{
		$data = array();
		/*	
		$this->db->where('lat_id >=', $latMin); 
		$this->db->where('lat_id <=', $latMax); 
		$this->db->where('lon_id >=', $lonMin); 
		$this->db->where('lon_id <=', $lonMax); 
		$this->db->order_by('lon_id', 'asc');
		$this->db->order_by('lat_id', 'asc');
		*/
		$query = $this->db->get($this->_fgrid);
		
		foreach ($query->result() as $row)
		{
			$data[$row->id]	= get_object_vars($row);
		}
		return $data;
	}
	
	function getSquareInfo($lat=0, $lon=0)
	{
		$data = array();
		
		$this->db->where('lat <=', $lat); 
		$this->db->where('lat + size >=', $lat); 
		$this->db->where('lon >=', $lon); 
		$this->db->where('lon - size <=', $lon); 
		$query = $this->db->get($this->_fgrid);
		$num_rows = $query->num_rows();
		if($num_rows != 1)
		{
			show_error("Error! There are ".$num_rows." entries matching those coordinates. Your query was:<br><br> ".$this->db->last_query());
			die;
		}
		foreach ($query->result() as $row)
		{
			$data = get_object_vars($row);
		}	
		//$data['upgrade_cost'] = $data['owner_id'] == $this->session->userdata('id') ? $this->upgradeCost($data['fort_lvl']): 0;
		return $data;
	}
	
	function getSquareLadder($id)
	{
		$data = array();
		$this->db->where('grid_id', $id); 
		$this->db->order_by("user_rank", "asc");
		$query = $this->db->get($this->_urank);
		if($query->num_rows() > 0){
			foreach ($query->result() as $row)
			{
				$data[$row->user_id] = get_object_vars($row);
			}	
		}
		return $data;
	}
	
	function getTotalFortLvl($owner_id=0)
	{
		$this->db->where('owner_id', $owner_id); 
		$query = $this->db->get($this->_grid);
		$total_fort_lvl = 0;
		foreach ($query->result() as $row)
		{
			$total_fort_lvl += ($row->fort_lvl);
		}	
		return	max(1,$total_fort_lvl);
	}
	
	function conquerFort($atk_user, $def_user, $sq)
	{
		//pre_print_r(array("atk_user"=>$atk_user, "def_user"=>$def_user, "sq"=>$sq));
		$loot_amt = $this->_getFullMoneyFromFort($atk_user, $def_user, $sq);
		$this->_takePosessionOfFort($atk_user, $sq);
		return $loot_amt;
	}
	
	function _getFullMoneyFromFort($atk_user, $def_user, $sq)
	{
		$per_fort	= floor($def_user['account'] / $def_user['total_fort_lvl']); // deal w/ integers only
		$loot 		= $per_fort * $sq['fort_lvl'];
		return $loot;
	}
	
	function _takePosessionOfFort($atk_user, $sq)
	{
		$sq_data = array(
					"owner_id"		=> $atk_user['id'],
					"ping_count"	=> $sq['ping_count']++,
					"fort_lvl"		=> max(1,($sq['fort_lvl']-1)) // current level -1, can't go below 0
					);
		$this->db->where('lat_id', $sq['lat_id']); 
		$this->db->where('lon_id', $sq['lon_id']); 
		$query = $this->db->update($this->_grid, $sq_data);
	}
	
	function upgradeFort($sq, $lvl)
	{
		$sq_data = array(
					"ping_count"	=> $sq['ping_count']++,
					"fort_lvl"		=> ($sq['fort_lvl']+$lvl)
					);
		$this->db->where('lat_id', $sq['lat_id']); 
		$this->db->where('lon_id', $sq['lon_id']); 
		$query = $this->db->update($this->_grid, $sq_data);
	}
	function upgradeCost($n)
	{
		$n++;
		$r = 0;
		for($i=$n; $i>0; $i--)
		{
			$r+=$i;
		}
		return $r * 10;
	}
}
	
/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */