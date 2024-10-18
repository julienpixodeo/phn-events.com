<?php
	$widget_id = $this->get_id();
	$slides = $this->get_settings('slides');
	$count_slides = count($slides);
	
	if(!empty($slides))
	{
		//Get all settings
		$settings = $this->get_settings();
?>
<div class="themegoods-marquee-menu-wrapper">
	<nav class="themegoods-marquee-menu">
		
		<?php		
			$count = 1;
			
			foreach ( $slides as $slide ) 
			{	
				//Get image URL
				if(is_numeric($slide['slide_image']['id']) && !empty($slide['slide_image']['id']))
				{
					if(is_numeric($slide['slide_image']['id']) && (!isset($_GET['elementor_library']) OR empty($_GET['elementor_library'])))
					{
						$image_url = wp_get_attachment_image_src($slide['slide_image']['id'], 'medium_large', true);
					}
					else
					{
						$image_url[0] = $slide['slide_image']['url'];
					}
					
					//Get image meta data
					$image_alt = get_post_meta($slide['slide_image']['id'], '_wp_attachment_image_alt', true);
				}
				else
				{
					$image_url[0] = $slide['slide_image']['url'];
					$image_alt = '';
				}
				
				$target = $slide['slide_link']['is_external'] ? 'target="_blank"' : '';
		?>
		<div class="themegoods-marquee-menu__item">
			<a class="themegoods-marquee-menu__item-link" href="<?php echo esc_url($slide['slide_link']['url']); ?>" <?php echo esc_attr($target); ?>><?php echo esc_html($slide['slide_title']); ?></a>
			
			<img class="themegoods-marquee-menu__item-img" src="<?php echo esc_url($image_url[0]); ?>" alt="<?php echo esc_attr($image_alt); ?>"/>
			
			<div class="themegoods-marquee">
				<div class="themegoods-marquee__inner" aria-hidden="true">
					<span><?php echo esc_html($slide['slide_title']); ?></span>
					<span><?php echo esc_html($slide['slide_title']); ?></span>
					<span><?php echo esc_html($slide['slide_title']); ?></span>
					<span><?php echo esc_html($slide['slide_title']); ?></span>
				</div>
			</div>
		</div>
		<?php
			}
		?>
		
	</nav>
</div>
<?php
	} //If slide is not empty
?>