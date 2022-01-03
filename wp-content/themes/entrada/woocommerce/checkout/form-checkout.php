<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
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
 * @version     3.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'entrada' ) );
	return;
}
$get_checkout_url = esc_url( wc_get_checkout_url() ); ?>
<div class="row same-height">
	<div class="col-md-6">
<?php
	if ( !is_user_logged_in()  ) {
		 wc_get_template( 'checkout/form-login.php', array( 'checkout' => WC()->checkout() ) );
	} ?>
	</div>
	<div class="col-md-6">
<?php
	if (  wc_coupons_enabled() ) {
		wc_get_template( 'checkout/form-coupon.php', array( 'checkout' => WC()->checkout() ) );
	} ?>
	</div>
</div>

<form name="checkout" method="post" class="booking-form checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">



	<div class="row">
		<div class="col-md-6">

		<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) :

		do_action( 'woocommerce_checkout_before_customer_details' );

			do_action( 'woocommerce_checkout_billing' );

		do_action( 'woocommerce_checkout_after_customer_details' );

		 ?>
		<?php endif; ?>

		</div>
		<div class="col-md-6">
		    <div class="form-holder">
		    	<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			    <div class="order-block">
					<h2 class="small-size"><?php _e( 'Preview Order', 'entrada' ); ?></h2>
					<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
					<div id="order_review" class="woocommerce-checkout-review-order">
						<?php do_action( 'woocommerce_checkout_order_review' ); ?>
					</div>
					<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
			    </div>
		    </div>
		</div>
	</div>
</form>
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>