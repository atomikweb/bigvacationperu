<?php
global $loop;
$average_rating =  entrada_post_average_rating(get_the_ID()); ?>
<article class="article has-hover-s1 ratingview">
	<div class="thumbnail" itemscope itemtype="http://schema.org/Product">
		<?php
		$entrada_social_media_share_img =  entrada_social_media_share_img(get_the_ID());
		?>
		<!--Wrap image inside a href to make image clickable -->
		<a href="<?php the_permalink(); ?>" itemprop="name"> <?php echo entrada_product_resized_img(get_the_ID(), $resize = array(550, 358)); ?> </a>
		<div class="description">
			<div class="col-left">
				<header class="heading">
					<h3><a href="<?php the_permalink(); ?>" itemprop="name"><?php the_title(); ?></a></h3>
					<div class="info-day"><?php echo get_post_meta(get_the_ID(), "trip_duration", true); ?></div>
				</header>
				<p itemprop="description"><?php echo entrada_truncate(get_the_ID(), 40, 180, 'id'); ?></p>
				<div class="reviews-holder" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
					<div class="star-rating">
						<input class="product_rating" type="hidden" value="<?php echo esc_attr($average_rating); ?>">
						<div class="product_rateYo"><span class="sr-only" itemprop="ratingValue"><?php

																									echo sprintf(__('%s', 'entrada'), $average_rating);
																									?></span></div>
					</div>
					<div class="info-rate" itemprop="reviewCount"><?php echo entrada_post_total_reviews(get_the_ID()); ?></div>
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
				<div class="activity-level">
					<div class="ico">
						<span class="icon-level<?php entrada_product_activity_level(get_the_ID(), 'level', true); ?>"></span>
					</div>
					<span class="text"><?php entrada_product_activity_level(get_the_ID(), 'title', true); ?></span>
				</div>
				<a href="<?php the_permalink(); ?>" class="btn btn-default" itemprop="url"><?php echo get_theme_mod('square_button_text', 'Explore'); ?></a>
			</aside>
		</div>
	</div>
</article>