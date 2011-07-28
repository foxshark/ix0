<?
function buildLayout($data = false, $layout_template = "default")
	{
		// start $data if not already set
		if(!isset($data)){ $data = array();	}
		$data['css_url'] = base_url();
		
		// expose our data to the view
		if(!isset($data['css_id'])){
			$data['css_id']	= "page_default";
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