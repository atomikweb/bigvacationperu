<?php

global $wpdb;
$msg = '';
if (isset($_POST['import_taxonomy']) && $_POST['import_taxonomy'] != '') {
    if (!function_exists('wp_handle_upload')) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
    }
    $uploadedfile = $_FILES['taxonomy_file'];



    $upload_overrides = array('test_form' => false);

    $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

    if ($movefile && !isset($movefile['error'])) {

        $msg =  __('Custom taxonomy data has been successfully imported.', 'eaddons');
        $file_path = $movefile['file'];
        $file_url = $movefile['url'];
        /* Update taxonomy ........... */
        $upload_dir = wp_upload_dir();
        if (file_exists($file_path)) {
            $xml = simplexml_load_file($file_path);
            $cnt = 0;
            foreach ($xml->item as $item) {
                $cnt++;
                if ($cnt == 1) {
                    $old_url = $item->cat_url;
                    $new_url = esc_url(home_url(''));
                    $this->eaddons_update_guid($old_url, $new_url);
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
                        foreach ((array) $cat_data as $key => $key_value) {
                            if (array_key_exists($key, $array_data)) {
                                $val = $key_value;
                                if (!empty($key_value) && ($key == 'product_cat_banner_img_id' || $key == 'product_cat_map_img_id')) {


                                    $image_url = $upload_dir['baseurl'] . $key_value;

                                    $attachment_id = $this->eaddons_attachment_id_from_src($image_url);
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
                        $attach_id = $this->eaddons_attachment_id_from_src($featured_img_src);
                        if (!empty($attach_id)) {
                            update_woocommerce_term_meta($term->term_id, 'thumbnail_id', $attach_id, true);
                        }
                    }
                }
            }
        }
    } else {
        /**
         * Error generated by _wp_handle_upload()
         * @see _wp_handle_upload() in wp-admin/includes/file.php
         */
        $msg =  $movefile['error'];
    }
}

echo '<div id="wrap"><div class="wrap"><h2><img src="' . plugin_dir_url(dirname(__FILE__))  . 'assets/img/addons.png"> ' . __("Addons", "entrada") . '</h2></div>';
echo '<div class="wrap">';
if (!empty($msg)) {
    echo '<p class="update-nag notice">' . $msg . '</p>';
} ?>
<table width="100%" class="widefat fixed comments" style="padding-bottom:20px;">
    <tr>
        <td>
            <h3> <?php _e('Export Taxonomy Data',  'eaddons'); ?></h3>
        </td>
    </tr>
    <tr>
        <td><?php echo '<a href="' . get_template_directory_uri()  . '/admin/feed/taxonomy-data.php" target="_blank" class="button-primary">' . __("Export Taxonomy Data", "entrada") . '</a>'; ?></td>
    </tr>
</table>
<table width="100%" class="widefat fixed comments" style="padding-bottom:20px;">
    <tr>
        <td>
            <h3><?php _e('Import Taxonomy Data',  'eaddons'); ?></h3>
        </td>
    </tr>
    <tr>
        <td>
            <form action="" method="post" enctype="multipart/form-data">
                <?php _e('Upload XML Files',  'eaddons'); ?> <input type="file" name="taxonomy_file">
                <input type="submit" value="<?php esc_attr_e('Import Taxonomy Data',  'eaddons'); ?>" name="import_taxonomy" class="button-primary">
            </form>
        </td>
    </tr>
</table>
<?php
echo '</div></div>';
