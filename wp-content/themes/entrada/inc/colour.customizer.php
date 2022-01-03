<?php
// Entrada Setting theme color..
//@ Entrada Theme

$entrada_neutral_colour = get_theme_mod('entrada_neutral_colour', '#252525');
$entrada_primary_colour = get_theme_mod('entrada_primary_colour', '#b0a377');
$entrada_secondary_colour = get_theme_mod('entrada_secondary_colour', '#474d4b');
$entrada_tertiary_colour = get_theme_mod('entrada_tertiary_colour', '#fafafa');
$entrada_quaternary_colour = get_theme_mod('entrada_quaternary_colour', '#e2e2e2');
$entrada_faternary_colour = get_theme_mod('entrada_faternary_colour', '#b0a377');

/* rgba convertion */
list($primary_r, $primary_g, $primary_b) = sscanf($entrada_primary_colour, "#%02x%02x%02x");
list($secondary_r, $secondary_g, $secondary_b) = sscanf($entrada_secondary_colour, "#%02x%02x%02x");
list($neutral_r, $neutral_g, $neutral_b) = sscanf($entrada_neutral_colour, "#%02x%02x%02x");

?>
<style title="Customizer color layout">
	a:hover {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.sidebar .panel-heading a {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.side-list.hovered-list a:hover {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.side-list li.active a {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.services-block.has-bg .ico-article:hover .content-title,
	.services-block.has-bg .ico-article:hover a {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.services-block.has-bg .ico-article:hover .ico-holder {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.dropdown-menu a:hover {
		color: <?php echo sanitize_hex_color($entrada_faternary_colour);
				?>;
	}

	.feature-block li a:hover {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.content-block.guide-add .social-networks a:hover {
		background: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
	}

	.btn.btn-primary:hover {
		border-color: <?php echo sanitize_hex_color($entrada_tertiary_colour);
						?>;
		background: <?php echo sanitize_hex_color($entrada_tertiary_colour);
					?>;
	}

	.btn.btn-default {
		border-color: <?php echo sanitize_hex_color($entrada_quaternary_colour);
						?>;
		background: <?php echo sanitize_hex_color($entrada_neutral_colour);
					?>;
	}

	.btn.btn-default:before {
		background: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
	}

	.btn.btn-default:hover {
		border-color: <?php echo sanitize_hex_color($entrada_primary_colour);
						?>;
	}

	.btn.btn-info-sub {
		background: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
		border-color: <?php echo sanitize_hex_color($entrada_primary_colour);
						?>;
	}

	.btn.btn-info-sub:hover {
		background: <?php echo sanitize_hex_color($entrada_secondary_colour);
					?>;
		border-color: <?php echo sanitize_hex_color($entrada_secondary_colour);
						?>;
	}

	.btn.btn-info {
		background: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
		border-color: <?php echo sanitize_hex_color($entrada_primary_colour);
						?>;
	}

	.btn.btn-info:hover {
		background: <?php echo sanitize_hex_color($entrada_secondary_colour);
					?>;
		border-color: <?php echo sanitize_hex_color($entrada_secondary_colour);
						?>;
	}

	.btn.btn-white:hover {
		background: #fff;
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.btn-banner {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
		border: 1px solid <?php echo sanitize_hex_color($entrada_primary_colour);
							?>;
	}

	.btn-banner:hover {
		background: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
	}

	.woocommerce input.button {
		background-color: <?php echo sanitize_hex_color($entrada_primary_colour);
							?>;
	}

	.woocommerce input.button:hover {
		background-color: <?php echo sanitize_hex_color($entrada_secondary_colour);
							?>;
	}

	.filter-option .link.active,
	.filter-option .link:hover {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.pagination-wrap .btn-next a:hover,
	.pagination-wrap .btn-prev a:hover {
		background: none;
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.pagination-wrap.pagination-solid {
		background: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
	}

	.pagination-wrap li a:hover {
		background: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
	}

	.pagination-wrap li.active a {
		background: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
	}

	.pagination-wrap li.active a:hover {
		background: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
	}

	.count-block .block-1 {
		background: <?php echo sanitize_hex_color($entrada_tertiary_colour);
					?>;
	}

	.count-block .block-2 {
		background: <?php echo sanitize_hex_color($entrada_quaternary_colour);
					?>;
	}

	.count-block .block-3 {
		background: <?php echo sanitize_hex_color($entrada_secondary_colour);
					?>;
	}

	.count-block .block-4 {
		background: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
	}

	.article.has-hover-s2:hover h3 a {
		color: <?php echo sanitize_hex_color($entrada_secondary_colour);
				?>;
	}

	.article.has-hover-s3:hover h3 a {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.article .hover-article a:hover {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.article .ico-action a:hover {
		color: <?php echo sanitize_hex_color($entrada_secondary_colour);
				?>;
	}

	.article h3 a:hover {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.article .img-wrap .social-networks a {
		background: <?php echo sanitize_hex_color($entrada_secondary_colour);
					?>;
	}

	.article .thumbnail:hover h3 a {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.article .thumbnail:hover footer .price span {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.article.blog-article:hover .heading {
		color: <?php echo sanitize_hex_color($entrada_secondary_colour);
				?>;
	}

	.article.blog-article:hover .heading h3 a {
		color: <?php echo sanitize_hex_color($entrada_secondary_colour);
				?>;
	}

	.article.blog-article:hover .link-view a {
		color: <?php echo sanitize_hex_color($entrada_secondary_colour);
				?>;
	}

	.article.blog-article:hover .star-rating a,
	.article.blog-article:hover .star-rating span {
		color: <?php echo sanitize_hex_color($entrada_secondary_colour);
				?>;
	}

	.article.blog-article .footer-sub a:hover {
		color: <?php echo sanitize_hex_color($entrada_secondary_colour);
				?>;
	}

	.blog-single .meta-article a:hover {
		color: <?php echo sanitize_hex_color($entrada_secondary_colour);
				?>;
	}

	.meta-article .ico-action a:hover {
		color: <?php echo sanitize_hex_color($entrada_secondary_colour);
				?>;
	}

	.img-article .holder:hover .caption,
	.img-article .holder:hover .text-block {
		background: <?php echo sanitize_hex_color($entrada_secondary_colour);
					?>;
	}

	.list-view .article .thumbnail:hover h3 a {
		color: <?php echo sanitize_hex_color($entrada_secondary_colour);
				?>;
	}

	.list-view .article .thumbnail:hover .price span {
		color: <?php echo sanitize_hex_color($entrada_secondary_colour);
				?>;
	}

	.list-view .article .thumbnail:hover .activity-level .ico {
		color: <?php echo sanitize_hex_color($entrada_secondary_colour);
				?>;
	}

	.list-view .article .thumbnail:hover .star-rating {
		color: <?php echo sanitize_hex_color($entrada_secondary_colour);
				?>;
	}

	.list-view .article .ico-action a:hover {
		color: <?php echo sanitize_hex_color($entrada_secondary_colour);
				?>;
	}

	.recent-block .thumbnail:hover .sub-info span:last-child {
		color: <?php echo sanitize_hex_color($entrada_secondary_colour);
				?>;
	}

	.recent-block .article .popup {
		background: <?php echo sanitize_hex_color($entrada_secondary_colour);
					?>;
	}

	.recent-block .article .popup:before {
		border-top-color: <?php echo sanitize_hex_color($entrada_secondary_colour);
							?>;
	}

	.datepicker table tr td.day:hover,
	.datepicker table tr td span:hover,
	.datepicker table tr td.day.focused {
		background: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
	}

	.datepicker .datepicker-switch:hover,
	.datepicker .prev:hover,
	.datepicker .next:hover,
	.datepicker tfoot tr th:hover {
		background: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
	}

	.datepicker table tr td.day.focused,
	.datepicker table tr td span.focused {
		color: <?php echo sanitize_hex_color($entrada_neutral_colour);
				?>;
	}

	.datepicker table tr td.active:hover,
	.datepicker table tr td.active:hover:hover,
	.datepicker table tr td.active.disabled:hover,
	.datepicker table tr td.active.disabled:hover:hover,
	.datepicker table tr td.active:active,
	.datepicker table tr td.active:hover:active,
	.datepicker table tr td.active.disabled:active,
	.datepicker table tr td.active.disabled:hover:active,
	.datepicker table tr td.active.active,
	.datepicker table tr td.active:hover.active,
	.datepicker table tr td.active.disabled.active,
	.datepicker table tr td.active.disabled:hover.active,
	.datepicker table tr td.active.disabled,
	.datepicker table tr td.active:hover.disabled,
	.datepicker table tr td.active.disabled.disabled,
	.datepicker table tr td.active.disabled:hover.disabled,
	.datepicker table tr td.active[disabled],
	.datepicker table tr td.active:hover[disabled],
	.datepicker table tr td.active.disabled[disabled],
	.datepicker table tr td.active.disabled:hover[disabled],
	.datepicker table tr td span.active:hover,
	.datepicker table tr td span.active:hover:hover,
	.datepicker table tr td span.active.disabled:hover,
	.datepicker table tr td span.active.disabled:hover:hover,
	.datepicker table tr td span.active:active,
	.datepicker table tr td span.active:hover:active,
	.datepicker table tr td span.active.disabled:active,
	.datepicker table tr td span.active.disabled:hover:active,
	.datepicker table tr td span.active.active,
	.datepicker table tr td span.active:hover.active,
	.datepicker table tr td span.active.disabled.active,
	.datepicker table tr td span.active.disabled:hover.active,
	.datepicker table tr td span.active.disabled,
	.datepicker table tr td span.active:hover.disabled,
	.datepicker table tr td span.active.disabled.disabled,
	.datepicker table tr td span.active.disabled:hover.disabled,
	.datepicker table tr td span.active[disabled],
	.datepicker table tr td span.active:hover[disabled],
	.datepicker table tr td span.active.disabled[disabled],
	.datepicker table tr td span.active.disabled:hover[disabled] {
		background: <?php echo sanitize_hex_color($entrada_secondary_colour);
					?>;
	}

	.datepicker table tr td.today,
	.datepicker table tr td.today.disabled,
	.datepicker table tr td.today.disabled:hover {
		background: <?php echo sanitize_hex_color($entrada_secondary_colour);
					?>;
	}

	.jcf-select-drop.jcf-select-trip-select-v2 .jcf-hover {
		background: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
	}

	.image-slide .controls a {
		background: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
	}

	.image-slide .controls a:hover {
		background: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
	}

	.popup {
		background: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
	}

	.popup:before {
		border-bottom: 7px solid <?php echo sanitize_hex_color($entrada_primary_colour);
									?>;
	}

	.pop-opener:hover [class^='icon-'],
	.pop-opener:hover [class*=' icon-'] {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.article .pop-opener:hover [class^='icon-'],
	.article .pop-opener:hover [class*=' icon-'] {
		color: <?php echo sanitize_hex_color($entrada_secondary_colour);
				?>;
	}

	.article .popup {
		background: <?php echo sanitize_hex_color($entrada_secondary_colour);
					?>;
	}

	.article .popup:before {
		border-bottom-color: <?php echo sanitize_hex_color($entrada_secondary_colour);
								?>;
	}

	.comment-slot .name a:hover {
		color: <?php echo sanitize_hex_color($entrada_secondary_colour);
				?>;
	}

	.comments .comment-slot .text:hover a {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.comments .comment-slot .text:hover .star-rating {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.comments .link-more a:hover {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.featured-content.feature-small {
		background: <?php echo sanitize_hex_color($entrada_secondary_colour);
					?>;
	}

	.progress .progress-bar {
		background: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
	}

	.progress .value {
		background: <?php echo sanitize_hex_color($entrada_secondary_colour);
					?>;
	}

	.progress .value:before {
		border-color: <?php echo sanitize_hex_color($entrada_secondary_colour);
						?>transparent transparent;
	}

	.block-quotation {
		background: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
	}

	.partner-block a:before {
		background: <?php echo sanitize_hex_color($entrada_secondary_colour);
					?>;
	}

	.content-intro .map-col .holder {
		background: <?php echo sanitize_hex_color($entrada_secondary_colour);
					?>;
	}

	.trip-info .reviews-info .star-rating {
		color: <?php echo sanitize_hex_color($entrada_secondary_colour);
				?>;
	}

	#tour-slide .owl-prev:hover,
	#tour-slide .owl-next:hover {
		background: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
	}

	.demo-wrapper .owl-theme .owl-controls .owl-buttons .owl-next,
	.demo-wrapper .owl-theme .owl-controls .owl-buttons .owl-prev {
		background: <?php echo sanitize_hex_color($entrada_neutral_colour);
					?>;
	}

	.demo-wrapper .owl-theme .owl-controls .owl-buttons .owl-next:hover,
	.demo-wrapper .owl-theme .owl-controls .owl-buttons .owl-prev:hover {
		background: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
	}

	.trip-detail .nav-wrap {
		background: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
	}

	.top-user-panel>li>a:hover,
	.top-right-panel>li>a:hover,
	.top-right-panel>li>a:hover {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.header-box:hover {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.header-box a:hover {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.nav-tabs>li.active a,
	.nav-tabs>li:focus a {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.nav-tabs>li.active a:hover,
	.nav-tabs>li.active a.active,
	.nav-tabs>li.active a:focus,
	.nav-tabs>li:focus a:hover,
	.nav-tabs>li:focus a.active,
	.nav-tabs>li:focus a:focus {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.nav-tabs>li>a:hover {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.carousel .carousel-control:hover {
		background: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
	}

	.reviews-slot .name a:hover {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.trip-form {
		box-shadow: none;
		background: rgba(<?php echo sanitize_hex_color($neutral_r . ',' . $neutral_g . ',' . $neutral_b);
							?>, .80);
		border: 10px solid rgba(<?php echo sanitize_hex_color($neutral_r . ',' . $neutral_g . ',' . $neutral_b);
								?>, .95);
	}

	.jcf-select.jcf-select-filter-select {
		background: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
	}

	.jcf-select.jcf-select-sort-select {
		background: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
	}

	.jcf-select-trip .jcf-select-drop-content {
		background: rgba(<?php echo sanitize_hex_color($primary_r . ',' . $primary_g . ',' . $primary_b);
							?>, .61);
	}

	.jcf-select-trip .jcf-list {
		background: rgba(<?php echo sanitize_hex_color($primary_r . ',' . $primary_g . ',' . $primary_b);
							?>, .61);
	}

	.jcf-select-trip .jcf-hover {
		background: rgba(50, 157, 136, .61);
	}

	.comment-form .form-rate .star-rating>span:hover {
		color: <?php echo sanitize_hex_color($entrada_secondary_colour);
				?>;
	}

	.contact-info .tel.bg-blue {
		background: <?php echo sanitize_hex_color($entrada_secondary_colour);
					?>;
	}

	.contact-form [type='submit'].btn {
		border-color: <?php echo sanitize_hex_color($entrada_primary_colour);
						?>;
	}

	.contact-form [type='submit'].btn:hover {
		background: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
	}

	.contact-confirmation {
		color: <?php echo sanitize_hex_color($entrada_secondary_colour);
				?>;
	}

	.error {
		color: <?php echo sanitize_hex_color($entrada_secondary_colour);
				?>;
	}

	.special-block {
		background: <?php echo sanitize_hex_color($entrada_secondary_colour);
					?>;
	}

	.browse-block .column.browse-destination a {
		background: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
	}

	.browse-block .column.browse-adventures a {
		background: <?php echo sanitize_hex_color($entrada_secondary_colour);
					?>;
	}

	.cart-holder .delete:hover {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.footer-nav a:hover {
		color: <?php echo sanitize_hex_color($entrada_quaternary_colour);
				?>;
	}

	.social-wrap li a:hover {
		color: <?php echo sanitize_hex_color($entrada_primary_colour);
				?>;
	}

	.footer-bottom a:hover {
		color: <?php echo sanitize_hex_color($entrada_quaternary_colour);
				?>;
	}

	.cart-list .name a:hover {
		color: <?php echo sanitize_hex_color($entrada_faternary_colour);
				?>;
	}

	.cart-list li:hover a {
		color: <?php echo sanitize_hex_color($entrada_faternary_colour);
				?>;
	}

	.cart-list li:hover .name a {
		color: <?php echo sanitize_hex_color($entrada_faternary_colour);
				?>;
	}

	#scroll-to-top {
		background: <?php echo sanitize_hex_color($entrada_faternary_colour);
					?>;
	}

	/* From Woocommerce */

	.product-detail-container .nav-v li a {
		border: 2px solid <?php echo sanitize_hex_color($entrada_neutral_colour);
							?>;
	}

	.product-detail-container .nav-v li.active a,
	.product-detail-container .nav-v li:focus a {
		border: 2px solid <?php echo sanitize_hex_color($entrada_primary_colour);
							?>;
	}

	.woocommerce a.button,
	.woocommerce input.button,
	.woocommerce button.button {
		background-color: <?php echo sanitize_hex_color($entrada_primary_colour), '!important';
							?>;
	}

	.woocommerce a.button:hover,
	.woocommerce input.button:hover,
	.woocommerce button.button:hover {
		background: <?php echo sanitize_hex_color($entrada_secondary_colour), '!important';
					?>;
	}

	.woocommerce .woocommerce-info {
		border-top: 3px solid <?php echo sanitize_hex_color($entrada_primary_colour);
								?>;
	}

	.woocommerce-MyAccount-navigation-link.is-active a {
		color: <?php echo sanitize_hex_color($entrada_secondary_colour);
				?>;
	}

	/* Media Query Colors Customization */

	@media only screen and (min-width: 992px) {

		.default-page #header.white-header.fixed-position .navbar-default .navbar-nav>li>a:hover,
		#header.white-header.fixed-position .navbar-default .navbar-nav>li>a:hover {
			color: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
		}

		.default-page #header.white-header.fixed-position .navbar-default .navbar-nav>li.hover>a,
		#header.white-header.fixed-position .navbar-default .navbar-nav>li.hover>a {
			color: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
		}

		.default-page #header.default-white-header .navbar-default .navbar-nav>li>a:hover,
		#header.default-white-header .navbar-default .navbar-nav>li>a:hover {
			color: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
		}

		.default-page #header.default-white-header .navbar-default .navbar-nav>li.hover>a,
		#header.default-white-header .navbar-default .navbar-nav>li.hover>a {
			color: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
		}

		.dropdown-menu .drop-holder .col:hover .title,
		.dropdown-menu .drop-holder .col:hover .title a {
			color: <?php echo sanitize_hex_color($entrada_faternary_colour);
					?>;
		}

	}

	@media only screen and (min-width: 1025px) {

		#header.fixed-position .navbar-default .navbar-nav>li>a:hover {
			color: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
		}

		#header.fixed-position .navbar-default .navbar-nav>li>a:active {
			color: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
		}

		#header.fixed-position .search-form .search-opener:hover {
			color: <?php echo sanitize_hex_color($entrada_primary_colour);
					?>;
		}

	}
</style>