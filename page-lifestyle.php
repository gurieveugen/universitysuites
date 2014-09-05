<?php
 /*
  Template Name: Page Lifestyle
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
      
      <section class="bottom-lifestyle cf">
		<?php 
		$banner_image = get_field('banner_image');
		$banner_url = get_field('banner_url');
		?>
		<?php if(!empty($banner_image)){?>
		<p><img src="<?php echo $banner_image;?>" alt=" "></p>
		<?php }?>
            <div class="map cf">
			<?php echo do_shortcode('[store_wpress display="map"]'); ?>
			</div>
      </section>

	<?php endif; ?>
	</div>
	
<?php get_footer(); ?>
