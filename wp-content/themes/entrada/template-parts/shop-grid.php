<div class="container">
	<?php
	global $vendor_id;
	global $vendor_page;
	global $vendor_shop;
	$posts_per_page = get_theme_mod('woo_listing_per_page', 6);

	if (('yes' == $vendor_page) && ($vendor_id)) {
		$args = array(
			'post_type' 		=> 'product',
			'posts_per_page'	=> $posts_per_page,
			'paged' 			=> 1,
			'author'			=> $vendor_id,
		);
	} else {
		$args = array(
			'post_type' 		=> 'product',
			'posts_per_page'	=> $posts_per_page,
			'paged' 			=> 1,
		);
		$args = entrada_product_type_meta_query($args, 'shop_item');
	}
	$shop_loop = new WP_Query($args);
	if ($shop_loop->have_posts()) { ?>
		<div class="content-holder content-sub-holder">
			<div class="row db-3-col" id="entrada_content_loader">
				<?php
					while ($shop_loop->have_posts()) : $shop_loop->the_post();
						$entrada_social_media_share_img = '';
						$share_txt = entrada_truncate(get_the_ID(), 30, 120, 'id');
						$average_rating =  entrada_post_average_rating(get_the_ID()); ?>
					<article class="col-sm-6 col-md-4 article has-hover-s1">
						<div class="thumbnail" itemscope itemtype="http://schema.org/Product">
							<?php
									$entrada_social_media_share_img =  entrada_social_media_share_img(get_the_ID());
									?>
							<!--Wrap image inside a href to make image clickable -->
							<a href="<?php the_permalink(); ?>" itemprop="name"> <?php echo entrada_product_resized_img(get_the_ID(), $resize = array(550, 358)); ?> </a>
							<h3 class="small-space"><a href="<?php the_permalink(); ?>" itemprop="name"><?php the_title(); ?></a></h3>
							<p itemprop="description"><?php echo entrada_truncate(get_the_ID(), 30, 120, 'id'); ?></p>
							<a href="<?php the_permalink(); ?>" class="btn btn-default" itemprop="url"><?php echo get_theme_mod('square_button_text', 'explore'); ?></a>
							<footer>
								<ul class="social-networks"><?php echo entrada_social_media_share_btn(get_the_title($shop_loop->ID), get_permalink($shop_loop->ID), $share_txt, $entrada_social_media_share_img); ?>
								</ul>
								<small class="price-prefix"><?php _e('from',  'entrada'); ?></small>
								<span class="price"><span <?php echo entrada_price_schema_micro_data_link(get_the_ID()); ?>><?php entrada_product_price(get_the_ID(), true); ?></span></span>
							</footer>
						</div>
					</article>
				<?php endwhile; ?>
			</div>
		</div>
		<nav class="loadmore-wrap text-center">
			<input type="hidden" id="posts_per_page" name="posts_per_page" value="<?php echo esc_attr($posts_per_page); ?>" />
			<input type="hidden" id="vendor_page" name="vendor_page" value="<?php echo esc_attr($vendor_page); ?>" />
			<input type="hidden" id="vendor_shop" name="vendor_shop" value="<?php echo esc_attr($vendor_shop); ?>" />
			<input type="hidden" id="paged" name="paged" value="2" />
			<a href="javascript:void(null);" id="load_more_shop_post" class="btn btn-default"><?php _e('LOAD MORE',  'entrada'); ?></a>
		</nav>
	<?php
	} else {
		$no_product_meaage =  'No products were found matching your selection.';
		echo sprintf(__('<p class="woocommerce-info"> %s </p>', 'entrada'), $no_product_meaage);
	} ?>
</div>