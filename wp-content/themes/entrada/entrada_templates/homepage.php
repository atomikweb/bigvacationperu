<?php

/**
 *  Template Name: Home Page
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 *
 * @package Entrada
 */
global $wp;
$url_part = add_query_arg(array(), $wp->request);
if (strpos($url_part, 'center') !== false) {
	get_header('centered');
} else if (strpos($url_part, 'top') !== false) {
	get_header('top');
} else {
	get_header();
} ?>
<main id="main">
	<?php
	while (have_posts()) : the_post();
		the_content();
		if (comments_open() || get_comments_number()) :
			comments_template();
		endif;
	endwhile; ?>
</main>
<?php get_footer(); ?>