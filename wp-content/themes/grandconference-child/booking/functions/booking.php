<?php
// enqueue scripts and styles.
function booking_scripts() {
    if(!is_admin()){
        wp_enqueue_style('frontend-jquery-ui-css', get_stylesheet_directory_uri() . '/booking/css/jquery-ui.css', array(), time(), 'all');
        wp_enqueue_script('frontend-jquery-ui-script', get_stylesheet_directory_uri() . '/booking/js/jquery-ui.js', array('jquery'), time(), true);
        wp_enqueue_script('frontend-booking-script', get_stylesheet_directory_uri() . '/booking/js/booking.js', array('jquery'), time(), true);
    }
    wp_enqueue_style('booking-css', get_stylesheet_directory_uri() . '/booking/css/booking.css', array(), time(), 'all');
}
add_action( 'wp_enqueue_scripts', 'booking_scripts',999 );

function add_ajaxurl_to_script()
{
    wp_localize_script('jquery', 'ajaxurl', admin_url('admin-ajax.php'));
}
add_action('wp_enqueue_scripts', 'add_ajaxurl_to_script');

// loader ajax
function loader_ajax(){
    ob_start();
    echo "<div class='wrap-loader'><div class='loader'></div></div><div class='loader-bg'></div>";
}
add_action('wp_footer','loader_ajax',999);

// form booking hotel
function phn_form_booking_hotel($event_id,$post_id,$title_price,$rooms,$option_default,$checkout,$maximum_guest_title){
    $price = []; $option_select = "";
    $lan = get_field('language', $post_id);
    $peoples = ($lan === 'french') ? "personnes" : "peoples";
    $currency = get_woocommerce_currency_symbol(get_option('woocommerce_currency'));
    if(!empty($event_id)){
        $data_hotel_event = get_post_meta($event_id, 'data_hotel_event', true);
        if(!empty($data_hotel_event)){
            echo "<form action='' class='form-booking'>";
            foreach($data_hotel_event as $key => $value){
                if((int) $value['hotel_id'] === $post_id){
                    $field_text = isset($value['field_text']) ? $value['field_text'] : '';
                    $field_text_html = "";
                    $variations_data = $value['variations_data'];
                    if(!empty($variations_data)){
                        $option_select .= "<option selected disabled>".$option_default."</option>";
                        foreach($variations_data as $k => $v){
                            $price[] = ((int) $v['price'] == $v['price']) ? (int) $v['price'] : (float) $v['price'];
                            $each_price = ((int) $v['price'] == $v['price']) ? (int) $v['price'] : (float) $v['price'];
                            $name_variations = get_post_meta($v['variations_id'], 'attribute_type-of-rooms', true);
                            $option_select .= "<option value='".$v['variations_id']."' data-price='".$v['price']."' data-maximum='".$v['maximum']."' data-event='".$event_id."' data-hotel='".$post_id."'>
                            ".$name_variations." - ".$v['maximum']." ".$peoples." - ".wc_price($each_price)." / ".$rooms."
                            </option>";
                        }
                    }
                    if(!empty($field_text)){
                        $field_text_html = "<p class='field-text-html'>".$field_text."</p>";
                    }
                }
            }
            if($price){
                $min_price = wc_price(min($price));
                $max_price = wc_price(max($price));
                echo "<h3 class='title'>".$title_price." : ".$min_price." - ".$max_price." / ".$rooms."</h3>";
            }
            if($option_select){
                echo "<select name='type_of_room' class='select_type_of_room' >".$option_select."</select>";
            }
            echo "<div id='calendar-booking'></div>";
            echo $field_text_html;
            echo "<div class='wrap-qty-js disable'>
                    <div class='quantity buttons_added qty-js qty-js-new'>
                        <a href='javascript:void(0)' id='minus_qty' class='minus'>-</a>
                        <input type='number' id='' class='input-text qty text' name='quantity' value='1'
                            aria-label='Product quantity' size='4' min='1' max='' step='1' placeholder=''
                            inputmode='numeric' autocomplete='off'>
                        <a href='javascript:void(0)' id='plus_qty' class='plus'>+</a>
                    </div>
                </div>";
            echo "<input type='hidden' id='start_day' size='10'><input type='hidden' id='end_day' size='10'>";
            echo "<input type='hidden' id='currency' value='".$currency."'>";
            echo "<div class='day-available'></div>";
            echo "<input type='hidden' id='setminday' value='0'>";
            echo "<h6 class='description-typeroom description-typeroom-new'>Nombre de nuit : <span class='number-night'></span></h6>";
            echo "<h6 class='price-typeroom price-typeroom-new'>Prix total : <span class='js-price-html'></span></h6>";
            echo "<button type='submit' name='add-to-cart-hotel' value='' class='add-to-cart-hotel button alt'>".$checkout."</button>";
            echo "</form>";    
        }
    }
}
add_filter( 'form_booking_hotel','phn_form_booking_hotel', 10, 8 );

