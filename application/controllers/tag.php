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
		$tag = $this->_tag->getTag($id);
		
		/* using this to quickly add tags to tag_event
		$data = array(
			'id' => $id,
			'valuation' => $this->_value->calculateTagValuation($id)
			);		
		pre_print_r($data);
		$this->_tag->updateTagValuation($data);*/
		
		$data['tag']				= $tag;
		$data['page_title']			= "Tag Stats";
		$data['content']['main']	= 'tag_stats';
		buildLayout($data);
	}

}