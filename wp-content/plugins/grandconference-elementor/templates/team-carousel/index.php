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

	$widget_id = $this->get_id();
	
	//Get all team contents
	$team_order = 'ASC';
	$team_order_by = 'menu_order';
	switch($settings['order'])
	{
		case 'default':
			$team_order = 'ASC';
			$team_order_by = 'menu_order';
		break;
		
		case 'newest':
			$team_order = 'DESC';
			$team_order_by = 'post_date';
		break;
		
		case 'oldest':
			$team_order = 'ASC';
			$team_order_by = 'post_date';
		break;
		
		case 'title':
			$team_order = 'ASC';
			$team_order_by = 'title';
		break;
		
		case 'random':
			$team_order = 'ASC';
			$team_order_by = 'rand';
		break;
	}
	
	//Get team items
	$args = array(
		'order' => $team_order,
		'orderby' => $team_order_by,
		'post_type' => array('team'),
	);
	
	if(isset($settings['cat']) && !empty($settings['cat']))
	{
		$args['teamcats'] = $settings['cat'];
	}
	
	if(isset($settings['items']['size']) && !empty($settings['items']['size']))
	{
		$args['numberposts'] = $settings['items']['size'];
	}
	
	$slides = get_posts($args);
	$count_slides = count($slides);
	
	if(!empty($slides))
	{
		//Get all settings
		$settings = $this->get_settings();
		$count = 1;
?>
<div class="team-carousel-wrapper <?php echo esc_attr($settings['grid_style']); ?>">
	<div class="owl-carousel" data-pagination="<?php echo intval($pagination); ?>" data-autoplay="<?php echo intval($autoplay); ?>" data-timer="<?php echo intval($timer); ?>" data-items="<?php echo intval($settings['ini_item']['size']); ?>" data-stage-padding="<?php echo esc_attr($settings['stage_padding']['size']); ?>" data-margin="<?php echo esc_attr($settings['item_margin']['size']); ?>">
<?php
		foreach ( $slides as $slide ) 
		{
			$member_ID = $slide->ID;
			$team_position = get_post_meta($member_ID, 'team_position', true);
			
			//Get customer picture
			if(has_post_thumbnail($member_ID, 'thumbnail'))
			{
				$image_id = get_post_thumbnail_id($member_ID);
				$image_url = wp_get_attachment_image_src($image_id, $thumb_image_name, true);
				
				//Get image meta data
				$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
			}
?>
			<div class="item">
				<div class="team-carousel-handle"></div>
				
				<?php 
				//Check design layout style
				switch($settings['grid_style'])
				{
					case 'style1':
					default:
				?>
				
				<?php
					//Display featured image
					if(isset($image_url[0]) && !empty($image_url[0]))
					{
				?>
					<div class="team-carousel-image">
						<div class="team-carousel-image-overflow">
							<img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($image_alt);?>" />
						</div>
					</div>
				<?php
					}
				?>
					
				<?php
					//Display title and excerpt
					if(!empty($slide->post_title))
					{
				?>
					<div class="team-carousel-content">
						<div class="overflow-inner">
							<div class="overflow-text">
								<h3 class="team-carousel-title"><?php echo esc_html($slide->post_title); ?></h3>
								<div class="team-carousel-subtitle"><?php echo esc_html($team_position); ?></div>
								<div class="team-carousel-desc"><?php echo htmlspecialchars_decode($slide->post_content); ?></div>
							</div>
						</div>
					</div>
				<?php
					}
					
					break;
					
					case 'style2':
				?>
						<?php
							if(isset($image_url[0]) && !empty($image_url[0]))
							{
						?>
							<div class="item-bg" style="background-image:url(<?php echo esc_url($image_url[0]); ?>);"></div>
						<?php 
							}
						?>
						
							<div class="item-content">
								<div class="team-carousel-subtitle"><?php echo esc_html($team_position); ?></div>
								
								<h3 class="team-carousel-title"><?php echo esc_html($slide->post_title); ?></h3>
									
								<div class="team-carousel-desc"><?php echo htmlspecialchars_decode($slide->post_content); ?></div>
							</div>
				<?php
					break;
				}
				?>
			</div>
<?php
		}	//End foreach	 
?>
	</div>
</div>
<?php
	}
?>