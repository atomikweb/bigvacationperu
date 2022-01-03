<?php

/**
 * The template for displaying search results pages.
 *
 *
 * @package Entrada
 */
get_header(); ?>
<main id="main">
	<div class="content-block content-sub">
		<div class="container">
			<?php if (have_posts()) {  ?>
				<?php echo get_search_form(); ?>
				<div class="blog-holder">
					<div class="blog-list list-view" id="entrada_content_loader">
						<?php while (have_posts()) : the_post();
								$average_rating =  entrada_post_average_rating(get_the_ID()); ?>
							<article class="article blog-article">
								<div class="thumbnail">
									<?php echo entrada_image_holder(get_the_ID(), array(350, 228));  ?>
									<div class="description">
										<header class="heading">
											<h3><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
											<time class="info-day" datetime="2011-01-12"><?php the_time('jS, M') ?></time>
										</header>
										<p><?php echo entrada_truncate(get_the_excerpt(), 70, 150); ?></p>
										<footer class="meta">
											<div class="star-rating">
												<input class="product_rating" type="hidden" value="<?php echo esc_attr($average_rating); ?>">
												<div class="product_rateYo"></div>
											</div>
											<div class="footer-sub">
												<div class="rate-info">
													<?php _e('Post By',  'entrada'); ?> <a href="#"><?php the_author(); ?></a>
												</div>
												<div class="comment">
													<a href="<?php the_permalink(); ?>"><?php echo entrada_post_total_reviews($post->ID, true); ?> <?php _e('Comments',  'entrada'); ?></a>
												</div>
											</div>
											<ul class="ico-action">
												<?php
														if (shortcode_exists('sharethis_nav')) {
															echo do_shortcode('[sharethis_nav post_id="' . get_the_ID() . '"]');
														}

														?>

											</ul>
										</footer>
										<div class="link-view">
											<a href="<?php the_permalink(); ?>"><?php _e('VIEW POST',  'entrada'); ?></a>
										</div>
									</div>
								</div>
							</article>
						<?php endwhile; ?>
					</div>
				</div>
				<?php echo entrada_page_nav(); ?>
			<?php
			} else { ?>
				<?php echo get_search_form(); ?>
				<div class="blog-holder">
					<div class="blog-list list-view">
						<div class="pagination-wrap">
							<p><?php _e('No blogs were found!', 'entrada'); ?> </p>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</main>
<?php get_footer(); ?>