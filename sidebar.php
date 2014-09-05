<?php
/**
 * @package WordPress
 * @subpackage Base_theme
 */
?>
        <aside class="sidebar-page">          
          <nav class="main-menu">
            <?php get_top_menu(); ?>
          </nav>
          
          <nav class="link-menu">
			<?php get_left_menu(); ?>
			<?php /*
            <ul>
              <li class="btn-blog"><a href="#">our blog</a></li>
              <li class="btn-apply"><a href="#">Apply Online</a></li>
              <li class="btn-sign"><a href="#">Sign Your Lease</a></li>
              <li class="btn-view"><a href="#">View Lease</a></li>
            </ul> */ ?>
          </nav>
          
          <section class="widget-rates">
            <div class="border">
              <header>
                <h3>rates starting at</h3>
              </header>
              <p>$ 535</p>
            </div>
          </section>
          
		  
			<?php
				$args = array(
					'before_widget' => '<section class="widget-tweet">',
					'after_widget' => '</section>',
					'before_title' => '<header>',
					'after_title' => '</header>',
				);
				xmt($args, 'Primary');
			?>		  
		  <?php // dynamic_sidebar( 'left-sidebar' ); ?>
		  
        </aside>
