<?php include('../../../../../wp-load.php');
header('Content-type: text/xml');
header('Content-Disposition: attachment; filename="gallery-data.xml"');
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



$result = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "postmeta WHERE meta_key ='itinerary_gallery_img' OR meta_key ='product_gallery_img' order by meta_key, post_id ASC");

$data = array();
$i = 0;
if ($result) {

	$xml_output = "<?xml version=\"1.0\"?>\n";
	$xml_output .= "<galleries>\n";

	foreach ($result as $entry) {

		$meta_key = $entry->meta_key;
		$post_id = $entry->post_id;

		if ($meta_key == 'itinerary_gallery_img') {

			$meta_arr = get_post_meta($post_id, 'itinerary_gallery_img');
		} else if ($meta_key == 'product_gallery_img') {

			$meta_arr = get_post_meta($post_id, 'product_gallery_img');
		} else {

			$meta_arr[0] = array();
		}

		if (count($meta_arr[0]) > 0) {

			$data[$i]['meta_key'] = $meta_key;
			$entrada_post_meta = get_post($post_id);
			$data[$i]['post_slug'] = $entrada_post_meta->post_name;

			$attach_urls = array();
			if (isset($meta_arr[0]) && (count($meta_arr[0]) > 0)) {
				foreach ($meta_arr[0] as $attach_id) {
					$attach_url = wp_get_attachment_url($attach_id);
					if (!empty($attach_url)) {
						$attach_urls[] = $attach_url;
					}
				}
				$data[$i]['attach_url'] = implode(',', $attach_urls);
			}
		}

		$i++;
	}

	if (count($data) > 0) {
		foreach ($data as $d) {
			$xml_output .= "\t<item>\n";
			$xml_output .= "\t\t<attach_url>" . $d['attach_url'] . "</attach_url>\n";
			$xml_output .= "\t\t<meta_key>" . $d['meta_key'] . "</meta_key>\n";
			$xml_output .= "\t\t<post_slug>" . $d['post_slug'] . "</post_slug>\n";
			$xml_output .= "\t\t<domain_url>" . esc_url(home_url('')) . "</domain_url>\n";
			$xml_output .= "\t</item>\n";
		}
	}

	$xml_output .= "</galleries>\n";


	echo sprintf(__('%s', 'entrada'), $xml_output);
}
