<?php
if (!function_exists('entrada_search_form')) {
	function entrada_search_form($form)
	{
		$form = '<form role="search" method="get" id="searchform" class="inner-search" action="' . home_url('/') . '" >';
		$form .= '<div class="input-wrap"><input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . __('Search', 'entrada') . '"><button type="submit"><span class="icon-search"></span></button></div>';
		if (is_404()) {
			$form .= __('<p>Sorry but the page you are looking for has been removed or had its name changed. Please use the links below to navigate your way out of here. Thank you!</p>',  'entrada');
		}
		$form .= '</form>';
		return $form;
	}
}
add_filter('get_search_form', 'entrada_search_form');

/* Blog Image/Gallery Images Holder */
if (!function_exists('entrada_image_holder')) {
	function entrada_image_holder($post_id, $holder_size = array(870, 480))
	{
		global $wpdb;
		$images_urls 	= array();
		$image_alt 		= array();

		/* Check if video is used as featured*/
		$featured_video_url = get_post_meta($post_id, 'featured_video_url', true);
		if (!empty($featured_video_url)) {
			return entrada_embed_video_code($post_id, $holder_size);
		}
		$image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'single-post-thumbnail');
		if (isset($image_url) && !empty($image_url[0])) {
			$images_urls[] 	= entrada_get_resized_image_url($image_url[0], $holder_size);
			$caption = entrada_image_attributes_from_src($image_url[0], 'title', false);
			if (empty($caption)) {
				$image_alt[] = 'Image Alt';
			} else {
				$image_alt[] = $caption;
			}
		}

		/* Post Gallery Images */
		$entrada_img_gal = get_post_meta($post_id, 'entrada_img_gal', true);

		if (isset($entrada_img_gal) && !empty($entrada_img_gal)) {
			$entrada_img_gal_arr = $entrada_img_gal;

			if (count($entrada_img_gal_arr) > 0) {
				foreach ($entrada_img_gal_arr as $attach_id) {
					$gal_img_url = wp_get_attachment_url($attach_id);
					$attach_metadata = entrada_image_attributes($attach_id);
					$images_urls[] 	= entrada_get_resized_image_url($gal_img_url, $holder_size);
					if (array_key_exists('title', $attach_metadata) && $attach_metadata['title'] != '') {
						$caption = $attach_metadata['title'];
					} else {
						$caption = '';
					}

					if (empty($caption)) {
						$image_alt[] = 'Image Alt';
					} else {
						$image_alt[] = $caption;
					}
				}
			}
		}

		/* Generate Feature Image and Carousel Slide */
		$total_image_records = count($images_urls);
		$html = '';
		if ($total_image_records > 0) {
			if ($total_image_records == 1) {
				$html .= '<div class="img-wrap">';
				$html .= '<img src="' . $images_urls[0] . '" width="' . $holder_size[0] . '" height="' . $holder_size[1] . '" class="img-responsive" alt="' . $caption . '">';
				$html .= '</div>';
			} else {
				$html .= '<div class="img-wrap">';
				$html .= '<div id="entrada-carousel-slide-' . $post_id . '" class="carousel slide" data-ride="carousel">';
				$html .= '<div class="carousel-inner" role="listbox">';
				$counter = 0;
				foreach ($images_urls as $url) {
					$html .= ($counter == 0 ? '<div class="item active">' : '<div class="item">');
					$html .= '<img src="' . $url . '" width="' . $holder_size[0] . '" height="' . $holder_size[1] . '" class="img-responsive" alt="' . $caption[$counter] . '">';
					$html .= '</div>';
					$counter++;
				}
				$html .= '</div>';
				$html .= '<a class="left carousel-control" href="#entrada-carousel-slide-' . $post_id . '" role="button" data-slide="prev">';
				$html .= '<span class="icon-angle-down" aria-hidden="true"></span><span class="sr-only">' . __('Previous', 'entrada') . '</span>';
				$html .= '</a>';
				$html .= '<a class="right carousel-control" href="#entrada-carousel-slide-' . $post_id . '" role="button" data-slide="next">';
				$html .= '<span class="icon-angle-down" aria-hidden="true"></span>';
				$html .= '<span class="sr-only">' . __('Next', 'entrada') . '</span>';
				$html .= '</a>';
				$html .= '</div>';
				$html .= '</div>';
			}
		}
		return $html;
	}
}

