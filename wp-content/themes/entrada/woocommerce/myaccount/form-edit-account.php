<?php

/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_edit_account_form');
?>
<div class="booking-form account-form">
	<div class="top-box">
		<strong class="holder height">
			<span class="left"><?php _e('Update Account', 'entrada'); ?> </span>
			<span class="arrow"></span>
		</strong>
	</div>
	<?php wc_print_notices(); ?>
	<form class="woocommerce-EditAccountForm edit-account" action="" method="post">

		<?php do_action('woocommerce_edit_account_form_start');  ?>
		<div class="row">
			<div class="col-md-6">
				<h3><?php _e('General', 'entrada'); ?></h3>
				<div class="form-holder">
					<p class="form-row form-row-wide">
						<label for="account_first_name"><?php echo esc_html__('First Name', 'entrada'); ?> <span class="required">*</span></label>
						<input type="text" class="woocommerce-Input woocommerce-Input--text form-control" name="account_first_name" id="account_first_name" value="<?php echo esc_attr($user->first_name); ?>" />
					</p>
					<p class="form-row form-row-wide">
						<label for="account_last_name"><?php echo esc_html__('Last Name', 'entrada'); ?> <span class="required">*</span></label>
						<input type="text" class="woocommerce-Input woocommerce-Input--text form-control" name="account_last_name" id="account_last_name" value="<?php echo esc_attr($user->last_name); ?>" />
					</p>
					<div class="clear"></div>
					<p class="form-row form-row-wide form-bottom-space">
						<label for="account_email"><?php echo esc_html__('Email', 'entrada'); ?> <span class="required">*</span></label>
						<input type="email" class="woocommerce-Input woocommerce-Input--email form-control" name="account_email" id="account_email" value="<?php echo esc_attr($user->user_email); ?>" />
					</p>
				</div>
			</div>

			<div class="col-md-6">
				<h3 class="small-size"><?php esc_html_e('Password Change', 'entrada'); ?></h3>
				<div class="form-holder">
					<p class="form-row form-row-wide">
						<label for="password_current"><?php _e('Current Password <small>(leave blank to leave unchanged) </small>', 'entrada'); ?></label>
						<input type="password" class="woocommerce-Input woocommerce-Input--password form-control" name="password_current" id="password_current" />
					</p>
					<p class="form-row form-row-wide">
						<label for="password_1"><?php _e('New Password <small>(leave blank to leave unchanged)</small>', 'entrada'); ?></label>
						<input type="password" class="woocommerce-Input woocommerce-Input--password  form-control" name="password_1" id="password_1" />
					</p>
					<p class="form-row form-row-wide">
						<label for="password_2"><?php echo esc_html__('Confirm New Password', 'entrada'); ?></label>
						<input type="password" class="wocommerce-Input woocommerce-Input--password form-control" name="password_2" id="password_2" />
					</p>
				</div>
			</div>
		</div>
		<?php do_action('woocommerce_edit_account_form'); ?>
		<div class="btn-holder">
			<?php wp_nonce_field('save_account_details', 'save-account-details-nonce'); ?>
			<input type="submit" class="woocommerce-Button button btn btn-default" name="save_account_details" value="<?php esc_attr_e('Save changes', 'entrada'); ?>" />
			<input type="hidden" name="action" value="save_account_details" />
		</div>
		<?php do_action('woocommerce_edit_account_form_end'); ?>
	</form>
</div>

<?php do_action('woocommerce_after_edit_account_form'); ?>