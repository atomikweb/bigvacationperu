<?php
$banner_type = get_post_meta(get_the_ID(), 'banner_type', true);
if (isset($banner_type) && $banner_type == 'image') {
	$banner_image_id 	= get_post_meta(get_the_ID(), 'banner_image_id', true);
	$banner_image 		= wp_get_attachment_url($banner_image_id);
	$banner_sub_heading = get_post_meta(get_the_ID(), 'banner_sub_heading', true);
	$banner_heading 	= get_post_meta(get_the_ID(), 'banner_heading', true); ?>
	<section class="banner banner-inner parallax" style="background-image: url('<?php echo esc_url($banner_image); ?>');">
		<div class="banner-text">
			<div class="center-text">
				<div class="container">
					<?php if (isset($banner_heading) && $banner_heading != '') {
							echo '<h1>' . $banner_heading . '</h1>';
						}
						if (isset($banner_sub_heading) && $banner_sub_heading != '') {
							echo '<strong class="subtitle">' . $banner_sub_heading . '</strong>';
						} ?>
					<nav class="breadcrumbs">
						<?php entrada_custom_breadcrumbs(); ?>
					</nav>
				</div>
			</div>
		</div>
	</section>
<?php } ?>