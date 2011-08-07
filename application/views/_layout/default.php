<!doctype html>
<!--[if lt IE 7 ]> <html class="no-js ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<? $names = array("IPOfestr","Strtup","Strtup","Startup","Betaville","IPOville","eWebnet","Dotcom Bust","Dotcom Bubble Burster","Dot Dot Dot Com"); $site_name = $names[array_rand($names)] . " (alpha)"; ?>
	<title><?=$site_name?></title>
	<meta name="description" content="">
	<meta name="author" content="">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	<?=css_asset('style.css?v=1');?>
	<?=css_asset('style-dark.css?v=1');?>
    <?=js_asset('modernizr-1.7.min.js');?>

</head>

<body class="<?=$page_title_short?>">

<div id="container">

	<header>
	
		<h2><?=$site_name?></h2>
		<? if($this->tank_auth->is_logged_in()){?>
		<ul class="user-links">
			<li><a href="<?=base_url()?>">Dashboard</a></li>
			<li><a href="<?=base_url()?>home/rules">Rules</a></li>
			<? if(is_admin()){?>
			<li><a href="<?=base_url()?>admin">Admin</a></li>
			<? } ?>
			<li><?=$this->tank_auth->get_username()?> | <a href="<?=base_url()?>auth/logout">Logout</a></li>
		</ul>
		<? } ?>
	
	</header>
	
	<? if(isset($page_title)){?>
        <h1><?=$page_title?></h1>
    <? }?>
	
	<div id="main" role="main">
	
		<? 
		$load = $content['main'];		
        if(!is_array($load)){ $load = array($load); } // turn single entries into an array		
        foreach($load as $v){ $this->load->view($v); }
        ?>
	
	</div>
	
	<footer>
		
	</footer>
	
</div> 

<?=js_asset('jquery-1.5.1.min.js');?>
<?=js_asset('plugins.js?v=1');?>
<?=js_asset('script.js?v=1');?>

<!--[if lt IE 7 ]>
<?=js_asset('dd_belatedpng.js?v=1');?>
<script>DD_belatedPNG.fix('img, .png_bg'); // Fix any <img> or .png_bg bg-images. Also, please read goo.gl/mZiyb </script>
<![endif]-->

</body>
</html>