if (!function_exists('entrada_get_resized_image_url')) {
	function entrada_get_resized_image_url($image_url, $resize = array(870, 480))
	{
		$resized_img_url 	= '';
		$image 				= matthewruddy_image_resize($image_url, $resize[0], $resize[1], true, false);
		if (array_key_exists('url', $image) && $image['url'] != '') {
			$resized_img_url = $image['url'];
		}
		return $resized_img_url;
	}
}

if (!function_exists('entrada_embed_video_code')) {
	function entrada_embed_video_code($post_id, $size = array(870, 480))
	{
		$html = '<div class="img-wrap">';
		$featured_video_url = get_post_meta($post_id, 'featured_video_url', true);
		if (!empty($featured_video_url)) {
			$html .= wp_oembed_get($featured_video_url, array('width' => $size[0], 'height' => $size[1]));
		}
		$html .= '</div>';
		return $html;
	}
}

/* Blog Sidebar View */
if (!function_exists('entrada_blog_sidebarview')) {
	function entrada_blog_sidebarview()
	{
		global $wpdb;
		$full_length = get_theme_mod('blog_full_onoff');
		$html = '';
		$category_type = $_POST['category_type'];
		$response_arr = array();
		$args = array(
			'post_type' 	 => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => $_POST['posts_per_page'],
			'paged' 		 => $_POST['paged']
		);
		if (!empty($category_type)) $args['cat'] = $category_type;
		$post = new WP_Query($args);
		if ($post->have_posts()) {
			while ($post->have_posts()) : $post->the_post();
				if (empty($full_length)) {
					$word = (int) get_theme_mod('blog_excerpt_word_length', 25);
					$char = (int) get_theme_mod('blog_excerpt_char_length', 150);
					$content = entrada_truncate($post->ID, $word, $char, 'id');
				} else {
					$content = get_the_content($post->ID);
				}
				$average_rating =  entrada_post_average_rating(get_the_ID());
				$html .= '<article class="article blog-article">';
				$html .= entrada_image_holder(get_the_ID(), array(870, 480));
				$html .= '<div class="description">';
				$html .= '<header class="heading">';
				$html .= '<h3><a href="' . get_permalink($post->ID) . '">' . get_the_title($post->ID) . '</a></h3>';
				$html .= '<time class="info-day" datetime="2011-01-12">' . get_the_time('jS, M') . '</time>';
				$html .= '</header>';
				$html .= '<p>' . $content . '</p>';
				$html .= '<footer class="meta">';
				$html .= '<div class="star-rating"><input class="product_rating" type="hidden" value="' . $average_rating . '"><div class="product_rateYo"></div></div>';
				$html .= '<div class="footer-sub">';
				$html .= '<div class="rate-info">Post by <a href="#">' . get_the_author() . '</a></div>';
				$count = entrada_post_total_reviews(get_the_ID(), true);
				$html .= '<div class="comment">';
				$html .= '<a href="' . get_permalink($post->ID) . '">' . sprintf(esc_html(_n('%d Comment', '%d Comments', $count, 'entrada')), $count) . '</a>';
				$html .= '</div>';
				$html .= '</div>';
				$html .= '<ul class="ico-action">';

				if (shortcode_exists('sharethis_nav')) {
					$html .=  do_shortcode('[sharethis_nav post_id="' . get_the_ID() . '"]');
				}
				$html .=  '</ul>';

				$html .= '</footer>';
				$html .= '<div class="link-view"><a href="' . get_permalink($post->ID) . '">' . __('VIEW POST', 'entrada') . '</a></div>';
				$html .= '</div>';
				$html .= '</article>';
			endwhile;
			wp_reset_query();
			$response_arr['html_content'] = $html;
		} else {
			$response_arr['html_content'] = '';
		}
		echo json_encode($response_arr, true);
		exit;
	}
}
add_action('wp_ajax_entrada_blog_sidebarview', 'entrada_blog_sidebarview');
add_action('wp_ajax_nopriv_entrada_blog_sidebarview', 'entrada_blog_sidebarview');

