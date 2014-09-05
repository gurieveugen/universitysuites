<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>

<?php if ( ! have_posts() ) : ?>

          <article class="post-page cf">
            <header>
              <h1>Not Found</h1>
            </header>
            <p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
            <?php get_search_form(); ?>
          </article>
	
<?php endif; ?>

<?php while ( have_posts() ) : the_post(); ?>

          <article id="post-<?php the_ID(); ?>" class="post-blog cf">
            <div class="date-post"><span><?php the_time("j"); ?></span><?php the_time("M"); ?></div>
            
            <div class="txt">
              <header>
                <h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
              </header>
              <div class="meta-date border cf"><span class="icon-autor">by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>"><?php the_author() ?></a></span><span class="icon-comments"><?php comments_number( '0', '1', '%' ); ?></span></div>
								<?php the_content( 'Continue reading &rarr;' ); ?>
								<?php 
               // $cont = get_the_excerpt(); 
               // if (!$cont) $cont = short_content(get_the_content()); 
               // echo $cont;
                ?>
              <div class="meta-date cf"><?php the_tags('<span class="icon-tag"><strong>Tags:</strong> ', ', ', ' '); ?> </span></div>
              <footer>
                <span>Social Share:</span>
                <ul class="share-post">
                  <li><a class="addthis_button_facebook_like" fb:like:layout="button_count" fb:like:locale="en_US"></a></li>
                  <li><a class="addthis_button_tweet"></a></li>
                  <li><a class="addthis_button_google_plusone" g:plusone:size="medium"></a></li>
                </ul>
              </footer>
            </div>
          </article>	

<?php comments_template( '', true ); ?>
<?php endwhile; ?>

<?php if ( $wp_query->max_num_pages > 1 ) : ?>

	<div id="nav-below" class="navigation">
		<?php wp_pagenavi(); ?>
	</div>


		<script type="text/javascript">
		jQuery(window).load(function() {
				jQuery(".wp-pagenavi .pages").hide();
				jQuery("#nav-below").addClass("cf");
				var pre_link = jQuery(".previouspostslink").attr("href");
				var next_link = jQuery(".nextpostslink").attr("href");
				jQuery(".wp-pagenavi").prepend('<a href="'+pre_link+'" class="prev">Previous</a>');
				jQuery(".wp-pagenavi").append('<a href="'+next_link+'" class="next">Next</a>');
				
		});
		</script>
		
<?php endif; ?>
