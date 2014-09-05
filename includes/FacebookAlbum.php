<?php
require_once '__.php';

class FacebookAlbum{
	//                          __              __      
	//   _________  ____  _____/ /_____ _____  / /______
	//  / ___/ __ \/ __ \/ ___/ __/ __ `/ __ \/ __/ ___/
	// / /__/ /_/ / / / (__  ) /_/ /_/ / / / / /_(__  ) 
	// \___/\____/_/ /_/____/\__/\__,_/_/ /_/\__/____/  
	const ALBUM_URL = 'https://graph.facebook.com/%s/photos?limit=20&fields=images'; 
	const ALBUM_ID  = 666; // HA - HA :-)                                                

	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct()
	{

		$ccollection_twitter = new Controls\ControlsCollection(
			array(		
				new Controls\Text('Album id', array('default-value' => '158628314237'), array('placeholder' => 'Enter public page album id')),
			)
		);

		$section_twitter = new Admin\Section('Facebook', array('prefix' => 'fb_'), $ccollection_twitter);
		$theme_settings  = new Admin\Page('Gallery settings', array(), array($section_twitter));

		add_shortcode('facebook_album', array(&$this, 'getHTML'));
	}	                                             

	/**
	 * Get gallery HTML code
	 * @param  array $atributes --- short code attributes
	 * @param  string $content  --- short code content
	 */
	public function getHTML($atributes, $content = '')
	{
		$images = array();
		$std    = $this->getImages($content);

		if($std AND is_array($std->data))
		{
			foreach ($std->data as $obj_img) 
			{
				$images[] = $this->wrapImage($obj_img);
			}
			return $this->wrapGallery($images);
		}

		return '';
	}

	private function wrapGallery($images)
	{
		ob_start();
		?>
		<div class="gg_gallery_wrap gg_standard_gallery gid_174" id="54095ffa8c758">
			<div class="gg_container" style="max-height: none; width: 0px; margin-left: 40px;">
				<?php echo implode('', $images); ?>
			</div>
			<div style="clear: both;"></div>
		</div>
		<?php
		$var = ob_get_contents();
		ob_end_clean();
		return $var;
	}

	/**
	 * Wrap single image object to HTML code
	 * @param  stdClass $obj --- image object
	 * @return string        --- HTML code
	 */
	private function wrapImage($obj)
	{
		$sorted = $this->sortImagesBySize($obj->images);
		$max    = $this->getMax($sorted);
		$min    = $this->getMin($sorted);

		if(!$sorted) return '';
		ob_start();
		?>
		<div style="width: 125px; height: 94px; opacity: 1;" rel="<?php echo self::ALBUM_ID; ?>" gg-descr="" gg-author="" class="gg_img  54095ffa8c758-0" gg-title="University-suites 20" gg-url="<?php echo $max->source; ?>">
			<div class="gg_img_inner">
				<div class="gg_main_img_wrap">
					<img class="gg_photo gg_main_thumb" alt="University-suites 20" id="<?php echo self::ALBUM_ID; ?>-<?php echo $max->source; ?>" src="<?php echo $min->source; ?>"></div>
				<div class="gg_overlays"></div>
			</div>
		</div>
		<?php
		$var = ob_get_contents();
		ob_end_clean();
		return $var;
	}

	/**
	 * Sort images by size ( width + height )
	 * @param  array $images --- image objects
	 * @return mixed         --- array if succes | false if not
	 */
	private function sortImagesBySize($images)
	{
		$sorted = array();
		if(is_array($images))
		{
			foreach ($images as $obj) 
			{
				$size = $obj->width + $obj->height;
				$sorted[$size] = $obj;
			}
			ksort($sorted);
			return $sorted;
		}
		return false;
	}

	/**
	 * Get the most big picture
	 * @param  array $images --- image objects array
	 * @return stdClass      --- most big picture
	 */
	private function getMax($images)
	{
		if(is_array($images))
		{
			return end($images);
		}
		return false;
	}

	/**
	 * Get the most small picture
	 * @param  array $images --- image objects array
	 * @return stdClass      --- most small picture
	 */
	private function getMin($images)
	{
		if(is_array($images))
		{
			return reset($images);
		}
		return false;
	}

	/**
	 * Get images from facebook album
	 * @param  string $album_id --- Publiс page album id
	 * @return stdClass         --- facebook album images
	 */
	public function getImages($album_id)
	{
		$json = file_get_contents(sprintf(self::ALBUM_URL, $album_id));
		$json = json_decode($json);
		if(!($json instanceof stdClass)) return false;
		return $json;
	}
}