/* Blog Default View */
if (!function_exists('entrada_blog_defaultview')) {
	function entrada_blog_defaultview()
	{
		global $wpdb;
		$full_length = get_theme_mod('blog_full_onoff');
		$html = '';
		$category_type = $_POST['category_type'];
		$response_arr = array();
		$args = array(
			'post_type' 	 => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => $_POST['posts_per_page'],
			'paged' 		 => $_POST['paged']
		);
		if (!empty($category_type)) $args['cat'] = $category_type;
		$show_post = new WP_Query($args);
		if ($show_post->have_posts()) {
			while ($show_post->have_posts()) : $show_post->the_post();
				if (empty($full_length)) {
					$word = (int) get_theme_mod('blog_excerpt_word_length', 25);
					$char = (int) get_theme_mod('blog_excerpt_char_length', 150);
					$content_data = entrada_truncate($post->ID, $word, $char, 'id');
				} else {
					$content_data = get_the_content($post->ID);
				}
				$average_rating =  entrada_post_average_rating(get_the_ID());
				$html .= '<article class="article blog-article">';
				$html .= '<div class="thumbnail">';
				$html .= entrada_image_holder(get_the_ID(), array(350, 228));
				$html .= '<div class="description">';
				$html .= '<header class="heading">';
				$html .= '<h3><a href="' . get_permalink(get_the_ID()) . '">' . get_the_title(get_the_ID()) . '</a></h3>';
				$html .= '<time class="info-day" datetime="2011-01-12">' . get_the_time('jS, M') . '</time>';
				$html .= '</header>';
				$html .= '<p>' . $content_data . '</p>';
				$html .= '<footer class="meta">';
				$html .= '<div class="star-rating"><input class="product_rating" type="hidden" value="' . $average_rating . '"><div class="product_rateYo"></div></div>';
				$html .= '<div class="footer-sub">';
				$html .= '<div class="rate-info">Post by <a href="#">' . get_the_author() . '</a></div>';
				$count = entrada_post_total_reviews(get_the_ID(), true);
				$html .= '<div class="comment"><a href="' . get_permalink(get_the_ID()) . '">' . sprintf(esc_html(_n('%d Comment', '%d Comments', $count, 'entrada')), $count) . '</a></div>';
				$html .= '</div>';
				$html .= '<ul class="ico-action">';

				if (shortcode_exists('sharethis_nav')) {
					$html .=  do_shortcode('[sharethis_nav post_id="' . get_the_ID() . '"]');
				}
				$html .=  '</ul>';
				$html .= '</footer>';
				$html .= '<div class="link-view"><a href="' . get_permalink(get_the_ID()) . '">' . __('VIEW POST', 'entrada') . '</a></div>';
				$html .= '</div>';
				$html .= '</div>';
				$html .= '</article>';
			endwhile;
			wp_reset_query();
			$response_arr['html_content'] = $html;
		} else {
			$response_arr['html_content'] = '';
		}
		echo json_encode($response_arr, true);
		exit;
	}
}
add_action('wp_ajax_entrada_blog_defaultview', 'entrada_blog_defaultview');
add_action('wp_ajax_nopriv_entrada_blog_defaultview', 'entrada_blog_defaultview');

