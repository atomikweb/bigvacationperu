<?php

/**
 * My Orders
 *
 * Shows recent orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */
if (!defined('ABSPATH')) {
    exit;
}
$my_orders_columns = apply_filters('woocommerce_my_account_my_orders_columns', array(
    'order-number'  => __('Order', 'entrada'),
    'order-date'    => __('Date', 'entrada'),
    'order-status'  => __('Status', 'entrada'),
    'order-total'   => __('Total', 'entrada'),
    'order-actions' => '&nbsp;',
));
$customer_orders = get_posts(apply_filters('woocommerce_my_account_my_orders_query', array(
    'numberposts' => $order_count,
    'meta_key'    => '_customer_user',
    'meta_value'  => get_current_user_id(),
    'post_type'   => wc_get_order_types('view-orders'),
    'post_status' => array_keys(wc_get_order_statuses())
)));
if ($customer_orders) : ?>
    <div class="order-block">
        <h3><?php echo apply_filters('woocommerce_my_account_my_orders_title', __('Recent Orders', 'entrada')); ?></h3>
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <?php foreach ($my_orders_columns as $column_id => $column_name) : ?>
                                <th class="<?php echo esc_attr($column_id); ?>"><span class="nobr"><?php echo esc_html($column_name, 'entrada'); ?></span></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($customer_orders as $customer_order) :
                                $order      = wc_get_order($customer_order);
                                $item_count = $order->get_item_count(); ?>
                            <tr class="order">
                                <?php foreach ($my_orders_columns as $column_id => $column_name) : ?>
                                    <td class="<?php echo esc_attr($column_id); ?>" data-title="<?php echo esc_attr($column_name); ?>">
                                        <?php
                                                    if (has_action('woocommerce_my_account_my_orders_column_' . $column_id)) {
                                                        do_action('woocommerce_my_account_my_orders_column_' . $column_id, $order);
                                                    } else if ('order-number' === $column_id) { ?>
                                            <a href="<?php echo esc_url($order->get_view_order_url()); ?>">
                                                <?php echo _x('#', 'hash before order number', 'entrada') . $order->get_order_number(); ?>
                                            </a>
                                        <?php
                                                    } else if ('order-date' === $column_id) { ?>
                                            <time datetime="<?php echo date('Y-m-d', strtotime($order->order_date)); ?>" title="<?php echo esc_attr(strtotime($order->order_date)); ?>"><?php echo date_i18n(get_option('date_format'), strtotime($order->order_date)); ?></time>
                                        <?php
                                                    } else if ('order-status' === $column_id) {
                                                        echo wc_get_order_status_name($order->get_status());
                                                    } else if ('order-total' === $column_id) {
                                                        echo sprintf(_n('%s for %s item', '%s for %s items', $item_count, 'entrada'), $order->get_formatted_order_total(), $item_count);
                                                    } else if ('order-actions' === $column_id) {
                                                        $actions = array(
                                                            'pay' => array(
                                                                'url'  => $order->get_checkout_payment_url(),
                                                                'name' => __('Pay', 'entrada')
                                                            ),
                                                            'view' => array(
                                                                'url'  => $order->get_view_order_url(),
                                                                'name' => __('View', 'entrada')
                                                            ),
                                                            'cancel' => array(
                                                                'url'  => $order->get_cancel_order_url(wc_get_page_permalink('myaccount')),
                                                                'name' => __('Cancel', 'entrada')
                                                            )
                                                        );
                                                        if (!$order->needs_payment()) {
                                                            unset($actions['pay']);
                                                        }
                                                        if (!in_array($order->get_status(), apply_filters('woocommerce_valid_order_statuses_for_cancel', array('pending', 'failed'), $order))) {
                                                            unset($actions['cancel']);
                                                        }
                                                        if ($actions = apply_filters('woocommerce_my_account_my_orders_actions', $actions, $order)) {
                                                            foreach ($actions as $key => $action) {
                                                                echo '<a href="' . esc_url($action['url']) . '" class="btn btn-default btn-h-slide ' . sanitize_html_class($key) . '">' . esc_html($action['name'], 'entrada') . '</a>';
                                                            }
                                                        }
                                                    } ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>