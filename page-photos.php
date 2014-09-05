<?php
 /*
  Template Name: Page Photos
  
 */
 
?>
<?php
$facebook_album_shortcode = sprintf('[facebook_album]%s[/facebook_album]', get_option('fb_album_id'));
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>

        <div class="right-page">
    
	<?php if ( have_posts() ) : the_post(); ?>

          <article id="post-<?php the_ID(); ?>" class="photos-page cf">            
			<?php the_content(); ?>
            <ul class="list-cat-photos cf">
              <li id="facebook">
                <span><a href="#facebook"  rel="35">facebook <small>photos</small></a></span>
              </li>
              <li id="interior">
                <span><a href="#interior"  rel="174">Interior <small>+ exterior</small></a></span>
              </li>
              <li class="last" id="ammenities">
                <span><a href="#ammenities" rel="173">Amenities <small>+ Community</small></a></span>
              </li>
            </ul>
			
			
			
			<div id="photos_interior"><?php echo do_shortcode('[g-gallery gid="174" random="0" watermark="0"]'); ?></div>
			
			<div id="photos_ammenities"><?php echo do_shortcode('[g-gallery gid="173" random="0" watermark="0"]'); ?></div>
			
			<div id="photos_facebook"><?php echo do_shortcode($facebook_album_shortcode); ?></div>
						
          </article>            
			<script type="text/javascript">
            jQuery(window).load(function() {
				//jQuery(".gg_gallery_wrap").hide();
				var query = location.href.split('#');
				//alert(query[1]);
				if(query[1] == 'facebook'){
					jQuery("#facebook").addClass("active");
					jQuery("#photos_facebook").show();
					jQuery("#photos_interior").hide();
					jQuery("#photos_ammenities").hide();
				}else if(query[1] == 'interior'){
					jQuery("#interior").addClass("active");
					//.gg_gallery_wrap .gg_img
					jQuery("#photos_facebook").hide();
					jQuery("#photos_interior").show();					
					jQuery("#photos_ammenities").hide();					
				}else if(query[1] == 'ammenities'){
					jQuery("#ammenities").addClass("active");
					jQuery("#photos_facebook").hide();
					jQuery("#photos_interior").hide();
					jQuery("#photos_ammenities").show();					
				}else{
					jQuery("#facebook").addClass("active");
					jQuery("#photos_facebook").show();
					jQuery("#photos_interior").hide();
					jQuery("#photos_ammenities").hide();					
				}
				//jQuery(".gg_overlays").attr("style", "");	
				
				//var gid = jQuery(".list-cat-photos li.active span a").attr("rel");
				//jQuery(".gid_"+gid).show();

				jQuery(".list-cat-photos li span a").click(function(){
					//jQuery(".gg_gallery_wrap").hide();
					//var gid = jQuery(this).attr("rel");
					//jQuery(".gid_"+gid).show();
					var gall = jQuery(this).attr("href");
					//alert(gall);
					if(gall == '#facebook'){
						jQuery("#facebook").addClass("active");
						jQuery("#photos_facebook").show();
						jQuery("#photos_interior").hide();
						jQuery("#photos_ammenities").hide();
					}else if(gall == '#interior'){
						jQuery("#interior").addClass("active");
						jQuery("#photos_facebook").hide();
						jQuery("#photos_interior").show();
						jQuery("#photos_ammenities").hide();						
					}else if(gall == '#ammenities'){
						jQuery("#ammenities").addClass("active");
						jQuery("#photos_facebook").hide();
						jQuery("#photos_interior").hide();
						jQuery("#photos_ammenities").show();					
					}					

					jQuery(".list-cat-photos li").removeClass("active");
					jQuery(this).parent().parent().addClass("active");					
				});	
					
			});
			</script>
            

	<?php endif; ?>
        </div>
	
<?php get_footer(); ?>
