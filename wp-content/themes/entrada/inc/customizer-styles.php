<?php

/**
 * Entrada Theme Customizer CSS.
 *
 * @package Entrada
 */
$layout_style = $preloader_style = $logo_style = $search_style = $icon_style = $gal_style = $call_style = $product_style = $blog_style = $counter_style = $browse_style = $guide_style = $partner_style = $foot_style = $filter_style = $map_style = $main_heading_style = $links_style = $round_button_style = $square_button_style = $large_button_style = $nav_bar_style = $top_style = $footer_style = $text_style = $footer_colour = '';

$checkfonts = get_theme_mod('google_font_setting');
$checkfontsweight = get_theme_mod('google_fontvariant_setting');

/* Layout */
$layout_style = '';
$sitelayout_onoff = get_theme_mod('sitelayout_onoff', 'wide');
if ('boxed' == $sitelayout_onoff) {
	$sitelayout_boxed_option = get_theme_mod('sitelayout_boxed_option', 'bckcolour');
	if ("bckcolour" == $sitelayout_boxed_option) {
		$bckcolor = get_theme_mod('bckgrd_bckcolour');
		if (!empty($bckcolor)) {
			$layout_style = '.boxed-layout{background: ' . $bckcolor . ';}';
		}
	} else if ("bckimage" == $sitelayout_boxed_option) {
		$bckimage = get_theme_mod('bckgrd_bckimage');
		if (!empty($bckimage)) {
			$layout_style = ".boxed-layout.bg-image{background: url('" . $bckimage . "') no-repeat; background-attachment:fixed; background-size:cover; }";
		}
	} else if ("bckpattern" == $sitelayout_boxed_option) {
		$bckpattern = get_theme_mod('bckgrd_bckpattern');
		if (!empty($bckpattern)) {
			$layout_style = ".boxed-layout.bg-pattern{ background: url('" . $bckpattern . "'); }";
		}
	}
}

/* Preloader */
$preloader_style = '';
$preloader_onoff = get_theme_mod('preloader_onoff', 'yes');
if (isset($preloader_onoff)) {
	if ('' == $preloader_onoff) {
		$preloader_style = ".preloader{ display:none; }";
	}
}

/* Search For Banner */
$search_count = 0;
$search_style = '';
$search_array = array();
$entrada_search_block_background = get_theme_mod('entrada_search_block_background', '#b0a377');
if (!empty($entrada_search_block_background) && '#b0a377' != $entrada_search_block_background) {
	list($bg_r, $bg_g, $bg_b) = sscanf($entrada_search_block_background, "#%02x%02x%02x");
	$search_array['background'] = 'rgba( ' . $bg_r . ', ' . $bg_g . ', ' . $bg_b . ', .95 )';
	$search_count++;
}
$entrada_search_block_border = get_theme_mod('entrada_search_block_border', '#b0a377');
if (!empty($entrada_search_block_border) && '#b0a377' != $entrada_search_block_border) {
	list($bg_r, $bg_g, $bg_b) = sscanf($entrada_search_block_border, "#%02x%02x%02x");
	$search_array['border-color'] = 'rgba( ' . $bg_r . ', ' . $bg_g . ', ' . $bg_b . ', .61 )';
	$search_count++;
}
$entrada_search_block_box_shadow = get_theme_mod('entrada_search_block_box_shadow', '#b0a377');
if (!empty($entrada_search_block_box_shadow) && '#b0a377' != $entrada_search_block_box_shadow) {
	list($bg_r, $bg_g, $bg_b) = sscanf($entrada_search_block_box_shadow, "#%02x%02x%02x");
	$search_array['box-shadow'] = '0 2px 2px rgba( ' . $bg_r . ', ' . $bg_g . ', ' . $bg_b . ', .75 )';
	$search_count++;
}

$banner_searchbox_bg_onoff = get_theme_mod('searchbox_bg_onoff');
if (isset($banner_searchbox_bg_onoff) && $banner_searchbox_bg_onoff == 'on') {

	if ($search_count > 0) {
		$search_style .= '.banner-trip-form{';
		foreach ($search_array as $id => $value) {
			$search_style .= $id . ': ' . $value . ';';
		}
		$search_style .= '}';
	}
} else {
	$search_style .= '.banner-trip-form{ background:none; border:none;}';
}

$banner_trip_form_label = get_theme_mod('entrada_search_block_label');
if (!empty($banner_trip_form_label)) {
	$search_style .= '.banner-trip-form label{';
	$search_style .= 'color: ' . $banner_trip_form_label . ';';
	$search_style .= '}';
}

$banner_trip_form_text = get_theme_mod('entrada_search_block_text');
if (!empty($banner_trip_form_text)) {
	$search_style .= '.jcf-select.jcf-select-trip-banner .jcf-select-text{';
	$search_style .= 'color: ' . $banner_trip_form_text . ';';
	$search_style .= '}';
}

$banner_trip_form_calendar_icon = get_theme_mod('entrada_search_block_calendar_icon');
if (!empty($banner_trip_form_calendar_icon)) {
	$search_style .= '.trip-form.banner-trip-form .date.picker-solid-bg:before{';
	$search_style .= 'color: ' . $banner_trip_form_calendar_icon . ';';
	$search_style .= '}';
}

$banner_trip_form_arrow = get_theme_mod('entrada_search_block_arrow');
if (!empty($banner_trip_form_arrow)) {
	$search_style .= '.jcf-select.jcf-select-trip-banner .jcf-select-opener:after, .trip-form.banner-trip-form .input-group.date .input-group-addon{';
	$search_style .= 'color: ' . $banner_trip_form_arrow . ';';
	$search_style .= '}';
}

$entrada_search_block_select_bg = get_theme_mod('entrada_search_block_select_bg', '#252525');
if (!empty($entrada_search_block_select_bg) && '#252525' != $entrada_search_block_select_bg) {
	list($bg_r, $bg_g, $bg_b) = sscanf($entrada_search_block_select_bg, "#%02x%02x%02x");
	$banner_trip_form_select_bg = 'rgba( ' . $bg_r . ', ' . $bg_g . ', ' . $bg_b . ', 1 )';
	$search_style .= '.trip-form.banner-trip-form .input-group.date, .jcf-select.jcf-select-trip-banner{';
	$search_style .= 'background: ' . $banner_trip_form_select_bg . ';';
	$search_style .= '}';
}

$entrada_search_block_dropdown_bg = get_theme_mod('entrada_search_block_dropdown_bg', '#b0a377');
if (!empty($entrada_search_block_dropdown_bg) && '#b0a377' != $entrada_search_block_dropdown_bg) {
	list($bg_r, $bg_g, $bg_b) = sscanf($entrada_search_block_dropdown_bg, "#%02x%02x%02x");
	$banner_trip_form_dropdown_bg = 'rgba( ' . $bg_r . ', ' . $bg_g . ', ' . $bg_b . ', 1 )';
	$search_style .= '.jcf-select-trip.jcf-select-trip-banner .jcf-list{';
	$search_style .= 'background: ' . $banner_trip_form_dropdown_bg . ';';
	$search_style .= '}';
}

$search_count = 0;
$search_array = array();
$entrada_search_block_dropdown_bg_hover = get_theme_mod('entrada_search_block_dropdown_bg_hover', '#0c0c0c');
if (!empty($entrada_search_block_dropdown_bg_hover) && '#0c0c0c' != $entrada_search_block_dropdown_bg_hover) {
	list($bg_r, $bg_g, $bg_b) = sscanf($entrada_search_block_dropdown_bg_hover, "#%02x%02x%02x");
	$banner_trip_form_dropdown_bg_hover = 'rgba( ' . $bg_r . ', ' . $bg_g . ', ' . $bg_b . ', 1 )';
	$search_style .= '.jcf-select-trip.jcf-select-trip-banner .jcf-hover{';
	$search_style .= 'background:' . $banner_trip_form_dropdown_bg_hover . ';';
	$search_style .= '}';
}

$banner_trip_form_dropdown_text = get_theme_mod('entrada_search_block_dropdown_text');
if (!empty($banner_trip_form_dropdown_text)) {
	$search_style .= '.jcf-select-trip.jcf-select-trip-banner .jcf-option{';
	$search_style .= 'color: ' . $banner_trip_form_dropdown_text . ';';
	$search_style .= '}';
}

$banner_trip_form_dropdown_text_hover = get_theme_mod('entrada_search_block_dropdown_text_hover');
if (!empty($banner_trip_form_dropdown_text_hover)) {
	$search_style .= '.jcf-select-trip.jcf-select-trip-banner .jcf-option.jcf-hover{';
	$search_style .= 'color:' . $banner_trip_form_dropdown_text_hover . ';';
	$search_style .= '}';
}

