<?php
/**
 * Copyright © Lyra Network and contributors.
 * This file is part of Systempay plugin for WooCommerce. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @author    Geoffrey Crofte, Alsacréations (https://www.alsacreations.fr/)
 * @copyright Lyra Network and contributors
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL v2)
 */

/**
 * Plugin Name: Systempay for WooCommerce
 * Description: This plugin links your WordPress WooCommerce shop to the payment gateway.
 * Author: Lyra Network
 * Contributors: Alsacréations (Geoffrey Crofte http://alsacreations.fr/a-propos#geoffrey)
 * Version: 1.13.1
 * Author URI: https://www.lyra.com/
 * License: GPLv2 or later
 * Requires at least: 3.5
 * Tested up to: 6.5
 * WC requires at least: 2.0
 * WC tested up to: 8.8
 *
 * Text Domain: woo-systempay-payment
 * Domain Path: /languages/
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Automattic\WooCommerce\Blocks\Payments\PaymentMethodRegistry;
use Lyranetwork\Systempay\Sdk\Refund\Api as SystempayRefundApi;
use Lyranetwork\Systempay\Sdk\Refund\OrderInfo as SystempayOrderInfo;

define('WC_SYSTEMPAY_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WC_SYSTEMPAY_PLUGIN_PATH', untrailingslashit(plugin_dir_path(__FILE__)));

/* A global var to easily enable/disable features. */
global $systempay_plugin_features;

$systempay_plugin_features = array(
    'qualif' => false,
    'prodfaq' => true,
    'restrictmulti' => false,
    'shatwo' => true,
    'embedded' => true,
    'smartform' => true,
    'subscr' => true,
    'support' => true,

    'multi' => true,
    'choozeo' => false,
    'klarna' => false,
    'franfinance' => false
);

/* Check requirements. */
function woocommerce_systempay_activation()
{
    $all_active_plugins = get_option('active_plugins');
    if (is_multisite()) {
        $all_active_plugins = array_merge($all_active_plugins, wp_get_active_network_plugins());
    }

    $all_active_plugins = apply_filters('active_plugins', $all_active_plugins);

    if (! stripos(implode('', $all_active_plugins), '/woocommerce.php')) {
        deactivate_plugins(plugin_basename(__FILE__)); // Deactivate ourself.

        // Load translation files.
        load_plugin_textdomain('woo-systempay-payment', false, plugin_basename(dirname(__FILE__)) . '/languages');

        $message = sprintf(__('Sorry ! In order to use WooCommerce %s Payment plugin, you need to install and activate the WooCommerce plugin.', 'woo-systempay-payment'), 'Systempay');
        wp_die($message, 'Systempay for WooCommerce', array('back_link' => true));
    }
}
register_activation_hook(__FILE__, 'woocommerce_systempay_activation');

/* Delete all data when uninstalling plugin. */
function woocommerce_systempay_uninstallation()
{
    delete_option('woocommerce_systempay_settings');
    delete_option('woocommerce_systempaystd_settings');
    delete_option('woocommerce_systempaymulti_settings');
    delete_option('woocommerce_systempaychoozeo_settings');
    delete_option('woocommerce_systempayklarna_settings');
    delete_option('woocommerce_systempayfranfinance_settings');
    delete_option('woocommerce_systempayregroupedother_settings');
    delete_option('woocommerce_systempaysubscription_settings');
    delete_option('woocommerce_systempaywcssubscription_settings');
}
register_uninstall_hook(__FILE__, 'woocommerce_systempay_uninstallation');

