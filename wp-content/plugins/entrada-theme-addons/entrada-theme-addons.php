<?php
/*
Plugin Name: Entrada Theme Addons
Plugin URI: https://themeforest.net/item/tour-booking-adventure-tour-wordpress-theme-entrada/16867379
Description: Declares a plugin that will extend of WP Entrada Theme.
Version: 4.0.7
Author: Waituk
Author URI: https://waituk.com
Text Domain: eaddons
License: GPLv2
*/
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

define('EADDONS_VERSION', '1.0.1');
define('EADDONS_URL', WP_PLUGIN_URL . '/entrada-theme-addons');


if (!class_exists('EnradaAddons')) {
    class EnradaAddons
    {

        public function __construct()
        {

            $GLOBALS['eaddons_db_version'] = EADDONS_VERSION;
            $this->templates = array();

            add_action('plugins_loaded', array(&$this, 'eaddons_load_textdomain'), 1);
            add_action('admin_init', array(&$this, 'eaddons_update_db_check'), 2);
            add_action('admin_menu', array(&$this, 'eaddons_menus'), 3);

            /* Widgets */
            include(plugin_dir_path(__FILE__) . '/widgets/footer-contact-widget.php');
            include(plugin_dir_path(__FILE__) . '/widgets/entrada-categories-widget.php');
            include(plugin_dir_path(__FILE__) . '/widgets/entrada-popular-posts-widget.php');
            include(plugin_dir_path(__FILE__) . '/widgets/entrada-taxonomy-widget.php');
            include(plugin_dir_path(__FILE__) . '/widgets/entrada-gallery-posts-widget.php');
            include(plugin_dir_path(__FILE__) . '/widgets/entrada-subscribe-widget.php');
            include(plugin_dir_path(__FILE__) . '/widgets/entrada-poll-widget.php');
            include(plugin_dir_path(__FILE__) . '/widgets/entrada-filter-region-widget.php');
            include(plugin_dir_path(__FILE__) . '/widgets/entrada-filter-activity-type-widget.php');
            include(plugin_dir_path(__FILE__) . '/widgets/entrada-filter-tour-tag-widget.php');
            include(plugin_dir_path(__FILE__) . '/widgets/entrada-filter-activity-level-widget.php');
            include(plugin_dir_path(__FILE__) . '/widgets/entrada-filter-price-range-widget.php');

            // Remove term default derm description
            if (class_exists('WooCommerce')) {
                remove_filter('pre_term_description', 'wp_filter_kses');
                remove_filter('pre_link_description', 'wp_filter_kses');
            }

            // Add rate article field
            add_action('comment_form_logged_in_after', array(&$this, 'eaddons_additional_fields'));
            add_action('comment_form_after_fields', array(&$this, 'eaddons_additional_fields'));

            add_filter('preprocess_comment',  array(&$this, 'eaddons_verify_comment_meta_data'));
            add_shortcode('sharethis_nav', array(&$this, 'eaddons_sharethis_nav'));
        }

        public function eaddons_load_textdomain()
        {
            load_plugin_textdomain('eaddons', false, dirname(plugin_basename(__FILE__)) . '/languages');
        }

        public function eaddons_sharethis_nav($post_id)
        {
            global $wpdb;
            $share_img         = '';
            $share_txt  =  '';
            $share_title     = get_the_title($post_id);
            $share_url         = get_permalink($post_id);
            $entrada_post     = get_post($post_id);

            if (isset($entrada_post->post_content)) {
                $share_txt  = wp_trim_words(strip_tags($entrada_post->post_content), 40, '');
            }

            if (has_post_thumbnail($post_id)) :
                $image         = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'single-post-thumbnail');
                $share_img     = $image[0];
            endif;
            $html = '<li class="dropdown">
	    <a class="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><span class="icon-share"></span></a>
	    <ul class="dropdown-menu drop-social-share">
	    <li><a href="javascript:void(null);" class="facebook" onClick = "fb_callout(&quot;' . $share_url . '&quot;, &quot;' . $share_img . '&quot;, &quot;' . $share_title . '&quot;, &quot;' . $share_txt . '&quot;);">
	        <span class="ico">
	            <span class="icon-facebook"></span>
	        </span>
	        <span class="text">Share</span>
	    </a>
	    </li>
	    <li><a href="javascript:void(null);" class="twitter" onClick ="share_on_twitter(&quot;' . $share_url . '&quot;, &quot;' . $share_title . '&quot;);">
	        <span class="ico">
	            <span class="icon-twitter"></span>
	        </span>
	        <span class="text">Tweet</span>
	    </a> </li>
	    </ul>
	    </li>';
            return $html;
        }

        /* Upgrade while new version comes up */
        public function eaddons_update_db_check()
        {

            if (get_option('eaddons_db_version') != $GLOBALS['eaddons_db_version']) {
                include(plugin_dir_path(__FILE__) . 'upgrade/create_tables.php');
                update_option("eaddons_db_version", $GLOBALS['eaddons_db_version']);
            }
        }

        /* Options for plugins */
        public function eaddons_menus()
        {
            $dashboard = plugin_dir_url(__FILE__) . 'assets/img/addons.png';

            add_menu_page(__('Addons', 'eaddons'), __('Addons', 'eaddons'), 'manage_options', 'eaddons_dashboard', array(&$this, 'eaddons_action'), $dashboard, 21);

            add_submenu_page('eaddons_dashboard', __('Facebook', 'eaddons'), __('Facebook', 'eaddons'), 'manage_options', 'eaddons-facebook', array(&$this, 'eaddons_facebook'));

            add_submenu_page('eaddons_dashboard', __('Google API Key', 'eaddons'), __('Google API Key', 'eaddons'), 'manage_options', 'eaddons-googleapi', array(&$this, 'eaddons_google_api'));

            add_submenu_page('eaddons_dashboard', __('Custom Icons', 'eaddons'), __('Custom Icons', 'eaddons'), 'manage_options', 'eaddons-custom-icons', array(&$this, 'eaddons_custom_icons'));

            add_submenu_page('eaddons_dashboard', __('Price Range', 'eaddons'), __('Price Range', 'eaddons'), 'manage_options', 'eaddons-price-range', array(&$this, 'eaddons_price_range'));

            add_submenu_page('eaddons_dashboard', __('Community Polls', 'eaddons'), __('Community Polls', 'eaddons'), 'manage_options', 'eaddons-polls', array(&$this, 'eaddons_polls'));

            add_submenu_page('eaddons_dashboard', __('Import/Export Taxonomy', 'eaddons'), __('Import/Export Taxonomy', 'eaddons'), 'manage_options', 'eaddons-export-category', array(&$this, 'eaddons_export_category'));

            add_submenu_page('eaddons_dashboard', __('Import/Export Gallery', 'eaddons'), __('Import/Export Gallery', 'eaddons'), 'manage_options', 'eaddons-gallery-import-export', array(&$this, 'eaddons_gallery_import_export'));
        }

        public function eaddons_action()
        {
            include(plugin_dir_path(__FILE__) . '/components/addons.php');
        }

        public function eaddons_facebook()
        {
            include(plugin_dir_path(__FILE__) . '/components/facebook.php');
        }

        public function eaddons_google_api()
        {
            include(plugin_dir_path(__FILE__) . '/components/google_api.php');
        }

        public function eaddons_custom_icons()
        {
            include(plugin_dir_path(__FILE__) . '/components/custom_icons.php');
        }

        public function eaddons_price_range()
        {
            include(plugin_dir_path(__FILE__) . '/components/price_range.php');
        }

        public function eaddons_polls()
        {
            include(plugin_dir_path(__FILE__) . '/components/community_polls.php');
        }

        public function eaddons_export_category()
        {
            include(plugin_dir_path(__FILE__) . '/components/export_categories.php');
        }

        public function eaddons_gallery_import_export()
        {
            include(plugin_dir_path(__FILE__) . '/components/gallery_import_export.php');
        }

        public function eaddons_additional_fields()
        {
            $content = '';

            if (is_singular('post')) {
                return '';
            }
            if (is_user_logged_in()) {
                $content .=  '<div class="row">';
            }
            $content .=  '<div class="col-sm-6 form-group form-rate">';
            $content .=  '<input class="give_blog_rating" name="product_rating" type="hidden" value="">';
            $content .=  '<input name="show_rating_field" type="hidden" value="yes">';
            $content .=  '<input placeholder="' . __('Rate Article', 'eaddons') . '" type="text" class="form-control">';
            $content .=  '<div class="star-rating">';
            $content .=  '<div class="give_blog_rateYo" id="rate"></div>';
            $content .=  '</div>';
            $content .=  '</div>';
            if (is_user_logged_in()) {
                $content .=  '</div>';
            }
            echo sprintf(__('%s', 'eaddons'), $content);
        }

        public function eaddons_verify_comment_meta_data($commentdata)
        {
            if (!is_admin()) {

                if (isset($_POST['show_rating_field']) && $_POST['show_rating_field'] == 'yes') {

                    if (!isset($_POST['product_rating']) || $_POST['product_rating'] == '') {
                        wp_die(__('<strong>Error: </strong> You did not add a rating. Hit the Back button on your Web browser and resubmit your comment with a rating.', 'eaddons'));
                    }
                }
            }
            return $commentdata;
        }

        public function eaddons_currency_symbol()
        {

            if (class_exists('WooCommerce')) {
                $currency_symbol = get_woocommerce_currency_symbol();
            } else {
                $currency_symbol = '$';
            }

            return $currency_symbol;
        }

        public function eaddons_count_poll_option_result($question_id, $option_index = '')
        {
            global $wpdb;
            $sql = "select COUNT(*) from " . $wpdb->prefix . "poll_answer where 1 = 1 and question_id = " . $question_id;
            if (!empty($option_index)) {
                $sql .= " and vote = " . $option_index;
            }
            $rowcount = $wpdb->get_var($sql);
            return $rowcount;
        }

        public function eaddons_active_poll()
        {
            $widget_entrada_poll_widget = get_option('widget_entrada_poll_widget');
            $active_poll                 = maybe_unserialize($widget_entrada_poll_widget);
            if (array_key_exists(2, $active_poll)) {
                if (array_key_exists('poll_id', $active_poll[2])) {
                    return $active_poll[2]['poll_id'];
                } else {
                    return '';
                }
            }
            return '';
        }


        public function eaddons_poll_option_vote_percentage($total_vote, $option_vote)
        {
            if ($total_vote == 0) {
                return 0;
            }
            return round(($option_vote / $total_vote) * 100);
        }

        public function eaddons_attachment_id_from_src($image_src)
        {
            global $wpdb;
            $query     = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
            $id     = $wpdb->get_var($query);
            return $id;
        }

        public function eaddons_update_guid($old_url, $new_url)
        {
            global $wpdb;
            $wpdb->query("UPDATE " . $wpdb->prefix . "posts SET guid = replace(guid, '" . $old_url . "','" . $new_url . "')");
            $wpdb->query("UPDATE " . $wpdb->prefix . "postmeta SET meta_value = replace(meta_value, '" . $old_url . "','" . $new_url . "')");
        }

        public function eaddons_post_id_from_slug($post_slug)
        {
            global $wpdb;
            $rw = $wpdb->get_row("select * from " . $wpdb->prefix . "posts where post_name ='" . $post_slug . "'");
            return $rw->ID;
        }
    }
}


/* Object create for main class */
if (class_exists('EnradaAddons')) {
    global $entrada_addons;
    $entrada_addons = new EnradaAddons();
}
