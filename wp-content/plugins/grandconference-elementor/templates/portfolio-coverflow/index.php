<?php
	//Get all settings
	$settings = $this->get_settings();
	
	//Get portfolio items
	$widget_id = $this->get_id();
	
	$args = array( 
		'post_type' => 'portfolios',
		'posts_per_page' => $settings['items']['size'],
		'orderby' => 'menu_order',
		'order' => 'ASC',
	);
	
	switch($settings['sort_by'])
	{
		case 'menu_order':
		default:
			$args['orderby'] = 'menu_order';
		break;
		
		case 'title':
			$args['orderby'] = 'post_title';
		break;
		
		case 'newest':
			$args['orderby'] = 'date';
			$args['order'] = 'DESC';
		break;
		
		case 'oldest':
			$args['orderby'] = 'date';
			$args['order'] = 'ASC';
		break;
	}

	//Check if filter category is valid
	$is_tax_query_valid = false;
	if(isset($settings['categories'][0]) && !empty($settings['categories'][0]))
	{
		$categories_obj = get_term_by('id', $settings['categories'][0], 'portfolio_cat');
		
		if(!empty($categories_obj))
		{
			$is_tax_query_valid = true;
		}
	}
	else
	{
		$is_tax_query_valid = true;
	}
	
	if(isset($settings['categories']) && !empty($settings['categories']) && $is_tax_query_valid)
	{
		$args['tax_query'] = array( 
			array( 
				'taxonomy' => 'portfolio_cat', //or tag or custom taxonomy
				'field' => 'id', 
				'terms' => $settings['categories']
			) 
		);
	}
	
	query_posts($args);
?>
<div class="swiper-container portfolio-coverflow" data-initial="<?php echo esc_attr($settings['initial_slide']['size']); ?>">
<?php
	if (have_posts())
	{		
		$thumb_image_name = 'grandconference-gallery-grid';
?>
<div class="swiper-wrapper">
<?php		
		$last_class = '';
		$count = 0;
		
		while (have_posts()) : the_post();
			$portfolio_id = get_the_id();
			$portfolio_title = get_the_title();
			$portfolio_subtitle = get_the_excerpt();
			$image_id = get_post_thumbnail_id($portfolio_id);
			$image_url = wp_get_attachment_image_src($image_id, $thumb_image_name, true);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			
			//Get custom link
			$portfolio_link = get_post_meta($portfolio_id, 'portfolio_link', true);
			$target = 1;
			
			if(empty($portfolio_link))
			{
				$portfolio_link = get_permalink($portfolio_id);
				$target = 0;
			}
?>
		<div class="swiper-slide" data-id="<?php echo esc_attr($count); ?>">
			<div class='swiper-content'>
				<div class="article">
					<div class='article-preview'>
						<div class="controls">
							<label class="lbl-btn-reset" data-audio="audio_<?php echo esc_attr($portfolio_id); ?>" data-link="<?php echo esc_url($portfolio_link); ?>" data-external="<?php echo esc_attr($target); ?>"><span>
								<?php echo esc_html($settings['link_label']); ?>
							</span></label>
						</div>
				  	</div>
				  	<div class='article-thumbnail' style='background-image: url(<?php echo esc_url($image_url[0]); ?>)'>
				    <h2>
				      <span><?php echo esc_html($portfolio_subtitle); ?></span>
				      <?php echo esc_html($portfolio_title); ?>
				    </h2>
				  </div>
				</div>
			</div>
		</div>
<?php
			$count++;
		endwhile;
?>
</div>
<?php
	}
?>
<div class="swiper-pagination"></div>
</div>