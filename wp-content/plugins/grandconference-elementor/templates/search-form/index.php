<?php
	$widget_id = $this->get_id();
	
	//Get all settings
	$settings = $this->get_settings();
	
	$redirect_to_page = get_site_url();
	if(isset($settings['action']) && !empty($settings['action']) && $settings['search_event']=='yes')
	{
		$redirect_to_page = get_permalink($settings['action']);
	}
	
	$keyword = '';
	if(isset($_GET['s']))
	{
		$keyword = $_GET['s'];
	}
?>
<div class="tg-search-wrapper"> 	
	<form id="tg-search-form-<?php echo esc_attr($widget_id); ?>" class="tg-search-form <?php if($settings['autocomplete'] == 'yes') { ?>autocomplete-form<?php } ?>" method="get" action="<?php echo esc_url($redirect_to_page); ?>" data-result="autocomplete-<?php echo esc_attr($widget_id); ?>" data-autocomplete-event="<?php echo esc_attr($settings['search_event']); ?>">
		<div class="input-group">
			<input name="s" placeholder="<?php echo esc_attr($settings['placeholder']); ?>" autocomplete="off" value="<?php echo esc_attr($keyword); ?>"/>
			<?php
				if($settings['autocomplete'] == 'yes')
				{
			?>
				<div id="autocomplete-<?php echo esc_attr($widget_id); ?>" class="autocomplete" data-mousedown="false"></div>
		    <?php
			    }
			    
			    if (function_exists('icl_object_id')) {
			?>
			    <input id="lang" name="lang" type="hidden" value="<?php echo esc_attr(ICL_LANGUAGE_CODE); ?>"/>
			<?php
				}
			?>
			<span class="input-group-button">
				<button aria-label="<?php echo esc_attr($settings['placeholder']); ?>" type="submit"><i class="fas fa-search"></i></button>
			</span>
		</div>
	</form>
</div>