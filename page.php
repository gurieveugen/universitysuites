<?php
/**
 *
 * @package WordPress
 * @subpackage Base_Theme
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
            <?php wp_link_pages( array( 'before' => '<div class="page-link">Pages:', 'after' => '</div>' ) ); ?>
            <?php edit_post_link('Edit', '<span class="edit-link">', '</span>' ); ?>
            
          </article>

	<?php endif; ?>
        </div>

<?php get_footer(); ?>