$search_count = 0;
$search_array = array();
$banner_trip_form_button_bg = get_theme_mod('entrada_search_block_button_bg');
if (!empty($banner_trip_form_button_bg)) {
	$search_count++;
	$search_array['background'] = $banner_trip_form_button_bg;
}
$banner_trip_form_button = get_theme_mod('entrada_search_block_button');
if (!empty($banner_trip_form_button)) {
	$search_count++;
	$search_array['color'] = $banner_trip_form_button;
}
if ($search_count > 0) {
	$search_style .= '.trip-form.banner-trip-form .btn-trip{';
	foreach ($search_array as $id => $value) {
		$search_style .= $id . ': ' . $value . ';';
	}
	$search_style .= '}';
}
$search_count = 0;
$search_array = array();
$banner_trip_form_button_hover_bg = get_theme_mod('entrada_search_block_button_hover_bg');
if (!empty($banner_trip_form_button_hover_bg)) {
	$search_count++;
	$search_array['background'] = $banner_trip_form_button_hover_bg;
}

$banner_trip_form_button_hover = get_theme_mod('entrada_search_block_button_hover');
if (!empty($banner_trip_form_button_hover)) {
	$search_count++;
	$search_array['color'] = $banner_trip_form_button_hover;
}
if ($search_count > 0) {
	$search_style .= '.trip-form.banner-trip-form .btn-trip:hover{';
	foreach ($search_array as $id => $value) {
		$search_style .= $id . ': ' . $value . ';';
	}
	$search_style .= '}';
}

/* Icon Bar */
$icon_style = '';
$icon_color = get_theme_mod('entrada_icon_color');
if (!empty($icon_color)) {
	$icon_style .= '.feature-block li a .ico{';
	$icon_style .= 'color: ' . $icon_color . ';';
	$icon_style .= '}';
}
$icon_text_color = get_theme_mod('entrada_icon_text_color');
if (!empty($icon_text_color)) {
	$icon_style .= '.feature-block li a .info{';
	$icon_style .= 'color: ' . $icon_text_color . ';';
	$icon_style .= '}';
}
$icon_hover_color = get_theme_mod('entrada_icon_hover_color');
if (!empty($icon_hover_color)) {
	$icon_style .= '.feature-block li a:hover .ico{';
	$icon_style .= 'color: ' . $icon_hover_color . ';';
	$icon_style .= '}';
}
$icon_text_hover_color = get_theme_mod('entrada_icon_text_hover_color');
if (!empty($icon_text_hover_color)) {
	$icon_style .= '.feature-block li a:hover .info{';
	$icon_style .= 'color: ' . $icon_text_hover_color . ';';
	$icon_style .= '}';
}

/* Gallery Block */
$gal_style = '';
$gallery_icon_hover_bg_color = get_theme_mod('entrada_icon_hover_bg_color');
if (!empty($gallery_icon_hover_bg_color)) {
	$gal_style .= '.gallery-list a:after{';
	$gal_style .= 'background: ' . $gallery_icon_hover_bg_color . ';';
	$gal_style .= '}';
}
$gllery_icon_hover_color = get_theme_mod('entrada_cat_gllery_icon_hover_color');
if (!empty($gllery_icon_hover_color)) {
	$gal_style .= '.gallery-list a:hover .hover{';
	$gal_style .= 'color: ' . $gllery_icon_hover_color . ';';
	$gal_style .= '}';
}
$gallery_text_hover_color = get_theme_mod('entrada_cat_gallery_text_hover_color');
if (!empty($gallery_text_hover_color)) {
	$gal_style .= '.gallery-list a:hover .info{';
	$gal_style .= 'color: ' . $gallery_text_hover_color . ';';
	$gal_style .= '}';
}

/* Call To Action Block */
$call_action_count = 0;
$call_action_array = array();
$entrada_call_to_action_background = get_theme_mod('entrada_call_to_action_background', '#252525');
if (!empty($entrada_call_to_action_background) && '#252525' != $entrada_call_to_action_background) {
	$call_action_count++;
	$call_action_array['background'] = $entrada_call_to_action_background;
}
$call_to_action_border = get_theme_mod('entrada_call_to_action_border', '#5f6865');
if (!empty($call_to_action_border) && '#5f6865' != $call_to_action_border) {
	$call_action_count++;
	$call_action_array['border-color'] = $call_to_action_border;
}

if ($call_action_count > 0) {
	$call_style .= '.special-block{';
	foreach ($call_action_array as $id => $value) {
		$call_style .= $id . ': ' . $value . ';';
	}
	$call_style .= '}';
}

/* Product Listing */
$product_style = '';
$product_title_color = get_theme_mod('entrada_product_title_color', '#474d4b');
if (!empty($product_title_color) && '#474d4b' != $product_title_color) {
	$product_style .= '.article h3 a, h1.small-size{ color: ' . $product_title_color . '; }';
	$product_title = 'yes';
}

$product_title_hover_color = get_theme_mod('entrada_product_title_hover_color', '#b0a377');
if (!empty($product_title_hover_color) && '#b0a377' != $product_title_hover_color) {
	$product_style .= '.article.has-hover-s3:hover h3 a, .article .thumbnail:hover h3 a, .list-view .article .thumbnail:hover h3 a{color: ' . $product_title_hover_color . ';}';
	$product_title_hover = 'yes';
}

$product_price = get_theme_mod('entrada_product_price');
if (!empty($product_price)) {
	$product_style .= '.thumbnail .price > span, .trip-info .price strong, .list-view .article .info-aside .price > span, .recent-block .thumbnail .sub-info > span:last-child{';
	$product_style .= 'color: ' . $product_price . ';';
	$product_style .= '}';
}

$product_price_hover = get_theme_mod('entrada_product_price_hover', '#b0a377');
if (!empty($product_price_hover) && '#b0a377' != $product_price_hover) {
	$product_style .= '.article .thumbnail:hover footer .price span, .list-view .article .thumbnail:hover .price span, .recent-block .thumbnail:hover .sub-info span:last-child{';
	$product_style .= 'color: ' . $product_price_hover . ';';
	$product_style .= '}';
};

$product_tag_hover = get_theme_mod('entrada_product_tag_hover');
if (!empty($product_tag_hover)) {
	$product_style .= ".article .pop-opener:hover [class^='icon-'], .pop-opener:hover [class^='icon-']{ color: " . $product_tag_hover . ";}";
	$product_style .= ".recent-block .article .popup, .article .popup, .popup{ background-color: " . $product_tag_hover . ";}";
	$product_style .= ".recent-block .article .popup:before, .pop-opener.top .popup:before{ color: " . $product_tag_hover . "; border-top-color: " . $product_tag_hover . ";}";
	$product_style .= ".article .popup:before, .popup:before{ color: " . $product_tag_hover . ";  border-bottom-color: " . $product_tag_hover . "; }";
}

$product_count = 0;
$product_array = array();
$product_button = get_theme_mod('entrada_product_button', '#b0a377');
if (!empty($product_button) && '#b0a377' != $product_button) {
	$product_count++;
	$product_array['background'] = $product_button;
};
$product_border = get_theme_mod('entrada_product_button_border', '#b0a377');
if (!empty($product_border) && '#b0a377' != $product_border) {
	$product_count++;
	$product_array['border-color'] = $product_border;
};
$product_button_text = get_theme_mod('entrada_product_button_text');
if (!empty($product_button_text)) {
	$product_count++;
	$product_array['color'] = $product_button_text;
};

if ($product_count > 0) {
	$product_style .= '.btn.btn-info{';
	foreach ($product_array as $id => $value) {
		$product_style .= $id . ': ' . $value . ';';
	}
	$product_style .= '}';
}

$product_count = 0;
$product_array = array();
$product_button_hover = get_theme_mod('entrada_product_button_hover', '#b0a377');
if (!empty($product_button_hover) && '#b0a377' != $product_button_hover) {
	$product_count++;
	$product_array['background'] = $product_button_hover;
};
$product_border_hover = get_theme_mod('entrada_product_button_border_hover', '#b0a377');
if (!empty($product_border_hover) && '#b0a377' != $product_border_hover) {
	$product_count++;
	$product_array['border-color'] = $product_border_hover;
};
$product_button_text_hover = get_theme_mod('entrada_product_button_text_hover');
if (!empty($product_button_text_hover)) {
	$product_count++;
	$product_array['color'] = $product_button_text_hover;
};

if ($product_count > 0) {
	$product_style .= '.btn.btn-info:hover{';
	foreach ($product_array as $id => $value) {
		$product_style .= $id . ': ' . $value . ';';
	}
	$product_style .= '}';
}

$product_image_caption = get_theme_mod('entrada_product_image_caption');
if (!empty($product_image_caption)) {
	$product_style .= ".article .img-caption{ color: " . $product_image_caption . ";}";
}

