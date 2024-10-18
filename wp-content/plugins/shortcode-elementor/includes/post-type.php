<?php
function rselements_shortcode_register_post_type() {
    $labels = array(
        'name'               => esc_html__( 'RS Global Shortcodes', 'rs-shortcode'),
        'singular_name'      => esc_html__( 'Elementor Shortcodes', 'rs-shortcode'),
        'add_new'            => esc_html_x( 'Add New Shorcode', 'rs-shortcode'),
        'add_new_item'       => esc_html__( 'Add New Shorcode', 'rs-shortcode'),
        'edit_item'          => esc_html__( 'Edit Element', 'rs-shortcode'),
        'new_item'           => esc_html__( 'New Shortcode', 'rs-shortcode'),
        'all_items'          => esc_html__( 'All Shorcodes', 'rs-shortcode'),
        'view_item'          => esc_html__( 'View Elements', 'rs-shortcode'),    
        'not_found'          => esc_html__( 'No Elements found', 'rs-shortcode'),
        'not_found_in_trash' => esc_html__( 'No Elements found in Trash', 'rs-shortcode'),
        'parent_item_colon'  => esc_html__( 'Parent Team:', 'rs-shortcode'),
        'menu_name'          => esc_html__( 'Shortcode Elementor', 'rs-shortcode'),
    );  
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_in_menu'       => true,
        'show_in_admin_bar'  => true,
        'can_export'         => true,
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 20,     
        'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
        'supports'           => array( 'title', 'thumbnail', 'editor', 'page-attributes' )
    );
    register_post_type( 'rs_elements', $args );
}
add_action( 'init', 'rselements_shortcode_register_post_type' );



function rselements_add_meta_box(){
    add_meta_box('rs-shortcode-box','Elements Shortcode','rselemetns_shortcode_box','rs_elements','side','high');
}
add_action("add_meta_boxes", "rselements_add_meta_box");


function rselemetns_shortcode_box($post){
    ?>
    <h4><?php echo esc_html('Shortcode','rs-shortcode');?></h4>
    <input type='text' class='widefat' value='[SHORTCODE_ELEMENTOR id="<?php echo $post->ID; ?>"]' readonly="">

     <h4><?php echo esc_html('PHP Code','rs-shortcode');?></h4>
    <input type='text' class='widefat' value="&lt;?php echo do_shortcode('[SHORTCODE_ELEMENTOR id=&quot;<?php echo $post->ID; ?>&quot;]'); ?&gt;" readonly="">
    <?php
}