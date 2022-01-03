<?php 
/*
Template Name: Listing Full Width (four column grid)
*/
get_header();
global $wp_customize;
while ( have_posts() ) : the_post();
	get_template_part( 'template-parts/banner', 'section' ); ?>
    <main id="main" class="list_grid_view">
	<?php
		$force_display_mode = get_post_meta(get_the_ID(),'force_display_mode', true);  
		$referer = wp_get_referer();
		
		if ( isset( $wp_customize ) ) {
			$view_mode = get_theme_mod( 'view_mode_layout', 'list' );
		}
		else if(!empty($force_display_mode) && (get_permalink(get_the_ID()) != $referer )){
			$view_mode = $force_display_mode;
		}
		else if( isset( $_COOKIE['view_mode'] ) ){
			$view_mode = $_COOKIE['view_mode'];
		}
		else{
			$view_mode = get_theme_mod( 'view_mode_layout', 'list' );
		}
		if( 'grid' == $view_mode ) {
			get_template_part( 'template-parts/grid', 'fourcolumn' );
			echo '<input type="hidden" class="view_mode" value="'.esc_attr( 'grid' ).'">';
			echo '<input type="hidden" class="ajax_action" value="'.esc_attr( 'fourcol' ).'">';
		}
		else{
			get_template_part( 'template-parts/list', 'general' );
			echo '<input type="hidden" class="view_mode" value="'.esc_attr( 'list' ).'">';
			echo '<input type="hidden" class="ajax_action" value="'.esc_attr( 'withdetail' ).'">';
		} ?>
	</main>
<?php endwhile;
get_footer(); ?>