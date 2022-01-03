<?php
/* Entrada VC Extended shortcode
---------------------------------------------------------- */
add_shortcode('bartag', 'bartag_custom_entrada_heading');
function bartag_custom_entrada_heading($atts, $content = null)
{ // New function parameter $content is added!
	extract(shortcode_atts(array(
		'entrada_heading' => 'Entrada Heading',
		'color' => '#FFF'
	), $atts));

	$content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

	return "<header class='content-heading'>
						<h2 class='main-heading'>${entrada_heading}</h2>
						<div class='main-subtitle'>{$content}</div>
						<div class='seperator'></div>
					</header>";
}

/*  Entrada VC Post grid Shortcode
---------------------------------------------------------- */
add_shortcode('entradapostgrid', 'entrada_vc_custom_postgrid');
function entrada_vc_custom_postgrid($atts, $content = null)
{
	global $wpdb;
	extract(shortcode_atts(array(
		'entrada_postgrid_title' => 'Entrada Post Grid Title',
		'post_type' => 'guide',
		'display_style' => 'guide',
		'entrada_column' => '4',
		'total_item' => '3',
		'orderby' => 'date',
		'order' => 'DESC'
	), $atts));

	$html_content = '';
	$post_type = "{$post_type}";
	$display_style = "{$display_style}";
	$entrada_column = "{$entrada_column}";
	$total_item = "{$total_item}";
	$orderby = "{$orderby}";
	$order = "{$order}";

	$args = array(
		'post_type'		 =>  $post_type,
		'showposts'  	 =>  $total_item,
		'orderby'        => $orderby,
		'order'          => $order
	);

	if (!isset($entrada_column) || empty($entrada_column)) {
		$entrada_column_class = 'col-md-4';
	} else {
		$entrada_column_class = 'col-md-' . $entrada_column;
	}

	$theme = wp_get_theme();
	if ('entrada' == strtolower($theme->name) || 'entrada' == strtolower($theme->parent_theme)) {
		switch ($display_style) {
			case "partner":

				$epost = new WP_Query($args);
				if ($epost->have_posts()) {
					$html_content .= '<div class="partner-list" id="partner-slide">';
					while ($epost->have_posts()) : $epost->the_post();
						$epost_id = get_the_ID();

						if (get_post_meta($epost_id, 'parner_url', true) != '') {
							$parner_url = get_post_meta($epost_id, 'parner_url', true);
						} else {
							$parner_url = '#';
						}

						if (get_post_meta($epost_id, 'partner_secondary_img_id', true) != '') {
							$partner_secondary_img_id = get_post_meta($epost_id, 'partner_secondary_img_id', true);
						} else {
							$partner_secondary_img_id = '';
						}

						$feat_image_url = wp_get_attachment_url(get_post_thumbnail_id($epost_id));
						if (!empty($feat_image_url)) {
							$html_content .= '<div class="partner">
									<a href="' . $parner_url . '" target="_blank">
									<img src="' . $feat_image_url . '" alt="' . get_the_title($epost_id) . '">';

							if (isset($partner_secondary_img_id) && $partner_secondary_img_id != '') {
								$parner_secondary_img_src = wp_get_attachment_url($partner_secondary_img_id);

								$html_content .= '<img  class="hover" src="' . $parner_secondary_img_src . '" alt="' . get_the_title($epost_id) . '" >';
							}
							$html_content .= '</a>
								</div>';
						}
					endwhile;
					wp_reset_query();
					$html_content .= '</div>';
				}

				break;

			case "testimonial":

				$epost = new WP_Query($args);
				if ($epost->have_posts()) {

					$html_content .= '<div class="container">
							<div id="testimonial-home-slide">';
					$carousel_control = '';
					$cnt = 0;
					while ($epost->have_posts()) : $epost->the_post();
						$epost_id = get_the_ID();
						$testi_custom_url = get_post_meta($epost_id, 'testi_custom_url', true);

						$html_content .= '<div class="slide">
								<blockquote class="testimonial-quote">';

						$feat_image_url = wp_get_attachment_url(get_post_thumbnail_id($epost_id));
						if (!empty($feat_image_url)) {
							$image = matthewruddy_image_resize($feat_image_url, 112, 112, true, false);
							$html_content .= '<div class="img">
										<img src="' . $image['url'] . '"  alt="' . get_the_title($epost_id) . '">
									</div>';
						}

						$testi_content = strip_tags(get_the_content());
						$testi_read_more = '';

						if (!empty($testi_custom_url)) {
							$testi_read_more = '<a href="' . $testi_custom_url . '">' . __('Read More', 'entrada') . '</a>';
						} else if (str_word_count($testi_content) > 40) {
							$testi_read_more = '<a href="' . get_permalink() . '">' . __('Read More', 'entrada') . '</a>';
						}

						$html_content .= '<div class="text">
										<cite>' . get_the_title($epost_id) . '</cite>
										<q>' . entrada_truncate($testi_content, 40, 200) . ' ' . $testi_read_more . '</q>
									</div>
								</blockquote>
							</div>';
						$cnt++;
					endwhile;
					wp_reset_query();
					$html_content .= '</div></div>';
				}

				break;

			case 'top_adventure':

				$args = entrada_vc_product_type_meta_query($args, 'tour');
				$featured_query = new WP_Query($args);
				if ($featured_query->have_posts()) :

					$html_content .= '<div class="content-holder content-boxed content-spacing">';
					$html_content .= '<div class="row db-3-col">';

					while ($featured_query->have_posts()) :
						$featured_query->the_post();

						$share_txt  = entrada_truncate(strip_tags(get_the_content($featured_query->post->ID)), 30, 110);
						$entrada_social_media_share_img = '';

						$html_content .= '<article class="col-sm-6 ' . $entrada_column_class . ' article has-hover-s1">
										<div class="thumbnail" itemscope itemtype="http://schema.org/Product">';
						$entrada_social_media_share_img =  entrada_social_media_share_img(get_the_ID());
						//$html_content .= entrada_product_resized_img(get_the_ID(), $resize = array(550, 358));
						$html_content .= '<a href="' . get_permalink($featured_query->post->ID) . '" itemprop="name">' . entrada_product_resized_img(get_the_ID(), $resize = array(550, 358));

						$html_content .= '<h3 class="small-space"><a href="' . get_permalink($featured_query->post->ID) . '" itemprop="name">' . get_the_title($featured_query->post->ID) . '</a></h3>
								<span class="info">';

						$term_list = wp_get_post_terms($featured_query->post->ID, 'product_cat', array('fields' => 'ids'));
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
								<aside class="meta">' . entrada_destinations_activities_count($featured_query->post->ID, false) . '
								</aside>
								<p itemprop="description">' . entrada_truncate(strip_tags(get_the_content()), 40, 180) . '</p>
								<a href="' . get_permalink($featured_query->post->ID) . '" class="btn btn-default" itemprop="url">' . get_theme_mod('square_button_text', 'explore') . '</a>
								<footer>
									<ul class="social-networks">
										' . entrada_social_media_share_btn(get_the_title($featured_query->post->ID), get_permalink($featured_query->post->ID), $share_txt, $entrada_social_media_share_img) . '
									</ul>
									<span class="price">';

						$product_price = entrada_product_price($featured_query->post->ID);

						if ($product_price != '') {
							$html_content .= entrada_price_from_txt($product_price);
							$html_content .= ' <span ' . entrada_price_schema_micro_data_link(get_the_ID()) . '>' . $product_price . '</span>';
						}
						$html_content .= '</span>
											</footer>
											</div>
											</article>';

					endwhile;

					$html_content .= '</div>';
					$html_content .= '</div>';
				endif;
				wp_reset_query();

				break;

			case 'popular_tour':

				$args['orderby'] = 'meta_value';
				$args['meta_key'] = 'total_sales';

				$args = entrada_vc_product_type_meta_query($args, 'tour');

				$featured_query = new WP_Query($args);
				if ($featured_query->have_posts()) :
					$cnt = 0;
					$html_content .= '<div class="content-holder content-spacing">';
					$html_content .= '<div class="row db-3-col">';

					while ($featured_query->have_posts()) :
						$featured_query->the_post();

						$trip_sub_heading = get_post_meta($featured_query->post->ID, "trip_sub_heading", true);
						$average_rating = '';
						$average_rating =  entrada_post_average_rating($featured_query->post->ID);
						$html_content .= '<article class="col-sm-6 ' . $entrada_column_class . ' article has-hover-s3" itemscope itemtype="http://schema.org/Product"><div class="img-wrap">';

						$entrada_social_media_share_img =  entrada_social_media_share_img($featured_query->post->ID);

						if (has_post_thumbnail($featured_query->post->ID)) :

							$html_content .= '<a href="' . get_permalink($featured_query->post->ID) . '">' . get_the_post_thumbnail($featured_query->post->ID, array(550, 358)) . '</a>';

						endif;


						$trip_duration = get_post_meta($featured_query->post->ID, "trip_duration", true);

						if ($trip_sub_heading != '') {
							$html_content .= '<div class="img-caption">' . $trip_duration . '</div>';
						}

						$html_content .=	'<div class="hover-article">
												<div class="star-rating">
													<input class="front_rating" type="hidden" value="' . $average_rating . '">
													<div class="front_rateYo"></div>
												</div>
												<div class="icons">
													' . entrada_wishlist_html(get_the_ID()) . '
													<a href="' . get_permalink($featured_query->post->ID) . '" itemprop="url"><span class="icon-reply"></span></a>
												</div>
												<div class="info-footer">';

						$product_price = entrada_product_price($featured_query->post->ID);

						if (isset($product_price) && !empty($product_price)) {
							$html_content .= '<span class="price">' . entrada_price_from_txt($product_price) . '<span ' . entrada_price_schema_micro_data_link(get_the_ID()) . '>' . $product_price . '</span></span>';
						}

						$html_content .=	'<a href="' . get_permalink($featured_query->post->ID) . '" class="link-more" itemprop="url">' . get_theme_mod('square_button_text', 'explore') . '</a>
												</div>
											</div>
										</div>
										<h3><a href="' . get_permalink($featured_query->post->ID) . '" itemprop="name">' . get_the_title($featured_query->post->ID) . '</a></h3>
										<p itemprop="description">' . entrada_truncate(strip_tags(get_the_content()), 30, 140) . '</p>
									</article>';

					endwhile;


					$html_content .= '</div>';
					$html_content .= '</div>';

				endif;
				wp_reset_query();

				break;

			case 'featured_tour':

				//$args['meta_key'] = '_featured';
				//$args['meta_value'] = 'yes';

				$tax_query[] = array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => 'featured',
					'operator' => 'IN',
				);

				$args['tax_query'] = $tax_query;

				$args = entrada_vc_product_type_meta_query($args, 'tour');

				$featured_query = new WP_Query($args);

				if ($featured_query->have_posts()) :
					$cnt = 0;

					while ($featured_query->have_posts()) :
						$featured_query->the_post();
						$image_url = array();
						$cnt++;

						$slide_section1 = ($cnt % 2 == 0) ? 'slideInRight' : 'slideInLeft';
						$slide_section2 = ($cnt % 2 == 0) ? 'slideInLeft' : 'slideInRight';


						$html_content .= '<div class="row same-height">';

						if (has_post_thumbnail($featured_query->post->ID)) :

							$image_url = wp_get_attachment_image_src(get_post_thumbnail_id($featured_query->post->ID), 'single-post-thumbnail');

							if (count($image_url) > 0) {
								$image = matthewruddy_image_resize($image_url[0], 960, 627, true, false);
								if (array_key_exists('url', $image) && $image['url'] != '') {
									$html_content .= '<div class="col-sm-6 image height wow ' . $slide_section1 . '">
										<div class="bg-stretch">
											<img src="' . $image['url'] . '"  alt="' . get_the_title($featured_query->post->ID) . '">
										</div>
									</div>';
								}
							}

						endif;

						$html_content .= '<div class="col-sm-6 text-block height wow ' . $slide_section2 . '">
													<div class="centered">
														<h2 class="intro-heading">' . get_the_title($featured_query->post->ID) . '</h2>
														<p class="intro">' . entrada_truncate(strip_tags(get_the_content()), 40, 180) . '</p>
														<a href="' . get_permalink($featured_query->post->ID) . '" class="btn btn-primary btn-lg">' . get_theme_mod('large_button_text', 'explore') . '</a>
													</div>
												</div>
											</div>';

					endwhile;

				endif;
				wp_reset_query();

				break;

			default:

				$eposts = new WP_Query($args);

				if ($eposts->have_posts()) {
					$html_content .= '<div class="content-holder">';
					$html_content .= '<div class="row">';
					while ($eposts->have_posts()) : $eposts->the_post();
						$post_id = 	get_the_ID();
						/* Social URL icons append here */
						$social_icons = '';
						$facebook_url = get_post_meta($post_id, 'facebook_url', true);
						$twitter_url = get_post_meta($post_id, 'twitter_url', true);
						$instagram_url = get_post_meta($post_id, 'instagram_url', true);
						$guide_custom_url = get_post_meta($post_id, 'guide_custom_url', true);

						if (!empty($facebook_url)) {
							$social_icons .= '<li><a href="' . $facebook_url . '" target="_blank"><span class="icon-facebook">
							</span></a></li>';
						}
						if (!empty($twitter_url)) {
							$social_icons .= '<li><a href="' . $twitter_url . '" target="_blank"><span class="icon-twitter">
							</span></a></li>';
						}
						if (!empty($instagram_url)) {
							$social_icons .= '<li><a href="' . $instagram_url . '" target="_blank"><span class="icon-instagram">
							</span></a></li>';
						}
						if (!empty($guide_custom_url) && (!empty($guide_custom_url))) {
							$social_icons .= '<li><a href="' . $guide_custom_url . '" target="_blank"><span class="icon-link">
							</span></a></li>';
						} else if ((get_the_content($post_id) != "") && (!empty($guide_custom_url))) {
							$social_icons .= '<li><a href="' . get_permalink() . '" >
							<span class="icon-link"> </span></a></li>';
						}

						$html_content .= '<div class="col-sm-6 ' . $entrada_column_class . ' img-article">
										<div class="holder">';

						$feat_image_url = wp_get_attachment_url(get_post_thumbnail_id($post_id));
						$image = matthewruddy_image_resize($feat_image_url, 370, 450, true, false);

						$html_content .= '<div class="img-wrap">';

						if (array_key_exists('url', $image) && $image['url'] != '') {
							$html_content .= '<img src="' . $image['url'] . '" alt="' . get_the_title($post_id) . '">';
						}

						if (!empty($social_icons)) {
							$html_content .= '<ul class="social-networks">' . $social_icons . '</ul>';
						}


						$html_content .= '</div>';



						$html_content .= '<div class="caption">
													<h3 class="small-space">' . get_the_title($post_id) . '</h3>
													<span class="designation">' . strtoupper(get_post_meta($post_id, 'guide_designation', true)) . '</span></div>';

						$html_content .= '</div>
									</div>';
					endwhile;
					wp_reset_query();
					$html_content .= '</div>';
					$html_content .= '</div>';
				}
		}
	}
	return $html_content;
}