/* Include gateway classes. */
function woocommerce_systempay_init()
{
    global $systempay_plugin_features;

    // Load translation files.
    load_plugin_textdomain('woo-systempay-payment', false, plugin_basename(dirname(__FILE__)) . '/languages');

    if (! class_exists('Systempay_Subscriptions_Loader')) { // Load subscriptions processing mecanism.
        require_once 'includes/subscriptions/systempay-subscriptions-loader.php';
    }

    if (! class_exists('WC_Gateway_Systempay')) {
        require_once 'class-wc-gateway-systempay.php';
    }

    if (! class_exists('WC_Gateway_SystempayStd')) {
        require_once 'class-wc-gateway-systempaystd.php';
    }

    if ($systempay_plugin_features['multi'] && ! class_exists('WC_Gateway_SystempayMulti')) {
        require_once 'class-wc-gateway-systempaymulti.php';
    }

    if ($systempay_plugin_features['choozeo'] && ! class_exists('WC_Gateway_SystempayChoozeo')) {
        require_once 'class-wc-gateway-systempaychoozeo.php';
    }

    if ($systempay_plugin_features['klarna'] && ! class_exists('WC_Gateway_SystempayKlarna')) {
        require_once 'class-wc-gateway-systempayklarna.php';
    }

    if ($systempay_plugin_features['franfinance'] && ! class_exists('WC_Gateway_SystempayFranfinance')) {
        require_once 'class-wc-gateway-systempayfranfinance.php';
    }

    if (! class_exists('WC_Gateway_SystempayRegroupedOther')) {
        require_once 'class-wc-gateway-systempayregroupedother.php';
    }

    if (! class_exists('WC_Gateway_SystempayOther')) {
        require_once 'class-wc-gateway-systempayother.php';
    }

    if ($systempay_plugin_features['subscr'] && ! class_exists('WC_Gateway_SystempaySubscription')) {
        require_once 'class-wc-gateway-systempaysubscription.php';
    }

    if (! class_exists('WC_Gateway_SystempayWcsSubscription')) {
        require_once 'class-wc-gateway-systempaywcssubscription.php';
    }

    require_once 'includes/sdk-autoload.php';
    require_once 'includes/SystempayRestTools.php';
    require_once 'includes/SystempayTools.php';

    // Restore WC notices in case of IFRAME or POST as return mode.
    WC_Gateway_Systempay::restore_wc_notices();
}
add_action('woocommerce_init', 'woocommerce_systempay_init');

function woocommerce_systempay_woocommerce_block_support()
{
    if (class_exists('Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType')) {
        require_once 'includes/SystempayTools.php';
        if (! SystempayTools::has_checkout_block()) {
            return;
        }

        if (! class_exists('WC_Gateway_Systempay_Blocks_Support')) {
            require_once 'includes/class-wc-gateway-systempay-blocks-support.php';
        }

        add_action(
            'woocommerce_blocks_payment_method_type_registration',
            function(PaymentMethodRegistry $payment_method_registry) {
                global $systempay_plugin_features;

                $payment_method_registry->register(new WC_Gateway_Systempay_Blocks_Support('systempaystd'));

                if ($systempay_plugin_features['multi']) {
                    $payment_method_registry->register(new WC_Gateway_Systempay_Blocks_Support('systempaymulti'));
                }

                if ($systempay_plugin_features['franfinance']) {
                    $payment_method_registry->register(new WC_Gateway_Systempay_Blocks_Support('systempayfranfinance'));
                }

                if ($systempay_plugin_features['klarna']) {
                    $payment_method_registry->register(new WC_Gateway_Systempay_Blocks_Support('systempayklarna'));
                }

                if ($systempay_plugin_features['subscr']) {
                    $payment_method_registry->register(new WC_Gateway_Systempay_Blocks_Support('systempaysubscription'));
                }

                $payment_method_registry->register(new WC_Gateway_Systempay_Blocks_Support('systempaywcssubscription'));

                $payment_method_registry->register(new WC_Gateway_Systempay_Blocks_Support('systempayregroupedother'));

                if (get_transient('systempay_other_methods')) {
                    $methods = json_decode(get_transient('systempay_other_methods'), true);

                    // Virtual method to display non regrouped other payment means.
                    $payment_method_registry->register(
                        new WC_Gateway_Systempay_Blocks_Support('systempayother_lyranetwork')
                    );

                    foreach ($methods as $code => $label) {
                        $payment_method_registry->register(
                            new WC_Gateway_Systempay_Blocks_Support('systempayother_' . $code, $label)
                        );
                    }
                }
             }
        );
    }
}

add_action('woocommerce_blocks_loaded', 'woocommerce_systempay_woocommerce_block_support');

