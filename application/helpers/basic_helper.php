<?
function pre_print_r($v=array())
{
	echo "<pre>";
	if(!empty($v))
	{
		print_r($v);
	} else {
		print_r("&laquo; empty array &raquo;");
	}
	echo "</pre>";
}

function is_myproject($project_id)
{
	$CI =& get_instance();
	
	$CI->load->model('project_model','_project');
	$CI->load->model('company_model','_company');
	
	// get all projects for the company ID tied to this user's session id
	//$company = $CI->_company->getCompany($CI->session->userdata('id'));
	$projects = $CI->_project->getCompanyProjects($CI->_company->getActiveCompanyID($CI->tank_auth->get_user_id()));
	// permission granted if requested project id matches
	foreach($projects as $p)
	{
	//pre_print_r($projects); die;
		if($p['id'] === $project_id)
		{
			return true;
		}
	}
	
	// else if project wasn't found, deny access
	return false;	
	
}

function is_admin()
{
	$CI =& get_instance();
	$admins = array(1,2);
	$id = $CI->tank_auth->get_user_id();
	if(in_array($id,$admins)){
		return true;
	}
	return false;
}

function user_confirm($return_url)
{
	// get flashdata from session
	$CI =& get_instance();	
	$confirm = $CI->session->flashdata('confirmed');	
	
	// first time the page loads, show our confirmation dialog
	if(!$confirm)
	{
		// set confirm to yes for the next page load
		$CI->session->set_flashdata('confirmed','yes');
		// yes reloads (confirming), no goes back without completing the action
		echo "Are you sure? <a href='".current_url()."'>Yes</a> or <a href='$return_url'>No</a>.";
		return false;
	}
	else
	{
		return true;
	}
}