/*  Entrada VC Search Block
---------------------------------------------------------- */
add_shortcode('entrada_search_block', 'entrada_vc_search_block');
function entrada_vc_search_block($atts, $content = null)
{
	global $wpdb;
	extract(shortcode_atts(array(
		'search_block_title' => '',
		'search_block_desc' => '',
		'search_field_col' => 3,
		'search_block_button_text' => ''
	), $atts));

	$html_content = '';
	$holder = '';
	$search_block_desc = "{$search_block_desc}";
	$search_field_col = "{$search_field_col}";
	$search_block_button_text = "{$search_block_button_text}";

	//  echo 'Test: '.$search_block_desc;
	$search_fields = explode(",", $search_block_desc);
	$theme = wp_get_theme();
	if ('entrada' == strtolower($theme->name) || 'entrada' == strtolower($theme->parent_theme)) {
		if ($search_fields) {

			// Month-Year Date select box
			$date = date('Y-m-d');
			$entrada_start_date_month_year_arr = array();
			$entrada_end_date_month_year_arr = array();
			for ($i = 0; $i < 12; $i++) {

				$entrada_current_month = date('n', strtotime($date));
				$start_day = ($i == ($entrada_current_month - 1) ? date('d', strtotime($date)) : 01);

				$entrada_month_year_date = date('d-m-Y', strtotime('+' . $i . ' month', strtotime($date)));
				/* Lastday of Month */
				$Year =  date('Y', strtotime($entrada_month_year_date));
				$Month = date('n', strtotime($entrada_month_year_date));
				$aMonth         = mktime(0, 0, 0, $Month, 1, $Year);
				$NumOfDay       = 0 + date("t", $aMonth);
				$LastDayOfMonth = mktime(0, 0, 0, $Month, $NumOfDay, $Year);

				$start_date_val = $start_day . '-' . date('m-Y', strtotime($entrada_month_year_date));
				$end_date_val = date('t-m-Y', strtotime($entrada_month_year_date));

				$y = date('Y', strtotime($entrada_month_year_date));
				$index = date('n', strtotime($entrada_month_year_date));

				$entrada_start_date_month_year_arr[$start_date_val] = entrada_vc_month_name($index, $y);
				$entrada_end_date_month_year_arr[$end_date_val] = entrada_vc_month_name($index, $y);
			}

			foreach ($search_fields as $field) {
				$field_elements = explode("::", $field);
				$default_select_label = '';
				if (isset($field_elements[2])) {
					$default_select_label = $field_elements[2];
				}
				switch ($field_elements[1]) {

					case 'destination':
						$desti = array();

						if (empty($default_select_label)) {
							$default_select_label = __('All Destinations', 'entrada');
						}

						$diestinations = get_terms('destination', array('hide_empty' => 0, 'orderby' => 'name', 'order' => 'asc'));
						if ($diestinations) {
							foreach ($diestinations as $dest) {
								if ($dest->parent != 0) {
									$term = get_term_by('id', $dest->parent, 'destination');
									$desti[$dest->parent][] = '<option value="' . $dest->slug . '">' . $term->name . ' - ' . $dest->name . '</option>';
								}
							}
						}
						ksort($desti);
						//return print_r($desti);

						$holder .= '<div class="holder">
										<label for="destination">' . $field_elements[0] . '</label>
										<div class="select-holder">
											<select class="trip trip-banner" id="destination" name="destination">';
						$holder .= '<option value="">' . $default_select_label . '</option>';

						if ($desti) {
							foreach ($desti as $data) {
								foreach ($data as $d) {
									$holder .= $d;
								}
							}
						}

						$holder .= '</select>
										</div>
									</div>';

						break;

					case 'destination_level_1':

						$desti = array();

						if (empty($default_select_label)) {
							$default_select_label = __('All Destinations', 'entrada');
						}

						$diestinations = get_terms('destination', array('hide_empty' => 0, 'orderby' => 'name', 'order' => 'asc'));
						if ($diestinations) {
							foreach ($diestinations as $dest) {

								$term = get_term_by('id', $dest->parent, 'destination');
								$desti[$dest->parent][] = '<option value="' . $dest->slug . '">' . $dest->name . '</option>';
							}
						}
						ksort($desti);
						//return print_r($desti);

						$holder .= '<div class="holder">
										<label for="destination">' . $field_elements[0] . '</label>
										<div class="select-holder">
											<select class="trip trip-banner" id="destination" name="destination">';
						$holder .= '<option value="">' . $default_select_label . '</option>';

						if ($desti) {
							foreach ($desti as $data) {
								foreach ($data as $d) {
									$holder .= $d;
								}
							}
						}

						$holder .= '</select>
										</div>
									</div>';

						break;

					case 'start_month_year_selectbox':

						if (empty($default_select_label)) {
							$default_select_label = __('Any Date', 'entrada');
						}

						$holder .= '<div class="holder">
									<label for="destination">' . $field_elements[0] . '</label>
									<div class="select-holder">
										<select class="trip trip-banner" id="start_date_month_year" name="start_date">';
						$holder .= '<option value="">' . $default_select_label . '</option>';

						if ($entrada_start_date_month_year_arr) {
							foreach ($entrada_start_date_month_year_arr as $key => $value) {
								$holder .= '<option value="' . $key . '">' . $value . '</option>';
							}
						}

						$holder .= '</select>
										</div>
									</div>';

						break;

					case 'end_month_year_selectbox':

						if (empty($default_select_label)) {
							$default_select_label = __('Any Date', 'entrada');
						}

						$holder .= '<div class="holder">
									<label for="destination">' . $field_elements[0] . '</label>
									<div class="select-holder">
										<select class="trip trip-banner" id="end_date_month_year" name="end_date">';
						$holder .= '<option value="">' . $default_select_label . '</option>';

						if ($entrada_end_date_month_year_arr) {
							foreach ($entrada_end_date_month_year_arr as $key => $value) {
								$holder .= '<option value="' . $key . '">' . $value . '</option>';
							}
						}

						$holder .= '</select>
										</div>
									</div>';

						break;

					case 'start_date':
						$holder .= '<div class="holder">
										<label>' . $field_elements[0] . '</label>
										<div class="select-holder">
											<div id="datepicker5" class="input-group date picker-solid-bg" data-date-format="yyyy-mm-dd">
												<input class="form-control" type="text" name="start_date" />
												<span class="input-group-addon"><i class="icon-arrow-down"></i></span>
											</div>
										</div>
									</div>';
						break;

					case 'end_date':
						$holder .= '<div class="holder">
										<label>' . $field_elements[0] . '</label>
										<div class="select-holder">
											<div id="datepicker6" class="input-group date picker-solid-bg" data-date-format="yyyy-mm-dd">
												<input class="form-control" type="text" name="end_date" />
												<span class="input-group-addon"><i class="icon-arrow-down"></i></span>
											</div>
										</div>
									</div>';
						break;

					case 'price_range':

						if (empty($default_select_label)) {
							$default_select_label = __('All Range', 'entrada');
						}

						$holder .= '<div class="holder">
								<label for="destination">' . $field_elements[0] . '</label>
								<div class="select-holder">
									<select class="trip trip-banner" id="price_range" name="price_range">';

						$holder .= '<option value="">' . $default_select_label . '</option>';
						$holder .= entrada_product_price_range(false);
						$holder .= '</select>
										</div>
									</div>';

						break;

					default:

						if (empty($default_select_label)) {
							$default_select_label = __('All Activities', 'entrada');
						}
						$holder .= '<div class="holder">
									<label for="destination">' . $field_elements[0] . '</label>
									<div class="select-holder">
										<select class="trip trip-banner" id="adventure" name="product_cat">';

						$holder .= '<option value="">' . $default_select_label . '</option>';
						$featured_cat_ids = entrada_product_featured_categories('prod_iconbar_cat_val');
						$prod_cat_args = array(
							'type'         => 'product',
							'taxonomy'     => 'product_cat',
							'hide_empty'   => 0,
							'include'      => $featured_cat_ids
						);

						$activities = get_categories($prod_cat_args);
						if ($activities) {
							foreach ($activities as $activity) {
								$holder .= '<option value="' . $activity->slug . '">' . $activity->name . '</option>';
							}
						}

						$holder .= '</select>
										</div>
									</div>';
				}
			}
			$search_block_button_text = !empty($search_block_button_text) ? $search_block_button_text : 'GO WILD';
			$holder .= '<div class="holder"><input class="btn btn-trip" type="submit" value="' . $search_block_button_text . '"></div>';

			$html_content .= '<div class="banner-text">
						<div class="center-text">
							<form class="trip-form banner-trip-form" method="get" action = "' . home_url('/find/tours/') . '">
								<fieldset>' . $holder;
			$html_content .= '</fieldset>
							</form>
						</div>
					</div>';

			if (!empty($search_field_col)) {
				$width = (int) (100 / $search_field_col);
				global $post;
				if (isset($post->ID) && $post->ID != '') {
					update_post_meta($post->ID, 'entrada_search_col', $width);
				}
			}
		}
	}
	return $html_content;
}