// get day available variation
function get_day_available_variation($data_hotel_event,$id_variation,$hotel_id,$current_day_timestamp){
    $html='';
    if(!empty($data_hotel_event)){
        foreach($data_hotel_event as $key => $value){
            if((int)$value['hotel_id'] === $hotel_id ){
                $variations_data = $value['variations_data'];
                if(!empty($variations_data)){
                    foreach($variations_data as $k => $v){
                        if((int)$v['variations_id'] === $id_variation){
                            if(isset($v['date_available'])){
                                $day_available = $v['date_available'];
                                foreach($day_available as $kk => $vl){
                                    $stock = isset($vl['stock']) ? (int) $vl['stock'] : 0;
                                    if($vl['stock'] != 0 && (int)$vl['timestamp'] >= $current_day_timestamp ){
                                        $html .="<input type='hidden' name='day' value='".$vl['date']."' data-timestamp='".$vl['timestamp']."' data-stock='".$vl['stock']."'>";
                                    }
                                }
                            } 
                        }
                    }
                }
            } 
        }
    }
    return $html;
}

// get array day timestamp available variation
function get_day_and_stock_variation($event_id,$variation_id,$hotel_id,$current_day_timestamp,$start_day,$end_day,$quantity){
    $data_hotel_event = get_post_meta($event_id, 'data_hotel_event', true);
    $variation_data = [];
    if(!empty($data_hotel_event)){
        foreach($data_hotel_event as $key => $value){
            if((int)$value['hotel_id'] === $hotel_id ){
                $variations_data = $value['variations_data'];
                if(!empty($variations_data)){
                    foreach($variations_data as $k => $v){
                        if((int)$v['variations_id'] === $variation_id){
                            if(isset($v['date_available'])){
                                $day_available = $v['date_available'];
                                foreach($day_available as $kk => $vl){
                                    $stock = isset($vl['stock']) ? (int) $vl['stock'] : 0;
                                    if($vl['stock'] != 0 && (int)$vl['timestamp'] >= $current_day_timestamp && (int)$vl['timestamp'] >= $start_day && (int)$vl['timestamp'] < $end_day){
                                        $variation_data[(int)$vl['timestamp']] = (int) $vl['stock'] - (int) $quantity;
                                    }
                                }
                            } 
                        }
                    }
                }
            } 
        }
    }
    return $variation_data;
}

// stock day in cart
function stock_day_in_cart($variation_id) {
    $cart = WC()->cart;
    $cart_items = $cart->get_cart();
    $stock_day = [];
    $output = [];

    foreach ($cart_items as $cart_item) {
        if ($cart_item['variation_id'] === $variation_id) {
            $quantity = $cart_item['quantity'];
            $start_day_timestamp = $cart_item['start_day_timestamp'];
            $end_day_timestamp = $cart_item['end_day_timestamp'];
            $total_days = ($end_day_timestamp - $start_day_timestamp) / 86400;

            for ($i = 0; $i < $total_days; $i++) {
                $current_day_timestamp = $start_day_timestamp + (86400 * $i);
                if (isset($stock_day[$current_day_timestamp])) {
                    $stock_day[$current_day_timestamp] += $quantity;
                } else {
                    $stock_day[$current_day_timestamp] = $quantity;
                }
            }
        }
    }

    return $stock_day;
}

