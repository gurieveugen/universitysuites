<?php
 /*
  Template Name: Page Floor Plans
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

          <article id="post-<?php the_ID(); ?>" class="post-page cf">
		      	<?php the_content(); ?>
          </article>
          
		  
		  <?php
		  $slides = get_field('slides');
		  
		  if($slides){
		  ?>		  
          <section class="photo-plans">
            <header>
              <h3>Floor Plans</h3>
            </header>			
							<script type="text/javascript">
              jQuery(window).load(function() {
                var galleries = jQuery('.ad-gallery').adGallery({
					callbacks: {
						beforeImageVisible: function(new_image, old_image) {
							jQuery(".ad-image").find("img").after('<a href="#" class="btn-larger">larger</a>');
						}
					}
									
				});
                
              jQuery(document).on("click", ".ad-image", function(){
                  //var content_id = jQuery(this).attr("href");
                  var href = jQuery(".ad-image img").attr("src");
                  //alert(href);
                  jQuery.fancybox( content, {
                      'type'				: 'image',
                      'href'				: href,
                      'titlePosition'		: 'inside',
                      'transitionIn'		: 'none',
                      'transitionOut'		: 'none'
                  });	
                  return false;				
                });			
              });
              </script>
                
                <div id="gallery" class="ad-gallery">
                  <div class="ad-image-wrapper">
                  
                  </div>
                  <div class="ad-controls">
                  </div>
                  <div class="ad-nav">
                  <div class="ad-thumbs">
                    <ul class="ad-thumb-list">
					<?php foreach($slides as $slide){?>
					<?php
					$i = 1;
					$plan_id = $slide['plan'];
					$slide_thumb = wp_get_attachment_image_src($plan_id, 'floor-plan-thumb');
					$slide = wp_get_attachment_image_src($plan_id, 'full');
					?>
                    <li>
                      <a href="<?php echo $slide[0]; ?>">
                      <img src="<?php echo $slide_thumb[0]; ?>" width="94px" height="72px"  title="" alt="" class="image<?php echo $i; ?>">
                      </a>
                    </li>
					<?php $i++; }?>          
                    </ul>
                  </div>
                  </div>
                </div>			
          </section>
		  <?php }?>
          
		  
		<?php if(get_field('apply_now_content')){?>
          <section class="bottom-plans">
            <a href="https://conway-universitysuites.securecafe.com/onlineleasing/university-suites-at-conway/register.aspx?myOlePropertyId=66376&FloorPlanID=0&sMoveInDate=&sRent=&RentableItemTypeIDs=&sbeds=&sLeaseTerm=&UnitID=0&isFromContactLoginPrompt=&guestcard=" class="btn-apply">Apply now!</a>
            <header>
              <h3><?php the_field('apply_now_title');?></h3>
            </header>
			<?php the_field('apply_now_content');?>
          </section>
		<?php }?>	
			
<?php endif; ?>

	</div>


<?php get_footer(); ?>