<?php include('../../../../../wp-load.php');
header('Content-type: text/xml');
header('Content-Disposition: attachment; filename="taxonomy-data.xml"');
global $wpdb;

function check_slug($taxonomy_id, $taxonomy)
{
	global $wpdb;
	$data = '';
	$term = get_term($taxonomy_id, $taxonomy);
	if (count($term) > 0) {
		$data = $term->slug . '==' . $taxonomy;
	}
	return $data;
}

$result = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "options WHERE option_name LIKE 'taxonomy_%' order by option_id ASC ");


if ($result) {

	$xml_output = "<?xml version=\"1.0\"?>\n";
	$xml_output .= "<categories>\n";

	foreach ($result as $entry) {
		$slug = '';

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

		$taxonomy_id = str_replace('taxonomy_', '', $entry->option_name);

		if (!empty($taxonomy_id)) {
			$slug = '';
			$slug = check_slug($taxonomy_id, 'product_cat');
			if ($slug == '') {
				$slug = check_slug($taxonomy_id, 'destination');
			}
			if ($slug == '') {
				$slug = check_slug($taxonomy_id, 'activity_level');
			}

			$option_value = get_option($entry->option_name);
			//print_r ( $option_value );
			//$option_value = str_replace('&', ' and ', $option_value);
			$data = $option_value;
			$slug = str_replace('&', ' and ', $slug);

			$upload_dir = wp_upload_dir();
			// Featured image for category
			$image_src = '';
			$thumbnail_id = get_term_meta($taxonomy_id, 'thumbnail_id', true);
			$cat_image_src = wp_get_attachment_url($thumbnail_id);
			if (!empty($cat_image_src)) {
				$image_src =  str_replace($upload_dir['baseurl'], '', $cat_image_src);
			}

			if (count($data) > 0) {
				foreach ((array) $data as $key => $key_value) {

					if (array_key_exists($key, $array_data)) {

						$val = str_replace('&', ' and ', $key_value);
						if ($key == 'product_cat_banner_img_id' || $key == 'product_cat_map_img_id') {
							$val = wp_get_attachment_url($key_value);
							$val =  str_replace($upload_dir['baseurl'], '', $val);
						}

						$array_data[$key] = $val;
					}
				}
			}

			if (!empty($slug)) {
				$xml_output .= "\t<item>\n";
				$xml_output .= "\t\t<cat_slug>" . $slug . "</cat_slug>\n";
				$xml_output .= "\t\t<cat_data>" . serialize($array_data) . "</cat_data>\n";
				$xml_output .= "\t\t<cat_url>" . esc_url(home_url('')) . "</cat_url>\n";
				$xml_output .= "\t\t<cat_img>" . $image_src . "</cat_img>\n";
				$xml_output .= "\t</item>\n";
			}
		}
	}
	$xml_output .= "</categories>\n";

	echo sprintf(__('%s', 'entrada'), $xml_output);
}