/* Blog Listing */
$blog_style = '';
$blog_title_color = get_theme_mod('entrada_blog_title_color');
if (!empty($blog_title_color)) {
	$blog_style .= '.article.blog-article h3 a{ color: ' . $blog_title_color . '; }';
}

$blog_title_hover_color = get_theme_mod('entrada_blog_title_hover_color', '#b0a377');
if (!empty($blog_title_hover_color) && '#b0a377' != $blog_title_hover_color) {
	$blog_style .= '.article.blog-article .thumbnail:hover h3 a, .article.blog-article:hover .heading h3 a{ color: ' . $blog_title_hover_color . '; }';
}

$blog_sidebar_title_color = get_theme_mod('entrada_blog_sidebar_title', '#b0a377');
if (!empty($blog_sidebar_title_color) && '#b0a377' != $blog_sidebar_title_color) {
	$blog_style .= '.sidebar .panel-heading a{ color: ' . $blog_sidebar_title_color . '; }';
}

$blog_sidebar_heading_color = get_theme_mod('entrada_blog_sidebar_heading', '#9d9d9d');
if (!empty($blog_sidebar_heading_color) && '#9d9d9d' != $blog_sidebar_heading_color) {
	$blog_style .= '.side-list.hovered-list a{ color: ' . $blog_sidebar_heading_color . '; }';
}

$blog_sidebar_heading_hover_color = get_theme_mod('entrada_blog_sidebar_heading_hover', '#9d9d9d');
if (!empty($blog_sidebar_heading_hover_color) && '#9d9d9d' != $blog_sidebar_heading_hover_color) {
	$blog_style .= '.side-list.hovered-list a:hover{ color: ' . $blog_sidebar_heading_hover_color . '; }';
}

/* Counter Block */
$counter_style = '';
$counter_first = get_theme_mod('entrada_counter_first', '#b0a377');
if (!empty($counter_first) && '#b0a377' != $counter_first) {
	$counter_style .= '.count-block .block-1{background:' . $counter_first . ';}';
}

$counter_second = get_theme_mod('entrada_counter_second', '#b0a377');
if (!empty($counter_second) && '#b0a377' != $counter_second) {
	$counter_style .= '.count-block .block-2{background:' . $counter_second . ';}';
}

$counter_third = get_theme_mod('entrada_counter_third', '#474d4b');
if (!empty($counter_third) && '#474d4b' != $counter_third) {
	$counter_style .= '.count-block .block-3{background:' . $counter_third . ';}';
}

$counter_fourth = get_theme_mod('entrada_counter_fourth', '#b0a377');
if (!empty($counter_fourth) && '#b0a377' != $counter_fourth) {
	$counter_style .= '.count-block .block-4{background:' . $counter_fourth . ';}';
}

/* Browse by Block */
$browse_style = '';
$browse_by_destination = get_theme_mod('entrada_browse_by_destination', '#b0a377');
if (!empty($browse_by_destination) && '#b0a377' != $browse_by_destination) {
	$browse_style .= '.browse-block .column.browse-destination a{background:' . $browse_by_destination . ';}';
}

$browse_by_destination_hover = get_theme_mod('entrada_browse_by_destination_hover', '#9a8c5a');
if (!empty($browse_by_destination_hover) && '#9a8c5a' != $browse_by_destination_hover) {
	$browse_style .= '.browse-block .column.browse-destination a:hover{background:' . $browse_by_destination_hover . ';}';
}

$browse_by_adventure = get_theme_mod('entrada_browse_by_adventure', '#474d4b');
if (!empty($browse_by_adventure) && '#474d4b' != $browse_by_adventure) {
	$browse_style .= '.browse-block .column.browse-adventures a{background:' . $browse_by_adventure . ';}';
}

$browse_by_adventure_hover = get_theme_mod('entrada_browse_by_adventure_hover', '#b0a377');
if (!empty($browse_by_adventure_hover) && '#b0a377' != $browse_by_adventure_hover) {
	$browse_style .= '.browse-block .column.browse-adventures a:hover{background:' . $browse_by_adventure_hover . ';}';
}

$entrada_browse_by_text = get_theme_mod('entrada_browse_by_text');
if (!empty($entrada_browse_by_text)) {
	$browse_style .= '.browse-block a{color:' . $entrada_browse_by_text . ';}';
}

$browse_by_text_hover = get_theme_mod('entrada_browse_by_text_hover', '#b0a377');
if (!empty($browse_by_text_hover) && '#b0a377' != $browse_by_text_hover) {
	$browse_style .= '.browse-block a:hover{color:' . $browse_by_text_hover . ';}';
}

/* Guide Colours */
$guide_style = '';
$guide_bg = get_theme_mod('entrada_guide_bg');
if (!empty($guide_bg)) {
	$guide_style .= '.img-article .caption{background:' . $guide_bg . ';}';
}

$guide_bg_hover = get_theme_mod('entrada_guide_bg_hover', '#b0a377');
if (!empty($guide_bg_hover) && '#b0a377' != $guide_bg_hover) {
	$guide_style .= '.img-article .holder:hover .caption{background:' . $guide_bg_hover . ';}';
}

$guide_text = get_theme_mod('entrada_guide_name');
if (!empty($guide_text)) {
	$guide_style .= '.img-article .caption h3{color:' . $guide_text . ';}';
}

$guide_text_hover = get_theme_mod('entrada_guide_name_hover', '#b0a377');
if (!empty($guide_text_hover) && '#b0a377' != $guide_text_hover) {
	$guide_style .= '.content-block.guide-sub .holder:hover .caption,.content-block.guide-sub .holder:hover .caption h3{color:' . $guide_text_hover . ';}';
}

/* Partner Block */
$partner_bottom_border = get_theme_mod('entrada_partner_bottom_border', '#b0a377');
if (!empty($partner_bottom_border) && '#b0a377' != $partner_bottom_border) {
	$partner_style = '.partner-block a:before{ background: ' . $partner_bottom_border . '; }';
}

/* Footer Block */
$foot_array = array();
$foot_count = 0;
$foot_style = '';
$footer_newsletter = get_theme_mod('entrada_footer_newsletter', '#6b6957');
if (!empty($footer_newsletter) && '#6b6957' != $footer_newsletter) {
	$foot_style .= '.newsletter-form .form-control{color: ' . $footer_newsletter . ';}';
	$foot_style .= '.newsletter-form .form-control::-webkit-input-placeholder{ color: ' . $footer_newsletter . ';}';
	$foot_style .= '.newsletter-form .form-control:-moz-placeholder{color: ' . $footer_newsletter . ';}';
	$foot_style .= '.newsletter-form .form-control::-moz-placeholder{color: ' . $footer_newsletter . ';}';
	$foot_style .= '.newsletter-form .form-control:-ms-input-placeholder{color: ' . $footer_newsletter . ';}';
	$foot_style .= '.newsletter-form .input-holder{border-color: ' . $footer_newsletter . ';}';
	$foot_style .= ".newsletter-form [type='submit']{ border-color: " . $footer_newsletter . ";color: " . $footer_newsletter . ";}";
	$foot_array['background'] = $footer_newsletter;
	$foot_count++;
}
$footer_newsletter_text_hover = get_theme_mod('entrada_footer_newsletter_text_hover', '#ffffff');
if (!empty($footer_newsletter_text_hover) && '#ffffff' != $footer_newsletter_text_hover) {
	$foot_array['color'] = $footer_newsletter_text_hover;
	$foot_count++;
}
if ($foot_count > 0) {
	$foot_style .= ".newsletter-form [type='submit']:hover{";
	foreach ($foot_array as $id => $value) {
		$foot_style .= $id . ': ' . $value . ';';
	}
	$foot_style .= '}';
}

$footer_newsletter_text = get_theme_mod('entrada_footer_newsletter_text_colour', '#9d9d9d');
if (!empty($footer_newsletter_text) && '#9d9d9d' != $footer_newsletter_text) {
	$foot_style .= '.newsletter-form .info { color: ' . $footer_newsletter_text . '; }';
}

$footer_column_title = get_theme_mod('entrada_footer_column_title');
if (!empty($footer_column_title)) {
	$foot_style .= '.footer-nav h3{ color: ' . $footer_column_title . '; }';
}

$footer_link = get_theme_mod('entrada_footer_link');
if (!empty($footer_link)) {
	$foot_style .= '.footer-nav ul li{ color: ' . $footer_link . '; }';
	$foot_style .= '.footer-nav a{ color: ' . $footer_link . '; }';
}

$footer_link_hover = get_theme_mod('entrada_footer_link_hover', '#e2e2e2');
if (!empty($footer_link_hover) && '#e2e2e2' != $footer_link_hover) {
	$foot_style .= '.footer-nav a:hover{ color: ' . $footer_link_hover . '; }';
}