// is stock add
function is_stock_add($event_id, $variation_id, $hotel_id, $current_day_timestamp, $start_day, $end_day, $quantity) {
    $variation_data = get_day_and_stock_variation($event_id, $variation_id, $hotel_id, $current_day_ts, $start_day, $end_day, $quantity);
    $stock_day = stock_day_in_cart($variation_id);
    foreach ($variation_data as $key => $value) {
        $result = $value - ($stock_day[$key] ?? 0);
        if ($result < 0) {
            return false; 
        }
    }
    return true;
}

// select type of room
function select_type_of_room(){
    $id_variation = isset($_POST['id_variation']) ? (int) $_POST['id_variation'] : '';
    $maximum = isset($_POST['maximum']) ? (int) $_POST['maximum'] : '';
    $event_id = isset($_POST['event_id']) ? (int) $_POST['event_id'] : '';
    $hotel_id = isset($_POST['hotel_id']) ? (int) $_POST['hotel_id'] : '';
    $current_day_timestamp = isset($_POST['current_day_timestamp']) ? (int) $_POST['current_day_timestamp'] : '';
    $price = '';

    if(isset($_POST['price'])){
        if((int) $_POST['price'] == $_POST['price']){
            $price = (int) $_POST['price'];
        }else{
            $price = (float) $_POST['price'];
        }
    }

    if($event_id){
        $data_hotel_event = get_post_meta($event_id, 'data_hotel_event', true);
    }

    $day_available = get_day_available_variation($data_hotel_event,$id_variation,$hotel_id,$current_day_timestamp);

    $return = array(
        'day_available' => $day_available
    );

    wp_send_json($return);
}
add_action('wp_ajax_select_type_of_room', 'select_type_of_room');
add_action('wp_ajax_nopriv_select_type_of_room', 'select_type_of_room');

// add hotel to cart
function add_to_cart_hotel(){
    $variation_id = isset($_POST['id_variation']) ? (int) $_POST['id_variation'] : '';
    $max = isset($_POST['maximum']) ? (int) $_POST['maximum'] : '';
    $event_id = isset($_POST['event_id']) ? (int) $_POST['event_id'] : '';
    $hotel_id = isset($_POST['hotel_id']) ? (int) $_POST['hotel_id'] : '';
    $start_day_str = isset($_POST['start_day_string']) ? $_POST['start_day_string'] : '';
    $start_day_ts = isset($_POST['start_day_timestamp']) ? (int) $_POST['start_day_timestamp'] : '';
    $end_day_str = isset($_POST['end_day_string']) ? $_POST['end_day_string'] : '';
    $end_day_ts = isset($_POST['end_day_timestamp']) ? (int) $_POST['end_day_timestamp'] : '';
    $quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : '';
    $current_day_ts = isset($_POST['current_day_timestamp']) ? (int) $_POST['current_day_timestamp'] : '';
    $price = '';
    if(isset($_POST['price'])){
        if((int) $_POST['price'] == $_POST['price']){
            $price = (int) $_POST['price'];
        }else{
            $price = (float) $_POST['price'];
        }
    }

    $cart_url = wc_get_cart_url();
    $lan = get_field('language', $hotel_id);
    $stock = get_post_meta($product_id, '_stock', true);
    $success = false;
    $msg_success = ($lan === 'french') ? get_field('room_message_success_fr', 'option') : get_field('room_message_success', 'option');
    $msg_limit = ($lan === 'french') ? get_field('room_message_limit_fr', 'option') : get_field('room_message_limit', 'option');
    $msg_error = ($lan === 'french') ? get_field('room_message_error_fr', 'option') : get_field('room_message_error', 'option');
    $msg_add_tickets_first = ($lan === 'french') ? get_field('add_tickets_to_cart_first_fr', 'option') : get_field('add_tickets_to_cart_first', 'option');
    $msg_err_add_hotel = ($lan === 'french') ? get_field('message_err_add_hotel_fr', 'option') : get_field('message_err_add_hotel', 'option');
    $view_cart = ($lan === 'french') ? get_field('view_cart_fr', 'option') : get_field('view_cart', 'option');
    $msg = '<a href="' . $cart_url . '" tabindex="1" class="button wc-forward">' . $view_cart . '</a> ';
    $num_day = ($end_day_ts - $start_day_ts)/86400;

    $id_ticket = (int) id_ticket_in_cart();
    $is_stock_add = is_stock_add($event_id,$variation_id,$hotel_id,$current_day_ts,$start_day_ts,$end_day_ts,$quantity);

    if($is_stock_add == true){
        session_start();
        $_SESSION['event_id'] = $event_id;
        $cart_data = array(
            "start_day" => $start_day_str,
            "start_day_timestamp" => $start_day_ts,
            "end_day" => $end_day_str,
            "end_day_timestamp" => $end_day_ts,
            "maximum" => $max,
            "number_day" => $num_day,
            "price" => $price,
            "variation_id" => $variation_id,
            "event_id" => $event_id,
            "hotel_id" => $hotel_id,
            "current_day_ts" => $current_day_ts
        );

        $add_to_cart = WC()->cart->add_to_cart($variation_id, $quantity, 0, array(), $cart_data);
        
        if ($add_to_cart) {
            $msg .= $msg_success;
            $success = true;
        } else {
            $message .= $message_error;
        }
    }else{
        $msg .= $msg_limit;
    }

    $quantity_total = quantity_cart();

    $return = array(
        'success' => $success,
        'quantity_total' => $quantity_total,
        'message' => $msg
    );

    wp_send_json($return);
}
add_action('wp_ajax_add_to_cart_hotel', 'add_to_cart_hotel');
add_action('wp_ajax_nopriv_add_to_cart_hotel', 'add_to_cart_hotel');

