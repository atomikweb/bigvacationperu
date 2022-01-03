<?php
/*
Plugin Name: Entrada Post Type
Plugin URI: http://waituk.com/
Description: Declares a plugin that will create a custom post type displaying custom post type.
Version: 4.0.7
Author: WAITUK
Author URI: http://waituk.com/
Text Domain: ecpt_addons
License: GPLv2
*/

if (!defined('ABSPATH')) {
	exit;
}

define('ECPT_ADDONS_VERSION', '4.0.7');
define('ECPT_ADDONS_URL', WP_PLUGIN_URL . '/entrada-post-type');


/* Register Custom Post Type : Guides

................................... */

include('entrada_vc_icomoon_list.php');
include('inc/wc_meta_boxes.php');
include('inc/custom-postmeta.php');
include('inc/post-gallery-images.php');
include('inc/post-featured-video.php');

function custom_post_type_guide()
{



	$labels = array(

		'name'                => _x('Guide', 'Post Type General Name', 'entrada'),

		'singular_name'       => _x('Guide', 'Post Type Singular Name', 'entrada'),

		'menu_name'           => __('Guides', 'entrada'),

		'name_admin_bar'      => __('Guides', 'entrada'),

		'parent_item_colon'   => __('Parent Guide:', 'entrada'),

		'all_items'           => __('All Guides', 'entrada'),

		'add_new_item'        => __('Add New Guide', 'entrada'),

		'add_new'             => __('Add New', 'entrada'),

		'new_item'            => __('New Guide', 'entrada'),

		'edit_item'           => __('Edit Guide', 'entrada'),

		'update_item'         => __('Update Guide', 'entrada'),

		'view_item'           => __('View Guides', 'entrada'),

		'search_items'        => __('Search Guide', 'entrada'),

		'not_found'           => __('Not found', 'entrada'),

		'not_found_in_trash'  => __('Not found in Trash', 'entrada'),

	);

	$args = array(

		'label'               => __('Guide', 'entrada'),

		'description'         => __('Post Type Description', 'entrada'),

		'labels'              => $labels,

		'supports'            => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),

		'hierarchical'        => false,

		'public'              => true,

		'show_ui'             => true,

		'show_in_menu'        => true,

		'menu_position'       => 5,

		'show_in_admin_bar'   => true,

		'menu_icon'           => 'dashicons-id',

		'show_in_nav_menus'   => true,

		'can_export'          => true,

		'has_archive'         => true,

		'exclude_from_search' => false,

		'publicly_queryable'  => true,

		'capability_type'     => 'page',

	);

	register_post_type('guide', $args);

	flush_rewrite_rules();
}

add_action('init', 'custom_post_type_guide', 0);



// Register Custom Post Type : Partners
function custom_post_type_partner()
{



	$labels = array(

		'name'                => _x('Partner', 'Post Type General Name', 'entrada'),

		'singular_name'       => _x('Partner', 'Post Type Singular Name', 'entrada'),

		'menu_name'           => __('Partners', 'entrada'),

		'name_admin_bar'      => __('Partners', 'entrada'),

		'parent_item_colon'   => __('Parent Partner:', 'entrada'),

		'all_items'           => __('All Partners', 'entrada'),

		'add_new_item'        => __('Add New Partner', 'entrada'),

		'add_new'             => __('Add New', 'entrada'),

		'new_item'            => __('New Partner', 'entrada'),

		'edit_item'           => __('Edit Partner', 'entrada'),

		'update_item'         => __('Update Partner', 'entrada'),

		'view_item'           => __('View Partners', 'entrada'),

		'search_items'        => __('Search Partner', 'entrada'),

		'not_found'           => __('Not found', 'entrada'),

		'not_found_in_trash'  => __('Not found in Trash', 'entrada'),

	);

	$args = array(

		'label'               => __('Partner', 'entrada'),

		'description'         => __('Post Type Description', 'entrada'),

		'labels'              => $labels,

		'supports'            => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),

		'hierarchical'        => false,

		'public'              => true,

		'show_ui'             => true,

		'show_in_menu'        => true,

		'menu_position'       => 6,

		'show_in_admin_bar'   => true,

		'menu_icon'           => 'dashicons-media-code',

		'show_in_nav_menus'   => true,

		'can_export'          => true,

		'has_archive'         => true,

		'exclude_from_search' => false,

		'publicly_queryable'  => true,

		'capability_type'     => 'page',

	);

	register_post_type('partner', $args);

	flush_rewrite_rules();
}