/*  Entrada VC Category Gallery Shortcode
---------------------------------------------------------- */
add_shortcode('categoriesgallery', 'entrada_vc_custom_category_gallery');
function entrada_vc_custom_category_gallery($atts, $content = null)
{
	global $wpdb;
	extract(shortcode_atts(array(
		'entrada_catgallery_title' => 'Entrada product category title',
		'showhide_empty' => 0,
		'catgal_record_data' => 9,
		'iconbar_nav_link' => 'default'
	), $atts));

	$html_content = '';
	$showhide_empty = "{$showhide_empty}";
	$catgal_record_data = "{$catgal_record_data}";
	$iconbar_nav_link = "{$iconbar_nav_link}";

	$theme = wp_get_theme();
	if ('entrada' == strtolower($theme->name) || 'entrada' == strtolower($theme->parent_theme)) {
		$featured_cat_ids = entrada_product_featured_categories('prod_featured_home_val');

		$prod_cat_args = array(
			'hide_empty'   => $showhide_empty
		);


		$categories = get_terms('product_cat', $prod_cat_args);
		$categories_arr = array();
		// print_r($categories);
		if ($categories) {
			$sort_order = 10000;

			foreach ($categories as $category) {
				$sort_id = get_term_meta($category->term_id, 'order', true);
				if (!empty($sort_id)) {
					$categories_arr[$sort_id] = $category;
				} else {
					$categories_arr[$sort_order] = $category;
				}
				$sort_order++;
			}
		}
		ksort($categories_arr);
		//print_r($categories_arr);
		if ($categories_arr) {

			$counter = 1;
			$html_content .= '<div class="adventure-holder gallery-home-holder img-block ">';
			$html_content .= '<ul class="gallery-list gallery-with-icon">';

			foreach ($categories_arr as $category) {

				if (in_array($category->term_id, $featured_cat_ids) && $counter <= $catgal_record_data) {
					$counter++;
					$thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
					$category_url = entrada_product_cat_url($category->term_id, $iconbar_nav_link);
					$html_content .= '<li><a href="' . $category_url . '" class="thumbnail">';
					if ($thumbnail_id != '') {

						$url = wp_get_attachment_url($thumbnail_id);
						$image = matthewruddy_image_resize($url, 170, 165, true, false);

						if (array_key_exists('url', $image) && $image['url'] != '') {
							$html_content .= '<img src="' . $image['url'] . '"  alt="image description">';
						}
					}

					$t_id = $category->term_id;
					$term_meta = get_option("taxonomy_$t_id");
					$prod_icomoon_cat_val =  $term_meta['prod_icomoon_cat_val'];
					if (!empty($prod_icomoon_cat_val)) {
						$html_content .=  '<span class="hover ' . $prod_icomoon_cat_val . '"></span>';
					}
					$html_content .= '<span class="info">' . $category->name . '</span></a></li>';
				}
			}

			$html_content .= '</ul>';
			$html_content .= '</div>';
		}
	}

	return $html_content;
}

