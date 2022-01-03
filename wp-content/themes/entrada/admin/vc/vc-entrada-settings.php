<?php
// Check if Visual Composer Integration is On
// =============================================================================
function entrada_visual_composer_integration_on()
{
	return get_option('wpb_entrada_integration', true);
}

function entrada_visual_composer_add_options_tab($tabs)
{
	$tabs['entrada-integration'] = 'Entrada Integration';
	return $tabs;
}

add_filter('vc_settings_tabs', 'entrada_visual_composer_add_options_tab');
add_action('vc_settings_tab-entrada-integration', 'entrada_visual_composer_add_setting_fields');
function entrada_visual_composer_add_setting_fields($vc_settings)
{
	$vc_settings->addSection('entrada-integration', null, 'entarda_visual_composer_options_description');

	$vc_settings->addField('entrada-integration', __('Entrada Integration', 'entrada'), 'entrada_integration', 'entrada_visual_composer_sanitize_checkbox', 'entrada_visual_composer_entrada_integration');

	if (entrada_visual_composer_integration_on()) {
		$vc_settings->addField('entrada-integration', __('Remove Native Elements', 'entrada'),   'entrada_remove_native_elements',   'entrada_visual_composer_sanitize_checkbox', 'entrada_visual_composer_remove_native_elements_callback');
		$vc_settings->addField('entrada-integration', __('Remove Default Templates', 'entrada'), 'entrada_remove_default_templates', 'entrada_visual_composer_sanitize_checkbox', 'entrada_visual_composer_remove_default_templates_callback');

		$vc_settings->addField('entrada-integration', __('Remove Frontend Editor', 'entrada'),   'entrada_disable_frontend_editor',  'entrada_visual_composer_sanitize_checkbox', 'entrada_visual_composer_disable_frontend_editor_callback');

		$vc_settings->addField('entrada-integration', __('Hide Design Options', 'entrada'),      'entrada_hide_design_options', 'entrada_visual_composer_sanitize_checkbox', 'entrada_visual_composer_hide_design_options_callback');
	}
}
function entrada_visual_composer_entrada_integration()
{
	return entrada_visual_composer_options_checkbox('entrada_integration', true, __('Enable', 'entrada'), __('Activate Entrada integration with Visual Composer. This allows for the theme to overwrite certain Visual Composer shortcodes and map in custom shortcodes. Turning this off will make Visual Composer oparate natively without any overwriting being done.', 'entrada'));
}

function entrada_visual_composer_remove_native_elements_callback()
{
	return entrada_visual_composer_options_checkbox('entrada_remove_native_elements', false, __('Enable', 'entrada'), __('Ensures only Entrada styled elements will be used on this site.', 'entrada'));
}

function entrada_visual_composer_remove_default_templates_callback()
{
	return entrada_visual_composer_options_checkbox('entrada_remove_default_templates', false, __('Enable', 'entrada'), __('Recommend if you are hiding native Visual Composer elements.', 'entrada'));
}

function entrada_visual_composer_disable_frontend_editor_callback()
{
	return entrada_visual_composer_options_checkbox('entrada_disable_frontend_editor', false, __('Enable', 'entrada'), __('Hides access to the Frontend editor.', 'entrada'));
}

function entrada_visual_composer_hide_design_options_callback()
{
	return entrada_visual_composer_options_checkbox('entrada_hide_design_options', false, __('Enable', 'entrada'), __('Hides Visual Composer options for which Entrada already provides functionality.', 'entrada'));
}


function entarda_visual_composer_options_description($tab)
{
	if ($tab['id'] == 'wpb_js_composer_settings_entrada-integration') : ?>

		<div class="tab_intro">
			<p class="description">
				<?php _e('Toggle certain Visual Composer features for better integration with Entrada Theme.', 'entrada') ?>
			</p>
		</div>

	<?php endif;
	}

	function entrada_visual_composer_sanitize_checkbox($value)
	{
		return $value;
	}

	function entrada_visual_composer_options_checkbox($setting_id, $default, $label, $description)
	{
		$checked = ($checked = get_option('wpb_js_' . $setting_id, $default)) ? $checked : false; ?>

	<label>
		<input type="checkbox" <?php echo (esc_attr($checked) ? ' checked="checked";' : '') ?> value="1" id="wpb_js_<?php echo esc_attr($setting_id); ?>" name="<?php echo 'wpb_js_' . $setting_id; ?>">
		<?php echo sprintf(__('%s', 'entrada'), $label); ?>
	</label>
	<br />
	<p class="description indicator-hint"><?php echo sprintf(__('%s', 'entrada'), $description); ?></p>
<?php
}

