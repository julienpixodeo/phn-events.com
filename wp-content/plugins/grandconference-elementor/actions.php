<?php
add_filter( 'posts_where', 'grandconference_title_like_posts_where', 10, 2 );
function grandconference_title_like_posts_where( $where, $wp_query ) {
    global $wpdb;
    if ( $post_title_like = $wp_query->get( 'post_title_like' ) ) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( $wpdb->esc_like( $post_title_like ) ) . '%\'';
    }
    return $where;
}
	
	
/**
*	Setup AJAX search function
**/
add_action('wp_ajax_grandconference_ajax_search_result', 'grandconference_ajax_search_result');
add_action('wp_ajax_nopriv_grandconference_ajax_search_result', 'grandconference_ajax_search_result');

function grandconference_ajax_search_result() 
{
	global $wpdb;
	
	if(!isset($_POST['keyword']))
	{
		$_POST['keyword'] = $_POST['s'];
	}

	if (strlen($_POST['keyword'])>0) {
		$query_string.= $query_string = '&orderby=post_date&order=DESCe&suppress_filters=0&post_status=publish';
		parse_str($query_string, $args);
    
	    if(isset($_POST['keyword']) && !empty($_POST['keyword']))
	    {  
	    	$args['post_title_like'] = $_POST['keyword'];
	    }
		
		if(isset($_POST['search_event']) && $_POST['search_event']=='yes')
		{  
			$args['post_type'] = 'tribe_events';
		}
	    
	    if(isset($_POST['search_course']) && !empty($_POST['search_course']))
	    {  
	    	$args['post_type'] = 'lp_course';
	    }
		
		if(!isset($args['post_type']) OR empty($args['post_type']))
		{  
			$args['post_type'] = 'any';
		}
	    
	    $args['orderby'] = 'post_title';
		$args['order'] = 'ASC';
	    $args['posts_per_page'] = 10;

	    query_posts($args);
	    echo '<ul>';
	 	
	 	if (have_posts()) : while (have_posts()) : the_post();
	 		
	 		$course_ID_ID = get_the_ID();
	 		$course_title = get_the_title();
	 		$course_title = grandconference_highlight_keyword($course_title, $_POST['keyword']);
	 		
			echo '<li>';
			echo '<a href="'.get_permalink($course_ID_ID).'">';
			echo $course_title;
			echo '</a>';
			echo '</li>';
	
		endwhile;
		endif;
		
		echo '</ul>';
	}
	else 
	{
		echo '';
	}
	die();

}
/**
*	End theme custom AJAX calls handler
**/


/**
*	Setup AJAX get fullscreen menu function
**/
add_action('wp_ajax_grandconference_ajax_get_fullmenu', 'grandconference_ajax_get_fullmenu');
add_action('wp_ajax_nopriv_grandconference_ajax_get_fullmenu', 'grandconference_ajax_get_fullmenu');

function grandconference_ajax_get_fullmenu() 
{
	if(isset($_GET['id']) & !empty($_GET['id']))
	{
		$grandconference_fullmenu_default = $_GET['id'];
		
		//Add Polylang plugin support
		if (function_exists('pll_get_post')) {
			$grandconference_fullmenu_default = pll_get_post($grandconference_fullmenu_default);
		}
		
		//Add WPML plugin support
		if (function_exists('icl_object_id')) {
			$grandconference_fullmenu_default = icl_object_id($grandconference_fullmenu_default, 'page', false, ICL_LANGUAGE_CODE);
		}
		
		if(!empty($grandconference_fullmenu_default) && class_exists("\\Elementor\\Plugin"))
		{
			echo grandconference_get_elementor_content($grandconference_fullmenu_default);
		}
	}
	
	die();

}
/**
*	End get fullscreen menu function
**/

/**
*	Setup image proofing function
**/
add_action('wp_ajax_grandconference_image_proofing', 'grandconference_image_proofing');
add_action('wp_ajax_nopriv_grandconference_image_proofing', 'grandconference_image_proofing');

function grandconference_image_proofing() {
		check_ajax_referer( 'grandconference-gallery-proofing-nonce', 'themegoods_security' );
		
		$gallery_id = '';
		$image_id = '';
		
		if(isset($_POST['gallery_id']))
		{
			$gallery_id = $_POST['gallery_id'];
		}
		
		if(isset($_POST['image_id']))
		{
			$image_id = $_POST['image_id'];
		}
		
		//Get current approved images
		$current_images_approve = get_post_meta($gallery_id, 'gallery_images_approve', true);
		if(empty($current_images_approve))
		{
			add_post_meta($gallery_id, 'gallery_images_approve', array());
		}
		
		if(isset($_POST['method']) && $_POST['method'] == 'approve')
		{
			if ( !in_array( $image_id, $current_images_approve ) ) {
				$current_images_approve[] = $image_id;
			}

			$current_images_approve = array_unique($current_images_approve);
			update_post_meta($gallery_id, 'gallery_images_approve', $current_images_approve);
		}
		else if(isset($_POST['method']) && $_POST['method'] == 'unapprove')
		{
			if (($key = array_search($image_id, $current_images_approve)) !== false) 
			{
				unset($current_images_approve[$key]);
			}
			
			update_post_meta($gallery_id, 'gallery_images_approve', $current_images_approve);
		}
	
	die();
}

/**
*	End image proofing function
**/	
?>