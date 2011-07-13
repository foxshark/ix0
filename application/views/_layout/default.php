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
</head>

<body>

    <div id="container">
    
        <header>
        
            <h2>Manifestiny</h2>
            <? if(isset($user_details) && !empty($user_details)){ ?>
            	<p class="logged_in_as"><span class="user_color user_<?=$user_details['id']?>"></span> <?=$username?> | resources available: <strong><?= $user_details['account'] ?></strong> | income: <strong><?=$user_details['tot_resource'] ?></strong> per hour | <a href="<?=base_url()?>home/logout/">log out</a></p>
            <? } ?>
			
			<? if(isset($page_title)){?>
            	<h1><?=$page_title?></h1>
			<? }?>
        </header>
        
        <div id="content">
        
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
    
    </div><!--! end of #container -->
    
    <?=js_asset('jquery-1.4.2.min.js');?>
    <?=js_asset('plugins.js?v=1');?>
    <?=js_asset('script.js?v=1');?>
    <!--[if lt IE 7 ]>
    <?=js_asset('dd_belatedpng.js?v=1');?>
    <![endif]-->
  
</body>
</html>