/* Blog Full Width */
if (!function_exists('entrada_blog_fullwidth')) {
	function entrada_blog_fullwidth()
	{
		global $wpdb;
		$full_length = get_theme_mod('blog_full_onoff');
		$html = '';
		$category_type = $_POST['category_type'];
		$response_arr = array();
		$args = array(
			'post_type' 	 => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => $_POST['posts_per_page'],
			'paged' 		 => $_POST['paged']
		);
		if (!empty($category_type)) $args['cat'] = $category_type;
		$post = new WP_Query($args);
		if ($post->have_posts()) {
			while ($post->have_posts()) : $post->the_post();
				if (empty($full_length)) {
					$word = (int) get_theme_mod('blog_excerpt_word_length', 25);
					$char = (int) get_theme_mod('blog_excerpt_char_length', 150);
					$content = entrada_truncate($post->ID, $word, $char, 'id');
				} else {
					$content = get_the_content($post->ID);
				}
				$average_rating =  entrada_post_average_rating(get_the_ID());
				$html .= '<article class="article blog-article">';
				$html .= entrada_image_holder(get_the_ID(), array(1170, 646));
				$html .= '<div class="description">';
				$html .= '<header class="heading">';
				$html .= '<h3><a href="' . get_permalink($post->ID) . '">' . get_the_title($post->ID) . '</a></h3>';
				$html .= '<time class="info-day" datetime="2011-01-12">' . get_the_time('jS, M') . '</time>';
				$html .= '</header>';
				$html .= '<p>' . $content . '</p>';
				$html .= '<footer class="meta">';
				$html .= '<div class="star-rating"><input class="product_rating" type="hidden" value="' . $average_rating . '"><div class="product_rateYo"></div></div>';
				$html .= '<div class="rate-info">Post by <a href="#">' . get_the_author() . '</a></div>';
				$count = entrada_post_total_reviews(get_the_ID(), true);
				$html .= '<div class="comment"><a href="' . get_permalink(get_the_ID()) . '">' . sprintf(esc_html(_n('%d Comment', '%d Comments', $count, 'entrada')), $count) . '</a></div>';
				$html .= '<ul class="ico-action">';

				if (shortcode_exists('sharethis_nav')) {
					$html .=  do_shortcode('[sharethis_nav post_id="' . get_the_ID() . '"]');
				}
				$html .=  '</ul>';
				$html .= '</footer>';
				$html .= '<div class="link-view"><a href="' . get_permalink($post->ID) . '">' . __('VIEW POST', 'entrada') . '</a></div>';
				$html .= '</div>';
				$html .= '</article>';
			endwhile;
			wp_reset_query();
			$response_arr['html_content'] = $html;
		} else {
			$response_arr['html_content'] = '';
		}
		echo json_encode($response_arr, true);
		exit;
	}
}
add_action('wp_ajax_entrada_blog_fullwidth', 'entrada_blog_fullwidth');
add_action('wp_ajax_nopriv_entrada_blog_fullwidth', 'entrada_blog_fullwidth');


if (!function_exists('entrada_save_comment_meta_data')) {
	function entrada_save_comment_meta_data($comment_id)
	{
		if ((isset($_POST['product_rating'])) && ($_POST['product_rating'] != '')) {
			$rating = wp_filter_nohtml_kses($_POST['product_rating']);
			add_comment_meta($comment_id, 'rating', $rating);
		}
	}
}
add_action('comment_post', 'entrada_save_comment_meta_data');

if (!function_exists('entrada_comment_form_before_fields')) {
	function entrada_comment_form_before_fields()
	{
		echo '<div class="row">';
	}
}
add_action('comment_form_before_fields', 'entrada_comment_form_before_fields');

if (!function_exists('entrada_comment_form_after_fields')) {
	function entrada_comment_form_after_fields()
	{
		echo '</div>';
	}
}
add_action('comment_form_after_fields', 'entrada_comment_form_after_fields');

