<?php
class Project extends Controller {

	function Project()
	{
		parent::Controller();
		//$this->load->library('form_validation');
		//$this->load->model('user_model','_users');
		$this->load->model('project_model','_project');
		$this->load->model('staff_model','_staff');
	}
	
	function index()
	{
		if(!$this->session->userdata('logged_in')) {
			redirect('');
		}
	}
	
	function overview()
	{	
		

		// hard code project id for now
		$project_id 				= 1;
		$project_data 				= $this->_project->getProjectOverview($project_id);
		$tag_data 					= $this->_staff->getStaffTagsOnly($this->session->userdata('id'));
		
		//$data['project_data']		= $this->_project->getProjectOverview($this->session->userdata('id'));
		
		
		// assemble our $data for the view
		$data['page_title']			= "Projects Overview";
		$data['content']['main']	= 'project_overview';
		$data['p'] = $project_data;
		$data['t'] = $tag_data; 
		buildLayout($data);
	}
	
	function editProject($project_id)
	{
		$data['page_title']		= $project_id?"Edit Project":"Add Project";
		$data['content']['main']	= 'project_edit';
		$data['project_id']		= $project_id;
		//$data['project_data']		= $this->_fgrid->getAllSquares();
		buildLayout($data);
	}
	
	function update($project_id)
	{
		$this->load->library('form_validation');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			
			if ($this->form_validation->run() == true)
			{
				if($this->simplelogin->login($this->input->post('username'),$this->input->post('password')))
				{
					redirect(base_url());
				}
			}
	
			$data['page_title'] = "Login";
			$data['content']['main'] = array('login','register');
			
			// uncomment to see hiring interface
			//$data['content']['main'] = 'hire';
			
			buildLayout($data);
	}
	
	function addTag($project_id, $tag_id)
	{
		// is this your project?
		// is this skill already in progress?
			// if yes to both, add skill to project (last priority)
			$this->_project->addProjectTag($project_id, $tag_id);
		// else or after adding, redirect
		redirect('project/overview');
	}
}