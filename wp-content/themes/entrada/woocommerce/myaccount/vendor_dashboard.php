<?php
/**
 * My Account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
wc_print_notices();
 ?>
 <script type="text/javascript">
 var entrada_params = window.entrada_params;
 window.location = entrada_params.site_home_url+'/vendor_dashboard';
 </script>
