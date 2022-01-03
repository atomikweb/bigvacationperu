<div class="container">
	<?php
	global $vendor_id;
	global $vendor_page;
	global $vendor_shop;
	$posts_per_page = get_theme_mod('woo_listing_per_page', 6);

	if (('yes' == $vendor_page) && ($vendor_id)) {
		$args = array(
			'post_type' 		=> 'product',
			'posts_per_page'	=> $posts_per_page,
			'paged' 			=> 1,
			'author'			=> $vendor_id,
		);
	} else {
		$args = array(
			'post_type' 		=> 'product',
			'posts_per_page'	=> $posts_per_page,
			'paged' 			=> 1,
		);
		$args = entrada_product_type_meta_query($args, 'shop_item');
	}
	$shop_loop = new WP_Query($args);
	if ($shop_loop->have_posts()) { ?>
		<div class="content-holder list-view" id="entrada_content_loader">
			<?php
				while ($shop_loop->have_posts()) : $shop_loop->the_post();
					$entrada_social_media_share_img = '';
					$share_txt = entrada_truncate(get_the_ID(), 30, 120, 'id');
					$review = entrada_post_total_reviews(get_the_ID());
					if ($review > 0) {
						$average_rating = entrada_post_average_rating(get_the_ID());
					} else {
						$average_rating = 0;
					} ?>
				<article class="article has-hover-s1 ratingview">
					<div class="thumbnail" itemscope itemtype="http://schema.org/Product">
						<?php
								$image_url = wp_get_attachment_image_src(get_post_thumbnail_id($shop_loop->ID), 'single-post-thumbnail');
								$image = matthewruddy_image_resize($image_url[0], 350, 240, true, false);
								if (array_key_exists('url', $image) && $image['url'] != '') {
									echo '<div class="img-wrap"><img src="' . $image['url'] . '"  alt="' . get_the_title($shop_loop->ID) . '"></div>';
								} ?>
						<div class="description">
							<div class="col-left">
								<header class="heading">
									<h3><a href="<?php the_permalink(); ?>" itemprop="name"><?php the_title(); ?></a></h3>
									<div class="info-day"><?php echo get_post_meta(get_the_ID(), "trip_duration", true); ?></div>
								</header>
								<p itemprop="description"><?php echo entrada_truncate(get_the_ID(), 40, 180, 'id'); ?></p>
								<div class="reviews-holder">
									<div class="star-rating">
										<input class="product_rating" type="hidden" value="<?php echo esc_attr($average_rating); ?>">
										<div class="product_rateYo"></div>
									</div>
									<div class="info-rate"><?php

																	echo sprintf(__('%s', 'entrada'), $review);

																	?></div>
								</div>
								<footer class="info-footer">
									<?php
											/* Product Tag..... */
											$product_tag = wp_get_post_terms(get_the_ID(), 'product_tag');
											if (count($product_tag) > 0) {
												echo '<ul class="ico-list">';
												foreach ($product_tag as $term) {
													$icomoon_class = entrada_icomoon_class($term->slug);
													if (!empty($icomoon_class)) {
														echo '<li class="pop-opener"><span class="' . $icomoon_class . '"></span><div class="popup">' . ucwords($term->name) . '</div></li>';
													}
												}
												echo '</ul>';
											} ?>
									<ul class="ico-action">
										<?php
												if (shortcode_exists('sharethis_nav')) {
													echo do_shortcode('[sharethis_nav post_id="' . get_the_ID() . '"]');
												}

												?>
										<li><?php echo entrada_wishlist_html(get_the_ID()); ?></li>
									</ul>
								</footer>
							</div>
							<aside class="info-aside">
								<small class="price-prefix"><?php _e('from',  'entrada'); ?></small>
								<span class="price"><span <?php echo entrada_price_schema_micro_data_link(get_the_ID()); ?>><?php entrada_product_price(get_the_ID(), true); ?></span></span>

								<a href="<?php the_permalink(); ?>" class="btn btn-default" itemprop="url"><?php echo get_theme_mod('square_button_text', 'Explore'); ?></a>
							</aside>
						</div>
					</div>
				</article>
			<?php endwhile; ?>
		</div>
		<nav class="loadmore-wrap text-center">
			<input type="hidden" id="posts_per_page" name="posts_per_page" value="<?php echo esc_attr($posts_per_page); ?>" />
			<input type="hidden" id="vendor_page" name="vendor_page" value="<?php echo esc_attr($vendor_page); ?>" />
			<input type="hidden" id="vendor_shop" name="vendor_shop" value="<?php echo esc_attr($vendor_shop); ?>" />
			<input type="hidden" id="paged" name="paged" value="2" />
			<a href="javascript:void(null);" id="load_more_shop_post" class="btn btn-default"><?php _e('LOAD MORE',  'entrada'); ?></a>
		</nav>
	<?php
	} else {
		$no_product_meaage =  'No products were found matching your selection.';
		echo sprintf(__('<p class="woocommerce-info"> %s </p>', 'entrada'), $no_product_meaage);
	} ?>
</div>
<?php
if ('no' == $vendor_page) {
	$recently_viewed = get_theme_mod('woo_recently_viewed_items', 'enable');
	if ('enable' == $recently_viewed) {
		get_template_part('template-parts/similar', 'tours');
	}
}
