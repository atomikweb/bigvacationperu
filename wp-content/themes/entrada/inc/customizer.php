<?php

/**
 * Entrada Theme Customizer.
 *
 * @package Entrada
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
require_once dirname(__FILE__) . '/entrada-google-font-dropdown-custom-control.php';
require_once dirname(__FILE__) . '/entrada-google-fontvariants-dropdown-custom-control.php';
function entrada_customize_register($wp_customize)
{
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
}
add_action('customize_register', 'entrada_customize_register');

/* Custom customizer start here
:::::::::::::::::::::::::::::::::::::::::::::  */

function entrada_customizer_settings($wp_customize)
{

	/* Add Customizer Panel here
	  ...............................  */
	$wp_customize->add_panel('entrada_header_setting_panel', array(
		'capability' 		=> 'edit_theme_options',
		'theme_supports' 	=> '',
		'title' 			=> __('Header', 'entrada'),
		'description' 		=> __('Header Settings', 'entrada'),
		'priority' 			=> 10,
	));

	$wp_customize->add_panel('entrada_basic_setting_panel', array(
		'capability' 		=> 'edit_theme_options',
		'theme_supports' 	=> '',
		'title' 			=> __('Basic Settings', 'entrada'),
		'description' 		=> __('Update Basic Settings', 'entrada'),
	));

	$wp_customize->add_panel('entrada_layout_setting_panel', array(
		'capability' 		=> 'edit_theme_options',
		'theme_supports' 	=> '',
		'title' 			=> __('Layout &amp; Designs', 'entrada'),
		'description' 		=> __('Update Layout', 'entrada'),
		'priority' 			=> 11,
	));

	$wp_customize->add_panel('entrada_typography_setting_panel', array(
		'capability' 		=> 'edit_theme_options',
		'theme_supports' 	=> '',
		'title' 			=> __('Typography', 'entrada'),
		'description' 		=> __('Update Typography Settings', 'entrada'),
		'priority' 			=> 12
	));
	$wp_customize->add_panel('entrada_button_setting_panel', array(
		'capability' 		=> 'edit_theme_options',
		'theme_supports' 	=> '',
		'title' 			=> __('Buttons &amp; Links', 'entrada'),
		'description' 		=> __('Update Button &amp; Link Settings', 'entrada'),
		'priority' 			=> 13
	));
	$wp_customize->add_panel('entrada_woocommerce_setting_panel', array(
		'capability'		=> 'edit_theme_options',
		'theme_supports' 	=> '',
		'title' 			=> __('Entrada WooCommerce', 'entrada'),
		'description' 		=> __('Update WooCommerce Settings', 'entrada'),
		'priority' 			=> 14
	));
	$wp_customize->add_panel('entrada_footer_setting_panel', array(
		'capability' 		=> 'edit_theme_options',
		'theme_supports' 	=> '',
		'title' 			=> __('Footer', 'entrada'),
		'description' 		=> __('Update Footer Settings', 'entrada'),
	));

	/* **************************** Header setting starts **************************** */
	/* Logo  Heading */
	$wp_customize->add_section(
		'section_logo',
		array(
			'title'       	=> __('Logo', 'entrada'),
			'description' 	=> __('Set text or an image as a logo.', 'entrada'),
			'panel'			=> 'entrada_header_setting_panel',
		)
	);

	$wp_customize->add_setting(
		'logo_text_image',
		array(
			'default' 			=> 'text',
			'sanitize_callback' => 'entrada_sanitize_choices',
		)
	);
	$wp_customize->add_control(
		'logo_text_image',
		array(
			'type'		=> 'radio',
			'label' 	=> __('Image or Text Logo', 'entrada'),
			'section' 	=> 'section_logo',
			'choices' 	=> array(
				'image'	=> 'Image',
				'text' 	=> 'Text'
			),
		)
	);

	/* logo image */
	$wp_customize->add_setting(
		'header_darkbg_logo',
		array(
			'default' 			=> get_template_directory_uri() . '/dist/images/logos/logo.svg',
			'sanitize_callback' => 'entrada_sanitize_url',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'header_darkbg_logo',
			array(
				'label'    => __('Logo for Dark Background', 'entrada'),
				'section'  => 'section_logo',
				'settings' => 'header_darkbg_logo',
			)
		)
	);

	$wp_customize->add_setting(
		'header_whitebg_logo',
		array(
			'default' 			=> get_template_directory_uri() . '/dist/images/logos/logo-gray.svg',
			'sanitize_callback' => 'entrada_sanitize_url',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'header_whitebg_logo',
			array(
				'label'    => __('Logo for White Background', 'entrada'),
				'section'  => 'section_logo',
				'settings' => 'header_whitebg_logo',
			)
		)
	);

	$wp_customize->add_setting(
		'header_logo_width',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_check_number',
		)
	);
	$wp_customize->add_control(
		'header_logo_width',
		array(
			'label'		=> __('Width (px)', 'entrada'),
			'description' => __('Width more than 210px is not recommended.', 'entrada'),
			'type'		=> 'text',
			'section'	=> 'section_logo',
			'settings'	=> 'header_logo_width',
		)
	);

	$wp_customize->add_setting(
		'header_logo_height',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_check_number',
		)
	);
	$wp_customize->add_control(
		'header_logo_height',
		array(
			'label'		=> __('Height (px)', 'entrada'),
			'description' => __('Height more than 80px is not recommended.', 'entrada'),
			'type'		=> 'text',
			'section'	=> 'section_logo',
			'settings'	=> 'header_logo_height',
		)
	);

	$wp_customize->add_setting(
		'header_logo_padding',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_check_number',
		)
	);
	$wp_customize->add_control(
		'header_logo_padding',
		array(
			'label'		=> __('Padding (px)', 'entrada'),
			'description' => __('Padding more than 10px is not recommended.', 'entrada'),
			'type'		=> 'text',
			'section'	=> 'section_logo',
			'settings'	=> 'header_logo_padding',
		)
	);

	/* logo text */
	$wp_customize->add_setting(
		'logo_text',
		array(
			'default'			=> get_bloginfo('name'),
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'logo_text',
		array(
			'label'		=> __('Logo', 'entrada'),
			'type'		=> 'text',
			'section'	=> 'section_logo',
			'settings'	=> 'logo_text',
		)
	);

	$wp_customize->add_setting(
		'google_font_setting["logo_font"]',
		array(
			'default'			=> 'Roboto',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Entrada_Google_Font_Dropdown_Custom_Control(
			$wp_customize,
			'google_font_logo',
			array(
				'label'   	=> __('Font Family', 'entrada'),
				'section'	=> 'section_logo',
				'settings'  => 'google_font_setting["logo_font"]',
			)
		)
	);

	$wp_customize->add_setting(
		'google_fontvariant_setting["logo_font"]',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Google_Fontvariants_Dropdown_Custom_Control(
			$wp_customize,
			'logo_google_fontvariant_setting',
			array(
				'label'   	=> __('Font Weight', 'entrada'),
				'section'	=> 'section_logo',
				'settings'  => 'google_fontvariant_setting["logo_font"]',
			)
		)
	);

	$wp_customize->add_setting(
		'logo_font_colour',
		array(
			'default' 			=> '#5c5e62',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'logo_font_colour',
			array(
				'label' 	=> __('Font Colour', 'entrada'),
				'section' 	=> 'section_logo',
				'settings' 	=> 'logo_font_colour'
			)
		)
	);

	$wp_customize->add_setting(
		'logo_font_size',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_check_number',
		)
	);

	$wp_customize->add_control(
		'logo_font_size',
		array(
			'label'		=> __('Font Size (px)', 'entrada'),
			'type'		=> 'text',
			'section'	=> 'section_logo',
			'settings'	=> 'logo_font_size',
		)
	);

	$wp_customize->add_setting(
		'logo_font_style',
		array(
			'default'			=> 'normal',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'logo_font_style',
		array(
			'label'		=> __('Font Style', 'entrada'),
			'type'		=> 'radio',
			'section'	=> 'section_logo',
			'settings'	=> 'logo_font_style',
			'choices' 	=> array(
				'normal' 	=> 'Normal',
				'italic'	=> 'Italic'
			),
		)
	);

	/* Nav Bar Section */
	$wp_customize->add_section(
		'section_header_navbar',
		array(
			'title' 		=> __('Nav Bar', 'entrada'),
			'description' 	=> __('Set header navbar settings.', 'entrada'),
			'panel'			=> 'entrada_header_setting_panel',
		)
	);

	/* Top bar */
	$wp_customize->add_setting(
		'navbar_top',
		array(
			'default'    		=> '',
			'sanitize_callback' => 'entrada_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'navbar_top',
			array(
				'label'     => __('Show Top Nav Bar', 'entrada'),
				'section'   => 'section_header_navbar',
				'settings'  => 'navbar_top',
				'type'      => 'checkbox',
			)
		)
	);

	$wp_customize->add_setting(
		'topbar_links_colour',
		array(
			'default' 			=> '#fff',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'topbar_links_colour',
			array(
				'label' 	=> __('Top Nav Bar Link Colour', 'entrada'),
				'section' 	=> 'section_header_navbar',
				'settings' 	=> 'topbar_links_colour'
			)
		)
	);

	$wp_customize->add_setting(
		'topbar_links_hover_colour',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'topbar_links_hover_colour',
			array(
				'label' 	=> __('Top Nav Bar Link Hover Colour', 'entrada'),
				'section' 	=> 'section_header_navbar',
				'settings' 	=> 'topbar_links_hover_colour'
			)
		)
	);

	$wp_customize->add_setting(
		'topbar_links_font_size',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_check_number',
		)
	);

	$wp_customize->add_control(
		'topbar_links_font_size',
		array(
			'label'		=> __('Top Nav Bar Link Font Size (px)', 'entrada'),
			'type'		=> 'text',
			'section'	=> 'section_header_navbar',
			'settings'	=> 'topbar_links_font_size',
		)
	);

	$wp_customize->add_setting(
		'topbar_phone',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'topbar_phone',
		array(
			'label'		=> __('Phone', 'entrada'),
			'type'		=> 'text',
			'section'	=> 'section_header_navbar',
			'settings'	=> 'topbar_phone',
		)
	);

	$wp_customize->add_setting(
		'topbar_email',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'topbar_email',
		array(
			'label'		=> __('Email', 'entrada'),
			'type'		=> 'text',
			'section'	=> 'section_header_navbar',
			'settings'	=> 'topbar_email',
		)
	);

	/* normal heading setting */
	$wp_customize->add_setting(
		'navbar_style',
		array(
			'default'			=> 'default_navbar',
			'sanitize_callback' => 'entrada_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'navbar_style',
		array(
			'label'		=> __('Nav Bar Style', 'entrada'),
			'type'		=> 'select',
			'section'	=> 'section_header_navbar',
			'settings'	=> 'navbar_style',
			'choices' 	=> array(
				'default_navbar'		=> 'Default Navbar',
				'centered_navbar'		=> 'Centered Navbar',
			),
		)
	);

	$wp_customize->add_setting(
		'navbar_property',
		array(
			'default'			=> 'white-header',
			'sanitize_callback' => 'entrada_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'navbar_property',
		array(
			'label'		=> __('Nav Bar Property', 'entrada'),
			'type'		=> 'select',
			'section'	=> 'section_header_navbar',
			'settings'	=> 'navbar_property',
			'choices' 	=> array(
				'white-header'			=> 'Transparent Navbar',
				'dark-header'			=> 'Dark Navbar',
				'default-white-header'	=> 'White Navbar',
			),
		)
	);

	$wp_customize->add_setting(
		'navbar_links_colour',
		array(
			'default' 			=> '#fff',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'navbar_links_colour',
			array(
				'label' 	=> __('Nav Bar Link Colour (Transparent Background)', 'entrada'),
				'section' 	=> 'section_header_navbar',
				'settings' 	=> 'navbar_links_colour'
			)
		)
	);

	$wp_customize->add_setting(
		'navbar_links_bg_colour',
		array(
			'default' 			=> '#5c5e62',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'navbar_links_bg_colour',
			array(
				'label' 	=> __('Nav Bar Link Colour (Non-Transparent Background)', 'entrada'),
				'section' 	=> 'section_header_navbar',
				'settings' 	=> 'navbar_links_bg_colour'
			)
		)
	);

	$wp_customize->add_setting(
		'navbar_links_hover_colour',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'navbar_links_hover_colour',
			array(
				'label' 	=> __('Nav Bar Link Hover Colour', 'entrada'),
				'section' 	=> 'section_header_navbar',
				'settings' 	=> 'navbar_links_hover_colour'
			)
		)
	);

	$wp_customize->add_setting(
		'google_font_setting["nav_bar"]',
		array(
			'default'			=> 'Montserrat',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Entrada_Google_Font_Dropdown_Custom_Control(
			$wp_customize,
			'google_font_nav_bar',
			array(
				'label'   	=> __('Nav Bar Font Family', 'entrada'),
				'section'	=> 'section_header_navbar',
				'settings'  => 'google_font_setting["nav_bar"]',
			)
		)
	);

	$wp_customize->add_setting(
		'google_fontvariant_setting["nav_bar"]',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Google_Fontvariants_Dropdown_Custom_Control(
			$wp_customize,
			'top_bar_google_fontvariant_setting',
			array(
				'label'   	=> __('Nav Bar Font Weight', 'entrada'),
				'section'	=> 'section_header_navbar',
				'settings'  => 'google_fontvariant_setting["nav_bar"]',
			)
		)
	);

	$wp_customize->add_setting(
		'navbar_links_font_size',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_check_number',
		)
	);

	$wp_customize->add_control(
		'navbar_links_font_size',
		array(
			'label'		=> __('Nav Bar Font Size (px)', 'entrada'),
			'type'		=> 'text',
			'section'	=> 'section_header_navbar',
			'settings'	=> 'navbar_links_font_size',
		)
	);

	$wp_customize->add_setting(
		'navbar_links_letter_spacing',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'navbar_links_letter_spacing',
		array(
			'label'		=> __('Nav Bar Letter Spacing (em)', 'entrada'),
			'type'		=> 'text',
			'section'	=> 'section_header_navbar',
			'settings'	=> 'navbar_links_letter_spacing',
		)
	);

	$wp_customize->add_setting(
		'navbar_links_uppercase',
		array(
			'default'    		=> 'upper_yes',
			'sanitize_callback' => 'entrada_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'navbar_links_uppercase',
			array(
				'label'     => __('Uppercase', 'entrada'),
				'section'   => 'section_header_navbar',
				'settings'  => 'navbar_links_uppercase',
				'type'      => 'checkbox',
			)
		)
	);

	$wp_customize->add_setting(
		'navbar_breadcrumb_onoff',
		array(
			'default'   		=> '1',
			'sanitize_callback' => 'entrada_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'navbar_breadcrumb_onoff',
			array(
				'label'     => __('Show Breadcrumb', 'entrada'),
				'section'   => 'section_header_navbar',
				'settings'  => 'navbar_breadcrumb_onoff',
				'type'      => 'checkbox',
			)
		)
	);

	/* Preloader Display */
	$wp_customize->add_section(
		'section_preloader',
		array(
			'title'       	=> __('Preloader Display', 'entrada'),
			'description' 	=> __('Enable or Disable the preloader.', 'entrada'),
			'panel'			=> 'entrada_header_setting_panel',
		)
	);

	$wp_customize->add_setting(
		'preloader_onoff',
		array(
			'default'			=> 'yes',
			'sanitize_callback' => 'entrada_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'preloader_onoff',
		array(
			'label'		=> __('Enable Preloader', 'entrada'),
			'type'		=> 'checkbox',
			'section'	=> 'section_preloader',
			'settings'	=> 'preloader_onoff',
		)
	);

	/* Google Analytics */
	$wp_customize->add_section(
		'section_google_analytics',
		array(
			'title' 	  => __('Google Analytics', 'entrada'),
			'description' => __('Set google analytics code.', 'entrada'),
			'panel'		  => 'entrada_header_setting_panel',
		)
	);

	$wp_customize->add_setting(
		'custom_google_analytics',
		array(
			'default' 			=> '',
			'sanitize_callback' => 'entrada_sanitize_analytics',
		)
	);

	$wp_customize->add_control(
		'custom_google_analytics',
		array(
			'label'		=> __('Google Analytics', 'entrada'),
			'section' 	=> 'section_google_analytics',
			'type' 		=> 'textarea',
			'settings'	=> 'custom_google_analytics',
		)
	);

	/* Search Type */
	$wp_customize->add_section(
		'section_search_option_setting',
		array(
			'title'       	=> __('Search Option', 'entrada'),
			'description' 	=> __('Set search option.', 'entrada'),
			'panel'			=> 'entrada_header_setting_panel',
		)
	);

	$wp_customize->add_setting(
		'search_option',
		array(
			'default' 			=> 'tour-search',
			'sanitize_callback' => 'entrada_sanitize_choices',
		)
	);
	$wp_customize->add_control(
		'search_option',
		array(
			'type'		=> 'radio',
			'label' 	=> __('Search Option', 'entrada'),
			'section' 	=> 'section_search_option_setting',
			'choices' 	=> array(
				'site-search' => 'Site Search',
				'tour-search' => 'Tour Search'
			),
		)
	);

	/* ***************** Layout setting start here ************************** */
	/* site layout */
	$wp_customize->add_section(
		'section_site_layout_setting',
		array(
			'title' 		=> __('Site Layout', 'entrada'),
			'description' 	=> __('Set site layout settings.', 'entrada'),
			'panel' 		=> 'entrada_layout_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'sitelayout_onoff',
		array(
			'default'			=> 'wide',
			'sanitize_callback' => 'entrada_sanitize_select',
		)
	);
	$wp_customize->add_control(
		'sitelayout_onoff',
		array(
			'type' 		=> 'radio',
			'label' 	=> __('Site Layout', 'entrada'),
			'section' 	=> 'section_site_layout_setting',
			'choices' 	=> array(
				'wide' 	=> 'Wide',
				'boxed' => 'Boxed'
			),
		)
	);

	/* if boxed option chosen */
	$wp_customize->add_setting(
		'sitelayout_boxed_option',
		array(
			'default'			=> 'bckcolour',
			'sanitize_callback' => 'entrada_sanitize_choices',
		)
	);
	$wp_customize->add_control(
		'sitelayout_boxed_option',
		array(
			'type' 		=> 'radio',
			'label' 	=> __('Background Options', 'entrada'),
			'section' 	=> 'section_site_layout_setting',
			'choices' 	=> array(
				'bckcolour' 	=> 'Colour',
				'bckimage' 		=> 'Image',
				'bckpattern'	=> 'Pattern',
			),
		)
	);

	/* background layout inside site layout */
	$wp_customize->add_setting(
		'bckgrd_bckcolour',
		array(
			'default' 			=> '#6b6957',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'bckgrd_bckcolour',
			array(
				'label' 	=> __('Background Colour', 'entrada'),
				'section' 	=> 'section_site_layout_setting',
				'settings' 	=> 'bckgrd_bckcolour'
			)
		)
	);

	$wp_customize->add_setting(
		'bckgrd_bckimage',
		array(
			'default' 			=> get_template_directory_uri() . '/dist/images/footer/footer-pattern.png',
			'sanitize_callback' => 'entrada_sanitize_url',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'bckgrd_bckimage',
			array(
				'label'    => __('Background Image', 'entrada'),
				'section'  => 'section_site_layout_setting',
				'settings' => 'bckgrd_bckimage',
			)
		)
	);

	$wp_customize->add_setting(
		'bckgrd_bckpattern',
		array(
			'default' 			=> get_template_directory_uri() . '/dist/images/footer/footer-pattern.png',
			'sanitize_callback' => 'entrada_sanitize_url',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'bckgrd_bckpattern',
			array(
				'label'    => __('Background Pattern', 'entrada'),
				'section'  => 'section_site_layout_setting',
				'settings' => 'bckgrd_bckpattern',
			)
		)
	);

	/* *****************  Main Colours ***************  */

	$wp_customize->add_section(
		'entrada_section_select_color_setting',
		array(
			'title' 		=> __('Main Colours', 'entrada'),
			'description' 	=> __('Set layout color settings.', 'entrada'),
			'panel' 		=> 'entrada_layout_setting_panel'
		)
	);

	/* Neutral Colour */
	$wp_customize->add_setting(
		'entrada_neutral_colour',
		array(
			'default' 			=> '#252525',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_neutral_colour',
			array(
				'label' 	=> __('Neutral Colour', 'entrada'),
				'section' 	=> 'entrada_section_select_color_setting',
				'settings' 	=> 'entrada_neutral_colour'
			)
		)
	);

	/* Primary Colour */
	$wp_customize->add_setting(
		'entrada_primary_colour',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_primary_colour',
			array(
				'label' 	=> __('Primary Colour', 'entrada'),
				'section' 	=> 'entrada_section_select_color_setting',
				'settings' 	=> 'entrada_primary_colour'
			)
		)
	);

	/* Secondary Colour */
	$wp_customize->add_setting(
		'entrada_secondary_colour',
		array(
			'default' 			=> '#474d4b',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_secondary_colour',
			array(
				'label' 	=> __('Secondary Colour', 'entrada'),
				'section' 	=> 'entrada_section_select_color_setting',
				'settings' 	=> 'entrada_secondary_colour'
			)
		)
	);

	/* Tertiary Colour */
	$wp_customize->add_setting(
		'entrada_tertiary_colour',
		array(
			'default' 			=> '#6b6957',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_tertiary_colour',
			array(
				'label' 	=> __('Tertiary Colour', 'entrada'),
				'section' 	=> 'entrada_section_select_color_setting',
				'settings' 	=> 'entrada_tertiary_colour'
			)
		)
	);

	/* Quaternary Colour */
	$wp_customize->add_setting(
		'entrada_quaternary_colour',
		array(
			'default' 			=> '#565335',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_quaternary_colour',
			array(
				'label' 	=> __('Quaternary Colour', 'entrada'),
				'section' 	=> 'entrada_section_select_color_setting',
				'settings' 	=> 'entrada_quaternary_colour'
			)
		)
	);

	/* Faternary Colour */
	$wp_customize->add_setting(
		'entrada_faternary_colour',
		array(
			'default' 			=> '#c02127',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_faternary_colour',
			array(
				'label' 	=> __('Faternary Colour', 'entrada'),
				'section' 	=> 'entrada_section_select_color_setting',
				'settings' 	=> 'entrada_faternary_colour'
			)
		)
	);

	/* *****************  Search Block Colours ***************  */

	$wp_customize->add_section(
		'entrada_section_search_block',
		array(
			'title' 		=> __('Search Block', 'entrada'),
			'description' 	=> __('Set search block settings.', 'entrada'),
			'panel' 		=> 'entrada_layout_setting_panel'
		)
	);

	/* Search Block Background Options */

	$wp_customize->add_setting(
		'searchbox_bg_onoff',
		array(
			'default'			=> 'on',
			'sanitize_callback' => 'entrada_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'searchbox_bg_onoff',
		array(
			'label'		=> __('Enable Searchbox Background Options', 'entrada'),
			'type'		=> 'checkbox',
			'section'	=> 'entrada_section_search_block',
			'settings'	=> 'searchbox_bg_onoff',
		)
	);

	$wp_customize->add_setting(
		'entrada_search_block_background',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_search_block_background',
			array(
				'label' 	=> __('Background Colour', 'entrada'),
				'section' 	=> 'entrada_section_search_block',
				'settings' 	=> 'entrada_search_block_background'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_search_block_border',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_search_block_border',
			array(
				'label' 	=> __('Border Colour', 'entrada'),
				'section' 	=> 'entrada_section_search_block',
				'settings' 	=> 'entrada_search_block_border'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_search_block_box_shadow',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_search_block_box_shadow',
			array(
				'label' 	=> __('Box Shadow Colour', 'entrada'),
				'section' 	=> 'entrada_section_search_block',
				'settings' 	=> 'entrada_search_block_box_shadow'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_search_block_label',
		array(
			'default' 			=> '#fff',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_search_block_label',
			array(
				'label' 	=> __('Label Colour', 'entrada'),
				'section' 	=> 'entrada_section_search_block',
				'settings' 	=> 'entrada_search_block_label'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_search_block_text',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_search_block_text',
			array(
				'label' 	=> __('Text Colour', 'entrada'),
				'section' 	=> 'entrada_section_search_block',
				'settings' 	=> 'entrada_search_block_text'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_search_block_calendar_icon',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_search_block_calendar_icon',
			array(
				'label' 	=> __('Calendar Icon Colour', 'entrada'),
				'section' 	=> 'entrada_section_search_block',
				'settings' 	=> 'entrada_search_block_calendar_icon'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_search_block_arrow',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_search_block_arrow',
			array(
				'label' 	=> __('Arrow Colour', 'entrada'),
				'section' 	=> 'entrada_section_search_block',
				'settings' 	=> 'entrada_search_block_arrow'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_search_block_select_bg',
		array(
			'default' 			=> '#252525',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_search_block_select_bg',
			array(
				'label' 	=> __('Background Colour', 'entrada'),
				'section' 	=> 'entrada_section_search_block',
				'settings' 	=> 'entrada_search_block_select_bg'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_search_block_dropdown_bg',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_search_block_dropdown_bg',
			array(
				'label' 	=> __('Dropdown Background Colour', 'entrada'),
				'section' 	=> 'entrada_section_search_block',
				'settings' 	=> 'entrada_search_block_dropdown_bg'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_search_block_dropdown_bg_hover',
		array(
			'default' 			=> '#0c0c0c',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_search_block_dropdown_bg_hover',
			array(
				'label' 	=> __('Dropdown Background Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_search_block',
				'settings' 	=> 'entrada_search_block_dropdown_bg_hover'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_search_block_dropdown_text',
		array(
			'default' 			=> '#fff',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_search_block_dropdown_text',
			array(
				'label' 	=> __('Dropdown Text Colour', 'entrada'),
				'section' 	=> 'entrada_section_search_block',
				'settings' 	=> 'entrada_search_block_dropdown_text'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_search_block_dropdown_text_hover',
		array(
			'default' 			=> '#fff',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_search_block_dropdown_text_hover',
			array(
				'label' 	=> __('Dropdown Text Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_search_block',
				'settings' 	=> 'entrada_search_block_dropdown_text_hover'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_search_block_button_bg',
		array(
			'default' 			=> '#252525',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_search_block_button_bg',
			array(
				'label' 	=> __('Button Background Colour', 'entrada'),
				'section' 	=> 'entrada_section_search_block',
				'settings' 	=> 'entrada_search_block_button_bg'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_search_block_button_hover_bg',
		array(
			'default' 			=> '#4f4d40',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_search_block_button_hover_bg',
			array(
				'label' 	=> __('Button Hover Background Colour', 'entrada'),
				'section' 	=> 'entrada_section_search_block',
				'settings' 	=> 'entrada_search_block_button_hover_bg'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_search_block_button',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_search_block_button',
			array(
				'label' 	=> __('Button Text Colour', 'entrada'),
				'section' 	=> 'entrada_section_search_block',
				'settings' 	=> 'entrada_search_block_button'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_search_block_button_hover',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_search_block_button_hover',
			array(
				'label' 	=> __('Button Text Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_search_block',
				'settings' 	=> 'entrada_search_block_button_hover'
			)
		)
	);

	/* *****************  Icon Colours ***************  */

	$wp_customize->add_section(
		'entrada_section_icon_color_setting',
		array(
			'title' 		=> __('Icon Bar Colour', 'entrada'),
			'description' 	=> __('Set icon bar colour settings.', 'entrada'),
			'panel' 		=> 'entrada_layout_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'entrada_icon_color',
		array(
			'default' 			=> '#9d9d9d',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_icon_color',
			array(
				'label' 	=> __('Icon Colour', 'entrada'),
				'section' 	=> 'entrada_section_icon_color_setting',
				'settings' 	=> 'entrada_icon_color'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_icon_text_color',
		array(
			'default' 			=> '#9d9d9d',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_icon_text_color',
			array(
				'label' 	=> __('Text Colour', 'entrada'),
				'section' 	=> 'entrada_section_icon_color_setting',
				'settings' 	=> 'entrada_icon_text_color'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_icon_hover_color',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_icon_hover_color',
			array(
				'label' 	=> __('Icon Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_icon_color_setting',
				'settings' 	=> 'entrada_icon_hover_color'
			)
		)
	);
	$wp_customize->add_setting(
		'entrada_icon_text_hover_color',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_icon_text_hover_color',
			array(
				'label' 	=> __('Text Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_icon_color_setting',
				'settings' 	=> 'entrada_icon_text_hover_color'
			)
		)
	);

	/* *****************  Category Gallery Colours ***************  */

	$wp_customize->add_section(
		'entrada_section_cat_gallery_color_setting',
		array(
			'title' 		=> __('Gallery Colours', 'entrada'),
			'description' 	=> __('Set category gallery colour settings.', 'entrada'),
			'panel' 		=> 'entrada_layout_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'entrada_icon_hover_bg_color',
		array(
			'default' 			=> '#474d4b',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_icon_hover_bg_color',
			array(
				'label' 	=> __('Background Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_cat_gallery_color_setting',
				'settings' 	=> 'entrada_icon_hover_bg_color'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_cat_gllery_icon_hover_color',
		array(
			'default' 			=> '#fff',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_cat_gllery_icon_hover_color',
			array(
				'label' 	=> __('Icon Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_cat_gallery_color_setting',
				'settings' 	=> 'entrada_cat_gllery_icon_hover_color'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_cat_gallery_text_hover_color',
		array(
			'default' 			=> '#fff',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_cat_gallery_text_hover_color',
			array(
				'label' 	=> __('Text Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_cat_gallery_color_setting',
				'settings' 	=> 'entrada_cat_gallery_text_hover_color'
			)
		)
	);

	/* *****************  Call to Action Block Colours ***************  */

	$wp_customize->add_section(
		'entrada_section_call_to_action',
		array(
			'title' 		=> __('Call to Action Block', 'entrada'),
			'description' 	=> __('Set call to action block colour settings.', 'entrada'),
			'panel' 		=> 'entrada_layout_setting_panel'
		)
	);
	/* Background */
	$wp_customize->add_setting(
		'entrada_call_to_action_background',
		array(
			'default' 			=> '#252525',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_call_to_action_background',
			array(
				'label' 	=> __('Background Colour', 'entrada'),
				'section' 	=> 'entrada_section_call_to_action',
				'settings' 	=> 'entrada_call_to_action_background'
			)
		)
	);
	/* Border */
	$wp_customize->add_setting(
		'entrada_call_to_action_border',
		array(
			'default' 			=> '#5f6865',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_call_to_action_border',
			array(
				'label' 	=> __('Border Colour', 'entrada'),
				'section' 	=> 'entrada_section_call_to_action',
				'settings' 	=> 'entrada_call_to_action_border'
			)
		)
	);


	/* *****************  Product Listing Colours ***************  */

	$wp_customize->add_section(
		'entrada_section_product_listing',
		array(
			'title' 		=> __('Product Listing', 'entrada'),
			'description' 	=> __('Set product listing view colour settings.', 'entrada'),
			'panel' 		=> 'entrada_layout_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'entrada_product_title_color',
		array(
			'default' 			=> '#474d4b',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_product_title_color',
			array(
				'label' 	=> __('Title Colour', 'entrada'),
				'section' 	=> 'entrada_section_product_listing',
				'settings' 	=> 'entrada_product_title_color'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_product_title_hover_color',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_product_title_hover_color',
			array(
				'label' 	=> __('Title Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_product_listing',
				'settings' 	=> 'entrada_product_title_hover_color'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_product_price',
		array(
			'default' 			=> '#474d4b',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_product_price',
			array(
				'label' 	=> __('Price Colour', 'entrada'),
				'section' 	=> 'entrada_section_product_listing',
				'settings' 	=> 'entrada_product_price'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_product_price_hover',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_product_price_hover',
			array(
				'label' 	=> __('Price Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_product_listing',
				'settings' 	=> 'entrada_product_price_hover'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_product_tag_hover',
		array(
			'default' 			=> '#474d4b',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_product_tag_hover',
			array(
				'label' 	=> __('Tag Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_product_listing',
				'settings' 	=> 'entrada_product_tag_hover'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_product_button',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_product_button',
			array(
				'label' 	=> __('Book Now Button Colour', 'entrada'),
				'section' 	=> 'entrada_section_product_listing',
				'settings' 	=> 'entrada_product_button'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_product_button_hover',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_product_button_hover',
			array(
				'label' 	=> __('Book Now Button Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_product_listing',
				'settings' 	=> 'entrada_product_button_hover'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_product_button_border',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_product_button_border',
			array(
				'label' 	=> __('Book Now Border Colour', 'entrada'),
				'section' 	=> 'entrada_section_product_listing',
				'settings' 	=> 'entrada_product_button_border'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_product_button_border_hover',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_product_button_border_hover',
			array(
				'label' 	=> __('Book Now Border Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_product_listing',
				'settings' 	=> 'entrada_product_button_border_hover'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_product_button_text',
		array(
			'default' 			=> '#fff',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_product_button_text',
			array(
				'label' 	=> __('Book Now Text Colour', 'entrada'),
				'section' 	=> 'entrada_section_product_listing',
				'settings' 	=> 'entrada_product_button_text'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_product_button_text_hover',
		array(
			'default' 			=> '#fff',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_product_button_text_hover',
			array(
				'label' 	=> __('Book Now Text Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_product_listing',
				'settings' 	=> 'entrada_product_button_text_hover'
			)
		)
	);


	$wp_customize->add_setting(
		'entrada_product_image_caption',
		array(
			'default' => '#d8c689',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_product_image_caption',
			array(
				'label' 	=> __('Image Caption Colour', 'entrada'),
				'section' 	=> 'entrada_section_product_listing',
				'settings' 	=> 'entrada_product_image_caption'
			)
		)
	);

	/* *****************  Blog Colours ***************  */

	$wp_customize->add_section(
		'entrada_section_blog',
		array(
			'title' 		=> __('Blog Listing', 'entrada'),
			'description' 	=> __('Set blog listing page colours settings.', 'entrada'),
			'panel' 		=> 'entrada_layout_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'entrada_blog_title_color',
		array(
			'default' 			=> '#5c5e62',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_blog_title_color',
			array(
				'label' 	=> __('Title Colour', 'entrada'),
				'section' 	=> 'entrada_section_blog',
				'settings' 	=> 'entrada_blog_title_color'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_blog_title_hover_color',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_blog_title_hover_color',
			array(
				'label' 	=> __('Title Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_blog',
				'settings' 	=> 'entrada_blog_title_hover_color'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_blog_sidebar_title',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_blog_sidebar_title',
			array(
				'label' 	=> __('Sidebar Title Colour', 'entrada'),
				'section' 	=> 'entrada_section_blog',
				'settings' 	=> 'entrada_blog_sidebar_title'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_blog_sidebar_heading',
		array(
			'default' 			=> '#9d9d9d',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_blog_sidebar_heading',
			array(
				'label' 	=> __('Sidebar Heading Colour', 'entrada'),
				'section' 	=> 'entrada_section_blog',
				'settings' 	=> 'entrada_blog_sidebar_heading'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_blog_sidebar_heading_hover',
		array(
			'default' 			=> '#9d9d9d',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_blog_sidebar_heading_hover',
			array(
				'label' 	=> __('Sidebar Heading Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_blog',
				'settings' 	=> 'entrada_blog_sidebar_heading_hover'
			)
		)
	);

	/* *****************  Counter Block Colours ***************  */

	$wp_customize->add_section(
		'entrada_section_counter',
		array(
			'title' 		=> __('Counter Blocks', 'entrada'),
			'description' 	=> __('Set counter blocks background colour settings.', 'entrada'),
			'panel' 		=> 'entrada_layout_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'entrada_counter_first',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_counter_first',
			array(
				'label' 	=> __('First Counter Background Colour', 'entrada'),
				'section' 	=> 'entrada_section_counter',
				'settings' 	=> 'entrada_counter_first'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_counter_second',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_counter_second',
			array(
				'label' 	=> __('Second Block Background Colour', 'entrada'),
				'section' 	=> 'entrada_section_counter',
				'settings' 	=> 'entrada_counter_second'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_counter_third',
		array(
			'default' 			=> '#474d4b',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_counter_third',
			array(
				'label' 	=> __('Third Block Background Colour', 'entrada'),
				'section' 	=> 'entrada_section_counter',
				'settings' 	=> 'entrada_counter_third'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_counter_fourth',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_counter_fourth',
			array(
				'label' 	=> __('Fourth Block Background Colour', 'entrada'),
				'section' 	=> 'entrada_section_counter',
				'settings' 	=> 'entrada_counter_fourth'
			)
		)
	);

	/* *****************  Browse by Block Colours ***************  */

	$wp_customize->add_section(
		'entrada_section_browse_by',
		array(
			'title' 		=> __('Browse by Block', 'entrada'),
			'description' 	=> __('Set browse by block background colour settings.', 'entrada'),
			'panel' 		=> 'entrada_layout_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'entrada_browse_by_destination',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_browse_by_destination',
			array(
				'label' 	=> __('Destination Block Background Colour', 'entrada'),
				'section' 	=> 'entrada_section_browse_by',
				'settings' 	=> 'entrada_browse_by_destination'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_browse_by_destination_hover',
		array(
			'default' 			=> '#9a8c5a',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_browse_by_destination_hover',
			array(
				'label' 	=> __('Destination Block Background Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_browse_by',
				'settings' 	=> 'entrada_browse_by_destination_hover'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_browse_by_adventure',
		array(
			'default' 			=> '#474d4b',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_browse_by_adventure',
			array(
				'label' 	=> __('Adventure Block Background Colour', 'entrada'),
				'section' 	=> 'entrada_section_browse_by',
				'settings' 	=> 'entrada_browse_by_adventure'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_browse_by_adventure_hover',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_browse_by_adventure_hover',
			array(
				'label' 	=> __('Adventure Block Background Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_browse_by',
				'settings' 	=> 'entrada_browse_by_adventure_hover'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_browse_by_text',
		array(
			'default' 			=> '#fff',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_browse_by_text',
			array(
				'label' 	=> __('Block Text Colour', 'entrada'),
				'section' 	=> 'entrada_section_browse_by',
				'settings' 	=> 'entrada_browse_by_text'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_browse_by_text_hover',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_browse_by_text_hover',
			array(
				'label' 	=> __('Block Text Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_browse_by',
				'settings' 	=> 'entrada_browse_by_text_hover'
			)
		)
	);


	/* *****************  Guide Block Colours ***************  */

	$wp_customize->add_section(
		'entrada_section_guides',
		array(
			'title' 		=> __('Guide Block', 'entrada'),
			'description' 	=> __('Set browse by block background colour settings.', 'entrada'),
			'panel' 		=> 'entrada_layout_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'entrada_guide_bg',
		array(
			'default' 			=> '#6b6957',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_guide_bg',
			array(
				'label' 	=> __('Text Background Colour', 'entrada'),
				'section' 	=> 'entrada_section_guides',
				'settings' 	=> 'entrada_guide_bg'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_guide_bg_hover',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_guide_bg_hover',
			array(
				'label' 	=> __('Text Background Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_guides',
				'settings' 	=> 'entrada_guide_bg_hover'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_guide_name',
		array(
			'default' 			=> '#fff',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_guide_name',
			array(
				'label' 	=> __('Name Colour', 'entrada'),
				'section' 	=> 'entrada_section_guides',
				'settings' 	=> 'entrada_guide_name'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_guide_name_hover',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_guide_name_hover',
			array(
				'label' 	=> __('Name Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_guides',
				'settings' 	=> 'entrada_guide_name_hover'
			)
		)
	);

	/* *****************  Partners Block Colours ***************  */

	$wp_customize->add_section(
		'entrada_section_partner',
		array(
			'title' 		=> __('Partner Block', 'entrada'),
			'description' 	=> __('Set partner block colour settings.', 'entrada'),
			'panel' 		=> 'entrada_layout_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'entrada_partner_bottom_border',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_partner_bottom_border',
			array(
				'label' 	=> __('Bottom Border Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_partner',
				'settings' 	=> 'entrada_partner_bottom_border'
			)
		)
	);

	/* *****************  Footer Block Colours ***************  */

	$wp_customize->add_section(
		'entrada_section_footer_block',
		array(
			'title' 		=> __('Footer Block Colour', 'entrada'),
			'description' 	=> __('Set partner block colour settings.', 'entrada'),
			'panel' 		=> 'entrada_layout_setting_panel'
		)
	);
	//newsletter
	$wp_customize->add_setting(
		'entrada_footer_newsletter',
		array(
			'default' 			=> '#6b6957',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_footer_newsletter',
			array(
				'label' 	=> __('Newsletter Block Colour', 'entrada'),
				'section' 	=> 'entrada_section_footer_block',
				'settings' 	=> 'entrada_footer_newsletter'
			)
		)
	);
	$wp_customize->add_setting(
		'entrada_footer_newsletter_text_hover',
		array(
			'default' 			=> '#fff',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_footer_newsletter_text_hover',
			array(
				'label' 	=> __('Newsletter Button Text Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_footer_block',
				'settings' 	=> 'entrada_footer_newsletter_text_hover'
			)
		)
	);
	$wp_customize->add_setting(
		'entrada_footer_newsletter_text_colour',
		array(
			'default' 			=> '#9d9d9d',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_footer_newsletter_text_colour',
			array(
				'label' 	=> __('Newsletter Text Colour', 'entrada'),
				'section' 	=> 'entrada_section_footer_block',
				'settings' 	=> 'entrada_footer_newsletter_text_colour'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_footer_column_title',
		array(
			'default' 			=> '#6b6957',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_footer_column_title',
			array(
				'label' 	=> __('Column Title Colour', 'entrada'),
				'section' 	=> 'entrada_section_footer_block',
				'settings' 	=> 'entrada_footer_column_title'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_footer_link',
		array(
			'default' 			=> '#9d9d9d',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_footer_link',
			array(
				'label' 	=> __('Link Colour', 'entrada'),
				'section' 	=> 'entrada_section_footer_block',
				'settings' 	=> 'entrada_footer_link'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_footer_link_hover',
		array(
			'default' 			=> '#e2e2e2',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_footer_link_hover',
			array(
				'label' 	=> __('Link Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_footer_block',
				'settings' 	=> 'entrada_footer_link_hover'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_footer_social',
		array(
			'default' 			=> '#6b6957',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_footer_social',
			array(
				'label' 	=> __('Social Icon Colour', 'entrada'),
				'section' 	=> 'entrada_section_footer_block',
				'settings' 	=> 'entrada_footer_social'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_footer_social_hover',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_footer_social_hover',
			array(
				'label' 	=> __('Social Icon Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_footer_block',
				'settings' 	=> 'entrada_footer_social_hover'
			)
		)
	);

	/* *****************  Filter Colours ***************  */

	$wp_customize->add_section(
		'entrada_section_filter',
		array(
			'title' 		=> __('Filter', 'entrada'),
			'description' 	=> __('Set filter colour settings.', 'entrada'),
			'panel' 		=> 'entrada_layout_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'entrada_filter_select',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_filter_select',
			array(
				'label' 	=> __('Box Colour', 'entrada'),
				'section' 	=> 'entrada_section_filter',
				'settings' 	=> 'entrada_filter_select'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_filter_select_arrow',
		array(
			'default' 			=> '#fff',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_filter_select_arrow',
			array(
				'label' 	=> __('Arrow Colour', 'entrada'),
				'section' 	=> 'entrada_section_filter',
				'settings' 	=> 'entrada_filter_select_arrow'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_filter_select_text',
		array(
			'default' 			=> '#fff',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_filter_select_text',
			array(
				'label' 	=> __('Text Colour', 'entrada'),
				'section' 	=> 'entrada_section_filter',
				'settings' 	=> 'entrada_filter_select_text'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_filter_dropdown_box',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_filter_dropdown_box',
			array(
				'label' 	=> __('Dropdown Box Colour', 'entrada'),
				'section' 	=> 'entrada_section_filter',
				'settings' 	=> 'entrada_filter_dropdown_box'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_filter_dropdown_box_hover',
		array(
			'default' 			=> '#8a7d50',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_filter_dropdown_box_hover',
			array(
				'label' 	=> __('Dropdown Box Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_filter',
				'settings' 	=> 'entrada_filter_dropdown_box_hover'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_filter_dropdown_text',
		array(
			'default' 			=> '#fff',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_filter_dropdown_text',
			array(
				'label' 	=> __('Dropdown Text Colour', 'entrada'),
				'section' 	=> 'entrada_section_filter',
				'settings' 	=> 'entrada_filter_dropdown_text'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_filter_dropdown_text_hover',
		array(
			'default' 			=> '#fff',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_filter_dropdown_text_hover',
			array(
				'label' 	=> __('Dropdown Text Hover Colour', 'entrada'),
				'section' 	=> 'entrada_section_filter',
				'settings' 	=> 'entrada_filter_dropdown_text_hover'
			)
		)
	);

	$wp_customize->add_setting(
		'entrada_view_option',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_view_option',
			array(
				'label' 	=> __('View Option', 'entrada'),
				'section' 	=> 'entrada_section_filter',
				'settings' 	=> 'entrada_view_option'
			)
		)
	);

	/* *****************  Category Page Colours ***************  */

	$wp_customize->add_section(
		'entrada_section_category_page',
		array(
			'title' 		=> __('Category Page', 'entrada'),
			'description' 	=> __('Set category page colour settings.', 'entrada'),
			'panel' 		=> 'entrada_layout_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'entrada_category_page_map',
		array(
			'default' 			=> '#474d4b',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entrada_category_page_map',
			array(
				'label' 	=> __('Map Background Colour', 'entrada'),
				'section' 	=> 'entrada_section_category_page',
				'settings' 	=> 'entrada_category_page_map'
			)
		)
	);

	/* ************************   Typography setting **************************** */
	/* --- Body and content ---- */
	$wp_customize->add_section(
		'section_typography_body_content',
		array(
			'title' 		=> __('Body and Content', 'entrada'),
			'description' 	=> __('Set body and content styles settings.', 'entrada'),
			'priority' 		=> 24,
			'panel' 		=> 'entrada_typography_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'google_font_setting["body_content"]',
		array(
			'default'			=> 'Roboto',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Entrada_Google_Font_Dropdown_Custom_Control(
			$wp_customize,
			'google_font_body_content',
			array(
				'label'   	=> __('Body Font Family', 'entrada'),
				'section'	=> 'section_typography_body_content',
				'settings'  => 'google_font_setting["body_content"]',
			)
		)
	);

	$wp_customize->add_setting(
		'google_fontvariant_setting["body_content"]',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Google_Fontvariants_Dropdown_Custom_Control(
			$wp_customize,
			'body_content_google_fontvariant_setting',
			array(
				'label'   	=> __('Font Weight', 'entrada'),
				'section'	=> 'section_typography_body_content',
				'settings'  => 'google_fontvariant_setting["body_content"]',
			)
		)
	);

	$wp_customize->add_setting(
		'body_font_colour',
		array(
			'default' 			=> '#5c5e62',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'body_font_colour',
			array(
				'label' 	=> __('Body Font Colour', 'entrada'),
				'section' 	=> 'section_typography_body_content',
				'settings' 	=> 'body_font_colour'
			)
		)
	);

	$wp_customize->add_setting(
		'body_font_size',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_check_number',
		)
	);

	$wp_customize->add_control(
		'body_font_size',
		array(
			'label'		=> __('Body Font Size (px)', 'entrada'),
			'type'		=> 'text',
			'section'	=> 'section_typography_body_content',
			'settings'	=> 'body_font_size'
		)
	);

	$wp_customize->add_setting(
		'content_font_size',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_check_number',
		)
	);

	$wp_customize->add_control(
		'content_font_size',
		array(
			'label'		=> __('Content Font Size (px)', 'entrada'),
			'type'		=> 'text',
			'section'	=> 'section_typography_body_content',
			'settings'	=> 'content_font_size',
		)
	);

	/* Heading h1 */
	$wp_customize->add_section(
		'section_typography_heading_hone',
		array(
			'title' 		=> __('Heading h1', 'entrada'),
			'description' 	=> __('Set heading h1 styles settings.', 'entrada'),
			'priority' 		=> 24,
			'panel' 		=> 'entrada_typography_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'google_font_setting["heading_hone"]',
		array(
			'default'			=> 'Montserrat',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Entrada_Google_Font_Dropdown_Custom_Control(
			$wp_customize,
			'heading_hone_google_font_setting',
			array(
				'label'   	=> __('Heading Font Family', 'entrada'),
				'section'	=> 'section_typography_heading_hone',
				'settings'  => 'google_font_setting["heading_hone"]',
			)
		)
	);

	$wp_customize->add_setting(
		'google_fontvariant_setting["heading_hone"]',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Google_Fontvariants_Dropdown_Custom_Control(
			$wp_customize,
			'heading_hone_google_fontvariant_setting',
			array(
				'label'   	=> __('Heading Font Weight', 'entrada'),
				'section'	=> 'section_typography_heading_hone',
				'settings'  => 'google_fontvariant_setting["heading_hone"]',
			)
		)
	);

	$wp_customize->add_setting(
		'heading_hone_font_size',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_check_number',
		)
	);

	$wp_customize->add_control(
		'heading_hone_font_size',
		array(
			'label'		=> __('Heading Font Size (px)', 'entrada'),
			'type'		=> 'text',
			'section'	=> 'section_typography_heading_hone',
			'settings'	=> 'heading_hone_font_size',
		)
	);

	$wp_customize->add_setting(
		'heading_hone_colour',
		array(
			'default' 			=> '#6b6957',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'heading_hone_colour',
			array(
				'label' 	=> __('Heading Font Colour', 'entrada'),
				'section' 	=> 'section_typography_heading_hone',
				'settings' 	=> 'heading_hone_colour'
			)
		)
	);

	/* Heading h2 */
	$wp_customize->add_section(
		'section_typography_heading_font',
		array(
			'title' 		=> __('Heading h2', 'entrada'),
			'description' 	=> __('Set main heading h2 styles settings.', 'entrada'),
			'priority' 		=> 24,
			'panel' 		=> 'entrada_typography_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'google_font_setting["main_heading"]',
		array(
			'default'			=> 'Montserrat',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Entrada_Google_Font_Dropdown_Custom_Control(
			$wp_customize,
			'main_heading_google_font_setting',
			array(
				'label'   	=> __('Heading Font Family', 'entrada'),
				'section'	=> 'section_typography_heading_font',
				'settings'  => 'google_font_setting["main_heading"]',
			)
		)
	);

	$wp_customize->add_setting(
		'main_heading_font_size',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_check_number',
		)
	);

	$wp_customize->add_control(
		'main_heading_font_size',
		array(
			'label'		=> __('Heading Font Size (px)', 'entrada'),
			'type'		=> 'text',
			'section'	=> 'section_typography_heading_font',
			'settings'	=> 'main_heading_font_size',
		)
	);

	$wp_customize->add_setting(
		'google_fontvariant_setting["main_heading"]',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Google_Fontvariants_Dropdown_Custom_Control(
			$wp_customize,
			'main_heading_google_fontvariant_setting',
			array(
				'label'   	=> __('Heading Font Weight', 'entrada'),
				'section'	=> 'section_typography_heading_font',
				'settings'  => 'google_fontvariant_setting["main_heading"]',
			)
		)
	);

	$wp_customize->add_setting(
		'main_heading_colour',
		array(
			'default' 			=> '#5c5e62',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'main_heading_colour',
			array(
				'label' 	=> __('Heading Font Colour', 'entrada'),
				'section' 	=> 'section_typography_heading_font',
				'settings' 	=> 'main_heading_colour'
			)
		)
	);

	$wp_customize->add_setting(
		'main_heading_font_capitalise',
		array(
			'default'			=> 'capital_yes',
			'sanitize_callback' => 'entrada_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'main_heading_font_capitalise',
		array(
			'label'		=> __('Uppercase', 'entrada'),
			'type'		=> 'checkbox',
			'section'	=> 'section_typography_heading_font',
			'settings'	=> 'main_heading_font_capitalise',
		)
	);

	/* Heading h3 */
	$wp_customize->add_section(
		'section_typography_heading_hthree',
		array(
			'title' 		=> __('Heading h3', 'entrada'),
			'description' 	=> __('Set heading h3 styles settings.', 'entrada'),
			'priority' 		=> 24,
			'panel' 		=> 'entrada_typography_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'google_font_setting["heading_hthree"]',
		array(
			'default'			=> 'Montserrat',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Entrada_Google_Font_Dropdown_Custom_Control(
			$wp_customize,
			'heading_hthree_google_font_setting',
			array(
				'label'   	=> __('Heading Font Family', 'entrada'),
				'section'	=> 'section_typography_heading_hthree',
				'settings'  => 'google_font_setting["heading_hthree"]',
			)
		)
	);

	$wp_customize->add_setting(
		'google_fontvariant_setting["heading_hthree"]',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Google_Fontvariants_Dropdown_Custom_Control(
			$wp_customize,
			'heading_hthree_google_fontvariant_setting',
			array(
				'label'   	=> __('Heading Font Weight', 'entrada'),
				'section'	=> 'section_typography_heading_hthree',
				'settings'  => 'google_fontvariant_setting["heading_hthree"]',
			)
		)
	);

	$wp_customize->add_setting(
		'heading_hthree_font_size',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_check_number',
		)
	);

	$wp_customize->add_control(
		'heading_hthree_font_size',
		array(
			'label'		=> __('Heading Font Size (px)', 'entrada'),
			'type'		=> 'text',
			'section'	=> 'section_typography_heading_hthree',
			'settings'	=> 'heading_hthree_font_size',
		)
	);

	$wp_customize->add_setting(
		'heading_hthree_colour',
		array(
			'default' 			=> '#6b6957',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'heading_hthree_colour',
			array(
				'label' 	=> __('Heading Font Colour', 'entrada'),
				'section' 	=> 'section_typography_heading_hthree',
				'settings' 	=> 'heading_hthree_colour'
			)
		)
	);

	/* Heading h4 */
	$wp_customize->add_section(
		'section_typography_heading_hfour',
		array(
			'title' 		=> __('Heading h4', 'entrada'),
			'description' 	=> __('Set heading h4 styles settings.', 'entrada'),
			'priority' 		=> 24,
			'panel' 		=> 'entrada_typography_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'google_font_setting["heading_hfour"]',
		array(
			'default'			=> 'Montserrat',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Entrada_Google_Font_Dropdown_Custom_Control(
			$wp_customize,
			'heading_hfour_google_font_setting',
			array(
				'label'   	=> __('Heading Font Family', 'entrada'),
				'section'	=> 'section_typography_heading_hfour',
				'settings'  => 'google_font_setting["heading_hfour"]',
			)
		)
	);

	$wp_customize->add_setting(
		'google_fontvariant_setting["heading_hfour"]',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Google_Fontvariants_Dropdown_Custom_Control(
			$wp_customize,
			'heading_hfour_google_fontvariant_setting',
			array(
				'label'   	=> __('Heading Font Weight', 'entrada'),
				'section'	=> 'section_typography_heading_hfour',
				'settings'  => 'google_fontvariant_setting["heading_hfour"]',
			)
		)
	);

	$wp_customize->add_setting(
		'heading_hfour_font_size',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_check_number',
		)
	);

	$wp_customize->add_control(
		'heading_hfour_font_size',
		array(
			'label'		=> __('Heading Font Size (px)', 'entrada'),
			'type'		=> 'text',
			'section'	=> 'section_typography_heading_hfour',
			'settings'	=> 'heading_hfour_font_size',
		)
	);

	$wp_customize->add_setting(
		'heading_hfour_colour',
		array(
			'default' 			=> '#5c5e62',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'heading_hfour_colour',
			array(
				'label' 	=> __('Heading Font Colour', 'entrada'),
				'section' 	=> 'section_typography_heading_hfour',
				'settings' 	=> 'heading_hfour_colour'
			)
		)
	);
	/* Heading h5 */
	$wp_customize->add_section(
		'section_typography_heading_hfive',
		array(
			'title' 		=> __('Heading h5', 'entrada'),
			'description' 	=> __('Set heading h5 styles settings.', 'entrada'),
			'priority' 		=> 24,
			'panel' 		=> 'entrada_typography_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'google_font_setting["heading_hfive"]',
		array(
			'default'			=> 'Montserrat',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Entrada_Google_Font_Dropdown_Custom_Control(
			$wp_customize,
			'heading_hfive_google_font_setting',
			array(
				'label'   	=> __('Heading Font Family', 'entrada'),
				'section'	=> 'section_typography_heading_hfive',
				'settings'  => 'google_font_setting["heading_hfive"]',
			)
		)
	);

	$wp_customize->add_setting(
		'google_fontvariant_setting["heading_hfive"]',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Google_Fontvariants_Dropdown_Custom_Control(
			$wp_customize,
			'heading_hfive_google_fontvariant_setting',
			array(
				'label'   	=> __('Heading Font Weight', 'entrada'),
				'section'	=> 'section_typography_heading_hfive',
				'settings'  => 'google_fontvariant_setting["heading_hfive"]',
			)
		)
	);

	$wp_customize->add_setting(
		'heading_hfive_font_size',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_check_number',
		)
	);

	$wp_customize->add_control(
		'heading_hfive_font_size',
		array(
			'label'		=> __('Heading Font Size (px)', 'entrada'),
			'type'		=> 'text',
			'section'	=> 'section_typography_heading_hfive',
			'settings'	=> 'heading_hfive_font_size',
		)
	);

	$wp_customize->add_setting(
		'heading_hfive_colour',
		array(
			'default' 			=> '#5c5e62',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'heading_hfive_colour',
			array(
				'label' 	=> __('Heading Font Colour', 'entrada'),
				'section' 	=> 'section_typography_heading_hfive',
				'settings' 	=> 'heading_hfive_colour'
			)
		)
	);
	/* Heading h6 */
	$wp_customize->add_section(
		'section_typography_heading_hsix',
		array(
			'title' 		=> __('Heading h6', 'entrada'),
			'description' 	=> __('Set heading h6 styles settings.', 'entrada'),
			'priority' 		=> 24,
			'panel' 		=> 'entrada_typography_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'google_font_setting["heading_hsix"]',
		array(
			'default'			=> 'Montserrat',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Entrada_Google_Font_Dropdown_Custom_Control(
			$wp_customize,
			'heading_hsix_google_font_setting',
			array(
				'label'   	=> __('Heading Font Family', 'entrada'),
				'section'	=> 'section_typography_heading_hsix',
				'settings'  => 'google_font_setting["heading_hsix"]',
			)
		)
	);

	$wp_customize->add_setting(
		'google_fontvariant_setting["heading_hsix"]',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Google_Fontvariants_Dropdown_Custom_Control(
			$wp_customize,
			'heading_hsix_google_fontvariant_setting',
			array(
				'label'   	=> __('Heading Font Weight', 'entrada'),
				'section'	=> 'section_typography_heading_hsix',
				'settings'  => 'google_fontvariant_setting["heading_hsix"]',
			)
		)
	);

	$wp_customize->add_setting(
		'heading_hsix_font_size',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_check_number',
		)
	);

	$wp_customize->add_control(
		'heading_hsix_font_size',
		array(
			'label'		=> __('Heading Font Size (px)', 'entrada'),
			'type'		=> 'text',
			'section'	=> 'section_typography_heading_hsix',
			'settings'	=> 'heading_hsix_font_size',
		)
	);

	$wp_customize->add_setting(
		'heading_hsix_colour',
		array(
			'default' 			=> '#5c5e62',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'heading_hsix_colour',
			array(
				'label' 	=> __('Heading Font Colour', 'entrada'),
				'section' 	=> 'section_typography_heading_hsix',
				'settings' 	=> 'heading_hsix_colour'
			)
		)
	);

	/* Sub title */
	$wp_customize->add_section(
		'section_typography_subtitle',
		array(
			'title' 		=> __('Sub Title', 'entrada'),
			'description' 	=> __('Set subtitle styles settings.', 'entrada'),
			'priority' 		=> 24,
			'panel' 		=> 'entrada_typography_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'google_font_setting["subtitle_font"]',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Entrada_Google_Font_Dropdown_Custom_Control(
			$wp_customize,
			'google_font_subtitle',
			array(
				'label'   	=> __('Font Family', 'entrada'),
				'section'	=> 'section_typography_subtitle',
				'settings'  => 'google_font_setting["subtitle_font"]',
			)
		)
	);

	$wp_customize->add_setting(
		'google_fontvariant_setting["subtitle_font"]',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new Google_Fontvariants_Dropdown_Custom_Control(
			$wp_customize,
			'subtitle_google_fontvariant_setting',
			array(
				'label'   	=> __('Font Weight', 'entrada'),
				'section'	=> 'section_typography_subtitle',
				'settings'  => 'google_fontvariant_setting["subtitle_font"]',
			)
		)
	);

	/* Custom Font Icon */
	$wp_customize->add_section(
		'section_typography_font_icon_path',
		array(
			'title' 		=> __('Custom Font Icons', 'entrada'),
			'description' 	=> __('Add Font Icon folder inside the theme and relative path below. Example : icomoon/style.css', 'entrada'),
			'priority' 		=> 24,
			'panel' 		=> 'entrada_typography_setting_panel'
		)
	);


	$wp_customize->add_setting(
		'entrada_font_icons_path',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'entrada_font_icons_path',
		array(
			'label'		=> __('Font Icon Style URL', 'entrada'),
			'type'		=> 'text',
			'section'	=> 'section_typography_font_icon_path',
			'settings'	=> 'entrada_font_icons_path',
		)
	);


	/* ************************ Button and links setting ****************** */
	/* Round Button */
	$wp_customize->add_section(
		'section_round_button_setting',
		array(
			'title'       	=> __('Round Button', 'entrada'),
			'description'	=> __('Round button settings.', 'entrada'),
			'priority' 		=> 24,
			'panel' 		=> 'entrada_button_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'rounded_button_text',
		array(
			'default'			=> 'Dig More',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'rounded_button_text',
		array(
			'label'		=> __('Button Text', 'entrada'),
			'type'		=> 'text',
			'section'	=> 'section_round_button_setting',
			'settings'	=> 'rounded_button_text',
		)
	);

	$wp_customize->add_setting(
		'rounded_button_bckgrd_colour',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'rounded_button_bckgrd_colour',
			array(
				'label' 	=> __('Button Background Colour', 'entrada'),
				'section' 	=> 'section_round_button_setting',
				'settings' 	=> 'rounded_button_bckgrd_colour'
			)
		)
	);
	$wp_customize->add_setting(
		'rounded_button_hover_colour',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'rounded_button_hover_colour',
			array(
				'label' 	=> __('Button Hover Colour', 'entrada'),
				'section' 	=> 'section_round_button_setting',
				'settings' 	=> 'rounded_button_hover_colour'
			)
		)
	);

	$wp_customize->add_setting(
		'rounded_button_colour',
		array(
			'default' 			=> '#fff',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'rounded_button_colour',
			array(
				'label' 	=> __('Button Text Colour', 'entrada'),
				'section' 	=> 'section_round_button_setting',
				'settings' 	=> 'rounded_button_colour'
			)
		)
	);

	$wp_customize->add_setting(
		'rounded_button_border',
		array(
			'default'			=> 'rd_border_yes',
			'sanitize_callback' => 'entrada_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'rounded_button_border',
		array(
			'label'		=> __('Button Border', 'entrada'),
			'type'		=> 'checkbox',
			'section'	=> 'section_round_button_setting',
			'settings'	=> 'rounded_button_border',
		)
	);

	$wp_customize->add_setting(
		'rounded_button_border_colour',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'rounded_button_border_colour',
			array(
				'label' 	=> __('Border Colour', 'entrada'),
				'section' 	=> 'section_round_button_setting',
				'settings' 	=> 'rounded_button_border_colour'
			)
		)
	);
	$wp_customize->add_setting(
		'rounded_button_border_hover_colour',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'rounded_button_border_hover_colour',
			array(
				'label' 	=> __('Border Hover Colour', 'entrada'),
				'section' 	=> 'section_round_button_setting',
				'settings' 	=> 'rounded_button_border_hover_colour'
			)
		)
	);

	/* Square Button */
	$wp_customize->add_section(
		'section_square_button_setting',
		array(
			'title'      	=> __('Square Button', 'entrada'),
			'description'	=> __('Square Button settings.', 'entrada'),
			'priority' 		=> 24,
			'panel' 		=> 'entrada_button_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'square_button_text',
		array(
			'default'			=> 'Explore',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'square_button_text',
		array(
			'label'		=> __('Button Text', 'entrada'),
			'type'		=> 'text',
			'section'	=> 'section_square_button_setting',
			'settings'	=> 'square_button_text',
		)
	);


	$wp_customize->add_setting(
		'square_button_bckgrd_colour',
		array(
			'default' 			=> '#252525',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'square_button_bckgrd_colour',
			array(
				'label' 	=> __('Background Colour', 'entrada'),
				'section' 	=> 'section_square_button_setting',
				'settings' 	=> 'square_button_bckgrd_colour'
			)
		)
	);
	$wp_customize->add_setting(
		'square_button_hover_colour',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'square_button_hover_colour',
			array(
				'label' 	=> __('Button Hover Colour', 'entrada'),
				'section' 	=> 'section_square_button_setting',
				'settings' 	=> 'square_button_hover_colour'
			)
		)
	);

	$wp_customize->add_setting(
		'square_button_colour',
		array(
			'default' 			=> '#fff',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'square_button_colour',
			array(
				'label' 	=> __('Button Text Colour', 'entrada'),
				'section' 	=> 'section_square_button_setting',
				'settings' 	=> 'square_button_colour'
			)
		)
	);

	$wp_customize->add_setting(
		'square_button_border',
		array(
			'default'			=> 'sq_border_yes',
			'sanitize_callback' => 'entrada_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'square_button_border',
		array(
			'label'		=> __('Button Border', 'entrada'),
			'type'		=> 'checkbox',
			'section'	=> 'section_square_button_setting',
			'settings'	=> 'square_button_border',
		)
	);

	$wp_customize->add_setting(
		'square_button_border_colour',
		array(
			'default' 			=> '#252525',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'square_button_border_colour',
			array(
				'label' 	=> __('Button Border Colour', 'entrada'),
				'section' 	=> 'section_square_button_setting',
				'settings' 	=> 'square_button_border_colour'
			)
		)
	);
	$wp_customize->add_setting(
		'square_button_border_hover_colour',
		array(
			'default' 			=> '#e2e2e2',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'square_button_border_hover_colour',
			array(
				'label' 	=> __('Border Hover Colour', 'entrada'),
				'section' 	=> 'section_square_button_setting',
				'settings' 	=> 'square_button_border_hover_colour'
			)
		)
	);

	/* Large Button */
	$wp_customize->add_section(
		'section_large_button_setting',
		array(
			'title'      	=> __('Large Button', 'entrada'),
			'description'	=> __('Large Button settings.', 'entrada'),
			'priority' 		=> 24,
			'panel' 		=> 'entrada_button_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'large_button_text',
		array(
			'default'			=> 'Explore',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'large_button_text',
		array(
			'label'		=> __('Button Text', 'entrada'),
			'type'		=> 'text',
			'section'	=> 'section_large_button_setting',
			'settings'	=> 'large_button_text',
		)
	);


	$wp_customize->add_setting(
		'large_button_bckgrd_colour',
		array(
			'default' 			=> '#fff',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'large_button_bckgrd_colour',
			array(
				'label' 	=> __('Background Colour', 'entrada'),
				'section' 	=> 'section_large_button_setting',
				'settings' 	=> 'large_button_bckgrd_colour'
			)
		)
	);
	$wp_customize->add_setting(
		'large_button_hover_colour',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'large_button_hover_colour',
			array(
				'label' 	=> __('Button Hover Colour', 'entrada'),
				'section' 	=> 'section_large_button_setting',
				'settings' 	=> 'large_button_hover_colour'
			)
		)
	);

	$wp_customize->add_setting(
		'large_button_colour',
		array(
			'default' 			=> '#5c5e62',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'large_button_colour',
			array(
				'label' 	=> __('Button Text Colour', 'entrada'),
				'section' 	=> 'section_large_button_setting',
				'settings' 	=> 'large_button_colour'
			)
		)
	);

	$wp_customize->add_setting(
		'large_button_border',
		array(
			'default'			=> 'sq_border_yes',
			'sanitize_callback' => 'entrada_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'large_button_border',
		array(
			'label'		=> __('Button Border', 'entrada'),
			'type'		=> 'checkbox',
			'section'	=> 'section_large_button_setting',
			'settings'	=> 'large_button_border',
		)
	);

	$wp_customize->add_setting(
		'large_button_border_colour',
		array(
			'default' 			=> '#5c5e62',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'large_button_border_colour',
			array(
				'label' 	=> __('Button Border Colour', 'entrada'),
				'section' 	=> 'section_large_button_setting',
				'settings' 	=> 'large_button_border_colour'
			)
		)
	);
	$wp_customize->add_setting(
		'large_button_border_hover_colour',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'large_button_border_hover_colour',
			array(
				'label' 	=> __('Border Hover Colour', 'entrada'),
				'section' 	=> 'section_large_button_setting',
				'settings' 	=> 'large_button_border_hover_colour'
			)
		)
	);

	/* Site link */
	$wp_customize->add_section(
		'section_typography_site_links',
		array(
			'title' 		=> __('Site Link', 'entrada'),
			'description' 	=> __('Site link settings.', 'entrada'),
			'priority' 		=> 24,
			'panel' 		=> 'entrada_button_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'site_links_colour',
		array(
			'default' 			=> '#9d9d9d',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_links_colour',
			array(
				'label' 	=> __('Link Colour', 'entrada'),
				'section' 	=> 'section_typography_site_links',
				'settings' 	=> 'site_links_colour'
			)
		)
	);

	$wp_customize->add_setting(
		'site_links_hover_colour',
		array(
			'default' 			=> '#b0a377',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_links_hover_colour',
			array(
				'label' 	=> __('Link Hover Colour', 'entrada'),
				'section' 	=> 'section_typography_site_links',
				'settings' 	=> 'site_links_hover_colour'
			)
		)
	);

	$wp_customize->add_setting(
		'site_links_text_decor',
		array(
			'default' 			=> 'none',
			'sanitize_callback' => 'entrada_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'site_links_text_decor',
		array(
			'label'		=> __('Text Decoration', 'entrada'),
			'type'		=> 'select',
			'section'	=> 'section_typography_site_links',
			'settings'	=> 'site_links_text_decor',
			'choices' 	=> array(
				'none' 			=> 'None',
				'blink'			=> 'Blink',
				'inherit'		=> 'Inherit',
				'initial'		=> 'Initial',
				'line-through'	=> 'Line Through',
				'overline'		=> 'Overline',
				'underline'		=> 'Underline',
			),
		)
	);

	/* ************************ Woocommerce setting start here ******************  */
	/* Entrada Badges */

	$wp_customize->add_section(
		'section_sale_badge_setting',
		array(
			'title' 		=> __('Badges', 'entrada'),
			'description' 	=> __('Badges Settings.', 'entrada'),
			'panel' 		=> 'entrada_woocommerce_setting_panel',
			'priority'		=> 1,
		)
	);
	$wp_customize->add_setting(
		'sale_badge_image',
		array(
			'default' 			=> get_template_directory_uri() . '/img/badge-sale.svg',
			'sanitize_callback' => 'entrada_sanitize_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'sale_badge_image',
			array(
				'label'    => __('Sale Badge Image', 'entrada'),
				'description'    => __('This badge will appear for sale product.', 'entrada'),
				'section'  => 'section_sale_badge_setting',
				'settings' => 'sale_badge_image',
			)
		)
	);

	/* Entrada Custom Badge */

	$wp_customize->add_setting(
		'custom_badge_onoff',
		array(
			'default'			=> 'cs_yes',
			'sanitize_callback' => 'entrada_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'custom_badge_onoff',
		array(
			'label'		=> __('Enable Custom Badges', 'entrada'),
			'type'		=> 'checkbox',
			'section'	=> 'section_sale_badge_setting',
			'settings'	=> 'custom_badge_onoff',
		)
	);

	for ($j = 1; $j <= 5; $j++) {
		$custom_badge_image = 'custom_badge_image' . $j;

		$wp_customize->add_setting(
			$custom_badge_image,
			array(
				'default' 			=> '',
				'sanitize_callback' => 'entrada_sanitize_url',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				$custom_badge_image,
				array(
					'label'    => 'Custom Badge Image ' . $j,
					'description'    => __('(Recommended size 55px * 55px)', 'entrada'),
					'section'  => 'section_sale_badge_setting',
					'settings' => $custom_badge_image,
				)
			)
		);
	}

	/* Lisiting View */
	$wp_customize->add_section(
		'section_list',
		array(
			'title' 		=> __('Lisitng Views', 'entrada'),
			'description' 	=> __('Set list view settings.', 'entrada'),
			'panel' 		=> 'entrada_woocommerce_setting_panel',
			'priority'		=> 2,
		)
	);
	$wp_customize->add_setting(
		'view_mode_layout',
		array(
			'default'    		=> 'list',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'view_mode_layout',
			array(
				'label'     => __('Search View Mode', 'entrada'),
				'section'   => 'section_list',
				'settings'  => 'view_mode_layout',
				'type'      => 'radio',
				'choices'	=> array(
					'grid'	=> 'Grid view',
					'list'	=> 'List View',
				),
			)
		)
	);

	$wp_customize->add_setting(
		'tour_cat_view_mode_layout',
		array(
			'default'    		=> 'list',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'tour_cat_view_mode_layout',
			array(
				'label'     => __('Tour Category View Mode', 'entrada'),
				'section'   => 'section_list',
				'settings'  => 'tour_cat_view_mode_layout',
				'type'      => 'radio',
				'choices'	=> array(
					'grid'	=> 'Grid view',
					'list'	=> 'List View',
				),
			)
		)
	);

	$wp_customize->add_setting(
		'desti_view_mode_layout',
		array(
			'default'    		=> 'list',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'desti_view_mode_layout',
			array(
				'label'     => __('Tour Destination View Mode', 'entrada'),
				'section'   => 'section_list',
				'settings'  => 'desti_view_mode_layout',
				'type'      => 'radio',
				'choices'	=> array(
					'grid'	=> 'Grid view',
					'list'	=> 'List View',
				),
			)
		)
	);


	/* Search Page Settings */
	$wp_customize->add_section(
		'section_search_setting',
		array(
			'title' 		=> __('Search Settings', 'entrada'),
			'description' 	=> __('Set search page settings.', 'entrada'),
			'panel' 		=> 'entrada_woocommerce_setting_panel',
			'priority'		=> 3,
		)
	);

	$wp_customize->add_setting(
		'search_posts_per_page',
		array(
			'default' 			=> '',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'search_posts_per_page',
		array(
			'label' 	=> __('Posts per Page', 'entrada'),
			'section' 	=> 'section_search_setting',
			'type' 		=> 'text',
		)
	);

	$wp_customize->add_setting(
		'search_filter_date_option_setting',
		array(
			'default' 			=> 'calendar',
			'sanitize_callback' => 'entrada_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'search_filter_date_option_setting',
		array(
			'type' 		=> 'select',
			'label' 	=> __('Date Option', 'entrada'),
			'section' 	=> 'section_search_setting',
			'choices' 	=> array(
				'calendar'	=> 'Calendar',
				'monthyear_seelctbox' 	=> 'Month/Year Selectbox',
			),
		)
	);

	$wp_customize->add_setting(
		'search_filter_option_setting',
		array(
			'default' 			=> 'filter_on_sidebar',
			'sanitize_callback' => 'entrada_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'search_filter_option_setting',
		array(
			'type' 		=> 'select',
			'label' 	=> __('Filter Option', 'entrada'),
			'section' 	=> 'section_search_setting',
			'choices' 	=> array(
				'filter_on_sidebar'	=> 'Sidebar',
				'filter_on_top' 	=> 'Filter on Top',
			),
		)
	);

	$wp_customize->add_setting(
		'search_banner',
		array(
			'default' 			=> '',
			'sanitize_callback' => 'entrada_sanitize_url',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'search_banner',
			array(
				'label'    => __('Banner Image for Search', 'entrada'),
				'section'  => 'section_search_setting',
				'settings' => 'search_banner',
			)
		)
	);

	$wp_customize->add_setting(
		'search_heading',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'search_heading',
		array(
			'label'		=> __('Search Heading', 'entrada'),
			'type'		=> 'text',
			'section'	=> 'section_search_setting',
			'settings'	=> 'search_heading'
		)
	);

	$wp_customize->add_setting(
		'search_sub_heading',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'search_sub_heading',
		array(
			'label'		=> __('Search Sub Heading', 'entrada'),
			'type'		=> 'text',
			'section'	=> 'section_search_setting',
			'settings'	=> 'search_sub_heading'
		)
	);

	/* Shop Page Settings */
	$wp_customize->add_section(
		'section_woocommerce_setting',
		array(
			'title' 		=> __('Shop Page', 'entrada'),
			'description' 	=> __('Set woocommerce shop page settings.', 'entrada'),
			'panel' 		=> 'entrada_woocommerce_setting_panel',
			'priority' 		=> 4,
		)
	);

	$wp_customize->add_setting(
		'woo_default_listing_view',
		array(
			'default' 			=> 'list',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'woo_default_listing_view',
		array(
			'type' 		=> 'radio',
			'label' 	=> __('Default Listing View', 'entrada'),
			'section'	=> 'section_woocommerce_setting',
			'choices' 	=> array(
				'list' => 'List',
				'grid' => 'Grid'
			),
		)
	);

	$wp_customize->add_setting(
		'woo_listing_per_page',
		array(
			'default' 			=> '6',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'woo_listing_per_page',
		array(
			'label' 	=> __('Listing per Page', 'entrada'),
			'section' 	=> 'section_woocommerce_setting',
			'type' 		=> 'text',
		)
	);

	$wp_customize->add_setting(
		'woo_recently_viewed_items',
		array(
			'default' 			=> 'enable',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'woo_recently_viewed_items',
		array(
			'type' 		=> 'radio',
			'label' 	=> __('Recently Viewed Items', 'entrada'),
			'section' 	=> 'section_woocommerce_setting',
			'choices' 	=> array(
				'enable' 	=> 'Enable',
				'disable'	=> 'Disable'
			),
		)
	);

	$wp_customize->add_setting(
		'woo_background_image',
		array(
			'default' 			=> '',
			'sanitize_callback' => 'entrada_sanitize_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'woo_background_image',
			array(
				'label'    => __('Background Image', 'entrada'),
				'section'  => 'section_woocommerce_setting',
				'settings' => 'woo_background_image',
			)
		)
	);

	$wp_customize->add_setting(
		'woo_heading',
		array(
			'default' 			=> 'Shop',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'woo_heading',
		array(
			'label' 	=> __('Heading', 'entrada'),
			'section' 	=> 'section_woocommerce_setting',
			'type' 		=> 'text',
		)
	);

	$wp_customize->add_setting(
		'woo_sub_heading',
		array(
			'default' 			=> 'Available Product List',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'woo_sub_heading',
		array(
			'label' 	=> __('Sub Heading', 'entrada'),
			'section' 	=> 'section_woocommerce_setting',
			'type' 		=> 'text',
		)
	);

	/* Book Now Button URL/Text Settings */

	$wp_customize->add_section(
		'section_booknow_btn_setting',
		array(
			'title' 		=> __('Book Now Button Settings', 'entrada'),
			'description' 	=> __('Set book now button text & URL for tour detail page.', 'entrada'),
			'panel' 		=> 'entrada_woocommerce_setting_panel',
			'priority' 		=> 5,
		)
	);

	$wp_customize->add_setting(
		'booknow_btn_text',
		array(
			'default' 			=> 'Book Now',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'booknow_btn_text',
		array(
			'label' 	=> __('Button Text', 'entrada'),
			'section' 	=> 'section_booknow_btn_setting',
			'type' 		=> 'text',
		)
	);

	$wp_customize->add_setting(
		'booknow_btn_url',
		array(
			'default' 			=> '',
			'sanitize_callback' => 'entrada_sanitize_url',
		)
	);

	$wp_customize->add_control(
		'booknow_btn_url',
		array(
			'label' 	=> __('Button URL', 'entrada'),
			'section' 	=> 'section_booknow_btn_setting',
			'type' 		=> 'text'

		)
	);

	/* single page tabs */
	$wp_customize->add_section(
		'section_product_tabs_setting',
		array(
			'title' 		=> __('Tab Label Settings', 'entrada'),
			'description' 	=> __('Tab label settings.', 'entrada'),
			'panel' 		=> 'entrada_woocommerce_setting_panel',
			'priority'		=> 6,
		)
	);
	$wp_customize->add_setting(
		'label_for_overview',
		array(
			'default'			=> __('Overview', 'entrada'),
			'sanitize_callback' => 'entrada_sanitize_textarea',
		)
	);
	$wp_customize->add_control(
		'label_for_overview',
		array(
			'label'		=> __('Label for Overview', 'entrada'),
			'type'		=> 'textbox',
			'section'	=> 'section_product_tabs_setting',
			'settings'	=> 'label_for_overview',
		)
	);
	$wp_customize->add_setting(
		'label_for_itinerary',
		array(
			'default'			=> __('Itinerary', 'entrada'),
			'sanitize_callback' => 'entrada_sanitize_textarea',
		)
	);
	$wp_customize->add_control(
		'label_for_itinerary',
		array(
			'label'		=> __('Label for Itinerary', 'entrada'),
			'type'		=> 'textbox',
			'section'	=> 'section_product_tabs_setting',
			'settings'	=> 'label_for_itinerary',
		)
	);
	$wp_customize->add_setting(
		'label_for_accomodation',
		array(
			'default'			=> __('Accomodation', 'entrada'),
			'sanitize_callback' => 'entrada_sanitize_textarea',
		)
	);
	$wp_customize->add_control(
		'label_for_accomodation',
		array(
			'label'		=> __('Label for Accomodation', 'entrada'),
			'type'		=> 'textbox',
			'section'	=> 'section_product_tabs_setting',
			'settings'	=> 'label_for_accomodation',
		)
	);
	$wp_customize->add_setting(
		'label_for_faqs',
		array(
			'default'			=> __('FAQs & Reviews', 'entrada'),
			'sanitize_callback' => 'entrada_sanitize_textarea',
		)
	);
	$wp_customize->add_control(
		'label_for_faqs',
		array(
			'label'		=> __('Label for FAQs and Reviews', 'entrada'),
			'type'		=> 'textbox',
			'section'	=> 'section_product_tabs_setting',
			'settings'	=> 'label_for_faqs',
		)
	);
	$wp_customize->add_setting(
		'label_for_gallery',
		array(
			'default'			=> __('Gallery', 'entrada'),
			'sanitize_callback' => 'entrada_sanitize_textarea',
		)
	);
	$wp_customize->add_control(
		'label_for_gallery',
		array(
			'label'		=> __('Label for Gallery', 'entrada'),
			'type'		=> 'textbox',
			'section'	=> 'section_product_tabs_setting',
			'settings'	=> 'label_for_gallery',
		)
	);
	$wp_customize->add_setting(
		'label_for_dates',
		array(
			'default'			=> __('Dates & Prices', 'entrada'),
			'sanitize_callback' => 'entrada_sanitize_textarea',
		)
	);
	$wp_customize->add_control(
		'label_for_dates',
		array(
			'label'		=> __('Label for Dates and Prices', 'entrada'),
			'type'		=> 'textbox',
			'section'	=> 'section_product_tabs_setting',
			'settings'	=> 'label_for_dates',
		)
	);

	/* **************************** Blog setting starts here **************************** */
	$wp_customize->add_section(
		'section_blog',
		array(
			'title' 		=> __('Blog', 'entrada'),
			'description' 	=> __('Set blog page settings.', 'entrada'),
			'priority' 		=> 15,
		)
	);
	/* post per page */
	$wp_customize->add_setting(
		'blog_per_page',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_check_number',
		)
	);
	$wp_customize->add_control(
		'blog_per_page',
		array(
			'label'		=> __('Blog per Page (This value overrides the reading setting)', 'entrada'),
			'type'		=> 'textbox',
			'section'	=> 'section_blog',
			'settings'	=> 'blog_per_page',
		)
	);
	/* post meta */
	$wp_customize->add_setting(
		'blog_post_meta_onoff',
		array(
			'default'			=> 'blog_meta_yes',
			'sanitize_callback' => 'entrada_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'blog_post_meta_onoff',
		array(
			'label'		=> __('Show Post Meta', 'entrada'),
			'type'		=> 'checkbox',
			'section'	=> 'section_blog',
			'settings'	=> 'blog_post_meta_onoff',
		)
	);

	/* full length post */
	$wp_customize->add_setting(
		'blog_full_onoff',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'blog_full_onoff',
		array(
			'label'		=> __('Show Full Length Blog', 'entrada'),
			'type'		=> 'checkbox',
			'section'	=> 'section_blog',
			'settings'	=> 'blog_full_onoff',
		)
	);

	/* excerpt length */
	$wp_customize->add_setting(
		'blog_excerpt_word_length',
		array(
			'default'			=> '70',
			'sanitize_callback' => 'entrada_check_number',
		)
	);
	$wp_customize->add_control(
		'blog_excerpt_word_length',
		array(
			'label'		=> __('Excerpt Length (Word)', 'entrada'),
			'type'		=> 'textbox',
			'section'	=> 'section_blog',
			'settings'	=> 'blog_excerpt_word_length',
		)
	);
	$wp_customize->add_setting(
		'blog_excerpt_char_length',
		array(
			'default'			=> '150',
			'sanitize_callback' => 'entrada_check_number',
		)
	);

	$wp_customize->add_control(
		'blog_excerpt_char_length',
		array(
			'label'		=> __('Excerpt Length (Character)', 'entrada'),
			'type'		=> 'textbox',
			'section'	=> 'section_blog',
			'settings'	=> 'blog_excerpt_char_length',
		)
	);

	/* ************************   Footer setting start **************************** */
	/* Partner image height */
	$wp_customize->add_section(
		'section_partner_setting',
		array(
			'title' 		=> __('Partner Image Height', 'entrada'),
			'description' 	=> __('Set partner image height settings.', 'entrada'),
			'priority' 		=> 1,
			'panel' 		=> 'entrada_footer_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'partner_height',
		array(
			'default'			=> '70',
			'sanitize_callback' => 'entrada_check_number',
		)
	);

	$wp_customize->add_control(
		'partner_height',
		array(
			'label'		=> __('Image Height (px)', 'entrada'),
			'type'		=> 'textbox',
			'section'	=> 'section_partner_setting',
			'settings'	=> 'partner_height',
		)
	);

	/* Footer Background */
	$wp_customize->add_section(
		'section_footer_bck_setting',
		array(
			'title' 		=> __('Footer Background', 'entrada'),
			'description' 	=> __('Set footer settings.', 'entrada'),
			'priority' 		=> 2,
			'panel' 		=> 'entrada_footer_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'footer_background_option',
		array(
			'default'			=> 'ft_none',
			'sanitize_callback' => 'entrada_sanitize_choices',
		)
	);

	$wp_customize->add_control(
		'footer_background_option',
		array(
			'type' 		=> 'radio',
			'label' 	=> __('Choose Background Options', 'entrada'),
			'section' 	=> 'section_footer_bck_setting',
			'choices' 	=> array(
				'ft_none'			=> 'None',
				'ft_bckcolour' 	=> 'Colour',
				'ft_bckimage' 	=> 'Image',
				'ft_bckpattern'	=> 'Pattern',
			),
		)
	);

	$wp_customize->add_setting(
		'footer_ft_bckcolour',
		array(
			'default' 			=> '#252525',
			'sanitize_callback' => 'entrada_sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_ft_bckcolour',
			array(
				'label' 	=> __('Background Colour', 'entrada'),
				'section' 	=> 'section_footer_bck_setting',
				'settings' 	=> 'footer_ft_bckcolour'
			)
		)
	);

	$wp_customize->add_setting(
		'footer_ft_bckimage',
		array(
			'default' 			=> get_template_directory_uri() . '/dist/images/footer/footer-pattern.png',
			'sanitize_callback' => 'entrada_sanitize_url',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'footer_ft_bckimage',
			array(
				'label'    => __('Background Image', 'entrada'),
				'section'  => 'section_footer_bck_setting',
				'settings' => 'footer_ft_bckimage',
			)
		)
	);

	$wp_customize->add_setting(
		'footer_ft_bckpattern',
		array(
			'default' 			=> get_template_directory_uri() . '/dist/images/footer/footer-pattern.png',
			'sanitize_callback' => 'entrada_sanitize_url',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'footer_ft_bckpattern',
			array(
				'label'    => __('Background Pattern', 'entrada'),
				'section'  => 'section_footer_bck_setting',
				'settings' => 'footer_ft_bckpattern',
			)
		)
	);

	/* Footer Newsletter */
	$wp_customize->add_section(
		'section_footer_newsletter_text',
		array(
			'title' 		=> __('Newsletter Text', 'entrada'),
			'description' 	=> __('Change the newsletter text in footer.', 'entrada'),
			'priority' 		=> 3,
			'panel' 		=> 'entrada_footer_setting_panel'
		)
	);
	$wp_customize->add_setting(
		'footer_newsletter_text',
		array(
			'default' 			=> __('To receive news, updates and tour packages via email.', 'entrada'),
			'sanitize_callback' => 'entrada_sanitize_textarea',
		)
	);

	$wp_customize->add_control(
		'footer_newsletter_text',
		array(
			'label'		=> __('Text', 'entrada'),
			'section' 	=> 'section_footer_newsletter_text',
			'type' 		=> 'textarea',
			'settings'	=> 'footer_newsletter_text',
		)
	);

	/* Footer Widget column setting */

	$wp_customize->add_section(
		'section_footer_widget_settings',
		array(
			'title' 		=> __('Footer Widget Settings', 'entrada'),
			'description' 	=> __('Change the widget settings in footer.', 'entrada'),
			'priority' 		=> 3,
			'panel' 		=> 'entrada_footer_setting_panel'
		)
	);
	$wp_customize->add_setting(
		'footer_widget_column',
		array(
			'default' 			=> 3,
			'sanitize_callback' => 'entrada_sanitize_textarea',
		)
	);

	$wp_customize->add_control(
		'footer_widget_column',
		array(
			'label'		=> __('Text', 'entrada'),
			'section' 	=> 'section_footer_widget_settings',
			'type' 		=> 'textarea',
			'settings'	=> 'footer_widget_column',
		)
	);

	$wp_customize->add_control(
		'footer_widget_column',
		array(
			'type' 		=> 'select',
			'label' 	=> __('Number of column', 'entrada'),
			'section' 	=> 'section_footer_widget_settings',
			'choices' 	=> array(
				'12'	=> __('1 Column', 'entrada'),
				'6' 	=> __('2 Column', 'entrada'),
				'4' 	=> __('3 Column', 'entrada'),
				'3' 	=> __('4 Column', 'entrada'),
				'2' 	=> __('6 Column', 'entrada'),
			),
		)
	);

	/* Footer social icons */
	$wp_customize->add_section(
		'section_footer_social_setting',
		array(
			'title' 		=> __('Footer Social Icons', 'entrada'),
			'description' 	=> __('Set the social icons settings. Adding a link will make its respective icon show up. Only first Six Icons from the top will be displayed.', 'entrada'),
			'priority' 		=> 4,
			'panel' 		=> 'entrada_footer_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'footer_social_onoff',
		array(
			'default'			=> 'ft_social_yes',
			'sanitize_callback' => 'entrada_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'footer_social_onoff',
		array(
			'label'		=> __('Social Icons Show', 'entrada'),
			'type'		=> 'checkbox',
			'section'	=> 'section_footer_social_setting',
			'settings'	=> 'footer_social_onoff',
		)
	);

	for ($i = 0; $i < 10; $i++) {

		$wp_customize->add_setting(
			'footer_social_icon_' . $i,
			array(
				'default' 			=> '',
				'sanitize_callback' => 'entrada_sanitize_text',
			)
		);

		$wp_customize->add_control(
			'footer_social_icon_' . $i,
			array(
				'label'		=> __('Icon class for social media', 'entrada'),
				'section' 	=> 'section_footer_social_setting',
				'type' 		=> 'text',
				'settings'	=> 'footer_social_icon_' . $i,
			)
		);


		$wp_customize->add_setting(
			'footer_social_url_' . $i,
			array(
				'default' 			=> '',
				'sanitize_callback' => 'entrada_sanitize_url',
			)
		);

		$wp_customize->add_control(
			'footer_social_url_' . $i,
			array(
				'label'		=> __('Social Media URL', 'entrada'),
				'section' 	=> 'section_footer_social_setting',
				'type' 		=> 'text',
				'settings'	=> 'footer_social_url_' . $i,
			)
		);
	}


	/* Footer bottom information */
	$wp_customize->add_section(
		'section_footer_bottom_setting',
		array(
			'title' 		=> __('Footer Bottom Information', 'entrada'),
			'description' 	=> __('Set bottom footer information settings.', 'entrada'),
			'priority' 		=> 4,
			'panel' 		=> 'entrada_footer_setting_panel'
		)
	);

	$wp_customize->add_setting(
		'footer_bottom_onoff',
		array(
			'default'			=> 'ft_bottom_yes',
			'sanitize_callback' => 'entrada_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'footer_bottom_onoff',
		array(
			'label'		=> __('Bottom Footer Show', 'entrada'),
			'type'		=> 'checkbox',
			'section'	=> 'section_footer_bottom_setting',
			'settings'	=> 'footer_bottom_onoff',
		)
	);

	$wp_customize->add_setting(
		'copyright_text',
		array(
			'default'			=> '',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'copyright_text',
		array(
			'label'		=> __('Copyright Text', 'entrada'),
			'type'		=> 'text',
			'section'	=> 'section_footer_bottom_setting',
			'settings'	=> 'copyright_text',
		)
	);

	$payment_logos = array();
	$payment_logos[] = array(
		'slug'			=> 'payment_logo_first',
		'default' 		=> '',
		'label' 		=> __('Payment Logo 1', 'entrada'),
		'section'		=> 'section_footer_bottom_setting',
	);
	$payment_logos[] = array(
		'slug'			=> 'payment_logo_second',
		'default' 		=> '',
		'label' 		=> __('Payment Logo 2', 'entrada'),
		'section'		=> 'section_footer_bottom_setting',
	);
	$payment_logos[] = array(
		'slug'			=> 'payment_logo_third',
		'default' 		=> '',
		'label' 		=> __('Payment Logo 3', 'entrada'),
		'section'		=> 'section_footer_bottom_setting',
	);
	$payment_logos[] = array(
		'slug'			=> 'payment_logo_fourth',
		'default' 		=> '',
		'label' 		=> __('Payment Logo 4', 'entrada'),
		'section'		=> 'section_footer_bottom_setting',
	);
	$payment_logos[] = array(
		'slug'			=> 'payment_logo_fifth',
		'default' 		=> '',
		'label' 		=> __('Payment Logo 5', 'entrada'),
		'section'		=> 'section_footer_bottom_setting',
	);
	$payment_logos[] = array(
		'slug'			=> 'payment_logo_sixth',
		'default' 		=> '',
		'label' 		=> __('Payment Logo 6', 'entrada'),
		'section'		=> 'section_footer_bottom_setting',
	);
	$payment_logos[] = array(
		'slug'			=> 'payment_logo_seventh',
		'default' 		=> '',
		'label' 		=> __('Payment Logo 7', 'entrada'),
		'section'		=> 'section_footer_bottom_setting',
	);
	$payment_logos[] = array(
		'slug'			=> 'payment_logo_eighth',
		'default' 		=> '',
		'label' 		=> __('Payment Logo 8', 'entrada'),
		'section'		=> 'section_footer_bottom_setting',
	);
	$payment_logos[] = array(
		'slug'			=> 'payment_logo_ninth',
		'default' 		=> '',
		'label' 		=> __('Payment Logo 9', 'entrada'),
		'section'		=> 'section_footer_bottom_setting',
	);
	$payment_logos[] = array(
		'slug'			=> 'payment_logo_tenth',
		'default' 		=> '',
		'label' 		=> __('Payment Logo 10', 'entrada'),
		'section'		=> 'section_footer_bottom_setting',
	);
	foreach ($payment_logos as $payment_logo) {
		$wp_customize->add_setting(
			$payment_logo['slug'],
			array(
				'default' 			=> $payment_logo['default'],
				'sanitize_callback' => 'entrada_sanitize_url',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				$payment_logo['slug'],
				array(
					'label'    => $payment_logo['label'],
					'section'  => $payment_logo['section'],
					'settings' => $payment_logo['slug'],
				)
			)
		);
	}

	/* **************************** Custom CSS and JS ***************************** */
	$wp_customize->add_section(
		'section_custom_css_js',
		array(
			'title' 		=> __('Custom CSS and JS', 'entrada'),
			'description' 	=> __('Set custom CSS and JS settings.', 'entrada'),
		)
	);

	$wp_customize->add_setting(
		'custom_css',
		array(
			'default' 			=> '',
			'sanitize_callback' => 'entrada_sanitize_textarea',
		)
	);

	$wp_customize->add_control(
		'custom_css',
		array(
			'label'		=> __('Custom CSS', 'entrada'),
			'section' 	=> 'section_custom_css_js',
			'type' 		=> 'textarea',
			'settings'	=> 'custom_css',
		)
	);

	$wp_customize->add_setting(
		'custom_js',
		array(
			'default' 			=> '',
			'sanitize_callback' => 'entrada_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'custom_js',
		array(
			'label'		=> __('Custom JS', 'entrada'),
			'section' 	=> 'section_custom_css_js',
			'type' 		=> 'textarea',
			'settings'	=> 'custom_js',
		)
	);

	$wp_customize->remove_section("colors");
	$wp_customize->remove_section("header_image");
	$wp_customize->remove_section("background_image");
}
add_action('customize_register', 'entrada_customizer_settings');

/* Custom customizer sanitization start here
................................ */
function entrada_sanitize_text($input)
{

	return wp_kses_post(force_balance_tags(sprintf(__('%s', 'entrada'), $input)));
}

function check_email($value)
{
	return (is_email($value)) ? $value : null;
}

function entrada_check_number($value)
{
	if (!empty($value)) {
		$value = (int) $value; // Force the value into integer type.
		return (0 < $value) ? $value : null;
	} else {
		return '';
	}
}

function entrada_sanitize_textarea($text)
{
	return esc_textarea($text);
}

function entrada_sanitize_hex_color($colour)
{
	return sanitize_hex_color($colour);
}

function entrada_sanitize_url($url)
{
	return esc_url_raw($url);
}

function entrada_sanitize_choices($input, $setting)
{
	global $wp_customize;
	$control = $wp_customize->get_control($setting->id);
	if (array_key_exists($input, $control->choices)) {
		return $input;
	} else {
		return $setting->default;
	}
}

function entrada_sanitize_checkbox($checked)
{
	return ((isset($checked) && true == $checked) ? true : false);
}

function entrada_sanitize_select($input, $setting)
{
	global $wp_customize;
	$input = sanitize_key($input);
	$choices = $wp_customize->get_control($setting->id)->choices;
	return (array_key_exists($input, $choices) ? $input : $setting->default);
}

function entrada_sanitize_analytics($text)
{
	return $text;
}
