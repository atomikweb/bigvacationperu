<?php 

/*
Template Name: Layout - Full Width Wide
*/

get_header();
while ( have_posts() ) : the_post();
get_template_part( 'template-parts/banner', 'section' ); ?> 
     <main id="main">
		<div class="inner-main common-spacing">
			<div class="container-fluid layout-fluid">
				<?php the_title( '<h2>', '</h2>' );
				the_content(); ?>
			</div>
		</div>
	</main>
   
<?php endwhile;
get_footer(); ?>