/*  Entrada VC Iconbar Navigation shortcode
---------------------------------------------------------- */
add_shortcode('entrada_iconbarnav', 'entrada_vc_custom_iconbarnav');
function entrada_vc_custom_iconbarnav($atts, $content = null)
{
	global $wpdb;
	extract(shortcode_atts(array(
		'iconbar_nav_title' => '',
		'iconbar_nav_showhide_empty' => 0,
		'iconbar_nav_count' => 8,
		'iconbar_nav_link' => 'default'
	), $atts));

	$html_content = '';
	$iconbar_nav_showhide_empty = "{$iconbar_nav_showhide_empty}";
	$iconbar_nav_count = "{$iconbar_nav_count}";
	$iconbar_nav_link = "{$iconbar_nav_link}";

	$theme = wp_get_theme();
	if ('entrada' == strtolower($theme->name) || 'entrada' == strtolower($theme->parent_theme)) {
		$featured_cat_ids = entrada_product_featured_categories('prod_iconbar_cat_val');

		$prod_cat_args = array(
			'hide_empty'   => $iconbar_nav_showhide_empty
		);

		$categories = get_terms('product_cat', $prod_cat_args);

		$categories_arr = array();

		if ($categories) {
			$sort_order = 10000;

			foreach ($categories as $category) {
				$sort_id = get_term_meta($category->term_id, 'order', true);
				if (!empty($sort_id)) {
					$categories_arr[$sort_id] = $category;
				} else {
					$categories_arr[$sort_order] = $category;
				}
				$sort_order++;
			}
		}
		ksort($categories_arr);


		if ($categories_arr) {
			$html_content .= '<div class="feature-block">
						<div class="holder"><ul>';
			$counter = 1;
			foreach ($categories_arr as $category) {
				$cat_id = $category->term_id;
				$term_meta = get_option("taxonomy_$cat_id");

				if (in_array($category->term_id, $featured_cat_ids) && $counter <= $iconbar_nav_count) {
					$counter++;
					$category_url = entrada_product_cat_url($category->term_id, $iconbar_nav_link);
					$html_content .= '<li>
								<a href="' . $category_url . '">
									<span class="ico">
										<span class="' . $term_meta['prod_icomoon_cat_val'] . '"></span>
									</span>
									<span class="info">' . $category->name . '</span>
								</a>
							</li>';
				}
			}

			$html_content .= '</ul>';
			$html_content .= '</div>
								</div>';
		}
	}
	return $html_content;
}

