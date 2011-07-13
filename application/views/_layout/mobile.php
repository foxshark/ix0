<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <!--[if IE]><![endif]-->
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <title></title>
    <meta name="description" content="">
    <meta name="author" content="">
    <?=css_asset('style.css?v=1');?>
    <?=js_asset('modernizr-1.5.min.js');?>
    <style type="text/css">
html, body {
	height: 100%;
}

#centeredcontent {
	width: 480px;
	height: 720px;
	text-align: left;
	border: 5px solid #999;
	background-color: #fff;
	color: #333;
	position: absolute;
	left: 50%;
	top: 50%;
	margin-left: -240px; 
	/* Half the width of the DIV tag which is 50 pixels */
	margin-top: -360px; 
	/* Half the height of the DIV tag which is also 50 pixels */
}
</style>

</head>

<body style="background-image:url(assets/images/trenta.gif)">

    <? // <div id="container"> ?>
    
        <header>
        
            <? if(isset($user_details) && !empty($user_details)){ ?>
            	<p class="logged_in_as"><span class="user_color user_<?=$user_details['id']?>"></span> <?=$username?> | resources available: <strong><?= $user_details['account'] ?></strong> | income: <strong><?=$user_details['tot_resource'] ?></strong> per hour | <a href="<?=base_url()?>home/logout/">log out</a></p>
            <? } ?>
			
        </header>
        
        
        <div id="centeredcontent">
        <div id="content">
        	<div style="background-color:#777; width:100%; color:#FFFFFF; margin-bottom:10px;">
            <? if(isset($page_title)){?>
            	<?=$page_title?>
			<? }?>
            </div>
        	<div id="main">
            
				<? 
                $load = $content['main'];		
                if(!is_array($load)){ $load = array($load); } // turn single entries into an array		
                foreach($load as $v)
                { 
                    $this->load->view($v); 
                }
                ?>
                            
            </div>
        
        </div>
        
        <footer>
        
        </footer>
    	</div> <!-- end floating middle div -->
<? //    </div><!--! end of #container --> ?>
    
    <?=js_asset('jquery-1.4.2.min.js');?>
    <?=js_asset('plugins.js?v=1');?>
    <?=js_asset('script.js?v=1');?>
    <!--[if lt IE 7 ]>
    <?=js_asset('dd_belatedpng.js?v=1');?>
    <![endif]-->
  
</body>
</html>