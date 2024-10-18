<?php
	$widget_id = $this->get_id();
	
	//Get all settings
	$settings = $this->get_settings();
?>

<div class="pricing-table-container">
<?php
	$slides = $this->get_settings('slides');
	$count_slides = count($slides);
	
	if(!empty($slides))
	{		
		$column_class = 3;
		
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
<div class="pricing-table-content-wrapper layout-<?php echo esc_attr($column_class); ?>" data-cols="<?php echo esc_attr($settings['columns']['size']); ?>">
	
<?php		
		$last_class = '';
		$count = 1;
		
		foreach ( $slides as $slide ) 
		{
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
			
			//Check featured pricing plan
			$featured_pricing_plan = '';
			if(isset($slide['slide_featured']) && $slide['slide_featured'] == 'yes')
			{
				$featured_pricing_plan = 'featured-pricing-plan';
			}
?>
		<div class="pricing-table-wrapper <?php echo esc_attr($column_class); ?> <?php echo esc_attr($last_class); ?>  pricing-<?php echo esc_attr($count); ?> tile scale-anm all <?php echo esc_attr($featured_pricing_plan); ?>">
			<div class="inner-wrap">
				<div class="overflow-inner">
					<div class="pricing-plan-wrap">
						<h2 class="pricing-plan-title"><?php echo esc_html($slide['slide_title']); ?></h2>
						
						<div class="pricing-plan-price-wrap">
							<h3 class="pricing-plan-price" data-price-month="<?php echo esc_attr($slide['slide_price_month']); ?>"><?php echo esc_attr($slide['slide_price_month']); ?></h3>
						</div>
					</div>
					
					<div class="pricing-plan-content">
						<?php 
							if(isset($slide['slide_features']) && !empty($slide['slide_features']))
							{
								$feature_lists = explode(PHP_EOL, $slide['slide_features']);
								
								if(!empty($feature_lists) && is_array($feature_lists))
								{
						?>
								<ul class="pricing-plan-content-list">
						<?php
									foreach($feature_lists as $feature_list)
									{
						?>
									<li><?php echo esc_html($feature_list); ?></li>
						<?php
									}
						?>
								</ul>
						<?php
								}
							}
						?>
						
						<?php 
							if(isset($slide['slide_button_title']) && !empty($slide['slide_button_title']))
							{
						?>
							<a class="pricing-plan-button button" href="<?php echo esc_url($slide['slide_button_link']['url']); ?>"><?php echo esc_html($slide['slide_button_title']); ?></a>
						<?php
							}
						?>
					</div>
				</div>
			</div>
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
</div>