if (!function_exists('entrada_comment')) {
	function entrada_comment($comment, $args, $depth)
	{
		$GLOBALS['comment'] = $comment;
		$rating = get_comment_meta(get_comment_ID(), 'rating', true);
		if (empty($rating) || !is_numeric($rating)) {
			$rating = 0;
		}

		?>
		<li>
			<div class="comment-slot" id="li-comment-<?php comment_ID() ?>">
				<div class="thumb">
					<a href="#"><?php echo get_avatar($comment->comment_author_email, 64); ?></a>
				</div>
				<div class="text">
					<header class="comment-head">
						<div class="left">
							<strong class="name">
								<?php printf(__('<cite class="fn">%s</cite> <span class="says"></span>', 'entrada'), get_comment_author_link()) ?>
							</strong>
							<div class="meta"><?php _e('Commented on',  'entrada'); ?> <time datetime="2015-07-19"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)) ?>"><?php printf(__('%1$s at %2$s', 'entrada'), get_comment_date(),  get_comment_time()); ?></a><?php edit_comment_link(__('(Edit)', 'entrada'), '  ', ''); ?></time></div>
						</div>
						<div class="right">

						</div>
					</header>
					<div class="comment-detail">
						<div class="short-review">
							<p> <?php echo entrada_truncate_comment(get_comment_ID(), 70, 150); ?> </p>
						</div>
						<div class="full-review" style="display:none;">
							<?php comment_text(); ?>
						</div>
						<div class="link-wrapper">
							<div class="link-holder">
								<a href="javascript:void(null);" class="read_full_review" id="<?php echo get_comment_ID(); ?>"><?php _e('Read Full Comment',  'entrada'); ?></a>
							</div>
							<div class="reply">
								<?php $args['reply_text'] =  __('Reply',  'entrada');
										comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
							</div>
						</div>

					</div>
				</div>
			</div>
			<?php
				}
			}

			if (!function_exists('entrada_page_nav')) {
				function entrada_page_nav($query = FALSE)
				{
					if (!$query) {
						global $wp_query;
						$query = $wp_query;
					}
					$entrada_output = '';
					$entrada_post_type = get_post_type();
					if (is_home() || is_archive() || is_search()) {
						$big = 999999999; // need an unlikely integer
						$pages = paginate_links(array(
							'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
							'format' => '?paged=%#%',
							'current' => max(1, get_query_var('paged')),
							'total' => $wp_query->max_num_pages,
							'prev_next' => false,
							'type'  => 'array',
							'prev_next'   => TRUE,
							'prev_text'    => __('<<', 'entrada'),
							'next_text'    => __('>>', 'entrada'),
						));
						if (is_array($pages)) {
							$paged = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');
							echo '<nav class="pagination-wrap bg-gray"><ul class="pagination">';
							foreach ($pages as $page) {
								echo "<li>$page</li>";
							}
							echo '</ul></nav>';
						}
					} else if (is_single() && $entrada_post_type == 'post') {
						$previous = __('Previous', 'entrada');
						$entrada_prev = get_previous_post_link('%link', '<span class="icon icon-arrow-down">&nbsp;</span> <span class="text">' . __('Previous', 'entrada') . ' </span>');
						$entrada_next = get_next_post_link('%link', '<span class="text">' . __('Next', 'entrada') . ' </span> <span class="icon icon-arrow-down">&nbsp;</span>');
						if (!is_null($entrada_prev) || !is_null($entrada_next)) : ?>
					<nav class="post-navigation">
						<div class="nav-links">
							<div class="nav-previous">
								<?php echo sprintf(__('%s', 'entrada'), $entrada_prev); ?>
							</div>
							<div class="nav-next <?php if (!empty($entrada_prev)) echo 'no-border'; ?>">
								<?php echo sprintf(__('%s', 'entrada'), $entrada_next); ?>
							</div>
						</div>
					</nav>
	<?php endif;
			}
			echo sprintf(__('%s', 'entrada'), $entrada_output);;
		}
	} ?>