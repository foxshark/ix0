<?php
class Home extends Controller {

	function Home()
	{
		parent::Controller();
		//$this->load->library('form_validation');
		$this->load->model('user_model','_users');
		$this->load->model('valuation_model','_value');
		$this->load->model('company_model','_company');
		
	}
	
	function index()
	{
		if($this->session->userdata('logged_in')) {
			$this->my_dash();
		} else {
			$this->login();
		}
	}
	
	function my_dash()
	{
		$this->load->model('project_model','_project');
		$this->load->model('staff_model','_staff');

		$company = $this->_company->getCompany($this->session->userdata('company_id'));
	
		$data['valuation_snapshot']			= $this->_value->getCompanyTotal();

		$data['page_title'] = "Dashboard";
		$data['page_title_short'] = "dash";
		$data['content']['main'] = 'dash';
		
		//$data['staff_data']		= $this->_staff->getUserOverview($this->session->userdata('id'));
		$data['staff_data'] 		= $this->_staff->getStaffDetails($company['id']);
		//$data['project_data']		= $this->_project->getProjectOverview($this->session->userdata('id'));		
		//$data['skill_data']		= $this->_staff->getStaffTagsOnly($this->session->userdata('id'),1);
		// replace the above function with getAllProjects, which will contain skill_data for each project
		$data['projects'] = $this->_project->getCompanyProjects($company['id']);
		$data['company'] = $company;

		//$data['user_details'] = $this->_users->getMyStats();
		//buildLayout($data, "mobile");
		buildLayout($data);
	}
	
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
				if($this->simplelogin->login($this->input->post('username'),$this->input->post('password')))
				{
					$company_id = $this->_company->getActiveCompanyID($this->session->userdata('id'));
					if(!$company_id)
					{
						// redirect them to create a company screen
					}
					$this->session->set_userdata('company_id',$company_id);
					redirect(base_url());
				}
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
	}
	
	function rules()
	{
		// assemble our view data
		$data['page_title'] = "Game Rules";
		$data['content']['main'] = array('rules');
		buildLayout($data);
	}
}