// Set Visual Composer
// =============================================================================
function entrada_visual_composer_set_as_theme()
{
	if (get_option('wpb_js_entrada_hide_design_options', true) && entrada_visual_composer_integration_on()) {
		vc_set_as_theme(true);
	} else {
		add_action('admin_notices', 'entrada_visual_composer_hide_update_notice', -99);
		vc_manager()->disableUpdater();
	}
}

function entrada_visual_composer_hide_update_notice()
{
	remove_action('admin_notices', array(vc_license(), 'adminNoticeLicenseActivation'));
}

add_action('vc_before_init', 'entrada_visual_composer_set_as_theme');


// Remove Default Templates
// =============================================================================

if (get_option('wpb_js_entrada_remove_default_templates', true) && entrada_visual_composer_integration_on()) {
	add_filter('vc_load_default_templates', '__return_empty_array', 1);
}

// Provision Frontend Editor
// =============================================================================

if (entrada_visual_composer_integration_on()) :
	if (function_exists('vc_disable_frontend') && get_option('wpb_js_entrada_disable_frontend_editor', false)) {
		vc_disable_frontend();
	}
	// Remove Default Shortcodes
	// =============================================================================

	if (!function_exists('entrada_visual_composer_remove_default_shortcodes' && entrada_visual_composer_integration_on())) {
		function entrada_visual_composer_remove_default_shortcodes()
		{
			vc_remove_element('vc_column_text');
			vc_remove_element('vc_separator');
			vc_remove_element('vc_text_separator');
			vc_remove_element('vc_message');
			vc_remove_element('vc_facebook');
			vc_remove_element('vc_tweetmeme');
			vc_remove_element('vc_googleplus');
			vc_remove_element('vc_pinterest');
			vc_remove_element('vc_toggle');
			vc_remove_element('vc_single_image');
			vc_remove_element('vc_gallery');
			vc_remove_element('vc_images_carousel');
			vc_remove_element('vc_tabs');
			vc_remove_element('vc_tour');
			vc_remove_element('vc_accordion');
			vc_remove_element('vc_posts_grid');
			vc_remove_element('vc_carousel');
			vc_remove_element('vc_posts_slider');
			vc_remove_element('vc_button');
			vc_remove_element('vc_cta_button');
			vc_remove_element('vc_video');
			vc_remove_element('vc_gmaps');
			vc_remove_element('vc_flickr');
			vc_remove_element('vc_progress_bar');
			vc_remove_element('vc_pie');
			vc_remove_element('vc_wp_search');
			vc_remove_element('vc_wp_meta');
			vc_remove_element('vc_wp_recentcomments');
			vc_remove_element('vc_wp_calendar');
			vc_remove_element('vc_wp_pages');
			vc_remove_element('vc_wp_tagcloud');
			vc_remove_element('vc_wp_custommenu');
			vc_remove_element('vc_wp_text');
			vc_remove_element('vc_wp_posts');
			vc_remove_element('vc_wp_links');
			vc_remove_element('vc_wp_categories');
			vc_remove_element('vc_wp_archives');
			vc_remove_element('vc_wp_rss');
			vc_remove_element('vc_button2');
			vc_remove_element('vc_cta_button2');
			vc_remove_element('vc_custom_heading');
			vc_remove_element('vc_empty_space');
		}

		if (get_option('wpb_js_entrada_remove_native_elements', true)) {
			add_action('vc_before_init', 'entrada_visual_composer_remove_default_shortcodes');
		}
	}
endif; ?>