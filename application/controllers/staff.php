<?php
class Staff extends Controller {

	function Staff()
	{
		parent::Controller();
		//$this->load->library('form_validation');
		//$this->load->model('user_model','_users');
	}
	
	function index()
	{
		if(!$this->session->userdata('logged_in')) {
			//redirect to base
		}
	}
	
	function hire()
	{
		//$data['page_title']		= $project_id?"Edit Project":"Add Project";
		$data['content']['main']	= 'staff_add';
		//$data['project_data']		= $this->_fgrid->getAllSquares();
		buildLayout($data);
	}
}