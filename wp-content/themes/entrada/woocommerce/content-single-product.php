<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */

do_action('woocommerce_before_single_product');

if (post_password_required()) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}


global $product;
$social_media__share_image_url = '';
$attributes_string = '';
$average_rating =  entrada_post_average_rating(get_the_ID());
update_post_meta(get_the_ID(), '_last_viewed', current_time('mysql'));

entrada_set_post_views(get_the_ID());
$variations = entrada_product_variations(get_the_ID());

$entrada_product_type = get_post_meta(get_the_ID(), 'entrada_product_type', true);

/* Product image gallery */
global $post, $product, $woocommerce;
$gallery_image_urls = array();

if (has_post_thumbnail(get_the_ID())) :
	$thumb_id = get_post_thumbnail_id(get_the_ID());
	$featured_img = wp_get_attachment_image_src($thumb_id, 'single-post-thumbnail');
	$thumb = wp_get_attachment_image_src($thumb_id, 'medium');

	$gallery_image_urls[$thumb_id] = $featured_img[0];
	$social_media__share_image_url = $thumb[0];
endif;

$attachment_ids = $product->get_gallery_image_ids();
if ($attachment_ids) {
	foreach ($attachment_ids as $attachment_id) {
		$gallery_image_urls[$attachment_id] =  wp_get_attachment_url($attachment_id, 'large');
	}
}

if ($entrada_product_type == 'shop_item') :
?>
	<div class="common-spacing product-detail-container">
		<div class="container woocommerce">
			<div class="row">
				<div class="col-md-6">
					<?php if (count($gallery_image_urls) > 0) { ?>
						<div class="col-wrapper">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs nav-v col" role="tablist">
								<?php
								$entrada_item_image_gal_cnt = 0;
								foreach ($gallery_image_urls as $entrada_img_url) {
									$entrada_item_image_gal_cnt++;
									$active_class = ($entrada_item_image_gal_cnt < 2 ? 'active' : '');
								?>
									<li role="presentation" class="<?php echo esc_html($active_class); ?>">
										<a href="#item-<?php echo esc_attr($entrada_item_image_gal_cnt); ?>" aria-controls="item-<?php echo esc_attr($entrada_item_image_gal_cnt); ?>" role="tab" data-toggle="tab"><img src="<?php echo esc_url($entrada_img_url); ?>" alt="<?php echo entrada_image_attributes_from_src($entrada_img_url, 'title', true); ?>"></a>
									</li>
								<?php } ?>
							</ul>
							<!-- Tab panes -->
							<div class="tab-content col">
								<?php
								$entrada_item_image_gal_cnt = 0;
								foreach ($gallery_image_urls as $entrada_img_url) {
									$entrada_item_image_gal_cnt++;
									$active_class = ($entrada_item_image_gal_cnt < 2 ? 'active' : '');
								?>
									<div role="tabpanel" class="tab-pane <?php echo esc_html($active_class); ?>" id="item-<?php echo esc_attr($entrada_item_image_gal_cnt); ?>">
										<div class="img-container">
											<img src="<?php echo esc_url($entrada_img_url); ?>" alt="<?php echo entrada_image_attributes_from_src($entrada_img_url, 'title', true); ?>">
										</div>
									</div>

								<?php } ?>
							</div>
						</div>
					<?php } ?>
				</div>
				<div class="col-md-6">
					<?php do_action('woocommerce_single_product_summary'); ?>
				</div>
			</div>
		</div>
	</div>
