<?php

class Admin_model extends CI_Model {

	// create a sample object out patient info
	function __construct()
	{
		parent::__construct();
		
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
	
	/* 
	run a simulation based on a basic cashing out formula
	*/
	function simCycle($price,$users,$turns)
	{
		
		// our total pool of $/btc
		$pool = $price*$users;
		
		//pre_print_r($random_val);
		
		// generate a random unique market snapshot
		for($j=0;$j<$turns;$j++){		
			
			// average valuation for companies
			$avg_val = mt_rand(1,10);
			
			// reset this array
			$random_val = array();
			
			// set the market depth to keep random valuations to scale
			$depth = $avg_val*$users;
			
			// generate random valuations for each company
			for($i=0;$i<$users;$i++){ 
				
				// randomly add or subtract the total market from our average to get a random, scaled valuation
				$random_val[] = ( mt_rand(0,1) == 1 ? $avg_val+mt_rand(0,$depth) : $avg_val-mt_rand(0, $avg_val) )+1;
			}
			
			// market values
			$market_val = array_sum($random_val);
			
			// my values
			$my_equity = mt_rand(1,99)/100;
			$my_val = $random_val[mt_rand(0,$users-1)];
			$my_share = round(($my_val/$market_val)*100);
			
			$sys_equity = 1-$my_equity;
			
			$return = ($pool*($my_val/$market_val));		
			$my_return = $return*$my_equity;
			$sys_return = $return*$sys_equity;
			
			// cut would be how much we could skim per transaction
			$cut = $sys_return*$this->config->item('reg_price_cut');
			
			// this would get returned to the pool
			$pool_return = $sys_return - $cut;
			
			$data[] = array(
				"market" => $market_val,
				"val" => $my_val,
				"share" => $my_share,
				"equity" => $my_equity,
				"return" => $my_return,
				"cut" => $cut,
				"pool" => $pool_return
				);
			
		}
		
		return $data;
			
	}
}
	
/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */