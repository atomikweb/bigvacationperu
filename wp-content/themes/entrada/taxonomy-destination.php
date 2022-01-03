<?php

/**
 * This template file is used to show the destinations
 */
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
get_header();
$cate = get_queried_object();
$t_id = $cate->term_id;
$term = get_term_by('id', $t_id, 'destination');

$term_meta = get_option("taxonomy_$t_id");

if (!isset($term_meta) || empty($term_meta)) {
	$term_meta = array();
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
<!-- main container -->
<main id="main">
	<div class="content-intro">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 text-holder">
					<h2 class="title-heading"><?php echo sprintf(__('%s', 'entrada'), $term_meta['prod_cat_sub_title']); ?></h2>
					<?php echo wpautop(do_shortcode($term->description)); ?>
				</div>
				<div class="col-sm-4 map-col">
					<div class="holder">
						<?php
						if (array_key_exists('product_cat_map_img_id', $term_meta) && !empty($term_meta['product_cat_map_img_id'])) {
							$map_img_src = wp_get_attachment_url($term_meta['product_cat_map_img_id']);
							if (!empty($map_img_src)) {
								echo '<div class="map-holder"><img src="' . $map_img_src . '" alt="image description"></div>';
							}
						} ?>
						<div class="info">
							<?php

							if (array_key_exists('prod_cat_best_season', $term_meta) && !empty($term_meta['prod_cat_best_season'])) {
								echo '<div class="slot"><strong>' . __('Best Season', 'entrada') . ':</strong><span class="sub">' . $term_meta['prod_cat_best_season'] . '</span></div>';
							}

							if (array_key_exists('prod_cat_popular_location', $term_meta) && !empty($term_meta['prod_cat_popular_location'])) {
								echo '<div class="slot">
												<strong>' . __('Popular Location', 'entrada') . ':</strong>
												<span class="sub">' . $term_meta['prod_cat_popular_location'] . '</span>
										  </div>';
							} ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
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
				} ?>
				<div class="seperator"></div>
			</header>
			<?php
			$tpl_listgrid = get_theme_mod('desti_view_mode_layout');
			if (!isset($tpl_listgrid) || empty($tpl_listgrid)) {
				$tpl_listgrid = 'list';
			}

			$args = array(
				'posts_per_page' 	=> -1,
				'post_type' 		=> 'product',
				'tax_query'     	=> array(
					array(
						'taxonomy'  => 'destination',
						'field'     => 'id',
						'terms'     => array($t_id)
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
<?php get_footer(); ?>