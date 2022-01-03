<?php
/* :::::::::::::::::::  Entrada custom Post Meta  ::::::::::::::::  */
add_action('add_meta_boxes', 'ecpt_add_custom_banner_box');
add_action('save_post', 'ecpt_save_page_banner_postmeta');
function ecpt_add_custom_banner_box()
{
    add_meta_box('entrada_page_banner_id', 'Banner Section', 'ecpt_custom_page_banner_box', 'page', 'normal', 'high');
}
function ecpt_custom_page_banner_box($post)
{
    global $wpdb;
    $post_id = $post->ID;
    wp_nonce_field(basename(__FILE__), "entrada_banner_box");
    $banner_heading = get_post_meta($post_id, 'banner_heading', true);
    $banner_sub_heading = get_post_meta($post_id, 'banner_sub_heading', true);
    $banner_image_id = get_post_meta($post_id, 'banner_image_id', true);
    $banner_type = get_post_meta($post_id, 'banner_type', true);
    $show_search_bar = get_post_meta($post_id, 'show_search_bar', true);
    $banner_img_src = '';

    $default_img = plugin_dir_url(dirname(__FILE__)) . 'img/placeholder.png';

    if (isset($banner_image_id) && $banner_image_id != '') {
        $banner_img_src = wp_get_attachment_url($banner_image_id);
    } ?>
    <div style="width:100%;">
        <table cellpadding="0" cellspacing="6" border="0" width="100%">
            <tr>
                <td width="34%"><strong> <?php _e('Inner Banner :', '_waituk_theme_text_domain'); ?><input type="hidden" id="banner_type" name="banner_type" value="<?php echo ($banner_type) ? esc_attr($banner_type) : ''; ?>" />
                    </strong></td>
                <td width="33%"> <input type="radio" class="banner_option" <?php if (isset($banner_type) && $banner_type == 'image') {
                                                                                    echo 'checked="checked"';
                                                                                } ?> name="banner_option" value="image"> <strong> <?php _e('Background :', '_waituk_theme_text_domain'); ?> </strong></td>
                <td width="33%"> <input type="radio" <?php if (empty($banner_type) || $banner_type == 'color') {
                                                                echo 'checked="checked"';
                                                            } ?> class="banner_option" name="banner_option" value="color"> <strong> <?php _e('No Background :', '_waituk_theme_text_domain'); ?> </strong></td>
            </tr>
        </table>
        <div class="entrada-banner-wrap">
            <table cellpadding="0" cellspacing="6" border="0" width="100%">
                <tr>
                    <td width="30%"><strong> <?php _e('Heading :', '_waituk_theme_text_domain'); ?></strong></td>
                    <td width="70%" align="left">
                        <input style="width:90%;" type="text" name="banner_heading" id="banner_heading" value="<?php esc_attr_e($banner_heading); ?>">
                    </td>
                </tr>
                <tr>
                    <td width="30%"><strong> <?php _e('Sub Heading :', '_waituk_theme_text_domain'); ?></strong></td>
                    <td width="70%" align="left">
                        <input style="width:90%;" type="text" name="banner_sub_heading" id="banner_sub_heading" value="<?php esc_attr_e($banner_sub_heading); ?>">
                    </td>
                </tr>
                <tr>
                    <td width="30%"><strong> <?php _e('Banner Image :', '_waituk_theme_text_domain'); ?></strong></td>
                    <td width="70%" align="left">
                        <div id="banner_img" style="float: left; margin-right: 10px;"><img src="<?php echo esc_attr($banner_img_src) ? esc_attr($banner_img_src) : $default_img; ?>" width="60px" height="60px" /></div>
                        <div style="line-height: 60px;">
                            <input type="hidden" id="banner_image_id" name="banner_image_id" value="<?php echo ($banner_image_id)  ? esc_attr($banner_image_id) : ''; ?>" />
                            <button type="button" class="upload_banner_img_button button"><?php _e('Upload/Add Image', '_waituk_theme_text_domain'); ?></button>
                            <button type="button" class="remove_banner_img_button button" style="display:<?php echo esc_attr($banner_img_src) ? 'inline-block' : 'none'; ?>"><?php _e('Remove Image', '_waituk_theme_text_domain'); ?></button>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <script type="text/javascript">
            // Only show the "remove image" button when needed
            if (!jQuery('#banner_type').val() || jQuery('#banner_type').val() == 'color') {
                jQuery('.entrada-banner-wrap').hide();
            }
            jQuery('.banner_option').click(function() {
                var banner_option = jQuery(this).val();
                jQuery('#banner_type').val(banner_option);
                if (banner_option == 'image') {
                    jQuery('.entrada-banner-wrap').show(500);
                } else {
                    jQuery('.entrada-banner-wrap').hide(500);
                }
            });
            if (!jQuery('#banner_image_id').val()) {
                jQuery('.remove_banner_img_button').hide();
            }
            // Uploading files
            var map_file_frame;
            jQuery(document).on('click', '.upload_banner_img_button', function(event) {
                event.preventDefault();
                // If the media frame already exists, reopen it.
                if (map_file_frame) {
                    map_file_frame.open();
                    return;
                }
                // Create the media frame.
                map_file_frame = wp.media.frames.downloadable_file = wp.media({
                    title: 'Choose an image',
                    button: {
                        text: 'Use image'
                    },
                    multiple: false
                });
                // When an image is selected, run a callback.
                map_file_frame.on('select', function() {
                    var attachment = map_file_frame.state().get('selection').first().toJSON();
                    jQuery('#banner_image_id').val(attachment.id);
                    jQuery('#banner_img').find('img').attr('src', attachment.sizes.thumbnail.url);
                    jQuery('.remove_banner_img_button').show();
                });
                // Finally, open the modal.
                map_file_frame.open();
            });
            jQuery(document).on('click', '.remove_banner_img_button', function() {
                jQuery('#banner_img').find('img').attr('src', '<?php echo $default_img; ?>');
                jQuery('#banner_image_id').val('');
                jQuery('.remove_banner_img_button').hide();
                return false;
            });
        </script>
    </div>
<?php
    global $post;
    $post->ID = $post_id;
}
function ecpt_save_page_banner_postmeta($post_id)
{
    global $wpdb;
    $exists = 0;
    if ($the_post = wp_is_post_revision($post_id)) {
        $post_id = $the_post;
    }
    /* checking verification */
    if (!isset($_POST["entrada_banner_box"]) || !wp_verify_nonce($_POST["entrada_banner_box"], basename(__FILE__))) {
        return $post_id;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    if ($_POST['post_type'] != 'page') {
        return $post_id;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    if (isset($_POST["banner_heading"])) {
        update_post_meta($post_id, "banner_heading", $_POST["banner_heading"]);
    } else {
        delete_post_meta($post_id, "banner_heading", '');
    }

    if (isset($_POST["banner_sub_heading"])) {
        update_post_meta($post_id, "banner_sub_heading", $_POST["banner_sub_heading"]);
    } else {
        delete_post_meta($post_id, "banner_sub_heading", '');
    }

    if (isset($_POST["banner_image_id"])) {
        update_post_meta($post_id, "banner_image_id", $_POST["banner_image_id"]);
    } else {
        delete_post_meta($post_id, "banner_image_id", '');
    }

    if (isset($_POST["banner_type"])) {
        update_post_meta($post_id, "banner_type", $_POST["banner_type"]);
    } else {
        delete_post_meta($post_id, "banner_type", '');
    }
}
/* List View Detail Page Content ............ */
add_action('add_meta_boxes', 'ecpt_add_custom_listview_cms_box');
add_action('save_post', 'ecpt_save_page_listview_cms_postmeta');
function ecpt_add_custom_listview_cms_box()
{
    add_meta_box('entrada_page_listview_cms_id', 'List View Page Content', 'ecpt_custom_page_listview_cms_box', 'page', 'normal', 'high');
}
function ecpt_custom_page_listview_cms_box($post)
{
    global $wpdb;
    $post_id = $post->ID;
    /*Add verification field*/
    wp_nonce_field(basename(__FILE__), "entrada_listview_box");
    /*Add verification field ends*/
    $best_season = get_post_meta($post_id, 'best_season', true);
    $popular_location = get_post_meta($post_id, 'popular_location', true);
    $map_image = get_post_meta($post_id, 'map_image', true); ?>
    <style>
        .entrada_metabox_desc {
            font-size: 11px;
            color: #dedede;
        }
    </style>
    <div style="width:100%;">
        <table cellpadding="0" cellspacing="6" border="0" width="100%">
            <tr>
                <td width="30%"><strong> <?php _e('Best Season :', '_waituk_theme_text_domain'); ?></strong></td>
                <td width="70%" align="left">
                    <input style="width:100%;" type="text" name="best_season" id="best_season" value="<?php esc_attr_e($best_season); ?>">
                    <span class="entrada_metabox_desc"> Example : Jan-Feb, Mar-Jun, Oct-Dec </span>
                </td>
            </tr>
            <tr>
                <td width="30%"><strong> <?php _e('Popular Location :', '_waituk_theme_text_domain'); ?></strong></td>
                <td width="70%" align="left">
                    <input style="width:100%;" type="text" name="popular_location" id="popular_location" value="<?php esc_attr_e($popular_location); ?>"> <span class="entrada_metabox_desc"> Example : Phuket, Bangkok, Ching Mai </span>
                </td>
            </tr>

            <tr>
                <td width="30%"><strong> <?php _e('Map Image :', '_waituk_theme_text_domain'); ?></strong></td>
                <td width="70%" align="left">
                    <input style="width:70%;" type="text" name="map_image" id="map_image" value="<?php esc_attr_e($map_image); ?>">
                    <a class="button" id="map_image_button" href="#"><?php _e('Add Image', '_waituk_theme_text_domain'); ?></a>
                </td>
            </tr>
        </table>
        <script>
            jQuery(document).ready(function() {
                jQuery('#map_image_button').click(function() {
                    window.send_to_editor = function(html) {
                        imgurl = jQuery(html).find('img').attr('src');
                        jQuery('#map_image').val(imgurl);
                        tb_remove();
                    }
                    tb_show('', 'media-upload.php?post_id=1&type=image&TB_iframe=true');
                    return false;
                });
            });
        </script>
    </div>
    <?php
        global $post;
        $post->ID = $post_id;
    }
    function ecpt_save_page_listview_cms_postmeta($post_id)
    {
        global $wpdb;
        $exists = 0;
        if ($the_post = wp_is_post_revision($post_id))
            $post_id = $the_post;
        /* checking verification */
        if (!isset($_POST["entrada_listview_box"]) || !wp_verify_nonce($_POST["entrada_listview_box"], basename(__FILE__))) {
            return $post_id;
        }
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }
        if ($_POST['post_type'] != 'page') {
            return $post_id;
        }
        if (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
        if (isset($_POST["best_season"])) {
            update_post_meta($post_id, "best_season", $_POST["best_season"]);
        } else {
            delete_post_meta($post_id, "best_season", '');
        }

        if (isset($_POST["popular_location"])) {
            update_post_meta($post_id, "popular_location", $_POST["popular_location"]);
        } else {
            delete_post_meta($post_id, "popular_location", '');
        }

        if (isset($_POST["map_image"])) {
            update_post_meta($post_id, "map_image", $_POST["map_image"]);
        } else {
            delete_post_meta($post_id, "map_image", '');
        }
    }
    /* Force Listing Display Mode */
    add_action('add_meta_boxes', 'ecpt_add_custom_metabox_display_mode');
    add_action('save_post', 'ecpt_save_page_metabox_display_mode');
    function ecpt_add_custom_metabox_display_mode()
    {
        add_meta_box('entrada_metabox_display_mode_id', 'Force Listing Display Mode', 'ecpt_custom_page_metabox_display_mode', 'page', 'normal', 'high');
    }
    function ecpt_custom_page_metabox_display_mode($post)
    {
        wp_nonce_field(basename(__FILE__), "entrada_forcedisplay_box");
        $allow_templates = array(
            'listing-sidebar-left'                 => 'entrada_templates/listing-sidebar-left.php',
            'listing-sidebar-right'             => 'entrada_templates/listing-sidebar-right.php',
            'listing-full-width-2column-grid'    => 'entrada_templates/listing-full-width-2column-grid.php',
            'listing-full-width-3column-grid'     => 'entrada_templates/listing-full-width-3column-grid.php',
            'listing-full-width-4column-grid'     => 'entrada_templates/listing-full-width-4column-grid.php',
            'listing-full-width'                 => 'entrada_templates/listing-full-width.php',
            'listing-with-detail'                 => 'entrada_templates/listing-with-detail.php'
        );

        $page_template = get_post_meta($post->ID, '_wp_page_template', true);
        $force_display_mode = get_post_meta($post->ID, 'force_display_mode', true);
        if (in_array($page_template, $allow_templates)) { ?>
        <table cellpadding="0" cellspacing="6" border="0" width="100%">
            <tr>
                <td width="30%"><strong> <?php _e('Force Listing Display Style :', '_waituk_theme_text_domain'); ?></strong></td>
                <td width="70%" align="left">
                    <select name="force_display_mode" id="force_display_mode">
                        <option value=""> Select Listing Display Style</option>
                        <option value="list" <?php if (isset($force_display_mode) && $force_display_mode == 'list') {
                                                            echo 'selected="selected"';
                                                        } ?>> List</option>
                        <option value="grid" <?php if (isset($force_display_mode) && $force_display_mode == 'grid') {
                                                            echo 'selected="selected"';
                                                        } ?>>Grid</option>
                    </select>
                    <span class="entrada_metabox_desc"> <?php _e('This will force to display style on listing pages.', '_waituk_theme_text_domain'); ?> </span>
                </td>
            </tr>
        </table>
<?php
    } else {
        _e('<p>Permission denied for the selected page template.</p>',  '_waituk_theme_text_domain');
    }
}
function ecpt_save_page_metabox_display_mode($post_id)
{
    global $wpdb;
    $exists = 0;
    if ($the_post = wp_is_post_revision($post_id))
        $post_id = $the_post;
    /* checking verification */
    if (!isset($_POST["entrada_forcedisplay_box"]) || !wp_verify_nonce($_POST["entrada_forcedisplay_box"], basename(__FILE__))) {
        return $post_id;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    if ($_POST['post_type'] != 'page') {
        return $post_id;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    if (isset($_POST["force_display_mode"])) {
        update_post_meta($post_id, "force_display_mode", $_POST["force_display_mode"]);
    } else {
        delete_post_meta($post_id, "force_display_mode", '');
    }
} ?>