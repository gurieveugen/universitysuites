<?php
 /*
  Template Name: Page Amenities
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

          <section class="list-amenities cf">
            <header>
              <h3>Amenities</h3>
            </header>
            <div class="column left">
              <h4><?php the_field('left_column_title');?></h4>
              <?php the_field('left_column_content');?>
            </div>
            
            <div class="column right">
              <h4><?php the_field('right_column_title');?></h4>
              <?php the_field('right_column_content');?>
            </div>
            
            <p><span class="btn-white"><a href="<?php the_field('button_gallery_link');?>"><?php the_field('button_gallery_titile');?></a></span></p>
          </section>
          
          <section class="policy-box cf">
            <h2><?php the_field('pet_policy_title');?></h2>
            <?php the_field('pet_policy_content');?>
			<?php
			$pet_policy_form = get_field('pet_policy_form');			
			if(!empty($pet_policy_form)){
			?>
            <p><span class="pdf">Download (2MB)</span><span class="btn-white"><a href="<?php echo $pet_policy_form['url']; ?>">pet policy forms</a></span></p>
			<?php }?>
          </section>

	<?php endif; ?>
        </div>
	
<?php get_footer(); ?>
