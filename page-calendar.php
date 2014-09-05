<?php
 /*
  Template Name: Page Calendar
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

          <article id="post-<?php the_ID(); ?>" class="post-page">
          
            <?php the_content(); ?>
			
			<?php 
			$calendar_url = get_post_meta(get_the_ID(), 'calendar_url', true);
			
			$calendar_embed_code = get_post_meta(get_the_ID(), 'calendar_embed_code', true);
			
			if(!empty($calendar_embed_code)){
			echo $calendar_embed_code;
			}elseif(!empty($calendar_url)){
			echo do_shortcode('[calendar url="'.$calendar_url.'"]');
			}
			?>
            
          </article>

	<?php endif; ?>
        </div>

<?php get_footer(); ?>