/*  Entrada VC Page content Shortcode
---------------------------------------------------------- */
add_shortcode('content_column', 'entrada_vc_content_column');
function entrada_vc_content_column($atts, $content = null)
{
	global $wpdb;

	extract(shortcode_atts(array(
		'content_column_title' => '',
		'content_column_desc' => '',
		'content_column_btn_title' => '',
		'block_for' => 'home',
		'content_column_btn_link' => ''
	), $atts));

	$html_content = '';

	$content_column_title = "{$content_column_title}";
	$content_column_desc = "{$content_column_desc}";
	$content_column_btn_title = "{$content_column_btn_title}";
	$block_for = "{$block_for}";
	$content_column_btn_link = "{$content_column_btn_link}";

	switch ($block_for) {
		case "about-top":

			$html_content .= '<div class="description-text">';
			if (!empty($content_column_title)) {
				$html_content .= '<h3>' . $content_column_title . '</h3>';
			}

			if (!empty($content_column_desc)) {
				$html_content .= '<p>' . $content_column_desc . '</p>';
			}

			$html_content .= '</div>';

			break;

		case "bottom-top":

			$html_content .= '<div class="description common-top-space">';
			if (!empty($content_column_title)) {
				$html_content .= '<h3>' . $content_column_title . '</h3>';
			}

			if (!empty($content_column_desc)) {
				$html_content .= '<p>' . $content_column_desc . '</p>';
			}

			$html_content .= '</div>';

			break;

		default:

			$html_content .= '<div class="adventure-holder gallery-home-holder text-block"><div class="centered">';

			if (!empty($content_column_title)) {
				$html_content .= '<h2 class="intro-heading">' . $content_column_title . '</h2>';
			}

			if (!empty($content_column_desc)) {
				$html_content .= '<p class="intro">' . $content_column_desc . '</p>';
			}

			if (!empty($content_column_btn_title) && !empty($content_column_btn_link)) {
				$html_content .= '<a href="' . $content_column_btn_link . '" class="btn btn-info-sub btn-md btn-shadow radius">' . $content_column_btn_title . '</a>';
			}

			$html_content .= '</div></div>';
	}



	return $html_content;
}

/*  Entrada VC Page content Shortcode
---------------------------------------------------------- */

add_shortcode('browse_link_block', 'entrada_vc_browseblock');
function entrada_vc_browseblock($atts)
{
	global $wpdb;

	extract(shortcode_atts(array(
		'browse_block_title' => 'BROWSE BY DESTINATION',
		'browse_block_display_style' => 'destinations',
		'browse_block_url' => '#'
	), $atts));


	$html_content = '';
	$browse_block_title = "{$browse_block_title}";
	$browse_block_display_style = "{$browse_block_display_style}";
	$browse_block_url = "{$browse_block_url}";

	switch ($browse_block_display_style) {
		case "adventures":
			$html_content .= '<div class="browse-adventures column">
					<a href="' . $browse_block_url . '" class="link">
						<span>' . $browse_block_title . '</span>
					</a>
				</div>';
			break;
		default:
			$html_content .= '<div class="browse-destination column">
					<a href="' . $browse_block_url . '" class="link">
						<span>' . $browse_block_title . '</span>
					</a>
				</div>';
	}

	return $html_content;
}

/*  Entrada VC Call To Action
---------------------------------------------------------- */

