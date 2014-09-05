<?php
/**
 *
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
<?php get_header(); ?>

		<div id="container">
			<div id="content" role="main">
				<h1 class="page-title">
				<?php global $post;
					  if ( is_day() ) : 
						echo 'Daily Archives: <span>'.get_the_date().'</span>';
					  elseif ( is_month() ) : 
					  	echo 'Monthly Archives: <span>'.get_the_date('F Y').'</span>';
					  elseif ( is_year() ) :  
					  	echo 'Yearly Archives: <span>'.get_the_date('Y').'</span>';
					  elseif ( is_tag() ) :  
					  	echo 'Tag Archives: <span>'.single_tag_title().'</span>';
					  else : 
					  	echo 'Blog Archives';
					  endif; 
					 ?>
				</h1>
				<?php include("loop.php"); ?>
			</div>
		</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
