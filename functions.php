<?php
/*
 * @package WordPress
 * @subpackage Base_Theme
 */
error_reporting(0); //E_ALL
$content_width = 600;				// Defines maximum width of images in posts
add_editor_style();					// Allows editor-style.css to configure editor visual style.


require_once (dirname (__FILE__) . '/__custom_ticker.php');

add_theme_support( 'post-thumbnails' );
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'front-gal-thumb', 174, 105, true ); //(cropped)
	add_image_size( 'front-slide', 629, 279, true ); //(cropped)
	add_image_size( 'featured-image', 590, 157, true ); //(cropped)
	add_image_size( 'floor-plan-thumb', 94, 72, true ); //(cropped)
}
	
function scripts_method() {
	/*if(is_front_page()){
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js');
	}*/
	wp_enqueue_script( 'jquery' );
}
add_action('wp_enqueue_scripts', 'scripts_method');

register_sidebar( array(
	'description' => 'Main sidebar',
	'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );

register_sidebar( array(
	'id' => 'left-sidebar',
	'name' => 'Left Sidebar',	
	'description' => 'Left widget area',
	'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );

register_nav_menus( array(
	'main' => 'Main Navigation Menu',
	'secondary' => 'Secondary navigation Menu',
	'location' => 'Location Menu',
	'left' => 'Left Menu',
) );
wp_create_nav_menu('LocationMenu');
wp_create_nav_menu('MainMenu');
wp_create_nav_menu('FooterMenu');
wp_create_nav_menu('LeftMenu');

function get_location_menu(){
  wp_nav_menu(array(
  'container'       => ' ', 			// tag name '' - for no container.
  'container_id'    => ' ',    // tag id
  'menu_class'      => '',				// ul class
  'menu_id'			=> 'nav-location',			// ul id
  'echo'            => true,
  'theme_location'  => 'location'));		// menu location name ('main' or 'secondary' by default)
}

function get_top_menu(){
  wp_nav_menu(array(
  'container'       => ' ', 			// tag name '' - for no container.
  'container_id'    => ' ',    // tag id
  'menu_class'      => '',				// ul class
  'menu_id'			=> 'nav-main',			// ul id
  'echo'            => true,
	'link_before'      => '<span></span>',
  'theme_location'  => 'main'));		// menu location name ('main' or 'secondary' by default)
}

function get_footer_menu(){
  wp_nav_menu(array(
  'container'       => ' ', 			// tag name '' - for no container.
  'container_id'    => ' ',    // tag id
  'menu_class'      => '',				// ul class
  'menu_id'			=> 'nav-footer',			// ul id
  'echo'            => true,
  'theme_location'  => 'secondary'));		// menu location name ('main' or 'secondary' by default)
}

function get_left_menu(){
  wp_nav_menu(array(
  'container'       => ' ', 			// tag name '' - for no container.
  'container_id'    => ' ',    // tag id
  'menu_class'      => '',				// ul class
  'menu_id'			=> 'link-menu',			// ul id
  'echo'            => true,
  'theme_location'  => 'left'));		// menu location name ('main' or 'secondary' by default)
}

/*function remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'remove_recent_comments_style' );*/

function show_posted_in() {
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	} else {
		$posted_in = 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	}
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}

add_theme_support( 'automatic-feed-links' );

function short_content($content,$sz = 500,$more = '...') {
	if (strlen($content)<$sz) return $content;
	$cp = explode("<!--more-->");
	if (count($cp>1)) return $cp[0].$more;
	$p = strpos($content, " ",$sz);
    if (!$p) return $content;
        $content = strip_tags($content);
        if (strlen($content)<$sz) return $content;
        $p = strpos($content, " ",$sz);
        if (!$p) return $content;
	return substr($content, 0, $p).$more;
}

function bmc_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
        // Display trackbacks differently than normal comments.
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <p><?php _e( 'Pingback:', 'twentytwelve' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?></p>
    <?php
            break;
        default :
        // Proceed with normal comments.
        global $post;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment">
            <header class="comment-meta comment-author vcard">
			<cite class="fn">
				<a href="<?php echo get_comment_author_link(); ?>" rel="external nofollow" class="url">Kate Dowson</a> - <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'twentytwelve' ), 'after' => ' ', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>				
			</cite>             
			 <?php
                    printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                        esc_url( get_comment_link( $comment->comment_ID ) ),
                        get_comment_time( 'c' ),
                        /* translators: 1: date, 2: time */
                        sprintf( __( '%1$s at %2$s', 'twentytwelve' ), get_comment_date(), get_comment_time() )
                    );
				?>                
            </header><!-- .comment-meta -->

            <?php if ( '0' == $comment->comment_approved ) : ?>
                <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
            <?php endif; ?>

            <section class="comment-content comment">
                <?php comment_text(); ?>
                <?php edit_comment_link( __( 'Edit', 'twentytwelve' ), '<p class="edit-link">', '</p>' ); ?>
            </section><!-- .comment-content -->

			<?php /*
            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'twentytwelve' ), 'after' => ' ', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div><!-- .reply -->
			*/ ?>
			
        </article><!-- #comment-## -->
    <?php
        break;
    endswitch; // end comment_type check
}

function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function getTweetCount($url)
{
    $url = urlencode($url);
    $twitterEndpoint = "http://urls.api.twitter.com/1/urls/count.json?url=%s";
    $fileData = file_get_contents(sprintf($twitterEndpoint, $url));
    $json = json_decode($fileData, true);
    unset($fileData); // free memory
    //print_r($json);
    return $json['count'];
}

//add_action('admin_init', 'wpse28702_restrictAdminAccess', 1);
function wpse28702_restrictAdminAccess() {
    $isAjax = (defined('DOING_AJAX') && true === DOING_AJAX) ? true : false;

    if(!$isAjax) {
        if(!current_user_can('administrator')) {
            wp_die(__('You are not allowed to access this part of the site'));
        }
    }
}