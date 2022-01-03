<?php
add_action( 'woocommerce_product_after_variable_attributes', 'entrada_variation_settings_fields', 10, 3 );
add_action( 'woocommerce_save_product_variation', 'entrada_save_variation_settings_fields', 10, 2 );
/**
 * Create new fields for variations
 *
*/
function entrada_variation_settings_fields( $loop, $variation_data, $variation ) {
	echo '<script>jQuery(document).ready(function() {
		     jQuery(".wc_confirmed_date").datepicker({ dateFormat: "yy-mm-dd" });
			 jQuery(".wc_returning_date").datepicker({ dateFormat: "yy-mm-dd" });
		});</script>';
	woocommerce_wp_text_input(
		array(
			'id'          	=> 'var_price_inc_flight[' . $variation->ID . ']',
			'label'       	=> __( 'Price Including Flight:', 'entrada' ),
			'placeholder'	=> 'Price Including Flight',
			'desc_tip'    	=> 'true',
			'description' 	=> __( 'Enter variation price including Flight.', 'entrada' ),
			'value'       	=> get_post_meta( $variation->ID, 'var_price_inc_flight', true ),
		)
	);

	woocommerce_wp_text_input(
		array(
			'id'          	=> 'var_confirmed_date[' . $variation->ID . ']',
			'label'       	=> __( 'Start Date: ', 'entrada' ),
			'placeholder' 	=> 'Start Date',
			'class'			=> 'wpg-datepicker wc_confirmed_date',
			'desc_tip'    	=> 'true',
			'description' 	=> __( 'Enter start date.', 'entrada' ),
			'value'       	=> get_post_meta( $variation->ID, 'var_confirmed_date', true ),
		)
	);

	woocommerce_wp_text_input(
		array(
			'id'          	=> 'var_returning_date[' . $variation->ID . ']',
			'label'       	=> __( 'Returning Date: ', 'entrada' ),
			'placeholder'	=> 'Returning Date',
			'class' 		=> 'wpg-datepicker wc_returning_date',
			'desc_tip'    	=> 'true',
			'description' 	=> __( 'Enter returning date.', 'entrada' ),
			'value'       	=> get_post_meta( $variation->ID, 'var_returning_date', true ),
		)
	);

	woocommerce_wp_text_input(
		array(
			'id'          	=> 'var_tour_status[' . $variation->ID . ']',
			'label'       	=> __( 'Tour Status: ', 'entrada' ),
			'placeholder'	=> 'Tour Status',
			'class' 		=> '',
			'desc_tip'    	=> 'true',
			'description' 	=> __( 'Enter tour status.(Available, Booked, Booked & Guaranteed etc.)', 'entrada' ),
			'value'       	=> get_post_meta( $variation->ID, 'var_tour_status', true ),
		)
	);

}
/**
 * Save new fields for variations
 *
*/
function entrada_save_variation_settings_fields( $post_id ) {
	if( ! empty( $_POST['var_price_inc_flight'][ $post_id ] ) ) {
		update_post_meta( $post_id, 'var_price_inc_flight', esc_attr( $_POST['var_price_inc_flight'][ $post_id ] ) );
	}

	if( ! empty( $_POST['var_confirmed_date'][ $post_id ] ) ) {
		update_post_meta( $post_id, 'var_confirmed_date', esc_attr( $_POST['var_confirmed_date'][ $post_id ] ) );
	}

	if( ! empty( $_POST['var_returning_date'][ $post_id ] ) ) {
		update_post_meta( $post_id, 'var_returning_date', esc_attr( $_POST['var_returning_date'][ $post_id ] ) );
	}
	if( ! empty( $_POST['var_tour_status'][ $post_id ] ) ) {
		update_post_meta( $post_id, 'var_tour_status', esc_attr( $_POST['var_tour_status'][ $post_id ] ) );
	}

} ?>