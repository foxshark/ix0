<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	// work in progress
	// see: http://heybigname.com/2009/08/28/how-to-write-a-better-model-in-code-igniter/
	// and: http://blog.builtbyprime.com/php/a-guide-to-generic-code-igniter-models	
	
	/*
	*  returns false if the $data array does not contain all of the keys assigned by the $required array.
	*/
	function _required($required, $data)
	{
		foreach($required as $field) if(!isset($data[$field])) return false;
		return true;
	}
	
	function _default($defaults, $options)
	{
		return array_merge($defaults, $options);
	}
	
	function insert($table,$data) 
	{
		$this->db->insert($table,$data);
		return $this->db->insert_id();
	}
	
	/* example usage:
	function exampleFunction($options = array())
	{
		// required values
		if(!$this->_required(array('userEmail'), $options)) return false;
	
		// default values
		$options = $this->_default(array('userStatus' => 'active'), $options);
	}
	*/
	
}