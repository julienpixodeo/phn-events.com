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
		//Get spacing class
		$spacing_class = '';
		if($settings['spacing'] != 'yes')
		{
			$spacing_class = 'has-no-space';
		}
		else
		{
			$spacing_class = 'has_space';
		}
		
		//Get lightbox link
		$is_lighbox = false;
		if($settings['lightbox'] == 'yes')
		{
			$is_lighbox = true;
		}
		
		$column_class = 1;
		$thumb_image_name = 'medium_large';
		
		//Start displaying gallery columns
		switch($settings['columns']['size'])
		{
		   	case 1:
		   	default:
		   		$column_class = 'grandconference-one-cols';
		   		$thumb_image_name = 'original';
		   	break;
		   	
		   	case 2:
		   		$column_class = 'grandconference-two-cols';
		   	break;
		   	
		   	case 3:
		   		$column_class = 'grandconference-three-cols';
		   		$thumb_image_name = 'grandconference-gallery-masonry';
		   	break;
		   	
		   	case 4:
		   		$column_class = 'grandconference-four-cols';
		   		$thumb_image_name = 'grandconference-gallery-masonry';
		   	break;
		   	
		   	case 5:
		   		$column_class = 'grandconference-five-cols';
		   		$thumb_image_name = 'grandconference-gallery-masonry';
		   	break;
		   	
		   	case 6:
		   		$column_class = 'tg_six_cols';
		   		$thumb_image_name = 'grandconference-gallery-masonry';
		   	break;
		}
		
		$tg_enable_lazy_loading = get_theme_mod('tg_enable_lazy_loading');
?>
<div class="grandconference-gallery-grid-content-wrapper do-masonry layout-<?php echo esc_attr($column_class); ?> <?php echo esc_attr($spacing_class); ?>" data-cols="<?php echo esc_attr($settings['columns']['size']); ?>">
<?php		
		$animation_class = '';
		$smoove_class = '';
	
		$last_class = '';
		$count = 1;
		
		foreach ( $images as $image ) 
		{
			$last_class = '';
			if($count%$settings['columns']['size'] == 0)
			{
				$last_class = 'last';
			}
			
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
			
			if($queue > $settings['columns']['size'])
			{
				$queue = 1;
			}
?>
		<div class="gallery-grid-item <?php echo esc_attr($column_class); ?> <?php echo esc_attr($last_class); ?> <?php echo esc_attr($smoove_class); ?> <?php echo esc_attr($animation_class); ?>" data-delay="<?php echo intval($queue*150); ?>" data-minwidth="<?php echo esc_attr($smoove_min_width); ?>">
			<?php
				if($is_lighbox)	
				{
			?>
				<a class="grandconference_gallery_lightbox" href="<?php echo esc_url($original_image_url[0]); ?>" data-thumb="<?php echo esc_url($lightbox_thumb_image_url[0]); ?>" data-rel="tg_gallery<?php echo esc_attr($widget_id); ?>" <?php if(!empty($image_title)) { ?>data-title="<?php echo esc_attr($image_title); ?>"<?php } ?> <?php if(!empty($image_desc)) { ?>data-desc="<?php echo esc_attr($image_desc); ?>"<?php } ?>>
			<?php
				}
			?>
				<img src="<?php echo esc_url($thumb_image_url[0]); ?>" class="lazy_masonry" alt="<?php echo esc_attr($image_alt); ?>" />
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
			$count++;
			$queue++;
		}
?>
<br class="clear"/>
</div>
<?php
	}
?>