$footer_social = get_theme_mod('entrada_footer_social', '#6b6957');
if (!empty($footer_social) && '#6b6957' != $footer_social) {
	$foot_style .= '.social-wrap li a{ color: ' . $footer_social . '; }';
}

$footer_social_hover = get_theme_mod('entrada_footer_social_hover', '#b0a377');
if (!empty($footer_social_hover) && '#b0a377' != $footer_social_hover) {
	$foot_style .= '.social-wrap li a:hover{ color: ' . $footer_social_hover . '; }';
}

/* Filter Colour */
$filter_style = '';
$filter_select_color = get_theme_mod('entrada_filter_select', '#b0a377');
if (!empty($filter_select_color) && '#b0a377' != $filter_select_color) {
	$filter_style .= '.jcf-select.jcf-select-filter-select{';
	$filter_style .= 'background: ' . $filter_select_color . ';';
	$filter_style .= '}';
}
$filter_select_arrow = get_theme_mod('entrada_filter_select_arrow', '#ffffff');
if (!empty($filter_select_arrow) && '#ffffff' != $filter_select_arrow) {
	$filter_style .= '.jcf-select.jcf-select-filter-select .jcf-select-opener:after{';
	$filter_style .= 'color: ' . $filter_select_arrow . ';';
	$filter_style .= '}';
}
$filter_select_text = get_theme_mod('entrada_filter_select_text', '#ffffff');
if (!empty($filter_select_text) && '#ffffff' != $filter_select_text) {
	$filter_style .= '.jcf-select.jcf-select-filter-select .jcf-select-text{';
	$filter_style .= 'color: ' . $filter_select_text . ';';
	$filter_style .= '}';
}
$filter_dropdown_box = get_theme_mod('entrada_filter_dropdown_box');
if (!empty($filter_dropdown_box)) {
	$filter_style .= '.jcf-select-drop.jcf-select-filter-select .jcf-list{';
	$filter_style .= 'background: ' . $filter_dropdown_box . ';';
	$filter_style .= '}';
}
$filter_dropdown_text = get_theme_mod('entrada_filter_dropdown_text');
if (!empty($filter_dropdown_text)) {
	$filter_style .= '.jcf-select-drop.jcf-select-filter-select .jcf-option{';
	$filter_style .= 'color: ' . $filter_dropdown_text . ';';
	$filter_style .= '}';
}

$filter_count = 0;
$filter_array = array();
$filter_dropdown_box_hover = get_theme_mod('entrada_filter_dropdown_box_hover');
if (!empty($filter_dropdown_box_hover)) {
	$filter_count++;
	$filter_array['background'] = $filter_dropdown_box_hover;
}
$filter_dropdown_text_hover = get_theme_mod('entrada_filter_dropdown_text_hover');
if (!empty($filter_dropdown_text_hover)) {
	$filter_count++;
	$filter_array['color'] = $filter_dropdown_text_hover;
}
if ($filter_count > 0) {
	$filter_style .= '.jcf-select-drop.jcf-select-filter-select .jcf-option.jcf-hover{';
	foreach ($filter_array as $id => $value) {
		$filter_style .= $id . ': ' . $value . ';';
	}
	$filter_style .= '}';
}

$view_option = get_theme_mod('entrada_view_option', '#b0a377');
if (!empty($view_option) && '#b0a377' != $view_option) {
	$filter_style .= '.filter-option .link.active, .filter-option .link:hover{';
	$filter_style .= 'color: ' . $view_option . ';';
	$filter_style .= '}';
}

/* Category Page */
$map_style = '';
$category_page_map = get_theme_mod('entrada_category_page_map', '#474d4b');
if (!empty($category_page_map) && '#474d4b' != $category_page_map) {
	$map_style .= '.content-intro .map-col .holder{';
	$map_style .= 'background: ' . $category_page_map . ';';
	$map_style .= '}';
}

/* Body and content */
$body_count = 0;
$body_style = '';
$body_array = array();
if (isset($checkfonts['"body_content"']) && 'Montserrat' != $checkfonts['"body_content"']) {
	$body_google_font = str_replace("+", " ", $checkfonts['"body_content"']);
	if (!empty($body_google_font)) {
		$body_count++;
		$body_array['font-family'] = "'" . $body_google_font . "'";
	}
}

if (isset($checkfontsweight['"body_content"'])) {
	if (!empty($checkfontsweight['"body_content"']) && 'default' != $checkfontsweight['"body_content"']) {
		$body_font_weight = explode(":", $checkfontsweight['"body_content"']);
		if (!empty($body_font_weight)) {
			$body_count++;
			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i', $body_font_weight[1]);
			foreach ($arr as $values) {
				if (is_numeric($values)) {
					$body_array['font-weight'] = $values;
				} else {
					if ("regular" == strtolower($values)) {
						$body_array['font-weight'] = 'normal';
					} else {
						$body_array['font-style'] = $values;
					}
				}
			}
		}
	}
}

$body_font_colour = get_theme_mod('body_font_colour');
if (!empty($body_font_colour) && '#5c5e62' != $body_font_colour) {
	$body_count++;
	$body_array['color'] = $body_font_colour;
}

$body_font_size = get_theme_mod('body_font_size');
if (!empty($body_font_size)) {
	$body_count++;
	$body_array['font-size'] = $body_font_size . "px";
}

if ($body_count > 0) {
	$body_style = 'body{';
	foreach ($body_array as $id => $value) {
		$body_style .= $id . ': ' . $value . ';';
	}
	$body_style .= '}';
}

/* heading h1 */
$heading_hone_count = 0;
$heading_hone_style = '';
$heading_hone_array = array();
if (isset($checkfonts['"heading_hone"']) && 'Montserrat' != $checkfonts['"heading_hone"']) {
	$heading_google_font = str_replace("+", " ", $checkfonts['"heading_hone"']);
	if (!empty($heading_google_font)) {
		$heading_hone_count++;
		$heading_hone_array['font-family'] = "'" . $heading_google_font . "'";
	}
}

if (isset($checkfontsweight['"heading_hone"'])) {
	if (!empty($checkfontsweight['"heading_hone"']) && 'default' != $checkfontsweight['"heading_hone"']) {
		$heading_font_weight = explode(":", $checkfontsweight['"heading_hone"']);
		if (!empty($heading_font_weight)) {
			$heading_hone_count++;
			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i', $heading_font_weight[1]);
			foreach ($arr as $values) {
				if (is_numeric($values)) {
					$heading_hone_array['font-weight'] = $values;
				} else {
					if ("regular" == strtolower($values)) {
						$heading_hone_array['font-weight'] = 'normal';
					} else {
						$heading_hone_array['font-style'] = $values;
					}
				}
			}
		}
	}
}

$heading_hone_colour = get_theme_mod('heading_hone_colour');
if (!empty($heading_hone_colour)) {
	$heading_hone_count++;
	$heading_hone_array['color'] = $heading_hone_colour;
}

$heading_hone_font_size = get_theme_mod('heading_hone_font_size');
if (!empty($heading_hone_font_size)) {
	$heading_hone_count++;
	$heading_hone_array['font-size'] = $heading_hone_font_size . "px";
}

if ($heading_hone_count > 0) {
	$heading_hone_style = 'h1{';
	foreach ($heading_hone_array as $id => $value) {
		$heading_hone_style .= $id . ': ' . $value . ';';
	}
	$heading_hone_style .= '}';
}

/* main heading h2 */
$main_heading_count = 0;
$main_heading_style = '';
$main_heading_array = array();
if (isset($checkfonts['"main_heading"']) && 'Montserrat' != $checkfonts['"main_heading"']) {
	$heading_google_font = str_replace("+", " ", $checkfonts['"main_heading"']);
	if (!empty($heading_google_font)) {
		$main_heading_count++;
		$main_heading_array['font-family'] = "'" . $heading_google_font . "'";
	}
}

if (isset($checkfontsweight['"main_heading"'])) {
	if (!empty($checkfontsweight['"main_heading"']) && 'default' != $checkfontsweight['"main_heading"']) {
		$heading_font_weight = explode(":", $checkfontsweight['"main_heading"']);
		if (!empty($heading_font_weight)) {
			$main_heading_count++;
			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i', $heading_font_weight[1]);
			foreach ($arr as $values) {
				if (is_numeric($values)) {
					$main_heading_array['font-weight'] = $values;
				} else {
					if ("regular" == strtolower($values)) {
						$main_heading_array['font-weight'] = 'normal';
					} else {
						$main_heading_array['font-style'] = $values;
					}
				}
			}
		}
	}
}

