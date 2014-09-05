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

          <article id="post-<?php the_ID(); ?>" class="post-blog cf">
            <div class="date-post"><span><?php the_time("j"); ?></span><?php the_time("M"); ?></div>
            
            <div class="txt">
              <header>
                <h1><?php the_title(); ?></h1>
              </header>
              <div class="meta-date border cf"><span class="icon-autor">by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>"><?php the_author() ?></a></span><span class="icon-comments"><?php comments_number( '0', '1', '%' ); ?></span></div>
							<?php the_content(); ?>
						  <?php wp_link_pages( array( 'before' => '<div class="page-link"> Pages:', 'after' => '</div>' ) ); ?>
              <?php the_tags('<div class="meta-date cf"><span class="icon-tag"><strong>Tags:</strong> ', ', ', '</span></div>'); ?> 
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

					<?php if ( get_the_author_meta( 'description' ) ) : ?>
            <div id="entry-author-info">
              <div id="author-avatar">
                <?php echo get_avatar( get_the_author_meta( 'user_email' ),  60  ); ?>
              </div>
              <div id="author-description">
                <h2>About <?php the_author() ?></h2>
                <?php the_author_meta( 'description' ); ?>
                <div id="author-link">
                  <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                    View all posts by <?php the_author() ?> <span class="meta-nav">&rarr;</span>
                  </a>
                </div>
              </div>
            </div>
          <?php endif; ?>

          </article>	

				  <?php comments_template( '', true ); ?>

		<script type="text/javascript">
		jQuery(window).load(function() {	  
			jQuery('li.comment').last().addClass('last');
			//jQuery('#submit').wrap('<div class="submit border"><span>');
			jQuery('#submit').wrap('<span>');
			jQuery('input[name="author"]').focus(function() {
				var val = jQuery(this).val();
				if(val == 'Name *'){ jQuery(this).val(''); }
			}).focusout(function() {
				var val = jQuery(this).val();
				if(val == ''){ jQuery(this).val('Name *'); }
			});
			jQuery('input[name="email"]').focus(function() {
				var val = jQuery(this).val();
				if(val == 'Email *'){ jQuery(this).val(''); }
			}).focusout(function() {
				var val = jQuery(this).val();
				if(val == ''){ jQuery(this).val('Email *'); }
			});
			jQuery('input[name="url"]').focus(function() {
				var val = jQuery(this).val();
				if(val == 'Website'){ jQuery(this).val(''); }
			}).focusout(function() {
				var val = jQuery(this).val();
				if(val == ''){ jQuery(this).val('Website'); }
			});	
			var logined_content = jQuery('.logged-in-as').html();
			if(logined_content == undefined){
				jQuery('#comments').addClass('not-logged-in');
			} else {
				jQuery('#comments').removeClass('not-logged-in');
			}
			
				
		});
		</script>
		
<?php endif; ?>

        </div>
<?php get_footer(); ?>
