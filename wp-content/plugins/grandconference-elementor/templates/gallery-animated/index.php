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
		$thumb_image_name = 'grandconference-gallery-grid';
		if(isset($settings['image_dimension']) && !empty($settings['image_dimension']))
		{
			$thumb_image_name = $settings['image_dimension'];
		}
?>
<div class="grandconference-gallery-animated-content-wrapper <?php echo esc_attr($thumb_image_name); ?> ri-grid ri-grid-size-2 ri-shadow" data-rows="<?php echo esc_attr($settings['rows']['size']); ?>" data-columns="<?php echo esc_attr($settings['columns']['size']); ?>" data-animation="<?php echo esc_attr($settings['animation_type']); ?>" data-animation-speed="<?php echo esc_attr($settings['animation_speed']['size']); ?>" data-interval="<?php echo esc_attr($settings['interval_time']['size']); ?>">
	<ul>
	<?php				
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

			if(is_numeric($image_id) && (!isset($_GET['elementor_library']) OR empty($_GET['elementor_library'])))
			{
				$thumb_image_url = wp_get_attachment_image_src($image_id, $thumb_image_name, true);
				$lightbox_thumb_image_url = wp_get_attachment_image_src($image_id, 'medium', true);
				
				//Get image meta data
		        $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			}
			else
			{
				$thumb_image_url[0] = $image['url'];
				$lightbox_thumb_image_url[0] = $image['url']; 
			}
?>
		<li>
			<a class="grandconference_gallery_lightbox" href="<?php echo esc_url($thumb_image_url[0]); ?>">
				<img src="<?php echo esc_url($thumb_image_url[0]); ?>" alt="<?php echo esc_attr($image_alt); ?>" />
			</a>
		</li>
	<?php
		}
	?>
	</ul>
</div>
<?php
	}
?>