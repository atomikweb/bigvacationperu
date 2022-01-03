<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Entrada
 */

$average_rating =  entrada_post_average_rating(get_the_ID());
?>
<article class="article blog-article">     
	<div class="description">
		<header class="heading">
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		</header>
		<p><?php echo entrada_truncate(strip_tags(get_the_content()), 50, 130); ?></p>

		<div class="link-view">
			<a href="<?php the_permalink(); ?>" class="btn btn-primery"><?php echo get_theme_mod( 'square_button_text', 'explore' ); ?></a>
		</div>
	</div>

</article>