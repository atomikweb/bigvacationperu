<?php
$search_option = get_theme_mod('search_option');

if (empty($search_option) || $search_option == 'tour-search') :
	?>
	<form class="search-form" action="<?php echo home_url('/find/tours/'); ?>">
		<fieldset>
			<a href="#" class="search-opener hidden-md hidden-lg">
				<span class="icon-search"></span>
			</a>
			<div class="search-wrap">
				<a href="#" class="search-opener close">
					<span class="icon-cross"></span>
				</a>
				<div class="trip-form trip-form-v2 trip-search-main">
					<div class="trip-form-wrap">
						<div class="holder">
							<label><?php _e('Departing',  'entrada'); ?></label>
							<div class='select-holder'>
								<?php echo entrada_header_dateform_selector('start_date'); ?>
							</div>
						</div>
						<div class="holder">
							<label><?php _e('Returning',  'entrada'); ?></label>
							<div class='select-holder'>
								<?php echo entrada_header_dateform_selector('end_date'); ?>
							</div>
						</div>
						<div class="holder">
							<label><?php _e('Select Region',  'entrada'); ?></label>
							<div class='select-holder'>
								<select class="trip-select trip-select-v2 region" name="destination" id="select-region">
									<option value="" class="hideme"><?php _e('Region',  'entrada'); ?></option>
									<option value=""><?php _e('Any Region',  'entrada'); ?></option>
									<?php
										if (class_exists('WooCommerce')) {
											$destinations = get_terms('destination', 'hide_empty=0&parent=0');

											if (!empty($destinations) && !is_wp_error($destinations)) {
												foreach ($destinations as $destination) { ?>
												<option value="<?php echo esc_attr($destination->slug); ?>">
													<?php echo sprintf(__('%s', 'entrada'), $destination->name); ?></option>
									<?php 	}
											}
										}
										?>
								</select>
							</div>
						</div>
						<div class="holder">
							<label><?php _e('Select Activity',  'entrada'); ?></label>
							<div class='select-holder'>
								<select class="trip-select trip-select-v2 acitvity" name="product_cat" id="select-activity">
									<option value="" class="hideme"><?php _e('Activity',  'entrada'); ?></option>
									<option value=""><?php _e('Any Activity',  'entrada'); ?></option>
									<?php
										if (class_exists('WooCommerce')) {
											$featured_cat_ids = entrada_product_featured_categories('prod_iconbar_cat_val');
											$prod_cat_args = array(
												'type'         => 'product',
												'taxonomy'     => 'product_cat',
												'hide_empty'   => 0,
												'include'      => $featured_cat_ids
											);
											$activities = get_categories($prod_cat_args);
											if ($activities) {
												foreach ($activities as $activity) { ?>
												<option value="<?php echo esc_attr($activity->slug);  ?>">
													<?php echo sprintf(__('%s', 'entrada'), $activity->name); ?>
												</option>
									<?php
												}
											}
										} ?>
								</select>
							</div>
						</div>
						<div class="holder">
							<label><?php _e('Price Range',  'entrada'); ?></label>
							<div class='select-holder'>
								<select class="trip-select trip-select-v2 price" name="price_range" id="price-range">
									<option value="" class="hideme"><?php _e('Price',  'entrada'); ?></option>
									<option value=""><?php _e('Any Price Range',  'entrada'); ?></option>
									<?php entrada_product_price_range(true); ?>
								</select>
							</div>
						</div>
						<div class="holder">
							<button class="btn btn-trip btn-trip-v2" type="submit">
								<?php _e('Find Tours',  'entrada'); ?></button>
						</div>
					</div>
				</div>
			</div>
		</fieldset>
	</form>
<?php else : ?>


	<form class="search-form" action="<?php echo home_url(); ?>">
		<fieldset>
			<a href="#" class="search-opener hidden-md hidden-lg">
				<span class="icon-search"></span>
			</a>
			<div class="search-wrap">
				<a href="#" class="search-opener close">
					<span class="icon-cross"></span>
				</a>
				<div class="form-group">
					<input type="text" autocomplete="off" class="form-control" name="s" placeholder="<?php esc_attr_e('Search',  'entrada'); ?>" id="search-input">
				</div>
			</div>
		</fieldset>
	</form>

<?php endif; ?>