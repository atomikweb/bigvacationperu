<?php 

/*
Template Name: Layout - Sidebar Left
*/

get_header();
while ( have_posts() ) : the_post(); 
	get_template_part( 'template-parts/banner', 'section' ); ?> 
    <main id="main">
		<div class="content-with-sidebar common-spacing">
			<div class="container">
				<div id="two-columns" class="row">
					<div id="content" class="col-sm-8 col-md-9">
					<?php the_title( '<h2>', '</h2>' ); 
					the_content(); ?>
					</div>
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</main>
<?php endwhile;
get_footer(); ?>