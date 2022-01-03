<?php

if ( ! class_exists( 'WP_Customize_Control' ) ){
    return NULL;
}
/**
 * A class to create a dropdown for all google fonts
 */
 class Entrada_Google_Font_Dropdown_Custom_Control extends WP_Customize_Control{
    private $fonts = false;

    public function __construct( $manager, $id, $args = array(), $options = array() ) {
        parent::__construct( $manager, $id, $args );
    }

    /**
     * Render the content of the category dropdown
     *
     * @return HTML
     */
    public function render_content() {
    	$fonts_list 	= array();
    	$google_api_key = get_option( 'entrada_google_api_key' );
		if ( empty( $google_api_key ) ) {
			delete_transient( 'google_fonts_variant_lists' );
    		echo '<label for="_customize-input-' . $this->id . ' " class="customize-control-title">' . esc_html( $this->label ) . '</label>';
			$api_url = esc_url( 'https://developers.google.com/fonts/docs/developer_api' );
			echo __( 'If you want to set up an integration with Google Fonts, you\'ll need to generate API Key.', 'entrada' );
			echo ' <a href="' . $api_url . '" target="_blank">' . __( 'Get API Key', 'entrada' ) . '</a>';
			echo ' ' . __( 'and set it via customizer.', 'entrada' );
    	}
        else {
        	$fonts_list = $this->get_fonts( $google_api_key );
			if( isset( $fonts_list ) ){ ?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<select <?php $this->link(); ?> class="entrada_google_font_select" >
						<option value=""><?php _e('Default',  'entrada' ); ?></option>
					<?php
						foreach( $fonts_list as $v => $i ) {
							$val = str_replace( "+", " ", $v );
							$selected = selected( $this->value(), $v, false );
							echo '<option value="' . $v . '" ' . $selected . '>' . $val . '</option>';
							//printf( '<option value="%s" %s>%s</option>', $v, selected($this->value(), $v, false), str_replace( "+", " ", $v ) );
						} ?>
					</select>
				</label>
		<?php
	        }
			else{
				$all_fonts = array();
				$all_fonts["PT+Sans"] 				= array( "300", "300italic", "regular", "italic", "600", "600italic", "700", "700italic", "800", "800italic" );
				$all_fonts["Roboto"] 				= array( "100", "100italic", "300", "300italic", "regular", "italic", "500", "500italic", "700", "700italic", "900", "900italic" );
				$all_fonts["Open+Sans"] 				= array( "300", "300italic", "regular", "italic", "600", "600italic", "700", "700italic", "800", "800italic" );
				$all_fonts["Lato"] 					= array( "100", "100italic", "300", "300italic", "regular", "italic", "700", "700italic", "900", "900italic" );
				$all_fonts["Lora"] 					= array( "regular", "italic", "700", "700italic" );
				$all_fonts["Montserrat"] 			= array( "regular", "700" );
				$all_fonts["Raleway"] 				= array( "100", "100italic", "200", "200italic", "300", "300italic", "regular", "italic", "500", "500italic", "600", "600italic", "700", "700italic", "800", "800italic", "900", "900italic" );
				$all_fonts["PT+Serif"] 				= array( "regular", "italic", "700", "700italic" );
				$all_fonts["Indie+Flower"] 			= array( "regular" );
				$all_fonts["Lobster"] 				= array( "regular" );
				$all_fonts["Cinzel"] 				= array( "regular", "700", "900" );
				$all_fonts["Shadows+Into+Light"] 	= array( "regular" );
				$all_fonts["Patrick+Hand"] 			= array( "regular" );
				$all_fonts["Fredericka+the+Great"] 	= array( "regular" );
				$all_fonts["Alef"] 					= array( "regular", "700" );
				$all_fonts["Cabin+Sketch"] 			= array(  "regular", "700" );
				$all_fonts["Merienda"] 				= array( "regular", "700" ); ?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<select <?php $this->link(); ?> class="entrada_google_font_select" >
						<option value=""><?php _e('Default',  'entrada' ); ?></option>
					<?php
						foreach( $all_fonts as $v => $i ){
							printf( '<option value="%s" %s>%s</option>', $v, selected($this->value(), $v, false), str_replace( "+", " ", $v ) );
						} ?>
					</select>
				</label>
			<?php
				set_transient( 'google_fonts_variant_lists', $all_fonts, 14 * DAY_IN_SECONDS );
			}
        }
    }

    /**
     * Get the google fonts from the API or in the cache
     *
     * @param  integer $amount
     *
     * @return String
     */
    public function get_fonts( $google_api ) {
		$all_fonts  = array();

		if ( false === ( $special_query_results = get_transient( 'google_fonts_variant_lists' ) ) ) {
			$googleApi 	 = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=alpha&key=' . $google_api;
			$fontContent = wp_remote_get( $googleApi, array('sslverify'   => false) );

			if ( is_array( $fontContent ) && ! is_wp_error( $fontContent ) && isset( $fontContent['response']['code'] ) && $fontContent['response']['code'] != 400 ) {
				$content = json_decode( $fontContent['body'] );
				$fonts = $content->items;
				sort($fonts);
				if( !empty( $fonts ) ){
					foreach ( $fonts as $k => $v ){
						$family = str_replace( " ", "+", $v->family );
						$all_fonts[$family] = $v->variants;
					}
				}
			}

			return $all_fonts;
		}
		else {
			$variant_lists = get_transient( 'google_fonts_variant_lists' );
			return $variant_lists;
		}
    }

 } ?>