<?php
else :
	if (class_exists('WC_Vendors')) {
		$auth = get_post(get_the_ID());
		$vendor_id = $auth->post_author;
	} ?>
	<!-- main tour information -->
	<div itemscope itemtype="http://schema.org/Product">
		<section class="container-fluid trip-info">
			<div class="two-columns row">
				<div class="col col-md-6">
					<!-- top image slideshow -->
					<?php

					if ($gallery_image_urls) { ?>
						<div id="tour-slide">
							<?php $entrada_product_img_resize_id = get_option('entrada_product_img_resize_id');
							$image_url = '';
							foreach ($gallery_image_urls as $key => $slider_img) {

								if (isset($entrada_product_img_resize_id) && $entrada_product_img_resize_id == 'wp_default') {
									$image_url = $slider_img;
									if (!empty($image_url)) { ?>
										<div class="slide">
											<div class="bg-no-stretch">
												<img src="<?php echo esc_url($image_url); ?>" itemprop="image" alt="<?php echo entrada_image_attributes_from_src($slider_img, 'title', true); ?>" height="1149" width="960">
											</div>
										</div>
									<?php }
								} else {
									$image = matthewruddy_image_resize($slider_img, 960, 1149, true, false);
									if (array_key_exists('url', $image) && $image['url'] != '') {
									?>
										<div class="slide">
											<div class="bg-stretch">
												<img src="<?php echo esc_url($image['url']); ?>" itemprop="image" alt="<?php echo entrada_image_attributes_from_src($slider_img, 'title', true); ?>" height="1149" width="960">
											</div>
										</div>

							<?php
									}
								}
							} ?>
						</div>
						<?php if (isset($vendor_id) && !is_super_admin($vendor_id)) { ?>
							<span class="wc_vendor_shop"><?php _e('Vendor',  'entrada'); ?></span>
						<?php } ?>
					<?php } ?>
				</div>
				<div class="col col-md-6 text-col">
					<div class="holder">
						<?php
						if ($product->is_type('booking')) {

							do_action('woocommerce_single_product_summary');
						} else {
						?>
							<h1 class="small-size" itemprop="name"><?php the_title(); ?></h1>
							<small class="price-prefix"><?php _e('from',  'entrada'); ?></small>
							<div class="price">
								<strong <?php echo entrada_price_schema_micro_data_link(get_the_ID()); ?>><?php entrada_product_price(get_the_ID(), true); ?></strong>
							</div>
							<div class="description" itemprop="description">
								<?php the_content(); ?>
							</div>
							<ul class="reviews-info">
								<li itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
									<div class="info-left">
										<strong class="title"><?php _e('Reviews',  'entrada'); ?></strong>
										<span class="value" itemprop="reviewCount"><?php $total_reviews = entrada_post_total_reviews(get_the_ID(), true);
																					printf(esc_html(_n('%d Review', '%d Reviews', $total_reviews, 'entrada')), $total_reviews); ?></span>
									</div>
									<div class="info-right">
										<div class="star-rating">
											<div class="average_rateYo"></div>
										</div>
										<span class="value" itemprop="ratingValue"><?php echo sprintf(__('%1$d/%2$d', 'entrada'), $average_rating, '5'); ?></span>
									</div>
								</li>
								<li>
									<div class="info-left">
										<strong class="title"><?php _e('Vacation Style',  'entrada'); ?></strong>
										<span class="value"><?php _e('Holiday Type',  'entrada'); ?></span>
									</div>
									<div class="info-right">
										<?php
										/* Product Tag..... */
										$product_tag = wp_get_post_terms(get_the_ID(), 'product_tag');
										if (count($product_tag) > 0) {
											echo '<ul class="ico-list">';
											foreach ($product_tag as $term) {
												$icomoon_class = entrada_icomoon_class($term->slug);
												if (!empty($icomoon_class)) {
													echo '<li class="pop-opener top">
											<span class="' . $icomoon_class . '"></span>
											<div class="popup">' . ucwords($term->name) . '</div>
											</li>';
												}
											}
											echo '</ul>';
										} ?>
										<span class="value"><?php echo entrada_product_holiday_types(get_the_ID(), false); ?></span>
									</div>
								</li>
								<li>
									<div class="info-left">
										<strong class="title"><?php _e('Activity Level',  'entrada'); ?></strong>
										<span class="value"><?php echo entrada_product_activity_level(get_the_ID(), 'title', false); ?></span>
									</div>
									<?php
									$activity_level = entrada_product_activity_level(get_the_ID(), 'level', false);
									if (!empty($activity_level)) { ?>
										<div class="info-right">
											<ul class="ico-list">
												<li><span class="icon-level<?php entrada_product_activity_level(get_the_ID(), 'level', true); ?>"></span></li>
											</ul>
											<span class="value"><?php echo sprintf(__('%1$d/%2$d', 'entrada'), $activity_level, '8'); ?></span>
										</div>
									<?php } ?>
								</li>
								<li>
									<?php
									$trip_group_size = get_post_meta(get_the_ID(), "trip_group_size", true);
									$trip_group_size_capacity = get_post_meta(get_the_ID(), "trip_group_size_capacity", true);
									if (!empty($trip_group_size)) {
										if ('Small Group' == $trip_group_size) {
											$group_name = __('Small Group',  'entrada');
										} else if ('Medium Group' == $trip_group_size) {
											$group_name = __('Medium Group',  'entrada');
										} else if ('Large Group' == $trip_group_size) {
											$group_name = __('Large Group',  'entrada');
										} ?>
										<div class="info-left">
											<strong class="title"><?php _e('Group Size',  'entrada'); ?></strong>
											<span class="value"><?php echo esc_html($group_name); ?></span>
										</div>
									<?php } ?>
									<div class="info-right">
										<?php
										$group_size_icon = entrada_product_group_size_icon(get_the_ID());
										if (!empty($group_size_icon)) {
											echo '<ul class="ico-list"><li>' . $group_size_icon . '</li></ul>';
										} ?>
										<?php
										if (!empty($trip_group_size_capacity)) {
											echo '<span class="value">' . $trip_group_size_capacity . '</span>';
										} ?>
									</div>
								</li>
							</ul>
							<div class="btn-holder">
								<form class="cart" method="post" enctype="multipart/form-data">
									<input type="hidden" name="quantity" value="1" title="Qty" class="input-text qty text">
									<input type="hidden" name="add-to-cart" value="<?php echo get_the_ID(); ?>">
									<?php
									if ($variations) {
										$attr = entrada_product_attributes(get_the_ID());
										if (count($attr) > 0) {
											foreach ($attr as $key => $value) {
												$attributes_string .= '&attribute_' . $key . '=';
												echo '<input type="hidden" name="attribute_' . $key . '" value="">';
											}
										}
									?>
										<input type="hidden" name="variation_id" value="<?php echo entrada_product_variation_id(get_the_ID()); ?>" />
									<?php
									}
									$variations_args = $variations;
									if ($variations_args) {
										$variations = array();
										foreach ($variations_args as $v) {
											$var_confirmed_date = get_post_meta($v, 'var_confirmed_date', true);
											if (strtotime($var_confirmed_date) > strtotime('now')) {
												$variations[] = $v;
											}
										}
									}

									$booknow_btn_txt = get_theme_mod('booknow_btn_text', 'Book Now');
									$booknow_btn_url_check = get_theme_mod('booknow_btn_url');
									if (empty($booknow_btn_txt)) {
										$booknow_btn_txt = __('Book Now',  'entrada');
									}
									if ($product->is_type('external')) {
										$_product_url = get_post_meta(get_the_ID(), '_product_url', true);
										$_button_text = get_post_meta(get_the_ID(), '_button_text', true);

										echo '<a href="' . $_product_url . '" class="btn btn-lg btn-info">' . $_button_text . '</a>';
									} else if (!empty($booknow_btn_url_check)) {
										$booknow_btn_url = get_theme_mod('booknow_btn_url', '#');
										echo '<a href="' . $booknow_btn_url . '" class="btn btn-lg btn-info">' . $booknow_btn_txt . '</a>';
									} else if ($product->is_type('variable')) {
										if ($variations) {
											echo '<a href="#tab06" class="btn btn-lg btn-info book_now_dates">' . $booknow_btn_txt . '</a>';
										} else {

											echo '<button type="submit" class="btn btn-lg btn-info" id="book_now_dates">' . $booknow_btn_txt . '</button>';
										}
									} else {
										echo '<button type="submit" class="btn btn-lg btn-info" id="book_now_dates">' . $booknow_btn_txt . '</button>';
									}
									?>
								</form>
							</div>
							<?php
							$social_media__share_url 	 = get_permalink();
							$social_media__share_title 	 = get_the_title();
							$social_media__share_content = entrada_truncate(get_the_ID(), 40, 180, 'id');
							$social_media__share_content = str_replace("'s", "`s", $social_media__share_content); ?>
							<ul class="social-networks social-share">
								<li>
									<a href="javascript:void(0);" onclick="fb_callout('<?php echo esc_js($social_media__share_url); ?>', '<?php echo esc_js($social_media__share_image_url); ?>', '<?php echo esc_js($social_media__share_title); ?>', '<?php echo sprintf(__('%s', 'entrada'), $social_media__share_content); ?>');" class="facebook">
										<span class="ico">
											<span class="icon-facebook"></span>
										</span>
										<span class="text"><?php _e('Share',  'entrada'); ?></span>
									</a>
								</li>
								<li>
									<a href="javascript:void(0);" onClick="share_on_twitter('<?php echo esc_url($social_media__share_url); ?>', '<?php echo esc_js($social_media__share_title); ?>');" class="twitter">
										<span class="ico">
											<span class="icon-twitter"></span>
										</span>
										<span class="text"><?php _e('Tweet',  'entrada'); ?></span>
									</a>
								</li>
							</ul>
						<?php } ?>
					</div>
				</div>
			</div>
		</section>
		<div class="tab-container">
			<div class="nav-wrap" id="sticky-tab">
				<div class="container">
					<!-- Nav tabs -->
					<?php
					$active_class = $assigned_class = $product_itinerary_count = $faq_question_count = '';
					$product_overview_detail = get_post_meta(get_the_ID(), 'product_overview_detail', true);
					$product_itinerary_arr 	 = array();
					$product_itinerary 		 = get_post_meta(get_the_ID(), 'product_itinerary');
					if (isset($product_itinerary) && !empty($product_itinerary)) {
						$product_itinerary_arr = maybe_unserialize($product_itinerary[0]);
						if ($product_itinerary_arr) {
							foreach ($product_itinerary_arr as $itinerary) {
								if (!empty($itinerary['itinerary_title'])) $product_itinerary_count = 'yes';
							}
						}
					}
					$product_accommodation   = get_post_meta(get_the_ID(), 'product_accommodation', true);
					$product_faq 	 		 = get_post_meta(get_the_ID(), 'product_faq', true);
					$product_faq_arr 		 = array();
					if (isset($product_faq) && !empty($product_faq)) {
						$product_faq_arr = maybe_unserialize($product_faq);
						if (count($product_faq_arr) > 0) $faq_question_count = 'yes';
					}

					$product_gallery_images  = get_post_meta(get_the_ID(), 'product_gallery_img', true); ?>

					<ul class="nav nav-tabs text-center tab-add" role="tablist">
						<?php
						if (isset($product_overview_detail) && !empty($product_overview_detail)) {
							$overview = get_theme_mod('label_for_overview');
							if (!isset($overview) || empty($overview)) {
								$overview = __('Overview',  'entrada');
							}
						?>
							<li role="presentation" class="active"><a href="#tab01" aria-controls="tab01" role="tab" data-toggle="tab"><?php echo esc_html($overview); ?></a></li>
						<?php
							$assigned_class = 'assigned';
						}
						if ('yes' == $product_itinerary_count) {
							$active_class = ($assigned_class == 'assigned') ? '' : 'class="active"';
							$itinerary = get_theme_mod('label_for_itinerary');
							if (!isset($itinerary) || empty($itinerary)) {
								$itinerary = __('Itinerary',  'entrada');
							}
						?>
							<li role="presentation" <?php echo esc_html($active_class); ?>><a href="#tab02" aria-controls="tab02" role="tab" data-toggle="tab"><?php echo esc_html($itinerary); ?></a></li>
						<?php
							$assigned_class = 'assigned';
						}
						if (isset($product_accommodation) && !empty($product_accommodation)) {
							$active_class = ($assigned_class == 'assigned') ? '' : 'class="active"';
							$accomodation = get_theme_mod('label_for_accomodation');
							if (!isset($accomodation) || empty($accomodation)) {
								$accomodation = __('Accomodation',  'entrada');
							}
						?>
							<li role="presentation" <?php echo esc_html($active_class); ?>><a href="#tab03" aria-controls="tab03" role="tab" data-toggle="tab"><?php echo esc_html($accomodation); ?></a></li>
						<?php
							$assigned_class = 'assigned';
						}
						if ('yes' == $faq_question_count) {
							$active_class = ($assigned_class == 'assigned') ? '' : 'class="active"';

							$faqs = get_theme_mod('label_for_faqs');
							if (!isset($faqs) || empty($faqs)) {
								$faqs = __('FAQs & Reviews',  'entrada');
							}
						?>
							<li role="presentation" <?php echo esc_html($active_class); ?>><a href="#tab04" aria-controls="tab04" role="tab" data-toggle="tab"><?php echo esc_html($faqs); ?></a></li>
						<?php
							$assigned_class = 'assigned';
						}
						if (isset($product_gallery_images) && !empty($product_gallery_images)) {
							$active_class = ($assigned_class == 'assigned') ? '' : 'class="active"';
							$gallery = get_theme_mod('label_for_gallery');
							if (!isset($gallery) || empty($gallery)) {
								$gallery = __('Gallery',  'entrada');
							}
						?>
							<li role="presentation" <?php echo esc_html($active_class); ?>><a href="#tab05" aria-controls="tab05" role="tab" data-toggle="tab"><?php echo esc_html($gallery); ?></a></li>
						<?php
							$assigned_class = 'assigned';
						}
						if ($variations) {
							$active_class = ($assigned_class == 'assigned') ? '' : 'class="active"';
							$dates = get_theme_mod('label_for_dates');
							if (!isset($dates) || empty($dates)) {
								$dates = __('Dates & Prices',  'entrada');
							}
						?>
							<li role="presentation" class="book_now_dates_li <?php echo esc_html($active_class); ?>"><a href="#tab06" aria-controls="tab06" role="tab" class="book_now_dates_href" data-toggle="tab"><?php echo esc_html($dates); ?></a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<!-- Tab panes -->
			<?php $active_class = $assigned_class = ''; ?>
			<div class="container tab-content trip-detail">
				<!-- Overview tab content -->
				<?php if (isset($product_overview_detail) && !empty($product_overview_detail)) {
					$active_class = ($assigned_class == 'assigned') ? '' : 'active'; ?>
					<div role="tabpanel" class="tab-pane <?php echo esc_html($active_class); ?>" id="tab01">
						<div class="row">
							<div class="col-md-6">
								<?php
								$title = get_the_title();
								echo '<strong class="header-box">' . sprintf(__('All about the %s.', 'entrada'), $title) . '</strong>';
								echo '<div class="detail">' . apply_filters('the_content', $product_overview_detail) . '</div>';
								?>
							</div>
							<div class="col-md-6">
								<?php
								$product_overview_included_feature 	   = get_post_meta(get_the_ID(), 'product_overview_included_feature', true);
								$product_overview_not_included_feature = get_post_meta(get_the_ID(), 'product_overview_not_included_feature', true);

								if (!empty($product_overview_included_feature) || !empty($product_overview_not_included_feature)) {
									echo '<strong class="header-box">' . __('The tour package inclusions and exclusions at a glance', 'entrada') . '</strong>';
								}

								echo '<div>';

								if (!empty($product_overview_included_feature)) {
									echo '<div class="text-box"><div class="holder">';
									echo '<strong class="title">' . __('What is included in this tour?', 'entrada') . '</strong>';
									echo '<span class="sub-title">' . __('Items that are included in the cost of tour price.', 'entrada') . '</span>';
									echo apply_filters('the_content', $product_overview_included_feature);
									echo '</div></div>';
								}

								if (!empty($product_overview_not_included_feature)) {
									echo '<div class="text-box not-included"><div class="holder">';
									echo '<strong class="title">' . __('What is not included in this tour?', 'entrada') . '</strong>';
									echo '<span class="sub-title">' . __('Items that are not included in the cost of tour price.', 'entrada') . '</span>';
									echo apply_filters('the_content', $product_overview_not_included_feature);
									echo '</div></div>';
								}
								echo '</div>';
								?>
							</div>
						</div>
					</div>
				<?php $assigned_class = 'assigned';
				} ?>
				<!-- itinerary tab content -->
				<?php if (isset($product_itinerary_arr) && 'yes' == $product_itinerary_count) {
					$active_class = ($assigned_class == 'assigned') ? '' : 'active';
					$cnt = 0; ?>
					<div role="tabpanel" class="tab-pane <?php echo esc_html($active_class); ?>" id="tab02">
						<div class="row">
							<div class="col-md-6">
								<ol class="detail-accordion">
									<?php
									foreach ($product_itinerary_arr as $itinerary) {
										$cnt++;

										if (array_key_exists("itinerary_txt", $itinerary) && $itinerary['itinerary_txt'] != '') {
											$itinerary_txt = stripslashes($itinerary['itinerary_txt']);
										} else {
											$itinerary_txt = __('Day', 'entrada') . $cnt;
										}
										if (!empty($itinerary['itinerary_title'])) {
											$activ_mode = ($cnt == 1) ? 'active' : '';
									?>
											<li class="<?php echo esc_attr($activ_mode); ?>">
												<a href="#">
													<strong class="title"><?php echo esc_html($itinerary_txt); ?> </strong>
													<span><?php echo stripslashes($itinerary['itinerary_title']); ?></span>
												</a>
												<div class="slide">
													<div class="slide-holder">
														<?php $itinerary_desc =  apply_filters('the_content', $itinerary['itinerary_desc']);
														echo apply_filters('the_content', stripslashes($itinerary_desc));
														?>
													</div>
												</div>
											</li>
									<?php
										}
									} ?>
								</ol>
							</div>
							<div class="col-md-6">
								<?php
								$itinerary_gallery_images_arr = array();
								$itinerary_gallery_img 		  = get_post_meta(get_the_ID(), 'itinerary_gallery_img', true);
								if (isset($itinerary_gallery_img) && !empty($itinerary_gallery_img)) {
									$itinerary_gallery_images_arr = maybe_unserialize($itinerary_gallery_img);
								}

								if (count($itinerary_gallery_images_arr) > 0) {
									foreach ($itinerary_gallery_images_arr as $itinerary_gal_img_id) {
										$itinerary_gal_img = wp_get_attachment_url($itinerary_gal_img_id);
										$image = matthewruddy_image_resize($itinerary_gal_img, 570, 319, true, false);
										if (array_key_exists('url', $image) && $image['url'] != '') { ?>
											<article class="img-article article-light">
												<div class="img-wrap">
													<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo entrada_image_attributes_from_src($itinerary_gal_img, 'title', true); ?>">
												</div>
												<div class="text-block">
													<?php
													$attach_metadata = entrada_image_attributes($itinerary_gal_img_id);

													if (!empty($attach_metadata['caption'])) {
														echo '<h3><a href="#">' . $attach_metadata['caption'] . '</a></h3>';
													}

													if (!empty($attach_metadata['desc'])) {
														echo '<p>' . $attach_metadata['desc'] . '</p>';
													}
													?>
												</div>
											</article>
								<?php
										}
									}
								} ?>
							</div>
						</div>
					</div>
				<?php $assigned_class = 'assigned';
				} ?>
				<!-- accomodation tab content -->
				<?php if (isset($product_accommodation) && !empty($product_accommodation)) {
					$active_class = ($assigned_class == 'assigned') ? '' : 'active'; ?>
					<div role="tabpanel" class="tab-pane <?php echo esc_html($active_class); ?>" id="tab03">
						<div class="row">
							<div class="col-md-6">
								<?php
								$hotel_name = get_post_meta(get_the_ID(), 'hotel_name', true);
								if (isset($hotel_name) && $hotel_name != '') {
									echo '<strong class="header-box">' . $hotel_name . '</strong>';
								}
								echo '<div class="detail">' . apply_filters('the_content', $product_accommodation) . '</div>';
								?>
							</div>
							<div class="col-md-6 accomodation-block">
								<?php
								$product_shared_room_included_feature = get_post_meta(get_the_ID(), 'product_shared_room_included_feature', true);
								$included_title = get_post_meta(get_the_ID(), 'included_title', true);
								$included_sub_title = get_post_meta(get_the_ID(), 'included_sub_title', true);

								$product_individual_room_not_included_feature = get_post_meta(get_the_ID(), 'product_individual_room_not_included_feature', true);
								$excluded_title 	= get_post_meta(get_the_ID(), 'excluded_title', true);
								$excluded_sub_title = get_post_meta(get_the_ID(), 'excluded_sub_title', true);
								if (!empty($product_shared_room_included_feature) && !empty($product_individual_room_not_included_feature)) {
									echo '<strong class="header-box">' . __('The tour package inclusions and exclusions at a glance.', 'entrada') . '</strong>';
								}
								echo '<div>';
								if (isset($product_shared_room_included_feature) && $product_shared_room_included_feature != '') {
									echo '<div class="text-box"><div class="holder">';
									echo '<strong class="title">' . $included_title . '</strong>';
									echo '<span class="sub-title">' . $included_sub_title . '</span>';
									echo '<div class="img-holder">' . apply_filters('the_content', $product_shared_room_included_feature) . '</div>';
									echo '</div>';
									echo '</div>';
								}
								if (isset($product_individual_room_not_included_feature) && $product_individual_room_not_included_feature != '') {
									echo '<div class="text-box not-included">';
									echo '<div class="holder">';
									echo '<strong class="title">' . $excluded_title . '</strong>';
									echo '<span class="sub-title">' . $excluded_sub_title . '</span>';
									echo '<div class="img-holder">' . apply_filters('the_content', $product_individual_room_not_included_feature) . '</div>';
									echo '</div>';
									echo '</div>';
								}
								echo '</div>'; ?>
							</div>
						</div>
					</div>
				<?php $assigned_class = 'assigned';
				} ?>
				<!-- faq and review tab content -->
				<?php if ('yes' == $faq_question_count) {
					$active_class = ($assigned_class == 'assigned') ? '' : 'active'; ?>
					<div role="tabpanel" class="tab-pane <?php echo esc_html($active_class); ?>" id="tab04">
						<div class="row">
							<div class="col-md-6">
								<?php
								$product_faq_arr = array();
								$product_faq_arr = maybe_unserialize($product_faq);
								if (count($product_faq_arr) > 0) { ?>
									<div class="question-select">
										<select id="tabSelect" class="question">
											<?php
											$faq_cnt = 0;
											if (is_array($product_faq_arr) || is_object($product_faq_arr)) {
												foreach ($product_faq_arr as $faq) {
													$faq_cnt++;
													$active_faq = ($faq_cnt == 1 ? ' selected="selected"' : '');
													echo '<option ' . $active_faq . ' value="#innerTab' . $faq_cnt . '">' . stripslashes($faq['faq_question']) . '</option>';
												}
											} ?>
										</select>
										<ul class="nav nav-tabs" id="questionTab">
											<?php
											$faq_cnt = 0;
											if (is_array($product_faq_arr) || is_object($product_faq_arr)) {
												foreach ($product_faq_arr as $faq) {
													$faq_cnt++;
													$active_faq = ($faq_cnt == 1 ? ' class="active"' : '');
													echo '<li' . $active_faq . '><a href="#innerTab' . $faq_cnt . '" data-toggle="tab">' . stripslashes($faq['faq_question']) . '</a></li>';
												}
											} ?>
										</ul>
									</div>
									<div class="tab-wrapper">
										<?php
										$faq_cnt = 0;
										if (is_array($product_faq_arr) || is_object($product_faq_arr)) {
											foreach ($product_faq_arr as $faq) {
												$faq_cnt++;
												$active_faq = ($faq_cnt == 1 ? ' active' : '');
												echo '<div role="tabpanel" class="tab-pane' . $active_faq . '" id="innerTab' . $faq_cnt . '"><div class="detail">' . apply_filters('the_content', stripslashes($faq['faq_answer'])) . '</div></div>';
											}
										} ?>
									</div>
								<?php } ?>
							</div>
							<div class="col-md-6">
								<?php
								wc_get_template('product-reviews.php');
								wc_get_template('write-a-review.php'); ?>
							</div>
						</div>
					</div>
				<?php $assigned_class = 'assigned';
				} ?>
				<!-- gallery tab content -->
				<?php if (isset($product_gallery_images) && !empty($product_gallery_images)) {
					$active_class = ($assigned_class == 'assigned') ? '' : 'active'; ?>
					<div role="tabpanel" class="tab-pane <?php echo esc_html($active_class); ?>" id="tab05">
						<ul class="row gallery-list has-center">
							<?php
							$product_gallery_images_arr = array();
							$product_gallery_images_arr = maybe_unserialize($product_gallery_images);
							if ($product_gallery_images_arr) {
								foreach ($product_gallery_images_arr as $product_gal_img_id) {
									$product_gal_img = wp_get_attachment_url($product_gal_img_id);
									$image = matthewruddy_image_resize($product_gal_img, 370, 240, true, false);
									$attach_metadata = entrada_image_attributes($product_gal_img_id);
									if (array_key_exists('url', $image) && $image['url']  != '') {
							?>
										<li class="col-sm-6">
											<a class="fancybox" data-fancybox-group="group" href="<?php echo esc_attr($product_gal_img); ?>" title="<?php echo entrada_image_attributes_from_src($product_gal_img, 'title', true); ?>">
												<span class="img-holder">
													<img src="<?php echo esc_url($image['url']); ?>" height="240" width="370" alt="<?php echo entrada_image_attributes_from_src($product_gal_img, 'title', true); ?>">
												</span>
												<span class="caption">
													<span class="centered">
														<strong class="title"><?php echo esc_html($attach_metadata['title']); ?></strong>
														<span class="sub-text"><?php echo esc_html($attach_metadata['desc']); ?></span>
													</span>
												</span>
											</a>
										</li>
							<?php   }
								}
							} ?>
						</ul>
					</div>
				<?php $assigned_class = 'assigned';
				} ?>
				<!-- dates and prices tab content -->
				<?php if ($variations) {
					$active_class = ($assigned_class == 'assigned') ? '' : 'active'; ?>
					<div role="tabpanel" class="tab-pane <?php echo esc_html($active_class); ?>" id="tab06">
						<div class="table-container">
							<div class="table-responsive">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>
												<strong class="date-text"><?php _e('Package',  'entrada'); ?></strong>
												<span class="sub-text"><?php _e('Confirmed Dates',  'entrada'); ?></span>
											</th>
											<th>
												<strong class="date-text"><?php _e('Trip Status',  'entrada'); ?></strong>
												<span class="sub-text"><?php _e('Trip Status',  'entrada'); ?></span>
											</th>
											<th>
												<strong class="date-text"><?php _e('Price (PP)',  'entrada'); ?></strong>
												<span class="sub-text"><?php _e('Excluding Flights',  'entrada'); ?></span>
											</th>
											<th>
												<strong class="date-text"><?php _e('Price (PP)',  'entrada'); ?></strong>
												<span class="sub-text"><?php _e('Including Flights',  'entrada'); ?></span>
											</th>
											<th>&nbsp;

											</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$attr_count = 0;
										$n_a_text   = __('N/A',  'entrada');
										foreach ($variations as $v) {

										?>
											<tr class="price" <?php echo entrada_price_schema_micro_data_link($v); ?>>
												<td>
													<div class="cell">
														<div class="middle">
															<?php
															$var_confirmed_date = get_post_meta($v, 'var_confirmed_date', true);
															$var_returning_date = get_post_meta($v, 'var_returning_date', true);
															if (!empty($var_confirmed_date)) {
																echo date_i18n(get_option('date_format'), strtotime($var_confirmed_date));
															}

															if (!empty($var_returning_date)) {
																echo ' - ' . date_i18n(get_option('date_format'), strtotime($var_returning_date));
															}

															?>

														</div>
													</div>
												</td>

												<td>
													<div class="cell">
														<div class="middle">
															<?php
															$var_tour_status = get_post_meta($v, 'var_tour_status', true);


															if ($var_tour_status) {
																echo sprintf(__('%s', 'entrada'), $var_tour_status);
															} else {
																echo sprintf(__('%s', 'entrada'), $n_a_text);
															}


															?>
														</div>
													</div>
												</td>

												<td>
													<div class="cell">
														<div class="middle">
															<?php
															$price_exc_flights = get_post_meta($v, '_price', true);


															if ($price_exc_flights) {
																echo entrada_price($price_exc_flights, $args = array(), 'sale_price');
															} else {
																echo sprintf(__('%s', 'entrada'), $n_a_text);
															}

															?>
														</div>
													</div>
												</td>

												<td>
													<div class="cell">
														<div class="middle">
															<?php
															$var_price_inc_flight = get_post_meta($v, 'var_price_inc_flight', true);



															if ($var_price_inc_flight) {
																echo entrada_price($var_price_inc_flight, $args, 'regular_price');
															} else {
																echo sprintf(__('%s', 'entrada'), $n_a_text);
															}


															?>
														</div>
													</div>
												</td>
												<?php
												$var_variation_url = get_post_meta($v, 'var_variation_url', true);

												if (!empty($var_variation_url)) {
													$booknow_btn_url = $var_variation_url;
												} else if (!empty($booknow_btn_url_check)) {
													$booknow_btn_url = get_theme_mod('booknow_btn_url');
												} else {

													$attributes_string = '';
													if (count($attr) > 0) {
														foreach ($attr as $key => $value) {
															$meta = get_post_meta($v, 'attribute_' . $key, true);
															$attributes_string .= '&attribute_' . $key . '=' . $meta;
														}
													}
													$booknow_btn_url = '?add-to-cart=' . get_the_ID() . '&variation_id=' . $v . $attributes_string;
												}
												?>
												<td>
													<div class="cell">
														<div class="middle">
															<a href="<?php echo esc_url($booknow_btn_url); ?>" class="btn btn-default"><?php echo esc_html($booknow_btn_txt); ?></a>
														</div>
													</div>
												</td>
											</tr>
										<?php
											$attr_count++;
										} ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>

<?php endif; ?>

<aside class="recent-block recent-gray recent-wide-thumbnail">
	<div class="container">
		<?php echo entrada_recently_viewed_product(get_the_ID()); ?>
	</div>
</aside>
<input class="average_rating" type="hidden" readonly="readonly" value="<?php echo esc_js($average_rating); ?>">
<?php do_action('woocommerce_after_single_product'); ?>