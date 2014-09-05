<?php
 /*
  Template Name: Page Location
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

          <article id="post-<?php the_ID(); ?>" class="post-page cf">
						<?php the_content(); ?>
          </article>

          <section class="bottom-location cf">
            <div class="left">			
				      <?php the_field('address'); ?>
            </div>
            
            <div class="right">				
				      <?php the_field('google_gadget'); ?>
            </div>
          </section>
		  
		  <?php include('google-map.php');?>

	<?php endif; ?>
        </div>
	
<?php get_footer(); ?>
