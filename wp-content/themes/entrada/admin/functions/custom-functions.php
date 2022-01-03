<?php
if (file_exists(get_template_directory() . '/admin/functions/blog-functions.php')) {
	require_once(get_template_directory() . '/admin/functions/blog-functions.php');
}

/* Entrada Max Execution Time ...... */
if (!function_exists('entrada_timeout_extended')) {
	function entrada_timeout_extended($time)
	{
		return 50;
	}
}
add_filter('http_request_timeout', 'entrada_timeout_extended');

/* Entrada Footer Inline Style ...... */
if (!function_exists('entrada_footer_styling')) {
	function entrada_footer_styling()
	{
		echo '<style>.partner-block a .hover{display:none;}</style>';
	}
}
add_action('wp_footer', 'entrada_footer_styling', 100);

/* Get Body class ...................................... */

if (!function_exists('entrada_body_class')) {
	function entrada_body_class()
	{
		$add_classes 		= '';
		$vc_default_classes = '';

		if (class_exists('Vc_Base'))
			$vc_default_classes = 'wpb-js-composer js-comp-ver-5.1.1 vc_responsive';

		if ('boxed' == get_theme_mod('sitelayout_onoff')) {
			$layout = 'boxed-layout';
			if ("bckimage" == get_theme_mod('sitelayout_boxed_option')) {
				$layout = 'boxed-layout bg-image';
			} else if ("bckpattern" == get_theme_mod('sitelayout_boxed_option')) {
				$layout = 'boxed-layout bg-pattern';
			}
		} else {
			$layout = '';
		}

		/* Skin for boxed layout ..*/
		if (isset($_REQUEST['layout']) && $_REQUEST['layout'] == 'boxed') {
			$layout = 'boxed-layout';

			if (isset($_REQUEST['boxed_option']) && $_REQUEST['boxed_option'] == 'bg_image') {
				$layout = 'boxed-layout bg-image';
			} else if (isset($_REQUEST['boxed_option']) && $_REQUEST['boxed_option'] == 'bg_pattern') {
				$layout = 'boxed-layout bg-pattern';
			}
		}

		$nav_property = get_theme_mod('navbar_property');
		if ('default-white-header' == $nav_property) {
			$nav = '';
			$pagenav = 'default-page';
		} else if ('white-header' == $nav_property) {
			$nav = '';
			$pagenav = 'default-page';
		} else if ('dark-header' == $nav_property) {
			$nav = 'default-page';
			$pagenav = 'default-page';
		} else {
			$nav = '';
			$pagenav = 'default-page';
		}

		if (is_home()) {
			$add_classes = 'default-page ';
			if (!empty($vc_default_classes))
				$add_classes .= $vc_default_classes;

			$add_classes .= ' ' . $layout;
		} else if (is_front_page()) {
			if (!empty($vc_default_classes))
				$add_classes .= $vc_default_classes;

			$add_classes .= ' ' . $nav . ' ' . $layout;
		} else if (is_search()) {
			if (!empty($vc_default_classes))
				$add_classes .= $vc_default_classes;

			$add_classes .= ' ' . $pagenav . ' ' . $layout;
		} else if (get_page_template_slug(get_the_ID()) == 'entrada_templates/homepage.php') {
			if (!empty($vc_default_classes))
				$add_classes .= $vc_default_classes;

			$add_classes .= ' ' . $layout;
		} else if (is_page()) {
			$banner_type = get_post_meta(get_the_ID(), 'banner_type', true);
			if (!empty($vc_default_classes))
				$add_classes .= $vc_default_classes;

			$add_classes .= ' ' . $pagenav . ' ' . $layout;
		} else {
			if (!empty($vc_default_classes))
				$add_classes .= $vc_default_classes;

			$add_classes .= ' ' . $pagenav . ' ' . $layout;
		}
		return 'class="' . $add_classes . '"';
	}
}

/* Entrada check if plugin is activated
............................................................. */


/* Entrada One Click Demo Install Plugin integration
............................................................. */
if (!function_exists('entrada_import_files')) {
	function entrada_import_files()
	{
		return array(
			array(
				'import_file_name'             => __('Entrada Default Demo Import', 'entrada'),
				'local_import_file'            => trailingslashit(get_template_directory()) . 'ocdi/default/demo-content-default.xml',
				'local_import_widget_file'     => trailingslashit(get_template_directory()) . 'ocdi/default/widgets-default.wie',
				'local_import_customizer_file' => trailingslashit(get_template_directory()) . 'ocdi/default/customizer-default.dat',
				'import_preview_image_url'    => get_template_directory_uri() . '/admin/demo_import/default.png',
				'import_notice'               => __('After you import this demo, you will have to set up the sliders separately', 'entrada'),
				'preview_url'                 => 'https://themes.waituk.com/entrada-default/',
			),

			array(
				'import_file_name'             => __('Entrada Modern Demo Import', 'entrada'),
				'local_import_file'            => trailingslashit(get_template_directory()) . 'ocdi/modern/demo-content-modern.xml',
				'local_import_widget_file'     => trailingslashit(get_template_directory()) . 'ocdi/modern/widgets-modern.wie',
				'local_import_customizer_file' => trailingslashit(get_template_directory()) . 'ocdi/modern/customizer-modern.dat',
				'import_preview_image_url'    => get_template_directory_uri() . '/admin/demo_import/modern/modern.jpg',
				'import_notice'               => __('After you import this demo, you will have to set up the sliders separately', 'entrada'),
				'preview_url'                 => 'https://themes.waituk.com/entrada-modern/',
			),
		);
	}
}
add_filter('pt-ocdi/import_files', 'entrada_import_files');


function entrada_ocdi_after_import($selected_import)
{
	_e("Entrada Demo content import has been completed.", "entrada");
	$demo_import_css = '';

	if ('Entrada Modern Demo Import' === $selected_import['import_file_name']) {
		//$demo_import_css = get_template_directory_uri() . '/admin/demo_import/modern/modern.css';

		/* Entrada Sync Taxonomy Data */
		$taxonomy_xml_url = esc_url('https://cdn2.waituk.com/ocdi/demo-content/entrada-407/modern/taxonomy-data.xml');
		entrada_sync_taxonomies($taxonomy_xml_url);

		/* Entrada Sync Product Gallery Data */
		$gallery_xml_url = esc_url('https://cdn2.waituk.com/ocdi/demo-content/entrada-407/modern/gallery-data.xml');
		entrada_sync_product_gallery($gallery_xml_url);

		//Import Modern Revolution Slider
		if (class_exists('RevSlider')) {

			$slider_urls = array(
				esc_url('https://cdn2.waituk.com/ocdi/sliders/entrada-407/modern/slider-6.zip'),
				esc_url('https://cdn2.waituk.com/ocdi/sliders/entrada-407/modern/destination-slider.zip'),
				esc_url('https://cdn2.waituk.com/ocdi/sliders/entrada-407/modern/slider-8.zip'),
				esc_url('https://cdn2.waituk.com/ocdi/sliders/entrada-407/modern/slider-9.zip'),
				esc_url('https://cdn2.waituk.com/ocdi/sliders/entrada-407/modern/slider-10.zip')
			);

			$slider_array = waituk_download_revsliders($slider_urls);

			$slider = new RevSlider();

			foreach ($slider_array as $filepath) {
				$slider->importSliderFromPost(true, true, $filepath);
			}
		}
	} else {

		/* Entrada Sync Taxonomy Data */
		$taxonomy_xml_url = esc_url('https://cdn2.waituk.com/ocdi/demo-content/entrada-407/default/taxonomy-data.xml');
		entrada_sync_taxonomies($taxonomy_xml_url);

		/* Entrada Sync Product Gallery Data */
		$gallery_xml_url = esc_url('https://cdn2.waituk.com/ocdi/demo-content/entrada-407/default/gallery-data.xml');
		entrada_sync_product_gallery($gallery_xml_url);

		//Import Default Revolution Slider
		if (class_exists('RevSlider')) {

			$slider_urls = array(
				esc_url('https://cdn2.waituk.com/ocdi/sliders/entrada-407/default/slider-1.zip'),
				esc_url('https://cdn2.waituk.com/ocdi/sliders/entrada-407/default/slider-2.zip'),
				esc_url('https://cdn2.waituk.com/ocdi/sliders/entrada-407/default/slider-3.zip'),
				esc_url('https://cdn2.waituk.com/ocdi/sliders/entrada-407/default/slider-4.zip'),
				esc_url('https://cdn2.waituk.com/ocdi/sliders/entrada-407/default/slider-5.zip')
			);

			$slider_array = waituk_download_revsliders($slider_urls);

			$slider_default = new RevSlider();

			foreach ($slider_array as $filepath) {
				$slider_default->importSliderFromPost(true, true, $filepath);
			}
		}
	}

	/* Set default shop page */
	$page = get_page_by_path('shop');
	if (isset($page->ID)) {
		update_option('woocommerce_shop_page_id', $page->ID);
		entrada_del_duplicate_shop_page();
	}

	//set_theme_mod('demo_import_css', $demo_import_css);
}
add_action('pt-ocdi/after_import', 'entrada_ocdi_after_import');

