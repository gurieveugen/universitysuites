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

<?php if ( have_posts() ) : the_post(); ?>

          <article id="post-<?php the_ID(); ?>" class="post-monthly cf">
							<?php the_content(); ?>
						  <?php wp_link_pages( array( 'before' => '<div class="page-link"> Pages:', 'after' => '</div>' ) ); ?>
          </article>	
		
<?php endif; ?>

        </div>
<?php get_footer(); ?>
