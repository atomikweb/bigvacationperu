<?php
//$wpdb->query("SET SESSION sql_mode = 'TRADITIONAL'");
/**
 * Entrada functions and definitions.
 *
 *
 * @package Entrada
 */


if (!function_exists('entrada_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function entrada_setup()
	{
		/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Entrada, use a find and replace
	 * to change 'entrada' to the name of your theme in all the template files.
	 */
		load_theme_textdomain('entrada', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
		add_theme_support('title-tag');

		add_theme_support('woocommerce');

		/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			'primary' => esc_html__('Primary Menu', 'entrada'),
		));

		/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
		add_theme_support('post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		));

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('entrada_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));
	}
endif; // entrada_setup
add_action('after_setup_theme', 'entrada_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function entrada_content_width()
{
	$GLOBALS['content_width'] = apply_filters('entrada_content_width', 640);
}
add_action('after_setup_theme', 'entrada_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
if (!function_exists('entrada_widgets_init')) {
	function entrada_widgets_init()
	{
		$footer_widget_column = get_theme_mod("footer_widget_column");
		$footer_widget_column = ($footer_widget_column ? $footer_widget_column : 3);
		$footer_widget_column_class = 'col-lg-' . $footer_widget_column;
		register_sidebar(array(
			'name'          => esc_html__('Sidebar', 'entrada'),
			'id'            => 'sidebar-1',
			'class'			=> 'sidebar1_class',
			'description'   => 'An optional custom widget area for sidebar.',
			'before_widget' => '<div class="accordion-group default-widget">',
			'after_widget'  => '</div></div></div>',
			'before_title'  => '<div class="panel-heading"><h4 class="panel-title default-title">',
			'after_title'   => '</h4></div><div class="panel-collapse collapse in default-widget-panel" role="tabpanel"><div class="panel-body">',
		));

		register_sidebar(array(
			'name' 			=> esc_html__('Footer', 'entrada'),
			'id' 			=> 'footer_widget',
			'class' 		=> 'footer1_class',
			'description'   => 'An optional custom widget area for footer.',
			'before_widget' => '<nav class="col-md-6 ' . $footer_widget_column_class . ' footer-nav">',
			'after_widget' 	=> '</nav>',
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3>',
		));

		register_sidebar(array(
			'name' 			=> esc_html__('Listing Sidebar', 'entrada'),
			'id' 			=> 'listingsidebar_widget',
			'description'   => 'An optional custom widget area for listing template sidebar.',
			'before_widget' => '<div class="accordion-group default-widget">',
			'after_widget'  => '</div></div></div>',
			'before_title'  => '<div class="panel-heading"><h4 class="panel-title default-title">',
			'after_title'   => '</h4></div><div class="panel-collapse collapse in default-widget-panel" role="tabpanel"><div class="panel-body">',
		));
	}
}
add_action('widgets_init', 'entrada_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function entrada_scripts()
{
	global $entrada_locale;
	$demo_import_css = get_theme_mod('demo_import_css');
	wp_enqueue_style('entrada-font-awesome',  get_template_directory_uri() . '/dist/styles/lib/font-awesome.css');
	wp_enqueue_style('entrada-materials',  get_template_directory_uri() . '/vendors/material-design-icons/material-icons.css');
	wp_enqueue_style('entrada-icomoon',  get_template_directory_uri() . '/dist/styles/lib/icomoon.css');

	if ('' != get_theme_mod('entrada_font_icons_path')) {
		wp_enqueue_style('entrada-custom-icomoon',  get_theme_root_uri() . '/' . get_theme_mod('entrada_font_icons_path'));
	}

	wp_enqueue_style('entrada-animate',  get_template_directory_uri() . '/dist/styles/lib/animate.css');
	wp_enqueue_style('entrada-bootstrap',  get_template_directory_uri() . '/dist/styles/bootstrap.css');
	wp_enqueue_style('entrada-owl-carousel',  get_template_directory_uri() . '/dist/styles/lib/owl.carousel.css');
	wp_enqueue_style('entrada-owl-theme',  get_template_directory_uri() . '/dist/styles/lib/owl.theme.css');
	wp_enqueue_style('entrada-jquery',  get_template_directory_uri() . '/vendors/jquery-ui/jquery-ui.min.css');
	wp_enqueue_style('entrada-jquery-fancybox',  get_template_directory_uri() . '/vendors/fancybox/jquery.fancybox.css');
	wp_enqueue_style('entrada-datepicker',  get_template_directory_uri() . '/vendors/bootstrap-datetimepicker-master/dist/css/bootstrap-datepicker.css');
	wp_enqueue_style('entrada-datepicker-standalone',  get_template_directory_uri() . '/vendors/bootstrap-datetimepicker-master/dist/css/bootstrap-datepicker.standalone.css');
	wp_enqueue_style('entrada-rateyo',  get_template_directory_uri() . '/vendors/rateYo/min/jquery.rateyo.min.css');
	wp_enqueue_style('entrada-style', get_stylesheet_uri());
	wp_enqueue_style('entrada-styles',  get_template_directory_uri() . '/admin/vc/vc_overwrite.css');

	if (class_exists("WC_Vendors") && (is_page('vendor_dashboard') || is_page('shop_settings') || is_page('product_orders'))) {
		wp_enqueue_style('wc-vendor-styles',  get_template_directory_uri() . '/wc-vendors/wc-vendor.css');
	}

	if (isset($demo_import_css) && $demo_import_css != '') {
		wp_enqueue_style('entrada-theme-demo-style',  $demo_import_css);
	}

	wp_enqueue_style('entrada-google-fonts', entrada_google_fonts_url(), array(), null);

	wp_enqueue_script('entrada-bootstrap-js', get_template_directory_uri() . '/vendors/bootstrap/javascripts/bootstrap.min.js', array(), NULL, true);
	wp_enqueue_script('entrada-placeholder-js', get_template_directory_uri() . '/vendors/jquery-placeholder/jquery.placeholder.min.js', array(), NULL, true);
	wp_enqueue_script('entrada-matchheight-js', get_template_directory_uri() . '/vendors/match-height/jquery.matchHeight-min.js', array(), NULL, true);
	wp_enqueue_script('entrada-wowmin-js', get_template_directory_uri() . '/vendors/wow/wow.min.js', array(), NULL, true);
	wp_enqueue_script('entrada-stellar-js', get_template_directory_uri() . '/vendors/stellar/jquery.stellar.min.js', array(), NULL, true);
	wp_enqueue_script('entrada-validate-js', get_template_directory_uri() . '/vendors/validate/jquery.validate.min.js', array(), NULL, true);
	wp_enqueue_script('entrada-waypoints-js', get_template_directory_uri() . '/vendors/waypoint/waypoints.min.js', array(), NULL, true);
	wp_enqueue_script('entrada-counterup-js', get_template_directory_uri() . '/vendors/counter-up/jquery.counterup.min.js', array(), NULL, true);
	wp_enqueue_script('jquery-ui-autocomplete');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-widget');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('jquery-ui-mouse');
	wp_enqueue_script('jquery-ui-draggable');
	wp_enqueue_script('entrada-touch-punch-js', get_template_directory_uri() . '/vendors/jQuery-touch-punch/jquery.ui.touch-punch.min.js', array(), NULL, true);
	wp_enqueue_script('entrada-fancybox-js', get_template_directory_uri() . '/vendors/fancybox/jquery.fancybox.min.js', array(), NULL, true);
	wp_enqueue_script('entrada-owlcarousel-js', get_template_directory_uri() . '/vendors/owl-carousel/owl.carousel.min.js', array(), NULL, true);
	wp_enqueue_script('entrada-jcf-js', get_template_directory_uri() . '/vendors/jcf/js/jcf.min.js', array(), NULL, true);
	wp_enqueue_script('entrada-jcfselect-js', get_template_directory_uri() . '/vendors/jcf/js/jcf.select.min.js', array(), NULL, true);
	wp_enqueue_script('entrada-datepicker-js', get_template_directory_uri() . '/vendors/bootstrap-datetimepicker-master/dist/js/bootstrap-datepicker.min.js', array(), NULL, true);

	if (!empty($entrada_locale) && $entrada_locale != 'en') {

		wp_enqueue_script('datepicker-locale', get_template_directory_uri() . '/vendors/bootstrap-datetimepicker-master/dist/locales/bootstrap-datepicker.' . $entrada_locale . '.min.js', array(), NULL, true);
	}

	wp_enqueue_script('entrada-stickykit-js', get_template_directory_uri() . '/vendors/sticky-kit/jquery.sticky-kit.min.js', array(), NULL, true);
	wp_enqueue_script('entrada-stickykitinit-js', get_template_directory_uri() . '/dist/js/components/sticky-kit-init.js', array(), NULL, true);
	wp_enqueue_script('entrada-rateyo-js', get_template_directory_uri() . '/vendors/rateYo/min/jquery.rateyo.min.js', array(), NULL, true);
	wp_enqueue_script('entrada-main-js', get_template_directory_uri() . '/dist/js/components/jquery.main.js', array(), NULL, true);
	wp_enqueue_script('entrada-bundle-js', get_template_directory_uri() . '/dist/js/bundle.js', array(), NULL, true);
	// wp_enqueue_script('entrada-retina-js', get_template_directory_uri() . '/vendors/retina/retina.min.js', array(), NULL, true);
	wp_enqueue_script('entrada-facebook-js', '//connect.facebook.net/en_US/all.js', array(), NULL, true);
	wp_enqueue_script('entrada-custom-js', get_template_directory_uri() . '/dist/js/components/entrada_custom.js', array(), '1.1.6', true);
	wp_enqueue_script('entrada-navigation', get_template_directory_uri() . '/dist/js/components/navigation.js', array(), '20120206', true);
	wp_enqueue_script('entrada-skip-link-focus-fix', get_template_directory_uri() . '/dist/js/components/skip-link-focus-fix.js', array(), '20130115', true);
	/* Choose skin via customizer
	.............................. */
	if (isset($_REQUEST['skin_variation']) && $_REQUEST['skin_variation'] == 'golden_grass') {
		wp_enqueue_style(get_theme_mod('skin_setting'),  get_template_directory_uri() . '/css/skins/golden_grass.css');
	} else if (isset($_REQUEST['skin_variation']) && $_REQUEST['skin_variation'] == 'puerto_rico') {
		wp_enqueue_style(get_theme_mod('skin_setting'),  get_template_directory_uri() . '/css/skins/puerto_rico.css');
	} else if (isset($_REQUEST['skin_variation']) && $_REQUEST['skin_variation'] == 'yellow_metal') {
		wp_enqueue_style(get_theme_mod('skin_setting'),  get_template_directory_uri() . '/css/skins/yellow_metal.css');
	} else if (isset($_REQUEST['skin_variation']) && $_REQUEST['skin_variation'] == 'royal_blue') {
		wp_enqueue_style(get_theme_mod('skin_setting'),  get_template_directory_uri() . '/css/skins/royal_blue.css');
	}

	wp_enqueue_script('entrada-search', get_template_directory_uri() . '/dist/js/components/entrada_search.js', array(), '12', true);
	wp_enqueue_script('entrada-product', get_template_directory_uri() . '/dist/js/components/entrada_product.js', array(), '12', true);
	wp_enqueue_script('entrada-blog', get_template_directory_uri() . '/dist/js/components/entrada_blog.js', array(), '12', true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'entrada_scripts', 10);


function entrada_loadscripts()
{
	wp_enqueue_style('entrada-tab-styles',  get_template_directory_uri() . '/admin/css/entrada_backend_style.css');

	wp_enqueue_script('entrada-skillset-js', get_template_directory_uri() . '/admin/js/skillset.js', array(), '43543', true);
	wp_enqueue_style('entrada-icomoon-admin',  get_template_directory_uri() . '/dist/styles/lib/icomoon.css');
	wp_enqueue_style('entrada-skillset-css',  get_template_directory_uri() . '/admin/css/skillset.css');

	if ('' != get_theme_mod('entrada_font_icons_path')) {
		wp_enqueue_style('entrada-custom-icomoon',  get_theme_root_uri() . '/' . get_theme_mod('entrada_font_icons_path'));
	}

	$current_screen = get_current_screen();
	if ($current_screen->id === "widgets" || $current_screen->id === "nav-menus") {

		wp_enqueue_script('jquery-ui-tabs');
	}

	wp_enqueue_style('entrada-admin-icomoon',  get_template_directory_uri() . '/dist/styles/lib/icomoon.css', array(), '1.0.0', true);
	wp_register_script('entrada-admin-js', get_template_directory_uri() . '/admin/js/entrada_admin.js', array(), NULL, true);
	wp_enqueue_script('entrada-admin-js');

	wp_register_script('entrada-customize-js', get_template_directory_uri() . '/admin/js/entrada_customize.js', array(), '1.1.3', true);
	wp_enqueue_script('entrada-customize-js');

	$entrada_custom = array(
		'templateUrl' => get_template_directory_uri(),
		'admin_ajax_url' => admin_url('/admin-ajax.php'),
	);

	wp_localize_script('entrada-admin-js', 'entrada_uri', $entrada_custom);
}
add_action('admin_enqueue_scripts', 'entrada_loadscripts');



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/admin/lang/month_translate.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

require get_template_directory() . '/admin/functions/entrada_icomoon_class_list.php';
require get_template_directory() . '/admin/vc/vc-extension.php';
require get_template_directory() . '/admin/menu/entrada_menu-item-icon.php';

if (file_exists(get_template_directory() . '/inc/resize.php')) {
	require_once(get_template_directory() . '/inc/resize.php');
}


if (file_exists(get_template_directory() . '/inc/class.walker.php')) {
	require_once(get_template_directory() . '/inc/class.walker.php');
}

/* TGM Plugin Activation ..........  */
if (file_exists(get_template_directory() . '/admin/tgma/tgma.php')) {
	require_once(get_template_directory() . '/admin/tgma/tgma.php');
}

/* Custom Functions ..........  */
if (file_exists(get_template_directory() . '/admin/functions/custom-functions.php')) {
	require_once(get_template_directory() . '/admin/functions/custom-functions.php');
}

/* Custom Functions ..........  */
if (file_exists(get_template_directory() . '/admin/wc/wc_functions.php')) {
	require_once(get_template_directory() . '/admin/wc/wc_functions.php');
}

function entrada_google_fonts_url()
{
	$fonts = get_theme_mod('google_font_setting');
	$font_families = array();
	if (!empty($fonts)) {
		foreach ($fonts as $id => $val) {
			if (!empty($val)) {
				$variant_lists = get_transient('google_fonts_variant_lists');
				if (false !== $variant_lists) {
					foreach ($variant_lists as $fonts_name => $variants) {
						$related_variants = '';
						if ($val == $fonts_name) {
							foreach ($variants as $v) {
								if (empty($related_variants)) {
									$related_variants = $v;
								} else {
									$related_variants .= ',' . $v;
								}
							}
							$f_name = str_replace("+", " ", $fonts_name);
							$font_families[] = $f_name . ":" . $related_variants;
						}
					}
				}
			}
		}
	}
	if (!empty($font_families)) {
		$query_args = array(
			'family' => urlencode(implode('|', $font_families))
		);

		$fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
		return esc_url_raw($fonts_url);
	}
}

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'wc_entrada_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'wc_entrada_wrapper_end', 10);

if (!function_exists('wc_entrada_wrapper_start')) {
	function wc_entrada_wrapper_start()
	{
		echo '<main id="main">';
	}
}

if (!function_exists('wc_entrada_wrapper_end')) {
	function wc_entrada_wrapper_end()
	{
		echo '</main>';
	}
}

function entrada_jk_remove_wc_breadcrumbs()
{
	remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
}
add_action('init', 'entrada_jk_remove_wc_breadcrumbs');

/* Write a Review to Product */
function entrada_product_write_review()
{
	global $wpdb;
	$time = current_time('mysql');
	$ipaddress = entrada_client_ip();
	$json_message = array();

	$comment_agent = '';
	if (class_exists('WooCommerce')) {
		$comment_agent = wc_get_user_agent();
	}

	$data = array(
		'comment_post_ID' 		=> $_POST['comment_post_ID'],
		'comment_author' 		=> $_POST['comment_author'],
		'comment_author_email' 	=> $_POST['comment_author_email'],
		'comment_author_url' 	=> $_POST['comment_author_url'],
		'comment_content' 		=> $_POST['comment_content'],
		'comment_type' 			=> '',
		'comment_parent' 		=> 0,
		'user_id' 				=> '',
		'comment_author_IP' 	=> $ipaddress,
		'comment_agent' 		=> $comment_agent,
		'comment_date' 			=> $time,
		'comment_approved' 		=> 0,
	);
	$comment_id = wp_insert_comment($data);
	update_comment_meta($comment_id, 'rating', $_POST['rating']);
	$json_message['Response'] = 'success';
	$json_message['Msg'] = 'Your comment has been submitted.';
	echo json_encode($json_message, true);
	exit;
}
add_action('wp_ajax_entrada_product_write_review', 'entrada_product_write_review');
add_action('wp_ajax_nopriv_entrada_product_write_review', 'entrada_product_write_review');

function entrada_post_average_rating($post_id)
{
	global $wpdb;
	$average_rating = 0;
	$total_rating = 0;
	$total_comment = 999999999999999999999999999999999999999;

	$comments = get_comments(array('post__in' => array($post_id), 'status' => 'approve',));
	if ($comments) {
		$total_comment = count($comments);
		foreach ($comments as $comment) {
			$rating = get_comment_meta($comment->comment_ID, 'rating', true);
			if (!empty($rating))
				$total_rating += $rating;
		}
	}
	$average_rating = ceil($total_rating / $total_comment);
	return $average_rating;
}

function entrada_post_total_reviews($post_id, $comment = false)
{
	global $wpdb;

	$comments = get_comments(array('post_id' => $post_id, 'status' => 'approve'));
	$total_comment = count($comments);
	if ($comment ==  true)
		return $total_comment;

	if ($total_comment  > 1) {
		return  sprintf(__('Based on %s  Reviews', 'entrada'), $total_comment);
	} else {
		return  sprintf(__('Based on %s  Review', 'entrada'), $total_comment);
	}
}

if (!function_exists('entrada_load_comment_pagination')) {
	function entrada_load_comment_pagination()
	{
		global $wpdb;
		$html = '';

		$offset = $_POST['comment_page'] * $_POST['comment_per_page'];

		$sql = "SELECT * FROM " . $wpdb->prefix . "comments WHERE 1= 1 and comment_post_ID =" . $_POST['comment_post_ID'];
		$sql .= " and comment_approved = 1 order by comment_date DESC LIMIT " . $offset . ", " . $_POST['comment_per_page'];

		$result = $wpdb->get_results($sql);
		if ($result) {
			foreach ($result as $comment) {
				$rating = get_comment_meta($comment->comment_ID, 'rating', true);
				$html .= '<div class="comment-slot">
	            <div class="thumb">
	                <a href="#">' . get_avatar($comment->comment_author_email, 64) . '</a>
	            </div>
	            <div class="text">
	                <header class="comment-head">
	                    <div class="left">
	                        <strong class="name">
	                            <a href="#">' . $comment->comment_author . '</a>
	                        </strong>
	                        <div class="meta">Reviewed on ' . date('d/m/Y', strtotime($comment->comment_date)) . '</div>
	                    </div>';
				if (!empty($rating)) :
					$html .= ' <div class="right">
						<div class="star-rating">
							<input class="personal_rating" type="hidden" value="' . $rating . '">
							<div class="personal_rateYo"></div>
						</div>
						<span class="value">' . $rating . '/5</span></div>';
				endif;

				$html .= '</header>
	                <div class="des">
	                    <p>' . $comment->comment_content . '</p>
	                </div>
	            </div>
	        </div>';
			}
		}

		$json_message['Response'] = 'success';
		$json_message['Msg'] = $html;
		echo json_encode($json_message, true);
		exit;
	}
}

if (!function_exists('wp_body_open')) {

	/**
	 * Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.
	 */
	function wp_body_open()
	{
		do_action('wp_body_open');
	}
}

add_action('wp_ajax_entrada_load_comment_pagination', 'entrada_load_comment_pagination');
add_action('wp_ajax_nopriv_entrada_load_comment_pagination', 'entrada_load_comment_pagination');

function entrada_locations_rewrite_rule()
{
	add_rewrite_rule('find/([^/]+)', 'index.php?tours=$matches[1]', 'top');
	add_rewrite_rule('shop/([^/]+)', 'index.php?tour-listing=$matches[1]', 'top');
}
function entrada_register_query_var($vars)
{
	$vars[] = 'tours';
	$vars[] = 'tour-listing';
	return $vars;
}
function entrada_url_rewrite_templates()
{
	if (get_query_var('tours')) {
		add_filter('template_include', function () {
			return get_template_directory() . '/page-properties.php';
		});
	} else if (get_query_var('tour-listing')) {
		add_filter('template_include', function () {
			return get_template_directory() . '/tour-listing.php';
		});
	}
}
add_action('template_redirect', 'entrada_url_rewrite_templates');
add_filter('query_vars', 'entrada_register_query_var');
add_action('init', 'entrada_locations_rewrite_rule');

/* Change the “Return to shop” button URL in the cart page */

function entrada_change_empty_cart_button_url()
{
	return esc_url(home_url('/shop/tour-listing/'));
}
add_filter('woocommerce_return_to_shop_redirect', 'entrada_change_empty_cart_button_url');

function entrada_color_customizer_empty_style()
{
	global $post;
	global $wp_customize;

	if (!get_query_var('tours') && is_home()) {
		echo '<style>.navbar-nav:last-child { display: none !important; } </style>';
	}

	if (!isset($_REQUEST['skin_variation']) || $_REQUEST['skin_variation'] == '') {
		require_once(get_template_directory() . '/inc/colour.customizer.php');
		require_once(get_template_directory() . '/inc/customizer-styles.php');
	}

	if (isset($wp_customize)) {
		echo "\n" . '<style type="text/css" id="custom-css-preview"></style>' . "\n";
		echo "\n" . '<script type="text/javascript" id="custom-js-preview"></script>' . "\n";
		echo "\n" . '<script type="text/javascript" id="custom_google_analytics-preview"></script>' . "\n";
	}

	if (isset($post->ID) && !empty($post->ID)) {
		$entrada_search_col = get_post_meta($post->ID, 'entrada_search_col', true);
		echo '<style> @media only screen and ( min-width: 992px ) { .trip-form .holder { width: ' . $entrada_search_col . '%; } }</style>';
	}
}
add_action('wp_head', 'entrada_color_customizer_empty_style');

/* set the view_mode cookie only after saving the customiser settings */
function entrada_action_customize_save_after($array)
{
	setcookie('view_mode_customizer', '', time() - 3600, COOKIEPATH, COOKIE_DOMAIN, false);
	$view_mode = get_theme_mod('view_mode_layout', 'list');
	setcookie('view_mode', $view_mode, time() + 86400, COOKIEPATH, COOKIE_DOMAIN, false);
};
add_action('customize_save_after', 'entrada_action_customize_save_after', 10, 1);

add_action('after_switch_theme', 'entrada_check_theme_setup');
function entrada_check_theme_setup()
{

	define('THEME_REQUIRED_PHP_VERSION', '5.6.0');
	// Compare versions.
	if (version_compare(phpversion(), THEME_REQUIRED_PHP_VERSION, '<')) :

		add_action('admin_notices', 'entrada_phpversion_check_admin_notice');
		function entrada_phpversion_check_admin_notice()
		{
?>
			<div class="notice notice-success is-dismissible">
				<p><?php _e('You need to update your PHP version to run Entrada Theme.', 'entrada');  ?>
					<?php _e('Running version is:', 'entrada') ?> <strong><?php echo phpversion(); ?></strong>, <?php _e('required is', 'entrada') ?> <strong><?php echo THEME_REQUIRED_PHP_VERSION; ?></strong></p>
			</div>
<?php
		}

		// Switch back to previous theme.
		$theme_switched = get_option('theme_switched');
		if (!empty($theme_switched)) {
			switch_theme($theme_switched);
		} else {
			switch_theme($old_theme->stylesheet);
		}

		return false;

	endif;
}
?>