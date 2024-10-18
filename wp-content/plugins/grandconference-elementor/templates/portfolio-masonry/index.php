<div class="portfolio-masonry-container">
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
	
	//Random sorting for demo purpose only
	if(GRANDCONFERENCE_THEMEDEMO)
	{
		$args['orderby'] = 'rand';
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
	
	if (have_posts())
	{
		//Get entrance animation option
		$smoove_animation_attr = '';
		switch($settings['entrance_animation'])
		{
			case 'slide-up':
			default:
				$smoove_animation_attr = 'data-move-y="60px"';
				
			break;
			
			case 'popout':
				$smoove_animation_attr = 'data-scale="0"';
				
			break;
			
			case 'fade-in':
				$smoove_animation_attr = 'data-opacity="0"';
				
			break;
		}
		
		$column_class = 1;
		$thumb_image_name = 'medium_large';
		
		//Start displaying gallery columns
		switch($settings['columns']['size'])
		{
			case 1:
		   		$column_class = 'grandconference-one-col';
		   	break;
		   	
			case 2:
		   		$column_class = 'grandconference-two-cols';
		   	break;
		   	
		   	case 3:
		   	default:
		   		$column_class = 'grandconference-three-cols';
		   	break;
		   	
		   	case 4:
		   		$column_class = 'grandconference-four-cols';
		   	break;
		   	
		   	case 5:
		   		$column_class = 'grandconference-five-cols';
		   	break;
		   	
		   	case 6:
		   		$column_class = 'tg_six_cols';
		   	break;
		}
		
		$filterable_class = 'no_filter';
		
		if($settings['filterable'] == 'yes')
		{
			//Get filterable categories
			$filterable_tags = array();
			$portfolio_cats = get_terms('portfolio_cat', 'hide_empty=0&hierarchical=0&parent=0&orderby=title');
			
			if(!isset($settings['filterable_ex_categories']) OR !is_array($settings['filterable_ex_categories']))
			{
				$settings['filterable_ex_categories'] = array();
			}
			
			foreach ( $portfolio_cats as $portfolio_cat ) 
			{
				if (!in_array($portfolio_cat->term_id, $settings['filterable_ex_categories'])) {
					$filterable_tags[] = ltrim($portfolio_cat->slug);
				}
			}
			
			if(!empty($filterable_tags) && $settings['filterable'] == 'yes')
			{
				$filterable_class = 'filterable';
?>
<div class="grandconference-portfolio-filter-wrapper">
		<a class="filter-tag-btn active" href="javascript:;" data-rel="all" data-cols="<?php echo esc_attr($settings['columns']['size']); ?>"><?php echo __( 'All', 'grandconference-elementor' ); ?></a>
	<?php
		foreach ( $filterable_tags as $filterable_tag ) 
		{
	?>
		<a class="filter-tag-btn" href="javascript:;" data-rel="<?php echo grandconference_sanitize_title($filterable_tag); ?>" data-cols="<?php echo esc_attr($settings['columns']['size']); ?>"><?php echo esc_html($filterable_tag); ?></a>
	<?php
		}
	?>
</div>
<?php
			}
		}
?>
<div class="portfolio-masonry-content-wrapper grandconference-gallery-grid-content-wrapper do-masonry masonry-classic portfolio_masonry layout-<?php echo esc_attr($column_class); ?>" data-cols="<?php echo esc_attr($settings['columns']['size']); ?>">
<?php		
		$animation_class = '';
		$smoove_class = 'smoove';
		if(isset($settings['disable_animation']))
		{
			$animation_class = 'disable_'.$settings['disable_animation'];
			
			if($settings['disable_animation'] == 'all')
			{
				$smoove_class = '';
			}
		}
		
		$smoove_min_width = 1;
		switch($settings['disable_animation'])
		{
			case 'none':
				$smoove_min_width = 1;
			break;
			
			case 'tablet':
				$smoove_min_width = 769;
			break;
			
			case 'mobile':
				$smoove_min_width = 415;
			break;
			
			case 'all':
				$smoove_min_width = 5000;
			break;
		}
	
		$last_class = '';
		$count = 1;
		
		while (have_posts()) : the_post();
			$last_class = '';
			if($count%$settings['columns']['size'] == 0)
			{
				$last_class = 'last';
			}
			
			//Calculation for animation queue
			if(!isset($queue))
			{
				$queue = 1;	
			}
			
			if($queue > $settings['columns']['size'])
			{
				$queue = 1;
			}
			
			$portfolio_id = get_the_id();
			$portfolio_title = get_the_title();
			$portfolio_subtitle = get_the_excerpt();
			$image_id = get_post_thumbnail_id($portfolio_id);
			$image_url = wp_get_attachment_image_src($image_id, 'large', true);
			$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			
			//Get custom link
			$portfolio_link = get_post_meta($portfolio_id, 'portfolio_link', true);
			$target = 'target="_blank"';
			
			if(empty($portfolio_link))
			{
				$portfolio_link = get_permalink($portfolio_id);
				$target = '';
			}
			
			//Get portfolio category
			$portfolio_item_cat = '';
			$portfolio_item_cats = wp_get_object_terms($portfolio_id, 'portfolio_cat');
			
			if(is_array($portfolio_item_cats))
			{
				foreach($portfolio_item_cats as $set)
				{
					$portfolio_item_cat.= $set->slug.' ';
				}
			}
?>
		<div class="portfolio-masonry-grid-wrapper gallery-grid-item <?php echo esc_attr($column_class); ?> <?php echo esc_attr($last_class); ?>  portfolio-<?php echo esc_attr($count); ?> tile scale-anm <?php echo esc_attr($portfolio_item_cat); ?> all <?php echo esc_attr($filterable_class); ?> <?php echo esc_attr($smoove_class); ?> <?php echo esc_attr($animation_class); ?>" data-delay="<?php echo intval($queue*150); ?>" data-minwidth="<?php echo esc_attr($smoove_min_width); ?>" <?php echo $smoove_animation_attr; ?>>
			<div class="portfolio_masonry_img">
				<img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($image_alt);?>" />
			</div>

			<div class="figcaption">
				<div class="portfolio-masonry-content">
					<h3><?php echo esc_html($portfolio_title); ?></h3>
					<div class="portfolio_masonry_subtitle"><?php echo esc_html($portfolio_subtitle); ?></div>
					<div class="popup-arrow"><span class="ti-arrow-right"></span></div>
				</div>
			</div>
			<a href="<?php echo esc_url($portfolio_link); ?>" <?php echo esc_attr($target); ?> ></a>
		</div>
<?php
			$count++;
			$queue++;
		endwhile;
?>
<br class="clear"/>
</div>
<?php
	}
?>
</div>