<?php
	
add_action('init', 'ticker_init');
function ticker_init() 
{
  $labels = array(
    'name' => _x('Tickers', 'post type general name'),
    'singular_name' => _x('Ticker', 'post type singular name'),
    'add_new' => _x('Add New', 'Ticker'),
    'add_new_item' => __('Add New Ticker'),
    'edit_item' => __('Edit Ticker'),
    'new_item' => __('New Ticker'),
    'view_item' => __('View Ticker'),
    'search_items' => __('Search Tickers'),
    'not_found' =>  __('No Tickers found'),
    'not_found_in_trash' => __('No Tickers found in Trash'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => true,
    'menu_position' => null,
    //'supports' => array('title','editor','excerpt','comments','author',)
    'supports' => array('title','thumbnail','editor', 'page-attributes','custom-fields'),	
  ); 
  register_post_type('ticker',$args);
  
}

//add filter to insure the text Сase study, or Сase study, is displayed when user updates a Сase study 
add_filter('post_updated_messages', 'ticker_updated_messages');
function ticker_updated_messages( $messages ) {

  $messages['Сase study'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Сase study updated. <a href="%s">View Сase study</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Сase study updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Сase study restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Сase study published. <a href="%s">View Сase study</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Сase study saved.'),
    8 => sprintf( __('Сase study submitted. <a target="_blank" href="%s">Preview Сase study</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Сase study scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Сase study</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Сase study draft updated. <a target="_blank" href="%s">Preview Сase study</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}

//display contextual help for Сase studies
add_action( 'contextual_help', 'add_ticker_help_text', 10, 3 );

function add_ticker_help_text($contextual_help, $screen_id, $screen) { 
  //$contextual_help = . var_dump($screen); // use this to help determine $screen->id
  if ('Сase study' == $screen->id ) {
    $contextual_help =
      '<p>' . __('Things to remember when adding or editing a Сase study:') . '</p>' .
      '<ul>' .
      '<li>' . __('Specify the correct genre such as Mystery, or Historic.') . '</li>' .
      '<li>' . __('Specify the correct writer of the Сase study.  Remember that the Author module refers to you, the author of this Сase study review.') . '</li>' .
      '</ul>' .
      '<p>' . __('If you want to schedule the Сase study review to be published in the future:') . '</p>' .
      '<ul>' .
      '<li>' . __('Under the Publish module, click on the Edit link next to Publish.') . '</li>' .
      '<li>' . __('Change the date to the date to actual publish this article, then click on Ok.') . '</li>' .
      '</ul>' .
      '<p><strong>' . __('For more information:') . '</strong></p>' .
      '<p>' . __('<a href="http://codex.wordpress.org/Posts_Edit_SubPanel" target="_blank">Edit Posts Documentation</a>') . '</p>' .
      '<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>') . '</p>' ;
  } elseif ( 'edit-Сase study' == $screen->id ) {
    $contextual_help = 
      '<p>' . __('This is the help screen displaying the table of Сase studies blah blah blah.') . '</p>' ;
  }
  return $contextual_help;
}

// Custom Taxonomy Code
//add_action( 'init', 'ticker_category_taxonomies', 0 );   
function ticker_category_taxonomies() {
    $labels = array(
      'name' => _x( 'Industries', 'taxonomy general name' ),
      'singular_name' => _x( 'Indastry', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search Indastry' ),
      'all_items' => __( 'All Industries' ),
      'edit_item' => __( 'Edit Indastry' ), 
      'update_item' => __( 'Update Indastry' ),
      'add_new_item' => __( 'Add New Indastry' ),
      'new_item_name' => __( 'New Indastry' ),
      'menu_name' => __( 'Industries' ),
    );
    register_taxonomy('industries', 'ticker', array('hierarchical' => true, 'label' => 'Industry', 'labels' => $labels, 'query_var' => true, 'rewrite' => true ));
	
    $labels = array(
      'name' => _x( 'Services', 'taxonomy general name' ),
      'singular_name' => _x( 'Service', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search Service' ),
      'all_items' => __( 'All Services' ),
      'edit_item' => __( 'Edit Service' ), 
      'update_item' => __( 'Update Service' ),
      'add_new_item' => __( 'Add New Service' ),
      'new_item_name' => __( 'New Service' ),
      'menu_name' => __( 'Services' ),
    );
    register_taxonomy('services', 'ticker', array('hierarchical' => true, 'label' => 'Services', 'labels' => $labels, 'query_var' => true, 'rewrite' => true ));	
}


add_filter("manage_edit-ticker_columns", "header_ticker_columns");
add_action("manage_ticker_posts_custom_column", "ticker_custom_columns");

function header_ticker_columns($columns)
{
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => "Title",
		"expiration_date" => "Expiration date",
		"date" => "Date"
	);
	return $columns;
}

function ticker_custom_columns($column){  
        global $post;   
        switch ($column)   
        {  	
            case "expiration_date":  
				$expiration_date = get_field('expiration_date', get_the_ID());
				$ex_date =  mysql2date('Y/n/j', $expiration_date);
				echo $ex_date;
                break;			  
        }   
}



/*
add_action( 'admin_menu', 'actionAdminMenu');

function actionAdminMenu (){
	add_meta_box("ticker-box", "Link", "ticker_box", "ticker", "normal", "high");  	
}

function ticker_box(){
	global $post;
	$ticker_link = get_post_meta($post->ID, 'ticker_link', true);
	
	echo '<input type="hidden" name="ticker_noncename" id="ticker_noncename" value="' . 
    wp_create_nonce( plugin_basename(__FILE__) ) . '" />';	
	
	?>
	<table style="width:auto;">
	  <tr>
	    <td>URL:</td>
	    <td><input type="text" name="ticker_link" style="width:400px;" value="<?php echo $ticker_link; ?>"></td>
	  </tr> 
	</table>
	<?php
}




add_action('save_post', 'save_ticker'); 

function save_ticker($post_id){
	global $post;
	
  if ( !wp_verify_nonce( $_POST['ticker_noncename'], plugin_basename(__FILE__) )) {
    return $post_id;
  }
	
	//update_post_meta($post->ID, "_wp_page_template", 'page-rider.php');
  
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    return $post_id;	
	
	
	if($post->post_type == 'ticker' && $_SERVER['REQUEST_METHOD'] == 'POST'){
	
		update_post_meta($post_id, "ticker_link", $_POST["ticker_link"]);
			
	}
}
*/

function set_ticker_admin_order($wp_query) {
  if (is_admin()) {
    // Get the post type from the query
    $post_type = $wp_query->query['post_type'];

    if ( $post_type == 'ticker') {

      // 'orderby' value can be any column name
      //$wp_query->set('orderby', 'menu_order');
	  $wp_query->set('orderby', 'meta_value');
	  $wp_query->set('meta_key', 'expiration_date');

      // 'order' value can be ASC or DESC
      $wp_query->set('order', 'ASC');	  
		
    }
  }
}
add_filter('pre_get_posts', 'set_ticker_admin_order');


	/*	ticker functions	*/

		function ticker_filter_where( $where = '' ) {
			$where .= " AND STR_TO_DATE(wp_postmeta.meta_value, '%Y-%m-%d') >= '" . date('Y-m-d', strtotime('now')) . "' ";
			return $where;
		}

		function ticker_filter_fields($fields){
			global $wp_query, $wpdb;
			$fields .= ", STR_TO_DATE(wp_postmeta.meta_value, '%Y-%m-%d') AS expiration_date ";			
			return ($fields);
		}		
				
		function date_diff2($date1, $date2){
			$diff = strtotime($date2) - strtotime($date1);
			return abs($diff);
		}

		function ticker_orderby($orderby_statement) {
			$orderby_statement = "expiration_date ASC";
			return $orderby_statement;
		}
?>