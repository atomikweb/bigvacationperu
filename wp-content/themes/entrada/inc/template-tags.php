<?php

/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Entrada
 */

if (!function_exists('entrada_entry_footer')) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function entrada_entry_footer()
	{
		if ('post' === get_post_type()) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list(esc_html__(', ', 'entrada'));
			if ($categories_list && entrada_categorized_blog()) {
				printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'entrada') . '</span>', $categories_list); // WPCS: XSS OK.
			}
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list('', esc_html__(', ', 'entrada'));
			if ($tags_list) {
				printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'entrada') . '</span>', $tags_list); // WPCS: XSS OK.
			}
		}
		if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
			echo '<span class="comments-link">';
			comments_popup_link(esc_html__('Leave a comment', 'entrada'), esc_html__('1 Comment', 'entrada'), esc_html__('% Comments', 'entrada'));
			echo '</span>';
		}
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__('Edit %s', 'entrada'),
				the_title('<span class="screen-reader-text">"', '"</span>', false)
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;
/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function entrada_categorized_blog()
{
	if (false === ($all_the_cool_cats = get_transient('entrada_categories'))) {
		$all_the_cool_cats = get_categories(array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			'number'     => 2,
		));
		$all_the_cool_cats = count($all_the_cool_cats);
		set_transient('entrada_categories', $all_the_cool_cats);
	}
	if ($all_the_cool_cats > 1) {
		return true;
	} else {
		return false;
	}
}
/**
 * Flush out the transients used in entrada_categorized_blog.
 */
function entrada_category_transient_flusher()
{
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	delete_transient('entrada_categories');
}
add_action('edit_category', 'entrada_category_transient_flusher');
add_action('save_post',     'entrada_category_transient_flusher');
