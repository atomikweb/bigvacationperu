<?php

/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.1.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
wc_print_notices();

do_action('woocommerce_before_customer_login_form');

$registration_enabled = false;

if (get_option('woocommerce_enable_myaccount_registration') === 'yes') :
	$registration_enabled = true;
endif; ?>
<div class="twocol-form">
	<div class="row">
		<?php
		if ($registration_enabled) :
			echo '<div class="col-md-6">';
		else :
			echo '<div class="col-md-12">';
		endif; ?>
		<div class="top-box">
			<span class="holder height"><?php _e('Login',  'entrada'); ?></span>
		</div>
		<form class="woocommerce-form woocommerce-form-login login" method="post">

			<?php do_action('woocommerce_login_form_start'); ?>
			<div class="form-holder">
				<div class="wrap">
					<div class="hold">
						<label for="uname"><?php _e('Username or email address',  'entrada'); ?></label>
						<input type="text" name="username" id="username" value="<?php if (!empty($_POST['username'])) echo esc_attr($_POST['username']); ?>" class="form-control">
					</div>
					<div class="hold">
						<label for="pass"><?php _e('Password',  'entrada'); ?></label>
						<input type="password" name="password" id="password" class="form-control">
					</div>
					<?php do_action('woocommerce_login_form'); ?>
					<div class="btn-hold">
						<?php wp_nonce_field('woocommerce-login'); ?>
						<input type="submit" class="btn btn-default" name="login" value="<?php esc_attr_e('Login',  'entrada'); ?>">
					</div>
					<div class="btn-hold">
						<a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php _e('Lost your password?',  'entrada'); ?></a>
					</div>
				</div>
			</div>
			<?php do_action('woocommerce_login_form_end'); ?>
		</form>
	</div>
	<!--Login section ends here-->
	<?php if (get_option('woocommerce_enable_myaccount_registration') === 'yes') : ?>
		<div class="col-md-6">
			<div class="top-box">
				<span class="holder height"><?php _e('Register',  'entrada'); ?></span>
			</div>
			<form method="post" class="register">
				<div class="form-holder">
					<div class="wrap">
						<?php do_action('woocommerce_register_form_start'); ?>
						<?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>
							<div class="hold">
								<label for="reg_username"><?php _e('Username',  'entrada'); ?></label>
								<input type="text" class="form-control" name="username" id="reg_username" value="<?php if (!empty($_POST['username'])) echo esc_attr($_POST['username']); ?>" />
							</div>
						<?php endif; ?>
						<div class="hold">
							<label for="reg_email"><?php _e('Email address',  'entrada'); ?></label>
							<input type="email" class="form-control" name="email" id="reg_email" value="<?php if (!empty($_POST['email'])) echo esc_attr($_POST['email']); ?>" />
						</div>
						<?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>
							<div class="hold">
								<label for="reg_password"><?php _e('Password',  'entrada'); ?></label>
								<input type="password" class="form-control" name="password" id="reg_password" />
							</div>
						<?php
						endif;
						do_action('woocommerce_register_form');
						do_action('register_form'); ?>
						<div class="hold">
							<?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
							<input type="submit" class="woocommerce-Button btn btn-default" name="register" value="<?php esc_attr_e('Register',  'entrada'); ?>" />
						</div>
						<?php do_action('woocommerce_register_form_end'); ?>
					</div>
				</div>
			</form>
		</div>
	<?php endif; ?>
</div>
</div>
<?php do_action('woocommerce_after_customer_login_form'); ?>