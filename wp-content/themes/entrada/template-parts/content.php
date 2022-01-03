<?php

/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Entrada
 */
if (empty($full_length)) {
	$word = (int) get_theme_mod('blog_excerpt_word_length', 25);
	$char = (int) get_theme_mod('blog_excerpt_char_length', 150);
	$content = entrada_truncate(strip_tags(get_the_content(get_the_ID())), $word, $char);
} else {
	$content = get_the_content(get_the_ID());
}
$average_rating =  entrada_post_average_rating($post->ID); ?>

<article class="article blog-article">
	<div class="thumbnail">
		<?php echo entrada_image_holder(get_the_ID(), array(350, 240)); ?>
		<div class="description">
			<header class="heading">
				<h3><a href="<?php the_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a></h3>
				<time class="info-day" datetime="2011-01-12"><?php the_time('jS, M') ?></time>
			</header>
			<p><?php echo sprintf(__('%s', 'entrada'), $content); ?></p>
			<footer class="meta">

				<div class="footer-sub">
					<div class="rate-info">
						Post by <a href="#"><?php the_author(); ?></a>
					</div>
					<div class="comment">
						<?php $count = entrada_post_total_reviews($post->ID, true); ?>
						<a href="<?php the_permalink($post->ID); ?>"><?php printf(esc_html(_n('%d Comment', '%d Comments', $count, 'entrada')), $count); ?></a>
					</div>
				</div>
				<ul class="ico-action">
					<?php
					if (shortcode_exists('sharethis_nav')) {
						echo do_shortcode('[sharethis_nav post_id="' . get_the_ID() . '"]');
					}

					?>
				</ul>
			</footer>
			<div class="link-view">
				<a href="<?php the_permalink($post->ID); ?>"><?php _e('VIEW POST',  'entrada'); ?></a>
			</div>
		</div>
	</div>
</article>