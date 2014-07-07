<!DOCTYPE html>
<html>
	<head>
		<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
		<meta charset="utf-8">
        <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta name="robots" content="index,follow"/>
		<meta name="description" content="<?php bloginfo('description'); ?>"/>
		<meta name="keywords" content="Mallow Studio" />
        <meta name="viewport" content="width=device-width">
        
        <?php wp_head(); ?>
        
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/colorbox/colorbox.css"></link>
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/styles.css"></link>
        
        <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/Utils.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/colorbox/jquery.colorbox-min.js"></script>
        <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/App.js"></script>
        
        <script type="text/javascript" src="//use.typekit.net/axo3bjh.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

        
        <script type="text/javascript"> //<![CDATA[  
			$(document).ready(function(){
				
				var mobile = Utils.checkMobile();
				//var app = new App();
				if(!mobile){
					$(".gallery-icon a").colorbox({rel:"gallery", maxWidth:'95%', maxHeight:'95%'});
				} else {
					$(".gallery-icon a").click(function(event){
						event.preventDefault();
						return false;	
					});
				}
				
				$("#menuButton").click(function(){
					$("#mobileNav").toggle();
				});
				
			});
		 //]]></script>
         
         
         
	</head>

<body class = "desktop">

<!-- HEADER -->
<div class = "outerHeader">
<header id = "intro" class = "wrapper">
    <div class = "headerLogo">
    	<!--<a href="<?php echo home_url('/'); ?>"><img src = "<?php header_image(); ?>" id = "logo" alt = "" /></a>-->
        <h1>Mallow Studio</h1>
        <a id = "menuButton"><img src="<?php bloginfo('template_url'); ?>/images/menu.png" /><span>MENU</span></a>
	</div>
    <nav>
        <ul class = "clearfix">
            <li><a<?php if(is_home()) echo ' class = "current"'; ?> href="<?php echo home_url('/'); ?>">Home</a></li>
            <li><a<?php if(is_page(147)) echo ' class = "current"'; ?> href="<?php echo get_page_link(147); ?>">Portfolio</a></li>
            <li><a<?php if(is_page(5)) echo ' class = "current"'; ?> href="<?php echo get_page_link(5); ?>">Blog</a></li>
            <li><a href="http://www.etsy.com/uk/shop/thedandeliongirl">Shop</a></li>
            <li><a<?php if(is_page(48)) echo ' class = "current"'; ?> href="<?php echo get_page_link(48); ?>">About</a></li>
        </ul>
    </nav>
    <div id = "mobileNav">
        <ul class = "clearfix">
            <li><a<?php if(is_home()) echo ' class = "current"'; ?> href="<?php echo home_url('/'); ?>">Home</a></li>
            <li><a<?php if(is_page(147)) echo ' class = "current"'; ?> href="<?php echo get_page_link(147); ?>">Portfolio</a></li>
            <li><a<?php if(is_page(5)) echo ' class = "current"'; ?> href="<?php echo get_page_link(5); ?>">Blog</a></li>
            <li><a href="google.co.uk">Shop</a></li>
            <li><a<?php if(is_page(48)) echo ' class = "current"'; ?> href="<?php echo get_page_link(48); ?>">About</a></li>
        </ul>
    </nav>
    
</header>
</div>