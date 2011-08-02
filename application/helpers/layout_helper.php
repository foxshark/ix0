<?
function buildLayout($data = false, $layout_template = "default") //mobile
{
	// start $data if not already set
	if(!isset($data)){ $data = array();	}
	$data['css_url'] = base_url();
	
	// expose our data to the view
	if(!isset($data['page_title_short'])){
		$data['page_title_short'] = "page";
	}
	if(!isset($data['content'])){
		$data['content'] = "hi";
	} else {
		if(!is_array($data['content']['main'])){
			$data['content']['main'] = array($data['content']['main']);
		}
	}

	$CI =& get_instance();
	$data['username'] = $CI->session->userdata('username');
	$CI->load->view('_layout/'.$layout_template, $data);
}