/* Add our payment methods to WooCommerce methods. */
function woocommerce_systempay_add_method($methods)
{
    global $systempay_plugin_features, $woocommerce;

    $methods[] = 'WC_Gateway_Systempay';
    $methods[] = 'WC_Gateway_SystempayStd';

    if ($systempay_plugin_features['multi']) {
        $methods[] = 'WC_Gateway_SystempayMulti';
    }

    if ($systempay_plugin_features['choozeo']) {
        $methods[] = 'WC_Gateway_SystempayChoozeo';
    }

    if ($systempay_plugin_features['klarna']) {
        $methods[] = 'WC_Gateway_SystempayKlarna';
    }

    if ($systempay_plugin_features['franfinance']) {
        $methods[] = 'WC_Gateway_SystempayFranfinance';
    }

    $methods[] = 'WC_Gateway_SystempayWcsSubscription';

    if ($systempay_plugin_features['subscr']) {
        $methods[] = 'WC_Gateway_SystempaySubscription';
    }

    $methods[] = 'WC_Gateway_SystempayRegroupedOther';

    if (get_transient('systempay_other_methods') && ! is_admin()) {
        $other_methods = json_decode(get_transient('systempay_other_methods'), true);

        foreach ($other_methods as $code => $label) {
            $methods[] = new WC_Gateway_SystempayOther($code, $label);
        }
    }

    // Since 2.3.0, we can display other payment means as submodules.
    if (version_compare($woocommerce->version, '2.3.0', '>=') && $woocommerce->cart) {
        $regrouped_other_payments = new WC_Gateway_SystempayRegroupedOther(false);

        if (! $regrouped_other_payments->regroup_other_payment_means()) {
            $systempay_other_methods = array();
            $payment_means = $regrouped_other_payments->get_available_options();

            if (is_array($payment_means) && ! empty($payment_means)) {
                foreach ($payment_means as $option) {
                    $systempay_other_methods[$option['payment_mean']] =  $option['label'];
                }
            }

            set_transient('systempay_other_methods', json_encode($systempay_other_methods));
        } else {
            delete_transient('systempay_other_methods');
        }
    }

    return $methods;
}
add_filter('woocommerce_payment_gateways', 'woocommerce_systempay_add_method');

/* Add a link to plugin settings page from plugins list. */
function woocommerce_systempay_add_link($links, $file)
{
    global $systempay_plugin_features;

    $links[] = '<a href="' . systempay_admin_url('Systempay') . '">' . __('General configuration', 'woo-systempay-payment') . '</a>';
    $links[] = '<a href="' . systempay_admin_url('SystempayStd') . '">' . __('Standard payment', 'woo-systempay-payment') . '</a>';

    if ($systempay_plugin_features['multi']) {
        $links[] = '<a href="' . systempay_admin_url('SystempayMulti') . '">' . __('Payment in installments', 'woo-systempay-payment')
            . '</a>';
    }

    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'woocommerce_systempay_add_link', 10, 2);

function systempay_admin_url($id)
{
    global $woocommerce;

    $base_url = 'admin.php?page=wc-settings&tab=checkout&section=';
    $section = strtolower($id); // Method id in lower case.

    // Backward compatibility.
    if (version_compare($woocommerce->version, '2.1.0', '<')) {
        $base_url = 'admin.php?page=woocommerce_settings&tab=payment_gateways&section=';
        $section = 'WC_Gateway_' . $id; // Class name as it is.
    } elseif (version_compare($woocommerce->version, '2.6.2', '<')) {
        $section = 'wc_gateway_' . $section; // Class name in lower case.
    }

    return admin_url($base_url . $section);
}

