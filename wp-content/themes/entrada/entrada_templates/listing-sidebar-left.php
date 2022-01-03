<?php
/*
Template Name: Listing Sidebar (Left)
*/
get_header();
global $wp_customize;
while (have_posts()) : the_post();
	get_template_part('template-parts/banner', 'section');
	$posts_per_page = 6;
	$posts_per_page_check = get_theme_mod('search_posts_per_page');
	if (isset($posts_per_page_check) && !empty($posts_per_page_check)) {
		$posts_per_page = get_theme_mod('search_posts_per_page');
	}
	$args = array(
		'post_type' 		=> 'product',
		'posts_per_page' 	=> $posts_per_page,
		'paged' 			=> 1,
		'orderby' 			=> 'date',
		'order' 			=> 'desc'
	);
	$args = entrada_product_type_meta_query($args, 'tour');
	$loop = new WP_Query($args); ?>
	<main id="main" class="list_grid_view">
		<div class="bg-gray content-with-sidebar list-view-sidebar grid-view-sidebar">
			<div class="container-fluid layout-fluid">
				<div id="two-columns" class="row">
					<!-- sidebar of the page -->
					<aside id="sidebar" class="col-md-4 col-lg-3 sidebar sidebar-list">
						<div class="sidebar-holder">
							<header class="heading">
								<h3><?php _e('FILTER',  'entrada'); ?></h3>
							</header>
							<!-- accordion filters in sidebar -->
							<div class="accordion">
								<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('listingsidebar_widget')) :
									endif; ?>
							</div>
						</div>
					</aside>
					<!-- main content area of the page -->
					<div id="content" class="col-md-8 col-lg-9">
						<!-- filter options -->
						<div class="filter-option filter-box">
							<?php $count = $loop->found_posts; ?>
							<strong class="result-info"><?php printf(esc_html(_n('%d Trip matches your search criteria', '%d Trips match your search criteria', $count, 'entrada')), $count); ?></strong>
							<div class="layout-holder">
								<div class="layout-action">
									<?php
										$list = '';
										$grid = '';
										$force_display_mode = get_post_meta(get_the_ID(), 'force_display_mode', true);
										$referer = wp_get_referer();

										if (isset($wp_customize)) {
											$mode = get_theme_mod('view_mode_layout', 'list');
											if ('list' == $mode) {
												$list = ' active';
											} else {
												$grid = ' active';
											}
										} else if (!empty($force_display_mode) && (get_permalink(get_the_ID()) != $referer)) {
											if ($force_display_mode == 'grid') {
												$grid = ' active';
											} else {
												$list = ' active';
											}
										} else if (isset($_COOKIE['view_mode'])) {
											if (isset($_COOKIE['view_mode']) && $_COOKIE['view_mode'] == 'list') {
												$list = ' active';
											} else if (isset($_COOKIE['view_mode']) && $_COOKIE['view_mode'] == 'grid') {
												$grid = ' active';
											}
										} else {
											$mode = get_theme_mod('view_mode_layout', 'list');
											if ('list' == $mode) {
												$list = ' active';
											} else {
												$grid = ' active';
											}
										} ?>
									<a href="javascript:void(null);" id="view_list" class="link link-list <?php echo esc_attr($list); ?>"><span class="icon-list"></span></a>
									<a href="javascript:void(null);" id="view_grid" class="link link-grid <?php echo esc_attr($grid); ?>"><span class="icon-grid"></span></a>
								</div>
								<div class="select-holder">
									<div class="select-col">
										<select class="filter-select sort-select filter_by_order">
											<option value="<?php echo esc_attr('sort'); ?>"><?php _e('Sort Order',  'entrada'); ?></option>
											<option value="<?php echo esc_attr('alphabet'); ?>"><?php _e('Alphabet',  'entrada'); ?></option>
											<option value="<?php echo esc_attr('price'); ?>"><?php _e('Price',  'entrada'); ?></option>
											<option value="<?php echo esc_attr('popularity'); ?>"><?php _e('Popular',  'entrada'); ?></option>
											<option value="<?php echo esc_attr('date'); ?>"><?php _e('Recent',  'entrada'); ?></option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<?php
							if (isset($wp_customize)) {
								$view_mode = get_theme_mod('view_mode_layout', 'list');
							} else if (!empty($force_display_mode) && (get_permalink(get_the_ID()) != $referer)) {
								$view_mode = $force_display_mode;
							} else if (isset($_COOKIE['view_mode'])) {
								$view_mode = $_COOKIE['view_mode'];
							} else {
								$view_mode = get_theme_mod('view_mode_layout', 'list');
							}
							if ('grid' == $view_mode) {
								get_template_part('template-parts/grid', 'sidebar');
								echo '<input type="hidden" class="view_mode" value="' . esc_attr('grid') . '">';
							} else {
								get_template_part('template-parts/list', 'sidebar');
								echo '<input type="hidden" class="view_mode" value="' . esc_attr('list') . '">';
							}
							echo '<input type="hidden" class="ajax_action" value="' . esc_attr('sidebarleft') . '">'; ?>
						<!-- pagination -->
						<nav class="loadmore-wrap text-center">
							<input type="hidden" id="posts_per_page" name="posts_per_page" value="<?php echo esc_attr($posts_per_page); ?>" />
							<input type="hidden" id="paged" name="paged" value="<?php echo esc_attr(2); ?>" />
							<a href="javascript:void(null);" id="load_more_post" class="btn btn-default"><?php _e('LOAD MORE',  'entrada'); ?></a>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<!-- recent information block of the page -->
		<?php get_template_part('template-parts/similar', 'tours'); ?>
	</main>
<?php endwhile;
get_footer(); ?>