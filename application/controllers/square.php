<?php

class Square extends Controller {

	function Square()
	{
		parent::Controller();
		//$this->load->library('form_validation');
		$this->load->model('grid_model','_grid');
		$this->load->model('frac_grid_model','_fgrid');
		$this->load->model('user_model','_users');
	}
	
	function index($lat=0, $lon=0)
	{
		$data['page_title']		= "Square Detail";
		$data['content']['main']= 'square_ladder';
		$data['square']			= $this->_fgrid->getSquareInfo($lat, $lon);
		$data['ladder']			= $this->_fgrid->getSquareLadder($data['square']['id']);
		$data['players']		= $this->_users->getUserArrayInfo(array_keys($data['ladder']));
		//$data['def_user']		= $this->_users->getUserInfo($data['square']['owner_id']);
		$data['user_details'] = $this->_users->getMyStats();
		buildLayout($data);
	}

	function attack_square()
	{
		$atk_user	= $this->_users->getUserInfo($this->session->userdata('id'));
		$has_funds	= $this->_users->buyTroops($_POST['troop_count'], $atk_user);
		if(!$has_funds) 
		{
			pre_print_r("Not Enough Cash!");
			return false;
		}

		//if you can / just did spend the money...		
		//get target square info
		$sq =  $this->_grid->getSquareInfo($_POST['lat_id'], $_POST['lon_id']);
		$def_user	= $this->_users->getUserInfo($sq['owner_id']);
		
		if($_POST['troop_count'] <= $sq['fort_lvl'])
		{
			pre_print_r("Not Enough Troops!");
			return false;
		}
		
		//if you can take over the target
		$def_user['total_fort_lvl']	= $this->_grid->getTotalFortLvl($sq['owner_id']);
		$loot = $this->_grid->conquerFort($atk_user, $def_user, $sq); // account / total_fort_lvl * this_fort_lvl
		$this->_users->takeMoney($atk_user, $def_user, $loot);
		redirect("","refresh");
	}
	
	function build()
	{
		$sq 		= $this->_grid->getSquareInfo($_POST['lat_id'], $_POST['lon_id']);
		$user		= $this->_users->getUserInfo($this->session->userdata('id'));
		$up_cost	= $this->_grid->upgradeCost($sq['fort_lvl']);
		$has_funds	= $user['account'] > $up_cost ? true : false;
		if(!$has_funds) 
		{
			pre_print_r("Not Enough Cash!");
			return false;
		}
		
		$this->_users->spendMoney($user, $up_cost);
		$this->_grid->upgradeFort($sq, 1);
		redirect("","refresh");
	}
}