/* Entrada Delete Duplicate Shop Page
 ............................. */
if (!function_exists('entrada_del_duplicate_shop_page')) {
	function entrada_del_duplicate_shop_page()
	{
		$page = get_page_by_path('shop-2');
		if (isset($page->ID)) {
			wp_delete_post($page->ID);
		}
	}
}

/* Entrada Sync Taxonomy Data
 ............................. */

if (!function_exists('entrada_sync_taxonomies')) {
	function entrada_sync_taxonomies($url)
	{
		$file_path = entrada_download_url($url);
		if (isset($file_path) && !empty($file_path)) {
			if (file_exists($file_path)) {
				$xml = simplexml_load_file($file_path);
				$cnt = 0;
				foreach ($xml->item as $item) {
					$cnt++;
					if ($cnt == 1) {
						$old_url = $item->cat_url;
						$new_url = esc_url(home_url(''));
						update_guid($old_url, $new_url);
					}

					$array_data = array(
						'prod_cat_best_season' => '',
						'prod_cat_popular_location' => '',
						'prod_cat_heading' => '',
						'prod_cat_sub_heading' => '',
						'prod_cat_sub_title' => '',
						'prod_cat_listing_title' => '',
						'prod_cat_listing_sub_title' => '',
						'prod_cat_dig_more_link' => '',
						'product_cat_banner_img_id' => '',
						'product_cat_map_img_id' => '',
						'prod_iconbar_cat_val' => '',
						'prod_featured_home_val' => '',
						'prod_featured_cat_val' => '',
						'prod_icomoon_cat_val' => '',
						'activity_level_val' => ''
					);

					$cat_data = unserialize($item->cat_data);

					if (!empty($item->cat_slug)) {
						/* Filter data ........... */
						if (count($cat_data) > 0) {
							$upload_dir = wp_upload_dir();
							foreach ((array) $cat_data as $key => $key_value) {
								if (array_key_exists($key, $array_data)) {
									$val = $key_value;
									if (!empty($key_value) && ($key == 'product_cat_banner_img_id' || $key == 'product_cat_map_img_id')) {


										$image_url = $upload_dir['baseurl'] . $key_value;

										$attachment_id = entrada_attachment_id_from_src($image_url);
										if (empty($attachment_id)) {

											$filetype = wp_check_filetype($key_value);
											$args = array(
												'orderby' => 'rand',
												'posts_per_page' => '1',
												'post_type' => 'product'
											);
											$loop = new WP_Query($args);
											while ($loop->have_posts()) : $loop->the_post();
												$parent_post_id = get_the_ID();
											endwhile;

											// Prepare an array of post data for the attachment.
											$attachment = array(
												'guid'           => $image_url,
												'post_mime_type' => $filetype['type'],
												'post_title'     => 'Entrada Banner Image',
												'post_content'   => '',
												'post_status'    => 'inherit'
											);

											// Insert the attachment.
											$attachment_id = wp_insert_attachment($attachment, $key_value, $parent_post_id);
										}
										$val = $attachment_id;
									}
									$array_data[$key] = $val;
								}
							}
						}

						$slug_data = explode("==", $item->cat_slug);


						$term = get_term_by('slug', $slug_data[0], $slug_data[1]);

						$option_name = 'taxonomy_' . $term->term_id;
						update_option($option_name, $array_data);

						// Taxonomy Featured Image Update....
						if (!empty($item->cat_img)) {
							$featured_img_src = $upload_dir['baseurl'] . $item->cat_img;
							$attach_id = entrada_attachment_id_from_src($featured_img_src);
							if (!empty($attach_id)) {
								update_woocommerce_term_meta($term->term_id, 'thumbnail_id', $attach_id, true);
							}
						}
					}
				}
			}
		}
	}
}

/* Entrada Sync Product Gallery Data
 ............................. */

if (!function_exists('entrada_sync_product_gallery')) {
	function entrada_sync_product_gallery($url)
	{
		$file_path = entrada_download_url($url);
		if (isset($file_path) && !empty($file_path)) {
			if (file_exists($file_path)) {
				$xml = simplexml_load_file($file_path);
				$cnt = 0;
				foreach ($xml->item as $item) {
					$attached_arr = array();
					if (!empty($item->attach_url)) {
						$post_id = entrada_post_id_from_slug($item->post_slug);

						$attach_urls  = explode(',', $item->attach_url);
						foreach ($attach_urls as $attach_url) {
							$image_url = str_replace($item->domain_url, esc_url(home_url('')), $attach_url);
							$attached_arr[] = entrada_attachment_id_from_src($image_url);
						}

						if ($item->meta_key == 'product_gallery_img') {
							update_post_meta($post_id, 'product_gallery_img', maybe_serialize($attached_arr));
						} else if ($item->meta_key == 'itinerary_gallery_img') {
							update_post_meta($post_id, 'itinerary_gallery_img', maybe_serialize($attached_arr));
						}
					}
				}
			}
		}
	}
}


function entrada_download_url($url)
{
	global $wp_filesystem;
	$file_full_path = '';
	$upload_dir = wp_upload_dir();

	$response = wp_remote_get($url);
	if (is_array($response)) {
		$zip = $response['body'];
		$folder_name = $upload_dir['path'];
		if (wp_mkdir_p($upload_dir['path'])) {
			$file = $upload_dir['path'] . "/entrada_" . wp_rand() . ".xml";
			if (connect_fs($url, "", $upload_dir['path'], $zip)) {
				$wp_filesystem->put_contents(
					$file,
					$zip,
					FS_CHMOD_FILE
				);

				$file_full_path = $file;
			}
		}
	}
	return $file_full_path;
}


function connect_fs($url, $method, $context, $fields = null)
{
	global $wp_filesystem;
	if (false === ($credentials = request_filesystem_credentials($url, $method, false, $context, $fields))) {
		return false;
	}

	//check if credentials are correct or not.
	if (!WP_Filesystem($credentials)) {
		request_filesystem_credentials($url, $method, true, $context);
		return false;
	}

	return true;
}

