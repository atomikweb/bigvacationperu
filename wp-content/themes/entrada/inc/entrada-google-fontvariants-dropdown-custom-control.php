<?php

if (!class_exists('WP_Customize_Control')) {
	return NULL;
}
/**
 * A class to create a dropdown for all google fonts
 */
class Google_Fontvariants_Dropdown_Custom_Control extends WP_Customize_Control
{
	private $fonts = false;

	public function __construct($manager, $id, $args = array(), $options = array())
	{
		parent::__construct($manager, $id, $args);
	}

	/**
	 * Render the content of the category dropdown
	 *
	 * @return HTML
	 */
	public function render_content()
	{
		$font 		   		 = '';
		$font_updated_value  = '';
		$variant_lists 		 = array();
		$google_api_key		 = get_option('entrada_google_api_key');

		if (empty($google_api_key)) {
			delete_transient('google_fonts_variant_lists');
			echo '<label for="_customize-input-' . $this->id . ' " class="customize-control-title">' . esc_html($this->label) . '</label>';
			$api_url = esc_url('https://developers.google.com/fonts/docs/developer_api');
			echo __('If you want to set up an integration with Google Fonts, you\'ll need to generate API Key.', 'entrada');
			echo ' <a href="' . $api_url . '" target="_blank">' . __('Get API Key', 'entrada') . '</a>';
			echo ' ' . __('and set it via customizer.', 'entrada');
		} else {
			if (false === ($special_query_results = get_transient('google_fonts_variant_lists'))) {
				$googleApi = 'https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=' . $google_api_key;
				$fontContent = wp_remote_get($googleApi, array('sslverify'   => false));

				if (is_array($fontContent) && !is_wp_error($fontContent)) {
					$content = json_decode($fontContent['body']);
					$fonts = $content->items;
					sort($fonts);
					if (!empty($fonts)) {
						foreach ($fonts as $k => $v) {
							$family = str_replace(" ", "+", $v->family);
							$variant_lists[$family] = $v->variants;
						}
					}
				}
				set_transient('google_fonts_variant_lists', $variant_lists, 14 * DAY_IN_SECONDS);
			} else {
				$variant_lists = get_transient('google_fonts_variant_lists');
			}
			$font_updated_value = $this->value();
			if (!empty($font_updated_value)) {
				$exploded_vals 	= explode(':', $font_updated_value);
				$select 		= $exploded_vals[1];
				$font 			= $exploded_vals[0]; ?>
			<?php
						} else {
							if ('body_content_google_fontvariant_setting' == esc_html($this->id) || 'logo_google_fontvariant_setting' == esc_html($this->id)) {
								$font = 'Roboto';
							} else if ('main_heading_google_fontvariant_setting' == esc_html($this->id)) {
								$font = 'Montserrat';
							} else if ('top_bar_google_fontvariant_setting' == esc_html($this->id)) {
								$font = 'Montserrat';
							}
						} ?>
			<label>
				<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
				<select <?php echo sprintf(__('%s', 'entrada'), $this->link()); ?>>
					<option value=""><?php _e('Default',  'entrada'); ?></option>
					<?php
								foreach ($variant_lists as $fontname => $variants) {
									if ($font == $fontname) {
										foreach ($variants as $v) {
											$option_value = $fontname . ':' . $v;
											printf('<option value="%s">%s</option>', $option_value, $v);
										}
									}
								} ?>
				</select>
			</label>
<?php
		}
	}
} ?>