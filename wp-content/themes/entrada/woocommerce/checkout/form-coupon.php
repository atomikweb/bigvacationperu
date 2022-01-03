<?php

/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

defined('ABSPATH') || exit;

if (!wc_coupons_enabled()) { // @codingStandardsIgnoreLine.
    return;
}

?>
<div class="top-box">
    <a href="#" class="showcoupon holder height">
        <span class="left"><?php _e('Have a Promotional Coupon?',  'entrada'); ?></span>
        <span class="right"><?php _e('Enter Coupon',  'entrada'); ?></span>
        <span class="arrow"></span>
    </a>
</div>
<form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">
    <div class="form-holder checkout-form-slide">
        <p><?php esc_html_e('Enter your Coupon Code',  'entrada'); ?></p>
        <div class="row">
            <div class="col-md-6">
                <div class="hold">
                    <input type="text" name="coupon_code" class="form-control" placeholder="<?php esc_attr_e('Coupon code', 'entrada'); ?>" id="coupon_code" value="" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="hold">
                    <input type="submit" class="btn btn-default" name="apply_coupon" value="<?php esc_attr_e('Apply Coupon', 'entrada'); ?>" />
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</form>