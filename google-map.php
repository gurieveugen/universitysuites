<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3&amp;sensor=false"></script>
<?php
			$markers = get_field('markers');
			if($markers){ ?>
						
			<div id="map_canvas" style="width:<?php the_field('map_canvas_width'); ?>; height:<?php the_field('map_canvas_height'); ?>"></div>
			<script type="text/javascript">
			
			jQuery(document).ready(function($) {
				initialize(); 
			});
			function initialize() {
				
				var map_centerLatLng =  new google.maps.LatLng(<?php the_field('map_center');?>);
				var mapOptions = {
					center: map_centerLatLng,
					zoom: <?php the_field('zoom');?>,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);	
				geocoder = new google.maps.Geocoder();
				
				var address = '';
				<?php $counter = 1; ?>
				<?php foreach($markers as $marker){?>
				
				<?php if(!empty($marker['point'])){?>
				
					var position = new google.maps.LatLng(<?php echo $marker['point'];?>);
							var marker_<?php echo $counter;?> = new google.maps.Marker({
								map: map,
								position: position
								<?php if(!empty($marker['icon'])){?>,
								icon: '<?php echo $marker['icon']; ?>'
								<?php }?>
							});	
							
				<?php }elseif(!empty($marker['address'])){?>
				
				address = '<?php echo $marker['address'];?>';
				geocoder.geocode( { 'address': address}, function(results, status) {
						  if (status == google.maps.GeocoderStatus.OK) {

							var marker_<?php echo $counter;?> = new google.maps.Marker({
								map: map,
								position: results[0].geometry.location
								<?php if(!empty($marker['icon'])){?>,
								icon: '<?php echo $marker['icon']; ?>'
								<?php }?>
							});																					
																					
						  } else {
							alert('Geocode was not successful for the following reason: ' + status);
						  }
						});
						
				<?php }?>						
				<?php $counter++; ?>				
				<?php }?>		
				
			}
			</script>
<?php }?>