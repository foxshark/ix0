<?php
class Staff extends Controller {

	function __construct()
	{
		parent::__construct();
		
		if(!$this->session->userdata('logged_in')) {
			redirect('/home');
		}
		
		$this->load->model('staff_model','_staff');
		//$this->load->library('form_validation');
		//$this->load->model('user_model','_users');
	}
	
	function index()
	{
		redirect('staff/overview');
	}
	
	function hire()
	{
		$this->load->model('valuation_model','_value');		
		$data['page_title']			= "Hire New Staff Members";
		$data['content']['main']		= 'staff_add';
		$data['staff_data']			= $this->_staff->getFreeStaff();
		$valuation_snapshot			= $this->_value->getCompanyTotal();
		$data['co_worth']			= $valuation_snapshot['valuation'] !=0 ? $valuation_snapshot['valuation'] : .01; //make sure this is never 0
		buildLayout($data);
	}
	
	function finalizeHire($id = 0)
	{
		$this->_staff->hireStaff($id);
		redirect('staff');	
	}
	
	function overview()
	{
		$data['page_title']		= "Staff Overview";
		$data['content']['main']	= 'staff_overview';
		$data['staff_data']		= $this->_staff->getUserOverview($this->session->userdata('id'));
		buildLayout($data);
	}

}