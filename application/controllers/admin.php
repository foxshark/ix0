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
	
	function modtag($t=0)
	{
		$data['page_title']			= "Admin: Tags";
		$data['content']['main']		= 'admin/edittag';
		$data['t']				= $this->_tags->getTag($t);
		buildLayout($data);	
	}
	
	function savetag($id=0)
	{
		//pre_print_r($_POST);
		if(!empty($_POST))
		{
			$this->_tags->updateTag($id);
		}
		redirect('admin');	
	}
}