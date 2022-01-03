<?php

/**
 * The template for displaying 404 pages (not found).
 *
 *
 * @package Entrada
 */
get_header(); ?>
<main id="main">
	<!-- error information holder -->
	<div class="error-holder">
		<div class="container">
			<h1 class="wow zoomIn"><?php esc_html_e('404', 'entrada'); ?></h1>
			<span class="title"><?php esc_html_e('Opps! You have reached Mars!', 'entrada'); ?></span>
			<?php echo get_search_form(); ?>
			<div class="button-holder">
				<a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-md btn-white"><?php _e('go to homepage',  'entrada'); ?></a>
				<a href="javascript:void(null);" onclick="history.go(-1);" class="btn btn-md btn-white"><?php _e('go to previous page',  'entrada'); ?></a>
			</div>
		</div>
	</div>
	<!-- partner list -->
	<?php
	$partner_args = array(
		'post_type' => 'partner',
		'showposts' => -1
	);
	$partners = new WP_Query($partner_args);

	if ($partners->have_posts()) { ?>

		<article class="partner-block bg-light-gray">
			<div class="container">
				<header class="content-heading">
					<h2 class="main-heading"><?php _e('Partner',  'entrada'); ?></h2>
					<span class="main-subtitle"><?php _e('People who always support and endorse our good work',  'entrada'); ?></span>
					<div class="seperator"></div>
				</header>
				<div class="partner-list" id="partner-slide">
					<?php
						while ($partners->have_posts()) : $partners->the_post();
							$partner_img_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
							if (!empty($partner_img_url)) { ?>
							<div class="partner">
								<a href="#">
									<img src="<?php echo esc_url($partner_img_url); ?>" alt="<?php echo get_the_title(); ?>">
									<img class="hover" src="<?php echo esc_url($partner_img_url); ?>" alt="<?php echo get_the_title(); ?>">
								</a>
							</div>
					<?php 							}
						endwhile;
						wp_reset_query(); ?>
				</div>
			</div>
		</article>
	<?php } ?>
</main>

<?php get_footer(); ?>