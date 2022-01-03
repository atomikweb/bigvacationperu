<?php
/*
Template Name: Blog (Default)
*/
get_header();
$entrada_wrapper_width = entrada_wrapper_width();
while (have_posts()) : the_post();
	get_template_part('template-parts/banner', 'section'); ?>
	<main id="main">
		<div class="content-with-sidebar common-spacing content-left page-bg-colored">
			<div class="container">
				<div id="two-columns" class="row">
					<div id="content" class='<?php echo esc_attr($entrada_wrapper_width); ?>'>
						<?php get_template_part('template-parts/blog', 'default'); ?>
						<input type="hidden" class="blog_ajax_action" value="<?php echo esc_attr('entrada_blog_defaultview', 'entrada'); ?>">
					</div>
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</main>
<?php endwhile;
get_footer(); ?>