<!doctype html>
<!--[if lt IE 7 ]> <html class="no-js ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>IPO Fest</title>
	<meta name="description" content="">
	<meta name="author" content="">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0b1/jquery.mobile-1.0b1.min.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.1.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.0b1/jquery.mobile-1.0b1.min.js"></script>

</head>

<body>

<div data-role="page">

	<div data-role="header">
	
		<h1><? if(isset($page_title)){?><?=$page_title?> | <? }?>IPOfestr <em>beta</em></h1>
		<? if($this->session->userdata('logged_in')){?>
			<a href="<?=base_url()?>" data-icon="home">Dashboard</a>
			<a href="<?=base_url()?>logout">Logout</a>
		<? } ?>	
	</div>
	
	<div data-role="content">
	
		<? 
		$load = $content['main'];		
        if(!is_array($load)){ $load = array($load); } // turn single entries into an array		
        foreach($load as $v){ $this->load->view($v); }
        ?>
	
	</div>
	
	<div data-role="footer">
	
		<p>&copy; <?=date('Y');?> IPOfestr. All rights reserved.</p>
	
	</div>
	
</div> 

</body>
</html>