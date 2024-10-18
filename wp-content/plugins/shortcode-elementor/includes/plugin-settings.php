<?php
    // Add settings links to the plugin page
    function rselements_setting_link($links) {
        $settings_links = array(
            
            sprintf("<a href='%s' target='_blank'>%s</a>", 'https://rstheme.com/support/', __('Support', 'rs-shortcode')),
        );

        $links = array_merge($links, $settings_links);

        return $links;
    }

    add_filter('plugin_action_links_' . RS_Elements_PLUGIN_BASE, 'rselements_setting_link');


    function rselements_custom_dashboard_widget() {
        ?>
        <style>
            .rselements_dashboard_widget_ads img {
                max-width: 100%; /* Ensure the image doesn't exceed the width of its container */
                height: auto;    /* Maintain the image's aspect ratio */
                display: block;  /* Remove any extra spacing below the image */
                margin: 0 auto;  /* Center the image horizontally */
            }
        </style>

        <div id="rselements_dashboard_widget" class="postbox">
            <div class="postbox-header">
                <h2 class="hndle ui-sortable-handle">
                    <?php _e("Single Shortcode", "rs-shortcode"); ?>
                    
                </h2>
            </div>
            <div class="inside" style="margin-bottom: 5px">
                <div class="rselements_dashboard_widget_ads">
                    <img src="<?php echo plugins_url('img/singleshortcode.jpg', __FILE__); ?>" alt="Plugin Icon">
                </div>
            </div>

            <div class="postbox-header">
                <h2 class="hndle ui-sortable-handle">
                    <?php _e("Add Shortcode", "rs-shortcode"); ?> 
                </h2>
            </div>

            <div class="inside">
                <div class="rselements_dashboard_widget_ads">
                    <img src="<?php echo plugins_url('img/allshortcode.jpg', __FILE__); ?>" alt="Plugin Icon">
                </div>
            </div>   

            <div class="postbox-header">
                <h2 class="hndle ui-sortable-handle">
                    <?php _e("Using Shortcode", "rs-shortcode"); ?> 
                </h2>
            </div>

            <div class="inside">
                <div class="rselements_dashboard_widget_ads">
                    <img src="<?php echo plugins_url('img/elementor_shortcode.jpg', __FILE__); ?>" alt="Plugin Icon">
                </div>
            </div>

            <div class="postbox-header">
                <h2 class="hndle ui-sortable-handle">
                    <?php _e("Preview Elementor Page", "rs-shortcode"); ?> 
                </h2>
            </div>

            <div class="inside">
                <div class="rselements_dashboard_widget_ads">
                    <img src="<?php echo plugins_url('img/elementor_shortcode_preview.jpg', __FILE__); ?>" alt="Plugin Icon">
                </div>
            </div>

            
        </div>
        <?php
    }

    function add_custom_dashboard_widget() {
        wp_add_dashboard_widget(
            'rselements_custom_dashboard_widget',
            'Shortcode Elementor',
            'rselements_custom_dashboard_widget'
        );
    }

    add_action('wp_dashboard_setup', 'add_custom_dashboard_widget');

