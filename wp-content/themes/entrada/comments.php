<?php

/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 *
 * @package Entrada
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

if (post_password_required()) {
	return;
} ?>
<div id="comments" class="comments-area">
	<?php
	if (have_comments()) : ?>
		<div class="header-box header-box-single">
			<strong class="comments-title">
				<?php
					printf(
						esc_html(_nx('One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'entrada')),
						number_format_i18n(get_comments_number()),
						'<span>' . get_the_title() . '</span>'
					); ?>
			</strong>
		</div>
		<div class="comments">
			<?php
				echo '<ul class="comment_list">';
				wp_list_comments('type=comment&callback=entrada_comment');
				echo '</ul>';
				if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
				<div class="link-more has-button">
					<span class="nav-previous"><?php previous_comments_link(esc_html__('Older Comments', 'entrada')); ?></span>
					<span class="nav-next"><?php next_comments_link(esc_html__('Newer Comments', 'entrada')); ?></span>
				</div>
			<?php endif; ?>
		</div>
		<?php
			if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
			<p class="no-comments"><?php esc_html_e('Comments are closed.',  'entrada'); ?></p>
	<?php
		endif;
	endif;

	global $post;
	$post_id = $post->ID;
	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$req = get_option('require_name_email');
	$aria_req = ($req ? " required='required'" : '');
	$comment_form_args = array(
		'fields' => array(
			'author'	=> '<div class="col-sm-6 form-group"><input placeholder="' . __('Full Name', 'entrada') . '"  id="author" name="author" type="text" class="form-control"  value="' . esc_attr($commenter['comment_author']) . '" ' . $aria_req . '></div>',
			'email'		=> '<div class="col-sm-6 form-group"><input placeholder="' . __('Email', 'entrada') . '" id="email" name="email" type="text" class="form-control"  value="' . esc_attr($commenter['comment_author_email']) . '" ' . $aria_req . '></div>',
			'url'		=> '<div class="col-sm-12 form-group"><input placeholder="' . __('Website', 'entrada') . '"  id="url" name="url" type="text" class="form-control"  value="' . esc_attr($commenter['comment_author_url']) . '"></div>',
		),
		'comment_field'			=> '<div class="row"><div class="col-sm-12 form-group"><textarea placeholder="' . __('Your Comment', 'entrada') . '" name="comment" class="form-control" aria-required="true"></textarea></div></div>',

		'must_log_in'			=> '<div class="row"><div class="col-sm-12 form-group  must-log-in"><span class="help-block text-muted smaller-text">' . sprintf(__('You must be <a href="%s">logged in</a> to post a comment.', 'entrada'), wp_login_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</span></div></div>',

		'logged_in_as'			=> '<div class="row"><div class="col-sm-12 form-group logged-in-as"><span class="help-block text-muted smaller-text">' . sprintf(__('You logged in as <a href="%1$s">%2$s</a>. <a href="%3$s">Log out</a>', 'entrada'), admin_url('profile.php'), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink($post_id)))) . '</span></div></div>',
		'comment_notes_before'	=> '',

		'id_form'				=> 'comment-form',
		'class_form'			=>  'comment-form blog-comment-form',
		'id_submit'				=>   'submit',
		'title_reply'			=> __('LEAVE A COMMENT', 'entrada'),
		'title_reply_to'		=> __('Submit reply to %s', 'entrada'),
		'cancel_reply_link'		=> __('Cancel reply', 'entrada'),
		'class_submit'			=> 'btn btn-default',
		'label_submit'			=> __('POST YOUR COMMENT', 'entrada'),
	);
	echo "<div class='comment_container comment-form'>";
	comment_form($comment_form_args);
	echo '</div>'; ?>
</div>