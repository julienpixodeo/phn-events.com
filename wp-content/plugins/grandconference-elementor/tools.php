<?php

if(!function_exists('grandconference_get_gallery_images'))
{
	function grandconference_get_gallery_images($gallery_id = '', $sorting = 'drag') {
		//Get selected gallery
		$images = array();
		
		if(!empty($gallery_id))
		{
			$images = get_post_meta($gallery_id, 'wpsimplegallery_gallery', true);
			
			//Re sort images
			$images = grandconference_resort_gallery_img($images, $sorting);
		}
		
		return $images;
	}
}

if(!function_exists('grandconference_resort_gallery_img'))
{
	function grandconference_resort_gallery_img($all_photo_arr, $sorting = 'drag')
	{
		$sorted_all_photo_arr = array();
	
		if(!empty($sorting) && !empty($all_photo_arr))
		{
			switch($sorting)
			{
				case 'drag':
				default:
					foreach($all_photo_arr as $key => $gallery_img)
					{
						$sorted_all_photo_arr[$key] = $gallery_img;
					}
				break;
				case 'post_date':
					foreach($all_photo_arr as $key => $gallery_img)
					{
						$gallery_img_meta = get_post($gallery_img);
						$gallery_img_date = strtotime($gallery_img_meta->post_date);
						
						$sorted_all_photo_arr[$gallery_img_date] = $gallery_img;
						krsort($sorted_all_photo_arr);
					}
				break;
				
				case 'post_date_old':
					foreach($all_photo_arr as $key => $gallery_img)
					{
						$gallery_img_meta = get_post($gallery_img);
						$gallery_img_date = strtotime($gallery_img_meta->post_date);
						
						$sorted_all_photo_arr[$gallery_img_date] = $gallery_img;
						ksort($sorted_all_photo_arr);
					}
				break;
				
				case 'rand':
					shuffle($all_photo_arr);
					$sorted_all_photo_arr = $all_photo_arr;
				break;
				
				case 'title':
					foreach($all_photo_arr as $key => $gallery_img)
					{
						$gallery_img_meta = get_post($gallery_img);
						$gallery_img_title = $gallery_img_meta->post_title;
						
						$sorted_all_photo_arr[$gallery_img_title] = $gallery_img;
						ksort($sorted_all_photo_arr);
					}
				break;
			}
			
			return $sorted_all_photo_arr;
		}
		else
		{
			return array();
		}
	}
}

if(!function_exists('grandconference_get_course_price_html') && function_exists('learn_press_get_course'))
{	
	function grandconference_get_course_price_html($course_id = '')
	{
		$price_html = '';
		if(!empty($course_id))
		{
			$course = learn_press_get_course($course_id);
			$price_html = $course->get_price_html();
		}
		
		return $price_html;
	}
}

if(!function_exists('grandconference_highlight_keyword'))
{
	function grandconference_highlight_keyword($str, $search) {
	    $occurrences = substr_count(strtolower($str), strtolower($search));
	    $newstring = $str;
	    $match = array();
	 
	    for ($i=0;$i<$occurrences;$i++) {
	        $match[$i] = stripos($str, $search, $i);
	        $match[$i] = substr($str, $match[$i], strlen($search));
	        $newstring = str_replace($match[$i], '[#]'.$match[$i].'[@]', strip_tags($newstring));
	    }
	 
	    $newstring = str_replace('[#]', '<strong>', $newstring);
	    $newstring = str_replace('[@]', '</strong>', $newstring);
	    return $newstring;
	}
}
	
if(!function_exists('grandconference_sanitize_title'))
{
	function grandconference_sanitize_title($title = '')
	{
		if(!empty($title))
		{
			$title = str_replace(' ', '-', $title);
			$title = preg_replace('/[^A-Za-z0-9]/', '-', $title);
			$title = strtolower($title);
			return $title;
		}
	}
}
	
if(!function_exists('grandconference_get_lazy_img_attr'))
{
	function grandconference_get_lazy_img_attr()
	{
		$tg_enable_lazy_loading = get_theme_mod('tg_enable_lazy_loading');
		$return_attr = array('class' => '','source' => 'src');
		
		if(!empty($tg_enable_lazy_loading))
		{
			$return_attr = array('class' => 'lazy','source' => 'data-src');
		}
		
		return $return_attr;
	}
}
	
if(!function_exists('grandconference_get_blank_img_attr'))
{
	function grandconference_get_blank_img_attr()
	{
		$tg_enable_lazy_loading = get_theme_mod('tg_enable_lazy_loading');
		$return_attr = '';
		
		if(!empty($tg_enable_lazy_loading))
		{
			$return_attr = 'src=""';
		}
		
		return $return_attr;
	}
}

