<?php

/**
 * Edit address form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

$page_title = ('billing' === $load_address) ? __('Billing address', 'entrada') : __('Shipping address',  'entrada');

do_action('woocommerce_before_edit_account_address_form'); ?>

<div class="booking-form account-form">
	<div class="top-box">
		<strong class="holder height">
			<span class="left"><?php echo sprintf(__('%s', 'entrada'), $page_title); ?> </span>
			<span class="arrow"></span>
		</strong>
	</div>
	<?php wc_print_notices(); ?>
	<?php if (!$load_address) : ?>
		<?php wc_get_template('myaccount/my-address.php'); ?>
	<?php else : ?>
		<form method="post" class="form-holder">
			<?php do_action("woocommerce_before_edit_address_form_{$load_address}"); ?>

			<?php
				foreach ($address as $key => $field) {
					if (isset($field['country_field'], $address[$field['country_field']])) {
						$field['country'] = wc_get_post_data_by_key($field['country_field'], $address[$field['country_field']]['value']);
					}
					woocommerce_form_field($key, $field, wc_get_post_data_by_key($key, $field['value']));
				}
				?>

			<?php do_action("woocommerce_after_edit_address_form_{$load_address}"); ?>

			<p>
				<div class="btn-holder">
					<input type="submit" class="button" name="save_address" value="<?php esc_attr_e('Save address',  'entrada'); ?>" />
					<?php wp_nonce_field('woocommerce-edit_address'); ?>
					<input type="hidden" name="action" value="edit_address" />
				</div>
			</p>
		</form>
	<?php endif; ?>
</div>

<?php do_action('woocommerce_after_edit_account_address_form'); ?>