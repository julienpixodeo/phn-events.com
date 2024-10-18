<?php
	$widget_id = $this->get_id();
	$slides = $this->get_settings('slides');
	$count_slides = count($slides);

	if(!empty($slides))
	{
		//Get all settings
		$settings = $this->get_settings();
?>
<div class="diagonal-slider-wrapper slider">
	<div class="nav">
		<div class="next"></div>
		<div class="prev"></div>
	 </div>
<?php
		$counter = 0;
		
		//Create slide image
		foreach ($slides as $slide)
		{	
			//Get slide images
			$count_slide_img = count($slide['slide_image']);
			$counter++;
?>
		<div class="item <?php if($counter == 1) { ?>is-active<?php } ?>">
			<?php
				if(isset($slide['slide_title']) && !empty($slide['slide_title']))
				{
			?>
				<div class="content">
				  <?php
					  if(!empty($slide['slide_link']['url']))
					  {
						  $target = $slide['slide_link']['is_external'] ? 'target="_blank"' : '';
				  ?>
				  <a class="slide-link" href="<?php echo esc_url($slide['slide_link']['url']); ?>" <?php echo esc_attr($target); ?>></a>
				  <?php
					  }
				  ?>
				  <div class="wrap">
					  <?php echo esc_html($slide['slide_title']); ?>
				  </div>
				</div>
			<?php
				}
				
				if($count_slide_img > 0 && is_array($slide['slide_image']))
				{
			?>
				<div class="imgs">
				  <div class="grid">
					  <?php
					    $count_inner_img = 0;
					  	foreach($slide['slide_image'] as $slide_img)
						{ 
							$count_inner_img++;
					  ?>
					  	<div class="img img-<?php echo esc_attr($count_inner_img); ?>"><img src="<?php echo esc_url($slide_img['url']); ?>"/></div>
					  <?php
				  		}
					  ?>
				  </div>
				</div>
			<?php
				}
			?>
		</div>
<?php
		}
?>
</div>
<?php
	}
?>