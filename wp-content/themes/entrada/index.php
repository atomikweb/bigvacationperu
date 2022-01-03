<?php

/**
 * The main template file.
 *
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
									<article class="article blog-article">
										<div class="thumbnail">

											<div class="description">

												<header class="heading">
													<h3><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
												</header>
												<p><?php echo entrada_truncate(strip_tags(get_the_content()), 70, 150); ?></p>
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
				</div>
				<!-- sidebar -->
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>