function waituk_download_revsliders($files_array)
{
	global $wp_filesystem;
	$slider_array = array();
	$upload_dir = wp_upload_dir();

	if ($files_array) {
		foreach ($files_array as $url) {
			$response = wp_remote_get($url);
			if (is_array($response)) {
				$zip = $response['body'];
				$folder_name = $upload_dir['path'];
				if (wp_mkdir_p($upload_dir['path'])) {
					$file = $upload_dir['path'] . "/slider_" . wp_rand() . ".zip";
					if (connect_fs($url, "", $upload_dir['path'], $zip)) {
						$wp_filesystem->put_contents(
							$file,
							$zip,
							FS_CHMOD_FILE
						);

						$slider_array[] = $file;
					}
				}
			}
		}
	}

	return $slider_array;
}

/* Entrada Login/Myaccount Icon for header section
............................................................. */
if (!function_exists('entrada_header_login_icon')) {
	function entrada_header_login_icon()
	{
		$navbar = get_theme_mod('navbar_style');
		$v_divider = 'v-divider';
		if ('centered_navbar' == $navbar) {
			$v_divider = '';
		}
		$html = '';

		$url = home_url('login');

		if (is_user_logged_in()) {

			$url =  admin_url('users.php');
			$woocommerce_myaccount_page_id = get_option('woocommerce_myaccount_page_id');
			if (isset($woocommerce_myaccount_page_id) && !empty($woocommerce_myaccount_page_id)) {
				$url =  get_permalink($woocommerce_myaccount_page_id);
			}
		}

		$html .= '<li class="visible-xs visible-sm">
						<a href="' . esc_url($url) . '">
							<i class="material-icons">account_circle</i>
							<span class="text"> ' . __('Login', 'entrada') . ' </span>
						</a>
					</li>
					<li class="hidden-xs hidden-sm ' . $v_divider . '">
						<a href="' . esc_url($url) . '">
							<i class="material-icons">account_circle</i>
						</a>
					</li>';
		return $html;
	}
}

/* Entrada Login/Myaccount Icon for header top-bar ection
............................................................. */
if (!function_exists('entrada_topbar_login_icon')) {
	function entrada_topbar_login_icon()
	{

		$html = '';
		$url = home_url('login');

		if (is_user_logged_in()) {

			$url =  admin_url('users.php');
			$woocommerce_myaccount_page_id = get_option('woocommerce_myaccount_page_id');
			if (isset($woocommerce_myaccount_page_id) && !empty($woocommerce_myaccount_page_id)) {
				$url =  get_permalink($woocommerce_myaccount_page_id);
			}
		}

		if (is_user_logged_in()) {
			$current_user = wp_get_current_user();
			$display_name = $current_user->display_name;
			$html .= '<li><a href="' . $url . '"><i class="material-icons">account_circle</i><span class="text hidden-xs">' . $display_name . '</span></a></li>
				<li><a href="' . wp_logout_url(home_url()) . '"><span class="icon-lock"></span><span class="text hidden-xs">' . __('Logout', 'entrada') . '</span></a></li>';
		} else {
			$html .= '<li><a href="' . $url . '"><span class="icon-lock"></span><span class="text hidden-xs">' . __('Login', 'entrada') . '</span></a></li>
				<li><a href="' . $url . '"><i class="material-icons">account_circle</i><span class="text hidden-xs">' . __('Register', 'entrada') . '</span></a></li>';
		}
		return $html;
	}
}

/* Entrada Locale
................................................ */
if (!function_exists('entrada_locale')) {
	function entrada_locale()
	{
		global $entrada_locale;
		$entrada_locale = 'en';
		$entrada_set_locale = 'en_US';
		if (class_exists('SitePress')) {
			$wpml_languages = icl_get_languages('skip_missing=0&orderby=code');
			if (!empty($wpml_languages)) {
				$active_total_language = count($wpml_languages);
				foreach ($wpml_languages as $l) {
					if ($l['active']) {
						$entrada_locale = $l['language_code'];
					}
				}
			}
		} else if (!empty(get_locale())) {
			$locale_tmp = get_locale();
			$entrada_set_locale = $locale_tmp;
			$locale_tmp_arr = explode("_", $locale_tmp);
			if ($locale_tmp_arr) {
				$entrada_locale = $locale_tmp_arr[0];
			}
		}
		setlocale(LC_ALL, $entrada_set_locale);
	}
}
add_action('init', 'entrada_locale');

/* Entrada WPML Language dropdown
................................................ */
if (!function_exists('entrada_multilang_dropdown')) {
	function entrada_multilang_dropdown($static_lanugages = false)
	{
		if (!defined('ICL_LANGUAGE_CODE')) {
			define('ICL_LANGUAGE_CODE', '');
		}

		$navbar = get_theme_mod('navbar_style');
		$v_divider = 'v-divider';
		if ('centered_navbar' == $navbar) {
			$v_divider = '';
		}
		$html = '';
		$selected_lang = 'EN';
		if (class_exists('SitePress')) {
			$wpml_languages = icl_get_languages('skip_missing=0&orderby=code');
			if (!empty($wpml_languages)) {
				$lang_count = 0;
				$active_total_language = count($wpml_languages);
				foreach ($wpml_languages as $l) {
					if ($l['active']) {
						$selected_lang = $l['language_code'];
					}
				}
				$html .= '<li class="dropdown hidden-xs hidden-sm last-dropdown ' . $v_divider . '"><a href="#"><span class="text">' . $selected_lang . '</span></a>';
				$html .= '<div class="dropdown-menu dropdown-sm"><div class="drop-wrap lang-wrap">';
				foreach ($wpml_languages as $l) {
					$html .= '<div class="lang-row"><div class="lang-col"><a href="' . $l['url'] . '"><span class="text">' . $l['translated_name'] . '</span></a></div></div>';
				}
				$html .= '</div></div>';
				$html .= '</li>';
			}
		} else if ($static_lanugages ==  true) {
			$html .= '<li class="dropdown hidden-xs hidden-sm last-dropdown v-divider">
					<a href="#"><span class="text">EN</span> <span class="icon-angle-down"></span></a>
					<div class="dropdown-menu dropdown-sm"><div class="drop-wrap lang-wrap">
					<div class="lang-row"><div class="lang-col"><a href="#"><span class="text">English</span></a></div></div>
					<div class="lang-row"><div class="lang-col"><a href="#"><span class="text">German</span></a></div></div>
					<div class="lang-row"><div class="lang-col"><a href="#"><span class="text">Russian</span></a></div></div>
					<div class="lang-row"><div class="lang-col"><a href="#"><span class="text">Czech</span></a></div></div>
					<div class="lang-row"><div class="lang-col"><a href="#"><span class="text">Chinese</span></a></div></div>
					<div class="lang-row"><div class="lang-col"><a href="#"><span class="text">Danish</span></a></div></div>
					</div></div></li>';
		}
		return $html;
	}
}

