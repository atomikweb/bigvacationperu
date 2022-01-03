<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;


get_header();

if (is_shop()) {
	global $vendor_id;
	global $vendor_page;
	global $vendor_shop;

	$background_image = '';
	$vendor_page = 'no';

	$woo_background_image = get_theme_mod('woo_background_image');
	if (!empty($woo_background_image)) {
		$background_image = get_theme_mod('woo_background_image');
	}
	$posts_per_page = (int) get_theme_mod('woo_listing_per_page', 9);

	if ((class_exists('WC_Vendors')) && (WCV_Vendors::is_vendor_page())) {
		/* Vendor Shop page */
		$vendor_page = 'yes';
		$vendor_shop = urldecode(get_query_var('vendor_shop'));
		$vendor_id   = WCV_Vendors::get_vendor_id($vendor_shop);
		if ($vendor_id) {
			$vendor_name_message = get_userdata($vendor_id);
			$current_user = wp_get_current_user();
			$vendor =  get_userdata($vendor_id);
			$heading = get_user_meta($vendor_id, 'pv_shop_name', true); //WCV_Vendors::get_vendor_shop_name( $vendor_id );
			$seller_info = get_user_meta($vendor_id, 'pv_seller_info', true); // Seller Information
			$sub_heading = get_user_meta($vendor_id, 'pv_shop_description', true); // Shop Description
		}
	} else {
		/* Normal Shop page */
		$heading = get_theme_mod('woo_heading', 'Shop');
		$sub_heading = get_theme_mod('woo_sub_heading', 'Available product list');
	} ?>
	<section class="banner banner-inner parallax" <?php if (!empty($background_image)) {
															echo 'style="background-image:url(' . $background_image . ')"';
														} ?>>
		<div class="banner-text">
			<div class="center-text">
				<div class="container">
					<?php
						echo '<h1>' . $heading . '</h1>';
						echo '<strong class="subtitle">' . $sub_heading . '</strong>'; ?>
					<!-- breadcrumb -->
					<nav class="breadcrumbs">
						<?php entrada_custom_breadcrumbs(); ?>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<main id="main">
		<div class="content-block content-sub">
			<!-- content block with boxed article -->
			<div class="container">
				<?php
					if (!empty($seller_info)) {
						echo '<div class="seller_info">' . $seller_info . '</div>';
					}
					$view_mode = get_theme_mod('woo_default_listing_view', 'list');

					if ('list' == $view_mode) {
						get_template_part('template-parts/shop', 'list');
						echo '<input type="hidden" class="view_mode" value="list">';
					} else {
						get_template_part('template-parts/shop', 'grid');
						echo '<input type="hidden" class="view_mode" value="grid">';
					} ?>
			</div>
		</div>
	</main>
	<?php
	} else {
		$cate = get_queried_object();
		$t_id = $cate->term_id;
		$entrada_taxonomy = get_query_var('taxonomy');

		$term = get_term_by('id', $t_id, $entrada_taxonomy);

		if (empty($entrada_taxonomy) || $entrada_taxonomy == 'product_cat') {
			$term_meta = get_option("taxonomy_$t_id");
		} else {
			$term_meta = array();
			$term_meta['prod_cat_listing_title'] = $term->name;
			$term_meta['prod_cat_listing_sub_title'] = strip_tags($term->description);
		}

		$banner_img_src = '';
		if (array_key_exists('product_cat_banner_img_id', $term_meta) && $term_meta['product_cat_banner_img_id']  != '') {
			$banner_img_src = wp_get_attachment_url($term_meta['product_cat_banner_img_id']); ?>
		<section class="banner banner-inner parallax" style="background-image:url(<?php echo esc_url($banner_img_src); ?>)">
			<div class="banner-text">
				<div class="center-text">
					<div class="container">
						<?php
								if (isset($term_meta['prod_cat_heading']) && $term_meta['prod_cat_heading']  != '') {
									echo '<h1>' . $term_meta['prod_cat_heading'] . '</h1>';
								}
								if (isset($term_meta['prod_cat_sub_heading']) && $term_meta['prod_cat_sub_heading']  != '') {
									echo '<strong class="subtitle">' . $term_meta['prod_cat_sub_heading'] . '</strong>';
								} ?>
						<!-- breadcrumb -->
						<nav class="breadcrumbs">
							<?php entrada_custom_breadcrumbs(); ?>
						</nav>
					</div>
				</div>
			</div>
		</section>
	<?php } ?>
	<main id="main">
		<?php if (empty($entrada_taxonomy) || $entrada_taxonomy == 'product_cat') { ?>
			<div class="content-intro">
				<div class="container">
					<div class="row">
						<div class="col-sm-8 col-md-8 text-holder">
							<?php
									if (isset($term_meta['prod_cat_sub_title']) && $term_meta['prod_cat_sub_title']  != '') {
										echo '<h2 class="title-heading">' . $term_meta['prod_cat_sub_title'] . '</h2>';
									} ?>
							<?php echo wpautop(do_shortcode($term->description)); ?>

						</div>
						<div class="col-sm-4 col-md-4 map-col">
							<div class="holder">
								<?php
										if (array_key_exists('product_cat_map_img_id', $term_meta) && $term_meta['product_cat_map_img_id']  != '') {
											$map_img_src = wp_get_attachment_url($term_meta['product_cat_map_img_id']);
											echo '<div class="map-holder"><img src="' . $map_img_src . '" alt="image description"></div>';
										} ?>
								<div class="info">
									<?php
											if (isset($term_meta['prod_cat_best_season']) && $term_meta['prod_cat_best_season']  != '') {
												echo '<div class="slot"><strong>' . __('Best Seasons', 'entrada') . ':</strong><span class="sub">' . $term_meta['prod_cat_best_season'] . '</span></div>';
											}
											if (isset($term_meta['prod_cat_popular_location']) && $term_meta['prod_cat_popular_location']  != '') {
												echo '<div class="slot"><strong>' . __('Popular Location', 'entrada') . ':</strong><span class="sub">' . $term_meta['prod_cat_popular_location'] . '</span></div>';
											} ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>

		<!-- content block with boxed article -->
		<article class="content-block article-boxed">
			<div class="container">
				<header class="content-heading">
					<?php
						if (isset($term_meta['prod_cat_listing_title']) && $term_meta['prod_cat_listing_title']  != '') {
							echo '<h2 class="main-heading">' . $term_meta['prod_cat_listing_title'] . '</h2>';
						}
						if (isset($term_meta['prod_cat_listing_sub_title']) && $term_meta['prod_cat_listing_sub_title']  != '') {
							echo '<span class="main-subtitle">' . $term_meta['prod_cat_listing_sub_title'] . '</span>';
						}  ?>
					<div class="seperator"></div>
				</header>
				<?php
					$tpl_listgrid = get_theme_mod('tour_cat_view_mode_layout');
					if (!isset($tpl_listgrid) || empty($tpl_listgrid)) {
						$tpl_listgrid = 'list';
					}
					$args = array(
						'posts_per_page'	=> -1,
						'post_type' 		=> 'product',
						'tax_query'    	 	=> array(
							array(
								'taxonomy'  => $entrada_taxonomy,
								'field'     => 'id',
								'terms'     => array($t_id),
							)
						)
					);
					$loop = new WP_Query($args);

					$mode = ($tpl_listgrid == 'grid') ? 'content-sub-holder' : 'list-view';
					?>
				<div <?php if ($tpl_listgrid == 'list') {
								echo ' id="ajax_content_wrapper"';
							} ?> class="content-holder <?php echo esc_attr($mode); ?>">
					<?php
						if ($tpl_listgrid == 'grid') {
							echo '<div class="row db-3-col"  id="ajax_content_wrapper">';
						}
						if ($loop->have_posts()) {
							$hide_load_more_btn = 'no';
							while ($loop->have_posts()) : $loop->the_post();
								get_template_part('template-parts/search', $tpl_listgrid);
							endwhile;
							if ($tpl_listgrid == 'grid') {
								echo '</div>';
							}
						} else {
							$hide_load_more_btn = '';
							if ($tpl_listgrid == 'grid') {
								echo '</div>';
							}
							echo '<div class="pagination-wrap" id="have_no_record"><p>' . __('No Trip matches your search criteira', 'entrada') . '</p> </div>';
						} ?>
				</div>
			</div>
		</article>
		<!-- recent block -->
		<?php get_template_part('template-parts/similar', 'tours'); ?>
	</main>
<?php
}
get_footer();