$heading_colour = get_theme_mod('main_heading_colour');
if (!empty($heading_colour)) {
	$main_heading_count++;
	$main_heading_array['color'] = $heading_colour;
}

$main_heading_font_size = get_theme_mod('main_heading_font_size');
if (!empty($main_heading_font_size)) {
	$main_heading_count++;
	$main_heading_array['font-size'] = $main_heading_font_size . "px";
}

$heading_capitalize = get_theme_mod('main_heading_font_capitalise', 'uppercase');
if (isset($heading_capitalize)) {
	if ('' == $heading_capitalize) {
		$main_heading_count++;
		$main_heading_array['text-transform'] = 'none !important';
	}
} else if (!isset($heading_capitalize)) {
	$main_heading_count++;
	$main_heading_array['text-transform'] = 'none !important';
}

if ($main_heading_count > 0) {
	$main_heading_style = 'h2{';
	foreach ($main_heading_array as $id => $value) {
		$main_heading_style .= $id . ': ' . $value . ';';
	}
	$main_heading_style .= '}';
}

/* heading h3 */
$heading_hthree_count = 0;
$heading_hthree_style = '';
$heading_hthree_array = array();
if (isset($checkfonts['"heading_hthree"']) && 'Montserrat' != $checkfonts['"heading_hthree"']) {
	$heading_hthree_google_font = str_replace("+", " ", $checkfonts['"heading_hthree"']);
	if (!empty($heading_hthree_google_font)) {
		$heading_hthree_count++;
		$heading_hthree_array['font-family'] = "'" . $heading_hthree_google_font . "'";
	}
}

if (isset($checkfontsweight['"heading_hthree"'])) {
	if (!empty($checkfontsweight['"heading_hthree"']) && 'default' != $checkfontsweight['"heading_hthree"']) {
		$heading_hthree_font_weight = explode(":", $checkfontsweight['"heading_hthree"']);
		if (!empty($heading_hthree_font_weight)) {
			$heading_hthree_count++;
			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i', $heading_hthree_font_weight[1]);
			foreach ($arr as $values) {
				if (is_numeric($values)) {
					$heading_hthree_array['font-weight'] = $values;
				} else {
					if ("regular" == strtolower($values)) {
						$heading_hthree_array['font-weight'] = 'normal';
					} else {
						$heading_hthree_array['font-style'] = $values;
					}
				}
			}
		}
	}
}

$heading_colour = get_theme_mod('heading_hthree_colour');
if (!empty($heading_colour)) {
	$heading_hthree_count++;
	$heading_hthree_array['color'] = $heading_colour;
}

$heading_hthree_font_size = get_theme_mod('heading_hthree_font_size');
if (!empty($heading_hthree_font_size)) {
	$heading_hthree_count++;
	$heading_hthree_array['font-size'] = $heading_hthree_font_size . "px";
}

if ($heading_hthree_count > 0) {
	$heading_hthree_style = 'h3{';
	foreach ($heading_hthree_array as $id => $value) {
		$heading_hthree_style .= $id . ': ' . $value . ';';
	}
	$heading_hthree_style .= '}';
}

/* heading h4 */
$heading_hfour_count = 0;
$heading_hfour_style = '';
$heading_hfour_array = array();
if (isset($checkfonts['"heading_hfour"']) && 'Montserrat' != $checkfonts['"heading_hfour"']) {
	$heading_google_font = str_replace("+", " ", $checkfonts['"heading_hfour"']);
	if (!empty($heading_google_font)) {
		$heading_hfour_count++;
		$heading_hfour_array['font-family'] = "'" . $heading_google_font . "'";
	}
}

if (isset($checkfontsweight['"heading_hfour"'])) {
	if (!empty($checkfontsweight['"heading_hfour"']) && 'default' != $checkfontsweight['"heading_hfour"']) {
		$heading_font_weight = explode(":", $checkfontsweight['"heading_hfour"']);
		if (!empty($heading_font_weight)) {
			$heading_hfour_count++;
			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i', $heading_font_weight[1]);
			foreach ($arr as $values) {
				if (is_numeric($values)) {
					$heading_hfour_array['font-weight'] = $values;
				} else {
					if ("regular" == strtolower($values)) {
						$heading_hfour_array['font-weight'] = 'normal';
					} else {
						$heading_hfour_array['font-style'] = $values;
					}
				}
			}
		}
	}
}

$heading_hfour_colour = get_theme_mod('heading_hfour_colour');
if (!empty($heading_hfour_colour)) {
	$heading_hfour_count++;
	$heading_hfour_array['color'] = $heading_hfour_colour;
}

$heading_hfour_font_size = get_theme_mod('heading_hfour_font_size');
if (!empty($heading_hfour_font_size)) {
	$heading_hfour_count++;
	$heading_hfour_array['font-size'] = $heading_hfour_font_size . "px";
}

if ($heading_hfour_count > 0) {
	$heading_hfour_style = 'h4{';
	foreach ($heading_hfour_array as $id => $value) {
		$heading_hfour_style .= $id . ': ' . $value . ';';
	}
	$heading_hfour_style .= '}';
}

/* heading h5 */
$heading_hfive_count = 0;
$heading_hfive_style = '';
$heading_hfive_array = array();
if (isset($checkfonts['"heading_hfive"']) && 'Montserrat' != $checkfonts['"heading_hfive"']) {
	$heading_google_font = str_replace("+", " ", $checkfonts['"heading_hfive"']);
	if (!empty($heading_google_font)) {
		$heading_hfive_count++;
		$heading_hfive_array['font-family'] = "'" . $heading_google_font . "'";
	}
}

if (isset($checkfontsweight['"heading_hfive"'])) {
	if (!empty($checkfontsweight['"heading_hfive"']) && 'default' != $checkfontsweight['"heading_hfive"']) {
		$heading_font_weight = explode(":", $checkfontsweight['"heading_hfive"']);
		if (!empty($heading_font_weight)) {
			$heading_hfive_count++;
			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i', $heading_font_weight[1]);
			foreach ($arr as $values) {
				if (is_numeric($values)) {
					$heading_hfive_array['font-weight'] = $values;
				} else {
					if ("regular" == strtolower($values)) {
						$heading_hfive_array['font-weight'] = 'normal';
					} else {
						$heading_hfive_array['font-style'] = $values;
					}
				}
			}
		}
	}
}

$heading_hfive_colour = get_theme_mod('heading_hfive_colour');
if (!empty($heading_hfive_colour)) {
	$heading_hfive_count++;
	$heading_hfive_array['color'] = $heading_hfive_colour;
}

$heading_hfive_font_size = get_theme_mod('heading_hfive_font_size');
if (!empty($heading_hfive_font_size)) {
	$heading_hfive_count++;
	$heading_hfive_array['font-size'] = $heading_hfive_font_size . "px";
}

if ($heading_hfive_count > 0) {
	$heading_hfive_style = 'h5{';
	foreach ($heading_hfive_array as $id => $value) {
		$heading_hfive_style .= $id . ': ' . $value . ';';
	}
	$heading_hfive_style .= '}';
}

/* heading h6 */
$heading_hsix_count = 0;
$heading_hsix_style = '';
$heading_hsix_array = array();
if (isset($checkfonts['"heading_hsix"']) && 'Montserrat' != $checkfonts['"heading_hsix"']) {
	$heading_google_font = str_replace("+", " ", $checkfonts['"heading_hsix"']);
	if (!empty($heading_google_font)) {
		$heading_hsix_count++;
		$heading_hsix_array['font-family'] = "'" . $heading_google_font . "'";
	}
}

if (isset($checkfontsweight['"heading_hsix"'])) {
	if (!empty($checkfontsweight['"heading_hsix"']) && 'default' != $checkfontsweight['"heading_hsix"']) {
		$heading_font_weight = explode(":", $checkfontsweight['"heading_hsix"']);
		if (!empty($heading_font_weight)) {
			$heading_hsix_count++;
			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i', $heading_font_weight[1]);
			foreach ($arr as $values) {
				if (is_numeric($values)) {
					$heading_hsix_array['font-weight'] = $values;
				} else {
					if ("regular" == strtolower($values)) {
						$heading_hsix_array['font-weight'] = 'normal';
					} else {
						$heading_hsix_array['font-style'] = $values;
					}
				}
			}
		}
	}
}

$heading_hsix_colour = get_theme_mod('heading_hsix_colour');
if (!empty($heading_hsix_colour)) {
	$heading_hsix_count++;
	$heading_hsix_array['color'] = $heading_hsix_colour;
}

$heading_hsix_font_size = get_theme_mod('heading_hsix_font_size');
if (!empty($heading_hsix_font_size)) {
	$heading_hsix_count++;
	$heading_hsix_array['font-size'] = $heading_hsix_font_size . "px";
}

