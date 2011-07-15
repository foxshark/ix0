<?php
class Project extends Controller {

	function Project()
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
	
	function editProject($project_id)
	{
		$data['page_title']		= $project_id?"Edit Project":"Add Project";
		$data['content']['main']	= 'project_edit';
		//$data['project_data']		= $this->_fgrid->getAllSquares();
		buildLayout($data);
	}
}