// Save custom data to order items
function save_custom_data_to_order_items($item, $cart_item_key, $values, $order) {
    if (isset($values['start_day']) && isset($values['start_day'])) {
        if($values['start_day_timestamp'] == $values['end_day_timestamp']){
            $date = $values['start_day'];
        }else{
            $date = $values['start_day']." au ".$values['end_day']." ".$values['number_day']." nuits";
        }
        $item->add_meta_data('Date', $date, true);
        $item->add_meta_data('start_day_ts', $values['start_day_timestamp'], true);
        $item->add_meta_data('end_day_ts', $values['end_day_timestamp'], true);
        $item->add_meta_data('start_day_st', $values['start_day'], true);
        $item->add_meta_data('end_day_st', $values['end_day'], true);
    }
}
add_action('woocommerce_checkout_create_order_line_item', 'save_custom_data_to_order_items', 10, 4);

// custom price before caculator in cart
function ctcs_cart_item_price( $wc_cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;
    foreach ( WC()->cart->get_cart() as $key => $cart_item ){        
        if(isset($cart_item['number_day'])){
            $original_price = $cart_item['price'];     
            $price = $original_price*$cart_item['number_day'];
            $cart_item['data']->set_price($price);
        } 
    }
}
add_action( 'woocommerce_before_calculate_totals', 'ctcs_cart_item_price', 20, 1 );

// update stock each day variation hotel of event
function update_stock_each_day_variation_hotel_of_event($order_id) {

    $order = wc_get_order( $order_id );
    $stock_day = [];
    $stock_day_data = [];
    
    foreach ( $order->get_items() as $item_id => $item ) {
        $variation_id = $item->get_variation_id();
        if($variation_id == 0){
            $product_id = $item->get_product_id();
            $event_id = (int) get_post_meta($product_id, 'events_of_product', true);
        }

        if($variation_id != 0){
            $quantity = $item->get_quantity();
            // $start_day_ts = (int) $item->get_meta( 'start_day_ts', true );
            // $end_day_ts = (int) $item->get_meta( 'end_day_ts', true );
            // $total_days = ($end_day_ts - $start_day_ts) / 86400;
            // $quantity_each_day =  quantity_each_day($total_days,$start_day_ts,$quantity);

            $start_day_st = $item->get_meta( 'start_day_st', true );
            $end_day_st = $item->get_meta( 'end_day_st', true );
            $quantity_each_day = quantity_each_day($start_day_st,$end_day_st,$quantity);

            // $start_date = new DateTime($start_day_st);
            // $end_date = new DateTime($end_day_st);

            // $dates = array();
            // while ($start_date < $end_date) {
            //     $dates[] = $start_date->format('d-m-Y');
            //     $start_date->modify('+1 day');
            // }

            // print_r($dates);
            // die();

            $stock_day[] = [
                $variation_id => $quantity_each_day
            ];
        }
    }

    if(!empty($stock_day)){
        $stock_day_data = mergeArray($stock_day);
    }

    session_start();
    if($event_id == 0 || $event_id == ''){
        $event_id = $_SESSION['event_id'];
    }
    $data_hotel_event = get_post_meta($event_id, 'data_hotel_event', true);

    if($data_hotel_event){
        foreach ($data_hotel_event as &$hotel) {
            foreach ($hotel['variations_data'] as &$variation) {
                $variation_id = $variation['variations_id'];
                if (isset($stock_day_data[$variation_id])) {
                    foreach ($variation['date_available'] as $key => &$date_available) {
                        $timestamp = $date_available['date'];
                        if (isset($stock_day_data[$variation_id][$timestamp])) {
                            echo $stock_day_data[$variation_id][$timestamp];
                            $date_available['stock'] -= $stock_day_data[$variation_id][$timestamp];
                            // Remove date_available if stock becomes zero
                            // if ($date_available['stock'] <= 0) {
                            //     unset($variation['date_available'][$key]);
                            // }
                        }
                    }
                    // Re-index the array to maintain numeric keys
                    $variation['date_available'] = array_values($variation['date_available']);
                }
            }
        }        
    }

    update_post_meta($event_id, 'data_hotel_event', $data_hotel_event);
}
// add_action('wp','update_stock_each_day_variation_hotel_of_event');