if ($heading_hsix_count > 0) {
	$heading_hsix_style = 'h6{';
	foreach ($heading_hsix_array as $id => $value) {
		$heading_hsix_style .= $id . ': ' . $value . ';';
	}
	$heading_hsix_style .= '}';
}

/* Sub-title */
$subtitle_count = 0;
$subtitle_style = '';
$subtitle_array = array();
if (isset($checkfonts['"subtitle_font"']) && !empty($checkfonts['"subtitle_font"'])) {
	$subtitle_google_font = str_replace("+", " ", $checkfonts['"subtitle_font"']);
	if (!empty($subtitle_google_font)) {
		$subtitle_count++;
		$subtitle_array['font-family'] = "'" . $subtitle_google_font . "'";
	}
}

if (isset($checkfontsweight['"subtitle_font"'])) {
	if (!empty($checkfontsweight['"subtitle_font"']) && 'default' != $checkfontsweight['"subtitle_font"']) {
		$subtitle_font_weight = explode(":", $checkfontsweight['"subtitle_font"']);
		if (!empty($subtitle_font_weight)) {
			$subtitle_count++;
			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i', $subtitle_font_weight[1]);
			foreach ($arr as $values) {
				if (is_numeric($values)) {
					$subtitle_array['font-weight'] = $values;
				} else {
					if ("regular" == strtolower($values)) {
						$subtitle_array['font-weight'] = 'normal';
					} else {
						$subtitle_array['font-style'] = $values;
					}
				}
			}
		}
	}
}

if ($subtitle_count > 0) {
	$subtitle_style = '.main-subtitle p{ ';
	foreach ($subtitle_array as $id => $value) {
		$subtitle_style .= $id . ': ' . $value . ';';
	}
	$subtitle_style .= ' }';
}

/* links */
$links_style = '';
$links_colour = get_theme_mod('site_links_colour');
if (!empty($links_colour)) {
	$links_style .= 'a{';
	$links_style .= 'color: ' . $links_colour . ';';
}

$links_text_decor = get_theme_mod('site_links_text_decor');
if (!empty($links_text_decor)) {
	if (empty($links_style)) {
		$links_style .= 'a{';
	}
	$links_style .= 'text-decoration: ' . $links_text_decor . ';';
}
if (!empty($links_style)) {
	$links_style .= '}';
}

$links_hover_colour = get_theme_mod('site_links_hover_colour', '#b0a377');
if (!empty($links_hover_colour) && '#b0a377' != $links_hover_colour) {
	$links_style .= 'a:hover{';
	$links_style .= 'color: ' . $links_hover_colour . ';';
	$links_style .= '}';
}

/* Round Button */
$round_button_style = '';
$round_button_count = 0;
$round_button_array = array();
$rounded_button_colour = get_theme_mod('rounded_button_colour');
if (!empty($rounded_button_colour)) {
	$round_button_count++;
	$round_button_array['color'] = $rounded_button_colour;
}

$rounded_bckgrd_colour = get_theme_mod('rounded_button_bckgrd_colour', '#b0a377');
if (!empty($rounded_bckgrd_colour) && '#b0a377' != $rounded_bckgrd_colour) {
	$round_button_count++;
	$round_button_array['background-color'] = $rounded_bckgrd_colour;
}

$rounded_border = get_theme_mod('rounded_button_border', 'yes');
if (isset($rounded_border)) {
	if ('' == $rounded_border) {
		$round_button_count++;
		$round_button_array['border'] = 'none';
	} else {
		$rounded_border_colour = get_theme_mod('rounded_button_border_colour', '#b0a377');
		if (!empty($rounded_border_colour) && '#b0a377' != $rounded_border_colour) {
			$round_button_count++;
			$round_button_array['border-color'] = $rounded_border_colour;
		}
	}
} else if (!isset($rounded_border)) {
	$round_button_count++;
	$round_button_array['border'] = 'none';
}
if ($round_button_count > 0) {
	$round_button_style .= '.btn-info-sub.btn-md{';
	foreach ($round_button_array as $id => $value) {
		$round_button_style .= $id . ': ' . $value . ';';
	}
	$round_button_style .= '}';
}
$round_button_hover_array = array();
$round_button_hover_count = 0;
$rounded_hover_colour = get_theme_mod('rounded_button_hover_colour', '#b0a377');
if (!empty($rounded_hover_colour) && '#b0a377' != $rounded_hover_colour) {
	$round_button_hover_count++;
	$round_button_hover_array['background'] = $rounded_hover_colour;
}
$rounded_button_border_hover_colour = get_theme_mod('rounded_button_border_hover_colour', '#b0a377');
if (!empty($rounded_button_border_hover_colour) && '#b0a377' != $rounded_button_border_hover_colour) {
	$round_button_hover_count++;
	$round_button_hover_array['border-color'] = $rounded_button_border_hover_colour;
}
if ($round_button_hover_count > 0) {
	$round_button_style .= '.btn-info-sub.btn-md:hover{';
	foreach ($round_button_hover_array as $id => $value) {
		$round_button_style .= $id . ': ' . $value . ';';
	}
	$round_button_style .= '}';
}

/* Square Button */
$square_button_style = '';
$square_button_count = 0;
$square_button_array = array();
$square_button_colour = get_theme_mod('square_button_colour');
if (!empty($square_button_colour)) {
	$square_button_count++;
	$square_button_array['color'] = $square_button_colour;
}

$square_bckgrd_colour = get_theme_mod('square_button_bckgrd_colour', '#252525');
if (!empty($square_bckgrd_colour) && '#252525' != $square_bckgrd_colour) {
	$square_button_count++;
	$square_button_array['background-color'] = $square_bckgrd_colour;
}

$square_border = get_theme_mod('square_button_border', 'yes');
if (isset($square_border)) {
	if ('' == $square_border) {
		$square_button_count++;
		$square_button_array['border'] = 'none';
	} else {
		$square_border_colour = get_theme_mod('square_button_border_colour', '#252525');
		if (!empty($square_border_colour) && '#252525' != $square_border_colour) {
			$square_button_count++;
			$square_button_array['border-color'] = $square_border_colour;
		}
	}
} else if (!isset($square_border)) {
	$square_button_count++;
	$square_button_array['border'] = 'none';
}
if ($square_button_count > 0) {
	$square_button_style .= '.btn.btn-default{';
	foreach ($square_button_array as $id => $value) {
		$square_button_style .= $id . ': ' . $value . ';';
	}
	$square_button_style .= '}';
}
$square_hover_colour = get_theme_mod('square_button_hover_colour', '#b0a377');
if (!empty($square_hover_colour) && '#b0a377' != $square_hover_colour) {
	$square_button_style .= '.btn.btn-default:hover:before{';
	$square_button_style .= 'background: ' . $square_hover_colour . ';';
	$square_button_style .= '}';
}
$square_button_border_hover_colour = get_theme_mod('square_button_border_hover_colour', '#e2e2e2');
if (!empty($square_button_border_hover_colour) && '#e2e2e2' != $square_button_border_hover_colour) {
	$square_button_style .= '.btn.btn-default:hover{';
	$square_button_style .= 'border-color: ' . $square_button_border_hover_colour . ';';
	$square_button_style .= '}';
}

/* Large Button */
$large_button_count = 0;
$large_button_style = '';
$large_button_array = array();
$large_button_colour = get_theme_mod('large_button_colour');
if (!empty($large_button_colour)) {
	$large_button_count++;
	$large_button_array['color'] = $large_button_colour;
}

$large_button_bckgrd_colour = get_theme_mod('large_button_bckgrd_colour');
if (!empty($large_button_bckgrd_colour)) {
	$large_button_count++;
	$large_button_array['background-color'] = $large_button_bckgrd_colour;
}

$large_border = get_theme_mod('large_button_border', 'yes');
if (isset($large_border)) {
	if ('' == $large_border) {
		$large_button_count++;
		$large_button_array['border'] = 'none';
	} else {
		$large_border_colour = get_theme_mod('large_button_border_colour');
		if (!empty($large_border_colour)) {
			$large_button_count++;
			$large_button_array['border-color'] = $large_border_colour;
		}
	}
} else if (!isset($large_border)) {
	$large_button_count++;
	$large_button_array['border'] = 'none';
}
if ($large_button_count > 0) {
	$large_button_style .= '.btn.btn-primary{';
	foreach ($large_button_array as $id => $value) {
		$large_button_style .= $id . ': ' . $value . ';';
	}
	$large_button_style .= '}';
}
$large_button_hover_count = 0;
$large_button_hover_array = array();
$large_hover_colour = get_theme_mod('large_button_hover_colour');
if (!empty($large_hover_colour)) {
	$large_button_hover_count++;
	$large_button_hover_array['background'] = $large_hover_colour;
}
$large_button_border_hover_colour = get_theme_mod('large_button_border_hover_colour');
if (!empty($large_button_border_hover_colour)) {
	$large_button_hover_count++;
	$large_button_hover_array['border-color'] = $large_button_border_hover_colour;
}
if ($large_button_hover_count > 0) {
	$large_button_style .= '.btn.btn-primary:hover{';
	foreach ($large_button_hover_array as $id => $value) {
		$large_button_style .= $id . ': ' . $value . ';';
	}
	$large_button_style .= '}';
}

