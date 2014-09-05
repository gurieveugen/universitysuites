<?php
 /*
  Template Name: Page Contact
 */
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>

        <div class="right-page">

          <figure class="topimg-page-box cf">
            <div class="border-img"><span>&nbsp;</span></div>
            <?php 
						if( has_post_thumbnail()){
							the_post_thumbnail('featured-image'); 
						}	
						?> 
          </figure>
          
	<?php if ( have_posts() ) : the_post(); ?>

			    <article id="post-<?php the_ID(); ?>"  class="post-page cf">	
			
			      <?php the_content(); ?>
      
          </article>
          
          <section class="contact-info cf">
            <div class="column">
              <h4><?php the_field('contact_information_title');?></h4>
              <p class="icon-map"><?php the_field('address');?></p>
              <p class="icon-phone"><?php the_field('phone');?></p>
              <p class="icon-mail"><?php the_field('email');?></p>
            </div>
            
            <div class="column">
              <h4><?php the_field('office_hours_title');?></h4>
              <p><?php the_field('office_hours');?></p>
            </div>
          </section>
          
          <section class="contact-map cf">
            <div class="map">
              <?php the_field('google_gadget_code'); ?>
			
		        	<?php include('google-map.php');?>
            </div>
          </section>

	<?php endif; ?>
	</div>

<?php get_footer(); ?>