/* Entrada Javascript constant
................................................ */
if (!function_exists('entrada_js_constant')) {
	function entrada_js_constant()
	{
		$html = '';
		global $entrada_locale;
		$global_vars = array();
		$global_vars['cookie_path'] 		  = '';
		$global_vars['admin_ajax_url'] 		  = admin_url('admin-ajax.php');
		$global_vars['site_home_url'] 		  = esc_url(home_url('/'));
		$global_vars['facebook_appId'] 		  = get_option('entrada_facebook_app_id');
		$global_vars['no_more_record_found']  = __('NO MORE RECORD FOUND.',  'entrada');
		$global_vars['no_more_comment_found'] = __('No more comment to load.',  'entrada');
		$global_vars['no_trip_matches'] 	  = __('No Trip matches your search criteria.',  'entrada');
		$global_vars['load_more'] 			  = __('LOAD MORE',  'entrada');
		$global_vars['loading'] 			  = __('LOADING...',  'entrada');
		$global_vars['procesing_msg'] 		  = __('Please wait while processing...',  'entrada');
		$global_vars['read_full_review'] 	  = __('Read Full Comment',  'entrada');
		$global_vars['hide_full_review'] 	  = __('Hide Full Comment',  'entrada');
		$global_vars['more_option'] 		  = __('More Option',  'entrada');
		$global_vars['hide_option'] 		  = __('Hide Option',  'entrada');
		$global_vars['email_mandatory_msg']   = __('Email must be filled out.',  'entrada');
		$global_vars['uemail_mandatory_msg']  = __('Username Or Email must be filled out.',  'entrada');
		$global_vars['fname_mandatory_msg']   = __('Your first name must be filled out.',  'entrada');
		$global_vars['lname_mandatory_msg']   = __('Your last name must be filled out.',  'entrada');
		$global_vars['aname_mandatory_msg']   = __('Your name must be filled out.',  'entrada');
		$global_vars['uname_mandatory_msg']   = __('Username must be filled out.',  'entrada');
		$global_vars['pass_mandatory_msg'] 	  = __('Password must be filled out.',  'entrada');
		$global_vars['rating_mandatory_msg']  = __('Rating must be selected.',  'entrada');
		$global_vars['comment_mandatory_msg'] = __('Comment must be filled out.',  'entrada');
		$global_vars['email_valid_msg'] 	  = __('Valid Email must be filled out.',  'entrada');

		if (!empty($entrada_locale)) {
			$global_vars['entrada_locale'] = $entrada_locale;
		} else {
			$global_vars['entrada_locale'] = 'en';
		}

		$siteurl = home_url();

		$domain_url = str_replace("http://", "", home_url());
		$domain_url = str_replace("https://", "", $domain_url);
		$cookie_path_arr = explode('/', $domain_url);
		if (isset($cookie_path_arr[1])) {
			$global_vars['cookie_path'] = $cookie_path_arr[1];
		}

		$html .= '<script type="text/javascript"> /* <![CDATA[ */ var entradaObj = {}; ';
		$html .= 'var entrada_params = ' . json_encode($global_vars, true) . ';';
		$html .= '/* ]]> */ </script>';
		echo sprintf(__('%s', 'entrada'), $html);

		/* Entrada adminbar style */
		if (is_user_logged_in()) {
			$current_user = wp_get_current_user();
			$show_admin_bar_front = get_user_meta($current_user->ID, 'show_admin_bar_front', true);

			if (isset($show_admin_bar_front) && $show_admin_bar_front == 'true') {
				$navbar_property = get_theme_mod('navbar_property', 'white-header');

				switch ($navbar_property) {
					case 'dark-header':
					case 'white-header':
						echo '<style> body{ padding-top:0;} #header{ top:32px;}</style>';
						break;

					default:
						echo '<style> body{ padding-top:32px;} #header{ top:32px;}</style>';
						break;
				}
			}
		}

		/* Facebook Open Graph */

		if (is_single()) {
			global $post;
			if (get_the_post_thumbnail($post->ID, 'thumbnail')) {
				$thumbnail_id = get_post_thumbnail_id($post->ID);
				$thumbnail_object = get_post($thumbnail_id);
				$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium');
				$image = $thumb[0];
			} else {
				$image = '';
			}
			$description = entrada_truncate($post->ID, 30, 100, 'id');
			$description = strip_tags($description);
			$description = str_replace("\"", "'", $description);

			$facebook_app_id = get_option('entrada_facebook_app_id');
			$post_title = get_the_title();
			$post_permalink = get_permalink();
			$blog_name = get_bloginfo('name');

			echo "\n<meta property=\"fb:appid\" content=\"$facebook_app_id\" />";
			echo "\n<meta property=\"og:type\" content=\"website\" />";
			echo "\n<meta property=\"og:title\" content=\"$post_title\" />";
			echo "\n<meta property=\"og:url\" content=\"$post_permalink\" />";
			echo "\n<meta property=\"og:description\" content=\"$description\" />";
			echo "\n<meta property=\"og:image\" content=\"$image\" />";
			echo "\n<meta property=\"og:image:width\" content=\"384\" />";
			echo "\n<meta property=\"og:image:height\" content=\"250\" />";
			echo "\n<meta property=\"og:site_name\" content=\"$blog_name\" />";
			echo "\n<meta property=\"og:locale\" content=\"en_US\" />";
		}
	}
}
add_action('wp_head', 'entrada_js_constant');

/* Entrada Post view count
................................................ */
if (!function_exists('entrada_get_post_views')) {
	function entrada_get_post_views($postID)
	{
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if ($count == '') {
			return __('0 View',  'entrada');
		}
		return $count . __(' Views',  'entrada');
	}
}
if (!function_exists('entrada_set_post_views')) {
	function entrada_set_post_views($postID)
	{
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if ($count == '') {
			$count = 1;
			update_post_meta($postID, $count_key, '1');
		} else {
			$count++;
			update_post_meta($postID, $count_key, $count);
		}
	}
}

if (!function_exists('entrada_post_id_from_slug')) {
	function entrada_post_id_from_slug($post_slug)
	{
		global $wpdb;
		$rw = $wpdb->get_row("select * from " . $wpdb->prefix . "posts where post_name ='" . $post_slug . "'");
		return $rw->ID;
	}
}
if (!function_exists('update_guid')) {
	function update_guid($old_url, $new_url)
	{
		global $wpdb;
		$wpdb->query("UPDATE " . $wpdb->prefix . "posts SET guid = replace(guid, '" . $old_url . "','" . $new_url . "')");
		$wpdb->query("UPDATE " . $wpdb->prefix . "postmeta SET meta_value = replace(meta_value, '" . $old_url . "','" . $new_url . "')");
	}
}

/* Entrada Guest wishlist tranfer to loggedin user's account
..................................................................... */
if (!function_exists('entrada_guest_wishlist_loggedIn_user')) {
	function entrada_guest_wishlist_loggedIn_user($user_login, $user)
	{
		global $wpdb;
		$user_id = get_current_user_id();
		if (isset($_COOKIE['guest_user']) && $_COOKIE['guest_user'] != '') {
			$guest_user = $_COOKIE['guest_user'];
			$execut = $wpdb->query($wpdb->prepare("UPDATE " . $wpdb->prefix . "entrada_wishlist SET user_id= %d WHERE guest_id= %s", $user_id, $guest_user));
			$sql_dup = "DELETE from " . $wpdb->prefix . "entrada_wishlist using " . $wpdb->prefix . "entrada_wishlist,
			" . $wpdb->prefix . "entrada_wishlist e1
				WHERE " . $wpdb->prefix . "entrada_wishlist.id > e1.id
				AND " . $wpdb->prefix . "entrada_wishlist.user_id = e1.user_id
				AND " . $wpdb->prefix . "entrada_wishlist.post_id = e1.post_id ";
			$execut = $wpdb->query($sql_dup);
		}
	}
}
add_action('wp_login', 'entrada_guest_wishlist_loggedIn_user', 10, 2);

/* Entrada Mailchimp Subscriber (Footer Section)
................................................ */

/* Entrada start Guest cookies
................................................ */
if (!function_exists('entrada_guest_cook')) {
	function entrada_guest_cook()
	{
		if (!isset($_COOKIE['guest_user']) || $_COOKIE['guest_user'] == '') {
			$guest_user = entrada_random_integer('int');
			$GLOBALS['guest_user'] = $guest_user;
			setcookie('guest_user', $guest_user, time() + (86400 * 365), COOKIEPATH, COOKIE_DOMAIN, false);
		}
	}
}
add_action('init', 'entrada_guest_cook');


