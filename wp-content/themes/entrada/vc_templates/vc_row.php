<?php
if (!defined('ABSPATH')) {
	die('-1');
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $equal_height
 * @var $columns_placement
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $parallax_speed_bg
 * @var $parallax_speed_video
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$el_class = $full_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = '';
$disable_element = '';
$output = $after_output = '';
$wrapper_container = '';
$entrada_row_bgcolor = '';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

/* Custom Added */
$wrapper_container = "{$wrapper_container}";
$entrada_row_bgcolor = "{$entrada_row_bgcolor}";

wp_enqueue_script('wpb_composer_front_js');

$el_class = $this->getExtraClass($el_class);

$css_classes = array(
	'row', // custom added row inplace of vc_row
	'wpb_row', //deprecated
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class($css),
);

if ('yes' === $disable_element) {
	if (vc_is_page_editable()) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

if (vc_shortcode_custom_css_has_property($css, array('border', 'background')) || $video_bg || $parallax) {
	$css_classes[] = 'vc_row-has-fill';
}

if (!empty($atts['gap'])) {
	$css_classes[] = 'vc_column-gap-' . $atts['gap'];
}

$wrapper_attributes = array();
// build attributes for wrapper
if (!empty($el_id)) {
	$wrapper_attributes[] = 'id="' . esc_attr($el_id) . '"';
}
if (!empty($full_width)) {
	$wrapper_attributes[] = 'data-vc-full-width="true"';
	$wrapper_attributes[] = 'data-vc-full-width-init="false"';
	if ('stretch_row_content' === $full_width) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
	} elseif ('stretch_row_content_no_spaces' === $full_width) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
		$css_classes[] = 'vc_row-no-padding';
	}
	$after_output .= '<div class="vc_row-full-width vc_clearfix"></div>';
}

/* Custom Added */
if (!empty($entrada_row_bgcolor)) {
	$css_classes[] =  esc_attr($entrada_row_bgcolor);
}

if (!empty($full_height)) {
	$css_classes[] = 'vc_row-o-full-height';
	if (!empty($columns_placement)) {
		$flex_row = true;
		$css_classes[] = 'vc_row-o-columns-' . $columns_placement;
		if ('stretch' === $columns_placement) {
			$css_classes[] = 'vc_row-o-equal-height';
		}
	}
}

if (!empty($equal_height)) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-equal-height';
}

if (!empty($content_placement)) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if (!empty($flex_row)) {
	$css_classes[] = 'vc_row-flex';
}

$has_video_bg = (!empty($video_bg) && !empty($video_bg_url) && vc_extract_youtube_id($video_bg_url));

$parallax_speed = $parallax_speed_bg;
if ($has_video_bg) {
	$parallax = $video_bg_parallax;
	$parallax_speed = $parallax_speed_video;
	$parallax_image = $video_bg_url;
	$css_classes[] = 'vc_video-bg-container';
	wp_enqueue_script('vc_youtube_iframe_api_js');
}

if (!empty($parallax)) {
	wp_enqueue_script('vc_jquery_skrollr_js');
	$wrapper_attributes[] = 'data-vc-parallax="' . esc_attr($parallax_speed) . '"'; // parallax speed
	$css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
	if (false !== strpos($parallax, 'fade')) {
		$css_classes[] = 'js-vc_parallax-o-fade';
		$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
	} elseif (false !== strpos($parallax, 'fixed')) {
		$css_classes[] = 'js-vc_parallax-o-fixed';
	}
}

