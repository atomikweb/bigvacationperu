<?php
$posts_per_page = 6;
$posts_per_page_check = get_theme_mod('search_posts_per_page');
if (isset($posts_per_page_check) && !empty($posts_per_page_check)) {
	$posts_per_page = get_theme_mod('search_posts_per_page');
}
$args = array(
	'post_type' => 'product',
	'posts_per_page' => $posts_per_page,
	'paged' => 1
);
$args = entrada_product_type_meta_query($args, 'tour');
$loop = new WP_Query($args); ?>
<div class="content-block content-sub">
	<div class="container">
		<!-- filter options of the page -->
		<div class="filter-option">
			<div class="layout-action">
				<a href="javascript:void(null);" id="view_list" class="link link-list"><span class="icon-list"></span></a>
				<a href="javascript:void(null);" id="view_grid" class="link link-grid active"><span class="icon-grid"></span></a>
			</div>
			<div class="select-holder">
				<a href="#" class="btn btn-primary btn-filter"><i class="fa fa-sliders"></i> <?php _e('Filter',  'entrada'); ?></a>
				<div class="filter-slide">
					<div class="select-col">
						<select class="filter-select" id="filter_holiday_type">
							<option value="" class="hideme"><?php _e('Holiday Type',  'entrada'); ?></option>
							<option value=""><?php _e('All Holiday Types',  'entrada'); ?></option>
							<?php
							$holiday_types = get_terms('holiday_type', 'hide_empty=0');
							if ($holiday_types) {
								foreach ($holiday_types as $holiday_type) {
									?>
									<option value="<?php echo esc_attr($holiday_type->slug);  ?>">
										<?php echo sprintf(__('%s', 'entrada'), $holiday_type->name); ?>
									</option>
							<?php
								}
							} ?>
						</select>
					</div>
					<div class="select-col">
						<?php echo entrada_custom_taxonomy_in_optgroup('destination', 'filter_destination', 'filter-select', 'filter_destination', $current_selected = ''); ?>
					</div>
					<div class="select-col">
						<select class="filter-select" id="filter_activity_level">
							<option value="" class="hideme"><?php _e('Difficulty',  'entrada'); ?></option>
							<option value=""><?php _e('All Difficulties',  'entrada'); ?></option>
							<?php
							$activity_levels_array 	= array();
							$activity_levels 		= get_terms('activity_level', 'orderby=id&order=asc&hide_empty=0');
							if ($activity_levels) {
								foreach ($activity_levels as $activity_level) {
									$term_meta 		= get_option("taxonomy_" . $activity_level->term_id);
									$taxonomy_value = esc_attr($term_meta['activity_level_val']);

									$activity_levels_array[$taxonomy_value]	= array(
										'name' 	  => $activity_level->name,
										'slug' 	  => $activity_level->slug,
										'term_id' => $activity_level->term_id,
									);
								}
								ksort($activity_levels_array);
								if (isset($activity_levels_array) && count($activity_levels_array) > 0) {
									foreach ($activity_levels_array as $key => $val) { ?>
										<option value="<?php echo esc_attr($val['slug']); ?>"><?php echo sprintf(__('%s', 'entrada'), $val['name']); ?></option>
							<?php
									}
								}
							} ?>
						</select>
					</div>
					<div class="select-col">
						<select class="filter-select filter_by_order">
							<option value="sort"><?php _e('Sort Order',  'entrada'); ?></option>
							<option value="alphabet"><?php _e('Alphabet',  'entrada'); ?></option>
							<option value="price"><?php _e('Price',  'entrada'); ?></option>
							<option value="popularity"><?php _e('Popular',  'entrada'); ?></option>
							<option value="date"><?php _e('Recent',  'entrada'); ?></option>
						</select>
					</div>
					<div class="select-col">
						<select class="filter-select" id="filter_price_range">
							<option value="" class="hideme"><?php _e('Price Range',  'entrada'); ?></option>
							<option value=""><?php _e('All Price Range',  'entrada'); ?></option>
							<?php entrada_product_price_range(true); ?>
						</select>
					</div>
				</div>
			</div>
		</div>
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
								<p itemprop="description"><?php echo entrada_truncate(get_the_ID(), 30, 120, 'id'); ?></p>
								<a href="<?php the_permalink(); ?>" class="btn btn-default" itemprop="url"><?php echo get_theme_mod('square_button_text', 'explore'); ?></a>
								<footer>
									<ul class="social-networks"><?php echo entrada_social_media_share_btn(get_the_title($loop->ID), get_permalink($loop->ID), $share_txt, $entrada_social_media_share_img); ?>
									</ul>
									<small class="price-prefix"><?php _e('from',  'entrada'); ?></small>
									<span class="price"><span <?php echo entrada_price_schema_micro_data_link(get_the_ID()); ?>><?php entrada_product_price(get_the_ID(), true); ?></span></span>
								</footer>
							</div>
						</article>
				<?php
					endwhile;
				} ?>
			</div>
		</div>
		<!-- pagination  -->
		<nav class="loadmore-wrap text-center">
			<input type="hidden" id="posts_per_page" name="posts_per_page" value="<?php echo esc_attr($posts_per_page); ?>" />
			<input type="hidden" id="paged" name="paged" value="2" />
			<a href="javascript:void(null);" id="load_more_post" class="btn btn-default"><?php _e('LOAD MORE',  'entrada'); ?></a>
		</nav>
	</div>
</div>
<?php get_template_part('template-parts/similar', 'tours'); ?>