// quantity each day
function quantity_each_day($start_day_st,$end_day_st,$quantity){
    $stock_day = [];

    $start_date = new DateTime($start_day_st);
    $end_date = new DateTime($end_day_st);

    $dates = array();
    while ($start_date < $end_date) {
        $dates =  $start_date->format('j-m-Y');
        $start_date->modify('+1 day');
        $stock_day[$dates] = $quantity;
    }

    // for ($i = 0; $i < $total_days; $i++) {
    //     $current_day_timestamp = $start_day_timestamp + (86400 * $i);
    //     $stock_day[$current_day_timestamp] = $quantity;
    // }


    // $start_date = new DateTime('2024-05-03');
    // $end_date = new DateTime('2024-05-07');

    // $dates = array();
    // while ($start_date < $end_date) {
    //     $dates[] = $start_date->format('d-m-Y');
    //     $start_date->modify('+1 day');
    // }

    // print_r($dates);


    return $stock_day;
}

// function to merge the array
function mergeArray($array) {
    $result = array();

    foreach ($array as $subArray) {
        foreach ($subArray as $key => $timestamps) {
            if (!isset($result[$key])) {
                $result[$key] = array();
            }

            foreach ($timestamps as $timestamp => $value) {
                if (!isset($result[$key][$timestamp])) {
                    $result[$key][$timestamp] = 0;
                }

                $result[$key][$timestamp] += $value;
            }
        }
    }

    return $result;
}

// admin order css
function admin_order_css(){
    ?>
    <style>
        #order_line_items .item .view tr:nth-child(3),
        #order_line_items .item .view tr:nth-child(4),
        #order_line_items .item .view tr:nth-child(5),
        #order_line_items .item .view tr:nth-child(6){
            display: none !important;
        }
    </style>
    <?php
}
add_action('admin_head','admin_order_css');

// update stock each day variation after checkout
function update_stock_each_day_variation_after_checkout( $order_id, $posted_data, $order ) {
    update_stock_each_day_variation_hotel_of_event($order_id);
    create_invoice_number_order($order_id);
}
add_action( 'woocommerce_checkout_order_processed', 'update_stock_each_day_variation_after_checkout', 10, 3 );

// Add custom CSS to WooCommerce emails
function add_custom_woocommerce_email_styles( $css, $email ) {
    $custom_css = '
        tr td li:nth-child(3),
        tr td li:nth-child(4){
            display: none !important;
        }
    ';
    
    // Append the custom CSS to the existing email CSS
    return $css . $custom_css;
}
add_filter( 'woocommerce_email_styles', 'add_custom_woocommerce_email_styles', 10, 2 );