if (!function_exists('entrada_sharethis_nav')) {
	function entrada_sharethis_nav($post_id)
	{
		global $wpdb;
		$share_img 		= '';
		$share_title 	= get_the_title($post_id);
		$share_url 		= get_permalink($post_id);
		$entrada_post 	= get_post($post_id);
		$share_txt 		= wp_trim_words(strip_tags($entrada_post->post_content), 40, '');
		if (has_post_thumbnail($post_id)) :
			$image 		= wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'single-post-thumbnail');
			$share_img 	= $image[0];
		endif;
		$html = '<li class="dropdown">
	    <a class="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><span class="icon-share"></span></a>
	    <ul class="dropdown-menu drop-social-share">
	    <li><a href="javascript:void(null);" class="facebook" onClick = "fb_callout(&quot;' . $share_url . '&quot;, &quot;' . $share_img . '&quot;, &quot;' . $share_title . '&quot;, &quot;' . $share_txt . '&quot;);">
	        <span class="ico">
	            <span class="icon-facebook"></span>
	        </span>
	        <span class="text">Share</span>
	    </a>
	    </li>
	    <li><a href="javascript:void(null);" class="twitter" onClick ="share_on_twitter(&quot;' . $share_url . '&quot;, &quot;' . $share_title . '&quot;);">
	        <span class="ico">
	            <span class="icon-twitter"></span>
	        </span>
	        <span class="text">Tweet</span>
	    </a> </li>
	    </ul>
	    </li>';
		return $html;
	}
}

if (!function_exists('entrada_custom_breadcrumbs')) {
	function entrada_custom_breadcrumbs()
	{
		$bread = get_theme_mod('navbar_breadcrumb_onoff', 'yes');
		if (isset($bread)) {
			if ('' != $bread) {
				$showOnHome = 0;
				$delimiter = '';
				$home = __('Home',  'entrada');
				$showCurrent = 1;
				$before = '<li>';
				$after = '</li>';
				global $post;
				$content = '';

				$homeLink = esc_url(home_url('/'));
				if (is_home() || is_front_page()) {
					if ($showOnHome == 1) {
						$content = '<ul><li><a href="' . $homeLink . '">' . $home . '</a></li></ul>';
					}
				} else {
					$content .= '<ul><li><a href="' . $homeLink . '">' . $home . '</a></li> ' . $delimiter . ' ';
					if (is_category()) {
						$thisCat = get_category(get_query_var('cat'), false);
						if ($thisCat->parent != 0) {
							$content .= get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
						}
						$content .= $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
					} else if (is_tax()) {
						$thisterm 	= get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
						$thisparent = $thisterm->parent;
						while ($thisparent) :
							$thisparents[] 	= $thisparent;
							$new_parent 	= get_term_by('id', $thisparent, get_query_var('taxonomy'));
							$thisparent 	= $new_parent->parent;
						endwhile;
						if (!empty($thisparents)) :
							$thisparents = array_reverse($thisparents);
							$woocommerce_permalinks_arr = array();
							foreach ($thisparents as $parent) :
								$taxonomy_slug = get_query_var('taxonomy');
								$item 	= get_term_by('id', $parent, $taxonomy_slug);
								$category_base = $item->taxonomy;
								$woocommerce_permalinks = get_option('woocommerce_permalinks');

								$url = get_term_link($item->term_id, $taxonomy_slug);

								if (!empty($woocommerce_permalinks->term_idlinks) && $taxonomy_slug != 'destination') {
									$woocommerce_permalinks_arr = maybe_unserialize($woocommerce_permalinks);
									$category_base = $woocommerce_permalinks_arr['category_base'];
									$url = esc_url(home_url('/')) . $category_base . '/' . $item->slug;
								}

								$content .= '<li><a href="' . $url . '">' . $item->name . '</a></li>';
							endforeach;
						endif;
						$content .= '<li>' . $thisterm->name . '</li>';
					} else if (is_search()) {
						$content .= $before . 'Search results for "' . get_search_query() . '"' . $after;
					} else if (is_day()) {
						$content .= '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
						$content .= '<li><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
						$content .= $before . get_the_time('d') . $after;
					} else if (is_month()) {
						$content .= '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
						$content .= $before . get_the_time('F') . $after;
					} else if (is_year()) {
						$content .= $before . get_the_time('Y') . $after;
					} else if (is_single() && !is_attachment()) {
						if (get_post_type() != 'post') {
							$post_type 	= get_post_type_object(get_post_type());
							$slug 		= $post_type->rewrite;
							$content .= '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li>';
							if ($showCurrent == 1) {
								$content .= ' ' . $delimiter . ' ' . esc_attr($before) . get_the_title() . $after;
							}
						} else {
							$cat 	= get_the_category();
							$cat = $cat[0];
							$cats 	= get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
							if ($showCurrent == 0) {
								$cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
							}
							$content .= $cats;
							if ($showCurrent == 1) {
								$content .= $before . get_the_title() . $after;
							}
						}
					} else if (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
						if (is_tax('product_cat')) {
							$content .= $before . single_cat_title('', false) . $after;
							$post_name = 'Product';
							$content .= $before . sprintf(__('%s', 'entrada'), $post_name) . $after;
						}
					} else if (is_attachment()) {
						$parent = get_post($post->post_parent);
						$cat 	= get_the_category($parent->ID);
						$cat = $cat[0];
						$content .= get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
						$content .= '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
						if ($showCurrent == 1) {
							$content .= ' ' . $delimiter . ' ' . esc_attr($before) . get_the_title() . $after;
						}
					} else if (is_page() && !$post->post_parent) {
						if ($showCurrent == 1) {
							$content .= $before . get_the_title() . $after;
						}
					} else if (is_page() && $post->post_parent) {
						$parent_id  	= $post->post_parent;
						$breadcrumbs 	= array();
						while ($parent_id) {
							$page 			= get_page($parent_id);
							$breadcrumbs[] 	= '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
							$parent_id  	= $page->post_parent;
						}
						$breadcrumbs = array_reverse($breadcrumbs);
						for ($i = 0; $i < count($breadcrumbs); $i++) {
							$content .= $breadcrumbs[$i];
							if ($i != count($breadcrumbs) - 1) {
								$content .= ' ' . $delimiter . ' ';
							}
						}
						if ($showCurrent == 1) {
							$content .= ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
						}
					} else if (is_tag()) {
						$content .= $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
					} else if (is_author()) {
						global $author;
						$userdata = get_userdata($author);
						$content .= $before . 'Articles posted by ' . $userdata->display_name . $after;
					} else if (is_404()) {
						$content .= $before . 'Error 404' . $after;
					}
					if (get_query_var('paged')) {
						if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
							$content .= ' (';
						}
						$content .= __('Page', 'entrada') . ' ' . get_query_var('paged');
						if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
							$content .= ')';
						}
					}
					$content .= '</ul>';
				}

				echo sprintf(__('%s', 'entrada'), $content);
			}
		}
	}
}

if (!function_exists('entrada_social_media_share_btn')) {
	function entrada_social_media_share_btn($share_title, $share_url, $share_txt, $share_img)
	{
		global $wpdb;
		$html = '';
		$html .= '<li><a href="javascript:void(null);" onClick = "fb_callout(&quot;' . $share_url . '&quot;, &quot;' . $share_img . '&quot;, &quot;' . $share_title . '&quot;, &quot;' . $share_txt . '&quot;);"><span class="icon-facebook"></span></a></li>';
		$html .= '<li><a href="javascript:void(null);" onClick ="share_on_twitter(&quot;' . $share_url . '&quot;, &quot;' . $share_title . '&quot;);"> <span class="icon-twitter"></span></a></li>';
		return $html;
	}
}

if (!function_exists('entrada_custom_mime_types')) {
	function entrada_custom_mime_types($mimes)
	{
		// New allowed mime types.
		$mimes['svg'] = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';

		unset($mimes['exe']);
		return $mimes;
	}
}
add_filter('upload_mimes', 'entrada_custom_mime_types');


