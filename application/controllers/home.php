<?php
class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('user_model','_users');
		$this->load->model('valuation_model','_value');
		$this->load->model('company_model','_company');
		
		// make everything in this controller require login
		if (!$this->tank_auth->is_logged_in()) { redirect('auth/login'); }
				
	}
	
	function index()
	{		
		// should only need to run getActiveCompany on login (we're assuming this is the first page after login)
		$company_id = $this->_company->getActiveCompanyID();
		if(!$company_id) {
			// redirect them to start a company screen
			redirect('company/start');
		}
		// set the active company id in session for use throughout the site
		$this->session->set_userdata('company_id',$company_id);
		
		$this->my_dash();
	}
	
	function rules()
	{
		// assemble our view data
		$data['page_title'] = "Game Rules";
		$data['content']['main'] = "rules";
		$data['page_title_short'] = "rules";
		buildLayout($data);
	}
	
	function my_dash()
	{
		$this->load->model('project_model','_project');
		$this->load->model('staff_model','_staff');
		
		$company = $this->_company->getCompany();
		
		$data['valuation_snapshot']	= $this->_value->getCompanyTotal();
		$data['staff_data'] = $this->_staff->getStaffDetails($company['id']);
		$data['projects'] = $this->_project->getCompanyProjects($company['id']);
		$data['company'] = $company;

		$data['page_title'] = "Dashboard";
		$data['page_title_short'] = "dash";
		$data['content']['main'] = 'dash';
		buildLayout($data);
	}
	
	/* all oudated by Tank Auth
	function login()
	{
		
		
		$this->load->library('form_validation');
		$this->session->unset_userdata('username');
		if($this->session->userdata("username"))
		{
			redirect('products');	
		}
		else
		{
			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			
			if ($this->form_validation->run() == true)
			{
				if($this->input->post('username') == "kyle@sitegoals.com"){ $this->session->set_userdata('id',2); }
				$this->session->set_userdata('logged_in','yes');
				//if($this->simplelogin->login($this->input->post('username'),$this->input->post('password')))
				//{
					$company_id = $this->_company->getActiveCompanyID($this->session->userdata('id'));
					if(!$company_id)
					{
						// redirect them to create a company screen
					}
					$this->session->set_userdata('company_id',$company_id);
					redirect(base_url());
				//}
			}
	
			$data['page_title'] = "Login";
			$data['content']['main'] = array('login');
			
			// uncomment to see hiring interface
			//$data['content']['main'] = 'hire';
			
			buildLayout($data);
		}
	}
	
	function logout()
	{
		$this->simplelogin->logout();
		redirect(base_url());
	}
	
	function register()
	{
		// validate
		// if good, insert into db
		// auto login? or direct to login page
		
		// assemble our view data
		$data['page_title'] = "Register";
		$data['content']['main'] = array('register');
		buildLayout($data);
	}*/
}