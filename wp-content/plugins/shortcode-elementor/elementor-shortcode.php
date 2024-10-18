<?php
/*plugin name: Shortcode Elementor
 * Plugin URI:  https://rstheme.com/products/wordpress/elementor
 * Description: Insert your elementor pages and sections templates anywhere using shortcode
 * Version:     1.0.3
 * Author:      RSTheme
 * Author URI:  https://rstheme.com/
 * Text Domain: rs-shortcode
 */
define( 'RS_Elements__FILE__', __FILE__ );
define( 'RS_Elements_PLUGIN_BASE', plugin_basename( RS_Elements__FILE__ ) );
define( 'RS_Elements_URL', plugins_url( '/', RS_Elements__FILE__ ) );
define( 'RS_Elements_PATH', plugin_dir_path( RS_Elements__FILE__ ) );

require_once( RS_Elements_PATH . 'includes/post-type.php' );
require_once( RS_Elements_PATH . 'includes/settings.php' );
require_once( RS_Elements_PATH . 'includes/plugin-settings.php' );

// Get Ready Plugin Translation
function rselements_load_textdomain_lite() {
    load_plugin_textdomain('rs-shortcode', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}
add_action('plugins_loaded', 'rselements_load_textdomain_lite');

class RSElements_Elementor_Shortcode{

	function __construct(){
		add_action( 'manage_rs_elements_posts_custom_column' , array( $this, 'rselements_rs_global_templates_columns' ), 10, 2);
		add_filter( 'manage_rs_elements_posts_columns', array($this,'rselements_custom_edit_global_templates_posts_columns' ));
		// Add Upgrade to Pro sub-menu
        add_action('admin_menu', array($this, 'rs_shortcode_demo_submenu'));	

	}

	function rselements_custom_edit_global_templates_posts_columns($columns) {
		
		$columns['rs_shortcode_column'] = __( 'Shortcode', 'rs_elements_lite' );
		return $columns;
	}


	function rselements_rs_global_templates_columns( $column, $post_id ) {

		switch ( $column ) {

			case 'rs_shortcode_column' :
				echo '<input type=\'text\' class=\'widefat\' value=\'[SHORTCODE_ELEMENTOR id="'.$post_id.'"]\' readonly="">';
				break;
		}
	}

	    // Function to add Upgrade to Pro sub-menu
    function rs_shortcode_demo_submenu() {
        add_submenu_page(
            'edit.php?post_type=rs_elements',
            'Get Help',
            'Get Help',
            'manage_options',
            'rs_shortcode_demo',
            array($this, 'rs_shortcode_demo_page')
        );
    }

    // Callback function for Upgrade to Pro sub-menu page
    function rs_shortcode_demo_page() {
        // Add your Upgrade to Pro page content here
        echo '<div class="wrap">';
         require_once( RS_Elements_PATH . 'includes/all-demo.php' );
        // Add your content here
        echo '</div>';
    }
    
	
}
new RSElements_Elementor_Shortcode();