add_action('init', 'custom_post_type_partner', 0);

// Register Custom Post Type : Service features
function custom_post_type_service_features()
{

	$labels = array(

		'name'                => _x('Service', 'Post Type General Name', 'entrada'),
		'singular_name'       => _x('Service', 'Post Type Singular Name', 'entrada'),
		'menu_name'           => __('Services', 'entrada'),
		'name_admin_bar'      => __('Services', 'entrada'),
		'parent_item_colon'   => __('Parent Service:', 'entrada'),
		'all_items'           => __('All Services', 'entrada'),
		'add_new_item'        => __('Add New Service', 'entrada'),
		'add_new'             => __('Add New', 'entrada'),
		'new_item'            => __('New Service', 'entrada'),
		'edit_item'           => __('Edit Service', 'entrada'),
		'update_item'         => __('Update Service', 'entrada'),
		'view_item'           => __('View Services', 'entrada'),
		'search_items'        => __('Search Service', 'entrada'),
		'not_found'           => __('Not found', 'entrada'),
		'not_found_in_trash'  => __('Not found in Trash', 'entrada'),

	);

	$args = array(

		'label'               => __('Service', 'entrada'),
		'description'         => __('Post Type Description', 'entrada'),
		'labels'              => $labels,
		'supports'            => array('title', 'editor'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 6,
		'show_in_admin_bar'   => true,
		'menu_icon'           => 'dashicons-screenoptions',
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);

	register_post_type('service', $args);

	flush_rewrite_rules();
}

add_action('init', 'custom_post_type_service_features', 0);

// Register Custom Post Type : Testimonials



function custom_post_type_testimonial()
{



	$labels = array(

		'name'                => _x('Testimonials', 'Post Type General Name', 'entrada'),

		'singular_name'       => _x('Testimonial', 'Post Type Singular Name', 'entrada'),

		'menu_name'           => __('Testimonials', 'entrada'),

		'name_admin_bar'      => __('Testimonials', 'entrada'),

		'parent_item_colon'   => __('Parent Testimonial:', 'entrada'),

		'all_items'           => __('All Testimonials', 'entrada'),

		'add_new_item'        => __('Add New Testimonial', 'entrada'),

		'add_new'             => __('Add New', 'entrada'),

		'new_item'            => __('New Testimonial', 'entrada'),

		'edit_item'           => __('Edit Testimonial', 'entrada'),

		'update_item'         => __('Update Testimonial', 'entrada'),

		'view_item'           => __('View Testimonials', 'entrada'),

		'search_items'        => __('Search Testimonial', 'entrada'),

		'not_found'           => __('Not found', 'entrada'),

		'not_found_in_trash'  => __('Not found in Trash', 'entrada'),

	);

	$args = array(

		'label'               => __('Testimonial', 'entrada'),

		'description'         => __('Post Type Description', 'entrada'),

		'labels'              => $labels,

		'supports'            => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),

		'hierarchical'        => false,

		'public'              => true,

		'show_ui'             => true,

		'show_in_menu'        => true,

		'menu_position'       => 6,

		'show_in_admin_bar'   => true,

		'menu_icon'           => 'dashicons-testimonial',

		'show_in_nav_menus'   => true,

		'can_export'          => true,

		'has_archive'         => true,

		'exclude_from_search' => false,

		'publicly_queryable'  => true,

		'capability_type'     => 'page',

	);

	register_post_type('testimonial', $args);

	flush_rewrite_rules();
}

add_action('init', 'custom_post_type_testimonial', 0);


/* Entrada Services Post meta
 ............... ...............  */
add_action('add_meta_boxes', 'entrada_add_custom_services');
add_action('save_post', 'entrada_save_custom_services_postmeta');

function entrada_add_custom_services()
{

	add_meta_box('entrada_service_id', 'Service Options', 'entrada_custom_services_box', 'service', 'side', 'low');
}

