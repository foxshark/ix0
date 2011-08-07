<?php
class Tag extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		if (!$this->tank_auth->is_logged_in()) { redirect(); }
		
		$this->load->model('staff_model','_staff');
		$this->load->model('valuation_model','_value');
		$this->load->model('tag_model','_tag');
		//$this->load->library('form_validation');
		//$this->load->model('user_model','_users');
	}
	
	function index($id)
	{
		$this->stats($id);
	}
	
	function stats($id)
	{
		$data['tag']				= $this->_tag->getTag($id);
		$data['page_title']			= "Tag Stats";
		$data['content']['main']	= 'tag_stats';
		buildLayout($data);
	}

}