add_shortcode('call_to_action', 'entrada_vc_call_to_action');
function entrada_vc_call_to_action($atts, $content = null)
{
	global $wpdb;

	extract(shortcode_atts(array(
		'callto_action_title' => ''
	), $atts));


	$html_content = '';
	$callto_action_title = "{$callto_action_title}";
	$content = wpb_js_remove_wpautop($content, true);


	$content = str_replace("<p>", "", $content);
	$content = str_replace("</p>", "", $content);

	$html_content .= '<p class="special-text">' . $content . '</p>';

	return $html_content;
}

/*  Entrada VC Counter Block
---------------------------------------------------------- */

add_shortcode('entrada_counter', 'entrada_vc_counter_block');
function entrada_vc_counter_block($atts)
{
	global $wpdb;

	extract(shortcode_atts(array(
		'entrada_counter_title' => 'Altutude',
		'entrada_counter_data' => '0',
		'entrada_counter_block_model' => 'block-1',
		'entrada_counter_icon' => 'mountain'
	), $atts));


	$html_content = '';
	$icon = '';
	$entrada_counter_title = "{$entrada_counter_title}";
	$entrada_counter_data = "{$entrada_counter_data}";
	$entrada_counter_block_model = "{$entrada_counter_block_model}";
	$entrada_counter_icon = "{$entrada_counter_icon}";

	$html_content .= '<div class="holder ' . $entrada_counter_block_model . '">
							<span class="icon ' . $entrada_counter_icon . '"></span>
							<span class="info"><span class="counter">' . $entrada_counter_data . '</span></span>
							<span class="txt">' . $entrada_counter_title . '</span>
						</div>';


	return $html_content;
}

/*  Entrada VC Telephone/ Fax Block Shortcode
---------------------------------------------------------- */
add_shortcode('entrada_telfax', 'entrada_vc_custom_telfax_block');
function entrada_vc_custom_telfax_block($atts, $content = null)
{
	global $wpdb;
	extract(shortcode_atts(array(
		'entrada_telfax_title' => 'Booking Enquiries',
		'entrada_telfax_no' => '',
		'entrada_telfax_icon' => 'icon-tel',
		'entrada_telfax_block_class' => ''
	), $atts));

	$content = wpb_js_remove_wpautop($content, true);

	$html_content = '';
	$entrada_telfax_title = "{$entrada_telfax_title}";
	$entrada_telfax_no = "{$entrada_telfax_no}";
	$entrada_telfax_icon = "{$entrada_telfax_icon}";
	$content = "{$content}";
	$entrada_telfax_block_class = "{$entrada_telfax_block_class}";

	$html_content .= '<span class="tel has-border ' . $entrada_telfax_block_class . '">
									<span class="' . $entrada_telfax_icon . '"></span>
									<a href="tel:' . str_replace(' ', '', $entrada_telfax_no) . '">' . $entrada_telfax_no . '</a>
								</span>
								<h3>' . $entrada_telfax_title . '</h3>' . $content;
	return $html_content;
}

/*  Entrada VC Google Map iFrame
---------------------------------------------------------- */
add_shortcode('entrada_googlemap', 'entrada_vc_custom_googlemap_iframe');
function entrada_vc_custom_googlemap_iframe($atts, $content = null)
{
	global $wpdb;
	extract(shortcode_atts(array(
		'entrada_gmap_address' => 'Pariser Platz, 10117 Berlin',
		'entrada_gmap_type' => '',
		'entrada_gmap_zoom' => '7',
		'entrada_gmap_width' => '100%',
		'entrada_gmap_height' => '100%'
	), $atts));

	$html_content = '<div class="map-col-main map-holder height">';
	$entrada_gmap_address = "{$entrada_gmap_address}";
	$entrada_gmap_type = "{$entrada_gmap_type}";
	$entrada_gmap_zoom = "{$entrada_gmap_zoom}";
	$entrada_gmap_width = "{$entrada_gmap_width}";
	$entrada_gmap_height = "{$entrada_gmap_height}";

	$html_content .= '<iframe width="' . $entrada_gmap_width . '" height="' . $entrada_gmap_height . '" src="https://maps.google.com/maps?hl=en&q=' . $entrada_gmap_address . '&ie=UTF8&t=' . $entrada_gmap_type . '&z=' . $entrada_gmap_zoom . '&iwloc=B&output=embed&center=true"></iframe>';

	$html_content .= '</div>';
	return $html_content;
}

/*  Entrada VC About Services Block
---------------------------------------------------------- */
add_shortcode('entrada_services_block', 'entrada_vc_custom_services_block');
function entrada_vc_custom_services_block($atts, $content = null)
{
	global $wpdb;
	extract(shortcode_atts(array(
		'entrada_service_block_title' => '',
		'entrada_service_block_icon' => '',
		'entrada_service_block_short_desc' => '',
		'entrada_service_block_image' => ''
	), $atts));

	$html_content = '';

	$entrada_service_block_title = "{$entrada_service_block_title}";
	$entrada_service_block_icon = "{$entrada_service_block_icon}";
	$entrada_service_block_short_desc = "{$entrada_service_block_short_desc}";
	$entrada_service_block_image = "{$entrada_service_block_image}";

	$html_content .= '<article class="article text-center article-top-space">';
	if (!empty($entrada_service_block_image)) {
		$attached_url = '';
		$attached_url =  wp_get_attachment_url($entrada_service_block_image);

		if (!empty($attached_url)) {

			$html_content .= '<div class="img-wrap1">
					<img  src="' . $attached_url . '" alt="image description">
				 </div>';
		}
	}

	$html_content .= 	'<div class="description">
							<h3>' . $entrada_service_block_title . '</h3>
							<p>' . strip_tags($entrada_service_block_short_desc) . '</p>
						</div></article>';

	return $html_content;
}

/*  Entrada VC Product Categories for Services Shortcode
---------------------------------------------------------- */
add_shortcode('cat_service', 'entrada_vc_custom_cat_service');
function entrada_vc_custom_cat_service($atts, $content = null)
{
	global $wpdb;
	extract(shortcode_atts(array(
		'cat_service_title' => '',
		'cat_service_lists' => array(),
		'cat_service_orderby' => 'id',
		'cat_service_order' => 'desc'
	), $atts));

	$html_content = '';

	$cat_service_title = "{$cat_service_title}";
	$cat_service_lists = "{$cat_service_lists}";
	$orderby = "{$cat_service_orderby}";
	$order = "{$cat_service_order}";

	$theme = wp_get_theme();
	if ('entrada' == strtolower($theme->name) || 'entrada' == strtolower($theme->parent_theme)) {
		$prod_cat_args = array(
			'orderby'      => $orderby,
			'order'        => $order,
			'hide_empty'   => 0,
			'include'      => $cat_service_lists
		);

		$product_cats = get_terms('product_cat', $prod_cat_args);
		if ($product_cats) {
			foreach ($product_cats as $product_cat) {
				$term_meta = get_option("taxonomy_" . $product_cat->term_id);
				$html_content .= '<div class="col-sm-4 ico-article wow fadeInUp" data-wow-duration="400ms" data-wow-delay="200ms">
										<div class="ico-holder">
											<span class="' . $term_meta['prod_icomoon_cat_val'] . '"></span>
										</div>
										<div class="description">
											<strong class="content-title"><a href="' . esc_url(get_term_link($product_cat)) . '">' . $product_cat->name . '</a></strong>
											<p>' . entrada_truncate(strip_tags($product_cat->description), 30, 120) . '</p>
										</div>
									</div>';
			}
		}
	}
	return $html_content;
}