/* Nav Bar */
$nav_bar_count = 0;
$nav_bar_style = '';
$nav_bar_array = array();
if (isset($checkfonts['"nav_bar"']) && 'Montserrat' != $checkfonts['"nav_bar"']) {
	$nav_bar_google_font = str_replace("+", " ", $checkfonts['"nav_bar"']);
	if (!empty($nav_bar_google_font)) {
		$nav_bar_count++;
		$nav_bar_array['font-family'] = $nav_bar_google_font;
	}
}
if (isset($checkfontsweight['"nav_bar"'])) {
	if (!empty($checkfontsweight['"nav_bar"']) && 'default' != $checkfontsweight['"nav_bar"']) {
		$nav_bar_font_weight = explode(":", $checkfontsweight['"nav_bar"']);
		if (!empty($nav_bar_font_weight)) {
			$nav_bar_count++;
			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i', $nav_bar_font_weight[1]);
			foreach ($arr as $values) {
				if (is_numeric($values)) {
					$nav_bar_array['font-weight'] = $values;
				} else {
					if ("regular" == strtolower($values)) {
						$nav_bar_array['font-weight'] = 'normal';
					} else {
						$nav_bar_array['font-style'] = $values;
					}
				}
			}
		}
	}
}
$navbar_links_font_size = get_theme_mod('navbar_links_font_size');
if (!empty($navbar_links_font_size)) {
	$nav_bar_count++;
	$nav_bar_array['font-size'] = $navbar_links_font_size . 'px';
}
$navbar_links_letter_spacing = get_theme_mod('navbar_links_letter_spacing');
if (!empty($navbar_links_letter_spacing)) {
	$nav_bar_count++;
	$nav_bar_array['letter-spacing'] = $navbar_links_letter_spacing . 'em';
}
$navbar_links_uppercase = get_theme_mod('navbar_links_uppercase', 'uppercase');
if (isset($navbar_links_uppercase)) {
	if ('' == $navbar_links_uppercase) {
		$nav_bar_count++;
		$nav_bar_array['text-transform'] = 'none !important';
	}
}
/*$navbar_links_colour = get_theme_mod( 'navbar_links_colour' );
	if( !empty( $navbar_links_colour ) && '#ffffff' != $navbar_links_colour ) {
		$nav_bar_count++;
		$nav_bar_array['color'] = $navbar_links_colour;
	}*/
if ($nav_bar_count > 0) {
	$nav_bar_style .= '#header .navbar-default .navbar-nav > li.menu-item > a{';
	foreach ($nav_bar_array as $id => $value) {
		$nav_bar_style .= $id . ': ' . $value . ';';
	}
	$nav_bar_style .= '}';
}

$navbar_links_colour = get_theme_mod('navbar_links_colour');
if (!empty($navbar_links_colour) && '#ffffff' != $navbar_links_colour) {
	$nav_bar_style .= '#header .navbar-default .navbar-nav > li.menu-item > a, .default-page #header.default-white-header .navbar-default .navbar-nav > li.menu-item > a, #header.default-white-header .navbar-default .navbar-nav > li.menu-item > a, #header.fixed-position .navbar-default .navbar-nav > li.menu-item > a{';
	$nav_bar_style .= 'color: ' . $navbar_links_colour . ';';
	$nav_bar_style .= '}';
}

$navbar_links_bg_colour = get_theme_mod('navbar_links_bg_colour', '#5c5e62');
if (!empty($navbar_links_bg_colour) && '#5c5e62' != $navbar_links_bg_colour) {
	$nav_bar_style .= '#header.fixed-position .navbar-default .navbar-nav > li.menu-item > a, .default-page #header.white-header.fixed-position .navbar-default .navbar-nav > li.menu-item > a, #header.white-header.fixed-position .navbar-default .navbar-nav > li.menu-item > a, .default-page #header.default-white-header.fixed-position .navbar-default .navbar-nav > li.menu-item > a, #header.default-white-header.fixed-position .navbar-default .navbar-nav > li.menu-item > a{';
	$nav_bar_style .= 'color: ' . $navbar_links_bg_colour . ';';
	$nav_bar_style .= '}';
}

$navbar_links_hover_colour = get_theme_mod('navbar_links_hover_colour', '#b0a377');
if (!empty($navbar_links_hover_colour) && '#b0a377' != $navbar_links_hover_colour) {
	//$nav_bar_style .= '#header .navbar-default .navbar-nav > li.menu-item > a:hover, #header.fixed-position .navbar-default .navbar-nav > li.menu-item > a:hover{';
	$nav_bar_style .= '.default-page #header.white-header.fixed-position .navbar-default .navbar-nav > li > a:hover, #header.white-header.fixed-position .navbar-default .navbar-nav > li > a:hover, .default-page #header.default-white-header .navbar-default .navbar-nav > li > a:hover, #header.default-white-header .navbar-default .navbar-nav > li > a:hover, #header .navbar-default .navbar-nav > li.menu-item > a:hover, #header.fixed-position .navbar-default .navbar-nav > li.menu-item > a:hover{';
	$nav_bar_style .= 'color: ' . $navbar_links_hover_colour . ';';
	$nav_bar_style .= '}';
	/* Dropdown Hover */
	$nav_bar_style .= '.nav-tabs > li.active a, .nav-tabs > li > a:hover, .nav-tabs > li.active a:hover{';
	$nav_bar_style .= 'color: ' . $navbar_links_hover_colour . ';';
	$nav_bar_style .= '}';
}

/* top nav bar */
$top_style = '';
$top_count = 0;
$top_array = array();
$topbar_links_font_size = get_theme_mod('topbar_links_font_size');
if (!empty($topbar_links_font_size)) {
	$top_count++;
	$top_array['font-size'] = $topbar_links_font_size . 'px';
}

$topbar_links_colour = get_theme_mod('topbar_links_colour');
if (!empty($topbar_links_colour)) {
	$top_count++;
	$top_array['color'] = $topbar_links_colour;
}
if ($top_count > 0) {
	$top_style .= '.top-user-panel > li > a, .top-right-panel > li > a{';
	foreach ($top_array as $id => $value) {
		$top_style .= $id . ': ' . $value . ';';
	}
	$top_style .= '}';
}
$topbar_links_hover_colour = get_theme_mod('topbar_links_hover_colour');
if (!empty($topbar_links_hover_colour)) {
	$top_style .= '.top-user-panel > li > a:hover, .top-right-panel > li > a:hover{';
	$top_style .= 'color: ' . $topbar_links_hover_colour . ';';
	$top_style .= '}';
}

/* footer */
$footer_style = '';
$footer_background_option = get_theme_mod('footer_background_option', 'ft_bckpattern');
if (!empty($footer_background_option)) {
	$footer_style .= '#footer{';
	if ('ft_none' == $footer_background_option) {
		$footer_style .= 'display: ' . 'none' . ';';
	} else if ('ft_bckcolour' == $footer_background_option) {
		$footer_colour = get_theme_mod('footer_ft_bckcolour');
		$footer_style .= 'background: ' . $footer_colour . ';';
	} else if ('ft_bckimage' == $footer_background_option) {
		$footer_image = get_theme_mod('footer_ft_bckimage');
		if (empty($footer_image)) {
			$footer_image = get_template_directory_uri() . '/img/banner/img-15.jpg';
		}
		$footer_style .= "background: url('" . $footer_image . "');";
	} else if ('ft_bckpattern' == $footer_background_option) {
		$footer_pattern = get_theme_mod('footer_ft_bckpattern');
		if (empty($footer_pattern)) {
			$footer_pattern = get_template_directory_uri() . '/dist/images/footer/footer-pattern.png';
		}
		$footer_style .= "background: url('" . esc_url($footer_pattern) . "');";
	}
	$footer_style .= '}';
}

$partner_height = get_theme_mod('partner_height');
if (!empty($partner_height)) {
	$footer_style .= '.partner-list a img{';
	$footer_style .= 'max-height: ' . $partner_height . 'px';
	$footer_style .= '}';
}

/* ----------- Logo ----------- */
/* image logo */
$logo_count = 0;
$logo_style = '';
$entrada_header_height = '';
$entrada_right_nav_width = '';

