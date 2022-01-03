<?php

/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Entrada
 */
$entrada_avg_rate = entrada_post_average_rating(get_the_ID());
if (!empty($entrada_avg_rate)) {
	$average_rating =  entrada_post_average_rating(get_the_ID());
} else {
	$average_rating = 0;
}
echo entrada_image_holder(get_the_ID(), array(870, 480));  ?>
<div class="description">
	<h1 class="content-main-heading"><?php the_title(); ?></h1>
	<?php the_content(); ?>
	<footer class="meta-article">

		<div class="footer-sub">
			<div class="rate-info">
				<?php _e('Post by',  'entrada'); ?> <a href="#"><?php the_author(); ?></a>
			</div>

			<div class="comment">
				<?php $count = entrada_post_total_reviews(get_the_ID(), true); ?>
				<a href="<?php the_permalink(get_the_ID()); ?>"><?php printf(esc_html(_n('%d Comment', '%d Comments', $count, 'entrada')), $count); ?></a>
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
</div>
<?php entrada_page_nav(); ?>