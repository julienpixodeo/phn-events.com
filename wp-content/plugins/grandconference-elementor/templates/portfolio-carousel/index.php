<?php
	//Get all settings
	$settings = $this->get_settings();
	
	$autoplay = 0;
	if($settings['autoplay'] == 'yes')
	{
		$autoplay = 1;
	}
	
	$pagination = 0;
	if($settings['pagination'] == 'yes')
	{
		$pagination = 1;
	}
	
	$timer = intval($settings['timer']['size']*1000);
	
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
	
	$thumb_image_name = 'grandconference-gallery-grid';
	if(isset($settings['image_dimension']) && !empty($settings['image_dimension']))
	{
		//If display original dimension and less initial items then display higher resolution image
		if($settings['image_dimension'] == 'medium_large' && $settings['ini_item']['size'] < 3)
		{
			$settings['image_dimension'] = 'large';
		}
		
		$thumb_image_name = $settings['image_dimension'];
	}

?>
<div class="portfolio-carousel-wrapper">
	<div class="owl-carousel" data-pagination="<?php echo intval($pagination); ?>" data-autoplay="<?php echo intval($autoplay); ?>" data-timer="<?php echo intval($timer); ?>" data-items="<?php echo intval($settings['ini_item']['size']); ?>" data-stage-padding="<?php echo esc_attr($settings['stage_padding']['size']); ?>" data-margin="<?php echo esc_attr($settings['item_margin']['size']); ?>">
<?php
		if (have_posts()) : while (have_posts()) : the_post();
			$portfolio_id = get_the_id();
			$portfolio_title = get_the_title();
			$portfolio_subtitle = get_the_excerpt();
			$image_id = get_post_thumbnail_id($portfolio_id);
			$image_url = wp_get_attachment_image_src($image_id, $thumb_image_name, true);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
?>
			<div class="item">
				<?php
					//Display featured image
					if(isset($image_url[0]) && !empty($image_url[0]))
					{
				?>
					<div class="portfolio-carousel-image">
						<img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($image_alt);?>" />
					</div>
				<?php
					}
				?>
					
				<?php
					//Display title and excerpt
					if(!empty($portfolio_title))
					{
				?>
					<div class="portfolio-carousel-content">
						<div class="overflow-inner">
							<div class="overflow-text">
								<h3 class="portfolio-carousel-title"><?php echo esc_html($portfolio_title); ?></h3>
								<div class="portfolio-carousel-subtitle"><?php echo esc_html($portfolio_subtitle); ?></div>
							</div>
						</div>
					</div>
				<?php
					}
				?>
				
				<?php
					//Get custom link
					$portfolio_link = get_post_meta($portfolio_id, 'portfolio_link', true);
					$target = 'target="_blank"';
					
					if(empty($portfolio_link))
					{
						$portfolio_link = get_permalink($portfolio_id);
						$target = '';
					}
				?>
					<a href="<?php echo esc_url($portfolio_link); ?>" <?php echo esc_attr($target); ?> ></a>
			</div>
<?php
		endwhile; endif;
		
		wp_reset_query();
?>
	</div>
</div>