<?php

if (file_exists(get_template_directory() . '/admin/tgma/class-tgm-plugin-activation.php')) {

	require_once(get_template_directory() . '/admin/tgma/class-tgm-plugin-activation.php');
}



add_action('tgmpa_register', 'entrada_register_required_plugins');

function entrada_register_required_plugins()
{

	$plugins = array(

		array(
			'name'               =>  __('WPBakery Page Builder', 'entrada'),
			'slug'               => 'js_composer',
			'source'             => esc_url('https://cdn2.waituk.com/ocdi/extensions/entrada-447/js_composer.zip'),
			'required'           => true,
			'version'            => '',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),

		array(

			'name'               => __('Slider Revolution', 'entrada'),
			'slug'               => 'revslider',
			'source'             => esc_url('https://cdn2.waituk.com/ocdi/extensions/entrada-447/revslider.zip'),
			'required'           => false,
			'version'            => '',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),

		array(
			'name'               => __('Entrada Post Type', 'entrada'),
			'slug'               => 'entrada-post-type',
			'source'             => esc_url('https://cdn2.waituk.com/ocdi/extensions/entrada-427/entrada-post-type.zip'),
			'required'           => true,
			'version'            => '',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),

		array(
			'name'               => __('Entrada WC Taxonomy', 'entrada'),
			'slug'               => 'entrada-wc-taxonomy',
			'source'             => esc_url('https://cdn2.waituk.com/ocdi/extensions/entrada-427/entrada-wc-taxonomy.zip'),
			'required'           => true,
			'version'            => '',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),

		array(
			'name'               => __('Entrada VC Addons', 'entrada'),
			'slug'               => 'entrada-vc-addons',
			'source'             => esc_url('https://cdn2.waituk.com/ocdi/extensions/entrada-427/entrada-vc-addons.zip'),
			'required'           => true,
			'version'            => '',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),

		array(
			'name'               => __('Entrada Theme Addons', 'entrada'),
			'slug'               => 'entrada-theme-addons',
			'source'             => esc_url('https://cdn2.waituk.com/ocdi/extensions/entrada-427/entrada-theme-addons.zip'),
			'required'           => true,
			'version'            => '',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),



		array(
			'name'      => __('Woocommerce', 'entrada'),
			'slug'      => 'woocommerce',
			'required'  => true,
		),

		array(
			'name'      =>  __('One Click Demo Import', 'entrada'),
			'slug'      => 'one-click-demo-import',
			'required'  => false,
		),

		array(

			'name'      => __('Widget Importer & Exporter', 'entrada'),
			'slug'      => 'widget-importer-exporter',
			'required'  => false,
		),

		array(

			'name'      => __('Contact Form 7', 'entrada'),
			'slug'      => 'contact-form-7',
			'required'  => false,
		),

		array(

			'name'      => __('Customizer Export/Import', 'entrada'),
			'slug'      => 'customizer-export-import',
			'required'  => false,
		),

		array(

			'name'      => __('Regenerate Thumbnails', 'entrada'),
			'slug'      => 'regenerate-thumbnails',
			'required'  => false,
		),



	);


	$config = array(

		'id'           => 'tgmpa',                // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

	);

	tgmpa($plugins, $config);
}
