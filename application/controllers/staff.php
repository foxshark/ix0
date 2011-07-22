<?php
class Staff extends Controller {

	function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('logged_in')) {
			redirect('/home');
		}
		
		$this->load->model('staff_model','_staff');
		
	}
	
	function index()
	{
		redirect('staff/overview');
	}
	
	function overview()
	{
		$data['page_title']		= "Staff Overview";
		$data['content']['main']	= 'staff_overview';
		$data['skill_data']		= $this->_staff->getStaffTagsOnly($this->session->userdata('id'),1);
		buildLayout($data);
	}
	
	function hire()
	{
		//$data['page_title']		= $project_id?"Edit Project":"Add Project";
		$data['content']['main']	= 'staff_add';
		//$data['project_data']		= $this->_fgrid->getAllSquares();
		buildLayout($data);
	}
}