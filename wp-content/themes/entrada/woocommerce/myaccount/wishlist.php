<?php

/**
 * Wishlist page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/wishlist.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.6
 */


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
wc_print_notices(); ?>


<div class="booking-form">
    <div class="top-box">
        <strong class="holder height">
            <span class="left"><?php _e('My Wishlist',  'entrada'); ?> </span>
            <span class="arrow"></span>
        </strong>
    </div>
    <?php do_action('woocommerce_before_my_account'); ?>
    <?php global $wpdb;
    $current_user = wp_get_current_user();
    $sql = "SELECT * FROM " . $wpdb->prefix . "entrada_wishlist WHERE 1 = 1 ";
    $sql .= " and user_id=" . $current_user->ID . " order by added_date DESC ";
    $result = $wpdb->get_results($sql);
    if ($result) {  ?>
        <div class="cart-holder table-container">
            <div class="table-responsive">
                <table class="table table-hover table-align-right">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>
                                <strong class="date-text"><?php _e('Selected Tours',  'entrada'); ?></strong>
                                <span class="sub-text"><?php _e('Added Dates',  'entrada'); ?></span>
                            </th>
                            <th>
                                <strong class="date-text"><?php _e('Price',  'entrada'); ?>(PP)</strong>
                                <span class="sub-text"><?php _e('Updated Today',  'entrada'); ?></span>
                            </th>
                            <th>
                                <strong class="date-text"><?php _e('Action',  'entrada'); ?></strong>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($result as $entry) {
                                $post_type = get_post_type($entry->post_id); ?>
                            <tr id="row_<?php echo esc_attr($entry->post_id); ?>" <?php if ('product' == $post_type) {
                                                                                                echo 'itemscope itemtype="http://schema.org/Product"';
                                                                                            } ?>>
                                <td>
                                    <div class="cell">
                                        <div class="middle">
                                            <a class="delete" href="javascript:void(null);" onClick="remove_wishlist(<?php echo esc_attr($entry->post_id); ?>);">
                                                <span class="icon-trash"></span>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="cell">
                                        <div class="middle">
                                            <div class="info">
                                                <div class="img-wrap">
                                                    <?php
                                                            if (has_post_thumbnail($entry->post_id)) :
                                                                echo get_the_post_thumbnail($entry->post_id, array(50, 50));
                                                            endif; ?>
                                                </div>
                                                <div class="text-wrap">
                                                    <strong class="product-title"><?php echo get_the_title($entry->post_id); ?></strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="cell" <?php if ('product' == $post_type) {
                                                                    echo entrada_price_schema_micro_data_link($entry->post_id);
                                                                } ?>>
                                        <div class="middle">
                                            <span class="txt">
                                                <?php
                                                        $price = ('post' == $post_type ? '-' : entrada_product_price_wishlist($entry->post_id, false));
                                                        echo sprintf(__('%s', 'entrada'), $price); ?>
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="cell">
                                        <div class="middle">
                                            <?php
                                                    if ('post' == $post_type) { ?>
                                                <a href="<?php echo esc_url(get_permalink($entry->post_id)); ?>" class="btn btn-default btn-h-slide"><?php _e('VIEW BLOG',  'entrada'); ?></a>
                                                <?php
                                                        } else {
                                                            $_product = wc_get_product($entry->post_id);
                                                            if ($_product->is_type('external')) {
                                                                $_product_url = get_post_meta($entry->post_id, '_product_url', true);
                                                                $_button_text = get_post_meta($entry->post_id, '_button_text', true);
                                                                echo '<a href="' . $_product_url . '" class="btn btn-default btn-h-slide">' . $_button_text . '</a>';
                                                            } else { ?>
                                                    <form class="cart" method="post" enctype="multipart/form-data">
                                                        <input type="hidden" name="quantity" value="1" title="Qty" class="input-text qty text">
                                                        <input type="hidden" name="add-to-cart" value="<?php echo esc_attr($entry->post_id); ?>">
                                                        <?php
                                                                        $attr = entrada_product_variation_detail_wishlist($entry->post_id);
                                                                        if ($attr['is_variation'] == true) { ?>
                                                            <input type="hidden" name="attribute_<?php echo esc_attr($attr['attribute']); ?>">
                                                            <input type="hidden" name="variation_id" value="<?php echo esc_attr($attr['variation_id']); ?>">
                                                        <?php } ?>
                                                        <button type="submit" class="btn btn-default btn-h-slide"><?php _e('BOOK NOW',  'entrada'); ?></button>
                                                    </form>
                                            <?php
                                                        }
                                                    } ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php
    } else {
        echo '<table class="table table-hover">';
        echo '<tbody><tr><td><div class="cell"><div class="middle">' . __('No record found in wishlist.', 'entrada') . '</div></div></td></tr></tbody>';
        echo '</table>';
    }
    do_action('woocommerce_after_my_account'); ?>
</div>