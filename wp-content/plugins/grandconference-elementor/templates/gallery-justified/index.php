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
		//Get all settings
		$settings = $this->get_settings();
		
		//Get lightbox link
		$is_lighbox = false;
		if($settings['lightbox'] == 'yes')
		{
			$is_lighbox = true;
		}
		
		$thumb_image_name = 'medium_large';
		
		$animation_class = '';
		$smoove_class = 'smoove';
?>
<div class="grandconference-gallery-grid-content-wrapper do-justified justified-gallery" data-row_height="<?php echo esc_attr($settings['row_height']['size']); ?>" data-margin="<?php echo esc_attr($settings['margin']['size']); ?>" data-justify_last_row="<?php echo esc_attr($settings['justify_last_row']); ?>">
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
				$original_image_url = wp_get_attachment_image_src($image_id, 'original', true);
				
				//Get image meta data
				$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
				
				//Get lightbox content
				$image_title = '';
				$image_desc = '';
				switch($settings['lightbox_content'])
				{
					case 'title':
						$image_title = get_the_title($image_id);
					break;
					
					case 'title_caption':
						$image_title = get_the_title($image_id);
						$image_desc = get_post_field('post_excerpt', $image_id);
					break;
				}
			}
			else
			{
				$thumb_image_url[0] = $image['url'];
				$lightbox_thumb_image_url[0] = $image['url'];
				$original_image_url[0] = $image['url'];
				$image_alt = '';
				$image_title = '';
				$image_desc = '';
			}
			
			$return_attr = grandconference_get_lazy_img_attr();
			
			//Calculation for animation queue
			if(!isset($queue))
			{
				$queue = 1;	
			}
			
			if($queue > 5)
			{
				$queue = 1;
			}
?>
		<div class="entry gallery-grid-item <?php echo esc_attr($smoove_class); ?>" data-delay="<?php echo intval($queue*150); ?>">
			<?php
				if($is_lighbox)	
				{
			?>
				<a class="grandconference_gallery_lightbox" href="<?php echo esc_url($original_image_url[0]); ?>" data-thumb="<?php echo esc_url($lightbox_thumb_image_url[0]); ?>" data-rel="tg_gallery<?php echo esc_attr($widget_id); ?>" <?php if(!empty($image_title)) { ?>data-title="<?php echo esc_attr($image_title); ?>"<?php } ?> <?php if(!empty($image_desc)) { ?>data-desc="<?php echo esc_attr($image_desc); ?>"<?php } ?>>
			<?php
				}
			?>
				<img src="<?php echo esc_url($thumb_image_url[0]); ?>" class="<?php echo esc_attr($return_attr['class']); ?>" alt="<?php echo esc_attr($image_alt); ?>" />
			<?php
				if($settings['show_title'] == 'yes')
				{
					if(empty($image_title))
					{
						$image_title = get_the_title($image_id);
					}
			?>		
				<div class="bg-overlay"></div>
				<div class="gallery-grid-title"><?php echo esc_html($image_title); ?></div>
			<?php
				}
				
				if($is_lighbox)	
				{
			?>
				</a>
			<?php
				}
			?>
		</div>
<?php
			$queue++;
		}
?>
<br class="clear"/>
</div>
<?php
	}
?>