function woocommerce_systempay_order_payment_gateways($available_gateways)
{
    global $woocommerce;
    $index_other_not_grouped_gateways_ids = array();
    $index_other_grouped_gateway_id = null;
    $gateways_ids = array();
    $index_gateways_ids = 0;
    foreach ($woocommerce->payment_gateways()->payment_gateways as $gateway) {
        if ($gateway->id === 'systempayregroupedother') {
            $index_other_grouped_gateway_id = $index_gateways_ids;
        } elseif (strpos($gateway->id, 'systempayother_') === 0) {
            $index_other_not_grouped_gateways_ids[] = $index_gateways_ids;
        }

        $gateways_ids[] = $gateway->id;
        $index_gateways_ids ++;
    }

    // Reorder custom Systempay non-grouped other payment means as they appear in WooCommerce backend.
    // And if only they are not already in last position.
    if (! empty($index_other_not_grouped_gateways_ids) && ($index_other_grouped_gateway_id !== reset($index_other_not_grouped_gateways_ids) - 1)) {
        $ordered_gateways_ids = array();
        for ($i = 0; $i < $index_other_grouped_gateway_id; $i++) {
            $ordered_gateways_ids[] = $gateways_ids[$i];
        }

        foreach ($index_other_not_grouped_gateways_ids as $index_not_grouped_other_id) {
            $ordered_gateways_ids[] = $gateways_ids[$index_not_grouped_other_id];
        }

        for ($i = $index_other_grouped_gateway_id + 1; $i < count($gateways_ids); $i++) {
            if (! in_array($i, $index_other_not_grouped_gateways_ids)) {
                $ordered_gateways_ids[] = $gateways_ids[$i];
            }
        }

        $ordered_gateways = array();
        foreach ($ordered_gateways_ids as $gateway_id) {
            if (isset($available_gateways[$gateway_id])) {
                $ordered_gateways[$gateway_id] = $available_gateways[$gateway_id];
            }
        }

        return $ordered_gateways;
    }

    return $available_gateways;
}
add_filter('woocommerce_available_payment_gateways', 'woocommerce_systempay_order_payment_gateways');

function systempay_send_support_email_on_order($order)
{
    global $systempay_plugin_features;

    $std_payment_method = new WC_Gateway_SystempayStd();
    if (substr(WC_Gateway_SystempayStd::get_order_property($order, 'payment_method'), 0, strlen('systempay')) === 'systempay') {
        $user_info = get_userdata(1);
        if (! ($user_info instanceof WP_User)) {
            $user_info = wp_get_current_user();
        }

        $send_email_url = add_query_arg('wc-api', 'WC_Gateway_Systempay_Send_Email', home_url('/'));

        $systempay_email_send_msg = get_transient('systempay_email_send_msg');
        if ($systempay_email_send_msg) {
            echo $systempay_email_send_msg;

            delete_transient('systempay_email_send_msg');
        }

        $systempay_update_subscription_error_msg = get_transient('systempay_update_subscription_error_msg');
        $systempay_renewal_error_msg = get_transient('systempay_renewal_error_msg');

        if ($systempay_plugin_features['support']) {
        ?>
        <script type="text/javascript" src="<?php echo WC_SYSTEMPAY_PLUGIN_URL; ?>assets/js/support.js"></script>
        <contact-support
            shop-id="<?php echo $std_payment_method->get_general_option('site_id'); ?>"
            context-mode="<?php echo $std_payment_method->get_general_option('ctx_mode'); ?>"
            sign-algo="<?php echo $std_payment_method->get_general_option('sign_algo'); ?>"
            contrib="<?php echo SystempayTools::get_contrib(); ?>"
            integration-mode="<?php echo SystempayTools::get_integration_mode(); ?>"
            plugins="<?php echo SystempayTools::get_active_plugins(); ?>"
            title=""
            first-name="<?php echo $user_info->first_name; ?>"
            last-name="<?php echo $user_info->last_name; ?>"
            from-email="<?php echo get_option('admin_email'); ?>"
            to-email="<?php echo WC_Gateway_Systempay::SUPPORT_EMAIL; ?>"
            cc-emails=""
            phone-number=""
            language="<?php echo SystempayTools::get_support_component_language(); ?>"
            is-order="true"
            transaction-uuid="<?php echo SystempayTools::get_transaction_uuid($order); ?>"
            order-id="<?php echo WC_Gateway_SystempayStd::get_order_property($order, 'id'); ?>"
            order-number="<?php echo WC_Gateway_SystempayStd::get_order_property($order, 'id'); ?>"
            order-status=<?php echo WC_Gateway_SystempayStd::get_order_property($order, 'status'); ?>
            order-date="<?php echo WC_Gateway_SystempayStd::get_order_property($order, 'date_created'); ?>"
            order-amount="<?php echo WC_Gateway_SystempayStd::get_order_property($order, 'total') . ' ' . WC_Gateway_SystempayStd::get_order_property($order, 'currency'); ?>"
            cart-amount=""
            shipping-fees="<?php echo WC_Gateway_SystempayStd::get_order_property($order, 'shipping_total') . ' ' . WC_Gateway_SystempayStd::get_order_property($order, 'currency'); ?>"
            order-discounts="<?php echo SystempayTools::get_used_discounts($order); ?>"
            order-carrier="<?php echo WC_Gateway_SystempayStd::get_order_property($order, 'shipping_method'); ?>"></contact-support>
        <?php
            // Load css and add spinner.
            wp_register_style('systempay', WC_SYSTEMPAY_PLUGIN_URL . 'assets/css/systempay.css', array(),  WC_Gateway_Systempay::PLUGIN_VERSION);
            wp_enqueue_style('systempay');
        }
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function() {
              <?php if ($systempay_plugin_features['support']) { ?>
                jQuery('contact-support').on('sendmail', function(e) {
                    jQuery('body').block({
                        message: null,
                        overlayCSS: {
                            background: '#fff',
                            opacity: 0.5
                        }
                    });

                    jQuery('div.blockUI.blockOverlay').css('cursor', 'default');

                    jQuery.ajax({
                        method: 'POST',
                        url: '<?php echo $send_email_url; ?>',
                        data: e.originalEvent.detail,
                        success: function(data) {
                            location.reload();
                        }
                    });
                });
        <?php
            }

            //$systempay_renewal_subscription_error_msg
            if ($systempay_update_subscription_error_msg) {
                delete_transient('systempay_update_subscription_error_msg');
        ?>
                jQuery('#lost-connection-notice').after('<div class="error notice is-dismissible"><p><?php echo addslashes($systempay_update_subscription_error_msg); ?></p><button type="button" class="notice-dismiss" onclick="this.parentElement.remove()"><span class="screen-reader-text"><?php echo esc_html__('Dismiss this notice.', 'woocommerce') ?></span></button></div>');
            <?php
            }
            if ($systempay_renewal_error_msg) {
                delete_transient('systempay_renewal_error_msg');
                ?>
                    jQuery('#lost-connection-notice').after('<div class="error notice is-dismissible"><p><?php echo addslashes($systempay_renewal_error_msg); ?></p><button type="button" class="notice-dismiss" onclick="this.parentElement.remove()"><span class="screen-reader-text"><?php echo esc_html__('Dismiss this notice.', 'woocommerce') ?></span></button></div>');
            <?php } ?>
            });
        </script>
        <?php
    }
}
// Add contact support link to order details page.
add_action('woocommerce_admin_order_data_after_billing_address', 'systempay_send_support_email_on_order');

