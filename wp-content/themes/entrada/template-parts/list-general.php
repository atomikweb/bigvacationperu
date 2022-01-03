<?php
$posts_per_page = 6;
$posts_per_page_check = get_theme_mod('search_posts_per_page');
if (isset($posts_per_page_check) && !empty($posts_per_page_check)) {
	$posts_per_page = get_theme_mod('search_posts_per_page');
}
$args = array(
	'post_type' 		=> 'product',
	'posts_per_page' 	=> $posts_per_page,
	'paged' 			=> 1
);

$args = entrada_product_type_meta_query($args, 'tour');
$loop = new WP_Query($args); ?>
<!-- content block with list items -->
<div class="content-block less-space content-sub">
	<div class="container">
		<div class="filter-option filter-option-list">
			<?php $count = $loop->found_posts; ?>
			<strong class="result-info"><?php printf(esc_html(_n('%d Trip matches your search criteria', '%d Trips match your search criteria', $count, 'entrada')), $count); ?></strong>
			<div class="layout-holder">
				<div class="layout-action">
					<a href="javascript:void(null);" id="view_list" class="link link-list active"><span class="icon-list"></span></a>
					<a href="javascript:void(null);" id="view_grid" class="link link-grid"><span class="icon-grid"></span></a>
				</div>
				<div class="select-holder">
					<a href="#" class="btn btn-primary btn-filter"><i class="fa fa-sliders"></i> <?php _e('Filter',  'entrada'); ?></a>
					<div class="filter-slide">
						<div class="select-col">
							<select class="filter-select" id="filter_holiday_type">
								<option value="" class="hideme"><?php _e('Holiday Type',  'entrada'); ?></option>
								<option value=""><?php _e('All Holiday Types',  'entrada'); ?></option>
								<?php
								$holiday_types = get_terms('holiday_type', 'hide_empty=0');
								if ($holiday_types) {
									foreach ($holiday_types as $holiday_type) { ?>
										<option value="<?php echo esc_attr($holiday_type->slug);  ?>">
											<?php echo sprintf(__('%s', 'entrada'), $holiday_type->name); ?>
										</option>

								<?php
									}
								} ?>
							</select>
						</div>
						<div class="select-col">
							<select class="filter-select" id="filter_activity_level">
								<option value="" class="hideme"><?php _e('Difficulty',  'entrada'); ?></option>
								<option value=""><?php _e('All Difficulties',  'entrada'); ?></option>
								<?php
								// Sorting Activity Level
								$activity_levels_array = array();
								$activity_levels = get_terms('activity_level', 'orderby=id&order=asc&hide_empty=0');
								if (!empty($activity_levels) && !is_wp_error($activity_levels)) {
									foreach ($activity_levels as $activity_level) {
										$term_meta = get_option("taxonomy_" . $activity_level->term_id);
										$taxonomy_value = esc_attr($term_meta['activity_level_val']);
										$activity_levels_array[$taxonomy_value]	= array(
											'name' 		=> $activity_level->name,
											'slug' 		=> $activity_level->slug,
											'term_id' 	=> $activity_level->term_id,
										);
									}
								}
								ksort($activity_levels_array);
								if (isset($activity_levels_array) && count($activity_levels_array) > 0) {
									foreach ($activity_levels_array as $key => $val) { ?>
										<option value="<?php echo esc_attr($val['slug']); ?>"><?php echo sprintf(__('%s', 'entrada'), $val['name']); ?></option>
								<?php
									}
								} ?>

							</select>
						</div>
						<div class="select-col">
							<select class="filter-select" id="filter_price_range">
								<option value="" class="hideme"><?php _e('Price Range',  'entrada'); ?></option>
								<option value=""><?php _e('All Price Range',  'entrada'); ?></option>
								<?php entrada_product_price_range(true); ?>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php if ($loop->have_posts()) { ?>
			<div class="content-holder list-view" id="entrada_content_loader">
				<?php
					while ($loop->have_posts()) : $loop->the_post();
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

											<div class="product_rateYo"><span class="sr-only" itemprop="ratingValue"><?php echo esc_attr($average_rating); ?></span></div>
										</div>
										<?php $review_link = get_the_permalink() . '#tab04'; ?>
										<div class="info-rate" itemprop="reviewCount"><?php echo entrada_post_total_reviews(get_the_ID()); ?> / <a href="<?php echo esc_url($review_link); ?>"><?php _e('Give Rating',  'entrada'); ?></a></div>
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
															echo '<li class="pop-opener">
													<span class="' . $icomoon_class . '"></span>
													<div class="popup">' . ucwords($term->name) . '</div>
											</li>';
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
									<a href="<?php the_permalink(); ?>" class="btn btn-default" itemprop="url"><?php echo get_theme_mod('square_button_text', 'explore'); ?></a>
								</aside>
							</div>
						</div>
					</article>
				<?php endwhile; ?>
			</div>
			<nav class="loadmore-wrap text-center">
				<input type="hidden" id="posts_per_page" name="posts_per_page" value="<?php echo esc_attr($posts_per_page); ?>" />
				<input type="hidden" id="paged" name="paged" value="2" />
				<a href="javascript:void(null);" id="load_more_post" class="btn btn-default"><?php _e('LOAD MORE',  'entrada'); ?></a>
			</nav>
		<?php } ?>
	</div>
</div>
<?php get_template_part('template-parts/similar', 'tours'); ?>