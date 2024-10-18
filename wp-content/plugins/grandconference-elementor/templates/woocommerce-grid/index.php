<div class="woocommerce-grid-container">
<?php
	$widget_id = $this->get_id();
	
	//Get all settings
	$settings = $this->get_settings();
	
	$product_shortcode = '[products';
	
	if(isset($settings['limit']['size']))
	{
		$product_shortcode.= ' limit="'.esc_attr($settings['limit']['size']).'"';
	}
	
	if(isset($settings['columns']['size']))
	{
		$product_shortcode.= ' columns="'.esc_attr($settings['columns']['size']).'"';
	}
	
	if(isset($settings['orderby']))
	{
		$product_shortcode.= ' orderby="'.esc_attr($settings['orderby']).'"';
	}
	
	if(isset($settings['category']) && !empty($settings['category']))
	{
		$product_shortcode.= ' category="'.esc_attr($settings['category']).'"';
	}
	
	if(isset($settings['on_sale']) && $settings['on_sale'] == 'yes')
	{
		$product_shortcode.= ' on_sale="true"';
	}
	
	$product_shortcode.= ']';
	
	echo do_shortcode($product_shortcode);
?>
</div>