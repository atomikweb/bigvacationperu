<?php 
/*
Template Name: Contact
*/
get_header();
while ( have_posts() ) : the_post(); 
	get_template_part( 'template-parts/banner', 'section' ); ?>
    <main id="main">
		<?php the_content(); ?>
	</main>
   
<?php endwhile;
get_footer(); ?>