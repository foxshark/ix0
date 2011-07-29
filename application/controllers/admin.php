<?php

class Admin extends Controller {

	function Admin()
	{
		parent::Controller();
		//$this->load->library('form_validation');
		$this->load->model('admin_model','_admin');
		$this->load->model('tag_model','_tags');
		}
	
	function index()
	{
		$this->tags();
	}
	
	function tags()
	{
		$data['page_title']			= "Admin: Tags";
		$data['content']['main']		= 'admin/tags';
		$data['tags']			= $this->_tags->getTags();
		buildLayout($data);
	}
}