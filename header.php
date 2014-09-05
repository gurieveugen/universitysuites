<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />

	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); 
		wp_head(); ?>		
	<!--[if lt IE 9]> 
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/html5.js"></script>
	<![endif]-->		
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.easing.1.3.js"></script>			
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/menu.js"></script>		
	
	<?php if(is_front_page()){?>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.nivo.slider.js"></script>    
	<?php } ?>		
	
	
	<?php if(is_page('floor-plans')){?>
	<?php /* <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/ad-gallery/jquery.ad-gallery.css"> */?>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/ad-gallery/jquery.ad-gallery.js"></script>	
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<?php }?>
	
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/fancybox/jquery.fancybox-1.3.4.css" media="screen" />	
	<!--<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=tyurinp"></script>-->
	
<!--[if IE]><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/ie.css" type="text/css" media="screen" /><![endif]-->
<script type="text/javascript" charset="utf-8" src="<?php bloginfo('template_url'); ?>/js/css_browser_selector.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/custom-form-elements.js"></script>
<?php if(is_page('contact')){?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script> 
<?php }?>

</head>
<body <?php body_class(); ?> <?php if(is_page('contact')){ echo 'onload="initialize()"';}?>>
  <div class="global-box">
    <div class="center-box">
      <header id="header" class="cf">
        <div class="top-header cf">
          <nav class="top-menu left">
            <?php get_location_menu(); ?>
          </nav>
          <?php /* ?>
          <a href="https://conway-universitysuites.securecafe.com/onlineleasing/university-suites-at-conway/register.aspx?myOlePropertyId=66376&FloorPlanID=0&sMoveInDate=&sRent=&RentableItemTypeIDs=&sbeds=&sLeaseTerm=&UnitID=0&isFromContactLoginPrompt=&guestcard=" target="_blank" class="btn-apply left">Apply now</a>
<?php */ ?>
<a href="http://www.conway.universitysuites.net/application/" class="btn-apply left">Apply now</a>
          
          <ul class="share-header right">
            <li class="email"><a href="mailto:kallen@universitysuites.net">email</a></li>
            <li class="tweet"><a href="https://twitter.com/CCUSuiteLife" target="_blank">tweet</a></li>
            <li class="facebook"><a href="https://www.facebook.com/pages/U-Suites-Coastal/332268743319" target="_blank">facebook</a></li>
          </ul>
          
          <section class="contact-header right">
            <p><a href="/contact/">Contact/ Directions</a></p>
            <p>(843) 349-1010</p>
          </section>
        </div>
<?php if(is_front_page()){?>   
    
        <figure class="img-header"><a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"><img src="<?php bloginfo('template_url'); ?>/images/logo_home.png" alt=" "></a></figure>
        
<?php } else {?>  

        <section class="img-header-page">
          <figure><a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"><img src="<?php bloginfo('template_url'); ?>/images/logo_page.png" alt=" "></a></figure>
          <?php if(is_home() || is_single()){
			$option_page_id =  get_option('page_for_posts');
			}elseif(is_page() || is_single()){
			$option_page_id = $post_id;	
			}
			?>	
		  <p><?php the_field('header_text', $option_page_id);?></p>
        </section>
        
<?php } ?> 
      </header>   
<?php if(is_front_page()){?>      
      <section id="content" class="home-page cf">
<?php } else {?>      
      <section id="content" class="cf">
<?php } ?> 
        <a href="/calendar/" class="btn-calendar">calendar</a>		
        <a href="https://conway-universitysuites.securecafe.com/residentservices/university-suites-at-conway/userlogin.aspx" class="btn-payonline" target="_blank">Pay Online</a>
        <header class="tit-page">
          <h1><?php if(is_home() || (is_single() && get_post_type() == 'post' )){ echo 'Our Blog'; }elseif(is_single() && get_post_type() == 'ticker'){ echo 'Special'; }else{ the_title(); } ?></h1>
        </header>