if (!function_exists('entrada_svg_thumb_display')) {
	function entrada_svg_thumb_display()
	{
		echo '<style>td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail {width: 100% !important; height: auto !important; }</style>';
	}
}
add_action('admin_head', 'entrada_svg_thumb_display');

if (!function_exists('entrada_add_option_to_settings_page')) {
	function entrada_add_option_to_settings_page($avia_elements)
	{
		$avia_elements[] =  array(
			"slug"  => "mysettings",
			"name"  => __('Custom Message', 'entrada'),
			"desc"  => __('Please enter the message that you would like to dispay to your visitors.', 'entrada'),
			"id"    => "message",
			"type"  => "textarea",
			"std"   => "",
		);
		return $avia_elements;
	}
}
add_filter('avf_option_page_data_init', 'entrada_add_option_to_settings_page', 10, 1);

if (!function_exists('entrada_image_attributes')) {
	function entrada_image_attributes($attach_id)
	{
		global $wpdb;
		$attach_metadata = array();

		$thumb_img = get_post($attach_id);

		$attach_metadata['caption'] = $thumb_img->post_excerpt;
		$attach_metadata['desc'] = strip_tags($thumb_img->post_content);
		$attach_metadata['title'] = $thumb_img->post_title;

		return $attach_metadata;
	}
}

if (!function_exists('entrada_attachment_id_from_src')) {
	function entrada_attachment_id_from_src($image_src)
	{
		global $wpdb;
		$query 	= "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
		$id 	= $wpdb->get_var($query);
		return $id;
	}
}

if (!function_exists('entrada_image_attributes_from_src')) {
	function entrada_image_attributes_from_src($img_url, $img_attr = 'caption', $print = false)
	{
		$image_attr_val = '';
		global $wpdb;
		$attachment_id = entrada_attachment_id_from_src($img_url);
		if (!$attachment_id) {
			return '';
		}
		$result = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "posts where ID =" . $attachment_id);
		if ($result) {
			if ($img_attr == 'desc') {
				$image_attr_val = strip_tags($result->post_content);
			} else if ($img_attr == 'caption') {
				$image_attr_val = $result->post_excerpt;
			} else {
				$image_attr_val = $result->post_title;
			}
		}
		if ($print == true) {
			echo sprintf(__('%s', 'entrada'), $image_attr_val);
		} else {
			return $image_attr_val;
		}
	}
}

/* Count total products
............................... */
if (!function_exists('entrada_count_total_post')) {
	function entrada_count_total_post($post_type, $property = 'publish')
	{
		$count_posts = wp_count_posts('product');
		$count 		 = $count_posts->$property;
		return $count;
	}
}

if (!function_exists('entrada_truncate')) {
	function entrada_truncate($input, $maxWords, $maxChars, $input_type = 'string')
	{
		if ('id' == $input_type) {
			$content_post   = get_post($input);
			$content        = $content_post->post_content;
			$content        = apply_filters('the_content', $content);
			$content        = str_replace(']]>', ']]&gt;', $content);
		} else {
			$content = $input;
		}
		$output = wp_trim_words($content, $maxWords, $more = null);
		return $output;
	}
}

if (!function_exists('entrada_truncate_comment')) {
	function entrada_truncate_comment($input, $maxWords, $maxChars)
	{
		$content = strip_tags(get_comment_text($input));
		$output  = wp_trim_words($content, $maxWords, $more = null);
		return $output;
	}
}

if (!function_exists('entrada_random_integer')) {
	function entrada_random_integer($string_type = 'string', $id_length = 20)
	{
		if ($string_type == 'int') {
			$str_result = "0123456789";
		} else {
			$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		}

		return substr(str_shuffle($str_result), 0, $id_length);
	}
}

/* Front Page Login
............................ */
if (!function_exists('entrada_LoginUser')) {
	function entrada_LoginUser()
	{
		global $wpdb;
		global $error;
		$response_arr 	= array();
		$email 			= $_POST['login_username'];
		$login_password = $_POST['login_password'];
		$remember_me = 1;
		if (is_email($email)) {
			$querystr = "SELECT * FROM " . $wpdb->prefix . "users WHERE user_email = '$email' ";
			$userinfo = $wpdb->get_row($querystr);
			if (count($userinfo) > 0) {
				$user_name = $userinfo->user_login;
			} else {
				$user_name = '';
			}
		} else {
			$user_name = $email;
		}
		$user = wp_signon(array('user_login' => $user_name, 'user_password' => trim($login_password), 'remember' => $remember_me), false);
		if (is_wp_error($user)) {
			echo '[{"response":"error","msg":"' . __('<strong>ERROR</strong>: Invalid username or password', 'entrada') . '"}]';
			exit;
		} else {
			echo '[{"response":"success","msg":"' . __('<strong>Login success!</strong> Please wait while page is being redirected...', 'entrada') . '"}]';
			exit;
		}
	}
}
add_action('wp_ajax_entrada_LoginUser', 'entrada_LoginUser');
add_action('wp_ajax_nopriv_entrada_LoginUser', 'entrada_LoginUser');

/* User Register
............................. */
if (!function_exists('entrada_getRegister')) {
	function entrada_getRegister()
	{
		global $wpdb;
		$msg_arr 	= array();
		$entry_date = date('Y-m-d h:i:s', time());
		$user_email = $_POST['reg_email'];
		$userdata 	= array(
			'user_email' 	=> $user_email,
			'role' 			=> get_option('default_role'),
		);
		if (!is_email($userdata['user_email'])) {
			$msg_arr['response'] = "error";
			$msg_arr['msg'] = __('<strong>Sorry,</strong> You must enter a valid email address.', 'entrada');
		} else if (username_exists($_POST['reg_username'])) {
			$msg_arr['response'] = "error";
			$msg_arr['msg'] = __('<strong>Sorry,</strong> that username is already registered!', 'entrada');
		} else if ((email_exists($userdata['user_email']))) {
			$msg_arr['response'] = "error";
			$msg_arr['msg'] = __('<strong>Sorry,</strong> that email address is already registered!', 'entrada');
		} else {
			$fname = $_POST['reg_fname'];
			$lname = $_POST['reg_lname'];
			$user_password = $_POST['reg_password'];
			$user_role = 'subscriber';
			$user_login = $_POST['reg_username'];
			$userdata = array(
				'user_login'	=> $user_login,
				'user_pass' 	=> $user_password,
				'first_name' 	=> $fname,
				'last_name' 	=> $lname,
				'user_email' 	=> $user_email,
				'role'			=> $user_role
			);
			$new_user = wp_insert_user($userdata);
			$msg_arr['user_id'] = $new_user;
			$msg_arr['response'] = "success";
			$msg_arr['msg'] = __('<strong>Congratulations!</strong>, your registration has been successfull.', 'entrada');
		}
		echo json_encode($msg_arr);
		exit;
	}
}
add_action('wp_ajax_entrada_getRegister', 'entrada_getRegister');
add_action('wp_ajax_nopriv_entrada_getRegister', 'entrada_getRegister');