function systempay_send_email()
{
    if (isset($_POST['submitter']) && $_POST['submitter'] === 'systempay_send_support') {
        $msg = '';
        if (isset($_POST['sender']) && isset($_POST['subject']) && isset($_POST['message'])) {
            $recipient = WC_Gateway_Systempay::SUPPORT_EMAIL;
            $subject = $_POST['subject'];
            $content = $_POST['message'];
            $headers = array('Content-Type: text/html; charset=UTF-8');

            if (wp_mail($recipient, $subject, $content, $headers)) {
                $msg = '<div class="inline updated"><p><strong>' . __('Thank you for contacting us. Your email has been successfully sent.', 'woo-systempay-payment') . '</strong></p></div>';
            } else {
                $msg = '<div class="inline error"><p><strong>' . __('An error has occurred. Your email was not sent.', 'woo-systempay-payment') . '</strong></p></div>';
            }
        } else {
            $msg = '<div class="inline error"><p><strong>' . __('Please make sure to configure all required fields.', 'woo-systempay-payment') . '</strong></p></div>';
        }

        set_transient('systempay_email_send_msg', $msg);
    }

    echo json_encode(array('success' => true));
    die();
}
// Send support email.
add_action('woocommerce_api_wc_gateway_systempay_send_email', 'systempay_send_email');

/* Retrieve blog_id from POST when this is an IPN URL call. */
require_once 'includes/sdk-autoload.php';
require_once 'includes/SystempayRestTools.php';

if (SystempayRestTools::checkResponse($_POST)) {
    $answer = json_decode($_POST['kr-answer'], true);
    $data = SystempayRestTools::convertRestResult($answer);
    $is_valid_ipn = isset($data['vads_ext_info_blog_id']);
} else {
    $is_valid_ipn = isset($_POST['vads_hash']) && isset($_POST['vads_ext_info_blog_id']);
}

