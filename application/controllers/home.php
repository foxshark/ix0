<?php
class Home extends Controller {

	function Home()
	{
		parent::Controller();
		//$this->load->library('form_validation');
		$this->load->model('user_model','_users');
	}
	
	function index()
	{
		if($this->session->userdata('logged_in')) {
			$this->my_char();
		} else {
			$this->login();
		}
	}
	
	function my_char()
	{
		$data['page_title'] = "Home";
		$data['content']['main'] = 'character';
		$data['user_details'] = $this->_users->getMyStats();
		buildLayout($data, "mobile");
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