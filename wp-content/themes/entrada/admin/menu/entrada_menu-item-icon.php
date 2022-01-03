<?php

/**
 * Entrada Menu Item Custom Icon
 *
 */

if ( ! class_exists( 'Entrada_Menu_Item_Custom_Icon' ) ) :
	/**
	* Menu Item Custom Fields Loader
	*/
	class Entrada_Menu_Item_Custom_Icon {

		/**
		* Add filter
		*
		* @wp_hook action wp_loaded
		*/
		public static function load() {
			add_filter( 'wp_edit_nav_menu_walker', array( __CLASS__, '_filter_walker' ), 99 );
		}

		public static function _filter_walker( $walker ) {
			$walker = 'Menu_Item_Custom_Fields_Walker';
			if ( ! class_exists( $walker ) ) {
				require_once dirname( __FILE__ ) . '/walker-nav-menu-edit.php';
			}

			return $walker;
		}
	}
	add_action( 'wp_loaded', array( 'Entrada_Menu_Item_Custom_Icon', 'load' ), 9 );
endif; 

require_once dirname( __FILE__ ) . '/menu-item-custom-icon-fields.php';
