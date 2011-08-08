<?php
class Staff extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		if (!$this->tank_auth->is_logged_in()) { redirect(); }
		
		// other models
		$this->load->model('staff_model','_staff');
		$this->load->model('valuation_model','_value');
		
		// tables
		$this->_table_staff = "staff";
	}
	
	function index()
	{
		redirect('staff/overview');
	}
	
	function hire()
	{
		
		$valuation_snapshot	= $this->_value->getCompanyTotal();
		$co_worth			= $valuation_snapshot['valuation'] !=0 ? $valuation_snapshot['valuation'] : .01; //make sure this is
		$candidates 		= $this->_staff->getFreeStaff();
		$max 				= $this->config->item('staff_equity_max');
		
		// candidates cannot ask for more equity than $max
		foreach($candidates as $k => $v)
		{
			$equity = ($v['worth']/$co_worth)*100;
			$candidates[$k]['equity'] = $equity;
			if($equity >= $max){
				$candidates[$k]['equity'] = $max;
			}
		}
		//pre_print_r($candidates);die();
		
		$data['staff_data']			= $candidates;
		$data['page_title']			= "Hire New Staff Members";
		$data['page_title_short']	= "hire";
		$data['content']['main']	= 'staff_add';
		buildLayout($data);
	}
	
	function finalizeHire($id = 0)
	{
		// get staff worth
		$staff = $this->_staff->_getStaffbyID(array('id'=>$id,'tags'=>TRUE));
		$staff_worth = $this->_value->currentTagValuation($staff['tags']);
		//pre_print_r($staff_worth);
		
		// get company worth
		$valuation_snapshot	= $this->_value->getCompanyTotal();
		$company_worth = $valuation_snapshot['valuation'] !=0 ? $valuation_snapshot['valuation'] : .01; //make sure this is never 0
		//pre_print_r($company_worth);
		
		// calculate demanded equity
		$staff_equity = round(($staff_worth/($company_worth*1000))*100); // company worth x 1000 to keep demanded equity low
		//pre_print_r($staff_equity);
		
		// get user equity
		$user_equity = 100;
		
		// if user equity(-1%) is greater than demanded equity, run hireStaff
		if(($user_equity-1) > $staff_equity){
			if(user_confirm(base_url()."staff/hire/")){
				$this->_staff->hireStaff(array('id'=>$id,'equity'=>$staff_equity));
				// also update user equity
				$this->_crud->update('company',array('id'=>$this->session->userdata('company_id'),'user_id'=>$this->tank_auth->get_user_id()),array('user_equity'=>$user_equity-$staff_equity));
				redirect();	
			}			
		}
		else
		{
			// provide error message: "You don't have enough available equity to hire this employee."
		}
	}
	
	function overview()
	{
		$data['page_title']			= "Staff Overview";
		$data['content']['main']	= 'staff_overview';
		//$data['staff_data']			= $this->_staff->getUserOverview($this->session->userdata('id'));
		$data['staff_data']			= $this->_staff->getStaffDetails($this->session->userdata('company_id'));
		$data['output']				= $this->_staff->getTotalOutput();
		buildLayout($data);
	}
	
	function employee_detail($id)
	{
		$staff = $this->_staff->_getStaffbyID(array('id'=>$id,'tags'=>TRUE,'valuation'=>TRUE));
		$worth = $this->_value->calculateStaffValuation($id);
		
		// running this to update worth --- don't need to run it every time
		//$this->db->where('id', $staff['id']);
		//$this->db->update($this->_table_staff, array('worth'=>$worth));		
		$staff['worth'] = $worth;
		
		$data['staff'] = $staff;
		$data['page_title']			= "Employee Detail";
		$data['content']['main']	= 'staff_detail';
		buildLayout($data);
	}

}