<?php
/*
 * Plugin Name: GrandConference Theme Elements for Elementor
 * Description: Custom elements for Elementor using GrandConference theme
 * Plugin URI:  https://grandconference.themegoods.com/v5
 * Version:     1.3
 * Author:      ThemGoods
 * Author URI:  https://themegoods.com/
 * Elementor tested up to: 3.18.3
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

if ( ! defined( 'ENVATOITEMID' ) ) {
	define("ENVATOITEMID", 19560408);
}

if ( ! defined( 'GRANDCONFERENCE_SHORTNAME' ) ) {
	define("GRANDCONFERENCE_SHORTNAME", "pp");
}

define( 'GRANDCONFERENCE_ELEMENTOR_PATH', plugin_dir_path( __FILE__ ));

if (!defined('GRANDCONFERENCE_THEMEDATEFORMAT'))
{
	define("GRANDCONFERENCE_THEMEDATEFORMAT", get_option('date_format'));
}

if (!defined('GRANDCONFERENCE_THEMETIMEFORMAT'))
{
	define("GRANDCONFERENCE_THEMETIMEFORMAT", get_option('time_format'));
}

if (!defined('GRANDCONFERENCE_UPLOAD'))
{
	$wp_upload_arr = wp_upload_dir();
	define("GRANDCONFERENCE_UPLOAD", $wp_upload_arr['basedir']."/".strtolower(sanitize_title('grandconference-elementor'))."/");
	
	if(!is_dir(GRANDCONFERENCE_UPLOAD))
	{
		mkdir(GRANDCONFERENCE_UPLOAD);
	}
}

if(!function_exists('grandconference_is_registered'))
{
	function grandconference_is_registered() {
		$grandconference_is_registered = get_option("envato_purchase_code_".ENVATOITEMID);
		
		if(!empty($grandconference_is_registered)) {
			return $grandconference_is_registered;
		}
		else {
			return false;
		}
	}
}

$is_verified_envato_purchase_code = true;

if($is_verified_envato_purchase_code) {
	/**
 	* Load the plugin after Elementor (and other plugins) are loaded.
 	*
 	* @since 1.0.0
 	*/
	function grandconference_elementor_load() {
		load_plugin_textdomain( 'grandconference-elementor', FALSE, dirname( plugin_basename(__FILE__) ) . '/languages/' );
		
		// Require the main plugin file
		require(GRANDCONFERENCE_ELEMENTOR_PATH.'/tools.php');
		require(GRANDCONFERENCE_ELEMENTOR_PATH.'/actions.php');
		require(GRANDCONFERENCE_ELEMENTOR_PATH.'/templates.php' );
		require(GRANDCONFERENCE_ELEMENTOR_PATH.'/plugin.php' );
		require(GRANDCONFERENCE_ELEMENTOR_PATH.'/shortcode.php');
		require(GRANDCONFERENCE_ELEMENTOR_PATH.'/megamenu.php');
	}
	add_action( 'plugins_loaded', 'grandconference_elementor_load' );
	
	
	function grandconference_post_type_header() {
		$labels = array(
    		'name' => _x('Headers', 'post type general name', 'grandconference-elementor'),
    		'singular_name' => _x('Header', 'post type singular name', 'grandconference-elementor'),
    		'add_new' => _x('Add New Header', 'grandconference-elementor'),
    		'add_new_item' => __('Add New Header', 'grandconference-elementor'),
    		'edit_item' => __('Edit Header', 'grandconference-elementor'),
    		'new_item' => __('New Header', 'grandconference-elementor'),
    		'view_item' => __('View Header', 'grandconference-elementor'),
    		'search_items' => __('Search Header', 'grandconference-elementor'),
    		'not_found' =>  __('No Header found', 'grandconference-elementor'),
    		'not_found_in_trash' => __('No Header found in Trash', 'grandconference-elementor'), 
    		'parent_item_colon' => ''
		);		
		$args = array(
    		'labels' => $labels,
    		'public' => true,
    		'publicly_queryable' => true,
    		'show_ui' => true, 
    		'query_var' => true,
    		'rewrite' => true,
    		'capability_type' => 'post',
    		'hierarchical' => false,
    		'show_in_nav_menus' => false,
    		'show_in_admin_bar' => true,
    		'menu_position' => 10,
    		'exclude_from_search' => true,
    		'supports' => array('title', 'content'),
    		'menu_icon' => 'dashicons-editor-insertmore'
		); 		
	
		register_post_type( 'header', $args );
	} 
								  	
	add_action('init', 'grandconference_post_type_header');
	
	add_action('elementor/widgets/register', 'grandconference_unregister_elementor_widgets');
	
	function grandconference_unregister_elementor_widgets($obj){
		$obj->unregister('sidebar');
	}
	
	function grandconference_post_type_footer() {
		$labels = array(
    		'name' => _x('Footers', 'post type general name', 'grandconference-elementor'),
    		'singular_name' => _x('Footer', 'post type singular name', 'grandconference-elementor'),
    		'add_new' => _x('Add New Footer', 'grandconference-elementor'),
    		'add_new_item' => __('Add New Footer', 'grandconference-elementor'),
    		'edit_item' => __('Edit Footer', 'grandconference-elementor'),
    		'new_item' => __('New Footer', 'grandconference-elementor'),
    		'view_item' => __('View Footer', 'grandconference-elementor'),
    		'search_items' => __('Search Footer', 'grandconference-elementor'),
    		'not_found' =>  __('No Footer found', 'grandconference-elementor'),
    		'not_found_in_trash' => __('No Footer found in Trash', 'grandconference-elementor'), 
    		'parent_item_colon' => ''
		);		
		$args = array(
    		'labels' => $labels,
    		'public' => true,
    		'publicly_queryable' => true,
    		'show_ui' => true, 
    		'query_var' => true,
    		'rewrite' => true,
    		'capability_type' => 'post',
    		'hierarchical' => false,
    		'show_in_nav_menus' => false,
    		'show_in_admin_bar' => true,
    		'menu_position' => 20,
    		'exclude_from_search' => true,
    		'supports' => array('title', 'content'),
    		'menu_icon' => 'dashicons-editor-insertmore'
		); 		
	
		register_post_type( 'footer', $args );
	} 
								  	
	add_action('init', 'grandconference_post_type_footer');
	
	
	function grandconference_post_type_megamenu() {
		$labels = array(
    		'name' => _x('Mega Menus', 'post type general name', 'grandconference-elementor'),
    		'singular_name' => _x('Mega Menu', 'post type singular name', 'grandconference-elementor'),
    		'add_new' => _x('Add New Mega Menu', 'grandconference-elementor'),
    		'add_new_item' => __('Add New Mega Menu', 'grandconference-elementor'),
    		'edit_item' => __('Edit Mega Menu', 'grandconference-elementor'),
    		'new_item' => __('New Mega Menu', 'grandconference-elementor'),
    		'view_item' => __('View Mega Menu', 'grandconference-elementor'),
    		'search_items' => __('Search Mega Menu', 'grandconference-elementor'),
    		'not_found' =>  __('No Mega Menu found', 'grandconference-elementor'),
    		'not_found_in_trash' => __('No Mega Menu found in Trash', 'grandconference-elementor'), 
    		'parent_item_colon' => ''
		);		
		$args = array(
    		'labels' => $labels,
    		'public' => true,
    		'publicly_queryable' => true,
    		'show_ui' => true, 
    		'query_var' => true,
    		'rewrite' => true,
    		'capability_type' => 'post',
    		'hierarchical' => false,
    		'show_in_nav_menus' => false,
    		'show_in_admin_bar' => true,
    		'menu_position' => 10,
    		'exclude_from_search' => true,
    		'supports' => array('title', 'content'),
    		'menu_icon' => 'dashicons-welcome-widgets-menus'
		); 		
	
		register_post_type( 'megamenu', $args );
	} 
								  	
	add_action('init', 'grandconference_post_type_megamenu');
	
	function grandconference_post_type_fullscreen_menu() {
		$labels = array(
			'name' => _x('Fullscreen Menus', 'post type general name', 'grandconference-elementor'),
			'singular_name' => _x('Fullscreen Menu', 'post type singular name', 'grandconference-elementor'),
			'add_new' => _x('Add New Fullscreen Menu', 'grandconference-elementor'),
			'add_new_item' => __('Add New Fullscreen Menu', 'grandconference-elementor'),
			'edit_item' => __('Edit Fullscreen Menu', 'grandconference-elementor'),
			'new_item' => __('New Fullscreen Menu', 'grandconference-elementor'),
			'view_item' => __('View Fullscreen Menu', 'grandconference-elementor'),
			'search_items' => __('Search Fullscreen Menu', 'grandconference-elementor'),
			'not_found' =>  __('No Fullscreen Menu found', 'grandconference-elementor'),
			'not_found_in_trash' => __('No Mega Menu found in Trash', 'grandconference-elementor'), 
			'parent_item_colon' => ''
		);		
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'show_in_nav_menus' => false,
			'show_in_admin_bar' => true,
			'menu_position' => 10,
			'exclude_from_search' => true,
			'supports' => array('title', 'content'),
			'menu_icon' => 'dashicons-format-aside'
		); 		
	
		register_post_type( 'fullmenu', $args );
	} 
								  	
	add_action('init', 'grandconference_post_type_fullscreen_menu');
	
	function grandconference_post_type_galleries() {
		$tg_permalink_galleries = get_theme_mod('grandconference_gallery_slug', 'gallery');
		
		$labels = array(
			'name' => _x('Galleries', 'post type general name', 'grandconference-elementor'),
			'singular_name' => _x('Gallery', 'post type singular name', 'grandconference-elementor'),
			'add_new' => _x('Add New Gallery', 'book', 'grandconference-elementor'),
			'add_new_item' => __('Add New Gallery', 'grandconference-elementor'),
			'edit_item' => __('Edit Gallery', 'grandconference-elementor'),
			'new_item' => __('New Gallery', 'grandconference-elementor'),
			'view_item' => __('View Gallery', 'grandconference-elementor'),
			'search_items' => __('Search Gallery', 'grandconference-elementor'),
			'not_found' =>  __('No Gallery found', 'grandconference-elementor'),
			'not_found_in_trash' => __('No Gallery found in Trash', 'grandconference-elementor'), 
			'parent_item_colon' => ''
		);		
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'query_var' => true,
			'rewrite' => array('slug' => $tg_permalink_galleries,'with_front' => false),
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => 20,
			'supports' => array('title', 'thumbnail', 'revisions'),
			'menu_icon' => 'dashicons-format-gallery'
		); 		
	
		register_post_type( 'galleries', $args );
		
	  	$labels = array(			  
			'name' => _x( 'Gallery Categories', 'taxonomy general name', 'grandconference-elementor' ),
			'singular_name' => _x( 'Gallery Category', 'taxonomy singular name', 'grandconference-elementor' ),
			'search_items' =>  __( 'Search Gallery Categories', 'grandconference-elementor' ),
			'all_items' => __( 'All Gallery Categories', 'grandconference-elementor' ),
			'parent_item' => __( 'Parent Gallery Category', 'grandconference-elementor' ),
			'parent_item_colon' => __( 'Parent Gallery Category:', 'grandconference-elementor' ),
			'edit_item' => __( 'Edit Gallery Category', 'grandconference-elementor' ), 
			'update_item' => __( 'Update Gallery Category', 'grandconference-elementor' ),
			'add_new_item' => __( 'Add New Gallery Category', 'grandconference-elementor' ),
			'new_item_name' => __( 'New Gallery Category Name', 'grandconference-elementor' ),
	  	); 							  	  
	} 
								  	
	add_action('init', 'grandconference_post_type_galleries');
	
	/*function post_type_portfolios() {
		$tg_permalink_portfolio = get_theme_mod('grandconference_portfolio_slug', 'portfolio');
		
		$labels = array(
			'name' => _x('Portfolios', 'post type general name', 'grandconference-elementor'),
			'singular_name' => _x('Portfolio', 'post type singular name', 'grandconference-elementor'),
			'add_new' => _x('Add New Portfolio', 'book', 'grandconference-elementor'),
			'add_new_item' => esc_html__('Add New Portfolio', 'grandconference-elementor'),
			'edit_item' => esc_html__('Edit Portfolio', 'grandconference-elementor'),
			'new_item' => esc_html__('New Portfolio', 'grandconference-elementor'),
			'view_item' => esc_html__('View Portfolio', 'grandconference-elementor'),
			'search_items' => esc_html__('Search Portfolios', 'grandconference-elementor'),
			'not_found' =>  esc_html__('No Portfolio found', 'grandconference-elementor'),
			'not_found_in_trash' => esc_html__('No Portfolio found in Trash', 'grandconference-elementor'), 
			'parent_item_colon' => ''
		);		
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'query_var' => true,
			'rewrite' => array('slug' => $tg_permalink_portfolio,'with_front' => false),
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => 20,
			'supports' => array('title','editor', 'thumbnail', 'excerpt', 'comments'),
			'show_in_rest' => true,
			'menu_icon' => 'dashicons-format-aside'
		); 		
	
		register_post_type( 'portfolios', $args );
		
	  	$labels = array(			  
			'name' => _x( 'Portfolio Categories', 'taxonomy general name', 'grandconference-elementor' ),
			'singular_name' => _x( 'Portfolio Category', 'taxonomy singular name', 'grandconference-elementor' ),
			'search_items' =>  __( 'Search Portfolio Categories', 'grandconference-elementor' ),
			'all_items' => __( 'All Portfolio Categories', 'grandconference-elementor' ),
			'parent_item' => __( 'Parent Portfolio Category', 'grandconference-elementor' ),
			'parent_item_colon' => __( 'Parent Portfolio Category:', 'grandconference-elementor' ),
			'edit_item' => __( 'Edit Portfolio Category', 'grandconference-elementor' ), 
			'update_item' => __( 'Update Portfolio Category', 'grandconference-elementor' ),
			'add_new_item' => __( 'Add New Portfolio Category', 'grandconference-elementor' ),
			'new_item_name' => __( 'New Portfolio Category Name', 'grandconference-elementor' ),
	  	); 							  
	  	
	  	register_taxonomy(
			'portfolio_cat',
			'portfolios',
			array(
				'public'=>true,
				'hierarchical' => true,
				'labels'=> $labels,
				'query_var' => 'portfolio_cat',
				'show_ui' => true,
				'show_in_rest' => true,
				'rewrite' => array( 'slug' => 'portfolio-cat', 'with_front' => false ),
			)
		);		  
	} 
								  	
	add_action('init', 'post_type_portfolios');*/
	
	add_action('add_meta_boxes', function () {
		global $post;

		if($post == NULL){
			return;
		}
	
		// Check if its a correct post type/types to apply template
		if ( ! in_array( $post->post_type, [ 'header', 'footer', 'megamenu' ] ) ) {
			return;
		}
	
		// Check that a template is not set already
		if ( '' !== $post->page_template ) {
			return;
		}
	
		//Finally set the page template
		$post->page_template = 'elementor_canvas';
		update_post_meta($post->ID, '_wp_page_template', 'elementor_canvas');
	}, 5 );
	
	
	//Make widget support shortcode
	add_filter('widget_text', 'do_shortcode');
	
	/**
	*	End Category Posts Custom Widgets
	**/
}
?>