// is stock add each variation
function is_stock_add_cart($event_id, $variation_id, $hotel_id, $current_day_ts, $start_day_ts, $end_day_ts, $quantity,$quantity_check) {
    $variation_data = get_day_and_stock_variation($event_id, $variation_id, $hotel_id, $current_day_ts, $start_day_ts, $end_day_ts, $quantity);
    $stock_day = stock_day_in_cart($variation_id);
    if($quantity_check == ""){
        return false; 
    }
    foreach ($variation_data as $key => $value) {
        $result = $value - ($stock_day[$key] ?? 0);
        if ($result < 0) {
            return false; 
        }
    }
    return true;
}

// cart quantity change
function cart_quantity_change(){
    $success = false;
    $event_id = isset($_POST['event_id']) ? (int) $_POST['event_id'] : '';
    $variation_id = isset($_POST['variation_id']) ? (int) $_POST['variation_id'] : '';
    $hotel_id = isset($_POST['hotel_id']) ? (int) $_POST['hotel_id'] : '';
    $current_day_ts = isset($_POST['current_day_ts']) ? (int) $_POST['current_day_ts'] : '';
    $start_day_ts = isset($_POST['start_day_ts']) ? (int)$_POST['start_day_ts'] : '';
    $end_day_ts = isset($_POST['end_day_ts']) ? (int) $_POST['end_day_ts'] : '';
    $quantity_old = isset($_POST['quantity_old']) ? (int) $_POST['quantity_old'] : '';
    $quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : '';
    $quantity_check = ($_POST['quantity_check']!="") ? (int) $_POST['quantity_check'] : '';
    $max = ($_POST['max']!="") ? (int) $_POST['max'] : '';
    $id = ($_POST['id']!="") ? $_POST['id'] : '';
    $is_stock_add_cart = is_stock_add_cart($event_id, $variation_id, $hotel_id, $current_day_ts, $start_day_ts, $end_day_ts, $quantity,$quantity_check);
    if($max !="" || $max > 0){
        if($quantity_check <= $max){
            $success = true;
        }
    }else{
        if($is_stock_add_cart == true){
            $success = true;
        }
    }

    if($quantity_old == $quantity_check){
        $success = false;
        $same = true;
    }else{
        $same = false;
    }

    $return = array(
        'success' => $success,
        'same' => $same,
        'id' => $id
    );

    wp_send_json($return);
    die();
}
add_action('wp_ajax_cart_quantity_change', 'cart_quantity_change');
add_action('wp_ajax_nopriv_cart_quantity_change', 'cart_quantity_change');

function create_invoice_number_order($order_id) {
    $order = wc_get_order($order_id); // Use the provided $order_id instead of hardcoding an order ID
    
    foreach ($order->get_items() as $item_id => $item) {
        $variation_id = $item->get_variation_id();
        if ($variation_id == 0) {
            $product_id = $item->get_product_id();
            $event_id = (int) get_post_meta($product_id, 'events_of_product', true);
            break; // Exit the loop once you find the event ID
        }
    }
    
    // Check if $event_id is set before using it
    if (isset($event_id)) {
        $prefix = get_field('prefix', $event_id); // Use get_field directly without empty()
        $prefix = !empty($prefix) ? $prefix : "PREFIX"; // Default prefix if not set
        
        $invoice_number = date("Y") . $prefix . date("m") . $order_id;
        update_post_meta( $order_id, 'invoice_number', $invoice_number );
    }else{
        session_start();
        $event_id = $_SESSION['event_id'];
        $prefix = get_field('prefix', $event_id); // Use get_field directly without empty()
        $prefix = !empty($prefix) ? $prefix : "PREFIX"; // Default prefix if not set
        
        $invoice_number = date("Y") . $prefix . date("m") . $order_id;
        update_post_meta( $order_id, 'invoice_number', $invoice_number );
        update_post_meta( $order_id, 'event_id_of_hotel', $event_id );
    }
    update_post_meta( $order_id, 'event_id_order', $event_id );
}