if (!empty($parallax_image)) {
	if ($has_video_bg) {
		$parallax_image_src = $parallax_image;
	} else {
		$parallax_image_id = preg_replace('/[^\d]/', '', $parallax_image);
		$parallax_image_src = wp_get_attachment_image_src($parallax_image_id, 'full');
		if (!empty($parallax_image_src[0])) {
			$parallax_image_src = $parallax_image_src[0];
		}
	}
	$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr($parallax_image_src) . '"';
}
if (!$parallax && $has_video_bg) {
	$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr($video_bg_url) . '"';
}
$css_class = preg_replace('/\s+/', ' ', apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode(' ', array_filter(array_unique($css_classes))), $this->settings['base'], $atts));
switch ($wrapper_container) {
	case "content-block":
		$wrapper_attributes[] = 'class="content-block ' . esc_attr(trim($css_class)) . '"';
		$output .= '<div ' . implode(' ', $wrapper_attributes) . '>';
		$output .= '<div class="container-fluid">';
		$output .= wpb_js_remove_wpautop($content);
		$output .= '</div>';
		$output .= '</div>';
		break;

	case "testimonial-block":
		$wrapper_attributes[] = 'class="' . esc_attr(trim($css_class)) . '"';
		$output .= '<div ' . implode(' ', $wrapper_attributes) . '>';
		$output .= wpb_js_remove_wpautop($content);
		$output .= '</div>';
		break;

	case "adventure-style":
		$wrapper_attributes[] = 'class="content-block gallery-home-block ' . esc_attr(trim($css_class)) . '"';
		$output .= '<div ' . implode(' ', $wrapper_attributes) . '>';
		$output .= '<div class="container">';
		$output .= wpb_js_remove_wpautop($content);
		$output .= '</div>';
		$output .= '</div>';
		break;

	case "content-block-no-padding-margin":
		$wrapper_attributes[] = 'class="content-block-no-padding-margin ' . esc_attr(trim($css_class)) . '"';
		$output .= '<div ' . implode(' ', $wrapper_attributes) . '>';
		$output .= wpb_js_remove_wpautop($content);
		$output .= '</div>';
		break;

	case "partner-block":
		$wrapper_attributes[] = 'class="partner-block ' . esc_attr(trim($css_class)) . '"';
		$output .= '<div ' . implode(' ', $wrapper_attributes) . '>';
		$output .= '<div class="container">';
		$output .= wpb_js_remove_wpautop($content);
		$output .= '</div>';
		$output .= '</div>';
		break;

	case "services-section":
		$wrapper_attributes[] = 'class="services-block ' . esc_attr(trim($css_class)) . '"';
		$output .= '<div ' . implode(' ', $wrapper_attributes) . '>';
		$output .= '<div class="container">';
		$output .= wpb_js_remove_wpautop($content);
		$output .= '</div>';
		$output .= '</div>';
		break;

	case "step-block":
		$wrapper_attributes[] = 'class="step-block text-center parallax ' . esc_attr(trim($css_class)) . '"';
		$output .= '<div ' . implode(' ', $wrapper_attributes) . '  data-stellar-background-ratio="0.3">';
		$output .= '<div class="container">';
		$output .= wpb_js_remove_wpautop($content);
		$output .= '</div>';
		$output .= '</div>';
		break;

	case "services-block":
		$wrapper_attributes[] = 'class="' . esc_attr(trim($css_class)) . '"';
		$output .= '<div class="services-block">';
		$output .= '<div class="container">';
		$output .= '<div ' . implode(' ', $wrapper_attributes) . '>';
		$output .= wpb_js_remove_wpautop($content);
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		break;

	case "about-service-block":
		$output .= '<div class="services-block has-bg parallax" id="about-service-block">';
		$output .= '<div class="container">';
		$output .= '<div class="row db-3-col">';
		$output .= wpb_js_remove_wpautop($content);
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		break;

	case "guide-block":

		$wrapper_attributes[] = 'class="content-block guide-sub guide-add ' . esc_attr(trim($css_class)) . '"';
		$output .= '<div ' . implode(' ', $wrapper_attributes) . '>';
		$output .= '<div class="container">';
		$output .= wpb_js_remove_wpautop($content);
		$output .= '</div>';
		$output .= '</div>';
		break;

	case "count-block":
		$wrapper_attributes[] = 'class="count-block ' . esc_attr(trim($css_class)) . '"';
		$output .= '<div ' . implode(' ', $wrapper_attributes) . '>';
		$output .= '<div class="container-fluid">';
		$output .= wpb_js_remove_wpautop($content);
		$output .= '</div>';
		$output .= '</div>';
		break;

	case "special-block":
		$wrapper_attributes[] = 'class="special-block ' . esc_attr(trim($css_class)) . '"';
		$output .= '<div ' . implode(' ', $wrapper_attributes) . '>';
		$output .= '<div class="container">';
		$output .= wpb_js_remove_wpautop($content);
		$output .= '</div>';
		$output .= '</div>';
		break;

	case "featured-product-block":
		$wrapper_attributes[] = 'class="featured-content adventure-holder ' . esc_attr(trim($css_class)) . '"';
		$output .= '<div ' . implode(' ', $wrapper_attributes) . '>';
		$output .= wpb_js_remove_wpautop($content);
		$output .= '</div>';
		break;

	case "browse-block":
		$wrapper_attributes[] = 'class="browse-block ' . esc_attr(trim($css_class)) . '"';
		$output .= '<div ' . implode(' ', $wrapper_attributes) . '>';
		$output .= wpb_js_remove_wpautop($content);
		$output .= '</div>';
		break;

	case "product-list-block":
		$wrapper_attributes[] = 'class="content-block product-list-block ' . esc_attr(trim($css_class)) . '"';
		$output .= '<div ' . implode(' ', $wrapper_attributes) . '>';
		$output .= '<div class="container">';
		$output .= wpb_js_remove_wpautop($content);
		$output .= '</div>';
		$output .= '</div>';
		break;

	case "no-container":
		$wrapper_attributes[] = 'class="' . esc_attr(trim($css_class)) . '"';
		$output .= '<div ' . implode(' ', $wrapper_attributes) . '>';
		$output .= wpb_js_remove_wpautop($content);
		$output .= '</div>';
		break;

	default:
		$wrapper_attributes[] = 'class="content-block ' . esc_attr(trim($css_class)) . '"';
		$output .= '<div ' . implode(' ', $wrapper_attributes) . '>';
		$output .= '<div class="container">';
		$output .= wpb_js_remove_wpautop($content);
		$output .= '</div>';
		$output .= '</div>';
}
$output .= $after_output;
echo sprintf(__('%s', 'entrada'), $output);