if(!function_exists('grandconference_get_post_format_icon'))
{
	function grandconference_get_post_format_icon($post_id = '')
	{
		$return_html = '';
		
		if(!empty($post_id))
		{
			$post_format = get_post_format($post_id);
			
			if($post_format == 'video')
			{
				$return_html = '<div class="post-type-icon"><span class="ti-control-play"></span></div>';	
			}
		}
		
		return $return_html;
	}
}

if(!function_exists('grandconference_limit_get_excerpt'))
{
	function grandconference_limit_get_excerpt($excerpt = '', $limit = 50, $string = '...')
	{
		$excerpt = preg_replace(" ([.*?])",'',$excerpt);
		$excerpt = strip_shortcodes($excerpt);
		$excerpt = strip_tags($excerpt);
		$excerpt = substr($excerpt, 0, $limit);
		$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
		$excerpt = $excerpt.$string;
		
		return '<p>'.$excerpt.'</p>';
	}
}

if(!function_exists('grandconference_get_image_id'))
{
	function grandconference_get_image_id($url) 
	{
		$attachment_id = attachment_url_to_postid($url);
		
		if(!empty($attachment_id))
		{
			return $attachment_id;
		}
		else
		{
			return $url;
		}
	}
}


/**
 * Retrieve galleries posts
 *
 * @since 1.0.0
 *
 * @access public
 *
 * @return array galleries
 */
function grandconference_get_galleries() {
	//Get all galleries
	$args = array(
		'numberposts' => -1,
		'post_type' => array('galleries'),
		'orderby'   => 'post_title',
		'order'     => 'ASC',
		'suppress_filters'   => false
	);
	
	$galleries_arr = get_posts($args);
	$galleries_select = array();
	$galleries_select[''] = '';
	
	foreach($galleries_arr as $gallery)
	{
		$galleries_select[$gallery->ID] = $gallery->post_title;
	}

	return $galleries_select;
}

/**
 * Retrieve portfolios posts
 *
 * @since 1.0.0
 *
 * @access public
 *
 * @return array portfolios
 */
function grandconference_get_portfolios() {
	//Get all galleries
	$args = array(
		'numberposts' => -1,
		'post_type' => array('portfolios'),
		'orderby'   => 'post_title',
		'order'     => 'ASC',
		'suppress_filters'   => false
	);
	
	$portfolios_arr = get_posts($args);
	$portfolios_select = array();
	$portfolios_select[''] = '';
	
	foreach($portfolios_arr as $portfolio)
	{
		$portfolios_select[$portfolio->ID] = $portfolio->post_title;
	}

	return $portfolios_select;
}

function grandconference_get_portfolio_cat() {
	return array();
}

/**
 * Retrieve fullscreen menu posts
 *
 * @since 1.0.0
 *
 * @access public
 *
 * @return array fullscreen menu
 */
function grandconference_get_fullmenu() {
	//Get all fullscreen menus
	$args = array(
		'numberposts' => -1,
		'post_type' => array('fullmenu'),
		'orderby'   => 'post_title',
		'order'     => 'ASC',
	);
	
	$fullmenu_arr = get_posts($args);
	$fullmenu_select = array();
	$fullmenu_select[''] = '';
	
	foreach($fullmenu_arr as $fullmenu)
	{
		$fullmenu_select[$fullmenu->ID] = $fullmenu->post_title;
	}

	return $fullmenu_select;
}

function grandconference_get_theme_sidebar() {
	
	//Get all theme predefined sidebars
	$theme_sidebar = array(
		'' => '',
		'Page Sidebar' => 'Page Sidebar', 
		'Blog Sidebar' => 'Blog Sidebar', 
		'Contact Sidebar' => 'Contact Sidebar', 
		'Single Post Sidebar' => 'Single Post Sidebar',
		'Single Image Page Sidebar' => 'Single Image Page Sidebar',
		'Archive Sidebar' => 'Archive Sidebar',
		'Category Sidebar' => 'Category Sidebar',
		'Search Sidebar' => 'Search Sidebar',
		'Tag Sidebar' => 'Tag Sidebar', 
		'Footer Sidebar' => 'Footer Sidebar',
	);
	$dynamic_sidebar = get_option('pp_sidebar');
	
	if(!empty($dynamic_sidebar))
	{
		foreach($dynamic_sidebar as $sidebar)
		{
			$theme_sidebar[$sidebar] = $sidebar;
		}
	}
	
	return $theme_sidebar;
}