// get array day timestamp available variation hotel
function get_day_and_stock_variation_hotel($event_id,$variation_id,$hotel_id,$start_day,$end_day){
    $data_hotel_event = get_post_meta($event_id, 'data_hotel_event', true);
    $variation_data = [];
    if(!empty($data_hotel_event)){
        foreach($data_hotel_event as $key => $value){
            if((int)$value['hotel_id'] === $hotel_id ){
                $variations_data = $value['variations_data'];
                if(!empty($variations_data)){
                    foreach($variations_data as $k => $v){
                        if((int)$v['variations_id'] === $variation_id){
                            if(isset($v['date_available'])){
                                $day_available = $v['date_available'];
                                foreach($day_available as $kk => $vl){
                                    $stock = isset($vl['stock']) ? (int) $vl['stock'] : 0;
                                    if($vl['stock'] != 0 && (int)$vl['timestamp'] >= $start_day && (int)$vl['timestamp'] < $end_day){
                                        $variation_data[(int)$vl['timestamp']] = (int) $vl['stock'];
                                    }
                                }
                            } 
                        }
                    }
                }
            } 
        }
    }
    return $variation_data;
}

// sum value
function sumValues(&$array, $index, $key, $value) {
    for ($i = $index + 1; $i < count($array); $i++) {
        if (array_key_exists($key, $array[$i])) {
            $array[$i][$key] += $value;
        }
    }
}

// Function to subtract values of $b from $a
function subtract_arrays($a, $b) {
    $result = array();
    $data_invalid = array();
    
    foreach ($a as $key => $subArray) {
        $result[$key] = array();
        if(empty($subArray)){
            $data_invalid[] = "variation-error-".$key;
        }
        foreach ($subArray as $timestamp => $valueA) {
            $valueB = isset($b[$key][$timestamp]) ? $b[$key][$timestamp] : 0;
            $value = $valueA - $valueB;
            $result[$key][$timestamp] = $value;
            if($value < 0){
                $data_invalid[] = "variation-error-".$key;
            }
        }
    }

    if($data_invalid){
        $data_invalid = array_unique($data_invalid);
    }
    
    return $data_invalid;
}

// check stock checkout
function is_stock_checkout(){
    $cart = WC()->cart;
    $cart_items = $cart->get_cart();
    $event_id = (int) id_ticket_in_cart();
    $i = 0;
    $variation_invalid = [];
    $stock_day_total = [];
    $variation_data_total = [];

    foreach ($cart_items as $cart_item) {
        if ($cart_item['variation_id'] != 0 ) {
            $i++;
            $variation_id  = $cart_item['variation_id'];
            $hotel_id  = $cart_item['hotel_id'];
            $start_day  = $cart_item['start_day_timestamp'];
            $end_day  = $cart_item['end_day_timestamp'];
            $quantity  = $cart_item['quantity'];
            if($event_id == 0 || $event_id == ""){
                $event_id = $cart_item['event_id'];
            }
            $variation_data = get_day_and_stock_variation_hotel($event_id,$variation_id,$hotel_id,$start_day,$end_day);

            $total_days = ($end_day - $start_day) / 86400;
            $stock_day = [];
            for ($i = 0; $i < $total_days; $i++) {
                $current_day_timestamp = $start_day + (86400 * $i);
                $stock_day[$current_day_timestamp] = $quantity;
            }
            $stock_day_total[] = $stock_day;
            $variation_data_total[] = $variation_data;
        }
    }

    foreach ($stock_day_total as $index => &$subArray) {
        foreach ($subArray as $key => $value) {
            sumValues($stock_day_total, $index, $key, $value);
        }
    }

    $result = subtract_arrays($variation_data_total, $stock_day_total);

    return $result;
}

// check stock checkout
function check_stock_checkout(){
    $success = false;
    $is_stock_checkout = is_stock_checkout();

    if(empty($is_stock_checkout)){
        $success = true;
    }

    $return = array(
        'success' => $success,
        'error' => $is_stock_checkout
    );

    wp_send_json($return);
}
add_action('wp_ajax_check_stock_checkout', 'check_stock_checkout');
add_action('wp_ajax_nopriv_check_stock_checkout', 'check_stock_checkout');

// custom button html
function woo_custom_button_html( $button_html ){
	$button_html .= '<a class="checkout-trigger">Place order</a>';
	return $button_html;
}
add_filter( 'woocommerce_order_button_html', 'woo_custom_button_html' );

// modal error checkout
function modal_error_checkout(){
    ?>
    <div class="modal-checkout-error">
        <div class="modal">
            <span class="close">&times;</span>
            <p>Unable to checkout, some booked dates are sold out!</p>
        </div>
    </div>
    <?php
}
add_action('wp_footer','modal_error_checkout');
?>