/* Save To Wishlist
............................... */
if (!function_exists('entrada_SaveToWishlist')) {
	function entrada_SaveToWishlist()
	{
		global $wpdb;
		$msg_arr 		= array();
		$post_id 		= $_POST['post_id'];
		$wishlist_add 	= array('post_id' => $_POST['post_id']);
		$sql 			= "SELECT * FROM " . $wpdb->prefix . "entrada_wishlist where post_id=" . $post_id;
		if (is_user_logged_in()) {
			$current_user = wp_get_current_user();
			$sql .= " and user_id=" . $current_user->ID;
			$wishlist_add['user_id'] = $current_user->ID;
		} else if (isset($_COOKIE['guest_user'])) {
			$sql .= " and guest_id= '" . $_COOKIE['guest_user'] . "'";
			$wishlist_add['guest_id'] = $_COOKIE['guest_user'];
		} else {

			$sql .= " and guest_id= '" . $GLOBALS['guest_user'] . "'";
			$wishlist_add['guest_id'] = $GLOBALS['guest_user'];
		}


		$result_seelct = $wpdb->get_row($sql);
		if ($result_seelct) {
			$wpdb->query("delete from " . $wpdb->prefix . "entrada_wishlist where id=" . $result_seelct->id);
			$msg_arr['response'] = 'deleted';
		} else {
			$wpdb->insert($wpdb->prefix . 'entrada_wishlist', $wishlist_add);
			$msg_arr['response'] = 'saved';
		}
		echo json_encode($msg_arr, true);
		exit;
	}
}
add_action('wp_ajax_entrada_SaveToWishlist', 'entrada_SaveToWishlist');
add_action('wp_ajax_nopriv_entrada_SaveToWishlist', 'entrada_SaveToWishlist');

if (!function_exists('entrada_wishlist_html')) {
	function entrada_wishlist_html($post_id)
	{
		global $wpdb;
		$html = '';
		if (empty($post_id)) {
			return '';
		}
		$table_name = $wpdb->prefix . 'entrada_wishlist';
		if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
			return '';
		}

		$sql = "SELECT * FROM " . $wpdb->prefix . "entrada_wishlist where post_id=" . $post_id;
		if (is_user_logged_in()) {
			$current_user = wp_get_current_user();
			$sql .= " and user_id=" . $current_user->ID;
		} else if (isset($_COOKIE['guest_user'])) {
			$sql .= " and guest_id=" . $_COOKIE['guest_user'];
		} else {
			$sql .= " and guest_id=" . $GLOBALS['guest_user'];
		}

		$result_seelct = $wpdb->get_row($sql);
		if ($result_seelct) {
			$html .= '<a href="javascript:void(null);" onClick="save_wishlist(' . $post_id . ');" id="wishlistId_' . $post_id . '"><span class="icon-remove-favourite"></span></a>';
		} else {
			$html .= '<a href="javascript:void(null);" onClick="save_wishlist(' . $post_id . ');" id="wishlistId_' . $post_id . '"><span class="icon-favs"></span></a>';
		}
		return $html;
	}
}


if (!function_exists('entrada_account_menu_panel_nav')) {
	function entrada_account_menu_panel_nav()
	{

		$items = array();
		$items['dashboard'] = __('Dashboard',  'entrada');

		$orders_endpoint = get_option('woocommerce_myaccount_orders_endpoint');
		if (!empty($orders_endpoint)) {
			$items[$orders_endpoint] = __('Orders',  'entrada');
		}

		$downloads_endpoint = get_option('woocommerce_myaccount_downloads_endpoint');
		if (!empty($downloads_endpoint)) {
			$items[$downloads_endpoint] = __('Downloads',  'entrada');
		}

		$edit_address_endpoint = get_option('woocommerce_myaccount_edit_address_endpoint');
		if (!empty($edit_address_endpoint)) {
			$items[$edit_address_endpoint] = __('Addresses',  'entrada');
		}

		$payment_methods_endpoint = get_option('woocommerce_myaccount_payment_methods_endpoint');
		if (!empty($payment_methods_endpoint)) {
			$items[$payment_methods_endpoint] = __('Payment Methods',  'entrada');
		}

		$edit_account_endpoint = get_option('woocommerce_myaccount_edit_account_endpoint');
		if (!empty($edit_account_endpoint)) {
			$items[$edit_account_endpoint] = __('Account Details',  'entrada');
		}

		$items['wishlist'] = __('Wishlist',  'entrada');

		if (class_exists('WC_Vendors')) {
			$user = wp_get_current_user();
			if (in_array('vendor', (array) $user->roles)) {
				$items['vendor-dashboard'] = __('Vendor Dashboard',  'entrada');
			}
		}

		$logout_endpoint = get_option('woocommerce_logout_endpoint');
		if (!empty($logout_endpoint)) {
			$items[$logout_endpoint] = __('Logout',  'entrada');
		}

		return $items;
	}
}
add_filter('woocommerce_account_menu_items', 'entrada_account_menu_panel_nav');

/* Wishlist : Create endpoint
............................... */
if (!function_exists('entrada_add_endpoint')) {
	function entrada_add_endpoint()
	{
		add_rewrite_endpoint('wishlist', EP_ROOT | EP_PAGES);
		add_rewrite_endpoint('vendor-dashboard', EP_ROOT | EP_PAGES);
	}
}
add_action('init', 'entrada_add_endpoint');

if (!function_exists('vendor_dashboard_endpoint_content')) {
	function vendor_dashboard_endpoint_content()
	{
		wc_get_template('woocommerce/myaccount/vendor_dashboard.php');
	}
}
add_action('woocommerce_account_vendor-dashboard_endpoint', 'vendor_dashboard_endpoint_content');

if (!function_exists('wishlist_endpoint_content')) {
	function wishlist_endpoint_content()
	{
		wc_get_template('woocommerce/myaccount/wishlist.php');
	}
}
add_action('woocommerce_account_wishlist_endpoint', 'wishlist_endpoint_content');

/* Subscribe into Mailchimp Account
...................................... */

/* Entrada Vote
.................................... */
if (!function_exists('entrada_vote_now')) {
	function entrada_vote_now()
	{
		global $wpdb;
		$response_arr 	= array();
		$poll_data 		= array();
		$ip 			= entrada_client_ip();
		if (entrada_check_duplicate_vote($_POST['question_id'], $ip) == 0) {
			$poll_data['question_id'] 		= $_POST['question_id'];
			$poll_data['vote'] 				= $_POST['poll_answer'];
			$poll_data['ip'] 				= $ip;
			$wpdb->insert($wpdb->prefix . 'poll_answer', $poll_data);
			$response_arr['response'] 		= 'success';
			$response_arr['message'] 		= __('Thank you for voting.',  'entrada');
			$response_arr['poll_result'] 	= entrada_poll_result($_POST['question_id']);
		} else {
			$response_arr['response'] 	= 'error';
			$response_arr['message'] 	= __('You already voted or you are not allowed to vote.',  'entrada');
		}
		echo json_encode($response_arr, true);
		exit;
	}
}
add_action('wp_ajax_entrada_vote_now', 'entrada_vote_now');
add_action('wp_ajax_nopriv_entrada_vote_now', 'entrada_vote_now');

if (!function_exists('entrada_check_duplicate_vote')) {
	function entrada_check_duplicate_vote($question_id, $ip)
	{
		global $wpdb;
		$sql 		= "select COUNT(*) from " . $wpdb->prefix . "poll_answer where 1=1 and question_id =" . $question_id . " and ip='" . $ip . "'";
		$rowcount 	= $wpdb->get_var($sql);
		return $rowcount;
	}
}

if (!function_exists('entrada_active_poll')) {
	function entrada_active_poll()
	{
		$widget_entrada_poll_widget = get_option('widget_entrada_poll_widget');
		$active_poll 				= maybe_unserialize($widget_entrada_poll_widget);
		if (array_key_exists(2, $active_poll)) {
			if (array_key_exists('poll_id', $active_poll[2])) {
				return $active_poll[2]['poll_id'];
			} else {
				return '';
			}
		}
		return '';
	}
}

