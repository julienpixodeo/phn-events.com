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
	
	$event_order = 'ASC';
	$event_order_by = 'menu_order';
	switch($settings['order'])
	{
		case 'default':
			$event_order = 'ASC';
			$event_order_by = 'menu_order';
		break;
		
		case 'newest':
			$event_order = 'DESC';
			$event_order_by = 'post_date';
		break;
		
		case 'oldest':
			$event_order = 'ASC';
			$event_order_by = 'post_date';
		break;
		
		case 'title':
			$event_order = 'ASC';
			$event_order_by = 'title';
		break;
		
		case 'random':
			$event_order = 'ASC';
			$event_order_by = 'rand';
		break;
	}
	
	$timer = intval($settings['timer']['size']*1000);

	$widget_id = $this->get_id();
	
	//Get all posts
	$args = array( 
		'posts_per_page' => $settings['posts_per_page']['size'],
		'post_type' => array('tribe_events'),
		'paged' => 1,
		'order' => $event_order,
		'orderby' => $event_order_by,
	);
	
	if(isset($settings['cat']) && !empty($settings['cat']))
	{
		$args['tribe_events_cat'] = $settings['cat'];
	}
	
	query_posts($args);
	
	if (have_posts())
	{
		//Get all settings
		$settings = $this->get_settings();
		$count = 1;
?>
<div class="event-carousel-wrapper">
	<div class="owl-carousel" data-pagination="<?php echo intval($pagination); ?>" data-autoplay="<?php echo intval($autoplay); ?>" data-timer="<?php echo intval($timer); ?>" data-items="<?php echo intval($settings['ini_item']['size']); ?>" data-stage-padding="<?php echo esc_attr($settings['stage_padding']['size']); ?>" data-margin="<?php echo esc_attr($settings['item_margin']['size']); ?>">
<?php
		while (have_posts()) : the_post();
			$post_ID = get_the_ID();
			
			$thumb_image_name = 'grandconference-gallery-grid';
			if(isset($settings['image_dimension']) && !empty($settings['image_dimension']))
			{
				$thumb_image_name = $settings['image_dimension'];
			}
		
			//Get featured image
			$image_thumb = '';
			if(has_post_thumbnail($post_ID, $thumb_image_name))
			{
				$image_id = get_post_thumbnail_id($post_ID);
				$image_thumb = wp_get_attachment_image_src($image_id, $thumb_image_name, true);
			}
			
			$event_link = get_permalink($post_ID);
			$start_datetime = tribe_get_start_date($post_ID);
			$cost = tribe_get_formatted_cost($post_ID);
			$venue = tribe_get_venue($post_ID);
?>
			<div class="item post-wrapper">
				<div class="event-carousel-handle"></div>
				
				<?php
					if(!empty($image_thumb))
					{
				?>
					<div class="post-featured-image static">
						<?php
							$tg_enable_lazy_loading = get_theme_mod('tg_enable_lazy_loading');
						
							$blog_featured_img_url = get_the_post_thumbnail_url($post_ID, $thumb_image_name); 
							$blog_featured_img_data = wp_get_attachment_image_src(get_post_thumbnail_id($post_ID), $thumb_image_name );
						    $blog_featured_img_alt = get_post_meta(get_post_thumbnail_id($post_ID), '_wp_attachment_image_alt', true);
							$return_attr = grandconference_get_lazy_img_attr();
								 
							if(!empty($blog_featured_img_url))
							{
						?>
							<a href="<?php echo $event_link; ?>" title="<?php the_title(); ?>">
								<img <?php echo grandconference_get_blank_img_attr(); ?> <?php echo esc_attr($return_attr['source']); ?>="<?php echo esc_url($blog_featured_img_url); ?>" class="<?php echo esc_attr($return_attr['class']); ?>" alt="<?php echo esc_attr($blog_featured_img_alt); ?>"/>
							</a>
						<?php
							}
						?>
					</div>
				<?php
					}
				?>
					
				<div class="post-header">
					<div class="post-header-title">
						<h5><a href="<?php echo $event_link; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
					</div>
				</div>
			
				<div class="post-header-wrapper">
					<?php
						if(isset($settings['excerpt_length']['size']) && $settings['excerpt_length']['size'] > 0) {
					?>
						<div class="portfolio-classic-description">
							<?php echo grandconference_limit_get_excerpt(esc_html(get_the_excerpt()), $settings['excerpt_length']['size'], '...'); ?>
						</div>
					<?php
						}
					?>
					
					<div class="portfolio-classic-meta">
						<?php
							if(!empty($start_datetime)) 
							{
						?>
							<div class="portfolio-classic-meta-fullwidth">
								<span class="ti-calendar"></span>
								<span class="portfolio-classic-meta-data"><?php echo esc_html($start_datetime); ?></span>
							</div>
						<?php
							}
						?>
						
						<?php
							if(!empty($cost) OR !empty($venue)) 
							{
						?>
							<div class="portfolio-classic-meta-fullwidth">
								<?php
									if(!empty($cost)) 
									{
								?>
									<div class="portfolio-classic-meta-fullwidth-item">
										<span class="ti-ticket"></span><span class="portfolio-classic-meta-data"><strong><?php echo $cost; ?></strong></span>
									</div>
								<?php
									}
									
									if(!empty($venue)) 
									{
								?>
								<div class="portfolio-classic-meta-fullwidth-item">
									<span class="ti-location-pin"></span><span class="portfolio-classic-meta-data"><?php echo $venue; ?></span>
								</div>
								<?php
									}
								?>
							</div>
						<?php
							}
						?>
					</div>
				</div>
			</div>
<?php
		endwhile; 
?>
	</div>
</div>
<?php
	}
	
	wp_reset_query();
?>