$logo_text_image = get_theme_mod('logo_text_image');
if ('image' == $logo_text_image) {
	$header_logo_width = get_theme_mod('header_logo_width');
	if (!empty($header_logo_width)) {
		$entrada_right_nav_width = '@media only screen and (min-width: 992px) {.nav-right { max-width: calc(100% - ' . $header_logo_width . 'px); } .logo img{ width:' . $header_logo_width . 'px; } }';
	}

	$header_logo_padding = get_theme_mod('header_logo_padding');
	$header_logo_height = get_theme_mod('header_logo_height');
	if (!empty($header_logo_height)) {

		$entrada_logo_img_max_height = $header_logo_height;
		if (!empty($header_logo_padding)) {
			$entrada_logo_img_max_height = $header_logo_height - (2 * $header_logo_padding);
		}

		$entrada_header_height = '@media only screen and (min-width: 992px) { ';

		$entrada_header_height .= ' #header { height: ' . $header_logo_height . 'px; } ';
		$entrada_header_height .= '.logo{ height:' . $header_logo_height . 'px; ';

		if (!empty($header_logo_padding)) {
			$entrada_header_height .= 'padding:' . $header_logo_padding . 'px 0; ';
		}

		$entrada_header_height .= '}';
		$entrada_header_height .= '.navbar-default .navbar-nav > li { height: ' . $header_logo_height . 'px; }';
		$entrada_header_height .= '.logo img { max-height:' . $entrada_logo_img_max_height . 'px; }';

		$entrada_header_height .= ' } ';
	}

	if ($logo_count > 0) {
		$logo_style = '.logo{';
		foreach ($logo as $id => $value) {
			$logo_style .= $id . ': ' . $value . ';';
		}
		$logo_style .= '}';
	}
}
/* text logo */
$text_count = 0;
$text_style = '';
$text_array = array();
if (isset($checkfonts['"logo_font"']) && 'Roboto' != $checkfonts['"logo_font"']) {
	$logo_font_setting = str_replace("+", " ", $checkfonts['"logo_font"']);
	if (!empty($logo_font_setting)) {
		$text_count++;
		$text_array['font-family'] = "'" . $logo_font_setting . "'";
	}
}

if (isset($checkfontsweight['"logo_font"'])) {
	if (!empty($checkfontsweight['"logo_font"']) && 'default' != $checkfontsweight['"logo_font"']) {
		$logo_font_weight = explode(":", $checkfontsweight['"logo_font"']);
		if (!empty($logo_font_weight)) {
			$arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i', $logo_font_weight[1]);
			foreach ($arr as $values) {
				$text_count++;
				if (is_numeric($values)) {
					$text_array['font-weight'] = $values;
				} else {
					if ("regular" == strtolower($values)) {
						$text_array['font-weight'] = "normal";
					} else {
						$text_array['font-style'] = $values;
					}
				}
			}
		}
	}
}

$logo_font_size = get_theme_mod('logo_font_size');
if (!empty($logo_font_size)) {
	$text_count++;
	$text_array['font-size'] = $logo_font_size . "px";
}

$logo_font_colour = get_theme_mod('logo_font_colour');
if (!empty($logo_font_colour)) {
	$text_count++;
	$text_array['color'] = $logo_font_colour;
}

$logo_font_style = get_theme_mod('logo_font_style');
if (!empty($logo_font_style)) {
	$text_count++;
	$text_array['font-style'] = $logo_font_style;
}

if ($text_count > 0) {
	$text_style = 'span.header_logo_text{';
	foreach ($text_array as $id => $value) {
		$text_style .= $id . ': ' . $value . ';';
	}
	$text_style .= '}';
}

$logo_whitebg_font_colour = get_theme_mod('logo_whitebg_font_colour');
if (!empty($logo_whitebg_font_colour)) {
	$text_style .= '.white-header.fixed-position span.header_logo_text{';
	$text_style .= 'color: ' . $logo_whitebg_font_colour . ';';
	$text_style .= '}';
}

?>

<style type='text/css' id="customizer-styles">
	<?php
	if (!empty($body_style)) {
		echo sprintf(__('%s', 'entrada'), $body_style);
	}
	if (!empty($heading_hone_style)) {
		echo sprintf(__('%s', 'entrada'), $heading_hone_style);
	}
	if (!empty($main_heading_style)) {
		echo sprintf(__('%s', 'entrada'), $main_heading_style);
	}
	if (!empty($heading_hthree_style)) {
		echo sprintf(__('%s', 'entrada'), $heading_hthree_style);
	}
	if (!empty($heading_hfour_style)) {
		echo sprintf(__('%s', 'entrada'), $heading_hfour_style);
	}
	if (!empty($heading_hfive_style)) {
		echo sprintf(__('%s', 'entrada'), $heading_hfive_style);
	}
	if (!empty($heading_hsix_style)) {
		echo sprintf(__('%s', 'entrada'), $heading_hsix_style);
	}
	if (!empty($subtitle_style)) {
		echo sprintf(__('%s', 'entrada'), $subtitle_style);
	}
	if (!empty($layout_style)) {
		echo sprintf(__('%s', 'entrada'), $layout_style);
	}
	if (!empty($preloader_style)) {
		echo sprintf(__('%s', 'entrada'), $preloader_style);
	}
	if (!empty($entrada_header_height)) {
		echo sprintf(__('%s', 'entrada'), $entrada_header_height);
	}
	if (!empty($entrada_right_nav_width)) {
		echo sprintf(__('%s', 'entrada'), $entrada_right_nav_width);
	}
	if (!empty($logo_style)) {
		echo sprintf(__('%s', 'entrada'), $logo_style);
	}
	if (!empty($search_style)) {
		echo sprintf(__('%s', 'entrada'), $search_style);
	}
	if (!empty($icon_style)) {
		echo sprintf(__('%s', 'entrada'), $icon_style);
	}
	if (!empty($gal_style)) {
		echo sprintf(__('%s', 'entrada'), $gal_style);
	}
	if (!empty($call_style)) {
		echo sprintf(__('%s', 'entrada'), $call_style);
	}
	if (!empty($product_style)) {
		echo sprintf(__('%s', 'entrada'), $product_style);
	}
	if (!empty($blog_style)) {
		echo sprintf(__('%s', 'entrada'), $blog_style);
	}
	if (!empty($counter_style)) {
		echo sprintf(__('%s', 'entrada'), $counter_style);
	}
	if (!empty($browse_style)) {
		echo sprintf(__('%s', 'entrada'), $browse_style);
	}
	if (!empty($guide_style)) {
		echo sprintf(__('%s', 'entrada'), $guide_style);
	}
	if (!empty($partner_style)) {
		echo sprintf(__('%s', 'entrada'), $partner_style);
	}
	if (!empty($foot_style)) {
		echo sprintf(__('%s', 'entrada'), $foot_style);
	}
	if (!empty($filter_style)) {
		echo sprintf(__('%s', 'entrada'), $filter_style);
	}
	if (!empty($map_style)) {
		echo sprintf(__('%s', 'entrada'), $map_style);
	}
	if (!empty($links_style)) {
		echo sprintf(__('%s', 'entrada'), $links_style);
	}
	if (!empty($round_button_style)) {
		echo sprintf(__('%s', 'entrada'), $round_button_style);
	}
	if (!empty($square_button_style)) {
		echo sprintf(__('%s', 'entrada'), $square_button_style);
	}
	if (!empty($large_button_style)) {
		echo sprintf(__('%s', 'entrada'), $large_button_style);
	}
	if (!empty($nav_bar_style)) {
		echo sprintf(__('%s', 'entrada'), $nav_bar_style);
	}
	if (!empty($top_style)) {
		echo sprintf(__('%s', 'entrada'), $top_style);
	}
	if (!empty($footer_style)) {
		echo sprintf(__('%s', 'entrada'), $footer_style);
	}
	if (!empty($text_style)) {
		echo sprintf(__('%s', 'entrada'), $text_style);
	}
	?>
</style>

<?php $custom_js = get_theme_mod('custom_js');
if (!empty($custom_js)) { ?>
	<script type="text/javascript" id="custom-js">
		/* custom JS */
		jQuery(document).ready(function($) {
			<?php echo json_encode($custom_js); ?>
		});
	</script>
<?php
}

$custom_google_analytics = get_theme_mod('custom_google_analytics');
if (!empty($custom_google_analytics)) { ?>
	<script type="text/javascript" id="custom_google_analytics">
		/* Google Analytics Code */
		<?php echo json_encode($custom_google_analytics); ?>
	</script>
<?php
}

$custom_css = get_theme_mod('custom_css');
if (!empty($custom_css)) { ?>
	<style type="text/css" id="custom-css">
		/* custom CSS */
		<?php echo esc_html($custom_css); ?>
	</style>
<?php
}
