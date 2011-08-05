<?php
class Project extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		//$this->load->model('user_model','_users');
		$this->load->model('project_model','_project');
		$this->load->model('company_model','_company');
		$this->load->model('staff_model','_staff');
		$this->_project->checkForMyOutstandingProjects();	
		$this->load->library('form_validation');
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
		
		$company_id 				= $this->_company->getActiveCompanyID($this->tank_auth->get_user_id());
		$project_id 				= $id;
		$project_data 				= $this->_project->getProjectDetails($id);
		//$tag_data					= $this->_staff->getStaffTagsOnly($this->session->userdata('id'));	
		// replaced getStaffTagsOnly with getAvailableTags which should take into consideration tags that are in progress
		$tag_data					= $this->_project->getAvailableTags($company_id, $project_id);
		
		// assemble our $data for the view
		$data['page_title']			= "Project Overview";
		$data['content']['main']	= array('project_overview','project_add_tags');
		$data['p']					= $project_data;
		$data['t'] 					= $tag_data; 
		buildLayout($data);
//		pre_print_r($data);
	}
	
	function addProject()
	{
		$tag_data = $this->_project->getAvailableTags($this->session->userdata('company_id'));
		//pre_print_r($tag_data);die();
		$post = $this->input->post();
		if($post)
		{ 
			foreach($post as $k => $v)
			{
				// create blank rules for all fields
				$validation[] = array('field'=>$k, 'label'=>$k, 'rules'=>'');
				
				// set actual validation rules for specific fields
				if($k==="name"){ $validation[] = array('field'=>'name', 'label'=>'Project Name', 'rules'=>'required'); }
			}
			$this->form_validation->set_rules($validation); 
		}		
		
		if($this->form_validation->run() == FALSE)
		{
			$data['t']					= $tag_data;
			$data['page_title']			= "Add Project";
			$data['page_title_short']	= "add_project";
			$data['content']['main']	= array("project_add"/*,"project_add_tags"*/);
			buildLayout($data);
		}
		else
		{
			$id = $this->_project->addProject($post);
			redirect('project/overview/'.$id);
		}
		
	}
	
	function editProject($project_id)
	{
		$data['page_title']			= $project_id?"Edit Project":"Add Project";
		$data['content']['main']	= 'project_edit';
		$data['project_id']			= $project_id;
		buildLayout($data);
	}
	
	function addTag($project_id, $tag_id)
	{
		if(user_confirm(base_url()."project/overview/$project_id"))
		{
			// check to see if this project is assigned to this user/company
			if(!is_myproject($project_id)){	redirect();	}
			
			$company_id 				= $this->_company->getActiveCompanyID($this->tank_auth->get_user_id());
			if(!empty($company_id))
			{
				// do you have this tag available (staff with tag, not being used, not in progress)
				// if yes, add tag to project (last priority)
				$this->_project->addProjectTag($company_id, $project_id, $tag_id);	
			}
			
			// else or after adding, redirect
			redirect('project/overview/'.$project_id);
		}
	}
}