<?php
/**
 * @package WordPress
 * @subpackage BMC
 */
if ( post_password_required() )
    return;
?>

<section id="comments" class="comments-area cf">

    <?php // You can start editing here -- including this comment! ?>

    <?php if ( have_comments() ) : ?>
		<h2 class="comments-title">Comments <span>(<?php echo get_comments_number();?>)</span></h2>

        <ol class="commentlist cf">
            <?php wp_list_comments( array( 'callback' => 'bmc_comment', 'style' => 'ol' ) ); ?>
        </ol><!-- .commentlist -->

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
        <nav id="comment-nav-below" class="navigation" role="navigation">
            <h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'twentytwelve' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'twentytwelve' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'twentytwelve' ) ); ?></div>
        </nav>
        <?php endif; // check for comment navigation ?>

        <?php
        /* If there are no comments and comments are closed, let's leave a note.
         * But we only want the note on posts and pages that had comments in the first place.
         */
        if ( ! comments_open() && get_comments_number() ) : ?>
        <p class="nocomments"><?php _e( 'Comments are closed.' , 'twentytwelve' ); ?></p>
        <?php endif; ?>

    <?php endif; // have_comments() ?>

	<?php
	if(empty($commenter['comment_author'])){ $commenter['comment_author'] = 'Name *'; }
	if(empty($commenter['comment_author_email'])){ $commenter['comment_author_email'] = 'Email *'; }
	if(empty($commenter['comment_author_url'])){ $commenter['comment_author_url'] = 'Website'; }
	
	?>
	
    <?php comment_form(array(
				'comment_field' => '<div class="fild-form cf"><div class="text-textarea border"><span><textarea id="comment" name="comment" class="text-textarea border" aria-required="true">Message *</textarea></span></div></div>',
				'fields' => array(
								'author' => '<div class="fild-form cf"><div class="text-input border"><span><input id="author" name="author" type="text" value="' .  esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' /></span></div>',
								'email' => '<div class="text-input border"><span><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' /></span></div>',
								'url' => '<div class="text-input border"><span><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></span></div></div>'
							)				
					)); ?>
</section>