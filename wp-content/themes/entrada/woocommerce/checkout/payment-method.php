<?php

/**
 * Output a single payment method
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.0
 */
if (!defined('ABSPATH')) {
    exit;
} ?>
<li class="payment_method_<?php echo esc_attr($gateway->id); ?>">
    <header class="title">
        <label class="custom-radio">
            <input id="payment_method_<?php echo esc_attr($gateway->id); ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr($gateway->id); ?>" <?php checked($gateway->chosen, true); ?> data-order_button_text="<?php echo esc_attr($gateway->order_button_text); ?>" />
            <span class="check-input"></span>
            <span class="check-label"><?php
                                        echo sprintf(__('%s', 'entrada'), $gateway->get_title());
                                        ?>

                <?php
                echo sprintf(__('%s', 'entrada'), $gateway->get_icon());
                ?></span>
        </label>
    </header>
    <?php if ($gateway->has_fields() || $gateway->get_description()) : ?>
        <div class="info-hold payment_box payment_method_<?php echo esc_attr($gateway->id); ?>" <?php if (!$gateway->chosen) : ?>style="display:none;" <?php endif; ?>>
            <?php $gateway->payment_fields(); ?>
        </div>
    <?php endif; ?>
</li>