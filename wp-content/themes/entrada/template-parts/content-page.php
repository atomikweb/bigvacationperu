<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Entrada
 */$banner_type = get_post_meta(get_the_ID(),'banner_type', true);
if(empty($banner_type) || $banner_type == 'color') { ?>
	<div class="inner-top">
		<div class="container">
			<?php the_title( '<h1 class="inner-main-heading">', '</h1>' ); ?>
			<nav class="breadcrumbs">
				<?php entrada_custom_breadcrumbs(); ?>
			</nav>
		</div>
	</div>
<?php } ?>
<div class="inner-main common-spacing container page-content-inner">
	<?php
		echo '<div class="blog-single page-content">';
		the_content();
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'entrada' ),
			'after'  => '</div>',
		) );
		echo '</div>';
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif; ?>
</div>