/* Entrada VC Progress Bar Shortcode
---------------------------------------------------------- */
add_shortcode('entrada_progress_bar', 'entrada_vc_custom_progress_bar');
function entrada_vc_custom_progress_bar($atts, $content = null)
{
	global $wpdb;
	extract(shortcode_atts(array(
		'progressbar_title' => '',
		'progressbar1_title' => '',
		'progressbar2_title' => '',
		'progressbar3_title' => '',
		'progressbar4_title' => '',
		'progressbar5_title' => ''
	), $atts));

	$html_content = '';

	$progressbar_data = array();

	$progressbar_title = "{$progressbar_title}";
	$progressbar1_title = "{$progressbar1_title}";
	$progressbar2_title = "{$progressbar2_title}";
	$progressbar3_title = "{$progressbar3_title}";
	$progressbar4_title = "{$progressbar4_title}";
	$progressbar5_title = "{$progressbar5_title}";

	if (!empty($progressbar1_title)) {
		$progressbar_data[] = $progressbar1_title;
	}

	if (!empty($progressbar2_title)) {
		$progressbar_data[] = $progressbar2_title;
	}

	if (!empty($progressbar3_title)) {
		$progressbar_data[] = $progressbar3_title;
	}

	if (!empty($progressbar4_title)) {
		$progressbar_data[] = $progressbar4_title;
	}

	if (!empty($progressbar5_title)) {
		$progressbar_data[] = $progressbar5_title;
	}

	if ($progressbar_data) {
		$cnt = 0;
		$html_content .= '<div class="progress-holder common-top-space"><div class="bar-holder">';
		foreach ($progressbar_data as $d) {
			$cnt++;
			$bar_data = explode("{{}}", $d);

			$html_content .= '<strong class="title">' . $bar_data[0] . '</strong>
								<div class="progress">
									<div class="progress-bar" role="progressbar" aria-valuenow="' . $bar_data[1] . '" aria-valuemin="0" aria-valuemax="100" id="progress' . $cnt . '">
									<span class="value">' . $bar_data[1] . '%</span>
									</div>
								</div>';
		}
		$html_content .= '</div></div>';
	}

	return $html_content;
}


/* Entrada VC Progress Bar Shortcode
---------------------------------------------------------- */
add_shortcode('entrada_blockquote', 'entrada_vc_custom_blockquote');
function entrada_vc_custom_blockquote($atts, $content = null)
{
	global $wpdb;
	extract(shortcode_atts(array(
		'blockquote_title' => '',
		'blockquote_short_desc' => ''
	), $atts));

	$html_content = '';

	$blockquote_title = "{$blockquote_title}";
	$blockquote_short_desc = "{$blockquote_short_desc}";

	if (!empty($blockquote_short_desc)) {

		$html_content .= '<blockquote class="normal">
						<q>' . $blockquote_short_desc . '</q>
						</blockquote>';
	}


	return $html_content;
}

/* Entrada VC Service Section Shortcode
---------------------------------------------------------- */
add_shortcode('entrada_service_section', 'entrada_vc_custom_service_section');
function entrada_vc_custom_service_section($atts, $content = null)
{
	global $wpdb;
	extract(shortcode_atts(array(
		'service_section_title' => '',
		'service_section_count' => -1,
		'orderby' => 'desc',
		'order' => 'date'
	), $atts));

	$html_content = '';

	$service_section_title = "{$service_section_title}";
	$service_section_count = "{$service_section_count}";
	$orderby = "{$orderby}";
	$order = "{$order}";

	$theme = wp_get_theme();
	if ('entrada' == strtolower($theme->name) || 'entrada' == strtolower($theme->parent_theme)) {
		$args = array(
			'post_type'		 =>  'service',
			'showposts'  	 =>  $service_section_count,
			'orderby'        => $orderby,
			'order'          => $order
		);

		$service = new WP_Query($args);
		if ($service->have_posts()) {
			$html_content .= '<div class="row db-3-col">';
			while ($service->have_posts()) : $service->the_post();

				$service_icon = get_post_meta(get_the_ID(), 'service_icon', true);

				$html_content .= '<div class="col-sm-4 col-md-3 ico-article">
									<div class="ico-holder">
										<span class="' . $service_icon . '"></span>
									</div>
									<div class="description">
										<strong class="content-title">' . get_the_title(get_the_ID()) . '</strong>
										<p>' . entrada_truncate(strip_tags(get_the_content()), 50, 300) . '</p>
									</div>
								</div>';

			endwhile;
			wp_reset_query();
			$html_content .= '</div>';
		}
	}

	return $html_content;
}

