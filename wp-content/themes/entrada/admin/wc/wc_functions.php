<?php

require get_template_directory() . '/admin/wc/wc_custom_field.php';
require get_template_directory() . '/admin/feed/assign_destination.php';
remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10);
remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);
remove_action('woocommerce_before_shop_loop', 'woocommeDirce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

/* Add checkout Form Field Class Name
....................................... */
if (!function_exists('entrada_woocommerce_billing_fields')) {
	function entrada_woocommerce_billing_fields($fields)
	{
		$fields['billing_first_name']['input_class'] 	= array('form-control');
		$fields['billing_last_name']['input_class'] 	= array('form-control');
		$fields['billing_company']['input_class'] 		= array('form-control');
		$fields['billing_email']['input_class'] 		= array('form-control');
		$fields['billing_phone']['input_class'] 		= array('form-control');
		$fields['billing_address_1']['input_class'] 	= array('form-control');
		$fields['billing_address_2']['input_class'] 	= array('form-control');
		$fields['billing_postcode']['input_class'] 		= array('form-control');
		$fields['billing_city']['input_class'] 			= array('form-control');
		$fields['billing_state']['input_class'] 		= array('jcf-ignore');
		$fields['billing_postcode']['input_class'] 		= array('form-control');
		$fields['billing_country']['input_class'] 		= array('filter-select bg-gray country-selectb jcf-ignore');
		$fields['account']['input_class'] 				= array('form-control');
		$fields['account']['placeholder'] 				= __('Username',  'entrada');
		return $fields;
	}
}
add_filter('woocommerce_billing_fields', 'entrada_woocommerce_billing_fields');

/* Add checkout Form Field Class Name
....................................... */
if (!function_exists('entrada_woocommerce_shipping_fields')) {
	function entrada_woocommerce_shipping_fields($fields)
	{
		$fields['shipping_first_name']['input_class'] 	= array('form-control');
		$fields['shipping_last_name']['input_class'] 	= array('form-control');
		$fields['shipping_company']['input_class'] 		= array('form-control');
		$fields['shipping_address_1']['input_class'] 	= array('form-control');
		$fields['shipping_address_2']['input_class'] 	= array('form-control');
		$fields['shipping_postcode']['input_class'] 	= array('form-control');
		$fields['shipping_city']['input_class'] 		= array('form-control');
		$fields['shipping_state']['input_class'] 		= array('jcf-ignore');
		$fields['shipping_postcode']['input_class'] 	= array('form-control');
		$fields['shipping_country']['input_class'] 		= array('filter-select bg-gray country-selectb jcf-ignore');
		return $fields;
	}
}
add_filter('woocommerce_shipping_fields', 'entrada_woocommerce_shipping_fields');

if (!function_exists('entrada_override_checkout_fields')) {
	function entrada_override_checkout_fields($fields)
	{
		$fields['account']['account_password']['input_class'] 	= array('form-control');
		$fields['order']['order_comments']['input_class'] 		= array('form-control');
		$fields['order']['order_comments']['label'] 			= 'Your Comment';
		return $fields;
	}
}
add_filter('woocommerce_checkout_fields', 'entrada_override_checkout_fields');

/* commented out as this css is included in theme now coz woocommerce is a required plugin!
Add a custom stylesheet to replace woocommerce.css
....................................... */
// if (!function_exists('entrada_woocommerce_custom_css')) {
// 	function entrada_woocommerce_custom_css()
// 	{
// 		wp_enqueue_style(
// 			'woocommerce-custom',
// 			get_template_directory_uri() . '/woocommerce/woocommerce.css'
// 		);
// 	}
// }
// add_action('wp_enqueue_scripts', 'entrada_woocommerce_custom_css', 15);

/* Entrada Create Product Category/ Sub-Category
.................................................... */
if (!function_exists('entrada_taxonomy_add_new_meta_field')) {
	function entrada_taxonomy_add_new_meta_field()
	{

		?>
		<div class="form-field">
			<label for="term_meta[activity_level_val]"><?php _e('Activity Level',  'entrada'); ?></label>
			<input type="text" name="term_meta[activity_level_val]" id="term_meta[activity_level_val]" value="">
			<p class="description"><?php _e('Enter a value for Activity Level (1-8)',  'entrada'); ?></p>
		</div>
	<?php
		}
	}
	add_action('activity_level_add_form_fields', 'entrada_taxonomy_add_new_meta_field', 10, 2);

	if (!function_exists('entrada_taxonomy_edit_meta_field')) {
		function entrada_taxonomy_edit_meta_field($term)
		{
			$t_id = $term->term_id;
			$term_meta = get_option("taxonomy_$t_id"); ?>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="term_meta[activity_level_val]"><?php _e('Activity Level',  'entrada'); ?></label></th>
			<td>
				<input type="text" name="term_meta[activity_level_val]" id="term_meta[activity_level_val]" value="<?php echo esc_attr($term_meta['activity_level_val']) ? esc_attr($term_meta['activity_level_val']) : ''; ?>">
				<p class="description"><?php _e('Enter a value for Activity Level (1-8)',  'entrada'); ?></p>
			</td>
		</tr>
	<?php
		}
	}
	add_action('activity_level_edit_form_fields', 'entrada_taxonomy_edit_meta_field', 10, 2);

	/* Save extra taxonomy fields callback function
..................................................... */
	if (!function_exists('entrada_save_taxonomy_custom_meta')) {
		function entrada_save_taxonomy_custom_meta($term_id)
		{
			if (isset($_POST['term_meta'])) {
				$t_id = $term_id;
				$term_meta = get_option("taxonomy_$t_id");
				$cat_keys = array_keys($_POST['term_meta']);
				foreach ($cat_keys as $key) {
					if (isset($_POST['term_meta'][$key])) {
						$term_meta[$key] = $_POST['term_meta'][$key];
					}


					if (isset($_POST['term_meta']['prod_featured_cat_val'])) {
						$term_meta['prod_featured_cat_val'] = '_yes';
					} else {
						$term_meta['prod_featured_cat_val'] = '';
					}

					if (isset($_POST['term_meta']['prod_iconbar_cat_val'])) {
						$term_meta['prod_iconbar_cat_val'] = '_yes';
					} else {
						$term_meta['prod_iconbar_cat_val'] = '';
					}

					if (isset($_POST['term_meta']['prod_featured_home_val'])) {
						$term_meta['prod_featured_home_val'] = '_yes';
					} else {
						$term_meta['prod_featured_home_val'] = '';
					}
				}
				update_option("taxonomy_$t_id", $term_meta);
			}
		}
	}
	add_action('edited_activity_level', 'entrada_save_taxonomy_custom_meta', 10, 2);
	add_action('create_activity_level', 'entrada_save_taxonomy_custom_meta', 10, 2);

	/* Set Icomoon Class on Back end */
	if (!function_exists('entrada_set_icomoon_class_selector')) {
		function entrada_set_icomoon_class_selector()
		{
			$html = '';
			global $icon_array;
			add_thickbox();
			$html .= '<div id="ico-class" style="display:none;">';
			$html .= '<p>' . __('Select Icomoon class here.', 'entrada') . '</p>';
			$html .= '<table width="100%" class="widefat fixed comments entrada-icomoon-select" style="padding-bottom:20px;"><tr>';

			ksort($icon_array);
			$cnt = 0;
			foreach ($icon_array as $key => $val) {
				$cnt++;
				$html .= '<td><a href="javascript:void(null);"><span class="' . $val . '"></span> ' . ucwords(str_replace('-', '', $key)) . '</a></td>';
				if ($cnt % 3 == 0) {
					$html .= '</tr><tr>';
				}
			}
			$html .= '</tr></table>';
			$html .= '</div>';
			echo sprintf(__('%s', 'entrada'), $html); ?>
		<script type="text/javascript">
			if (!jQuery('.set_icon_demo_val').val()) {
				jQuery('.remove-icon-span').hide();
			}
			jQuery(document).ready(function($) {
				$(".entrada-icomoon-select tr td a").click(function() {
					var icomoon_class_name = $(this).find('span').attr('class');
					$('.set-icon-demo').html(' <i class="' + icomoon_class_name + '"></i>');
					$('.set_icon_demo_val').val(icomoon_class_name);
					self.parent.tb_remove();
					$('.remove-icon-span').show();
					return false;
				});
				$(".remove-icon").click(function() {
					$('.set_icon_demo_val').val('');
					$('.set-icon-demo').html('');
					$('.remove-icon-span').hide();
				});
			});
		</script>
		<?php
			}
		}
		add_action('admin_footer', 'entrada_set_icomoon_class_selector');

		/* Image resize for product
.................................*/
		if (!function_exists('entrada_product_resized_img')) {
			function entrada_product_resized_img($post_id, $resize = array(550, 358))
			{
				global $wpdb;
				$badge_img = '';
				$html = '';
				$image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'single-post-thumbnail');
				if (!empty($image_url[0])) {
					$html .= '<div class="img-wrap">' . get_the_post_thumbnail($post_id, $resize, array('itemprop' => 'image'));
					$sale_price = get_post_meta($post_id, '_sale_price', true);
					$custom_badge = get_post_meta($post_id, 'custom_badge', true);
					$entrada_prod_sale_offer = entrada_check_product_sale_offer($post_id);
					$html .= '<div class="product-badge"><ul>';
					if (!empty($entrada_prod_sale_offer)) {
						$badge_img = get_theme_mod('sale_badge_image');
						if (empty($badge_img)) {
							$badge_img = get_template_directory_uri() . '/img/badge-sale.svg';
						}
						$html .= '<li><img src="' . $badge_img . '" alt="sale"></li>';
					}

					$html .= entrada_custom_badges($post_id);
					$html .= '</ul></div></div>';
				}
				return $html;
			}
		}

		/* Custom Badges for product
.................................*/
		if (!function_exists('entrada_custom_badges')) {
			function entrada_custom_badges($post_id)
			{
				$entrada_badges = '';
				$custom_badge_onoff = get_theme_mod('custom_badge_onoff');
				if (isset($custom_badge_onoff) && $custom_badge_onoff == 'cs_yes') {
					for ($j = 1; $j <= 5; $j++) {
						$custom_badge = get_post_meta($post_id, 'custom_badge' . $j, true);
						$custom_badge_image = get_theme_mod('custom_badge_image' . $j);
						if ((isset($custom_badge_image) && !empty($custom_badge_image)) && (isset($custom_badge) && !empty($custom_badge))) {

							$entrada_badges .= '<li><img src="' . $custom_badge_image . '" alt="Bages"></li>';
						}
					}
				}

				return $entrada_badges;
			}
		}

		/* Schema micro data price offer
.................................*/
		if (!function_exists('entrada_price_schema_micro_data_link')) {
			function entrada_price_schema_micro_data_link($post_id)
			{
				global $wpdb;
				$link = 'itemprop="offers" itemscope itemtype="http://schema.org/Offer"';
				$entrada_prod_sale_offer = entrada_check_product_sale_offer($post_id);
				if (!empty($entrada_prod_sale_offer)) {
					$link = 'itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer"';
				}
				return $link;
			}
		}

		/* check if product has sale/offer
.................................*/
		if (!function_exists('entrada_check_product_sale_offer')) {
			function entrada_check_product_sale_offer($post_id)
			{
				global $wpdb;
				$product = wc_get_product($post_id);
				$on_sale = '';
				if ((null !== $product->get_type()) && ($product->get_type() == "variable")) {
					$available_variations = $product->get_available_variations();
					foreach ($available_variations as $av) {
						$variation_id = $av['variation_id'];
						$variable_product1 = new WC_Product_Variation($variation_id);
						$sales_price = $variable_product1->get_sale_price();
						if (!empty($sales_price)) {
							$on_sale = 'sale';
						}
					}
				} else {
					$sale_price = get_post_meta($product->get_id(), '_sale_price', true);
					if (!empty($sale_price)) {
						$on_sale = 'sale';
					}
				}
				return $on_sale;
			}
		}

		if (!function_exists('entrada_social_media_share_img')) {
			function entrada_social_media_share_img($post_id)
			{
				$img_src = '';
				$image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), array(550, 358));
				if (!empty($image_url[0])) {
					$img_src = 	$image_url[0];
				}
				return $img_src;
			}
		}

		if (!function_exists('entrada_taxonomy_tinycme_hide_description')) {
			function entrada_taxonomy_tinycme_hide_description()
			{
				global $pagenow;

				//only hide on detail not yet on the overview page.
				if ((isset($_GET['taxonomy']) && ($_GET['taxonomy'] == 'product_cat' || $_GET['taxonomy'] == 'destination'))) :    ?>
			<script type="text/javascript">
				jQuery(function($) {
					$('.term-description-wrap').remove();
				});
			</script><?php endif;
							}
						}
						add_action('admin_head', 'entrada_taxonomy_tinycme_hide_description');

						/* Product Sub Category
.................................*/
						if (!function_exists('entrada_product_cat_add_new_meta_field')) {
							function entrada_product_cat_add_new_meta_field()
							{
								$upload_dir = wp_upload_dir();
								$content_dir = str_replace("uploads", "", $upload_dir['basedir']);
								$content_url = str_replace("uploads", "", $upload_dir['baseurl']);

								$default_img = '';
								if (file_exists($content_dir . 'plugins/woocommerce/assets/images/placeholder.png')) {
									$default_img = $content_url . 'plugins/woocommerce/assets/images/placeholder.png';
								} ?>

		<div class="form-field">
			<label for="description"><?php _e('Description',  'entrada'); ?></label>

			<?php $settings = array('wpautop' => true, 'media_buttons' => true, 'quicktags' => true, 'textarea_rows' => '15', 'textarea_name' => 'description');
					wp_editor(html_entity_decode('', ENT_QUOTES, 'UTF-8'), 'description', $settings); ?>
			<p class="description"><?php _e('The description is not prominent by default, however some themes may show it.',  'entrada'); ?></p>
		</div>


		<div class="form-field">
			<label for="term_meta[prod_cat_best_season]"><?php _e('Best Seasons',  'entrada'); ?></label>
			<input type="text" name="term_meta[prod_cat_best_season]" id="term_meta[prod_cat_best_season]" value="">
			<p class="description"><?php _e('Add best seasons here. ( E. g. May, June, July, August)',  'entrada'); ?></p>
		</div>

		<div class="form-field">
			<label for="term_meta[prod_cat_popular_location]"><?php _e('Popular Location',  'entrada'); ?></label>
			<input type="text" name="term_meta[prod_cat_popular_location]" id="term_meta[prod_cat_popular_location]" value="">
			<p class="description"><?php _e('Add popular location here. ( E. g. Madrid, Bhamas, Phuket, Sydney)',  'entrada'); ?></p>
		</div>

		<div class="form-field">
			<label for="term_meta[prod_cat_heading]"><?php _e('Heading',  'entrada'); ?></label>
			<input type="text" name="term_meta[prod_cat_heading]" id="term_meta[prod_cat_heading]" value="">
			<p class="description"><?php _e('Add Category heading here. ( E. g.Urban City Tours)',  'entrada'); ?></p>
		</div>

		<div class="form-field">
			<label for="term_meta[prod_cat_sub_heading]"><?php _e('Sub-heading',  'entrada'); ?></label>
			<input type="text" name="term_meta[prod_cat_sub_heading]" id="term_meta[prod_cat_sub_heading]" value="">
			<p class="description"><?php _e('Add Category sub-heading here.',  'entrada'); ?></p>
		</div>

		<div class="form-field">
			<label for="term_meta[prod_cat_sub_title]"><?php _e('Category Title',  'entrada'); ?></label>
			<input type="text" name="term_meta[prod_cat_sub_title]" id="term_meta[prod_cat_sub_title]" value="">
			<p class="description"><?php _e('Add Category title here.',  'entrada'); ?></p>
		</div>

		<div class="form-field">
			<label for="term_meta[prod_cat_listing_title]"><?php _e('Listing Title',  'entrada'); ?></label>
			<input type="text" name="term_meta[prod_cat_listing_title]" id="term_meta[prod_cat_listing_title]" value="">
			<p class="description"><?php _e('Add tour listing title in category here.',  'entrada'); ?></p>
		</div>

		<div class="form-field">
			<label for="term_meta[prod_cat_listing_sub_title]"><?php _e('Listing Sub-title',  'entrada'); ?></label>
			<input type="text" name="term_meta[prod_cat_listing_sub_title]" id="term_meta[prod_cat_listing_sub_title]" value="">
			<p class="description"><?php _e('Add tour listing sub-title in category here.',  'entrada'); ?></p>
		</div>

		<div class="form-field">
			<label for="term_meta[prod_cat_dig_more_link]"><?php _e('Custom Link for Icons on Iconbar',  'entrada'); ?></label>
			<input type="text" name="term_meta[prod_cat_dig_more_link]" id="term_meta[prod_cat_dig_more_link]" value="">
			<p class="description"><?php _e('Add link here, if you want custom link on iconbar. ( E. g. http://entrada.com/xxxx/)',  'entrada'); ?></p>
		</div>

		<div class="form-field">
			<label><?php _e('Banner Image',  'entrada'); ?></label>
			<div id="product_cat_banner_img" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url($default_img); ?>" width="60px" height="60px" /></div>
			<div style="line-height: 60px;">
				<input type="hidden" id="product_cat_banner_img_id" name="term_meta[product_cat_banner_img_id]" />
				<button type="button" class="upload_banner_img_button button"><?php _e('Upload/Add image',  'entrada'); ?></button>
				<button type="button" class="remove_banner_img_button button"><?php _e('Remove Image',  'entrada'); ?></button>
			</div>
			<script type="text/javascript">
				if (!jQuery('#product_cat_banner_img_id').val()) {
					jQuery('.remove_banner_img_button').hide();
				}
				var banner_file_frame;

				jQuery(document).on('click', '.upload_banner_img_button', function(event) {
					event.preventDefault();
					if (banner_file_frame) {
						banner_file_frame.open();
						return;
					}
					banner_file_frame = wp.media.frames.downloadable_file = wp.media({
						title: 'Choose an image',
						button: {
							text: 'Use image'
						},
						multiple: false
					});
					banner_file_frame.on('select', function() {
						var attachment = banner_file_frame.state().get('selection').first().toJSON();
						jQuery('#product_cat_banner_img_id').val(attachment.id);
						jQuery('#product_cat_banner_img').find('img').attr('src', attachment.sizes.thumbnail.url);
						jQuery('.remove_banner_img_button').show();
					});
					banner_file_frame.open();
				});

				jQuery(document).on('click', '.remove_banner_img_button', function() {
					jQuery('#product_cat_banner_img').find('img').attr('src', '<?php echo esc_url($default_img); ?>');
					jQuery('#product_cat_banner_img_id').val('');
					jQuery('.remove_banner_img_button').hide();
					return false;
				});
			</script>
			<div class="clear"></div>
		</div>

		<div class="form-field">
			<label><?php _e('Info Box Image',  'entrada'); ?></label>
			<div id="product_cat_map_img" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url($default_img); ?>" width="60px" height="60px" /></div>
			<div style="line-height: 60px;">
				<input type="hidden" id="product_cat_map_img_id" name="term_meta[product_cat_map_img_id]" />
				<button type="button" class="upload_map_img_button button"><?php _e('Upload/Add image',  'entrada'); ?></button>
				<button type="button" class="remove_map_img_button button"><?php _e('Remove image',  'entrada'); ?></button>
			</div>
			<script type="text/javascript">
				if (!jQuery('#product_cat_map_img_id').val()) {
					jQuery('.remove_map_img_button').hide();
				}
				var map_file_frame;
				jQuery(document).on('click', '.upload_map_img_button', function(event) {
					event.preventDefault();
					if (map_file_frame) {
						map_file_frame.open();
						return;
					}
					map_file_frame = wp.media.frames.downloadable_file = wp.media({
						title: 'Choose an image',
						button: {
							text: 'Use image'
						},
						multiple: false
					});
					map_file_frame.on('select', function() {
						var attachment = map_file_frame.state().get('selection').first().toJSON();

						jQuery('#product_cat_map_img_id').val(attachment.id);
						jQuery('#product_cat_map_img').find('img').attr('src', attachment.sizes.thumbnail.url);
						jQuery('.remove_map_img_button').show();
					});
					map_file_frame.open();
				});

				jQuery(document).on('click', '.remove_map_img_button', function() {
					jQuery('#product_cat_map_img').find('img').attr('src', '<?php echo esc_url($default_img); ?>');
					jQuery('#product_cat_map_img_id').val('');
					jQuery('.remove_map_img_button').hide();
					return false;
				});
			</script>
			<div class="clear"></div>
		</div>

		<div class="form-field">
			<input type="checkbox" value="_yes" name="term_meta[prod_iconbar_cat_val]" id="term_meta[prod_iconbar_cat_val]"><?php _e('Iconbar category',  'entrada'); ?>
			<p class="description"><?php _e('Displays on iconbar home template.',  'entrada'); ?></p>
		</div>

		<div class="form-field">
			<input type="checkbox" value="_yes" name="term_meta[prod_featured_home_val]" id="term_meta[prod_featured_home_val]"><?php _e('Set to display on homepage',  'entrada'); ?>
			<p class="description"><?php _e('Displays on home page.',  'entrada'); ?></p>
		</div>

		<div class="form-field">
			<input type="checkbox" value="_yes" name="term_meta[prod_featured_cat_val]" id="term_meta[prod_featured_cat_val]"><?php _e('Set featured category',  'entrada'); ?>
			<p class="description"><?php _e('Displays on sidebar filter option.',  'entrada'); ?></p>
		</div>

		<div class="form-field">
			<label for="term_meta[activity_level_val]" class="choose_icon_label"><?php _e('Choose Icon',  'entrada'); ?></label>
			<div class="set_icon-wrap">
				<span class="set-icon-demo"></span>
				<span> <a href="#TB_inline?width=600&height=550&inlineId=ico-class" class="thickbox"><?php _e('Set Icon',  'entrada'); ?></a></span>
				<span class="remove-icon-span"> <a href="javascript:void(null);" class="remove-icon"><?php _e('Remove',  'entrada'); ?></a></span>
				<input type="hidden" class="set_icon_demo_val" name="term_meta[prod_icomoon_cat_val]" id="term_meta[prod_icomoon_cat_val]" value="">
			</div>
			<p class="description"><?php _e('Select icon for this category.',  'entrada'); ?></p>
		</div>
	<?php
		}
	}
	add_action('product_cat_add_form_fields', 'entrada_product_cat_add_new_meta_field', 10, 2);

	if (!function_exists('entrada_product_cat_edit_meta_field')) {
		function entrada_product_cat_edit_meta_field($term)
		{
			$t_id = $term->term_id;
			$term_meta = get_option("taxonomy_$t_id");

			if (!isset($term_meta) && $term_meta == '') {
				$term_meta = array();
			}

			$upload_dir = wp_upload_dir();
			$content_dir = str_replace("uploads", "", $upload_dir['basedir']);
			$content_url = str_replace("uploads", "", $upload_dir['baseurl']);

			$default_img = '';
			$banner_img_src = '';
			$map_img_src = '';


			if (file_exists($content_dir . 'plugins/woocommerce/assets/images/placeholder.png')) {
				$default_img = $content_url . 'plugins/woocommerce/assets/images/placeholder.png';
			}

			if (array_key_exists('product_cat_banner_img_id', $term_meta) && $term_meta['product_cat_banner_img_id']  != '') {
				$banner_img_src = wp_get_attachment_url($term_meta['product_cat_banner_img_id']);
			}

			if (array_key_exists('product_cat_map_img_id', $term_meta) && $term_meta['product_cat_map_img_id']  != '') {
				$map_img_src = wp_get_attachment_url($term_meta['product_cat_map_img_id']);
			} ?>

		<tr class="form-field">
			<th scope="row" valign="top"><label for="description"><?php _e('Description',  'entrada'); ?></label></th>
			<td>
				<?php $editor_settings = array('wpautop' => true, 'media_buttons' => true, 'quicktags' => array('buttons' => 'strong,em,del,ul,ol,li,close'), 'textarea_rows' => '15', 'textarea_name' => 'description');

						wp_editor(html_entity_decode($term->description, ENT_QUOTES, 'UTF-8'), 'product_description2', $editor_settings); ?>
				<br />
				<span class="description"><?php _e('The description is not prominent by default, however some themes may show it.',  'entrada'); ?></span>
			</td>
		</tr>


		<tr class="form-field">
			<th scope="row" valign="top"><label for="term_meta[prod_cat_best_season]"><?php _e('Best Seasons',  'entrada'); ?></label></th>
			<td>
				<input type="text" name="term_meta[prod_cat_best_season]" id="term_meta[prod_cat_best_season]" value="<?php echo (array_key_exists('prod_cat_best_season', $term_meta))  ? esc_attr($term_meta['prod_cat_best_season']) : ''; ?>">
				<p class="description"><?php _e('Add best seasons here. ( E. g. May, June, July, August).',  'entrada'); ?></p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top"><label for="term_meta[prod_cat_popular_location]"><?php _e('Popular Location',  'entrada'); ?></label></th>
			<td>
				<input type="text" name="term_meta[prod_cat_popular_location]" id="term_meta[prod_cat_popular_location]" value="<?php echo (array_key_exists('prod_cat_popular_location', $term_meta)) ? esc_attr($term_meta['prod_cat_popular_location']) : ''; ?>">
				<p class="description"><?php _e('Add popular location here. ( E. g. Madrid, Bhamas, Phuket, Sydney).',  'entrada'); ?></p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top"><label for="term_meta[prod_cat_heading]"><?php _e('Heading',  'entrada'); ?></label></th>
			<td>
				<input type="text" name="term_meta[prod_cat_heading]" id="term_meta[prod_cat_heading]" value="<?php echo (array_key_exists('prod_cat_heading', $term_meta)) ? esc_attr($term_meta['prod_cat_heading']) : ''; ?>">
				<p class="description"><?php _e('Add Category heading here. ( E. g.Urban City Tours).',  'entrada'); ?></p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top"><label for="term_meta[prod_cat_sub_heading]"><?php _e('Sub-heading',  'entrada'); ?></label></th>
			<td>
				<input type="text" name="term_meta[prod_cat_sub_heading]" id="term_meta[prod_cat_sub_heading]" value="<?php echo (array_key_exists('prod_cat_sub_heading', $term_meta)) ? esc_attr($term_meta['prod_cat_sub_heading']) : ''; ?>">
				<p class="description"><?php _e('Add Category sub-heading here.',  'entrada'); ?></p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top"><label for="term_meta[prod_cat_sub_title]"><?php _e('Category Title',  'entrada'); ?></label></th>
			<td>
				<input type="text" name="term_meta[prod_cat_sub_title]" id="term_meta[prod_cat_sub_title]" value="<?php echo (array_key_exists('prod_cat_sub_title', $term_meta)) ? esc_attr($term_meta['prod_cat_sub_title']) : ''; ?>">
				<p class="description"><?php _e('Add Category title here.',  'entrada'); ?></p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top"><label for="term_meta[prod_cat_listing_title]"><?php _e('Listing Title',  'entrada'); ?></label></th>
			<td>
				<input type="text" name="term_meta[prod_cat_listing_title]" id="term_meta[prod_cat_listing_title]" value="<?php echo (array_key_exists('prod_cat_listing_title', $term_meta)) ? esc_attr($term_meta['prod_cat_listing_title']) : ''; ?>">
				<p class="description"><?php _e('Add tour listing title in category here.',  'entrada'); ?></p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top"><label for="term_meta[prod_cat_listing_sub_title]"><?php _e('Listing Sub-title',  'entrada'); ?></label></th>
			<td>
				<input type="text" name="term_meta[prod_cat_listing_sub_title]" id="term_meta[prod_cat_listing_sub_title]" value="<?php echo (array_key_exists('prod_cat_listing_sub_title', $term_meta)) ? esc_attr($term_meta['prod_cat_listing_sub_title']) : ''; ?>">
				<p class="description"><?php _e('Add tour listing sub-title in category here.',  'entrada'); ?></p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top"><label for="term_meta[prod_cat_dig_more_link]"><?php _e('Custom Link for Icons on Iconbar',  'entrada'); ?></label></th>
			<td>
				<input type="text" name="term_meta[prod_cat_dig_more_link]" id="term_meta[prod_cat_dig_more_link]" value="<?php echo (array_key_exists('prod_cat_dig_more_link', $term_meta))  ? esc_attr($term_meta['prod_cat_dig_more_link']) : ''; ?>">
				<p class="description"><?php _e('Add link here, if you want custom link on iconbar. ( E. g. http://entrada.com/xxxx/)',  'entrada'); ?></p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top">
				<label><?php _e('Banner Image',  'entrada'); ?></label>
			</th>
			<td>
				<div id="product_cat_banner_img" style="float: left; margin-right: 10px;"><img src="<?php echo esc_attr($banner_img_src) ? esc_attr($banner_img_src) : $default_img; ?>" width="60px" height="60px" /></div>
				<div style="line-height: 60px;">
					<input type="hidden" id="product_cat_banner_img_id" name="term_meta[product_cat_banner_img_id]" value="<?php echo (array_key_exists('product_cat_banner_img_id', $term_meta) && $term_meta['product_cat_banner_img_id'] != '')  ? esc_attr($term_meta['product_cat_banner_img_id']) : ''; ?>" />
					<button type="button" class="upload_banner_img_button button"><?php _e('Upload/Add image',  'entrada'); ?></button>
					<button type="button" class="remove_banner_img_button button" style="display:<?php echo esc_attr($banner_img_src) ? 'inline-block' : 'none'; ?>"><?php _e('Remove image',  'entrada'); ?></button>
				</div>
				<script type="text/javascript">
					// Only show the "remove image" button when needed
					if (!jQuery('#product_cat_banner_img_id').val()) {
						jQuery('.remove_banner_img_button').hide();
					}
					// Uploading files
					var banner_file_frame;
					jQuery(document).on('click', '.upload_banner_img_button', function(event) {
						event.preventDefault();
						// If the media frame already exists, reopen it.
						if (banner_file_frame) {
							banner_file_frame.open();
							return;
						}
						// Create the media frame.
						banner_file_frame = wp.media.frames.downloadable_file = wp.media({
							title: 'Choose an image',
							button: {
								text: 'Use image'
							},
							multiple: false
						});
						// When an image is selected, run a callback.
						banner_file_frame.on('select', function() {
							var attachment = banner_file_frame.state().get('selection').first().toJSON();

							jQuery('#product_cat_banner_img_id').val(attachment.id);
							jQuery('#product_cat_banner_img').find('img').attr('src', attachment.sizes.thumbnail.url);
							jQuery('.remove_banner_img_button').show();
						});
						// Finally, open the modal.
						banner_file_frame.open();
					});
					jQuery(document).on('click', '.remove_banner_img_button', function() {
						jQuery('#product_cat_banner_img').find('img').attr('src', '<?php echo esc_url($default_img); ?>');
						jQuery('#product_cat_banner_img_id').val('');
						jQuery('.remove_banner_img_button').hide();
						return false;
					});
				</script>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label><?php _e('Info Box Image',  'entrada'); ?></label>
			</th>
			<td>
				<div id="product_cat_map_img" style="float: left; margin-right: 10px;"><img src="<?php echo esc_attr($map_img_src) ? esc_attr($map_img_src) : $default_img; ?>" width="60px" height="60px" /></div>
				<div style="line-height: 60px;">
					<input type="hidden" id="product_cat_map_img_id" name="term_meta[product_cat_map_img_id]" value="<?php echo (array_key_exists('product_cat_map_img_id', $term_meta))  ? esc_attr($term_meta['product_cat_map_img_id']) : ''; ?>" />
					<button type="button" class="upload_map_img_button button"><?php _e('Upload/Add image',  'entrada'); ?></button>
					<button type="button" class="remove_map_img_button button" style="display:<?php echo esc_attr($map_img_src) ? 'inline-block' : 'none'; ?>"><?php _e('Remove image',  'entrada'); ?></button>
				</div>
				<script type="text/javascript">
					if (!jQuery('#product_cat_map_img_id').val()) {
						jQuery('.remove_map_img_button').hide();
					}
					var map_file_frame;
					jQuery(document).on('click', '.upload_map_img_button', function(event) {
						event.preventDefault();
						if (map_file_frame) {
							map_file_frame.open();
							return;
						}
						map_file_frame = wp.media.frames.downloadable_file = wp.media({
							title: 'Choose an image',
							button: {
								text: 'Use image'
							},
							multiple: false
						});
						map_file_frame.on('select', function() {
							var attachment = map_file_frame.state().get('selection').first().toJSON();

							jQuery('#product_cat_map_img_id').val(attachment.id);
							jQuery('#product_cat_map_img').find('img').attr('src', attachment.sizes.thumbnail.url);
							jQuery('.remove_map_img_button').show();
						});
						map_file_frame.open();
					});
					jQuery(document).on('click', '.remove_map_img_button', function() {
						jQuery('#product_cat_map_img').find('img').attr('src', '<?php echo esc_url($default_img); ?>');
						jQuery('#product_cat_map_img_id').val('');
						jQuery('.remove_map_img_button').hide();
						return false;
					});
				</script>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top"><label for="term_meta[prod_iconbar_cat_val]"><?php _e('Iconbar Category',  'entrada'); ?></label></th>
			<td>
				<input type="checkbox" value="_yes" <?php echo !empty($term_meta['prod_iconbar_cat_val']) ?  'checked="checked"'  : ''; ?> name="term_meta[prod_iconbar_cat_val]" id="term_meta[prod_iconbar_cat_val]"> <span class="description"><?php _e('Displays on iconbar home template.',  'entrada'); ?></span>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top"><label for="term_meta[prod_featured_home_val]"><?php _e('Homepage Tour Category',  'entrada'); ?></label></th>
			<td>
				<input type="checkbox" value="_yes" <?php echo !empty($term_meta['prod_featured_home_val']) ?  'checked="checked"'  : ''; ?> name="term_meta[prod_featured_home_val]" id="term_meta[prod_featured_home_val]"> <span class="description"><?php _e('Displays on home page.',  'entrada'); ?></span>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top"><label for="term_meta[prod_featured_cat_val]"><?php _e('Featured Category',  'entrada'); ?></label></th>
			<td>
				<input type="checkbox" value="_yes" <?php echo !empty($term_meta['prod_featured_cat_val']) ?  'checked="checked"'  : ''; ?> name="term_meta[prod_featured_cat_val]" id="term_meta[prod_featured_cat_val]"> <span class="description"><?php _e('Displays on sidebar filter option.',  'entrada'); ?></span>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top"><label for="term_meta[prod_featured_cat_val]"><?php _e('Select Icon',  'entrada'); ?></label></th>
			<td>
				<div class="set_icon-wrap">
					<span class="set-icon-demo">
						<?php
								if (isset($term_meta['prod_icomoon_cat_val'])) {
									echo '<i class="' . $term_meta['prod_icomoon_cat_val'] . '"></i>';
								} ?>
					</span>
					<span> <a href="#TB_inline?width=600&height=550&inlineId=ico-class" class="thickbox"><?php _e('Set Icon',  'entrada'); ?></a> </span>
					<span class="remove-icon-span"> <a href="javascript:void(null);" class="remove-icon"> <?php _e('Remove',  'entrada'); ?></a></span>
					<input type="hidden" class="set_icon_demo_val" name="term_meta[prod_icomoon_cat_val]" id="term_meta[prod_icomoon_cat_val]" value="<?php if (isset($term_meta['prod_icomoon_cat_val'])) {

																																									echo sprintf(__('%s', 'entrada'), $term_meta['prod_icomoon_cat_val']);
																																								} ?>">
				</div>
				<p class="description"><?php _e('Displays on sidebar filter option.',  'entrada'); ?></p>
			</td>
		</tr>
	<?php
		}
	}
	add_action('product_cat_edit_form_fields', 'entrada_product_cat_edit_meta_field', 10, 2);
	add_action('edited_product_cat', 'entrada_save_taxonomy_custom_meta', 10, 2);
	add_action('create_product_cat', 'entrada_save_taxonomy_custom_meta', 10, 2);

	/* Product Destination
.................................*/
	if (!function_exists('entrada_load_wp_media_files')) {
		function entrada_load_wp_media_files()
		{
			wp_enqueue_media();
		}
	}
	add_action('admin_enqueue_scripts', 'entrada_load_wp_media_files');

	if (!function_exists('entrada_destination_add_new_meta_field')) {
		function entrada_destination_add_new_meta_field()
		{
			$upload_dir = wp_upload_dir();
			$content_dir = str_replace("uploads", "", $upload_dir['basedir']);
			$content_url = str_replace("uploads", "", $upload_dir['baseurl']);
			$default_img = '';
			if (file_exists($content_dir . 'plugins/woocommerce/assets/images/placeholder.png')) {
				$default_img = $content_url . 'plugins/woocommerce/assets/images/placeholder.png';
			} ?>

		<div class="form-field">
			<label for="description"><?php _e('Description',  'entrada'); ?></label>

			<?php $settings = array('wpautop' => true, 'media_buttons' => true, 'quicktags' => true, 'textarea_rows' => '15', 'textarea_name' => 'description');

					wp_editor(html_entity_decode('', ENT_QUOTES, 'UTF-8'), 'description', $settings); ?>
			<p class="description"><?php _e('The description is not prominent by default, however some themes may show it.',  'entrada'); ?></p>
		</div>

		<div class="form-field">
			<label for="term_meta[prod_cat_best_season]"><?php _e('Best Seasons',  'entrada'); ?></label>
			<input type="text" name="term_meta[prod_cat_best_season]" id="term_meta[prod_cat_best_season]" value="">
			<p class="description"><?php _e('Add best seasons here. ( E. g. May, June, July, August)',  'entrada'); ?></p>
		</div>

		<div class="form-field">
			<label for="term_meta[prod_cat_popular_location]"><?php _e('Popular Location',  'entrada'); ?></label>
			<input type="text" name="term_meta[prod_cat_popular_location]" id="term_meta[prod_cat_popular_location]" value="">
			<p class="description"><?php _e('Add popular location here. ( E. g. Madrid, Bhamas, Phuket, Sydney)',  'entrada'); ?></p>
		</div>

		<div class="form-field">
			<label for="term_meta[prod_cat_heading]"><?php _e('Heading',  'entrada'); ?></label>
			<input type="text" name="term_meta[prod_cat_heading]" id="term_meta[prod_cat_heading]" value="">
			<p class="description"><?php _e('Add Category heading here. ( E. g.Urban City Tours)',  'entrada'); ?></p>
		</div>

		<div class="form-field">
			<label for="term_meta[prod_cat_sub_heading]"><?php _e('Sub-heading',  'entrada'); ?></label>
			<input type="text" name="term_meta[prod_cat_sub_heading]" id="term_meta[prod_cat_sub_heading]" value="">
			<p class="description"><?php _e('Add Category sub-heading here.',  'entrada'); ?></p>
		</div>

		<div class="form-field">
			<label for="term_meta[prod_cat_sub_title]"><?php _e('Category Title',  'entrada'); ?></label>
			<input type="text" name="term_meta[prod_cat_sub_title]" id="term_meta[prod_cat_sub_title]" value="">
			<p class="description"><?php _e('Add Category title here.',  'entrada'); ?></p>
		</div>

		<div class="form-field">
			<label for="term_meta[prod_cat_listing_title]"><?php _e('Listing Title',  'entrada'); ?></label>
			<input type="text" name="term_meta[prod_cat_listing_title]" id="term_meta[prod_cat_listing_title]" value="">
			<p class="description"><?php _e('Add tour listing title in category here.',  'entrada'); ?></p>
		</div>

		<div class="form-field">
			<label for="term_meta[prod_cat_listing_sub_title]"><?php _e('Listing Sub-title',  'entrada'); ?></label>
			<input type="text" name="term_meta[prod_cat_listing_sub_title]" id="term_meta[prod_cat_listing_sub_title]" value="">
			<p class="description"><?php _e('Add tour listing sub-title in category here.',  'entrada'); ?></p>
		</div>

		<div class="form-field">
			<label><?php _e('Banner Image',  'entrada'); ?></label>
			<div id="product_cat_banner_img" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url($default_img); ?>" width="60px" height="60px" /></div>
			<div style="line-height: 60px;">
				<input type="hidden" id="product_cat_banner_img_id" name="term_meta[product_cat_banner_img_id]" />
				<button type="button" class="upload_banner_img_button button"><?php _e('Upload/Add image',  'entrada'); ?></button>
				<button type="button" class="remove_banner_img_button button"><?php _e('Remove image',  'entrada'); ?></button>
			</div>
			<script type="text/javascript">
				if (!jQuery('#product_cat_banner_img_id').val()) {
					jQuery('.remove_banner_img_button').hide();
				}
				var banner_file_frame;
				jQuery(document).on('click', '.upload_banner_img_button', function(event) {
					event.preventDefault();
					if (banner_file_frame) {
						banner_file_frame.open();
						return;
					}
					banner_file_frame = wp.media.frames.downloadable_file = wp.media({
						title: 'Choose an image',
						button: {
							text: 'Use image'
						},
						multiple: false
					});
					banner_file_frame.on('select', function() {
						var attachment = banner_file_frame.state().get('selection').first().toJSON();
						jQuery('#product_cat_banner_img_id').val(attachment.id);
						jQuery('#product_cat_banner_img').find('img').attr('src', attachment.sizes.thumbnail.url);
						jQuery('.remove_banner_img_button').show();
					});
					banner_file_frame.open();
				});
				jQuery(document).on('click', '.remove_banner_img_button', function() {
					jQuery('#product_cat_banner_img').find('img').attr('src', '<?php echo esc_url($default_img); ?>');
					jQuery('#product_cat_banner_img_id').val('');
					jQuery('.remove_banner_img_button').hide();
					return false;
				});
			</script>
			<div class="clear"></div>
		</div>

		<div class="form-field">
			<label><?php _e('Map Image',  'entrada'); ?></label>
			<div id="product_cat_map_img" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url($default_img); ?>" width="60px" height="60px" /></div>
			<div style="line-height: 60px;">
				<input type="hidden" id="product_cat_map_img_id" name="term_meta[product_cat_map_img_id]" />
				<button type="button" class="upload_map_img_button button"><?php _e('Upload/Add image',  'entrada'); ?></button>
				<button type="button" class="remove_map_img_button button"><?php _e('Remove image',  'entrada'); ?></button>
			</div>
			<script type="text/javascript">
				if (!jQuery('#product_cat_map_img_id').val()) {
					jQuery('.remove_map_img_button').hide();
				}
				var map_file_frame;
				jQuery(document).on('click', '.upload_map_img_button', function(event) {
					event.preventDefault();
					if (map_file_frame) {
						map_file_frame.open();
						return;
					}
					map_file_frame = wp.media.frames.downloadable_file = wp.media({
						title: 'Choose an image',
						button: {
							text: 'Use image'
						},
						multiple: false
					});
					map_file_frame.on('select', function() {
						var attachment = map_file_frame.state().get('selection').first().toJSON();
						jQuery('#product_cat_map_img_id').val(attachment.id);
						jQuery('#product_cat_map_img').find('img').attr('src', attachment.sizes.thumbnail.url);
						jQuery('.remove_map_img_button').show();
					});
					map_file_frame.open();
				});
				jQuery(document).on('click', '.remove_map_img_button', function() {
					jQuery('#product_cat_map_img').find('img').attr('src', '<?php echo esc_url($default_img); ?>');
					jQuery('#product_cat_map_img_id').val('');
					jQuery('.remove_map_img_button').hide();
					return false;
				});
			</script>
			<div class="clear"></div>
		</div>
		<div class="form-field">
			<label for="term_meta[activity_level_val]" class="choose_icon_label"><?php _e('Choose Icon',  'entrada'); ?></label>
			<div class="set_icon-wrap">
				<span class="set-icon-demo"></span>
				<span> <a href="#TB_inline?width=600&height=550&inlineId=ico-class" class="thickbox"><?php _e('Set Icon',  'entrada'); ?></a></span>
				<span class="remove-icon-span"> <a href="javascript:void(null);" class="remove-icon"><?php _e('Remove',  'entrada'); ?></a></span>
				<input type="hidden" class="set_icon_demo_val" name="term_meta[prod_icomoon_cat_val]" id="term_meta[prod_icomoon_cat_val]" value="">
			</div>
			<p class="description"><?php _e('Select icon for this category.',  'entrada'); ?></p>
		</div>
	<?php
		}
	}
	add_action('destination_add_form_fields', 'entrada_destination_add_new_meta_field', 10, 2);

	if (!function_exists('entrada_destination_edit_meta_field')) {
		function entrada_destination_edit_meta_field($term)
		{
			$t_id = $term->term_id;
			$term_meta = get_option("taxonomy_$t_id");

			if (!isset($term_meta) && $term_meta == '') {
				$term_meta = array();
			}

			$upload_dir = wp_upload_dir();
			$content_dir = str_replace("uploads", "", $upload_dir['basedir']);
			$content_url = str_replace("uploads", "", $upload_dir['baseurl']);

			$default_img = '';
			$banner_img_src = '';
			$map_img_src = '';
			if (file_exists($content_dir . 'plugins/woocommerce/assets/images/placeholder.png')) {
				$default_img = $content_url . 'plugins/woocommerce/assets/images/placeholder.png';
			}
			if (array_key_exists('product_cat_banner_img_id', $term_meta) && $term_meta['product_cat_banner_img_id']  != '') {
				$banner_img_src = wp_get_attachment_url($term_meta['product_cat_banner_img_id']);
			}
			if (array_key_exists('product_cat_map_img_id', $term_meta) && $term_meta['product_cat_map_img_id']  != '') {
				$map_img_src = wp_get_attachment_url($term_meta['product_cat_map_img_id']);
			} ?>


		<tr class="form-field">
			<th scope="row" valign="top"><label for="description"><?php _e('Description',  'entrada'); ?></label></th>
			<td>
				<?php $editor_settings = array('wpautop' => true, 'media_buttons' => true, 'quicktags' => true, 'textarea_rows' => '15', 'textarea_name' => 'description');

						wp_editor(html_entity_decode($term->description, ENT_QUOTES, 'UTF-8'), 'product_description', $editor_settings); ?>
				<br />
				<span class="description"><?php _e('The description is not prominent by default, however some themes may show it.',  'entrada'); ?></span>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top"><label for="term_meta[prod_cat_best_season]"><?php _e('Best Seasons',  'entrada'); ?></label></th>
			<td>
				<input type="text" name="term_meta[prod_cat_best_season]" id="term_meta[prod_cat_best_season]" value="<?php echo (array_key_exists('prod_cat_best_season', $term_meta))  ? esc_attr($term_meta['prod_cat_best_season']) : ''; ?>">
				<p class="description"><?php _e('Add best seasons here. ( E. g. May, June, July, August).',  'entrada'); ?></p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top"><label for="term_meta[prod_cat_popular_location]"><?php _e('Popular Location',  'entrada'); ?></label></th>
			<td>
				<input type="text" name="term_meta[prod_cat_popular_location]" id="term_meta[prod_cat_popular_location]" value="<?php echo (array_key_exists('prod_cat_popular_location', $term_meta)) ? esc_attr($term_meta['prod_cat_popular_location']) : ''; ?>">
				<p class="description"><?php _e('Add popular location here. ( E. g. Madrid, Bhamas, Phuket, Sydney).',  'entrada'); ?></p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top"><label for="term_meta[prod_cat_heading]"><?php _e('Heading',  'entrada'); ?></label></th>
			<td>
				<input type="text" name="term_meta[prod_cat_heading]" id="term_meta[prod_cat_heading]" value="<?php echo (array_key_exists('prod_cat_heading', $term_meta)) ? esc_attr($term_meta['prod_cat_heading']) : ''; ?>">
				<p class="description"><?php _e('Add Category heading here. ( E. g.Urban City Tours).',  'entrada'); ?></p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top"><label for="term_meta[prod_cat_sub_heading]"><?php _e('Sub-heading',  'entrada'); ?></label></th>
			<td>
				<input type="text" name="term_meta[prod_cat_sub_heading]" id="term_meta[prod_cat_sub_heading]" value="<?php echo (array_key_exists('prod_cat_sub_heading', $term_meta)) ? esc_attr($term_meta['prod_cat_sub_heading']) : ''; ?>">
				<p class="description"><?php _e('Add Category sub-heading here.',  'entrada'); ?></p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top"><label for="term_meta[prod_cat_sub_title]"><?php _e('Category Title',  'entrada'); ?></label></th>
			<td>
				<input type="text" name="term_meta[prod_cat_sub_title]" id="term_meta[prod_cat_sub_title]" value="<?php echo (array_key_exists('prod_cat_sub_title', $term_meta)) ? esc_attr($term_meta['prod_cat_sub_title']) : ''; ?>">
				<p class="description"><?php _e('Add Category title here.',  'entrada'); ?></p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top"><label for="term_meta[prod_cat_listing_title]"><?php _e('Listing Title',  'entrada'); ?></label></th>
			<td>
				<input type="text" name="term_meta[prod_cat_listing_title]" id="term_meta[prod_cat_listing_title]" value="<?php echo (array_key_exists('prod_cat_listing_title', $term_meta)) ? esc_attr($term_meta['prod_cat_listing_title']) : ''; ?>">
				<p class="description"><?php _e('Add tour listing title in category here.',  'entrada'); ?></p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top"><label for="term_meta[prod_cat_listing_sub_title]"><?php _e('Listing Sub-title',  'entrada'); ?></label></th>
			<td>
				<input type="text" name="term_meta[prod_cat_listing_sub_title]" id="term_meta[prod_cat_listing_sub_title]" value="<?php echo (array_key_exists('prod_cat_listing_sub_title', $term_meta)) ? esc_attr($term_meta['prod_cat_listing_sub_title']) : ''; ?>">
				<p class="description"><?php _e('Add tour listing sub-title in category here.',  'entrada'); ?></p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top">
				<label><?php _e('Banner Image',  'entrada'); ?></label>
			</th>
			<td>
				<div id="product_cat_banner_img" style="float: left; margin-right: 10px;"><img src="<?php echo esc_attr($banner_img_src) ? esc_attr($banner_img_src) : $default_img; ?>" width="60px" height="60px" /></div>
				<div style="line-height: 60px;">
					<input type="hidden" id="product_cat_banner_img_id" name="term_meta[product_cat_banner_img_id]" value="<?php echo (array_key_exists('product_cat_banner_img_id', $term_meta) && $term_meta['product_cat_banner_img_id'] != '')  ? esc_attr($term_meta['product_cat_banner_img_id']) : ''; ?>" />
					<button type="button" class="upload_banner_img_button button"><?php _e('Upload/Add image',  'entrada'); ?></button>
					<button type="button" class="remove_banner_img_button button" style="display:<?php echo esc_attr($banner_img_src) ? 'inline-block' : 'none'; ?>"><?php _e('Remove image',  'entrada'); ?></button>
				</div>
				<script type="text/javascript">
					if (!jQuery('#product_cat_banner_img_id').val()) {
						jQuery('.remove_banner_img_button').hide();
					}
					var banner_file_frame;
					jQuery(document).on('click', '.upload_banner_img_button', function(event) {
						event.preventDefault();
						if (banner_file_frame) {
							banner_file_frame.open();
							return;
						}
						banner_file_frame = wp.media.frames.downloadable_file = wp.media({
							title: 'Choose an image',
							button: {
								text: 'Use image'
							},
							multiple: false
						});
						banner_file_frame.on('select', function() {
							var attachment = banner_file_frame.state().get('selection').first().toJSON();
							jQuery('#product_cat_banner_img_id').val(attachment.id);
							jQuery('#product_cat_banner_img').find('img').attr('src', attachment.sizes.thumbnail.url);
							jQuery('.remove_banner_img_button').show();
						});
						banner_file_frame.open();
					});
					jQuery(document).on('click', '.remove_banner_img_button', function() {
						jQuery('#product_cat_banner_img').find('img').attr('src', '<?php echo esc_url($default_img); ?>');
						jQuery('#product_cat_banner_img_id').val('');
						jQuery('.remove_banner_img_button').hide();
						return false;
					});
				</script>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top">
				<label><?php _e('Map Image',  'entrada'); ?></label>
			</th>
			<td>
				<div id="product_cat_map_img" style="float: left; margin-right: 10px;"><img src="<?php echo esc_attr($map_img_src) ? esc_attr($map_img_src) : $default_img; ?>" width="60px" height="60px" /></div>
				<div style="line-height: 60px;">
					<input type="hidden" id="product_cat_map_img_id" name="term_meta[product_cat_map_img_id]" value="<?php echo (array_key_exists('product_cat_map_img_id', $term_meta))  ? esc_attr($term_meta['product_cat_map_img_id']) : ''; ?>" />
					<button type="button" class="upload_map_img_button button"><?php _e('Upload/Add image',  'entrada'); ?></button>
					<button type="button" class="remove_map_img_button button" style="display:<?php echo esc_attr($map_img_src) ? 'inline-block' : 'none'; ?>"><?php _e('Remove image',  'entrada'); ?></button>
				</div>
				<script type="text/javascript">
					if (!jQuery('#product_cat_map_img_id').val()) {
						jQuery('.remove_map_img_button').hide();
					}
					var map_file_frame;
					jQuery(document).on('click', '.upload_map_img_button', function(event) {
						event.preventDefault();
						if (map_file_frame) {
							map_file_frame.open();
							return;
						}
						map_file_frame = wp.media.frames.downloadable_file = wp.media({
							title: 'Choose an image',
							button: {
								text: 'Use image'
							},
							multiple: false
						});
						map_file_frame.on('select', function() {
							var attachment = map_file_frame.state().get('selection').first().toJSON();
							jQuery('#product_cat_map_img_id').val(attachment.id);
							jQuery('#product_cat_map_img').find('img').attr('src', attachment.sizes.thumbnail.url);
							jQuery('.remove_map_img_button').show();
						});
						map_file_frame.open();
					});
					jQuery(document).on('click', '.remove_map_img_button', function() {
						jQuery('#product_cat_map_img').find('img').attr('src', '<?php echo esc_url($default_img); ?>');
						jQuery('#product_cat_map_img_id').val('');
						jQuery('.remove_map_img_button').hide();
						return false;
					});
				</script>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="term_meta[prod_featured_cat_val]"><?php _e('Select Icon',  'entrada'); ?></label></th>
			<td>
				<div class="set_icon-wrap">
					<span class="set-icon-demo">
						<?php
								if (isset($term_meta['prod_icomoon_cat_val'])) {
									echo '<i class="' . $term_meta['prod_icomoon_cat_val'] . '"></i>';
								} ?>
					</span>
					<span> <a href="#TB_inline?width=600&height=550&inlineId=ico-class" class="thickbox"><?php _e('Set Icon',  'entrada'); ?></a></span>
					<span class="remove-icon-span"> <a href="javascript:void(null);" class="remove-icon"><?php _e('Remove',  'entrada'); ?></a></span>
					<input type="hidden" class="set_icon_demo_val" name="term_meta[prod_icomoon_cat_val]" id="term_meta[prod_icomoon_cat_val]" value="<?php if (isset($term_meta['prod_icomoon_cat_val'])) {
																																									echo sprintf(__('%s', 'entrada'), $term_meta['prod_icomoon_cat_val']);
																																								} ?>">
				</div>

				<p class="description"><?php _e('Displays on sidebar filter option.',  'entrada'); ?></p>
			</td>
		</tr>

		<?php
			}
		}
		add_action('destination_edit_form_fields', 'entrada_destination_edit_meta_field', 10, 2);
		add_action('edited_destination', 'entrada_save_taxonomy_custom_meta', 10, 2);
		add_action('create_destination', 'entrada_save_taxonomy_custom_meta', 10, 2);

		/* Entrada Product custom functions
--------------------------------------------------------- */
		if (!function_exists('entrada_destinations_activities_count')) {
			function entrada_destinations_activities_count($post_id, $print = false)
			{
				$html = '';
				$post_taxonomy_count = array(
					array(
						'taxonomy'      => 'destination',
						'singular_name' => __('Place', 'entrada'),
						'plural_name'   => __('Places', 'entrada'),
						'span_class'    => 'country',
						'icomoon_class' => 'icon-world',
						'fields'        => 'all',
					),
					array(
						'taxonomy'      => 'product_cat',
						'singular_name' => __('Activity', 'entrada'),
						'plural_name'   => __('Activities', 'entrada'),
						'span_class'    => 'activity',
						'icomoon_class' => 'icon-acitivities',
						'fields'        => 'ids',
					)
				);

				foreach ($post_taxonomy_count as $post_taxonomy) {
					$term_names = array();
					$term_list = wp_get_post_terms($post_id, $post_taxonomy['taxonomy'], array('fields' => $post_taxonomy['fields']));

					$total_records = sizeof($term_list);

					if ($post_taxonomy['taxonomy'] == 'destination') {
						foreach ($term_list as $term) {
							if ($term->parent == 0)
								continue;
							$term_names[] = $term->name;
						}
						$total_records = sizeof($term_names);
					}

					if ($total_records  > 1) {
						$label = $total_records . ' ' . $post_taxonomy['plural_name'];
					} else {
						$label = $total_records . ' ' . $post_taxonomy['singular_name'];
					}
					$html .= '<span class="' . $post_taxonomy['span_class'] . '"><span class="' . $post_taxonomy['icomoon_class'] . '"> </span>' . $label . '</span>';
				}

				if ($print == true) {
					echo sprintf(__('%s', 'entrada'), $html);
				} else {
					return $html;
				}
			}
		}

		if (!function_exists('entrada_get_addons_price')) {
			function entrada_get_addons_price($product_id, $addons_label)
			{
				$addons_price = 0;
				$product_addons_arr = array();
				$product_addons = get_post_meta($product_id, 'product_addons', true);
				if (isset($product_addons) && !empty($product_addons)) {
					$product_addons_arr = maybe_unserialize($product_addons);
				}

				if ($product_addons_arr) {
					foreach ($product_addons_arr as $p_addons) {
						if (in_array($addons_label, $p_addons)) {
							return $p_addons['addons_price'];
						}
					}
				}
				return $addons_price;
			}
		}
		/* Update Cart Hook to include product variation
.................................................... */
		if (!function_exists('entrada_add_custom_price')) {
			function entrada_add_custom_price($cart_object)
			{
				global $woocommerce;
				$addons_price = 0;
				$inc_flight = array();
				if (isset($_COOKIE['include_flight']) && $_COOKIE['include_flight'] != '') {
					$inc_flight = explode("-", $_COOKIE['include_flight']);
				}

				foreach ($cart_object->cart_contents as $key => $value) {

					/* Product Addons calculation */
					$addons_qty = 'addons_' . $key . '_qty';
					$addons_label = 'addons_' . $key . '_label';
					$customer_start_date = 'customer_' . $key . '_start_date';

					if (isset($_POST[$customer_start_date])) {
						$cart_object->cart_contents[$key]['customer_start_date'] = $_POST[$customer_start_date];
					}

					if (isset($_POST[$addons_qty])) {

						$addons_data = array();
						$j = 0;
						for ($i = 0; $i < count($_POST[$addons_qty]); $i++) {
							if ($_POST[$addons_qty][$i] != 0) {
								$addons_price += entrada_get_addons_price($value['product_id'], $_POST[$addons_label][$i]) * $_POST[$addons_qty][$i];

								$addons_data[$j]['addons_label'] = $_POST[$addons_label][$i];
								$addons_data[$j]['addons_qty']   = $_POST[$addons_qty][$i];
								$addons_data[$j]['addons_price'] = entrada_get_addons_price($value['product_id'], $_POST[$addons_label][$i]);

								$j++;
							}
						}
						$cart_object->cart_contents[$key]['addons_data'] = $addons_data;
					}

					/* Addons option ends here */
					if (($value['variation_id'] != 0)) {
						$variation_id = $value['variation_id'];
						if (in_array($variation_id, $inc_flight)) {
							$new_price = get_post_meta($variation_id, 'var_price_inc_flight', true);
							$value['data']->set_price($new_price);
							update_post_meta($variation_id, 'tour_with_flight', 'yes');
						} else {
							update_post_meta($variation_id, 'tour_with_flight', '');
						}
					}
				}
			}
		}
		add_action('woocommerce_before_calculate_totals', 'entrada_add_custom_price');

		if (!function_exists('entrada_addons_price')) {
			function entrada_addons_price($cart_object)
			{

				global $woocommerce;
				$addons_price = 0;

				foreach ($cart_object->cart_contents as $key => $value) {

					/* Product Addons calculation */
					if (array_key_exists('addons_data', $value) && !empty($value['addons_data'])) {
						$addons_data_arr = $value['addons_data'];

						if (count($addons_data_arr) > 0) {
							foreach ($addons_data_arr as $ad) {
								$addons_price += $ad['addons_price'] * $ad['addons_qty'];
							}
						}
					}
				}

				if ($addons_price != 0) {
					$woocommerce->cart->add_fee(__('Addons Charge', 'entrada'), $addons_price, TRUE, '');
				}
			}
		}
		add_action('woocommerce_cart_calculate_fees', 'entrada_addons_price');

		if (!function_exists('entrada_addons_selected_quantity')) {
			function entrada_addons_selected_quantity($addons_data, $addons_label)
			{
				if (count($addons_data) > 0) {
					foreach ($addons_data as $ad) {
						if (in_array($addons_label, $ad)) {
							return $ad['addons_qty'];
						}
					}
				}
				return 0;
			}
		}

		if (!function_exists('entrada_addons_product_price')) {
			function entrada_addons_product_price($addons_data_arr)
			{

				global $woocommerce;
				$addons_price = 0;

				if (count($addons_data_arr) > 0) {
					foreach ($addons_data_arr as $ad) {
						$addons_price += $ad['addons_price'] * $ad['addons_qty'];
					}
				}

				return $addons_price;
			}
		}

		//Store the custom field
		if (!function_exists('add_cart_item_custom_database')) {
			function add_cart_item_custom_database($cart_item_meta, $product_id)
			{
				global $woocommerce;
				$cart_item_meta['addons_data'] = array();
				$cart_item_meta['customer_start_date'] = '';
				if (isset($_REQUEST['variation_id']) && is_numeric($_REQUEST['variation_id'])) {
					$var_confirmed_date = get_post_meta($_REQUEST['variation_id'], 'var_confirmed_date', true);
					if (!empty($var_confirmed_date)) {
						$cart_item_meta['customer_start_date'] = $var_confirmed_date;
					}
				}

				return $cart_item_meta;
			}
		}
		add_filter('woocommerce_add_cart_item_data', 'add_cart_item_custom_database', 10, 2);

		//Get it from the session and add it to the cart variable
		if (!function_exists('get_cart_items_from_session')) {
			function get_cart_items_from_session($item, $values, $key)
			{
				if (array_key_exists('addons_data', $values)) {
					$item['addons_data'] = $values['addons_data'];
				}

				if (array_key_exists('customer_start_date', $values)) {
					$item['customer_start_date'] = $values['customer_start_date'];
				}
				return $item;
			}
		}
		add_filter('woocommerce_get_cart_item_from_session', 'get_cart_items_from_session', 10, 3);


		if (!function_exists('entrada_values_to_order_item_meta')) {
			function entrada_values_to_order_item_meta($item_id, $item, $order_id)
			{
				global $woocommerce, $wpdb;
				$start_date = __('Start Date',  'entrada');

				wc_add_order_item_meta($item_id, $start_date, $item['customer_start_date']);
				wc_add_order_item_meta($item_id, 'addons_data', $item['addons_data']);
			}
		}
		add_action('woocommerce_new_order_item', 'entrada_values_to_order_item_meta', 10, 3);

		/* New */
		function add_order_item_meta($item_id, $values, $cart_item_key)
		{
			$key = 'Start Date'; // Define your key here

			if (isset($values['customer_start_date']) && !empty($values['customer_start_date'])) {
				wc_add_order_item_meta($item_id, $key, $values['customer_start_date'], true);
			}

			if (isset($values['addons_data']) && !empty($values['addons_data'])) {
				wc_add_order_item_meta($item_id, 'addons_data', $values['addons_data'], true);
			}
		}
		add_action('woocommerce_add_order_item_meta', 'add_order_item_meta', 10, 3);

		if (!function_exists('entrada_before_order_itemmeta')) {
			function entrada_before_order_itemmeta($item_id, $item, $_product)
			{
				$start_date = __('Start Date',  'entrada');
				$customer_start_date = wc_get_order_item_meta($item_id, $start_date, true);
				$addons_data = wc_get_order_item_meta($item_id, 'addons_data', true);
				if (!empty($customer_start_date) && $_product->is_type('simple')) {
					$customer_start_date = maybe_unserialize($customer_start_date);
					if (isset($customer_start_date[0])) {
						echo '<p><strong>' . __('Start Date', 'entrada') . ' : </strong> ' . $customer_start_date[0] . '</p>';
					}
				}

				if (!empty($addons_data)) {
					$addons_data = maybe_unserialize($addons_data);
					if (count($addons_data)) {
						$addons_total = 0;
						echo '<table  cellpadding="0" cellspacing="0" class="woocommerce_order_items">';
						echo "<thead><tr>";
						echo '<th>' . __('Addons Title', 'entrada') . '</th>';
						echo '<th>' . __('Quantity', 'entrada') . '</th>';
						echo '<th>' . __('Price', 'entrada') . '</th>';
						echo '<th>' . __('Total', 'entrada') . '</th>';
						echo "</tr></thead><tbody>";
						foreach ($addons_data as $d) {
							$addons_total += $d['addons_qty'] * $d['addons_price'];
							echo "<tr>";

							echo '<td>' . $d['addons_label'] . '</td>';
							echo '<td>' . $d['addons_qty'] . '</td>';
							echo '<td>' . entrada_price($d['addons_price']) . '</td>';
							echo '<td>' . entrada_price($d['addons_qty'] * $d['addons_price']) . '</td>';

							echo "</tr>";
						}

						echo '</tbody><tfoot><tr>';
						echo '<td colspan="3" align="right"><strong>' . __('Total', 'entrada') . ' :</strong></td>';
						echo '<td><strong>' . entrada_price($addons_total) . '</strong></td>';
						echo '</tr></tfoot></table>';
					}
				}
			}
		}
		add_action('woocommerce_before_order_itemmeta', 'entrada_before_order_itemmeta', 10, 3);


		/* Get Product Attributes from Product ID
............................................. */
		if (!function_exists('entrada_product_attributes')) {
			function entrada_product_attributes($post_id)
			{
				$product = wc_get_product($post_id);
				$formatted_attributes = array();

				$attributes = $product->get_attributes($product);

				foreach ($attributes as $attr => $attr_deets) {

					if (isset($attributes[$attr]) || isset($attributes['pa_' . $attr])) {

						$attribute = isset($attributes[$attr]) ? $attributes[$attr] : $attributes['pa_' . $attr];

						if ($attribute['is_taxonomy']) {

							$formatted_attributes[$attr] = wc_get_product_terms($product->get_id(), $attribute['name']);
						} else {

							$formatted_attributes[$attr] = $attribute['value'];
						}
					}
				}
				return $formatted_attributes;
			}
		}

		/* Get Product Variation from Product ID
............................................. */
		if (!function_exists('entrada_product_variations')) {
			function entrada_product_variations($post_id)
			{
				$product = wc_get_product($post_id);
				if ($product->is_type('variable')) {

					$variations_args = array();
					$variations = $product->get_available_variations();
					foreach ($variations as $v) {
						$variations_args[] = $v['variation_id'];
					}
					return $variations_args;
				} else {

					return;
				}
			}
		}

		/* Get cart item unit price for variation
..................................... */
		if (!function_exists('entrada_cart_item_unit_price')) {
			function entrada_cart_item_unit_price($product_id, $variation_id)
			{
				$price = '';
				$has_sale_price = '';
				$product = wc_get_product($product_id);

				if ($variation_id == 0) {
					$price = $product->get_price();
					$sale_price = $product->get_sale_price();
					if (!empty($sale_price)) {
						$price = $sale_price;
						$has_sale_price = 'sale_price';
					}
				} else {
					$tour_with_flight = get_post_meta($variation_id, 'tour_with_flight', true);
					$var_price_inc_flight = get_post_meta($variation_id, 'var_price_inc_flight', true);
					$_price = get_post_meta($variation_id, '_price', true);
					$price = ($tour_with_flight) ? $var_price_inc_flight : $_price;
				}
				if (!empty($has_sale_price)) {
					return entrada_price($price, $args = array(), $has_sale_price);
				} else {
					return entrada_price($price);
				}
			}
		}

		/* Get cart info block
.................................*/
		if (!function_exists('entrada_cart_info_block')) {
			function entrada_cart_info_block()
			{
				$purchases_options = entrada_showhide_purchases_options();
				if (!isset($purchases_options) || $purchases_options === false) {
					return '';
				}
				$navbar = get_theme_mod('navbar_style');
				$v_divider = 'v-divider';
				$args = array();
				if ('centered_navbar' == $navbar) {
					$v_divider = '';
				}
				$html = '';
				if (class_exists('WooCommerce')) {
					global $woocommerce;
					$addons_price = 0;
					$items = $woocommerce->cart->get_cart();
					$totalamount = $woocommerce->cart->total;
					$cart_alt_amt = 0;
					$currency_symbol = get_woocommerce_currency_symbol();

					$html .= '<li class="visible-xs visible-sm cart-visible"><a href="' . wc_get_cart_url() . '"><i class="material-icons">shopping_cart</i><span class="text">' . __('Cart', 'entrada') . '</span></a></li>';

					$html .= '<li class="hidden-xs hidden-sm nav-visible dropdown last-dropdown ' . $v_divider . '">';
					$html .= '<a href="' . wc_get_cart_url() . '" data-toggle="dropdown">';
					$html .= '<i class="material-icons">shopping_cart</i>';
					$html .= '<span class="text hidden-md hidden-lg">' . __('Cart', 'entrada') . '</span>';
					$html .= '<span class="text hidden-xs hidden-sm">' . $woocommerce->cart->get_cart_contents_count() . '</span>';
					$html .= '</a>';
					$html .= '<div class="dropdown-menu dropdown-md"><div class="drop-wrap cart-wrap"><strong class="title">' . __('Shopping Cart', 'entrada') . '</strong>';
					if (count($items) > 0) {
						$html .= '<ul class="cart-list">';
						foreach ($items as $item => $values) {
							//$_product = $values['data']->post;
							$price = entrada_cart_item_unit_price($values['product_id'], $values['variation_id']);
							$image_url = wp_get_attachment_image_src(get_post_thumbnail_id($values['product_id']), 'single-post-thumbnail');

							if (array_key_exists('addons_data', $values) && $values['addons_data'] != '') {
								$addons_price += entrada_addons_product_price($values['addons_data']);
							}

							$cart_alt_price = str_replace($currency_symbol, "", $price);
							$cart_alt_price = floatval(preg_replace("/[^-0-9\.]/", "", $cart_alt_price));

							if (array_key_exists('quantity', $values) && $values['quantity'] != '') {
								$cart_alt_amt +=  floatval($cart_alt_price * $values['quantity']);
							}

							$html .= '<li itemscope itemtype="http://schema.org/Product">';

							if (!empty($image_url)) {
								$image = matthewruddy_image_resize($image_url[0], 370, 450, true, false);
								if (array_key_exists('url', $image) && $image['url'] != '') {
									$html .= '<div class="img"><a href="' . get_permalink($values['product_id']) . '">';
									$html .= '<img src="' . $image['url'] . '"  itemprop="image"  alt="' . get_the_title($values['product_id']) . '"  height="450" width="370" >';
									$html .= '</a></div>';
								}
							}
							$html .= '<div class="text-holder">';
							$html .= '<span class="amount">x ' . $values['quantity'] . '</span>';
							$html .= '<div class="text-wrap">';
							$html .= '<strong class="name"><a href="' . get_permalink($values['product_id']) . '"  itemprop="name">' . get_the_title($values['product_id']) . '</a></strong>';
							$html .= '<span class="price" ' . entrada_price_schema_micro_data_link($values['product_id']) . '>' . $price . '</span>';
							$html .= '</div>';
							$html .= '</div>';

							$html .= '</li>';
						}

						if ($addons_price != 0) {
							$cart_alt_amt = $cart_alt_amt + $addons_price;
							$html .= '<li><div class="text-holder"><div class="text-wrap"><strong class="name"><a href="#">' . __('Addons Charge', 'entrada') . '</a></strong><span class="price" >' . entrada_price($addons_price, $args, 'footer_price') . '</span></div></div></li>';
						}

						if (empty($totalamount) || $totalamount == 0) {
							$totalamount = $cart_alt_amt;
						}

						$html .= '</ul>';
						$html .= '<div class="footer"><a href="' . wc_get_cart_url() . '" class="btn btn-primary">' . __('View Cart', 'entrada') . '</a><span class="total">' . entrada_price($totalamount, $args, 'footer_price') . '</span></div>';
					} else {
						$html .= '<div class="footer"><p>' . __('Cart is Empty', 'entrada') . '</p></div>';
					}
					$html .= '</div></div>';
					$html .= '</li>';
				}
				return $html;
			}
		}

		if (!function_exists('entrada_product_variation_detail_wishlist')) {
			function entrada_product_variation_detail_wishlist($post_id, $print = false)
			{
				$variation_id = get_post_meta($post_id, '_min_price_variation_id');
				$product = get_post_meta($post_id, '_product_attributes');
				$product_price = get_post_meta($post_id, '_price', true);
				$attr = array();
				$attr['price'] = $product_price;
				if (!empty($product[0])) {
					$attr['is_variation'] = true;
					foreach ($product[0] as $key => $p) {
						$attr['attribute'] = $key;
					}
					if (!empty($variation_id)) {
						$attr['variation_id'] = $variation_id[0];
					}
				} else {
					$attr['is_variation'] = false;
				}
				return $attr;
			}
		}

		if (!function_exists('entrada_product_price_wishlist')) {
			function entrada_product_price_wishlist($post_id, $print = false)
			{
				$price = '';
				$product_price = get_post_meta($post_id, '_price', true);
				if (is_array($product_price)) {
					$price = $product_price[0];
				} else {
					$price = $product_price;
				}
				if ($print == true) {
					echo entrada_price($price);
				} else {
					return entrada_price($price);
				}
			}
		}

		if (!function_exists('entrada_product_variation_id')) {
			function entrada_product_variation_id($post_id)
			{
				$product = wc_get_product($post_id);
				$product_variation_id = '';
				$check_low_price = 0;
				if ($product->get_type() == "variable") {
					$available_variations = $product->get_available_variations();
					foreach ($available_variations as $av) {
						$variation_id = $av['variation_id'];
						if (empty($product_variation_id)) {
							$product_variation_id = $variation_id;
						}
						$variable_product1 = new WC_Product_Variation($variation_id);
						$regular_price = (int) $variable_product1->get_regular_price();
						if (0 == $check_low_price) {
							$check_low_price = $regular_price;
						}
						$sp = (int) $variable_product1->get_sale_price();
						(empty($sp) ? $sales_price = 0 : $sales_price = $sp);
						if ($sales_price > 0) {
							if ($check_low_price > $sales_price) {
								$check_low_price = $sales_price;
								$product_variation_id = $variation_id;
							}
						} else {
							if ($check_low_price > $regular_price) {
								$check_low_price = $regular_price;
								$product_variation_id = $variation_id;
							}
						}
					}
				}
				return $product_variation_id;
			}
		}

		if (!function_exists('entrada_product_price')) {
			function entrada_product_price($post_id, $print = false)
			{
				$product = wc_get_product($post_id);
				$price = '';
				if ((null !== $product->get_type()) && ($product->get_type() == "variable")) {
					$check_low_price = 0;
					$show_sale_price = 0;
					$show_reg_price = 0;
					$available_variations = $product->get_available_variations();
					foreach ($available_variations as $av) {
						$variation_id = $av['variation_id'];
						$variable_product1 = new WC_Product_Variation($variation_id);
						$regular_price = (int) $variable_product1->get_regular_price();
						if (0 == $check_low_price) {
							$check_low_price = $regular_price;
						}
						$sp = (int) $variable_product1->get_sale_price();
						(empty($sp) ? $sales_price = 0 : $sales_price = $sp);
						if ($sales_price > 0) {
							if ($check_low_price > $sales_price) {
								$check_low_price = $show_sale_price = $sales_price;
								$show_reg_price = $regular_price;
							}
						} else {
							if ($check_low_price > $regular_price) {
								$check_low_price = $show_reg_price = $regular_price;
							}
						}
					}
					if ($show_sale_price > 0) {
						$show_price = "<del>" . entrada_price($show_reg_price, array(), 'regular_price') . "</del>" . entrada_price($show_sale_price, array(), 'sale_price');
					} else {
						$show_price = entrada_price($check_low_price);
					}
				} else {

					if ((null !== $product->get_type()) && ($product->get_type() == "booking")) {
						$reg_price = wc_get_price_to_display($product);
						$sale_price = '';
					} else {
						$reg_price = get_post_meta($product->get_id(), '_regular_price', true);
						$sale_price = get_post_meta($product->get_id(), '_sale_price', true);
					}


					if (is_array($reg_price)) {
						if ($sale_price) {
							$show_price = "<del>" . entrada_price($reg_price[0], array(), 'regular_price') . "</del>" . entrada_price($sale_price[0], array(), 'sale_price');
						} else {
							$show_price = entrada_price($reg_price[0]);
						}
					} else {
						if ($sale_price) {
							$show_price = "<del>" . entrada_price($reg_price, array(), 'regular_price') . "</del>" . entrada_price($sale_price, array(), 'sale_price');
						} else {
							$show_price = entrada_price($reg_price);
						}
					}
				}
				if ($print == true) {
					echo sprintf(__('%s', 'entrada'), $show_price);
				} else {
					return $show_price;
				}
			}
		}

		if (!function_exists('entrada_product_featured_categories')) {
			function entrada_product_featured_categories($taxonomy_field = '')
			{
				global $wpdb;
				$include_taxonomy = array();
				$product_cats = get_terms('product_cat', 'hide_empty=0');

				foreach ($product_cats as $product_cat) {
					$term_meta = get_option("taxonomy_" . $product_cat->term_id);
					if (isset($term_meta[$taxonomy_field]) && $term_meta[$taxonomy_field] != '') {
						$include_taxonomy[] = $product_cat->term_id;
					}
				}
				return $include_taxonomy;
			}
		}

		if (!function_exists('entrada_product_activity_level')) {
			function entrada_product_activity_level($post_id, $mode, $print = false)
			{
				$taxonomy_value = '';
				$cat_id = 0;
				$term_list = wp_get_post_terms($post_id, 'activity_level', array('fields' => 'ids'));
				if ($term_list) {
					$cat_id = (int) $term_list[0];
				}

				$term = get_term($cat_id, 'activity_level');
				if ($mode == 'level') {
					$term_meta = get_option("taxonomy_$cat_id");
					$taxonomy_value = esc_attr($term_meta['activity_level_val']);
				} else if ($mode == 'title') {
					$taxonomy_value = $term->name;
				} else {
					$taxonomy_value = $term->slug;
				}

				if ($print == true) {
					echo sprintf(__('%s', 'entrada'), $taxonomy_value);
				} else {
					return $taxonomy_value;
				}
			}
		}

		if (!function_exists('entrada_product_price_range')) {
			function entrada_product_price_range($print = false, $selected = '')
			{
				global $wpdb;
				$html = '';
				$table_name = $wpdb->prefix . 'entrada_price_range';
				if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
					return '';
				}
				$result = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "entrada_price_range WHERE 1= 1 order by min_price ASC ");
				if ($result) {
					foreach ($result as $entry) {
						$range_val = $entry->min_price . '-' . $entry->max_price;
						$html .= '<option value="' . $range_val . '"';
						if (!empty($selected) && $selected == $range_val) {
							$html .= ' selected="selected"';
						}
						$html .= '>' . $entry->pr_title . '</option>';
					}
				}

				if ($print == true) {
					echo sprintf(__('%s', 'entrada'), $html);
				} else {
					return $html;
				}
			}
		}

		if (!function_exists('entrada_product_categories')) {
			function entrada_product_categories($post_id, $print = false)
			{
				global $wpdb;
				$html = '';

				$term_list = wp_get_post_terms($post_id, 'product_cat', array('fields' => 'ids'));
				if (count($term_list) > 0) {
					foreach ($term_list as $cat_id) {
						if ($html != '') {
							$html .= ', ';
						}
						$term = get_term($cat_id, 'product_cat');
						$html .= '<a href="' . get_term_link($cat_id, 'product_cat') . '">' . $term->name . '</a>';
					}
				}

				if ($print == true) {
					echo sprintf(__('%s', 'entrada'), $html);
				} else {
					return $html;
				}
			}
		}

		if (!function_exists('entrada_product_holiday_types')) {
			function entrada_product_holiday_types($post_id, $print = false)
			{
				global $wpdb;
				$html = '';

				$term_list = wp_get_post_terms($post_id, 'holiday_type', array('fields' => 'ids'));
				if (count($term_list) > 0) {
					foreach ($term_list as $cat_id) {
						if ($html != '') {
							$html .= ', ';
						}
						$term = get_term($cat_id, 'holiday_type');
						$html .= $term->name;
					}
				}

				if ($print == true) {
					echo sprintf(__('%s', 'entrada'), $html);
				} else {
					return $html;
				}
			}
		}

		if (!function_exists('entrada_product_group_size_icon')) {
			function entrada_product_group_size_icon($post_id)
			{
				$icon = '';
				$trip_group_size = get_post_meta($post_id, "trip_group_size", true);
				switch ($trip_group_size) {
					case 'Small Group':
						$icon = '<span class="icon-group-small"></span>';
						break;

					case 'Medium Group':
						$icon = '<span class="icon-group-medium"></span>';
						break;

					case 'Large Group':
						$icon = '<span class="icon-group-large"></span>';
						break;

					default:
						$icon = '';
				}
				return $icon;
			}
		}

		if (!function_exists('entrada_icomoon_class')) {
			function entrada_icomoon_class($tag_slug)
			{
				global $icon_array;
				if (!array_key_exists($tag_slug, $icon_array)) {
					return '';
				} else {
					return 	$icon_array[$tag_slug];
				}
			}
		}

		if (!function_exists('entrada_custom_taxonomy_in_optgroup')) {
			function entrada_custom_taxonomy_in_optgroup($taxonomy, $name, $class, $id, $current_selected = '')
			{
				$list_of_terms = '';
				$terms = get_terms($taxonomy, array('orderby' => 'name', 'hide_empty' => 0));
				$list_of_terms .= '<select name="' . $name . '" class="' . $class . '" id="' . $id . '">';
				$list_of_terms .= '<option value="" class="hideme">' . __('Destination', 'entrada') . '</option>';
				$list_of_terms .= '<option value="">' . __('All Destinations', 'entrada') . '</option>';

				foreach ($terms as $term) {
					$select = ($current_selected == $term->slug) ? "selected" : "";
					if ($term->parent == 0) {
						$tchildren = get_term_children($term->term_id, $taxonomy);
						$children = array();
						foreach ($tchildren as $child) {
							$cterm = get_term_by('id', $child, $taxonomy);
							$children[$cterm->name] = $cterm;
						}
						ksort($children);
						if (count($children) > 0) {
							$list_of_terms .= '<optgroup label="' . $term->name . '">';
							if ($term->count > 0) {
								$list_of_terms .= '<option value="' . $term->slug . '" ' . $select . '>' . $term->name . '</option>';
							}
						} else {
							$list_of_terms .= '<option value="' . $term->slug . '" ' . $select . '>' . $term->name . '</option>';
						}
						foreach ($children as $child) {
							$select = ($current_selected == $cterm->slug) ? "selected" : "";
							$list_of_terms .= '<option value="' . $child->slug . '" ' . $select . '>' . $child->name . ' </option>';
						}
						if (count($children) > 0) {
							$list_of_terms .= "</optgroup>";
						}
					}
				}
				$list_of_terms .= '</select>';
				return $list_of_terms;
			}
		}

		/* Entrada Get Variation Price of Product from Variation ID
--------------------------------------------------------- */
		if (!function_exists('entrada_variation_price')) {
			function entrada_variation_price()
			{
				$response_arr = array();

				$price = get_post_meta($_POST['variation_id'], $_POST['price_type'], true);
				$response_arr['result'] = $price;

				echo json_encode($response_arr, true);
				exit;
			}
		}
		add_action('wp_ajax_variation_price', 'entrada_variation_price');
		add_action('wp_ajax_nopriv_variation_price', 'entrada_variation_price');

		if (!function_exists('entrada_price')) {
			function entrada_price($price,  $args = array(), $sale_offer = '')
			{
				extract(apply_filters('wc_price_args', wp_parse_args($args, array(
					'ex_tax_label'       => false,
					'currency'           => '',
					'decimal_separator'  => wc_get_price_decimal_separator(),
					'thousand_separator' => wc_get_price_thousand_separator(),
					'decimals'           => wc_get_price_decimals(),
					'price_format'       => get_woocommerce_price_format()
				))));

				$negative        = $price < 0;
				$price           = apply_filters('raw_woocommerce_price', floatval($negative ? $price * -1 : $price));
				$price           = apply_filters('formatted_woocommerce_price', number_format($price, $decimals, $decimal_separator, $thousand_separator), $price, $decimals, $decimal_separator, $thousand_separator);

				if (apply_filters('woocommerce_price_trim_zeros', false) && $decimals > 0) {
					$price = wc_trim_zeros($price);
				}

				if ($sale_offer == 'regular_price') {
					$price = '<span itemprop="highPrice">' . $price . '</span>';
				} else if ($sale_offer == 'sale_price') {
					$price = '<span itemprop="lowPrice">' . $price . '</span>';
				} else if ($sale_offer == 'footer_price') {
					$price = $price;
				} else {
					$price = '<span itemprop="price">' . $price . '</span>';
				}

				if ('footer_price' == $sale_offer) {
					$formatted_price = ($negative ? '-' : '') . sprintf($price_format, get_woocommerce_currency_symbol($currency), $price);
				} else {
					$formatted_price = ($negative ? '-' : '') . sprintf($price_format, '<span itemprop="priceCurrency">' . get_woocommerce_currency_symbol($currency) . '</span>', $price);
				}

				$return =  entrada_wc_cvo_price($formatted_price);

				if ($ex_tax_label && wc_tax_enabled()) {
					$return .= WC()->countries->ex_tax_or_vat();
				}
				return apply_filters('entrada_price', $return, $price, $args);
			}
		}

		/* Entrada Product Filter Ajax Functions
--------------------------------------------------------- */
		if (!function_exists('entrada_setcookie')) {
			function entrada_setcookie()
			{
				$response_arr = array();
				setcookie($_POST['cookie_param'], $_POST['cookie_value'], time() + 86400, COOKIEPATH, COOKIE_DOMAIN, false);
				$response_arr['result'] = 'set';
				echo json_encode($response_arr, true);
				exit;
			}
		}
		add_action('wp_ajax_entrada_setcookie', 'entrada_setcookie');
		add_action('wp_ajax_nopriv_entrada_setcookie', 'entrada_setcookie');

		/* Entrada Get Recently Viewed Tour/Product Functions
--------------------------------------------------------- */
		if (!function_exists('entrada_recently_viewed_product')) {
			function entrada_recently_viewed_product($current_post_id = 0)
			{
				global $wpdb;
				$html = '';
				$args = array(
					'post_type' 		=> 'product',
					'posts_per_page' 	=> 3,
					'meta_key' 			=> '_last_viewed',
					'orderby' 			=> 'meta_value',
					'order' 			=> 'DESC'
				);
				if ($current_post_id != 0) {
					$args['post__not_in'] = array($current_post_id);
				}

				$args = entrada_product_type_meta_query($args, 'tour');

				$recently_viewed = new WP_Query($args);
				if ($recently_viewed->have_posts()) {
					$html .= '<h2 class="text-center">' . __('Recently Viewed', 'entrada') . '</h2>';
					$html .= '<div class="row db-3-col">';
					while ($recently_viewed->have_posts()) : $recently_viewed->the_post();
						$entrada_social_media_share_img =  entrada_social_media_share_img(get_the_ID());
						$html .= '<article class="col-sm-6 col-md-4 article" itemscope itemtype="http://schema.org/Product">';
						$html .= '<div class="thumbnail">';
						$html .= '<h3 class="no-space"><a href="' . get_permalink(get_the_ID()) . '" itemprop="name">' . get_the_title(get_the_ID()) . '</a></h3>';
						$html .= '<strong class="info-title">' . entrada_product_categories(get_the_ID(), false) . '</strong>';
						$html .= entrada_product_resized_img(get_the_ID(), $resize = array(550, 358));
						$html .= '<footer>';
						$html .= '<div class="sub-info">';
						$html .= '<span>' . get_post_meta(get_the_ID(), "trip_duration", true) . '</span>';
						$html .= '<span ' . entrada_price_schema_micro_data_link(get_the_ID()) . '>' . entrada_product_price(get_the_ID(), false) . '</span>';
						$html .= '</div>';
						$product_tag = wp_get_post_terms(get_the_ID(), 'product_tag');
						if (count($product_tag) > 0) {
							$html .= '<ul class="ico-list">';
							foreach ($product_tag as $term) {
								$icomoon_class = entrada_icomoon_class($term->slug);
								if (!empty($icomoon_class)) {
									$html .=  '<li class="pop-opener"><span class="' . $icomoon_class . '"></span><div class="popup">' . ucwords($term->name) . '</div></li>';
								}
							}
							$html .=  '</ul>';
						}
						$html .= '</footer>';
						$html .= '</div>';
						$html .= '</article>';
					endwhile;
					$html .= '</div>';
					wp_reset_query();
				}
				return $html;
			}
		}

		/* Entrada sort post
............................ */
		if (!function_exists('entrada_sort_post_param')) {
			function entrada_sort_post_param($sort, $args = array())
			{

				switch ($sort) {
					case 'alphabet':
						$args['orderby'] = 'title';
						$args['order'] = 'ASC';
						break;

					case 'price':
						$args['orderby'] = 'meta_value_num';
						$args['meta_key'] = '_price';
						$args['order'] = 'ASC';
						break;

					case 'popularity':
						$args['orderby'] = 'meta_value';
						$args['meta_key'] = 'total_sales';
						$args['order'] = 'DESC';
						break;

					default:
						$args['orderby'] = 'date';
						$args['order'] = 'DESC';
						break;
				}
				return $args;
			}
		}

		/* Listing with Detail AJAX
............................ */
		if (!function_exists('entrada_list_withdetail')) {
			function entrada_list_withdetail()
			{
				global $wpdb;
				$response_arr = array();
				$tax_query = array();
				$meta_query = array();
				$html = '';
				$record_count = 0;
				$args = array(
					'post_type' 		=> 'product',
					'posts_per_page'	=> $_POST['posts_per_page'],
					'paged' 			=> $_POST['paged'],
					'post_status' 		=> 'publish',
				);

				$meta_query[] = array(
					'key' 		=> 'entrada_product_type',
					'value' 	=> 'tour',
					'compare' 	=> '='
				);

				$args = entrada_sort_post_param($_POST['filter_by_order'], $args);

				if (isset($_POST['holiday_type']) && $_POST['holiday_type'] != '') {
					$tax_query[] = array(
						'taxonomy' 	=> 'holiday_type',
						'field' 	=> 'slug',
						'terms' 	=> $_POST['holiday_type']
					);
				}

				if (isset($_POST['activity_level']) && $_POST['activity_level'] != '') {
					$tax_query[] = array(
						'taxonomy'	=> 'activity_level',
						'field' 	=> 'slug',
						'terms' 	=> $_POST['activity_level']
					);
				}

				if (isset($_POST['price_range']) && $_POST['price_range'] != '') {
					$price_range_arr = explode("-", $_POST['price_range']);
					$meta_query[] = array(
						'key' 		=> '_price',
						'value' 	=> $price_range_arr,
						'compare' 	=> 'BETWEEN',
						'type' 		=> 'NUMERIC'
					);
				}
				if (count($meta_query) > 0) {
					$args['meta_query'] = $meta_query;
				}
				if (count($tax_query) > 0) {
					$tax_query['relation'] = 'AND';
					$args['tax_query'] = $tax_query;
				}
				$loop = new WP_Query($args);
				if ($loop->have_posts()) {
					$record_count = $loop->found_posts;
					while ($loop->have_posts()) : $loop->the_post();
						$average_rating =  entrada_post_average_rating(get_the_ID());
						$html .= '<article class="article has-hover-s1 ratingview" >';
						$html .= '<div class="thumbnail" itemscope itemtype="http://schema.org/Product">';
						$entrada_social_media_share_img =  entrada_social_media_share_img(get_the_ID());
						$html .= entrada_product_resized_img(get_the_ID(), $resize = array(550, 358));
						$html .= '<div class="description">';
						$html .= '<div class="col-left">';
						$html .= '<header class="heading">';
						$html .= '<h3><a href="' . get_permalink() . '" itemprop="name">' . get_the_title() . ' with detail</a></h3>';
						$html .= '<div class="info-day">' . get_post_meta(get_the_ID(), "trip_duration", true) . '</div>';
						$html .= '</header>';
						$html .= '<p itemprop="description">' . entrada_truncate(get_the_ID(), 40, 180, 'id') . '</p>';
						$html .= '<div class="reviews-holder">';
						$html .= '<div class="star-rating">';
						$html .= '<input class="product_rating" type="hidden" value="' . $average_rating . '">';
						$html .= '<div class="product_rateYo"></div>';
						$html .= '</div>';
						$html .= '<div class="info-rate">' . entrada_post_total_reviews(get_the_ID()) . '</div>';
						$html .= '</div>';
						$html .= '<footer class="info-footer">';
						$product_tag = wp_get_post_terms(get_the_ID(), 'product_tag');
						if (count($product_tag) > 0) {
							$html .=  '<ul class="ico-list">';
							foreach ($product_tag as $term) {
								$icomoon_class = entrada_icomoon_class($term->slug);
								if (!empty($icomoon_class)) {
									$html .= '<li class="pop-opener">';
									$html .= '<span class="' . $icomoon_class . '"></span>';
									$html .= '<div class="popup">' . ucwords($term->name) . '</div>';
									$html .= '</li>';
								}
							}
							$html .= '</ul>';
						}
						$html .= '<ul class="ico-action">';

						if (shortcode_exists('sharethis_nav')) {
							$html .=  do_shortcode('[sharethis_nav post_id="' . get_the_ID() . '"]');
						}
						$html .=  '<li>' . entrada_wishlist_html(get_the_ID()) . '</li></ul>';
						$html .= '</footer>';
						$html .= '</div>';
						$html .= '<aside class="info-aside">';
						$html .= '<span class="price">' . entrada_price_from_txt(entrada_product_price(get_the_ID(), false)) . ' <span ' . entrada_price_schema_micro_data_link(get_the_ID()) . '>' . entrada_product_price(get_the_ID(), false) . '</span></span>';
						$html .= '<div class="activity-level">';
						$html .= '<div class="ico">';
						$html .= '<span class="icon-level' . entrada_product_activity_level(get_the_ID(), 'level', false) . '"></span>';
						$html .= '</div>';
						$html .= '<span class="text">' . entrada_product_activity_level(get_the_ID(), 'title', false) . '</span>';
						$html .= '</div>';
						$html .= '<a href="' . get_permalink(get_the_ID()) . '" class="btn btn-default" itemprop="url">' . get_theme_mod('square_button_text', 'Explore') . '</a>';
						$html .= '</aside>';
						$html .= '</div>';
						$html .= '</div>';
						$html .= '</article>';
					endwhile;
					wp_reset_postdata();
				} else {
					$html .= '';
				}
				$record_message = sprintf(esc_html(_n('%d Trip matches your search criteria', '%d Trips match your search criteria', $record_count, 'entrada')), $record_count);
				$response_arr['html_content'] = $html;
				$response_arr['record_count'] = $record_message;
				echo json_encode($response_arr, true);
				exit;
			}
		}
		add_action('wp_ajax_list_withdetail', 'entrada_list_withdetail');
		add_action('wp_ajax_nopriv_list_withdetail', 'entrada_list_withdetail');

		if (!function_exists('entrada_grid_withdetail')) {
			function entrada_grid_withdetail()
			{
				global $wpdb;
				$response_arr = array();
				$tax_query = array();
				$meta_query = array();
				$html = '';
				$record_count = 0;
				$args = array(
					'post_type' 		=> 'product',
					'posts_per_page' 	=> $_POST['posts_per_page'],
					'paged' 			=> $_POST['paged'],
					'post_status' 		=> 'publish',
				);

				$meta_query[] = array(
					'key' 		=> 'entrada_product_type',
					'value' 	=> 'tour',
					'compare' 	=> '='
				);
				$args = entrada_sort_post_param($_POST['filter_by_order'], $args);

				if (isset($_POST['holiday_type']) && $_POST['holiday_type'] != '') {
					$tax_query[] = array(
						'taxonomy'	=> 'holiday_type',
						'field' 	=> 'slug',
						'terms' 	=> $_POST['holiday_type']
					);
				}

				if (isset($_POST['activity_level']) && $_POST['activity_level'] != '') {
					$tax_query[] = array(
						'taxonomy' 	=> 'activity_level',
						'field' 	=> 'slug',
						'terms' 	=> $_POST['activity_level']
					);
				}

				if (isset($_POST['destination']) && $_POST['destination'] != '') {
					$tax_query[] = array(
						'taxonomy'	=> 'destination',
						'field' 	=> 'slug',
						'terms' 	=> $_POST['destination']
					);
				}

				if (isset($_POST['price_range']) && $_POST['price_range'] != '') {
					$price_range_arr = explode("-", $_POST['price_range']);
					$meta_query[] = array(
						'key' 		=> '_price',
						'value' 	=> $price_range_arr,
						'compare' 	=> 'BETWEEN',
						'type' 		=> 'NUMERIC'
					);
				}
				if (count($meta_query) > 0) {
					$args['meta_query'] = $meta_query;
				}
				if (count($tax_query) > 0) {
					$tax_query['relation'] = 'AND';
					$args['tax_query'] = $tax_query;
				}
				$loop = new WP_Query($args);
				if ($loop->have_posts()) {
					$record_count = $loop->found_posts;
					while ($loop->have_posts()) : $loop->the_post();

						$entrada_social_media_share_img = '';
						$share_txt = entrada_truncate(get_the_ID(), 30, 120, 'id');
						$average_rating =  entrada_post_average_rating(get_the_ID());

						$html .= '<article class="col-sm-6 col-md-4 article has-hover-s1">';
						$html .= '<div class="thumbnail" itemscope itemtype="http://schema.org/Product">';
						$entrada_social_media_share_img =  entrada_social_media_share_img(get_the_ID());
						$html .= entrada_product_resized_img(get_the_ID(), $resize = array(550, 358));
						$html .= '<h3 class="small-space"><a href="' . get_permalink($loop->ID) . '" itemprop="name">' . get_the_title() . '</a></h3>';
						$html .= '<span class="info">' . entrada_product_categories(get_the_ID(), false) . '</span>';
						$html .= '<aside class="meta">' . entrada_destinations_activities_count(get_the_ID(), false) . '</aside>';
						$html .= '<p itemprop="description">' . entrada_truncate(get_the_ID(), 30, 120, 'id') . '</p>';
						$html .= '<a href="' . get_permalink($loop->ID) . '" class="btn btn-default" itemprop="url">' . get_theme_mod('square_button_text', 'Explore') . '</a>';
						$html .= '<footer>';
						$html .= '<ul class="social-networks">' . entrada_social_media_share_btn(get_the_title($loop->ID), get_permalink($loop->ID), $share_txt, $entrada_social_media_share_img) . '</ul>';
						$html .= '<span class="price">' . entrada_price_from_txt(entrada_product_price(get_the_ID(), false)) . ' <span ' . entrada_price_schema_micro_data_link(get_the_ID()) . '>' . entrada_product_price(get_the_ID(), false) . '</span></span>';
						$html .= '</footer>';
						$html .= '</div>';
						$html .= '</article>';
					endwhile;
					wp_reset_postdata();
				} else {
					$html .= '';
				}
				$record_message = sprintf(esc_html(_n('%d Trip matches your search criteria', '%d Trips match your search criteria', $record_count, 'entrada')), $record_count);
				$response_arr['html_content'] = $html;
				$response_arr['record_count'] = $record_message;
				echo json_encode($response_arr, true);
				exit;
			}
		}
		add_action('wp_ajax_grid_withdetail', 'entrada_grid_withdetail');
		add_action('wp_ajax_nopriv_grid_withdetail', 'entrada_grid_withdetail');

		/* Listing with Full Width Grid 2 column AJAX
............................ */
		if (!function_exists('entrada_grid_twocol')) {
			function entrada_grid_twocol()
			{
				global $wpdb;

				$response_arr = array();
				$tax_query = array();
				$meta_query = array();
				$html = '';
				$record_count = 0;

				$args = array(
					'post_type' => 'product',
					'posts_per_page' => $_POST['posts_per_page'],
					'paged' => $_POST['paged'],
					'post_status' 		=> 'publish',
				);

				$meta_query[] = array(
					'key' 		=> 'entrada_product_type',
					'value' 	=> 'tour',
					'compare' 	=> '='
				);
				$args = entrada_sort_post_param($_POST['filter_by_order'], $args);

				if (isset($_POST['holiday_type']) && $_POST['holiday_type'] != '') {
					$tax_query[] = array(
						'taxonomy' => 'holiday_type',
						'field' => 'slug',
						'terms' => $_POST['holiday_type']
					);
				}

				if (isset($_POST['activity_level']) && $_POST['activity_level'] != '') {
					$tax_query[] = array(
						'taxonomy' => 'activity_level',
						'field' => 'slug',
						'terms' => $_POST['activity_level']
					);
				}

				if (isset($_POST['destination']) && $_POST['destination'] != '') {
					$tax_query[] = array(
						'taxonomy' => 'destination',
						'field' => 'slug',
						'terms' => $_POST['destination']
					);
				}

				if (isset($_POST['price_range']) && $_POST['price_range'] != '') {
					$price_range_arr = explode("-", $_POST['price_range']);
					$meta_query[] = array(
						'key' => '_price',
						'value' => $price_range_arr,
						'compare' => 'BETWEEN',
						'type' => 'NUMERIC'
					);
				}

				if (count($meta_query) > 0) {
					$args['meta_query'] = $meta_query;
				}

				if (count($tax_query) > 0) {
					$tax_query['relation'] = 'AND';
					$args['tax_query'] = $tax_query;
				}

				$loop = new WP_Query($args);

				if ($loop->have_posts()) {
					$record_count = $loop->found_posts;
					while ($loop->have_posts()) : $loop->the_post();
						$entrada_social_media_share_img = '';
						$share_txt = entrada_truncate(get_the_ID(), 30, 120, 'id');
						$average_rating =  entrada_post_average_rating(get_the_ID());
						$html .= '<article class="col-sm-6 article has-hover-s1">';
						$html .= '<div class="thumbnail" itemscope itemtype="http://schema.org/Product">';
						$entrada_social_media_share_img =  entrada_social_media_share_img(get_the_ID());
						$html .= entrada_product_resized_img(get_the_ID(), $resize = array(550, 358));
						$html .= '<h3 class="small-space"><a href="' . get_permalink($loop->ID) . '" itemprop="name">' . get_the_title() . '</a></h3>';
						$html .= '<span class="info">' . entrada_product_categories(get_the_ID(), false) . '</span>';
						$html .= '<aside class="meta">' . entrada_destinations_activities_count(get_the_ID(), false) . '</aside>';
						$html .= '<p itemprop="description">' . entrada_truncate(get_the_ID(), 30, 120, 'id') . '</p>';
						$html .= '<a href="' . get_permalink($loop->ID) . '" class="btn btn-default" itemprop="url">' . get_theme_mod('square_button_text', 'Explore') . '</a>';
						$html .= '<footer>';
						$html .= '<ul class="social-networks">' . entrada_social_media_share_btn(get_the_title($loop->ID), get_permalink($loop->ID), $share_txt, $entrada_social_media_share_img) . '</ul>';
						$html .= '<span class="price">' . entrada_price_from_txt(entrada_product_price(get_the_ID(), false)) . ' <span ' . entrada_price_schema_micro_data_link(get_the_ID()) . '>' . entrada_product_price(get_the_ID(), false) . '</span></span>';
						$html .= '</footer>';
						$html .= '</div>';
						$html .= '</article>';
					endwhile;
					wp_reset_postdata();
				} else {
					$html .= '';
				}
				$record_message = sprintf(esc_html(_n('%d Trip matches your search criteria', '%d Trips match your search criteria', $record_count, 'entrada')), $record_count);

				$response_arr['html_content'] = $html;
				$response_arr['record_count'] = $record_message;
				echo json_encode($response_arr, true);
				exit;
			}
		}
		add_action('wp_ajax_grid_twocol', 'entrada_grid_twocol');
		add_action('wp_ajax_nopriv_grid_twocol', 'entrada_grid_twocol');


		/* Listing with Full Width Grid 3 column AJAX
............................ */
		if (!function_exists('entrada_grid_threecol')) {
			function entrada_grid_threecol()
			{
				global $wpdb;
				$response_arr = array();
				$tax_query = array();
				$meta_query = array();
				$html = '';
				$record_count = 0;
				$args = array(
					'post_type' 		=> 'product',
					'posts_per_page' 	=> $_POST['posts_per_page'],
					'paged' 			=> $_POST['paged'],
					'post_status' 		=> 'publish',
				);

				$meta_query[] = array(
					'key' 		=> 'entrada_product_type',
					'value' 	=> 'tour',
					'compare' 	=> '='
				);

				$args = entrada_sort_post_param($_POST['filter_by_order'], $args);

				if (isset($_POST['holiday_type']) && $_POST['holiday_type'] != '') {
					$tax_query[] = array(
						'taxonomy'	=> 'holiday_type',
						'field' 	=> 'slug',
						'terms' 	=> $_POST['holiday_type']
					);
				}
				if (isset($_POST['activity_level']) && $_POST['activity_level'] != '') {
					$tax_query[] = array(
						'taxonomy' 	=> 'activity_level',
						'field' 	=> 'slug',
						'terms' 	=> $_POST['activity_level']
					);
				}

				if (isset($_POST['destination']) && $_POST['destination'] != '') {
					$tax_query[] = array(
						'taxonomy' 	=> 'destination',
						'field' 	=> 'slug',
						'terms' 	=> $_POST['destination']
					);
				}

				if (isset($_POST['price_range']) && $_POST['price_range'] != '') {
					$price_range_arr = explode("-", $_POST['price_range']);
					$meta_query[] = array(
						'key' 		=> '_price',
						'value' 	=> $price_range_arr,
						'compare' 	=> 'BETWEEN',
						'type' 		=> 'NUMERIC'
					);
				}
				if (count($meta_query) > 0) {
					$args['meta_query'] = $meta_query;
				}
				if (count($tax_query) > 0) {
					$tax_query['relation'] = 'AND';
					$args['tax_query'] = $tax_query;
				}
				$loop = new WP_Query($args);
				if ($loop->have_posts()) {
					$record_count = $loop->found_posts;
					while ($loop->have_posts()) : $loop->the_post();
						$entrada_social_media_share_img = '';
						$share_txt = entrada_truncate(get_the_ID(), 30, 120, 'id');
						$average_rating =  entrada_post_average_rating(get_the_ID());
						$html .= '<article class="col-sm-6 col-md-4 article has-hover-s1">';
						$html .= '<div class="thumbnail" itemscope itemtype="http://schema.org/Product">';
						$entrada_social_media_share_img =  entrada_social_media_share_img(get_the_ID());
						$html .= entrada_product_resized_img(get_the_ID(), $resize = array(550, 358));
						$html .= '<h3 class="small-space"><a href="' . get_permalink($loop->ID) . '" itemprop="name">' . get_the_title() . '</a></h3>';
						$html .= '<span class="info">' . entrada_product_categories(get_the_ID(), false) . '</span>';
						$html .= '<aside class="meta">' . entrada_destinations_activities_count(get_the_ID(), false) . '</aside>';
						$html .= '<p itemprop="description">' . entrada_truncate(get_the_ID(), 30, 120, 'id') . '</p>';
						$html .= '<a href="' . get_permalink($loop->ID) . '" class="btn btn-default" itemprop="url">' . get_theme_mod('square_button_text', 'Explore') . '</a>';
						$html .= '<footer>';
						$html .= '<ul class="social-networks">' . entrada_social_media_share_btn(get_the_title($loop->ID), get_permalink($loop->ID), $share_txt, $entrada_social_media_share_img) . '</ul>';
						$html .= '<span class="price">' . entrada_price_from_txt(entrada_product_price(get_the_ID(), false)) . ' <span ' . entrada_price_schema_micro_data_link(get_the_ID()) . '>' . entrada_product_price(get_the_ID(), false) . '</span></span>';
						$html .= '</footer>';
						$html .= '</div>';
						$html .= '</article>';
					endwhile;
					wp_reset_postdata();
				} else {
					$html .= '';
				}
				$record_message = sprintf(esc_html(_n('%d Trip matches your search criteria', '%d Trips match your search criteria', $record_count, 'entrada')), $record_count);

				$response_arr['html_content'] = $html;
				$response_arr['record_count'] = $record_message;
				echo json_encode($response_arr, true);
				exit;
			}
		}
		add_action('wp_ajax_grid_threecol', 'entrada_grid_threecol');
		add_action('wp_ajax_nopriv_grid_threecol', 'entrada_grid_threecol');

		/* Listing with Full Width Grid 4 column AJAX
............................ */
		if (!function_exists('entrada_grid_fourcol')) {
			function entrada_grid_fourcol()
			{
				global $wpdb;
				$response_arr = array();
				$tax_query = array();
				$meta_query = array();
				$html = '';
				$record_count = 0;


				$args = array(
					'post_type'			=> 'product',
					'posts_per_page' 	=> $_POST['posts_per_page'],
					'paged'				=> $_POST['paged'],
					'post_status' 		=> 'publish',
				);

				$meta_query[] = array(
					'key' 		=> 'entrada_product_type',
					'value' 	=> 'tour',
					'compare' 	=> '='
				);

				$args = entrada_sort_post_param($_POST['filter_by_order'], $args);

				if (isset($_POST['holiday_type']) && $_POST['holiday_type'] != '') {
					$tax_query[] = array(
						'taxonomy' 	=> 'holiday_type',
						'field' 	=> 'slug',
						'terms' 	=> $_POST['holiday_type']
					);
				}
				if (isset($_POST['activity_level']) && $_POST['activity_level'] != '') {
					$tax_query[] = array(
						'taxonomy' 	=> 'activity_level',
						'field' 	=> 'slug',
						'terms' 	=> $_POST['activity_level']
					);
				}
				if (isset($_POST['destination']) && $_POST['destination'] != '') {
					$tax_query[] = array(
						'taxonomy' 	=> 'destination',
						'field' 	=> 'slug',
						'terms' 	=> $_POST['destination']
					);
				}
				if (isset($_POST['price_range']) && $_POST['price_range'] != '') {
					$price_range_arr = explode("-", $_POST['price_range']);
					$meta_query[] = array(
						'key' 		=> '_price',
						'value' 	=> $price_range_arr,
						'compare' 	=> 'BETWEEN',
						'type' 		=> 'NUMERIC'
					);
				}
				if (count($meta_query) > 0) {
					$args['meta_query'] = $meta_query;
				}
				if (count($tax_query) > 0) {
					$tax_query['relation'] = 'AND';
					$args['tax_query'] = $tax_query;
				}
				$loop = new WP_Query($args);
				if ($loop->have_posts()) {
					$record_count = $loop->found_posts;
					while ($loop->have_posts()) : $loop->the_post();
						$entrada_social_media_share_img = '';
						$share_txt = entrada_truncate(get_the_ID(), 30, 120, 'id');
						$average_rating =  entrada_post_average_rating(get_the_ID());
						$html .= '<article class="col-sm-6 col-md-4 col-lg-3 article has-hover-s1">';
						$html .= '<div class="thumbnail" itemscope itemtype="http://schema.org/Product">';
						$entrada_social_media_share_img =  entrada_social_media_share_img(get_the_ID());
						$html .= entrada_product_resized_img(get_the_ID(), $resize = array(550, 358));
						$html .= '<h3 class="small-space"><a href="' . get_permalink($loop->ID) . '" itemprop="name">' . get_the_title() . '</a></h3>';
						$html .= '<span class="info">' . entrada_product_categories(get_the_ID(), false) . '</span>';
						$html .= '<aside class="meta">' . entrada_destinations_activities_count(get_the_ID(), false) . '</aside>';
						$html .= '<p itemprop="description">' . entrada_truncate(get_the_ID(), 30, 120, 'id') . '</p>';
						$html .= '<a href="' . get_permalink($loop->ID) . '" class="btn btn-default" itemprop="url">' . get_theme_mod('square_button_text', 'Explore') . '</a>';
						$html .= '<footer>';
						$html .= '<ul class="social-networks">' . entrada_social_media_share_btn(get_the_title($loop->ID), get_permalink($loop->ID), $share_txt, $entrada_social_media_share_img) . '</ul>';
						$html .= '<span class="price">' . entrada_price_from_txt(entrada_product_price(get_the_ID(), false)) . ' <span ' . entrada_price_schema_micro_data_link(get_the_ID()) . '>' . entrada_product_price(get_the_ID(), false) . '</span></span>';
						$html .= '</footer>';
						$html .= '</div>';
						$html .= '</article>';

					endwhile;
					wp_reset_postdata();
				} else {
					$html .= '';
				}
				$record_message = sprintf(esc_html(_n('%d Trip matches your search criteria', '%d Trips match your search criteria', $record_count, 'entrada')), $record_count);

				$response_arr['html_content'] = $html;
				$response_arr['record_count'] = $record_message;
				echo json_encode($response_arr, true);
				exit;
			}
		}
		add_action('wp_ajax_grid_fourcol', 'entrada_grid_fourcol');
		add_action('wp_ajax_nopriv_grid_fourcol', 'entrada_grid_fourcol');

		/* Search Filter AJAX
............................ */
		if (!function_exists('entrada_search_filter')) {
			function entrada_search_filter()
			{
				global $wpdb;
				$currency_symbol = get_woocommerce_currency_symbol();
				$response_arr = array();
				$tax_query = array();
				$meta_query = array();
				$html_content = '';
				$record_count = 0;

				wp_reset_query();
				wp_reset_postdata();

				$args = array(
					'post_type' 		=> 'product',
					'posts_per_page' 	=> $_POST['posts_per_page'],
					'paged' 			=> $_POST['paged'],
					'post_status' 	 	=> 'publish'
				);

				$meta_query[] = array(
					'key' 		=> 'entrada_product_type',
					'value' 	=> 'tour',
					'compare' 	=> '='
				);

				if (!empty($_POST['load_start_date']) || !empty($_POST['load_end_date'])) {
					$child_posts = array();
					$child_posts =	entrada_date_range_meta_query($_POST['load_start_date'], $_POST['load_end_date']);
					array_push($child_posts, "0");

					if (count($child_posts) > 0) {
						$args['post__in'] = $child_posts;
					}
				}

				$args = entrada_sort_post_param($_POST['filter_by_order'], $args);

				if (isset($_POST['holiday_type']) && $_POST['holiday_type'] != '') {
					$holiday_type = explode("%", $_POST['holiday_type']);
					$tax_query[] = array(
						'taxonomy'	=> 'holiday_type',
						'field' 	=> 'slug',
						'terms' 	=> $holiday_type
					);
				}
				if (isset($_POST['destination']) && $_POST['destination'] != '') {
					$destination = explode("%", $_POST['destination']);
					$tax_query[] = array(
						'taxonomy' 	=> 'destination',
						'field' 	=> 'slug',
						'terms' 	=> $destination
					);
				}
				if (isset($_POST['product_cat']) && $_POST['product_cat'] != '') {
					$product_cat = explode("%", $_POST['product_cat']);
					$tax_query[] = array(
						'taxonomy' 	=> 'product_cat',
						'field' 	=> 'slug',
						'terms' 	=> $product_cat
					);
				}
				if (isset($_POST['product_tag']) && $_POST['product_tag'] != '') {
					$product_tag = explode("%", $_POST['product_tag']);
					$tax_query[] = array(
						'taxonomy' 	=> 'product_tag',
						'field' 	=> 'slug',
						'terms' 	=> $product_tag
					);
				}

				if (isset($_POST['product_activity']) && $_POST['product_activity'] != '') {
					$product_activity = explode("%", $_POST['product_activity']);
					$tax_query[] = array(
						'taxonomy' 	=> 'activity_level',
						'field' 	=> 'slug',
						'terms' 	=> $product_activity
					);
				}
				if (isset($_POST['price_range']) && $_POST['price_range'] != '') {
					$price_range 		= str_replace($currency_symbol, '', $_POST['price_range']);
					$price_range 		= str_replace(' - ', '-', $price_range);
					$price_range_arr 	= explode("-", $price_range);
					$meta_query[] 		= array(
						'key' 		=> '_price',
						'value' 	=> $price_range_arr,
						'compare' 	=> 'BETWEEN',
						'type' 		=> 'NUMERIC'
					);
				}
				$tax_query[] = array(
					array(
						'taxonomy' => 'product_visibility',
						'field'    => 'name',
						'terms'    => 'exclude-from-search',
						'operator' => 'NOT IN',
					)
				);

				if (count($meta_query) > 0) {
					$args['meta_query'] = $meta_query;
				}
				if (count($tax_query) > 0) {
					$tax_query['relation'] = 'AND';
					$args['tax_query'] = $tax_query;
				}

				$search_post = new WP_Query($args);
				if ($search_post->have_posts()) {
					$record_count = $search_post->found_posts;
					while ($search_post->have_posts()) : $search_post->the_post();
						$average_rating =  entrada_post_average_rating(get_the_ID());
						$entrada_social_media_share_img = '';
						$share_txt = wp_trim_words(strip_tags(get_the_content()), 40, '.');

						switch ($_POST['view_mode']) {
							case 'list':
								$average_rating =  entrada_post_average_rating(get_the_ID());
								$html_content .= '<article class="article has-hover-s1 ratingview" >';
								$html_content .= '<div class="thumbnail" itemscope itemtype="http://schema.org/Product">';
								$entrada_social_media_share_img =  entrada_social_media_share_img(get_the_ID());
								$html_content .= entrada_product_resized_img(get_the_ID(), $resize = array(550, 358));
								$html_content .= '<div class="description">';
								$html_content .= '<div class="col-left">';
								$html_content .= '<header class="heading">';
								$html_content .= '<h3><a href="' . get_permalink() . '" itemprop="name">' . get_the_title() . '</a></h3>';
								$html_content .= '<div class="info-day">' . get_post_meta(get_the_ID(), "trip_duration", true) . '</div>';
								$html_content .= '</header>';
								$html_content .= '<p itemprop="description">' . entrada_truncate(get_the_ID(), 40, 180, 'id') . '</p>';
								$html_content .= '<div class="reviews-holder">';
								$html_content .= '<div class="star-rating">';
								$html_content .= '<input class="product_rating" type="hidden" value="' . $average_rating . '"><div class="product_rateYo"></div>';
								$html_content .= '</div>';
								$html_content .= '<div class="info-rate">' . entrada_post_total_reviews(get_the_ID()) . '</div>';
								$html_content .= '</div>';
								$html_content .= '<footer class="info-footer">';
								$product_tag = wp_get_post_terms(get_the_ID(), 'product_tag');
								if (count($product_tag) > 0) {
									$html_content .=  '<ul class="ico-list">';
									foreach ($product_tag as $term) {
										$icomoon_class = entrada_icomoon_class($term->slug);
										if (!empty($icomoon_class)) {
											$html_content .=  '<li class="pop-opener"><span class="' . $icomoon_class . '"></span><div class="popup">' . ucwords($term->name) . '</div></li>';
										}
									}
									$html_content .=  '</ul>';
								}


								$html_content .= '<ul class="ico-action">';

								if (shortcode_exists('sharethis_nav')) {
									$html_content .=  do_shortcode('[sharethis_nav post_id="' . get_the_ID() . '"]');
								}
								$html_content .=  '<li>' . entrada_wishlist_html(get_the_ID()) . '</li></ul>';

								$html_content .= '</footer>';
								$html_content .= '</div>';
								$html_content .= '<aside class="info-aside">';
								$html_content .= '<span class="price">' . entrada_price_from_txt(entrada_product_price(get_the_ID(), false)) . ' <span ' . entrada_price_schema_micro_data_link(get_the_ID()) . '>' . entrada_product_price(get_the_ID(), false) . '</span></span>';
								$html_content .= '<div class="activity-level">';
								$html_content .= '<div class="ico"><span class="icon-level' . entrada_product_activity_level(get_the_ID(), 'level', false) . '"></span></div>';
								$html_content .= '<span class="text">' . entrada_product_activity_level(get_the_ID(), 'title', false) . '</span>';
								$html_content .= '</div>';
								$html_content .= '<a href="' . get_permalink(get_the_ID()) . '" class="btn btn-default" itemprop="url">' . get_theme_mod('square_button_text', 'Explore') . '</a>';
								$html_content .= '</aside>';
								$html_content .= '</div>';
								$html_content .= '</div>';
								$html_content .= '</article>';
								break;

							default:
								$html_content .= '<article class="col-md-6 col-lg-4 article has-hover-s1 thumb-full">';
								$html_content .= '<div class="thumbnail" itemscope itemtype="http://schema.org/Product">';
								$entrada_social_media_share_img =  entrada_social_media_share_img(get_the_ID());
								$html_content .= entrada_product_resized_img(get_the_ID(), $resize = array(550, 358));
								$html_content .= '<h3 class="small-space"><a href="' . get_permalink($search_post->ID) . '" itemprop="name">' . get_the_title() . '</a></h3>';
								$html_content .= '<span class="info">' . entrada_product_categories(get_the_ID(), false) . '</span>';
								$html_content .= '<aside class="meta">' . entrada_destinations_activities_count(get_the_ID(), false) . '</aside>';
								$html_content .= '<p itemprop="description">' . entrada_truncate(get_the_ID(), 30, 120, 'id') . '</p>';
								$html_content .= '<a href="' . get_permalink($search_post->ID) . '" class="btn btn-default">' . get_theme_mod('square_button_text', 'Explore') . '</a>';
								$html_content .= '<footer>';
								$html_content .= '<ul class="social-networks">' . entrada_social_media_share_btn(get_the_title($search_post->ID), get_permalink($search_post->ID), $share_txt, $entrada_social_media_share_img) . '</ul>';
								$html_content .= '<span class="price">' . entrada_price_from_txt(entrada_product_price(get_the_ID(), false)) . ' <span ' . entrada_price_schema_micro_data_link(get_the_ID()) . '>' . entrada_product_price(get_the_ID(), false) . '</span></span>';
								$html_content .= '</footer>';
								$html_content .= '</div>';
								$html_content .= '</article>';
								break;
						}
					endwhile;
					wp_reset_query();
				} else {
					$html_content .= '';
				}
				$record_message = sprintf(esc_html(_n('%d Trip matches your search criteria', '%d Trips match your search criteria', $record_count, 'entrada')), $record_count);

				$response_arr['html_content'] = $html_content;
				$response_arr['record_count'] = $record_message;
				echo json_encode($response_arr, true);
				exit;
			}
		}
		add_action('wp_ajax_entrada_search_filter', 'entrada_search_filter');
		add_action('wp_ajax_nopriv_entrada_search_filter', 'entrada_search_filter');


		/* Sidebar (Left/Right) AJAX
............................ */
		if (!function_exists('entrada_list_sidebarleft')) {
			function entrada_list_sidebarleft()
			{
				global $wpdb;
				$currency_symbol = get_woocommerce_currency_symbol();
				$response_arr = array();
				$tax_query = array();
				$meta_query = array();
				$html = '';
				$record_count = 0;
				$args = array(
					'post_type' 		=> 'product',
					'posts_per_page' 	=> $_POST['posts_per_page'],
					'paged' 			=> $_POST['paged'],
					'post_status' 		=> 'publish',
				);

				$args = entrada_sort_post_param($_POST['filter_by_order'], $args);
				$meta_query[] = array(
					'key' 		=> 'entrada_product_type',
					'value' 	=> 'tour',
					'compare' 	=> '='
				);

				if (isset($_POST['destination']) && $_POST['destination'] != '') {
					$destination = explode("%", $_POST['destination']);
					$tax_query[] = array(
						'taxonomy' 	=> 'destination',
						'field' 	=> 'slug',
						'terms' 	=> $destination
					);
				}

				if (isset($_POST['product_cat']) && $_POST['product_cat'] != '') {
					$product_cat = explode("%", $_POST['product_cat']);
					$tax_query[] = array(
						'taxonomy' 	=> 'product_cat',
						'field' 	=> 'slug',
						'terms' 	=> $product_cat
					);
				}

				if (isset($_POST['product_tag']) && $_POST['product_tag'] != '') {
					$product_tag = explode("%", $_POST['product_tag']);
					$tax_query[] = array(
						'taxonomy' 	=> 'product_tag',
						'field' 	=> 'slug',
						'terms' 	=> $product_tag
					);
				}

				if (isset($_POST['product_activity']) && $_POST['product_activity'] != '') {
					$product_activity = explode("%", $_POST['product_activity']);
					$tax_query[] = array(
						'taxonomy' 	=> 'activity_level',
						'field' 	=> 'slug',
						'terms' 	=> $product_activity
					);
				}
				if (isset($_POST['price_range']) && $_POST['price_range'] != '') {
					$price_range = str_replace($currency_symbol, '', $_POST['price_range']);
					$price_range_arr = explode(" - ", $price_range);
					$meta_query[] = array(
						'key' 		=> '_price',
						'value' 	=> $price_range_arr,
						'compare' 	=> 'BETWEEN',
						'type' 		=> 'NUMERIC'
					);
				}
				if (count($meta_query) > 0) {
					$args['meta_query'] = $meta_query;
				}
				if (count($tax_query) > 0) {
					$tax_query['relation'] = 'AND';
					$args['tax_query'] = $tax_query;
				}


				$loop = new WP_Query($args);
				if ($loop->have_posts()) {
					$record_count = $loop->found_posts;
					while ($loop->have_posts()) : $loop->the_post();

						$average_rating =  entrada_post_average_rating(get_the_ID());
						$html .= '<article class="article has-hover-s1 ratingview">';
						$html .= '<div class="thumbnail" itemscope itemtype="http://schema.org/Product">';
						$entrada_social_media_share_img =  entrada_social_media_share_img(get_the_ID());
						$html .= entrada_product_resized_img(get_the_ID(), $resize = array(550, 358));
						$html .= '<div class="description" >';
						$html .= '<div class="col-left">';
						$html .= '<header class="heading">';
						$html .= '<h3 class="small-space"><a href="' . get_permalink($loop->ID) . '" itemprop="name">' . get_the_title() . '</a></h3>';
						$html .= '<time class="info-day" datetime="2011-01-12">' . get_post_meta(get_the_ID(), "trip_duration", true) . '</time>';
						$html .= '</header>';
						$html .= '<p itemprop="description">' . entrada_truncate(get_the_ID(), 30, 120, 'id') . '</p>';
						$html .= '<div class="reviews-holder">';
						$html .= '<div class="star-rating">';
						$html .= '<input class="product_rating" type="hidden" value="' . $average_rating . '"><div class="product_rateYo"></div>';
						$html .= '</div>';
						$html .= '<div class="info-rate">' . entrada_post_total_reviews(get_the_ID()) . '</div></div>';
						$html .= '<footer class="info-footer">';
						$product_tag = wp_get_post_terms(get_the_ID(), 'product_tag');
						if (count($product_tag) > 0) {
							$html .=  '<ul class="ico-list">';
							foreach ($product_tag as $term) {
								$icomoon_class = entrada_icomoon_class($term->slug);
								if (!empty($icomoon_class)) {
									$html .=  '<li class="pop-opener"><span class="' . $icomoon_class . '"></span><div class="popup">' . ucwords($term->name) . '</div></li>';
								}
							}
							$html .=  '</ul>';
						}



						$html .= '<ul class="ico-action">';

						if (shortcode_exists('sharethis_nav')) {
							$html .=  do_shortcode('[sharethis_nav post_id="' . get_the_ID() . '"]');
						}
						$html .=  '<li>' . entrada_wishlist_html(get_the_ID()) . '</li></ul>';

						$html .= '</footer>';
						$html .= '</div>';
						$html .= '<aside class="info-aside">';
						$html .= '<span class="price">' . entrada_price_from_txt(entrada_product_price(get_the_ID(), false)) . ' <span ' . entrada_price_schema_micro_data_link(get_the_ID()) . '>' . entrada_product_price(get_the_ID(), false) . '</span></span>';
						$html .= '<div class="activity-level">';
						$html .= '<div class="ico">';
						$html .= '<span class="icon-level' . entrada_product_activity_level(get_the_ID(), 'level', false) . '"></span>';
						$html .= '</div>';
						$html .= '<span class="text">' . entrada_product_activity_level(get_the_ID(), 'title', false) . '</span>';
						$html .= '</div>';
						$html .= '<a href="' . get_permalink(get_the_ID()) . '" class="btn btn-default" itemprop="url">' . get_theme_mod('square_button_text', 'Explore') . '</a>';
						$html .= '</aside>';
						$html .= '</div>';
						$html .= '</div>';
						$html .= '</article>';

					endwhile;
					wp_reset_postdata();
				} else {
					$html .= '';
				}
				$record_message = sprintf(esc_html(_n('%d Trip matches your search criteria', '%d Trips match your search criteria', $record_count, 'entrada')), $record_count);

				$response_arr['html_content'] = $html;
				$response_arr['record_count'] = $record_message;
				echo json_encode($response_arr, true);
				exit;
			}
		}
		add_action('wp_ajax_list_sidebarleft', 'entrada_list_sidebarleft');
		add_action('wp_ajax_nopriv_list_sidebarleft', 'entrada_list_sidebarleft');


		if (!function_exists('entrada_grid_sidebarleft')) {
			function entrada_grid_sidebarleft()
			{
				global $wpdb;
				$currency_symbol = get_woocommerce_currency_symbol();
				$response_arr = array();
				$tax_query = array();
				$meta_query = array();
				$html = '';
				$record_count = 0;
				$args = array(
					'post_type' 		=> 'product',
					'posts_per_page' 	=> $_POST['posts_per_page'],
					'paged' 			=> $_POST['paged'],
					'post_status' 		=> 'publish',
				);

				$args = entrada_sort_post_param($_POST['filter_by_order'], $args);

				$meta_query[] = array(
					'key' 		=> 'entrada_product_type',
					'value' 	=> 'tour',
					'compare' 	=> '='
				);

				if (isset($_POST['destination']) && $_POST['destination'] != '') {
					$destination = explode("%", $_POST['destination']);
					$tax_query[] = array(
						'taxonomy' 	=> 'destination',
						'field' 	=> 'slug',
						'terms' 	=> $destination
					);
				}

				if (isset($_POST['product_cat']) && $_POST['product_cat'] != '') {
					$product_cat = explode("%", $_POST['product_cat']);
					$tax_query[] = array(
						'taxonomy' 	=> 'product_cat',
						'field' 	=> 'slug',
						'terms' 	=> $product_cat
					);
				}

				if (isset($_POST['product_tag']) && $_POST['product_tag'] != '') {
					$product_tag = explode("%", $_POST['product_tag']);
					$tax_query[] = array(
						'taxonomy' 	=> 'product_tag',
						'field' 	=> 'slug',
						'terms' 	=> $product_tag
					);
				}

				if (isset($_POST['product_activity']) && $_POST['product_activity'] != '') {
					$product_activity = explode("%", $_POST['product_activity']);
					$tax_query[] = array(
						'taxonomy' 	=> 'activity_level',
						'field' 	=> 'slug',
						'terms' 	=> $product_activity
					);
				}
				if (isset($_POST['price_range']) && $_POST['price_range'] != '') {
					$price_range = str_replace($currency_symbol, '', $_POST['price_range']);
					$price_range_arr = explode(" - ", $price_range);
					$meta_query[] = array(
						'key' 		=> '_price',
						'value' 	=> $price_range_arr,
						'compare' 	=> 'BETWEEN',
						'type' 		=> 'NUMERIC'
					);
				}
				if (count($meta_query) > 0) {
					$args['meta_query'] = $meta_query;
				}
				if (count($tax_query) > 0) {
					$tax_query['relation'] = 'AND';
					$args['tax_query'] = $tax_query;
				}
				$loop = new WP_Query($args);

				if ($loop->have_posts()) {
					$record_count = $loop->found_posts;
					while ($loop->have_posts()) : $loop->the_post();
						$entrada_social_media_share_img = '';
						$share_txt = entrada_truncate(get_the_ID(), 30, 120, 'id');
						$html .= '<article class="col-md-6 col-lg-4 article thumb-full has-hover-s1">';
						$html .= '<div class="thumbnail" itemscope itemtype="http://schema.org/Product">';
						$entrada_social_media_share_img =  entrada_social_media_share_img(get_the_ID());
						$html .= entrada_product_resized_img(get_the_ID(), $resize = array(550, 358));
						$html .= '<h3 class="small-space"><a href="' . get_permalink($loop->ID) . '" itemprop="name">' . get_the_title() . '</a></h3>';
						$html .= '<span class="info">' . entrada_product_categories(get_the_ID(), false) . '</span>';
						$html .= '<aside class="meta">' . entrada_destinations_activities_count(get_the_ID(), false) . '</aside>';
						$html .= '<p itemprop="description">' . entrada_truncate(get_the_ID(), 30, 120, 'id') . '</p>';
						$html .= '<a href="' . get_permalink($loop->ID) . '" class="btn btn-default" itemprop="url">' . get_theme_mod('square_button_text', 'Explore') . '</a>';
						$html .= '<footer>';
						$html .= '<ul class="social-networks">' . entrada_social_media_share_btn(get_the_title($loop->ID), get_permalink($loop->ID), $share_txt, $entrada_social_media_share_img) . '</ul>';
						$html .= '<span class="price">' . entrada_price_from_txt(entrada_product_price(get_the_ID(), false)) . ' <span ' . entrada_price_schema_micro_data_link(get_the_ID()) . '>' . entrada_product_price(get_the_ID(), false) . '</span></span>';
						$html .= '</footer>';
						$html .= '</div>';
						$html .= '</article>';
					endwhile;
					wp_reset_postdata();
				} else {
					$html .= '';
				}
				$record_message = sprintf(esc_html(_n('%d Trip matches your search criteria', '%d Trips match your search criteria', $record_count, 'entrada')), $record_count);

				$response_arr['html_content'] = $html;
				$response_arr['record_count'] = $record_message;
				echo json_encode($response_arr, true);
				exit;
			}
		}
		add_action('wp_ajax_grid_sidebarleft', 'entrada_grid_sidebarleft');
		add_action('wp_ajax_nopriv_grid_sidebarleft', 'entrada_grid_sidebarleft');


		/* Pagination for shop */
		if (!function_exists('entrada_grid_shop_load_more')) {
			function entrada_grid_shop_load_more()
			{
				global $wpdb;

				$response_arr = array();
				$tax_query = array();
				$meta_query = array();
				$html = '';
				$record_count = 0;

				$args = array(
					'post_type' 		=> 'product',
					'posts_per_page' 	=> $_POST['posts_per_page'],
					'paged' 			=> $_POST['paged'],
					'post_status' 		=> 'publish',
				);

				if ('yes' == $_POST['vendor_page']) {
					$vendor_id = WCV_Vendors::get_vendor_id($_POST['vendor_name']);
					$user_role = '';
					$user_info = get_userdata($vendor_id);
					$user_role = implode(', ', $user_info->roles);
					if ('vendor' == $user_role) {
						$args['author'] = $vendor_id;
					}
				} else {
					$args = entrada_product_type_meta_query($args, 'shop_item');
				}
				$loop = new WP_Query($args);
				if ($loop->have_posts()) {
					$record_count = $loop->found_posts;
					while ($loop->have_posts()) : $loop->the_post();
						$entrada_social_media_share_img = '';
						$share_txt = entrada_truncate(get_the_ID(), 30, 120, 'id');
						$average_rating =  entrada_post_average_rating(get_the_ID());
						$html .= '<article class="col-sm-6 col-md-4 article has-hover-s1">';
						$html .= '<div class="thumbnail" itemscope itemtype="http://schema.org/Product">';
						$entrada_social_media_share_img =  entrada_social_media_share_img(get_the_ID());
						$html .= entrada_product_resized_img(get_the_ID(), $resize = array(550, 358));
						$html .= '<h3 class="small-space"><a href="' . get_permalink($loop->ID) . '" itemprop="name">' . get_the_title() . '</a></h3>';
						$html .= '<p itemprop="description">' . entrada_truncate(get_the_ID(), 30, 120, 'id') . '</p>';
						$html .= '<a href="' . get_permalink($loop->ID) . '" class="btn btn-default" itemprop="url">' . get_theme_mod('square_button_text', 'Explore') . '</a>';
						$html .= '<footer>';
						$html .= '<ul class="social-networks">' . entrada_social_media_share_btn(get_the_title($loop->ID), get_permalink($loop->ID), $share_txt, $entrada_social_media_share_img) . '</ul>';
						$html .= '<span class="price">' . entrada_price_from_txt(entrada_product_price(get_the_ID(), false)) . ' <span ' . entrada_price_schema_micro_data_link(get_the_ID()) . '>' . entrada_product_price(get_the_ID(), false) . '</span></span>';
						$html .= '</footer>';
						$html .= '</div>';
						$html .= '</article>';
					endwhile;
					wp_reset_postdata();
				} else {
					$html .= '';
				}
				$response_arr['html_content'] = $html;
				echo json_encode($response_arr, true);
				exit;
			}
		}
		add_action('wp_ajax_grid_shop_load_more', 'entrada_grid_shop_load_more');
		add_action('wp_ajax_nopriv_grid_shop_load_more', 'entrada_grid_shop_load_more');


		if (!function_exists('entrada_list_shop_load_more')) {
			function entrada_list_shop_load_more()
			{
				global $wpdb;
				$response_arr = array();
				$tax_query = array();
				$meta_query = array();
				$html = '';
				$record_count = 0;

				$args = array(
					'post_type' 		=> 'product',
					'posts_per_page' 	=> $_POST['posts_per_page'],
					'paged' 			=> $_POST['paged'],
					'post_status' 		=> 'publish',
				);

				if ('yes' == $_POST['vendor_page']) {
					$vendor_id = WCV_Vendors::get_vendor_id($_POST['vendor_name']);
					$user_role = '';
					$user_info = get_userdata($vendor_id);
					$user_role = implode(', ', $user_info->roles);
					if ('vendor' == $user_role) {
						$args['author'] = $vendor_id;
					}
				} else {
					$args = entrada_product_type_meta_query($args, 'shop_item');
				}
				$loop = new WP_Query($args);
				if ($loop->have_posts()) {
					$record_count = $loop->found_posts;
					while ($loop->have_posts()) : $loop->the_post();
						$average_rating =  entrada_post_average_rating(get_the_ID());
						$html .= '<article class="article has-hover-s1 ratingview">';
						$html .= '<div class="thumbnail" itemscope itemtype="http://schema.org/Product">';
						$entrada_social_media_share_img =  entrada_social_media_share_img(get_the_ID());
						$html .= entrada_product_resized_img(get_the_ID(), $resize = array(550, 358));
						$html .= '<div class="description">';
						$html .= '<div class="col-left">';
						$html .= '<header class="heading">';
						$html .= '<h3 class="small-space"><a href="' . get_permalink($loop->ID) . '" itemprop="name">' . get_the_title() . '</a></h3>';
						$html .= '<time class="info-day" datetime="2011-01-12">' . get_post_meta(get_the_ID(), "trip_duration", true) . '</time>';
						$html .= '</header>';
						$html .= '<p>' . entrada_truncate(get_the_ID(), 30, 120, 'id') . '</p>';
						$html .= '<div class="reviews-holder">';
						$html .= '<div class="star-rating"><input class="product_rating" type="hidden" value="' . $average_rating . '"><div class="product_rateYo"></div></div>';
						$html .= '<div class="info-rate">' . entrada_post_total_reviews(get_the_ID()) . '</div>';
						$html .= '</div>';
						$html .= '<footer class="info-footer">';
						$product_tag = wp_get_post_terms(get_the_ID(), 'product_tag');
						if (count($product_tag) > 0) {
							$html .=  '<ul class="ico-list">';
							foreach ($product_tag as $term) {
								$icomoon_class = entrada_icomoon_class($term->slug);
								if (!empty($icomoon_class)) {
									$html .=  '<li class="pop-opener"><span class="' . $icomoon_class . '"></span><div class="popup">' . ucwords($term->name) . '</div></li>';
								}
							}
							$html .=  '</ul>';
						}
						$html .= '<ul class="ico-action">';

						if (shortcode_exists('sharethis_nav')) {
							$html .= '<li>' .  do_shortcode('[sharethis_nav post_id="' . get_the_ID() . '"]') . '</li>';
						}

						$html .= '<li>' . entrada_wishlist_html(get_the_ID()) . '</li>';
						$html .= '</ul>';
						$html .= '</footer>';
						$html .= '</div>';
						$html .= '<aside class="info-aside">';
						$html .= '<span class="price">' . entrada_price_from_txt(entrada_product_price(get_the_ID(), false)) . ' <span ' . entrada_price_schema_micro_data_link(get_the_ID()) . '>' . entrada_product_price(get_the_ID(), false) . '</span></span>';

						$html .= '<a href="' . get_permalink(get_the_ID()) . '" class="btn btn-default" itemprop="url">' . get_theme_mod('square_button_text', 'Explore') . '</a>';
						$html .= '</aside>';
						$html .= '</div>';
						$html .= '</div>';
						$html .= '</article>';
					endwhile;
					wp_reset_postdata();
				} else {
					$html .= '';
				}
				$response_arr['html_content'] = $html;
				echo json_encode($response_arr, true);
				exit;
			}
		}
		add_action('wp_ajax_list_shop_load_more', 'entrada_list_shop_load_more');
		add_action('wp_ajax_nopriv_list_shop_load_more', 'entrada_list_shop_load_more');


		/* Add metaquery for WC entrada product type */
		if (!function_exists('entrada_product_type_meta_query')) {
			function entrada_product_type_meta_query($args, $entrada_product_type = 'tour')
			{
				$meta_query = array();

				$meta_query[] = array(
					'key' 		=> 'entrada_product_type',
					'value' 	=> $entrada_product_type,
					'compare' 	=> '='
				);

				if (count($meta_query) > 0) {
					$args['meta_query'] = $meta_query;
				}
				return $args;
			}
		}


		/* Add Date Range query for search page */
		if (!function_exists('entrada_date_range_meta_query')) {
			function entrada_date_range_meta_query($start_date = '', $end_date = '')
			{
				$date_meta_query = array();
				$child_posts = array();

				if (empty($start_date)) {
					$start_date = date('Y-m-d');
				}

				if (empty($end_date)) {
					$end_date = date('d-m-Y', strtotime('+10 years'));
				}

				$args_variable_post = array(
					'post_type' => 'product_variation',
					'showposts' => -1,
				);

				$date_meta_query[] 	= array(
					'key' 		=> 'var_confirmed_date',
					'value' 	=> array(date('Y-m-d', strtotime($start_date)), date('Y-m-d', strtotime($end_date))),
					'compare' 	=> 'BETWEEN',
					'type' 		=> 'DATE'
				);

				if (count($date_meta_query) > 0) {
					$args_variable_post['meta_query'] = $date_meta_query;
				}

				$loop_variable_post = new WP_Query($args_variable_post);
				if ($loop_variable_post->have_posts()) {
					while ($loop_variable_post->have_posts()) : $loop_variable_post->the_post();

						$child_posts[] = wp_get_post_parent_id(get_the_ID());

					endwhile;
				}

				return $child_posts;
			}
		}
		add_action('wp_ajax_entrada_add_itinerary', 'entrada_add_itinerary');
		add_action('wp_ajax_nopriv_entrada_add_itinerary', 'entrada_add_itinerary');

		if (!function_exists('entrada_add_itinerary')) {
			function entrada_add_itinerary()
			{

				$itinerary_settings = array(
					'quicktags' 	=> array('buttons' => 'em,strong,link'),
					'quicktags' 	=> true,
					'tinymce' 		=> true,
					'textarea_rows'	=> 10,
					'textarea_name' => 'itinerary_desc[]'
				);

				echo '<div class="itinerary_wrap">
					<div class="itinerary_row">
						<div class="itinerary_col"> <label>' . __('Label', 'entrada') . '</label> <input type="text" name="itinerary_txt[]" value="">
						</div>
						<div class="itinerary_col"><label>' . __('Title', 'entrada') . '</label><input type="text" name="itinerary_title[]" value="">
						</div>
					</div>';

				echo '<div class="itinerary_row">
						<label>' . __('Description', 'entrada') . '</label>
						<div class="itinerary-editor">';

				wp_editor($_POST['default_text'], $_POST['itinerary_id'], $itinerary_settings);

				echo '</div>
			</div>';
				echo '<div class="itinerary_row">
						<a href="javascript:void(null);" class="button button-small remove_itinery"> ' . __('Remove', 'entrada') . '</a>

					</div>';
				echo '</div>';
				exit;
			}
		}

		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
		add_action('woocommerce_single_product_summary', 'entrada_wc_single_title', 5);

		if (!function_exists('entrada_wc_single_title')) {
			function entrada_wc_single_title()
			{
				echo '<h1 itemprop="name" class="small-size">' . get_the_title() . '</h1>';
			}
		}

		if (!function_exists('wc_dropdown_variation_attribute_options')) {

			function wc_dropdown_variation_attribute_options($args = array())
			{
				$args = wp_parse_args(apply_filters('woocommerce_dropdown_variation_attribute_options_args', $args), array(
					'options'          => false,
					'attribute'        => false,
					'product'          => false,
					'selected' 	       => false,
					'name'             => '',
					'id'               => '',
					'class'            => 'variation-prod-select',
					'show_option_none' => __('Choose an option', 'entrada')
				));

				$options               = $args['options'];
				$product               = $args['product'];
				$attribute             = $args['attribute'];
				$name                  = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title($attribute);
				$id                    = $args['id'] ? $args['id'] : sanitize_title($attribute);
				$class                 = $args['class'];
				$show_option_none      = $args['show_option_none'] ? true : false;
				$show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __('Choose an option',  'entrada'); // We'll do our best to hide the placeholder, but we'll need to show something when resetting options.

				if (empty($options) && !empty($product) && !empty($attribute)) {
					$attributes = $product->get_variation_attributes();
					$options    = $attributes[$attribute];
				}

				$html = '<select id="' . esc_attr($id) . '" class="' . esc_attr($class) . '" name="' . esc_attr($name) . '" data-attribute_name="attribute_' . esc_attr(sanitize_title($attribute)) . '"' . '" data-show_option_none="' . ($show_option_none ? 'yes' : 'no') . '">';
				$html .= '<option value="">' . esc_html($show_option_none_text) . '</option>';

				if (!empty($options)) {
					if ($product && taxonomy_exists($attribute)) {
						// Get terms if this is a taxonomy - ordered. We need the names too.
						$terms = wc_get_product_terms($product->get_id(), $attribute, array('fields' => 'all'));

						foreach ($terms as $term) {
							if (in_array($term->slug, $options)) {
								$html .= '<option value="' . esc_attr($term->slug) . '" ' . selected(sanitize_title($args['selected']), $term->slug, false) . '>' . esc_html(apply_filters('woocommerce_variation_option_name', $term->name)) . '</option>';
							}
						}
					} else {
						foreach ($options as $option) {
							// This handles < 2.4.0 bw compatibility where text attributes were not sanitized.
							$selected = sanitize_title($args['selected']) === $args['selected'] ? selected($args['selected'], sanitize_title($option), false) : selected($args['selected'], $option, false);
							$html .= '<option value="' . esc_attr($option) . '" ' . $selected . '>' . esc_html(apply_filters('woocommerce_variation_option_name', $option)) . '</option>';
						}
					}
				}

				$html .= '</select>';

				echo apply_filters('woocommerce_dropdown_variation_attribute_options_html', $html, $args);
			}
		}

		/* Entrada catalog-visibility-options
************************************************************** */
		if (!function_exists('entrada_wc_cvo_price')) {
			function entrada_wc_cvo_price($price)
			{
				if (class_exists('WC_Catalog_Visibility_Options')) {
					$cvo_price = '';
					$wc_cvo_prices = get_option('wc_cvo_prices');
					$wc_cvo_c_price_text = get_option('wc_cvo_c_price_text');
					switch ($wc_cvo_prices) {
						case 'secured':
							if (is_user_logged_in()) {
								return $price;
							} else {
								$cvo_price = entrada_catalog_price_text($price);
							}
							break;

						case 'disabled':
							$cvo_price = entrada_catalog_price_text();
							break;

						default:
							return $price;
					}
					return $cvo_price;
				} else {
					return $price;
				}
			}
		}
		/* Entrada Catalog Price Text
--------------------------------------------------------- */
		if (!function_exists('entrada_catalog_price_text')) {
			function entrada_catalog_price_text($entrada_cpt = '')
			{
				$wc_cvo_c_price_text = get_option('wc_cvo_c_price_text');
				if (isset($wc_cvo_c_price_text) && !empty($wc_cvo_c_price_text)) {
					return $wc_cvo_c_price_text;
				} else {
					return $entrada_cpt;
				}
			}
		}

		/* Entrada From Text
--------------------------------------------------------- */
		if (!function_exists('entrada_price_from_txt')) {
			function entrada_price_from_txt($price = false)
			{
				if (strpos($price, '<del></del>') !== false) {
					return '';
				}
				if (isset($price) && !empty($price)) {
					return __('from',  'entrada');
				} else {
					return '';
				}
			}
		}

		/* Entrada From Text
--------------------------------------------------------- */
		if (!function_exists('entrada_showhide_purchases_options')) {
			function entrada_showhide_purchases_options()
			{
				$purchases_option = true;
				if (class_exists('WC_Catalog_Visibility_Options')) {
					$wc_cvo_atc = get_option('wc_cvo_atc');
					switch ($wc_cvo_atc) {

						case 'secured':
							if (is_user_logged_in()) {
								$purchases_option = true;
							} else {
								$purchases_option = false;
							}
							break;

						case 'disabled':
							$purchases_option = false;
							break;

						default:
							$purchases_option = true;
					}
				}
				return $purchases_option;
			}
		}

		/*function entrada_woocommerce_cart_item_subtotal( $wc, $cart_item, $cart_item_key ) {
	$price 					= '';
	$variation_id 			= $cart_item['variation_id'];
	$quantity 				= $cart_item['quantity'];
	$var_price_inc_flight 	= get_post_meta( $variation_id, 'var_price_inc_flight', true );
	if( !empty( $var_price_inc_flight ) ) {
		$string 			= wc_price( $var_price_inc_flight );
		$tour_with_flight 	= get_post_meta( $variation_id, 'tour_with_flight', true );
		$price 				= ( $tour_with_flight ) ? $var_price_inc_flight : '';
	}
	if( ! empty( $price ) ) {
		$actual_price 	= (float) $price * (int) $quantity;
		$wc 			= wc_price( $actual_price );
	}
    return $wc;
};
add_filter( 'woocommerce_cart_item_subtotal', 'entrada_woocommerce_cart_item_subtotal', 10, 3 ); */


		/* Add features for bookable Products/tours on single page
....................................... */
		if (!function_exists('entrada_bookable_product_features')) {
			function entrada_bookable_product_features()
			{
				$pid = get_the_ID();
				$_p = wc_get_product($pid);
				if ($_p->is_type('booking')) {


					$average_rating =  entrada_post_average_rating($pid);
					?>
								<style>
									/* .woocommerce-product-rating {
										display: none;
									} */
								</style>
								<ul class="reviews-info">
									<li itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
										<div class="info-left">
											<strong class="title"><?php _e('Reviews',  'entrada'); ?></strong>
											<span class="value" itemprop="reviewCount"><?php $total_reviews = entrada_post_total_reviews($pid, true);
																									printf(esc_html(_n('%d Review', '%d Reviews', $total_reviews, 'entrada')), $total_reviews); ?></span>
										</div>
										<div class="info-right">
											<div class="star-rating">
												<div class="average_rateYo"></div>
											</div>
											<span class="value" itemprop="ratingValue"><?php echo sprintf(__('%1$d/%2$d', 'entrada'), $average_rating, '5'); ?></span>
										</div>
									</li>
									<li>
										<div class="info-left">
											<strong class="title"><?php _e('Vacation Style',  'entrada'); ?></strong>
											<span class="value"><?php _e('Holiday Type',  'entrada'); ?></span>
										</div>
										<div class="info-right">
											<?php
														/* Product Tag..... */
														$product_tag = wp_get_post_terms($pid, 'product_tag');
														if (count($product_tag) > 0) {
															echo '<ul class="ico-list">';
															foreach ($product_tag as $term) {
																$icomoon_class = entrada_icomoon_class($term->slug);
																if (!empty($icomoon_class)) {
																	echo '<li class="pop-opener top">
											<span class="' . $icomoon_class . '"></span>
											<div class="popup">' . ucwords($term->name) . '</div>
											</li>';
																}
															}
															echo '</ul>';
														} ?>
											<span class="value"><?php echo entrada_product_holiday_types($pid, false); ?></span>
										</div>
									</li>
									<li>
										<div class="info-left">
											<strong class="title"><?php _e('Activity Level',  'entrada'); ?></strong>
											<span class="value"><?php echo entrada_product_activity_level($pid, 'title', false); ?></span>
										</div>
										<?php
													$activity_level = entrada_product_activity_level($pid, 'level', false);
													if (!empty($activity_level)) { ?>
											<div class="info-right">
												<ul class="ico-list">
													<li><span class="icon-level<?php entrada_product_activity_level($pid, 'level', true); ?>"></span></li>
												</ul>
												<span class="value"><?php echo sprintf(__('%1$d/%2$d', 'entrada'), $activity_level, '8'); ?></span>
											</div>
										<?php } ?>
									</li>
									<li>
										<?php
													$trip_group_size = get_post_meta($pid, "trip_group_size", true);
													$trip_group_size_capacity = get_post_meta($pid, "trip_group_size_capacity", true);
													if (!empty($trip_group_size)) {
														if ('Small Group' == $trip_group_size) {
															$group_name = __('Small Group',  'entrada');
														} else if ('Medium Group' == $trip_group_size) {
															$group_name = __('Medium Group',  'entrada');
														} else if ('Large Group' == $trip_group_size) {
															$group_name = __('Large Group',  'entrada');
														} ?>
											<div class="info-left">
												<strong class="title"><?php _e('Group Size',  'entrada'); ?></strong>
												<span class="value"><?php echo esc_html($group_name); ?></span>
											</div>
										<?php } ?>
										<div class="info-right">
											<?php
														$group_size_icon = entrada_product_group_size_icon($pid);
														if (!empty($group_size_icon)) {
															echo '<ul class="ico-list"><li>' . $group_size_icon . '</li></ul>';
														} ?>
											<?php
														if (!empty($trip_group_size_capacity)) {
															echo '<span class="value">' . $trip_group_size_capacity . '</span>';
														} ?>
										</div>
									</li>
								</ul>
							<?php
									}
								}
							}

							add_action('woocommerce_before_add_to_cart_form', 'entrada_bookable_product_features', 10, 2);

							/* Add features for bookable Products/tours on single page
....................................... */
							if (!function_exists('entrada_add_social_share_for_booking_product')) {
								function entrada_add_social_share_for_booking_product()
								{

									if (is_single() && is_singular('product')) {
										$social_media__share_image_url = '';
										$social_media__share_url 	 = get_permalink();
										$social_media__share_title 	 = get_the_title();
										$social_media__share_content = entrada_truncate(get_the_ID(), 40, 180, 'id');
										$social_media__share_content = str_replace("'s", "`s", $social_media__share_content);

										if (has_post_thumbnail(get_the_ID())) :
											$thumb_id = get_post_thumbnail_id(get_the_ID());
											$featured_img = wp_get_attachment_image_src($thumb_id, 'single-post-thumbnail');
											$thumb = wp_get_attachment_image_src($thumb_id, 'medium');

											$gallery_image_urls[$thumb_id] = $featured_img[0];
											$social_media__share_image_url = $thumb[0];
										endif;

										?>
								<ul class="social-networks social-share">
									<li>
										<a href="javascript:void(0);" onclick="fb_callout('<?php echo esc_js($social_media__share_url); ?>', '<?php echo esc_js($social_media__share_image_url); ?>', '<?php echo esc_js($social_media__share_title); ?>', '<?php echo sprintf(__('%s', 'entrada'), $social_media__share_content); ?>');" class="facebook">
											<span class="ico">
												<span class="icon-facebook"></span>
											</span>
											<span class="text"><?php _e('Share',  'entrada'); ?></span>
										</a>
									</li>
									<li>
										<a href="javascript:void(0);" onClick="share_on_twitter('<?php echo esc_url($social_media__share_url); ?>', '<?php echo esc_js($social_media__share_title); ?>');" class="twitter">
											<span class="ico">
												<span class="icon-twitter"></span>
											</span>
											<span class="text"><?php _e('Tweet',  'entrada'); ?></span>
										</a>
									</li>
								</ul>
					<?php
							}
						}
					}

					add_action('woocommerce_after_add_to_cart_button', 'entrada_add_social_share_for_booking_product');

					?>