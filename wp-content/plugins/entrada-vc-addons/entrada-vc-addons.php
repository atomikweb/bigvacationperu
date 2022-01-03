<?php
/*
Plugin Name: Entrada VC Addons
Plugin URI: http://waituk.com/
Description: Declares a plugin that will extend Visual Composer Elements and Shortcodes.
Version: 4.0.7
Author: WAITUK
Author URI: http://waituk.com/
License: GPLv2
*/

if (in_array('js_composer/js_composer.php', apply_filters('active_plugins', get_option('active_plugins')))) {

	require_once 'languages/month_translate.php';
	require_once 'vc-extended-shortcode.php';
	require_once 'vc-extended-elements.php';
} else {
	add_action('admin_notices', 'admin_notice_evc_activation');
}

function entrada_vc_addons_enqueue_scripts()
{
	wp_enqueue_style('entrada-vc-addons', plugins_url('/css/entrada_vc_addons.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'entrada_vc_addons_enqueue_scripts', 70);

function entrada_product_cat_url($term_id, $mode = 'default')
{
	$url = '';
	switch ($mode) {
		case 'custom':
			$url = '#';
			$term_meta = get_option("taxonomy_$term_id");
			if (array_key_exists('prod_cat_dig_more_link', $term_meta) && $term_meta['prod_cat_dig_more_link'] != '') {
				$url = $term_meta['prod_cat_dig_more_link'];
			}

			break;

		case 'search':
			$term = get_term_by('id', $term_id, 'product_cat');
			$url = esc_url(home_url('/') . 'find/tours/?product_cat=' . $term->slug);
			break;

		default:
			$url = esc_url(get_term_link($term_id));
			break;
	}

	return $url;
}

/* Add metaquery for WC entrada product type */
if (!function_exists('entrada_vc_product_type_meta_query')) {
	function entrada_vc_product_type_meta_query($args, $entrada_product_type = 'tour')
	{
		$meta_query = array();

		$meta_query[] = array(
			'key' 		=> 'entrada_product_type',
			'value' 	=> $entrada_product_type,
			'compare' 	=> '='
		);

		if (count($meta_query) > 0) {
			$args['meta_query'] = $meta_query;
		}
		return $args;
	}
}


function admin_notice_evc_activation()
{


	echo '<div class="error"><p>' . __('The <strong>Entrada VC Addons</strong> plugin requires <strong>Visual Composer</strong> installed and activated.', 'entrada') . '</p></div>';
}
if (!function_exists('entrada_vc_month_name')) {
	function entrada_vc_month_name($index, $y)
	{
		global $entrada_locale, $month_short_name;
		$date_formate = '';
		if (array_key_exists($entrada_locale, $month_short_name)) {
			$date_formate = $month_short_name[$entrada_locale][$index - 1] . ' ' . $y;
		} else {
			$date_formate = date('M', mktime(0, 0, 0, $index, 10))  . ' ' . $y;
		}

		return $date_formate;
	}
}
