<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
      </section>
      
      <footer id="footer" class="cf">
        <aside class="sidebar-footer cf">
		
		<?php
		
		add_filter('posts_orderby', 'ticker_orderby');	
		add_filter( 'posts_where', 'ticker_filter_where' );
		add_filter( 'posts_fields', 'ticker_filter_fields');
		$ticker_query =  new WP_Query( array('post_type'=>'ticker', 'meta_key'=>'expiration_date', 'posts_per_page'=>1) );
		remove_filter( 'posts_where', 'ticker_filter_where' );
		remove_filter( 'posts_orderby', 'ticker_orderby' );
		remove_filter( 'posts_fields', 'ticker_filter_fields' );
		
		//echo '<!--<pre>';
		//print_r($ticker_query);
		//echo '</pre>-->';
		
		while ( $ticker_query->have_posts() ){
			$ticker_query->the_post();
			$expiration_date = get_field('expiration_date', get_the_ID());
			
			/*
			$now = date('Y-m-d');
			$interval_sec = date_diff2($expiration_date, $now);
			$interval_days = $interval_sec/86400;
			*/
			$ex_date =  mysql2date('Y/n/j', $expiration_date);
			$ex_date .= ' 00:00:01';
		?>
          <section class="widget-expires-footer">
            <h3>Monthly Special<br>Countdown</h3>
			<?php echo do_shortcode('[jcountdown timetext="'.$ex_date.'" timezone="3" style="flip" color="black" width="0" textgroupspace="15" textspace="0" reflection="false" reflectionopacity="10" reflectionblur="0" daytextnumber="2" displayday="true" displayhour="false" displayminute="false" displaysecond="false" displaylabel="false" onfinishredirecturl=""]'.$ex_date.'[/jcountdown]');?>
            <!-- <a href="<?php the_permalink(); ?>" class="icon-arrow" title="<?php the_title(); ?>">View now</a>-->
			<a href="#monthly-special" class="icon-arrow" id="monthly-special-link" title="<?php the_title(); ?>">View now</a>
			
          </section>
		  
		<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery("#monthly-special-link").fancybox({ 'showCloseButton'	: false, 'titlePosition' 		: 'inside', 'titleFormat'		: formatTitle });			
		});
		function formatTitle(title, currentArray, currentIndex, currentOpts) {
			return '<div id="lightbox-style-title"><span><a href="javascript:;" onclick="jQuery.fancybox.close();"><img src="<?php bloginfo('template_url'); ?>/images/closelabel.gif" /></a></span><br><br></div>';
		}		
		</script>
		<div style="display:none">
			<div id="monthly-special" class="lightbox-block">
				<!--<div class="logo-lightbox"><a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"><img src="<?php bloginfo('template_url'); ?>/images/logo_text.png" alt="<?php bloginfo('name'); ?>" /></a></div>-->
				<div class="entry-lightbox">			
					<h1>UniversitySuites</h1>		
					<h2>Monthly special</h2>
					<h3><?php the_title(); ?></h3>
					<?php the_content(); ?>
				</div>
			</div>		
		</div>		  
        <?php }?>
		<?php wp_reset_postdata();?>		
		  
          <section class="widget-contact-footer">
            <h3>Where are we?</h3>
            <p>University Suites at Conway<br>2241 Technology Blvd<br>Conway, SC 29526<br>(843) 349-1010</p>
            <div class="icon-dog">Pet Friendly</div>
          </section>
          
          <section class="widget-form-footer">
            <h3>Request more info</h3>
            <?php echo do_shortcode('[contact-form-7 id="28" title="Contact form"]');?>
          </section>
        </aside>
        
        <div class="left icon-home">&copy; 2013 University Suites. All Rights Reserved.</div>
        <div class="right">Website Design by <a href="http://www.inkhaus.com">INKHAUS</a></div>
      </footer>
    </div>
  </div>
<?php wp_footer(); ?>
		<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery("#coming-soon-link").fancybox({ 'showCloseButton'	: false, 'titlePosition' 		: 'inside', 'titleFormat'		: formatTitle });			
		});
		function formatTitle(title, currentArray, currentIndex, currentOpts) {
			return '<div id="lightbox-style-title"><span><a href="javascript:;" onclick="jQuery.fancybox.close();"><img src="<?php bloginfo('template_url'); ?>/images/closelabel.gif" /></a></span><br><br></div>';
		}		
		</script>
		<div style="display:none">
			<div id="coming-soon" class="lightbox-block">
				<!--<div class="logo-lightbox"><a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"><img src="<?php bloginfo('template_url'); ?>/images/logo_text.png" alt="<?php bloginfo('name'); ?>" /></a></div>-->
				<div class="entry-lightbox">			
					<h1>UniversitySuites</h1>		
					<h2>Coming Soon</h2>
					<h3>Want an invite?</h3>
					<p>We are currently developing this page, please register to receive notice of our launch and other great stuff that happens here. *We respect your privacy.</p>
					<?php echo do_shortcode('[contact-form-7 id="242" title="Coming Soon"]');?>
				</div>
			</div>		
		</div>
</body>
</html>