<?php

/**
 * The template for displaying all single posts.
 *
 *
 * @package Entrada
 */

get_header();
$entrada_wrapper_width = entrada_wrapper_width();
$full_length 	= get_theme_mod('blog_full_onoff');
?>

<main id="main">
	<div class="content-with-sidebar common-spacing content-left page-bg-colored">
		<div class="container">
			<?php while (have_posts()) : the_post();	 ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div id="two-columns" class="row">
						<div id="content" class="<?php echo esc_attr($entrada_wrapper_width); ?>">
							<div class="blog-holder">
								<article class="blog-single">
									<?php get_template_part('template-parts/content', 'single');
										// If comments are open or we have at least one comment, load up the comment template.
										if (comments_open() || get_comments_number()) :
											comments_template();
										endif; ?>
								</article>
							</div>
						</div>
						<?php get_sidebar(); ?>
					</div>
				</div>
			<?php endwhile; // End of the loop.
			?>
		</div>
	</div>
</main>
<?php get_footer(); ?>