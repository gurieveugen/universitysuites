<?php
/**
 *
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
<?php get_header(); ?>

<?php get_sidebar(); ?>

        <div class="right-page home-page">
          
<?php if ( have_posts() ) : the_post(); ?>
<?php $home_page_id = get_the_ID(); ?>
	
	<?php $slides = get_field('slides'); ?>
	<?php if($slides){ 
			$slide_desc = array();
			$c = 1;
			foreach($slides as $slide){
				$slide_desc[] = '"'.addslashes($slide['description']).'"';
				$image = wp_get_attachment_image_src($slide['slide'], 'front-slide');
				$slide_images[] = '<img src="'.$image[0].'" class="editable" width="629" height="279" id="untitled-region-'.$c.'" alt=""/>';
				$c++;
			}
	?>
	
    <script type="text/javascript">
	var SPEED = 1000;

    jQuery(window).load(function() {

	var slider = jQuery('.slider');
	var bar = slider.find('h2 .bar');
	var number = slider.find('h2 .number');
	var description = slider.find('.description');	
	
	var descriptions = new Array(
		<?php echo implode(",", $slide_desc);?>
		);		
		
		jQuery('#slider').nivoSlider({
			effect: 'fade',
			directionNav: false,
			pauseTime: 10000,
			animSpeed: (SPEED * 0.6),
			beforeChange: function() {
				
				// Get current slide number.
				var data = jQuery('#slider').data('nivo:vars');
				
				var current_slide = data.currentSlide + 1;
				var total_slides = data.totalSlides;
				
				if (current_slide + 1 > total_slides) {
					current_slide = 1;
				} else {
					current_slide++;
				}
												
				// Add the new description.
				jQuery('<span/>', {
					html: descriptions[current_slide - 1]
				}).appendTo(description.find('p'));
				
				// Animate bar and change number
				bar.animate({ width: '95px'}, SPEED / 2, 'easeInOutBack', function(){
					number.html("0" + current_slide);
					bar.animate({ width: '51px'}, SPEED / 2, 'easeInOutExpo');
				});
				
				setTimeout(function(){
					// Animate the Title and Description slide up.		
					description.find('span:first-child').animate({marginTop:"-65px"}, SPEED * 0.4, 'easeInOutBack', function(){ jQuery(this).remove() });
				}, SPEED * 0.08);
			}
		});
		
    });
    </script>
          <section class="slider-box cf">
                
           <div class="slider">
              <div id="slider" class="nivoSlider">
				<?php echo implode("", $slide_images); ?>
              </div>
              <div class="info">
                <h2>
				  <span class="total-bar"><span class="bar">&nbsp;</span></span><span class="number">01</span>
                  <img src="<?php bloginfo('template_url'); ?>/images/slash.png">
                </h2>
                
                <div class="description">
                  <p><span><?php echo $slides[0]['description'];?></span></p>
                  <span></span>
                </div>
                
                <div class="clear">&nbsp;</div>
              </div>
            </div>
          </section>
	<?php }?>

          <article class="post-home cf">
					  <?php the_content(); ?>
				    <?php wp_link_pages( array( 'before' => '<div class="page-link">Pages:', 'after' => '</div>' ) ); ?>
          </article>

<?php endif; ?>
          
          <section class="widget-news cf">
            <header>
              <h3>Latest From the Blog</h3>
            </header>
			<?php $latest_query = new WP_Query(array('posts_per_page' => 2)); ?>
            <ul>
			<?php while ( $latest_query->have_posts() ){ ?>
			<?php $latest_query->the_post(); ?>
              <li>
                <div class="date-post"><span><?php the_time("j"); ?></span><?php the_time("M"); ?></div>
                <div class="txt">
                  <header>
                    <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                  </header>
                  <?php the_excerpt();?>
				  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="more">Read more</a>
                </div>
              </li>
            <?php }?>  
            </ul>
          </section>
          
          <section class="widget-photos cf">
            <header>
              <h3><?php the_field('photos_header', $home_page_id);?></h3>
            </header>
			<?php
			$galleries = get_field('galleries', $home_page_id);
			if($galleries){
			?>
            <ul>
			<?php foreach($galleries as $gal){?>
			<?php $gal_thumb = wp_get_attachment_image_src($gal['image'], 'front-gal-thumb'); ?>
              <li>
                <figure>
                  <a href="<?php echo $gal['page_link']; ?>" class="img"><img src="<?php echo $gal_thumb[0]; ?>" alt=" "><span>+</span></a>
                  <figcaption><a href="<?php echo $gal['page_link']; ?>"><?php echo $gal['title']; ?></a></figcaption>
                </figure>
              </li>
			<?php }?>  
            </ul>
			<?php }?>
          </section>
        </div>
		

<?php get_footer(); ?>