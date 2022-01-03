<?php
/* ecpt Post Featured Video
.................................... */
add_action('admin_init', 'ecpt_add_post_featured_video');
add_action('save_post', 'ecpt_update_post_featured_video', 10, 2);
/**
 * Add custom Meta Box to Posts post type
 */
function ecpt_add_post_featured_video()
{
    add_meta_box(
        'post_featured_video',
        __('Featured Video', 'ecpt_addons'),
        'ecpt_print_featured_video_option',
        'post',
        'side',
        'low'
    );
}
/**
 * Print the Meta Box content
 */
function ecpt_print_featured_video_option()
{
    global $post;
    $featured_video_url = get_post_meta($post->ID, 'featured_video_url', true);
    /* Use nonce for verification */
    wp_nonce_field(basename(__FILE__), "noncename_post_video"); ?>
    <div id="dynamic_form">
        <div id="add_field_row">
            <input type="text" name="featured_video_url" size="32" value="<?php echo esc_url($featured_video_url); ?>">
            <p class="howto"><?php _e('Add Youtube/vimeo URL.', 'ecpt_addons'); ?></p>
        </div>
    </div>
<?php
}
/**
 * Save post action, process fields
 */
function ecpt_update_post_featured_video($post_id, $post_object)
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
    if (!isset($_POST["noncename_post_video"]) || !wp_verify_nonce($_POST["noncename_post_video"], basename(__FILE__))) {
        return;
    }
    /* Correct post type */
    if ('post' != $_POST['post_type']) { /* here you can set post type name */
        return;
    }
    if (isset($_POST['featured_video_url'])) {
        update_post_meta($post_id, "featured_video_url", $_POST['featured_video_url']);
    } else {
        delete_post_meta($post_id, "featured_video_url", '');
    }
} ?>