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

// creates a simple form for quickly adding a single item
/*function quick_add($action_url, $title, $field_name, $field_label, $default_status=2, $save_text="")
{
	//example usage:
	//quick_add("client/add_client/","New Client","Client Name","name",2,"Add Client");
	
	if($save_text==""){ $save_text = "Add " . $title; }
	
	?>
    <div class="quick_add">
        
    <form action="<?=base_url()?><?=$action_url?>" method="post">
        
        <input name="agency" type="hidden" value="101">
        
        <?= form_error('agency'); ?>
        
        <span class="quick_add_title">New <?=$title?></span>
        
        <div class="form_line"><label for="<?=$field_name?>" class="infield"><?=$field_label?></label>
        <input name="<?=$field_name?>" id="<?=$field_name?>" type="text" value="<?= set_value($field_name); ?>" size="50"></div>

        <?= form_error($field_name); ?>
        
        <input type="hidden" name="status" value="2">
        
        <input name="Add" type="submit" value="<?=$save_text?>" class="quick_add_save">
        
    </form>
        
    </div>
<?
}*/

// create a list of links
function status_list($url, $links=array("active","pending","inactive","declined"), $status=array("active","pending","inactive","declined"), $active=0, $client_id='')
{
	/*
	example usage:
	status_list("client",$list_nav["names"],$list_nav['active'])
	*/

	$output = '<ul class="status_list">';
	foreach($links as $k => $name){
		$output.='<li id="status_'.$k.'" class="'.$name;

		if($active==$name){ $output.=' current'; }

		$output.='"><a href="'.base_url().$url;

		if($client_id!=''){ $output.="/".$client_id; }		

		$output.='/'.$name.'/">'.$status[$k].'</a></li>';
	}
	$output.='</ul>';
	return $output;
}

function status_list_client($url, $links=array("active","pending","inactive","declined"), $status=array("active","pending","inactive","declined"), $active=0, $client_id='')
{
	$output = '<ul class="status_list">';
	foreach($links as $k => $name){
		$output.='<li id="status_'.$k.'" class="'.$name;

		if($active==$name){ $output.=' current'; }

		$output.='"><a href="'.base_url()."client";

		if($client_id!=''){ $output.="/".$client_id; }		

		$output.='/'.$url.'/'.$name.'/">'.$status[$k].'</a></li>';
	}
	$output.='</ul>';
	return $output;
}

function sort_menu($url, $options=array("Most Recent","Alphabetical"), $selected="")
{
	if(isset($_POST['sort_menu_submit'])){
		redirect($_POST['list_sort']);
	}
    $output = '<form name="sort_menu" action="" method="post"><div class="sort_menu"><label for="sort_menu_select">Sort by</label><div class="form_line"><select name="list_sort" id="sort_menu_select">';
	foreach($options as $k=>$v){
        $output .= '<option value="'.$k.'"' . set_select("list_sort", $k, $k == $selected) . ' >'.$v.'</option>';
	}
    $output .= '</select></div>';
    
    $output .= '<noscript><input type="submit" name="sort_menu_submit" value="Sort" class="sort_menu_submit"></noscript></div></form>';
	return $output;
}

function is_client(){
	return false;
}

function is_superadmin(){
	return true;
}