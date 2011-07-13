<?php

class Admin_model extends Model {

	// create a sample object out patient info
	function Admin_model()
	{
		parent::Model();
		
		// Tables being used:
		$this->_grid = 'grid_square';
	}

	function makeSquares()
	{
		for($x = 1; $x<=10; $x++)
		{
			for($y = 1; $y<=10; $y++)
			{
				$data = array(
					'lat_id'			=> $y,
					'lon_id'			=> $x,
					'owner_id'			=> 0,
					'lvl'				=> ceil(rand(1, 11)/10), /// 1/10 of a chance to be a 2, otherwise a 1
					'fort_lvl'			=> 0,
					'ping_count'		=> rand(0, 15),
					'resource_value'	=> rand(1, 5),
				);
				$this->db->insert($this->_grid, $data); 
			}
		}
	}
}
	
/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */