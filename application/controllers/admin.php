<?php

class Admin extends Controller {

	function Admin()
	{
		parent::Controller();
		//$this->load->library('form_validation');
		$this->load->model('admin_model','_admin');
	}
	
	function index()
	{
		$this->load->view('home');
	}
	
	function makeSquares()
	{
		$this->_admin->makeSquares();
	}
}