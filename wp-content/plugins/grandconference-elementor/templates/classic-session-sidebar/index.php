<?php
	$widget_id = $this->get_id();
	
	//Get all settings
	$settings = $this->get_settings();
?>
<div class="session-sidebar-wrapper" data-widget-id="<?php echo esc_attr($widget_id); ?>" data-expand="<?php echo esc_attr($settings['expand']); ?>">
<?php
	$shortcode = '[ppb_session_filterable_sidebar widget_id="'.esc_attr($widget_id).'" ';
	
	if(isset($settings['filterable']) && !empty($settings['filterable']))
	{
		$filterable = 'yes';
		if($settings['filterable'] != 'yes')
		{
			$filterable = 'no';
		}
		
		$shortcode.= 'filterable="'.$filterable.'" ';
	}
	
	if(isset($settings['sidebar']) && !empty($settings['sidebar']))
	{
		$shortcode.= 'sidebar="'.$settings['sidebar'].'" ';
	}
	
	if(isset($settings['columns']['size']) && !empty($settings['columns']['size']))
	{
		$shortcode.= 'columns="'.$settings['columns']['size'].'" ';
	}
	
	$shortcode.= '][/ppb_session_filterable_sidebar]';
	//echo $shortcode;
	echo do_shortcode($shortcode);
?>
</div>
<br class="clear"/>