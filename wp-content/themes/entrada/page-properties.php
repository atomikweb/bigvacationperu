<?php 
/*
Template Name: Search Template
*/
global $tpl_listgrid;
global $wp_customize;

/* Choose layout for search */
$posts_per_page = 6;
$posts_per_page_check = get_theme_mod( 'search_posts_per_page'); 
if( isset($posts_per_page_check) && !empty( $posts_per_page_check ) ){
	$posts_per_page = get_theme_mod( 'search_posts_per_page'); 
}	
if( 'filter_on_top' != get_theme_mod( 'search_filter_option_setting') ){
	$layout = 'sidebar'; 
}
else {
	$layout = 'nosidebar';		
}
get_header();
if ( isset( $wp_customize ) ) {
	$view_mode = get_theme_mod( 'view_mode_layout', 'list' );
}
else if( isset( $_COOKIE['view_mode'] ) ){
	$view_mode = $_COOKIE['view_mode'];
}
else{
	$view_mode = get_theme_mod( 'view_mode_layout', 'list' );
}
if( 'grid' == $view_mode ) {
	$tpl_listgrid = 'grid';
	echo '<input type="hidden" class="view_mode" value="grid">';
}
else{
	$tpl_listgrid = 'list';
	echo '<input type="hidden" class="view_mode" value="list">';
}
$args = array(
			'post_type' 		=> 'product',
			'posts_per_page' 	=> $posts_per_page,
			'paged' 			=> 1,
		);
	
/* Search criteria start here 
................................... */
$meta_query = array();
$tax_query = array();

$meta_query[] = array(
					'key' 		=> 'entrada_product_type',
					'value' 	=> 'tour',
					'compare' 	=> '='
			);
			
if(isset($_REQUEST['price_range']) && $_REQUEST['price_range'] != ''){
	$price_range_arr	= explode("-",$_REQUEST['price_range']);
	$meta_query[] 		= array(
							'key' 		=> '_price',
							'value' 	=> $price_range_arr,
							'compare' 	=> 'BETWEEN',
							'type' 		=> 'NUMERIC'
						);			
}		
if(isset($_REQUEST['product_cat']) && $_REQUEST['product_cat'] != ''){
	$product_cat = explode("%", $_REQUEST['product_cat']);
	$tax_query[] = array(
						'taxonomy'	=> 'product_cat',
						'field' 	=> 'slug',
						'terms' 	=> $product_cat
					);
}
if(isset($_REQUEST['destination']) && $_REQUEST['destination'] != ''){
	$tax_query[] = array(
					'taxonomy' 	=> 'destination',
					'field' 	=> 'slug',
					'terms' 	=> $_REQUEST['destination']
				);
}
$tax_query[] = array(
  array(
	'taxonomy' => 'product_visibility',
	'field'    => 'name',
	'terms'    => 'exclude-from-search',
	'operator' => 'NOT IN',
	)
);
if (count( $meta_query ) > 0 ){
	$args['meta_query'] = $meta_query;
}
if (count( $tax_query ) > 0 ){
	$tax_query['relation'] = 'AND';
	$args['tax_query'] = $tax_query;
}

$loop = new WP_Query( $args );
$total_record_count = $loop->found_posts;

/* Dates Range start here ......... */

if((isset($_REQUEST['start_date']) && $_REQUEST['start_date'] != '') || (isset($_REQUEST['end_date']) && $_REQUEST['end_date'] != '')){
	
	$child_posts = array();
		
	if(isset($_REQUEST['start_date']) && $_REQUEST['start_date'] != ''){
		$start_date = date('Y-m-d', strtotime($_REQUEST['start_date']));
	} else {
		$start_date = date('Y-m-d');	
	}
	
	if(isset($_REQUEST['end_date']) && $_REQUEST['end_date'] != ''){
		$end_date = date('Y-m-d', strtotime($_REQUEST['end_date']));
	} else {
		$end_date = date('Y-m-d', strtotime('+10 years'));
	}
	
	$child_posts =	entrada_date_range_meta_query($start_date, $end_date);
	array_push($child_posts, "0");
	
				
	if(count($child_posts) > 0){
		$args['post__in'] = $child_posts; 
	}								
	
} else {
	$start_date = '';
	$end_date  = '';	
	
}


$loop = new WP_Query( $args );
$total_record_count = $loop->found_posts; ?>
<!-- main banner of the page -->
<?php get_template_part( 'template-parts/banner', 'search' ); ?>
    <main id="main">    	
		<?php get_template_part( 'search-templates/search', $layout ); ?>	
    </main>
<?php get_footer(); ?>