function entrada_custom_services_box($post)
{
	global $wpdb;
	global $icon_array;
	ksort($icon_array);
	$post_id = $post->ID;
	/*Add verification field*/
	wp_nonce_field(plugin_basename(__FILE__), 'entrada_service_noncename');

	/*Add verification field ends*/
	$service_icon = get_post_meta($post_id, 'service_icon', true);
	?>

	<div style="width:100%;">
		<table cellpadding="0" cellspacing="6" border="0" width="100%">
			<tr>
				<td width="100%" align="left"><label>Icon</label>
					<select name="service_icon" id="service_icon">
						<option value=""> Set Icon</option>
						<?php foreach ($icon_array as $key => $val) { ?>
							<option <?php if (isset($service_icon) && $service_icon == $val) {
												echo 'selected="selected"';
											} ?> value="<?php echo $val; ?>"><?php echo ucwords(str_replace('-', '', $key)); ?></option>
						<?php } ?>

					</select>
				</td>
			</tr>
		</table>

	</div>

<?php

	global $post;

	$post->ID = $post_id;
}

function entrada_save_custom_services_postmeta($post_id)
{
	global $wpdb;

	$exists = 0;

	if ($the_post = wp_is_post_revision($post_id)) {
		$post_id = $the_post;
	}

	/* checking verification */
	if (!isset($_POST["entrada_service_noncename"]) || !wp_verify_nonce($_POST["entrada_service_noncename"], plugin_basename(__FILE__))) {
		return $post_id;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	if ($_POST['post_type'] != 'service') {
		return $post_id;
	}

	if (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}


	if (isset($_POST["service_icon"])) {
		update_post_meta($post_id, "service_icon", $_POST["service_icon"]);
	} else {
		delete_post_meta($post_id, "service_icon", '');
	}
}

/* Entrada Testimonial Post meta
 ............... ...............  */
add_action('add_meta_boxes', 'entrada_add_custom_testi');
add_action('save_post', 'entrada_save_custom_testi_postmeta');

function entrada_add_custom_testi()
{

	add_meta_box('entrada_testi_id', 'Testimonial Options', 'entrada_custom_testi_box', 'testimonial', 'side', 'low');
}

function entrada_custom_testi_box($post)
{
	global $wpdb;
	global $icon_array;
	ksort($icon_array);
	$post_id = $post->ID;
	/*Add verification field*/
	wp_nonce_field(plugin_basename(__FILE__), 'entrada_testi_noncename');

	/*Add verification field ends*/
	$testi_custom_url = get_post_meta($post_id, 'testi_custom_url', true);
	?>

	<div style="width:100%;">
		<table cellpadding="0" cellspacing="6" border="0" width="100%">

			<tr>
				<td width="100%" align="left"><label>Custom Page Link</label>
					<input style="width:90%;" type="text" name="testi_custom_url" id="testi_custom_url" value="<?php echo $testi_custom_url; ?>">
					<p class="howto"> Add custom url to read more page. </p>

				</td>

			</tr>
		</table>

	</div>

<?php

	global $post;

	$post->ID = $post_id;
}

function entrada_save_custom_testi_postmeta($post_id)
{
	global $wpdb;

	$exists = 0;

	if ($the_post = wp_is_post_revision($post_id)) {
		$post_id = $the_post;
	}

	/* checking verification */
	if (!isset($_POST["entrada_testi_noncename"]) || !wp_verify_nonce($_POST["entrada_testi_noncename"], plugin_basename(__FILE__))) {
		return $post_id;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	if ($_POST['post_type'] != 'testimonial') {
		return $post_id;
	}

	if (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}


	if (isset($_POST["testi_custom_url"])) {
		update_post_meta($post_id, "testi_custom_url", $_POST["testi_custom_url"]);
	} else {
		delete_post_meta($post_id, "testi_custom_url", '');
	}
}


/* Entrada custom post meta start here
 ............... ...............  */

add_action('add_meta_boxes', 'entrada_add_custom_designation_box');
add_action('save_post', 'entrada_save_guide_designation_postmeta');

function entrada_add_custom_designation_box()
{
	add_meta_box('entrada_guide_designation_id', 'Guide Options', 'entrada_custom_guide_designation_box', 'guide', 'side', 'low');
}

function entrada_custom_guide_designation_box($post)

{

	global $wpdb;



	$post_id = $post->ID;



	/*Add verification field*/

	wp_nonce_field(plugin_basename(__FILE__), 'entrada_posttype_noncename');

	/*Add verification field ends*/

	$guide_designation = get_post_meta($post_id, 'guide_designation', true);

	$facebook_url = get_post_meta($post_id, 'facebook_url', true);

	$twitter_url = get_post_meta($post_id, 'twitter_url', true);

	$instagram_url = get_post_meta($post_id, 'instagram_url', true);

	$guide_custom_url = get_post_meta($post_id, 'guide_custom_url', true);

	?>

	<div style="width:100%;">

		<table cellpadding="0" cellspacing="6" border="0" width="100%">



			<tr>

				<td width="100%" align="left"><label>Designation</label>

					<input style="width:90%;" type="text" name="guide_designation" id="guide_designation" value="<?php echo $guide_designation; ?>">

					<p class="howto"> Add guide designation here. </p>

				</td>

			</tr>



			<tr>

				<td width="100%" align="left"><label>Facebook Link</label>

					<input style="width:90%;" type="text" name="facebook_url" id="facebook_url" value="<?php echo $facebook_url; ?>">
					<p class="howto"> Add Facebook link here. </p>

				</td>

			</tr>



			<tr>

				<td width="100%" align="left"> <label>Twitter Link</label>

					<input style="width:90%;" type="text" name="twitter_url" id="twitter_url" value="<?php echo $twitter_url; ?>">
					<p class="howto"> Add Twitter link here. </p>

				</td>

			</tr>



			<tr>

				<td width="100%" align="left"> <label>Instagram Link</label>

					<input style="width:90%;" type="text" name="instagram_url" id="instagram_url" value="<?php echo $instagram_url; ?>">
					<p class="howto"> Add Instagram link here. </p>

				</td>

			</tr>



			<tr>

				<td width="100%" align="left"><label>Custom Page Link</label>

					<input style="width:90%;" type="text" name="guide_custom_url" id="guide_custom_url" value="<?php echo $guide_custom_url; ?>">
					<p class="howto"> Add custom url to read more page. </p>

				</td>

			</tr>



		</table>



	</div>

<?php

	global $post;

	$post->ID = $post_id;
}



function entrada_save_guide_designation_postmeta($post_id)

{

	global $wpdb;





	$exists = 0;

	if ($the_post = wp_is_post_revision($post_id)) {
		$post_id = $the_post;
	}

	/* checking verification */
	if (!isset($_POST["entrada_posttype_noncename"]) || !wp_verify_nonce($_POST["entrada_posttype_noncename"], plugin_basename(__FILE__))) {
		return $post_id;
	}




	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}



	if ($_POST['post_type'] != 'guide') {
		return $post_id;
	}



	if (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	if (isset($_POST["guide_designation"])) {

		update_post_meta($post_id, "guide_designation", $_POST["guide_designation"]);
	} else {

		delete_post_meta($post_id, "guide_designation", '');
	}



	if (isset($_POST["facebook_url"])) {

		update_post_meta($post_id, "facebook_url", $_POST["facebook_url"]);
	} else {

		delete_post_meta($post_id, "facebook_url", '');
	}



	if (isset($_POST["twitter_url"])) {

		update_post_meta($post_id, "twitter_url", $_POST["twitter_url"]);
	} else {

		delete_post_meta($post_id, "twitter_url", '');
	}



	if (isset($_POST["instagram_url"])) {

		update_post_meta($post_id, "instagram_url", $_POST["instagram_url"]);
	} else {

		delete_post_meta($post_id, "instagram_url", '');
	}



	if (isset($_POST["guide_custom_url"])) {

		update_post_meta($post_id, "guide_custom_url", $_POST["guide_custom_url"]);
	} else {

		delete_post_meta($post_id, "guide_custom_url", '');
	}





	/* checking verification ends*/
}


/* Custom Post meta for partner
 ............... ...............  */
add_action('add_meta_boxes', 'entrada_add_partner_custom_metabox');
add_action('save_post', 'entrada_save_partner_postmeta');

function entrada_add_partner_custom_metabox()
{
	add_meta_box('entrada_partner_metabox_id', 'Partner Options', 'entrada_custom_partner_metabox', 'partner', 'side', 'low');
}

function entrada_custom_partner_metabox($post)
{
	global $wpdb;
	$post_id = $post->ID;

	/*Add verification field*/

	wp_nonce_field(plugin_basename(__FILE__), 'entrada_partner_noncename');

	/*Add verification field ends*/

	$parner_url = get_post_meta($post_id, 'parner_url', true);
	$partner_secondary_img_id = get_post_meta($post_id, 'partner_secondary_img_id', true);

	$parner_secondary_img_src = '';
	$default_img = plugins_url('img/placeholder.png', __FILE__);

	if (isset($partner_secondary_img_id) && $partner_secondary_img_id != '') {
		$parner_secondary_img_src = wp_get_attachment_url($partner_secondary_img_id);
	}

	?>

	<div style="width:100%;">

		<table cellpadding="0" cellspacing="6" border="0" width="100%">
			<tr>

				<td width="100%" align="left"><label><strong>Link</strong></label>

					<input style="width:90%;" type="text" name="parner_url" id="parner_url" value="<?php echo $parner_url; ?>">
					<p class="howto"> Add partner link here. </p>

				</td>

			</tr>


		</table>



	</div>
	<style>
		#parner_secondary_img img {
			max-height: 250px;
			max-width: 250px;
			padding: 25px 10px;
		}
	</style>

	<div class="form-field">
		<label><strong>Secondary Image</strong></label>
		<div id="parner_secondary_img" style="float: left; margin-right: 10px;"><img src="<?php echo esc_attr($parner_secondary_img_src) ? esc_attr($parner_secondary_img_src) : $default_img; ?>" /></div>
		<div style="line-height: 60px;">
			<input type="hidden" id="partner_secondary_img_id" name="partner_secondary_img_id" value="<?php echo esc_attr($partner_secondary_img_id) ? esc_attr($partner_secondary_img_id) : ''; ?>" />
			<button type="button" class="upload_banner_img_button button">Upload/Add image</button>
			<button type="button" class="remove_partner_img_button button">Remove image</button>
		</div>
		<script type="text/javascript">
			// Only show the "remove image" button when needed
			if (!jQuery('#partner_secondary_img_id').val()) {
				jQuery('.remove_partner_img_button').hide();
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

					jQuery('#partner_secondary_img_id').val(attachment.id);
					jQuery('#parner_secondary_img').find('img').attr('src', attachment.sizes.thumbnail.url);
					jQuery('.remove_partner_img_button').show();
				});

				// Finally, open the modal.
				banner_file_frame.open();
			});

			jQuery(document).on('click', '.remove_partner_img_button', function() {
				jQuery('#parner_secondary_img').find('img').attr('src', '<?php echo $default_img; ?>');
				jQuery('#partner_secondary_img_id').val('');
				jQuery('.remove_partner_img_button').hide();
				return false;
			});
		</script>
		<div class="clear"></div>
	</div>

<?php

	global $post;

	$post->ID = $post_id;
}

function entrada_save_partner_postmeta($post_id)
{

	global $wpdb;
	$exists = 0;

	if ($the_post = wp_is_post_revision($post_id)) {
		$post_id = $the_post;
	}

	/* checking verification */
	if (!isset($_POST["entrada_partner_noncename"]) || !wp_verify_nonce($_POST["entrada_partner_noncename"], plugin_basename(__FILE__))) {
		return $post_id;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}



	if ($_POST['post_type'] != 'partner') {
		return $post_id;
	}



	if (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	if (isset($_POST["parner_url"])) {
		update_post_meta($post_id, "parner_url", $_POST["parner_url"]);
	} else {
		delete_post_meta($post_id, "parner_url", '');
	}

	if (isset($_POST["partner_secondary_img_id"])) {
		update_post_meta($post_id, "partner_secondary_img_id", $_POST["partner_secondary_img_id"]);
	} else {
		delete_post_meta($post_id, "partner_secondary_img_id", '');
	}


	/* checking verification ends*/
}

?>