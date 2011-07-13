<?php
class Grid extends Controller {

	function Grid()
	{
		parent::Controller();
		//$this->load->library('form_validation');
		$this->load->model('grid_model','_grid');
		$this->load->model('frac_grid_model','_fgrid');
		$this->load->model('user_model','_users');
	}
	
	function index()
	{
		$data['page_title'] = "Home";
		$data['content']['main'] = 'home';
		$data['grid'] 		= $this->_fgrid->getAllSquares();
		$data['user_details'] = $this->_users->getMyStats();
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
					redirect(base_url());
				}
			}
	
			$data['page_title'] = "Login";
			$data['content']['main'] = 'login';
			buildLayout($data);
		}
	}
	
	function logout()
	{
		$this->simplelogin->logout();
		redirect(base_url());
	}
}