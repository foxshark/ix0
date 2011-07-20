<?php
class Project extends Controller {

	function Project()
	{
		parent::Controller();
		//$this->load->library('form_validation');
		//$this->load->model('user_model','_users');
		$this->load->model('project_model','_project');
	}
	
	function index()
	{
		if(!$this->session->userdata('logged_in')) {
			redirect('');
		}
	}
	
	function overview()
	{
		$this->load->model('staff_model','_staff');
		$data['page_title']		= "Projects Overview";
		$data['content']['main']	= 'project_overview';
		$data['project_data']		= $this->_project->getUserOverview($this->session->userdata('id'));
		$data['skill_data']		= $this->_staff->getStaffTagsOnly($this->session->userdata('id'),1);
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
}