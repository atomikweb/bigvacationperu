<?php
require_once(get_template_directory() . '/admin/vc/vc-entrada-settings.php');
if (!function_exists('is_plugin_active')) {
	require_once(ABSPATH . '/wp-admin/includes/plugin.php');
}
if (function_exists('js_composer_body_class') && get_option('wpb_js_entrada_integration', true)) {
	require_once(get_template_directory() . '/admin/vc/vc-extended-templates.php');
	require_once(get_template_directory() . '/admin/vc/vc-extended-param.php');
}