function grandconference_get_testimonial_cat() {
	//Get all testimonials categories
	$testimonial_cats_select = array();
	$testimonial_cats_select[''] = '';
	
	$testimonial_cats_arr = get_terms('testimonialcats', 'hide_empty=0&hierarchical=0&parent=0&orderby=menu_order');
			
	if(!empty($testimonial_cats_arr) && is_array($testimonial_cats_arr)) {
		foreach ($testimonial_cats_arr as $testimonial_cat) {
			$testimonial_cats_select[$testimonial_cat->slug] = $testimonial_cat->name;
		}
	}
	
	return $testimonial_cats_select;
}

function grandconference_get_team_cat() {
	//Get all team categories
	$team_cats_select = array();
	$team_cats_select[''] = '';
	
	$team_cats_arr = get_terms('teamcats', 'hide_empty=0&hierarchical=0&parent=0&orderby=menu_order');
			
	if(!empty($team_cats_arr) && is_array($team_cats_arr)) {
		foreach ($team_cats_arr as $team_cat) {
			$team_cats_select[$team_cat->slug] = $team_cat->name;
		}
	}
	
	return $team_cats_select;
}

function grandconference_get_speaker_cat() {
		//Get all speaker categories
		$speaker_cat_select = array();
		$speaker_cat_select[''] = '';
		
		$speaker_cat_arr = get_terms('speakercat', 'hide_empty=0&hierarchical=0&parent=0&orderby=menu_order');
				
		if(!empty($speaker_cat_arr) && is_array($speaker_cat_arr)) {
			foreach ($speaker_cat_arr as $speaker_cat) {
				$speaker_cat_select[$speaker_cat->slug] = $speaker_cat->name;
			}
		}
		
		return $speaker_cat_select;
	}

function grandconference_get_event_cat() {
		//Get all team categories
		$event_cats_select = array();
		$event_cats_select[''] = '';
		
		$event_cats_arr = get_terms('tribe_events_cat', 'hide_empty=0&hierarchical=0&parent=0&orderby=menu_order');
				
		if(!empty($event_cats_arr) && is_array($event_cats_arr)) {
			foreach ($event_cats_arr as $event_cat) {
				$event_cats_select[$event_cat->slug] = $event_cat->name;
			}
		}
		
		return $event_cats_select;
	}

function grandconference_get_event_location() {
		//Get all fullscreen menus
		$args = array(
			'numberposts' => -1,
			'post_type' => array('tribe_venue'),
			'orderby'   => 'post_title',
			'order'     => 'ASC',
		);
		
		$location_arr = get_posts($args);
		$location_select = array();
		$location_select[''] = '';
		
		foreach($location_arr as $location)
		{
			$location_select[$location->ID] = $location->post_title;
		}
	
		return $location_select;
}
 
function grandconference_attachment_field_credit ($form_fields, $post) {
	$form_fields['grandconference-purchase-url'] = array(
		'label' => esc_html__('Purchase URL', 'grandconference-elementor'),
		'input' => 'text',
		'value' => esc_url(get_post_meta( $post->ID, 'grandconference_purchase_url', true )),
	);

	return $form_fields;
}

function grandconference_get_pages() {
	/*
		Get all pages available
	*/
	$pages = get_pages();
	$pages_select = array();
	foreach($pages as $each_page)
	{
		$pages_select[$each_page->ID] = $each_page->post_title;
	}
	
	return $pages_select;
}

add_filter( 'attachment_fields_to_edit', 'grandconference_attachment_field_credit', 10, 2 );

function grandconference_attachment_field_credit_save ($post, $attachment) {
	if( isset( $attachment['grandconference-purchase-url'] ) )
update_post_meta( $post['ID'], 'grandconference_purchase_url', esc_url( $attachment['grandconference-purchase-url'] ) );

	return $post;
}

add_filter( 'attachment_fields_to_save', 'grandconference_attachment_field_credit_save', 10, 2 );

add_filter('upload_mimes', 'grandconference_add_custom_upload_mimes');
function grandconference_add_custom_upload_mimes($existing_mimes) 
{
	  $existing_mimes['woff'] = 'application/x-font-woff';
	  return $existing_mimes;
}

//Disable Elementor getting started
add_action( 'admin_init', function() {
	if ( did_action( 'elementor/loaded' ) ) {
		remove_action( 'admin_init', [ \Elementor\Plugin::$instance->admin, 'maybe_redirect_to_getting_started' ] );
	}
}, 1 );

add_action('init','grandconference_shop_sorting_remove');
function grandconference_shop_sorting_remove() {
	$grandconference_shop_filter_sorting = get_theme_mod('grandconference_shop_filter_sorting', true);
	
	if(empty($grandconference_shop_filter_sorting))
	{
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
		remove_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 30 );
		
		remove_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 20 );
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	}
}

remove_action( 'wp_head', 'rest_output_link_header', 10);    
remove_action( 'template_redirect', 'rest_output_link_header', 11);
?>