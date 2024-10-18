<?php
	global $post;
	$widget_id = $this->get_id();
	
	//Get all settings
	$settings = $this->get_settings();
	
	//Get selected gallery
	if($settings['gallery_content_type'] == 'gallery_post')
	{
		$images = grandconference_get_gallery_images($settings['gallery_id'], $settings['sort']);
	}
	else
	{
		$images = $this->get_settings('gallery');
	}
	
	//Get default gallery ID for single gallery page
	if(is_single() && $post->post_type == 'galleries' && empty($images))
	{
		$images = grandconference_get_gallery_images($post->ID, 'drag');
	}
	
	if(!empty($images))
	{
		$timer_arr = $this->get_settings('timer');
		$timer = intval($timer_arr['size']) * 1000;
		
		if($settings['autoplay'] != 'yes')
		{
			$timer = 0;
		}
		
		$loop = 0;
		if($settings['loop'] == 'yes')
		{
			$loop = 1;
		}
		
		$navigation = 0;
		if($settings['navigation'] == 'yes')
		{
			$navigation = 1;
		}
		
		$pagination = 0;
		if($settings['pagination'] == 'yes')
		{
			$pagination = 1;
		}
		
		$parallax = 0;
		if($settings['parallax'] == 'yes')
		{
			$parallax = 1;
		}
		
		$fullscreen = 0;
		if($settings['fullscreen'] == 'yes')
		{
			$fullscreen = 1;
		}
?>
<div id="horizontal-gallery-<?php echo esc_attr($widget_id); ?>" class="horizontal-gallery-wrapper" data-autoplay="<?php echo intval($timer); ?>" data-loop="<?php echo intval($loop); ?>" data-navigation="<?php echo intval($navigation); ?>" data-pagination="<?php echo intval($pagination); ?>" data-parallax="<?php echo intval($parallax); ?>" data-fullscreen="<?php echo intval($fullscreen); ?>">
<?php
		$counter = 0;
	
		foreach ( $images as $image ) 
		{	
			//Get image ID
			if(isset($image['id']) && !empty($image['id']))
			{
				$image_id = $image['id'];
			}
			else if(isset($image['url']) && !empty($image['url']))
			{
				$image_id = grandconference_get_image_id($image['url']);
			}
			else
			{
				$image_id = $image;
			}
			
			$image_url = wp_get_attachment_image_src($image_id, $settings['image_size'], true);
			
			$themegoods_link_url = get_post_meta($image_id, 'grandconference_purchase_url', true);
?>
		<div class="horizontal-gallery-cell" style="margin-right:<?php echo intval($settings['spacing']['size']).$settings['spacing']['unit']; ?>">
			<?php
				if(!empty($themegoods_link_url)) 
				{
			?>
			<a href="<?php echo esc_url($themegoods_link_url); ?>" target="_blank">
			<?php
				}
			?>
			<img class="horizontal-gallery-cell-img" data-flickity-lazyload="<?php echo esc_url($image_url[0]); ?>" alt="" style="height:<?php echo intval($settings['height']['size']).$settings['height']['unit']; ?>;" />
			<?php
				if(!empty($themegoods_link_url)) 
				{
			?>
			</a>
			<?php
				}
			?>
		</div>
<?php
			$counter++;
		}
?>
</div>
<?php
	}
?>