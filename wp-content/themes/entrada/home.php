<?php

/**
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 *
 * @package Entrada
 */
get_header();
$entrada_wrapper_width = entrada_wrapper_width();
$full_length 	= get_theme_mod('blog_full_onoff');
?>
<main id="main">
	<div class="inner-top">
		<div class="container">
			<h1 class="inner-main-heading"><?php _e('The Blog',  'entrada'); ?></h1>
			<!-- breadcrumb -->
			<nav class="breadcrumbs">
				<?php entrada_custom_breadcrumbs(); ?>
			</nav>
		</div>
	</div>
	<!-- content with sidebar -->
	<div class="content-with-sidebar common-spacing content-left">
		<div class="container">
			<div id="two-columns" class="row">
				<div id="content" class="<?php echo esc_attr($entrada_wrapper_width); ?>">
					<div class="blog-holder">
						<div class="blog-list list-view">
							<?php
							if (have_posts()) :
								while (have_posts()) : the_post(); ?>
									<article class="article blog-article <?php if (is_sticky()) {
																						echo ' sticky';
																					} ?>">
										<div class="thumbnail">

											<div class="<?php echo entrada_description_width(); ?>">

												<header class="heading">
													<h3><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
												</header>
												<p><?php

															if (empty($full_length)) {
																$word 	 = (int) get_theme_mod('blog_excerpt_word_length', 25);
																$char 	 = (int) get_theme_mod('blog_excerpt_char_length', 150);
																$content = entrada_truncate(get_the_ID(), $word, $char, 'id');
															} else {
																$content = get_the_content(get_the_ID());
															}
															echo sprintf(__('%s', 'entrada'), $content); ?></p>
												<div class="link-view">
													<a href="<?php the_permalink(); ?>"><?php _e('VIEW POST',  'entrada'); ?></a>
												</div>
											</div>
										</div>
									</article>
							<?php
								endwhile;
							endif; ?>
						</div>
					</div>
					<?php echo entrada_page_nav(); ?>

				</div>
				<!-- sidebar -->
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>