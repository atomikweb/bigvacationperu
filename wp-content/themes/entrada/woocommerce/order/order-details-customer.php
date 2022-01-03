<?php

/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

if (!defined('ABSPATH')) {
	exit;
}
$show_shipping = !wc_ship_to_billing_address_only() && $order->needs_shipping_address();

?>

<h3><?php _e('Customer Details', 'entrada'); ?></h3>

<div class="form-holder form-holder-details">
	<div class="table-responsive">
		<table class="table no-border woocommerce-table woocommerce-table--customer-details shop_table customer_details">

			<?php if ($order->get_customer_note()) : ?>
				<tr>
					<th><?php _e('Note:', 'entrada'); ?></th>
					<td><?php echo wptexturize($order->get_customer_note()); ?></td>
				</tr>
			<?php endif; ?>

			<?php if ($order->get_billing_email()) : ?>
				<tr>
					<th><?php _e('Email:', 'entrada'); ?></th>
					<td><?php echo esc_html($order->get_billing_email(), 'entrada'); ?></td>
				</tr>
			<?php endif; ?>

			<?php if ($order->get_billing_phone()) : ?>
				<tr>
					<th><?php _e('Phone:', 'entrada'); ?></th>
					<td><?php echo esc_html($order->get_billing_phone(), 'entrada'); ?></td>
				</tr>
			<?php endif; ?>

			<?php do_action('woocommerce_order_details_after_customer_details', $order); ?>

		</table>
	</div>
</div>

<?php if (!wc_ship_to_billing_address_only() && $order->needs_shipping_address()) : ?>
	<div class="form-holder form-holder-details">
		<div class="col2-set addresses">
			<div class="col-1">
			<?php endif; ?>
			<h3><?php _e('Billing Address', 'entrada'); ?></h3>
			<address><?php ($address = $order->get_formatted_billing_address()) ? $address : 'N/A';
						echo sprintf(__('%s', 'entrada'), $address);

						?></address>
			<?php if (!wc_ship_to_billing_address_only() && $order->needs_shipping_address()) : ?>
			</div><!-- /.col-1 -->
			<div class="col-2">
				<header class="title">
					<h2 class="small-size"><?php _e('Shipping Address', 'entrada'); ?></h2>
				</header>
				<address><?php ($address = $order->get_formatted_shipping_address()) ? $address : 'N/A';
								echo sprintf(__('%s', 'entrada'), $address); ?></address>
			</div><!-- /.col-2 -->
		</div>
	</div><!-- /.col2-set -->

<?php endif; ?>
<?php do_action('woocommerce_order_details_after_customer_details', $order); ?>