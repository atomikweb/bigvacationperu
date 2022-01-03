<?php
/* Entrada Post Gallery Images
.................................... */
add_action('admin_init', 'ecpt_add_post_gallery');
add_action('save_post', 'ecpt_update_post_gallery', 10, 2);
/**
 * Add custom Meta Box to Posts post type
 */
function ecpt_add_post_gallery()
{
    add_meta_box(
        'post_gallery',
        __('Post Gallery Images', 'ecpt_addons'),
        'ecpt_post_gallery_options',
        'post',
        'normal',
        'core'
    );
}
/**
 * Print the Meta Box content
 */
function ecpt_post_gallery_options()
{
    global $post;
    $entrada_img_gal_arr = array();
    $entrada_img_gal = get_post_meta($post->ID, 'entrada_img_gal', true);
    if (isset($entrada_img_gal) && !empty($entrada_img_gal)) {
        $entrada_img_gal_arr = $entrada_img_gal;
    }

    /* Use nonce for verification */
    wp_nonce_field(basename(__FILE__), "noncename_ecpt_gallery"); ?>
    <div id="dynamic_form">
        <ul class="post-gallery-list entrada_thumb" id="entrada_image_galleries">
            <?php

                if (count($entrada_img_gal_arr) > 0) {
                    $cnt = 0;
                    foreach ($entrada_img_gal_arr as $attach_id) {
                        $cnt++;

                        $entrada_img_gal = wp_get_attachment_url($attach_id);
                        $image = matthewruddy_image_resize($entrada_img_gal, 150, 150, true, false);

                        if (array_key_exists('url', $image) && $image['url'] != '') {
                            echo '<li><div class="holder"><input type="hidden" name="entrada_img_gal[]" value="' . $attach_id . '"> <img src="' . $image['url'] . '"> <a class="delete" href="javascript:void(null);"><img src="' . plugin_dir_url(dirname(__FILE__)) . 'img/delete.png"></a></div></li>';
                        }
                    }
                } ?>
        </ul>
        <div id="add_field_row">
            <input class="button" type="button" id="add_post_gallery_images" value="<?php _e('Add post gallery images',  '_waituk_theme_text_domain'); ?>" />
        </div>
    </div>
<?php
}
/**
 * Save post action, process fields
 */
function ecpt_update_post_gallery($post_id, $post_object)
{
    /* Doing revision, exit earlier **can be removed** */
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    /* Doing revision, exit earlier */
    if ('revision' == $post_object->post_type) {
        return;
    }
    /* Verify authenticity */
    if (!isset($_POST["noncename_ecpt_gallery"]) || !wp_verify_nonce($_POST["noncename_ecpt_gallery"], basename(__FILE__))) {
        return;
    }
    /* Correct post type */
    if ('post' != $_POST['post_type']) { /* here you can set post type name */
        return;
    }
    if (isset($_POST['entrada_img_gal']) && count($_POST['entrada_img_gal']) > 0) {
        update_post_meta($post_id, "entrada_img_gal",  $_POST['entrada_img_gal']);
    } else {
        delete_post_meta($post_id, "entrada_img_gal", '');
    }
} ?>