if (is_multisite() && $is_valid_ipn) {
    global $wpdb, $current_blog, $current_site;

    $blog = isset($_POST['vads_ext_info_blog_id']) ? $_POST['vads_ext_info_blog_id'] : $data['vads_ext_info_blog_id'];
    switch_to_blog((int) $blog);

    // Set current_blog global var.
    $current_blog = $wpdb->get_row(
        $wpdb->prepare("SELECT * FROM $wpdb->blogs WHERE blog_id = %s", $blog)
    );

    // Set current_site global var.
    $network_fnc = function_exists('get_network') ? 'get_network' : 'wp_get_network';
    $current_site = $network_fnc($current_blog->site_id);
    $current_site->blog_id = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT blog_id FROM $wpdb->blogs WHERE domain = %s AND path = %s",
            $current_site->domain,
            $current_site->path
        )
    );

    $current_site->site_name = get_site_option('site_name');
    if (! $current_site->site_name) {
        $current_site->site_name = ucfirst($current_site->domain);
    }
}

function systempay_launch_online_refund($order, $refund_amount, $refund_currency)
{
    // Prepare order information for refund.
    require_once 'includes/sdk-autoload.php';
    require_once 'includes/SystempayRefundProcessor.php';

    $order_info = new SystempayOrderInfo();
    $order_info->setOrderRemoteId($order->get_id());
    $order_info->setOrderId($order->get_id());
    $order_info->setOrderReference($order->get_order_number());
    $order_info->setOrderCurrencyIsoCode($refund_currency);
    $order_info->setOrderCurrencySign(html_entity_decode(get_woocommerce_currency_symbol($refund_currency)));
    $order_info->setOrderUserInfo(SystempayTools::get_user_info());
    $refund_processor = new SystempayRefundProcessor();

    $std_payment_method = new WC_Gateway_SystempayStd();

    $test_mode = $std_payment_method->get_general_option('ctx_mode') == 'TEST';
    $key = $test_mode ? $std_payment_method->get_general_option('test_private_key') : $std_payment_method->get_general_option('prod_private_key');

    $refund_api = new SystempayRefundApi(
        $refund_processor,
        $key,
        $std_payment_method->get_general_option('rest_url'),
        $std_payment_method->get_general_option('site_id'),
        'WooCommerce'
    );

    // Do online refund.
    $refund_api->refund($order_info, $refund_amount);
}

function systempay_display_refund_result_message($order_id)
{
    $systempay_online_refund_result = get_transient('systempay_online_refund_result');

    if ($systempay_online_refund_result) {
        echo $systempay_online_refund_result;

        delete_transient('systempay_online_refund_result');
    }
}

// Display online refund result message.
add_action('woocommerce_admin_order_totals_after_discount', 'systempay_display_refund_result_message', 10, 1);

function systempay_features_compatibility()
{
    if (class_exists(\Automattic\WooCommerce\Utilities\FeaturesUtil::class)) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility('custom_order_tables', __FILE__, true);
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility('cart_checkout_blocks', __FILE__, true);
    }
}

// Declaring HPOS compatibility.
add_action('before_woocommerce_init', 'systempay_features_compatibility');

function systempay_online_refund($order_id, $refund_id)
{
    // Check if order was passed with other payment means submodule.
    $order = new WC_Order((int) $order_id);
    if (substr($order->get_payment_method(), 0, strlen('systempayother_')) !== 'systempayother_') {
        return;
    }

    $refund = new WC_Order_Refund((int) $refund_id);

    // Do online refund.
    systempay_launch_online_refund($order, $refund->get_amount(), $refund->get_currency());
}

// Do online refund after local refund.
add_action('woocommerce_order_refunded', 'systempay_online_refund', 10 , 2);

function systempay_online_cancel($order_id)
{
    $order = new WC_Order((int) $order_id);
    if (substr($order->get_payment_method(), 0, strlen('systempay')) !== 'systempay') {
        return;
    }

    systempay_launch_online_refund($order, $order->get_total(), $order->get_currency());
}

// Do online cancel after local cancellation.
add_action('woocommerce_cancelled_order', 'systempay_online_cancel');
