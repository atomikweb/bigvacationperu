<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
if (is_user_logged_in()) {
	return;
} ?>
<form method="post" class="login booking-form" <?php if ($hidden) echo 'style="display:none;"'; ?>>
	<div class="form-holder checkout-form-slide">
		<?php do_action('woocommerce_login_form_start'); ?>
		<?php if ($message) echo wpautop(wptexturize($message)); ?>
		<div class="row">
			<div class="col-md-6">
				<div class="hold">
					<label for="username"><?php _e('Username or email',  'entrada' ); ?> <span class="required">*</span></label>
					<input type="text" class="form-control" name="username" id="username" />
				</div>
			</div>
			<div class="col-md-6">
				<div class="hold">
					<label><?php _e('Password',  'entrada' ); ?> <span class="required">*</span></label>
					<input class="form-control" type="password" name="password" id="password" />
				</div>
			</div>
		</div>
		<?php do_action('woocommerce_login_form'); ?>
		<div class="row">
			<div class="col-md-6">
				<label for="rememberme" class="inline"><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e('Remember me',  'entrada' ); ?></label>
			</div>
			<div class="col-md-6">
				<?php wp_nonce_field('woocommerce-login'); ?>
				<input type="submit" class="btn btn-default" name="login" value="<?php _e('Login',  'entrada' ); ?>" />
				<input type="hidden" name="redirect" value="<?php echo esc_url($redirect) ?>" />
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 btn-hold">
				<a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php _e('Lost your password?',  'entrada' ); ?></a>
			</div>
		</div>
		<div class="clear"></div>
		<?php do_action('woocommerce_login_form_end'); ?>
	</div>
</form>