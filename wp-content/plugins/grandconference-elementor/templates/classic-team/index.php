<?php
	$widget_id = $this->get_id();
?>
<div class="team-classic-wrapper">
<?php
	//Get all settings
	$settings = $this->get_settings();
	
	$shortcode = '[ppb_team_column widget_id="'.esc_attr($widget_id).'" ';
	
	if(isset($settings['cat']) && !empty($settings['cat']))
	{
		$shortcode.= 'cat="'.$settings['cat'].'" ';
	}
	
	if(isset($settings['columns']['size']) && !empty($settings['columns']['size']))
	{
		$shortcode.= 'columns="'.$settings['columns']['size'].'" ';
	}
	
	if(isset($settings['items']['size']) && !empty($settings['items']['size']))
	{
		$shortcode.= 'items="'.$settings['items']['size'].'" ';
	}
	
	if(isset($settings['order']) && !empty($settings['order']))
	{
		$shortcode.= 'order="'.$settings['order'].'" ';
	}
	
	$shortcode.= '][/ppb_team_column]';
	//echo $shortcode;
	echo do_shortcode($shortcode);
?>
</div>
<br class="clear"/>