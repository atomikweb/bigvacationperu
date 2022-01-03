<?php
/*
Template Name: Login/Register
*/
get_header();
while (have_posts()) : the_post(); ?>
	<!-- main banner of the page -->
	<main id="main">
		<!-- top information area -->
		<div class="inner-top">
			<div class="container">
				<h1><?php the_title(); ?></h1>
				<nav class="breadcrumbs">
					<?php entrada_custom_breadcrumbs(); ?>
				</nav>
			</div>
		</div>
		<div class="inner-main common-spacing container">
			<div id="entrada_alert"></div>
			<div class="twocol-form">
				<div class="row">
					<div class="col-md-6">
						<div class="top-box">
							<span class="holder height"><?php _e('Login',  'entrada'); ?></span>
						</div>
						<form id="entrada_login_form" action="#">
							<div class="form-holder">
								<div class="wrap">
									<div class="hold">
										<label for="login_username"><?php _e('Username or Email',  'entrada'); ?></label>
										<input type="text" id="login_username" name="login_username" class="form-control">
									</div>
									<div class="hold">
										<label for="login_password"><?php _e('Password',  'entrada'); ?></label>
										<input type="password" id="login_password" name="login_password" class="form-control">
									</div>
									<div class="btn-hold">
										<input type="hidden" id="redirect_link" value="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
										<button type="submit" class="btn btn-default"><?php _e('Login',  'entrada'); ?></button>
									</div>
									<div class="btn-hold">
										<a href="<?php echo home_url('/'); ?>my-account/lost-password"><?php _e('Lost your password?',  'entrada'); ?></a>
									</div>

								</div>
							</div>
						</form>
					</div>
					<div class="col-md-6">
						<div class="top-box">
							<span class="holder height"><?php _e('Register',  'entrada'); ?></span>
						</div>
						<form id="entrada_register_form" action="#">
							<div class="form-holder">
								<div class="wrap">
									<div class="hold">
										<label for="reg_fname"><?php _e('First Name',  'entrada'); ?></label>
										<input type="text" id="reg_fname" name="reg_fname" class="form-control">
									</div>
									<div class="hold">
										<label for="reg_lname"><?php _e('Last Name',  'entrada'); ?></label>
										<input type="text" id="reg_lname" name="reg_lname" class="form-control">
									</div>
									<div class="hold">
										<label for="reg_username"><?php _e('Username',  'entrada'); ?></label>
										<input type="text" id="reg_username" name="reg_username" class="form-control">
									</div>
									<div class="hold">
										<label for="reg_email"><?php _e('Email',  'entrada'); ?></label>
										<input type="email" id="reg_email" name="reg_email" class="form-control">
									</div>
									<div class="hold">
										<label for="reg_password"><?php _e('Password',  'entrada'); ?></label>
										<input type="password" id="reg_password" name="reg_password" class="form-control">
									</div>
									<div class="btn-hold">
										<button type="submit" class="btn btn-default"><?php _e('Register',  'entrada'); ?></button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>
<?php endwhile;
get_footer(); ?>