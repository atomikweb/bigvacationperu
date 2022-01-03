<?php 
/*
Template Name: Blog (Full Width)
*/
get_header();
while ( have_posts() ) : the_post();
	get_template_part( 'template-parts/banner', 'section' ); ?> 
	<main id="main">
		<div class="common-spacing blog-full-width">
			<div class="container">
				<div id="two-columns">
					<div id="content">
						<?php get_template_part( 'template-parts/blog', 'fullwidth' ); ?>
						<input type="hidden" class="blog_ajax_action" value="<?php echo esc_attr( 'entrada_blog_fullwidth' ); ?>">
					</div>
				</div>
			</div>
		</div>
	</main> 
<?php endwhile;
get_footer(); ?>