if (!function_exists('entrada_poll_result')) {
	function entrada_poll_result($question_id)
	{
		global $wpdb;
		$option_index 	= 0;
		$html 			= '<div class="poll-result-holder">';
		$total_vote 	= entrada_count_poll_option_result($question_id, '');
		$sql 			= "SELECT * FROM " . $wpdb->prefix . "polls where 1=1 and id =" . $question_id;
		$result_seelct 	= $wpdb->get_row($sql);
		$result_seelct->poll_options;
		$poll_options 	= explode('%%', $result_seelct->poll_options);
		if (count($poll_options) > 0) {
			foreach ($poll_options as $opt) {
				$option_index++;
				$option_vote 			= entrada_count_poll_option_result($question_id, $option_index);
				$option_vote_percentage = entrada__poll_option_vote_percentage($total_vote, $option_vote);
				$html .= '<div class="progress">
							<div class="progress-bar" role="progressbar" aria-valuenow="' . $option_vote_percentage . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $option_vote_percentage . '%;">
							<span class="value">' . $option_vote_percentage . '%</span>
							</div>
						</div>';
				$html .= '<strong class="title">' . $opt . '</strong>';
			}
		}

		$html .= sprintf(__('<p> Based on total %s  votes.</p>', 'entrada'), $total_vote);
		$html .= '</div>';
		return $html;
	}
}

if (!function_exists('entrada__poll_option_vote_percentage')) {
	function entrada__poll_option_vote_percentage($total_vote, $option_vote)
	{
		if ($total_vote == 0) {
			return 0;
		}
		return round(($option_vote / $total_vote) * 100);
	}
}

if (!function_exists('entrada_count_poll_option_result')) {
	function entrada_count_poll_option_result($question_id, $option_index = '')
	{
		global $wpdb;
		$sql = "select COUNT(*) from " . $wpdb->prefix . "poll_answer where 1 = 1 and question_id = " . $question_id;
		if (!empty($option_index)) {
			$sql .= " and vote = " . $option_index;
		}
		$rowcount = $wpdb->get_var($sql);
		return $rowcount;
	}
}

/* Function to get the client ip address
............................................. */
if (!function_exists('entrada_client_ip')) {
	function entrada_client_ip()
	{
		$ip = '';
		if (class_exists('WooCommerce')) {
			$e = new WC_Geolocation();
			$ip = $e->get_ip_address();
		}

		return $ip;
	}
}

/* Ajax call to font variants
.................................... */
if (!function_exists('entrada_font_variant')) {
	function entrada_font_variant()
	{
		$font 				= $_POST['font'];
		$value 				= array();
		$value['variant'] 	= '<select>';
		$value['variant']  .= '<option value="">Select font weight</option>';
		if (false === get_transient('google_fonts_variant_lists')) { } else {
			$variant_lists = get_transient('google_fonts_variant_lists');
			foreach ($variant_lists as $fontname => $variants) {
				if ($font == $fontname) {
					foreach ($variants as $v) {
						$value['variant'] .= '<option value="' . $fontname . ':' . $v . '">' . $v . '</option>';
					}
				}
			}
		}
		$value['variant'] .= '</select>';
		echo json_encode($value);
		exit;
	}
}
add_action('wp_ajax_entrada_font_variant', 'entrada_font_variant');
add_action('wp_ajax_nopriv_entrada_font_variant', 'entrada_font_variant');

if (!function_exists('entrada_footer')) {
	function entrada_footer()
	{ ?>
			<script type="text/javascript">
				/* Wishlist ................*/
				function remove_wishlist(post_id) {
					jQuery.ajax({
						type: "POST",
						dataType: "json",
						url: "<?php echo admin_url('admin-ajax.php'); ?>",
						data: {
							'action': 'entrada_SaveToWishlist',
							'post_id': post_id
						},
						success: function(data) {
							location.reload(true);
						}
					});
				}
			</script>
		<?php
			}
		}
		add_action('wp_footer', 'entrada_footer', 100);

		/* Entrada Monthname  */
		if (!function_exists('entrada_month_name')) {
			function entrada_month_name($index, $y)
			{
				global $entrada_locale, $month_short_name;
				$date_formate = '';
				if (array_key_exists($entrada_locale, $month_short_name)) {
					$date_formate = $month_short_name[$entrada_locale][$index - 1] . ' ' . $y;
				} else {
					$date_formate = date('M', mktime(0, 0, 0, $index, 10))  . ' ' . $y;
				}

				return $date_formate;
			}
		}

		/* Header Search Date selector */
		if (!function_exists('entrada_header_dateform_selector')) {
			function entrada_header_dateform_selector($date_for = '')
			{
				$html = '';

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

					$start_date_val = date('Y-m', strtotime($entrada_month_year_date)) . '-' . $start_day;
					$end_date_val =  date('Y-m-t', strtotime($entrada_month_year_date));

					$y = date('Y', strtotime($entrada_month_year_date));
					$index = date('n', strtotime($entrada_month_year_date));

					$entrada_start_date_month_year_arr[$start_date_val] = entrada_month_name($index, $y);
					$entrada_end_date_month_year_arr[$end_date_val] = entrada_month_name($index, $y);
				}

				switch ($date_for) {

					case 'start_date':

						if (get_theme_mod('search_filter_date_option_setting') == 'monthyear_seelctbox') {

							$html .= '<select class="trip trip-banner" id="start_date_month_year" name="start_date">';
							$html .= '<option value="">' . __('Any Date', 'entrada') . '</option>';
							$html .= '<option value="">' . __('Any Date', 'entrada') . '</option>';

							if ($entrada_start_date_month_year_arr) {
								foreach ($entrada_start_date_month_year_arr as $key => $value) {
									$html .= '<option value="' . $key . '">' . $value . '</option>';
								}
							}

							$html .= '</select>';
						} else {

							$html .= '<div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
								<input class="form-control" name="start_date" placeholder="' . __('DEPARTURE', 'entrada') . '" type="text" readonly />
								<span class="input-group-addon"><i class="icon-drop"></i></span>
							</div>';
						}

						break;

					default:

						if (get_theme_mod('search_filter_date_option_setting') == 'monthyear_seelctbox') {

							$html .= '<select class="trip trip-banner" id="end_date_month_year" name="end_date">';
							$html .= '<option value="">' . __('Any Date', 'entrada') . '</option>';
							$html .= '<option value="">' . __('Any Date', 'entrada') . '</option>';

							if ($entrada_end_date_month_year_arr) {
								foreach ($entrada_end_date_month_year_arr as $key => $value) {
									$html .= '<option value="' . $key . '">' . $value . '</option>';
								}
							}

							$html .= '</select>';
						} else {

							$html .= '<div id="datepicker1" class="input-group date" data-date-format="yyyy-mm-dd">
							 <input class="form-control"  name="end_date"  placeholder="' . __('ARRIVAL', 'entrada') . '" type="text" readonly />
							 <span class="input-group-addon"><i class="icon-drop"></i></span>
						 </div>';
						}
				}

				return $html;
			}
		}

		/* Wrapper width
.................................... */
		if (!function_exists('entrada_wrapper_width')) {
			function entrada_wrapper_width()
			{
				$wrapper_width = 'col-sm-12 col-md-12';

				if (is_active_sidebar('sidebar-1')) {
					$wrapper_width = 'col-sm-8 col-md-9';
				}
				return $wrapper_width;
			}
		}

		/* Description width
.................................... */
		if (!function_exists('entrada_description_width')) {
			function entrada_description_width()
			{
				$description_width = 'description full-width-description';

				if (is_active_sidebar('sidebar-1')) {
					$description_width = 'description';
				}
				return $description_width;
			}
		}


		/* Entrada unfiltered uploads
.................................... */
		if (!function_exists('entrada_unfiltered_uploads')) {
			function entrada_unfiltered_uploads()
			{
				define('ALLOW_UNFILTERED_UPLOADS', true);
			}
		}

		add_action('admin_init', 'entrada_unfiltered_uploads');

		?>