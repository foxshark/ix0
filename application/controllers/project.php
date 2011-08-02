<?php
class Project extends Controller {

	function Project()
	{
		parent::Controller();
		//$this->load->library('form_validation');
		//$this->load->model('user_model','_users');
		$this->load->model('project_model','_project');
		$this->load->model('company_model','_company');
		$this->load->model('staff_model','_staff');
	}
	
	function index()
	{
		if(!$this->session->userdata('logged_in')) {
			redirect('');
		}
	}
	
	function overview($id)
	{	
		
		// check to see if this project is assigned to this user/company
		if(!is_myproject($id)){	redirect();	}
		
		$project_id 				= $id;
		$project_data 				= $this->_project->getProjectDetails($project_id);
		$tag_data					= $this->_staff->getStaffTagsOnly($this->session->userdata('id'));	
		pre_print_r($tag_data);
		
		// assemble our $data for the view
		$data['page_title']			= "Project Overview";
		$data['content']['main']	= 'project_overview';
		$data['p']					= $project_data;
		$data['t'] 					= $tag_data; 
		buildLayout($data);
	}
	
	function editProject($project_id)
	{
		$data['page_title']			= $project_id?"Edit Project":"Add Project";
		$data['content']['main']	= 'project_edit';
		$data['project_id']			= $project_id;
		//$data['project_data']		= $this->_fgrid->getAllSquares();
		buildLayout($data);
	}
	
	function addTag($project_id, $tag_id)
	{
		if(user_confirm(base_url()."project/overview/$project_id"))
		{
			// check to see if this project is assigned to this user/company
			if(!is_myproject($project_id)){	redirect();	}
			
			$company = $this->_company->getCompany($this->session->userdata('id'));
			if(!empty($company))
			{
				// do you have this tag available (staff with tag, not being used, not in progress)
				// if yes, add tag to project (last priority)
				$this->_project->addProjectTag($company['id'], $project_id, $tag_id);	
			}
			
			// else or after adding, redirect
			redirect('project/overview/'.$project_id);
		}
	}
}