<?php

/**
 * The header for entrada theme.
 *
 * This is the template that displays all of the <head> section and everything up until content div
 *
 *
 * @package Entrada
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<!-- favion -->
	<?php wp_head(); ?>
</head>

<body <?php echo entrada_body_class(); ?>>
	<div class="preloader" id="pageLoad">
		<div class="holder">
			<div class="coffee_cup"></div>
		</div>
	</div>
	<!-- main wrapper of the page -->
	<div id="wrapper">
		<div class="page-wrapper">
			<!-- main header of the page -->
			<?php
			$user_ID 			= get_current_user_id();
			$nav_style 			= '';
			$right_nav_style 	= '';
			$header_class 		= '';
			$v_divider 			= 'v-divider';
			$navbar_property 	= get_theme_mod('navbar_property', 'white-header');
			/* header background */
			if ('dark-header' != $navbar_property) {
				$header_class = $navbar_property . " ";
			}

			/* Top Bar Show */
			$navbar_top = get_theme_mod('navbar_top');
			if (!empty($navbar_top)) {
				$header_class .= "top-header header-v1";
			}

			/* centralized navigation */
			$navbar = get_theme_mod('navbar_style', 'default_navbar');
			if ('centered_navbar' == $navbar && empty($navbar_top)) {
				$nav_style 			= 'nav-center';
				$right_nav_style 	= 'navbar-right';
				$header_class 	   .= 'header-v2';
				$v_divider 			= '';
			}

			/* Logo */
			$hide_logo = $hide_text = 'hide';
			$logo_src 		= get_theme_mod('header_darkbg_logo', get_template_directory_uri() . '/dist/images/logos/logo.svg');
			$gray_logo_src 	= get_theme_mod('header_whitebg_logo', get_template_directory_uri() . '/dist/images/logos/logo-gray.svg');
			$logo_option 	= get_theme_mod('logo_text_image', 'text');
			if ("image" == $logo_option) {
				$hide_logo = '';
			} else if ("text" == $logo_option) {
				$hide_text = '';
				$hide_logo = 'hide';
			}

			/* Primary menu arguments */
			$defaults = array(
				'theme_location'  => 'primary',
				'menu'            => '',
				'container'       => '',
				'container_class' => '',
				'container_id'    => '',
				'menu_class'      => 'nav navbar-nav ' . $nav_style,
				'menu_id'         => '',
				'echo'            => true,
				'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
				'before'          => '',
				'after'           => '',
				'link_before'     => '',
				'link_after'      => '',
				'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'depth'           => 0,
				'walker'          => new wp_bootstrap_navwalker(),
			); ?>
			<header id="header" class="<?php echo esc_attr($header_class); ?>">
				<?php
				if (empty($navbar_top)) { ?>
					<div class="container-fluid">
						<!-- logo -->
						<div class="logo">
							<a href="<?php echo esc_url(home_url('/')); ?>" class="logoanchor">
								<img class="normal <?php echo esc_attr($hide_logo); ?>" src="<?php echo esc_url($logo_src); ?>" alt="<?php echo get_bloginfo('name'); ?>">
								<img class="gray-logo <?php echo esc_attr($hide_logo); ?>" src="<?php echo esc_url($gray_logo_src); ?>" alt="<?php echo get_bloginfo('name'); ?>">
								<span class="header_logo_text <?php echo esc_attr($hide_text); ?> "><?php echo esc_html(get_theme_mod('logo_text', get_bloginfo('name'))); ?></span>
							</a>
						</div>
						<!-- main navigation -->
						<nav class="navbar navbar-default">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle nav-opener" data-toggle="collapse" data-target="#nav">
									<span class="sr-only"><?php _e('Toggle Navigation',  'entrada'); ?></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>
							<!-- main menu items and drop for mobile -->
							<div class="collapse navbar-collapse" id="nav">
								<!-- main navbar -->
								<?php
									if ('centered_navbar' != $navbar) {
										echo '<div class="nav-right">';
									}
									wp_nav_menu($defaults); ?>
								<ul class="nav navbar-nav <?php echo esc_attr($right_nav_style); ?>">
									<?php echo entrada_header_login_icon(); ?>
									<?php echo entrada_cart_info_block(); ?>
									<?php echo entrada_multilang_dropdown(); ?>
									<li class="visible-md visible-lg nav-visible <?php echo esc_attr($v_divider); ?>"><a href="#" class="search-opener"><span class="icon icon-search"></span></a></li>
								</ul>
								<?php
									if ('centered_navbar' != $navbar) {
										echo '</div>';
									} ?>
							</div>
						</nav>
					</div>
				<?php
				} else { ?>
					<div class="header-top">
						<div class="container">
							<ul class="top-user-panel">
								<?php
									$topbar_phone = get_theme_mod('topbar_phone');
									if (!empty($topbar_phone)) {
										$topbar_phone_filtered = preg_replace('/[^0-9]/', '', $topbar_phone);
										echo '<li><a href="tel:' . $topbar_phone_filtered . '"><i class="material-icons">phone_in_talk</i> <span class="text hidden-xs">' . $topbar_phone . '</span></a></li>';
									} ?>
								<?php
									$topbar_email = get_theme_mod('topbar_email');
									if (!empty($topbar_email)) {
										$topbar_email_filtered = preg_replace('/[^0-9]/', '', $topbar_email);
										echo '<li><a href="mailto:' . $topbar_email_filtered . '"><i class="material-icons">email</i> <span class="text hidden-xs">' . $topbar_email . '</span></a></li>';
									} ?>
							</ul>
							<ul class="top-right-panel">
								<?php echo entrada_topbar_login_icon(); ?>
								<?php echo entrada_cart_info_block(); ?>
								<?php echo entrada_multilang_dropdown(); ?>
							</ul>
						</div>
					</div>
					<div class="header-bottom">
						<div class="container">
							<div class="nav-frame">
								<div class="logo">
									<a href="<?php echo esc_url(home_url('/')); ?>" class="logoanchor">
										<img class="normal <?php echo esc_attr($hide_logo); ?>" src="<?php echo esc_url($logo_src); ?>" alt="<?php echo get_bloginfo('name'); ?>">
										<img class="gray-logo <?php echo esc_attr($hide_logo); ?>" src="<?php echo esc_url($gray_logo_src); ?>" alt="<?php echo get_bloginfo('name'); ?>">
										<span class="header_logo_text <?php echo esc_attr($hide_text); ?> "><?php echo esc_html(get_theme_mod('logo_text')); ?></span>
									</a>
								</div>
								<nav class="navbar navbar-default">
									<div class="navbar-header">
										<button type="button" class="navbar-toggle nav-opener" data-toggle="collapse" data-target="#nav">
											<span class="sr-only"><?php _e('Toggle Navigation',  'entrada'); ?></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
										</button>
									</div>
									<!-- main menu items and drop for mobile -->
									<div class="collapse navbar-collapse" id="nav">
										<!-- main navbar -->
										<div class="nav-right">
											<?php wp_nav_menu($defaults);  ?>
											<ul class="nav navbar-nav <?php echo esc_attr($right_nav_style);  ?>">
												<li class="visible-md visible-lg nav-visible"><a href="#" class="search-opener"><i class="material-icons">zoom_in</i></span></a></li>
											</ul>
										</div>
									</div>
								</nav>
							</div>
						</div>
					</div>
				<?php } ?>
				<!-- search form -->
				<?php get_template_part('template-parts/header', 'search'); ?>
			</header>