<?php

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		//$this->load->library('form_validation');
		$this->load->model('admin_model','_admin');
		$this->load->model('tag_model','_tags');
		}
	
	function index()
	{
		$this->tags();
	}
	
	function tags()
	{
		$data['page_title']			= "Admin: Tags";
		$data['content']['main']	= array('admin/_nav','admin/tags');
		$data['tags']				= $this->_tags->getTags();
		buildLayout($data);
	}
	
	function modtag($t=0)
	{
		$data['page_title']			= "Admin: Tags";
		$data['content']['main']		= 'admin/edittag';
		$data['t']				= $this->_tags->getTag($t);
		buildLayout($data);	
	}
	
	function savetag($id=0)
	{
		//pre_print_r($_POST);
		if(!empty($_POST))
		{
			$this->_tags->updateTag($id);
		}
		redirect('admin');	
	}
	
	function simulations()
	{
		
		$btc_buyin = $this->config->item('reg_price_btc');
		$total_companies = 10;
		$data['pool'] = $total_companies*$btc_buyin;
		
		// runs 10 simulations
		$data['sims'] = $this->_admin->simCycle($btc_buyin,$total_companies,10);
		$data['btc_buyin'] = $btc_buyin;
		$data['total_companies'] = $total_companies;
		
		$data['page_title']			= "Admin: Simulations";
		$data['content']['main']	= array("admin/_nav","admin/simulations");
		//$data['tags']				= $this->_tags->getTags();
		buildLayout($data);
	}
	
	function rules()
	{
		$data['page_title']			= "Admin: Rules Config";
		$data['content']['main']	= array("admin/_nav","admin/rules");
		//$data['tags']				= $this->_tags->getTags();
		buildLayout($data);
	}
}