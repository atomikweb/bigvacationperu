<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

/**
 * My Account navigation.
 * @since 2.6.0
 */
 ?>
<aside id="sidebar" class="col-sm-4 col-md-3 sidebar sidebar-list">
    <div class="sidebar-holder">
        <!-- accordion filters in sidebar -->
        <div class="accordion">
            <div class="accordion-group">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="#"><?php _e( 'My Account', 'entrada' ); ?></a></h4>
                </div>

                <div class="" role="tabpanel">
                    <div class="panel-body">
                        <?php do_action( 'woocommerce_account_navigation' ); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</aside>

<div id="content" class="col-sm-8 col-md-9 col-account">
    <div class="woocommerce-MyAccount-content">
        <?php
            /**
             * My Account content.
             * @since 2.6.0
             */
            do_action( 'woocommerce_account_content' );
        ?>
    </div>
</div>
