<div class="portfolio-classic-container grandconference-event-grid">
<?php
	$widget_id = $this->get_id();
	
	//Get all settings
	$settings = $this->get_settings();
	
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
	
	//Get team items
	$args = array(
		'order' => $event_order,
		'orderby' => $event_order_by,
		'post_type' => array('tribe_events'),
	);
	
	if(isset($settings['cat']) && !empty($settings['cat']))
	{
		$args['tribe_events_cat'] = $settings['cat'];
	}
	
	//If filter for search form
	if(isset($_GET['keyword']) && !empty($_GET['keyword']))
	{
		$args['s'] = $_GET['keyword'];
	}
	if(isset($_GET['s']) && !empty($_GET['s']))
	{
		$args['s'] = $_GET['s'];
	}
	if(isset($_GET['cat']) && !empty($_GET['cat']))
	{
		$args['tribe_events_cat'] = $_GET['cat'];
	}
	if(isset($_GET['location']) && !empty($_GET['location']))
	{
		$args['meta_query'][] = array(
			'key' => '_EventVenueID',
			'value' => $_GET['location'],
			'compare' => '='
		);
	}
	if(isset($_GET['start_date']) && !empty($_GET['start_date']))
	{
		$args['meta_query'][] = array(
			'key' => '_EventStartDateUTC',
			'value' => $_GET['start_date'],
			'compare' => '>=',
			'type' => 'DATE',
		);
	}
	
	if(isset($settings['items']['size']) && !empty($settings['items']['size']))
	{
		$args['numberposts'] = $settings['items']['size'];
	}
	
	$slides = get_posts($args);
	
	$count_slides = count($slides);
	
	if(!empty($slides))
	{	
		$column_class = 3;
		$thumb_image_name = 'grandconference-album-grid';
		if(isset($settings['image_dimension']) && !empty($settings['image_dimension']))
		{
			$thumb_image_name = $settings['image_dimension'];
		}
		
		//Start displaying gallery columns
		switch($settings['columns']['size'])
		{
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
		}
?>
<div class="portfolio-classic-content-wrapper portfolio-classic layout-<?php echo esc_attr($column_class); ?>" data-cols="<?php echo esc_attr($settings['columns']['size']); ?>">
<?php		
		$animation_class = '';
		$smoove_min_width = 1;
	
		$last_class = '';
		$count = 1;
		
		foreach ( $slides as $key => $slide ) 
		{
			$event_ID = $slide->ID;
			
			$last_class = '';
			if($count%$settings['columns']['size'] == 0)
			{
				$last_class = 'last';
			}
			
			//Get customer picture
			if(has_post_thumbnail($event_ID, 'thumbnail'))
			{
				$image_id = get_post_thumbnail_id($event_ID);
				$image_url = wp_get_attachment_image_src($image_id, $thumb_image_name, true);
				
				//Get image meta data
				$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			}
			
			$event_link = get_permalink($event_ID);
			$start_datetime = tribe_get_start_date($event_ID);
			$cost = tribe_get_formatted_cost($event_ID);
			$venue = tribe_get_venue($event_ID);
?>
		<div class="portfolio-classic-grid-wrapper <?php echo esc_attr($column_class); ?> <?php echo esc_attr($last_class); ?>  portfolio-<?php echo esc_attr($count); ?> tile scale-anm all">
			<div class="portfolio-classic-img">
				<a href="<?php echo esc_url($event_link); ?>"></a>
				<img class="static-hover-img" src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($image_alt);?>" />
			</div>
			<br class="clear"/>
			<div class="portfolio-classic-content">
				<h3 class="portfolio-classic_title">
					<a href="<?php echo esc_url($event_link); ?>">
						<?php echo esc_html($slide->post_title); ?>
					</a>
				</h3>
				
				<?php
					if(isset($settings['excerpt_length']['size']) && $settings['excerpt_length']['size'] > 0) {
				?>
					<div class="portfolio-classic-description">
						<?php echo grandconference_limit_get_excerpt(esc_html($slide->post_excerpt), $settings['excerpt_length']['size'], '...'); ?>
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
			$count++;
		}
?>

<br class="clear"/>

</div>
<?php
	}
	else {
?>
	<div class="search-no-results"><?php esc_html_e('No events found matching the keyword.', 'grandtour-translation' ); ?></div>
<?php
	}
?>
</div>