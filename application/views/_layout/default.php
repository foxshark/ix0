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
	<?=css_asset('style.css?v=1');?>
    <?=js_asset('modernizr-1.7.min.js');?>

</head>

<body>

<div id="container">

	<header>
	
		<h2>IPOfestr <em>beta</em></h2>
		<? if(isset($user_details) && !empty($user_details)){ ?>
            <p class="logged_in_as"><span class="user_color user_<?=$user_details['id']?>"></span> <?=$username?> | resources available: <strong><?= $user_details['account'] ?></strong> | income: <strong><?=$user_details['tot_resource'] ?></strong> per hour | <a href="<?=base_url()?>home/logout/">log out</a></p>
        <? } ?>
        
        <? if(isset($page_title)){?>
            <h1><?=$page_title?></h1>
        <? }?>
	
	</header>
	
	<div id="main" role="main">
	
		<div id="main">
            
			<? 
			$load = $content['main'];		
            if(!is_array($load)){ $load = array($load); } // turn single entries into an array		
            foreach($load as $v){ $this->load->view($v); }
            ?>
                        
        </div><!-- end #main -->
	
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