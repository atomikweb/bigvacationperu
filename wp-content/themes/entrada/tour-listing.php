<?php
/*
Template Name: Search Template
*/
global $tpl_listgrid;
global $wp_customize;

/* Choose layout for search */
$posts_per_page = 6;
if (!empty(get_theme_mod('search_posts_per_page'))) {
	$posts_per_page = get_theme_mod('search_posts_per_page');
}

get_header();

$meta_query = array();
$tax_query = array();

$args = array(
	'post_type' 		=> 'product',
	'posts_per_page' 	=> $posts_per_page,
	'paged' 			=> 1,
);

$args = entrada_product_type_meta_query($args, 'tour');

$loop = new WP_Query($args);
$total_record_count = $loop->found_posts;

?>
<!-- main banner of the page -->
<?php get_template_part('template-parts/banner', 'search'); ?>
<main id="main" class="list_grid_view">

	<div class="content-block content-sub">
		<div class="container">

			<!-- main content of the page -->
			<div class="content-holder content-sub-holder">
				<div class="row db-3-col" id="entrada_content_loader">
					<?php
					if ($loop->have_posts()) {
						while ($loop->have_posts()) : $loop->the_post();
							$entrada_social_media_share_img = '';
							$share_txt = entrada_truncate(get_the_ID(), 30, 120, 'id'); ?>
							<article class="col-sm-6 col-md-4 article has-hover-s1">
								<div class="thumbnail" itemscope itemtype="http://schema.org/Product">
									<?php
											$entrada_social_media_share_img =  entrada_social_media_share_img(get_the_ID());
											?>
									<!--Wrap image inside a href to make image clickable -->
									<a href="<?php the_permalink(); ?>" itemprop="name"> <?php echo entrada_product_resized_img(get_the_ID(), $resize = array(550, 358)); ?> </a>
									<h3 class="small-space"><a href="<?php the_permalink(); ?>" itemprop="name"><?php the_title(); ?></a></h3>
									<span class="info"><?php entrada_product_categories(get_the_ID(), true); ?></span>
									<aside class="meta">
										<?php entrada_destinations_activities_count(get_the_ID(), true); ?>
									</aside>
									<p itemprop="description"><?php echo entrada_truncate(strip_tags(get_the_content()), 30, 120); ?></p>
									<a href="<?php the_permalink(); ?>" class="btn btn-default" itemprop="url"><?php echo get_theme_mod('square_button_text', 'explore'); ?></a>
									<footer>
										<ul class="social-networks"><?php echo entrada_social_media_share_btn(get_the_title($loop->ID), get_permalink($loop->ID), $share_txt, $entrada_social_media_share_img); ?>
										</ul>
										<span class="price"><?php _e('from',  'entrada'); ?> <span <?php echo entrada_price_schema_micro_data_link(get_the_ID()); ?>><?php entrada_product_price(get_the_ID(), true); ?></span></span>
									</footer>
								</div>
							</article>
					<?php
						endwhile;
					} ?>
				</div>
			</div>
			<!-- pagination  -->
			<?php if ($total_record_count > 0) { ?>
				<nav class="loadmore-wrap text-center">
					<input type="hidden" id="posts_per_page" name="posts_per_page" value="<?php echo esc_attr($posts_per_page); ?>" />
					<input type="hidden" id="paged" name="paged" value="2" />
					<input type="hidden" class="view_mode" value="grid">
					<input type="hidden" class="ajax_action" value="threecol">
					<a href="javascript:void(null);" id="load_more_post" class="btn btn-default"><?php _e('LOAD MORE',  'entrada'); ?></a>
				</nav>
			<?php } ?>
		</div>
	</div>

</main>
<?php get_footer(); ?>