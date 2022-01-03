<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
	return;
}

/* Entrada Custom */
global $woocommerce_loop;
$columns = 4;
$entrada_col_class = '';

if (isset($woocommerce_loop) && array_key_exists("columns", $woocommerce_loop)) {
	$columns = $woocommerce_loop['columns'];
}
switch ($columns) {

	case '1':
		$entrada_col_class = 'col;-sm-6 col-md-12';
		break;

	case '2':
		$entrada_col_class = 'col;-sm-6 col-md-6';
		break;

	case '3':
		$entrada_col_class = 'col;-sm-6 col-md-4';
		break;

	case '6':
		$entrada_col_class = 'col;-sm-6 col-md-2';
		break;

	default:
		$entrada_col_class = 'col;-sm-6 col-md-3';
}

$share_txt  = entrada_truncate($product->get_id(), 30, 110, 'id');
$entrada_social_media_share_img = '';
$html_content = '';

$html_content .= '<article class="' . $entrada_col_class . ' article has-hover-s1">
					<div class="thumbnail" itemscope itemtype="http://schema.org/Product">';
$entrada_social_media_share_img =  entrada_social_media_share_img($product->get_id());
$html_content .= entrada_product_resized_img($product->get_id(), $resize = array(550, 358));

$html_content .= '<h3 class="small-space"><a href="' . get_permalink($product->get_id()) . '" itemprop="name">' . get_the_title($product->get_id()) . '</a></h3>
			<span class="info">';

$term_list = wp_get_post_terms($product->get_id(), 'product_cat', array('fields' => 'ids'));
$cat_url = '';

if (count($term_list) > 0) {
	foreach ($term_list as $cat_id) {
		if ($cat_url != '')
			$cat_url .= ', ';
		$term = get_term($cat_id, 'product_cat');
		$cat_url .= '<a href="' . get_term_link($cat_id, 'product_cat') . '">' . $term->name . '</a>';
	}
}

$html_content .= $cat_url . '</span>
			<aside class="meta">' . entrada_destinations_activities_count($product->get_id(), false) . '
			</aside>
			<p itemprop="description">' . entrada_truncate(strip_tags(get_the_content()), 40, 180) . '</p>
			<a href="' . get_permalink($product->get_id()) . '" class="btn btn-default" itemprop="url">' . get_theme_mod('square_button_text', 'explore') . '</a>
			<footer>
				<ul class="social-networks">
					' . entrada_social_media_share_btn(get_the_title($product->get_id()), get_permalink($product->get_id()), $share_txt, $entrada_social_media_share_img) . '
				</ul>
				<span class="price">';

$product_price = $product->get_price();

if ($product_price != '') {

	$html_content .= __('from', 'entrada') . ' <span ' . entrada_price_schema_micro_data_link($product->get_id()) . '>' . entrada_price($product_price) . '</span>';
}
$html_content .= '</span>
						</footer>
						</div>
						</article>';
echo sprintf(__('%s', 'entrada'), $html_content);
