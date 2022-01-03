<?php
$banner_image = '';
$search_banner_check = get_theme_mod('search_banner');
$search_heading_check = get_theme_mod('search_heading');
$search_sub_heading_check = get_theme_mod('search_sub_heading');


if (!empty($search_banner_check)) {
	$banner_image = get_theme_mod('search_banner');
}
if (!empty($search_heading_check)) {
	$banner_heading = get_theme_mod('search_heading');
} else {
	$banner_heading = __('Search Results', 'entrada');
}
if (!empty($search_sub_heading_check)) {
	$banner_sub_heading = get_theme_mod('search_sub_heading');
} else {
	$banner_sub_heading = __('The search results are as follows', 'entrada');
} ?>

<section class="banner banner-inner parallax" style="background-image: url('<?php echo esc_url($banner_image); ?>');">
	<div class="banner-text">
		<div class="center-text">
			<div class="container">
				<?php
				echo '<h1>' . $banner_heading . '</h1>';
				echo '<strong class="subtitle">' . $banner_sub_heading . '</strong>'; ?>
				<nav class="breadcrumbs">
					<ul>
						<li><a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('HOME',  'entrada'); ?></a></li>
						<li><?php _e('SEARCH',  'entrada'); ?></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</section>