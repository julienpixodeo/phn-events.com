<div class="portfolio-classic-container contain grandconference-team-grid">
<?php
	$widget_id = $this->get_id();
	
	//Get all settings
	$settings = $this->get_settings();
	
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
		//Get spacing class
		$spacing_class = '';
		if($settings['spacing'] != 'yes')
		{
			$spacing_class = 'has-no-space';
		}
		
		$column_class = 1;
		$thumb_image_name = 'grandconference-album-grid';
		if(isset($settings['image_dimension']) && !empty($settings['image_dimension']))
		{
			$thumb_image_name = $settings['image_dimension'];
		}
		
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
?>
<div class="portfolio-classic-content-wrapper portfolio-classic layout-<?php echo esc_attr($column_class); ?> <?php echo esc_attr($spacing_class); ?>" data-cols="<?php echo esc_attr($settings['columns']['size']); ?>">
<?php		
		$animation_class = '';
		$smoove_min_width = 1;
	
		$last_class = '';
		$count = 1;
		
		foreach ( $slides as $key => $slide ) 
		{
			$member_ID = $slide->ID;
			
			$last_class = '';
			if($count%$settings['columns']['size'] == 0)
			{
				$last_class = 'last';
			}
			
			//Get customer picture
			if(has_post_thumbnail($member_ID, 'thumbnail'))
			{
				$image_id = get_post_thumbnail_id($member_ID);
				$image_url = wp_get_attachment_image_src($image_id, $thumb_image_name, true);
				
				//Get image meta data
				$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
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
			
			$team_position = get_post_meta($member_ID, 'team_position', true);
?>
		<div class="portfolio-classic-grid-wrapper <?php echo esc_attr($column_class); ?> <?php echo esc_attr($last_class); ?>  portfolio-<?php echo esc_attr($count); ?> tile scale-anm all smoove <?php echo esc_attr($animation_class); ?>" data-delay="<?php echo intval($queue*150); ?>" data-minwidth="<?php echo esc_attr($smoove_min_width); ?>" data-move-y="45px">
			<div class="portfolio-classic-img grid_tilt">
				<img src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($image_alt);?>" />
			</div>
			<br class="clear"/>
			<div class="portfolio-classic-content">
				<div class="portfolio-classic-subtitle"><?php echo esc_html($team_position); ?></div>
				<h3 class="portfolio-classic_title"><?php echo esc_html($slide->post_title); ?></h3>
				
				<div class="portfolio-classic-description"><?php echo esc_html($slide->post_content); ?></div>
			</div>
		</div>
<?php
			$count++;
			$queue++;
		}
?>
<?php
	if($settings['spacing'] == 'yes')
	{
?>
<br class="clear"/>
<?php
	}
?>
</div>
<?php
	}
?>
</div>