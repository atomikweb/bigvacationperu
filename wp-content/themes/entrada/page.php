<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 *
 * @package Entrada
 */
get_header();
while ( have_posts() ) : the_post();
	get_template_part( 'template-parts/banner', 'section' ); ?>
	<main id="main">
	<?php get_template_part( 'template-parts/content', 'page' ); ?>
	</main>
<?php endwhile;
get_footer(); ?>