/* Entrada VC Service Section Shortcode
---------------------------------------------------------- */
add_shortcode('entrada_product_carousel', 'entrada_vc_product_carousel_shortcode');
function entrada_vc_product_carousel_shortcode($atts, $content = null)
{
	global $wpdb;
	extract(shortcode_atts(array(
		'product_carousel_title' => '',
		'product_ids' => '',
		'product_carousel_count' => 9,
		'auto_play' => 'false',
		'carousel_display_opt' => 'default_display',
		'slide_speed' => '300',
		'orderby' => 'desc',
		'order' => 'date',
		'stopOnHover' => 'true'
	), $atts));

	$html_content = '';

	$product_carousel_title = "{$product_carousel_title}";
	$product_ids = "{$product_ids}";
	$product_carousel_count = "{$product_carousel_count}";
	$auto_play = "{$auto_play}";
	$carousel_display_opt = "{$carousel_display_opt}";
	$slide_speed = "{$slide_speed}";
	$orderby = "{$orderby}";
	$order = "{$order}";
	$stopOnHover = "{$stopOnHover}";

	$carousel_rand_id = 'entrada_' . wp_rand();


	$theme = wp_get_theme();
	if ('entrada' == strtolower($theme->name) || 'entrada' == strtolower($theme->parent_theme)) {
		$global_vars = array();
		$global_data = '';
		$global_vars['auto_play'] = $auto_play;
		$global_vars['slide_speed'] = $slide_speed;
		$global_vars['$stopOnHover'] = $stopOnHover;

		$global_data  = '<script type="text/javascript">';
		$global_data .= "(function($) {
    						'use strict';";
		$global_data .= "$( document ).ready(function() {";
		$global_data .= "$('#" . $carousel_rand_id . "')
					        .owlCarousel({
					            items: 3,
					            navigation : true,
					            slideSpeed: parseInt(" . $slide_speed . "),
					            itemsDesktop : [1199, 3],
					            itemsDesktopSmall : [979, 2],
					            itemsTablet : [768, 1],
					            itemsMobile: [480, 1],
					            autoPlay: " .  $auto_play . ",
					            touchDrag: false,
					            pagination: false,
								mouseDrag: false,
								stopOnHover: true
						});";
		$global_data .= "});";

		$global_data .= "}(jQuery));  ";
		$global_data .= '</script>';

		$args = array(
			'post_type'		 => 'product',
			'showposts'  	 => $product_carousel_count,
			'orderby'        => $orderby,
			'order'          => $order
		);

		if (!empty($orderby) && $orderby == 'popular_tour') {
			$args['orderby'] = 'meta_value';
			$args['meta_key'] = 'total_sales';
		} else if (!empty($orderby) && $orderby == 'featured_tour') {
			$args['meta_key'] = '_featured';
			$args['meta_value'] = 'yes';
		}

		if (isset($product_ids) && !empty($product_ids)) {
			$args['post_type'] = 'product';
			$args['post__in'] = explode(',', $product_ids);
		}

		$args = entrada_vc_product_type_meta_query($args, 'tour');
		$featured_query = new WP_Query($args);

		if ($featured_query->have_posts()) :

			// if (isset($global_data) && !empty($global_data)) {
			// 	echo $global_data;
			// }
			$html_content .= $global_data;
			$html_content .= '<div class="content-holder content-boxed content-spacing">';
			$html_content .= '<div class="row db-3-col product_carousel_block" id="' . $carousel_rand_id . '">';

			while ($featured_query->have_posts()) :
				$featured_query->the_post();

				$trip_sub_heading = get_post_meta($featured_query->post->ID, "trip_sub_heading", true);
				$average_rating = '';
				$average_rating =  entrada_post_average_rating($featured_query->post->ID);

				$share_txt  = entrada_truncate(strip_tags(get_the_content($featured_query->post->ID)), 30, 110);
				$entrada_social_media_share_img = '';

				switch ($carousel_display_opt) {

					case 'featured_display':

						$html_content .= '<article class="item article has-hover-s3" itemscope itemtype="http://schema.org/Product"><div class="img-wrap">';

						$entrada_social_media_share_img =  entrada_social_media_share_img($featured_query->post->ID);

						if (has_post_thumbnail($featured_query->post->ID)) :

							$html_content .= '<a href="' . get_permalink($featured_query->post->ID) . '">' . get_the_post_thumbnail($featured_query->post->ID, array(550, 358)) . '</a>';

						endif;


						$trip_duration = get_post_meta($featured_query->post->ID, "trip_duration", true);

						if ($trip_sub_heading != '') {
							$html_content .= '<div class="img-caption">' . $trip_duration . '</div>';
						}

						$html_content .=	'<div class="hover-article">
												<div class="star-rating">
													<input class="front_rating" type="hidden" value="' . $average_rating . '">
													<div class="front_rateYo"></div>
												</div>
												<div class="icons">
													' . entrada_wishlist_html(get_the_ID()) . '
													<a href="' . get_permalink($featured_query->post->ID) . '" itemprop="url"><span class="icon-reply"></span></a>
												</div>
												<div class="info-footer">';

						$product_price = entrada_product_price($featured_query->post->ID);

						if (isset($product_price) && !empty($product_price)) {
							$html_content .= '<span class="price">' . entrada_price_from_txt($product_price) . '<span ' . entrada_price_schema_micro_data_link(get_the_ID()) . '>' . $product_price . '</span></span>';
						}

						$html_content .=	'<a href="' . get_permalink($featured_query->post->ID) . '" class="link-more" itemprop="url">' . get_theme_mod('square_button_text', 'explore') . '</a>
												</div>
											</div>
										</div>
										<h3><a href="' . get_permalink($featured_query->post->ID) . '" itemprop="name">' . get_the_title($featured_query->post->ID) . '</a></h3>
										<p itemprop="description">' . entrada_truncate(strip_tags(get_the_content()), 30, 140) . '</p>
									</article>';


						break;

					default:
						$html_content .= '<article class="item article has-hover-s1">
					<div class="thumbnail" itemscope itemtype="http://schema.org/Product">';
						$entrada_social_media_share_img =  entrada_social_media_share_img(get_the_ID());
						// $html_content .= entrada_product_resized_img(get_the_ID(), $resize = array(550, 358));
						$html_content .= '<a href="' . get_permalink($featured_query->post->ID) . '" itemprop="name">' . entrada_product_resized_img(get_the_ID(), $resize = array(550, 358));

						$html_content .= '<h3 class="small-space"><a href="' . get_permalink($featured_query->post->ID) . '" itemprop="name">' . get_the_title($featured_query->post->ID) . '</a></h3>
			<span class="info">';

						$term_list = wp_get_post_terms($featured_query->post->ID, 'product_cat', array('fields' => 'ids'));
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
			<aside class="meta">' . entrada_destinations_activities_count($featured_query->post->ID, false) . '
			</aside>
			<p itemprop="description">' . entrada_truncate(strip_tags(get_the_content()), 40, 180) . '</p>
			<a href="' . get_permalink($featured_query->post->ID) . '" class="btn btn-default" itemprop="url">' . get_theme_mod('square_button_text', 'explore') . '</a>
			<footer>
				<ul class="social-networks">
					' . entrada_social_media_share_btn(get_the_title($featured_query->post->ID), get_permalink($featured_query->post->ID), $share_txt, $entrada_social_media_share_img) . '
				</ul>
				<span class="price">';

						$product_price = entrada_product_price($featured_query->post->ID);

						if ($product_price != '') {
							$html_content .= entrada_price_from_txt($product_price);
							$html_content .= ' <span ' . entrada_price_schema_micro_data_link(get_the_ID()) . '>' . $product_price . '</span>';
						}
						$html_content .= '</span>
						</footer>
						</div>
						</article>';


						break;
				}

			endwhile;

			$html_content .= '</div>';
			$html_content .= '</div>';
		endif;
		wp_reset_query();
	}

	return $html_content;
}
