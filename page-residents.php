<?php
 /*
  Template Name: Page Residents
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
          <article id="post-<?php the_ID(); ?>" class="post-residents left cf">

				    <?php the_content(); ?>
				
          </article>
	
		<?php
		$quick_links = get_field('quick_links');
		if($quick_links){
			?>	
          <section class="right-residents right">
            <header>
              <h3>quick links</h3>
            </header>
            <ul>
			<?php $i = 1;?>
			<?php foreach($quick_links as $ql){ ?>
			<?php if(count($quick_links) == $i){ $class = 'class="last cf"'; }else{ $class = '';} ?>
			<?php if($ql['text'] == 'Resident App'){ ?>
				<li <?php echo $class; ?>><img src="<?php bloginfo('template_url'); ?>/images/upload/img_100.png" class="img1" alt=" "><a href="<?php echo $ql['link']; ?>"><?php echo $ql['text']; ?></a><img src="<?php bloginfo('template_url'); ?>/images/upload/residents_10.png" class="img2" alt=" "></li>			
			<?php }else{ ?>
				<li <?php echo $class; ?>><a href="<?php echo $ql['link']; ?>"><?php echo $ql['text']; ?></a></li>
			<?php }?>  
			<?php $i++; }?>  
            </ul>
          </section>
		<?php }?>
			
	<?php endif; ?>	
          
          <section class="bottom-residents">
            <header>
              <h3>Residents Blog Articles</h3>
            </header>	
					  <?php query_posts( 'posts_per_page=10&cat=8' ); ?>
            <?php include("loop.php"); ?>
          </section>
	</div>
<?php get_footer(); ?>
