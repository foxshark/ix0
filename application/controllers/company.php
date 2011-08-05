<?php
class Company extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		//$this->load->model('user_model','_users');
		$this->load->model('project_model','_project');
		$this->load->model('company_model','_company');
		$this->load->model('staff_model','_staff');
		$this->load->model('crud_model','_crud');
		$this->_project->checkForMyOutstandingProjects();	
		$this->load->library('form_validation');
		
	}
	
	function index()
	{
		if(!$this->session->userdata('logged_in')) {
			redirect('');
		}
	}
	
	function addCompany()
	{
		
		$u_id = $this->tank_auth->get_user_id();
		if($this->session->userdata('company_id')){ redirect(); }
		
		$post = $this->input->post();
		if($post)
		{ 
			foreach($post as $k => $v)
			{
				// create blank rules for all fields
				$validation[] = array('field'=>$k, 'label'=>$k, 'rules'=>'');
				
				// set actual validation rules for specific fields
				if($k==="name"){ $validation[] = array('field'=>'name', 'label'=>'Company Name', 'rules'=>'required'); }
			}
			$this->form_validation->set_rules($validation); 
		}		
		
		if($this->form_validation->run() == FALSE)
		{
			$data['page_title']			= "Start Company";
			$data['page_title_short']	= "add_company";
			$data['content']['main']	= array("company_add");
			buildLayout($data);
		}
		else
		{
			$id = $this->_company->addCompany($post);
			redirect();
		}
		
	}
	
	function name()
	{
		$name = $this->_company->nameGenerator();
		echo $name;
	}

}