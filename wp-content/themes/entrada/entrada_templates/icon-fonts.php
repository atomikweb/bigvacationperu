<?php 
/*
Template Name: Icon Fonts
*/
get_header(); 
	while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'template-parts/banner', 'section' ); ?>
		<main id="main">
		<?php
			$banner_type = get_post_meta(get_the_ID(),'banner_type', true);
			if(empty($banner_type) || $banner_type == 'color') { ?>
				<div class="inner-top">
					<div class="container">
						<?php the_title( '<h1 class="inner-main-heading">', '</h1>' ); ?>
						<nav class="breadcrumbs">
							<?php entrada_custom_breadcrumbs(); ?>
						</nav>
					</div>
				</div>
			<?php } ?>
			<div class="inner-main common-spacing container font-demo-wrapper">
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-airplane">
							
							</span>
							<span class="mls"> icon-airplane</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-athens">
							
							</span>
							<span class="mls"> icon-athens</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-axe-1">
							
							</span>
							<span class="mls"> icon-axe-1</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-axe">
							
							</span>
							<span class="mls"> icon-axe</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-backpacking">
							
							</span>
							<span class="mls"> icon-backpacking</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-backpaker-2">
							
							</span>
							<span class="mls"> icon-backpaker-2</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-bag">
							
							</span>
							<span class="mls"> icon-bag</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-balloon">
							
							</span>
							<span class="mls"> icon-balloon</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-beanie">
							
							</span>
							<span class="mls"> icon-beanie</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-binoculars-1">
							
							</span>
							<span class="mls"> icon-binoculars-1</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-binoculars-2">
							
							</span>
							<span class="mls"> icon-binoculars-2</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-binoculars">
							
							</span>
							<span class="mls"> icon-binoculars</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-bonfire">
							
							</span>
							<span class="mls"> icon-bonfire</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-bow-arrow">
							
							</span>
							<span class="mls"> icon-bow-arrow</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-bowling-pin">
							
							</span>
							<span class="mls"> icon-bowling-pin</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-briefcase">
							
							</span>
							<span class="mls"> icon-briefcase</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-burj-khalifa">
							
							</span>
							<span class="mls"> icon-burj-khalifa</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-cab">
							
							</span>
							<span class="mls"> icon-cab</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-cabin">
							
							</span>
							<span class="mls"> icon-cabin</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-camp-chair">
							
							</span>
							<span class="mls"> icon-camp-chair</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-campfire-1">
							
							</span>
							<span class="mls"> icon-campfire-1</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-campfire">
							
							</span>
							<span class="mls"> icon-campfire</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-canal-house">
							
							</span>
							<span class="mls"> icon-canal-house</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-canopy-walking">
							
							</span>
							<span class="mls"> icon-canopy-walking</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-car-luggage">
							
							</span>
							<span class="mls"> icon-car-luggage</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-car">
							
							</span>
							<span class="mls"> icon-car</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-carabiner">
							
							</span>
							<span class="mls"> icon-carabiner</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-christ">
							
							</span>
							<span class="mls"> icon-christ</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-climbing-rope">
							
							</span>
							<span class="mls"> icon-climbing-rope</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-coffee-set">
							
							</span>
							<span class="mls"> icon-coffee-set</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-compass-small">
							
							</span>
							<span class="mls"> icon-compass-small</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-compass">
							
							</span>
							<span class="mls"> icon-compass</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-country-skiing">
							
							</span>
							<span class="mls"> icon-country-skiing</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-cruise-ship">
							
							</span>
							<span class="mls"> icon-cruise-ship</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-directions">
							
							</span>
							<span class="mls"> icon-directions</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-door-sign">
							
							</span>
							<span class="mls"> icon-door-sign</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-eiffel">
							
							</span>
							<span class="mls"> icon-eiffel</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-fir-tree">
							
							</span>
							<span class="mls"> icon-fir-tree</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-fishing-rod">
							
							</span>
							<span class="mls"> icon-fishing-rod</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-fishing">
							
							</span>
							<span class="mls"> icon-fishing</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-flash-light">
							
							</span>
							<span class="mls"> icon-flash-light</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-globe-1">
							
							</span>
							<span class="mls"> icon-globe-1</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-grill">
							
							</span>
							<span class="mls"> icon-grill</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-hang-glider">
							
							</span>
							<span class="mls"> icon-hang-glider</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-helecopter-1">
							
							</span>
							<span class="mls"> icon-helecopter-1</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-helecopter">
							
							</span>
							<span class="mls"> icon-helecopter</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-hiking-1">
							
							</span>
							<span class="mls"> icon-hiking-1</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-hiking-poles">
							
							</span>
							<span class="mls"> icon-hiking-poles</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-hot-air-balloon">
							
							</span>
							<span class="mls"> icon-hot-air-balloon</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-information-circle">
							
							</span>
							<span class="mls"> icon-information-circle</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-information">
							
							</span>
							<span class="mls"> icon-information</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-jeep-1">
							
							</span>
							<span class="mls"> icon-jeep-1</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-jeep-2">
							
							</span>
							<span class="mls"> icon-jeep-2</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-kayak-1">
							
							</span>
							<span class="mls"> icon-kayak-1</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-kayak">
							
							</span>
							<span class="mls"> icon-kayak</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-key">
							
							</span>
							<span class="mls"> icon-key</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-knife">
							
							</span>
							<span class="mls"> icon-knife</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-lantren">
							
							</span>
							<span class="mls"> icon-lantren</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-life-vest">
							
							</span>
							<span class="mls"> icon-life-vest</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-lighter">
							
							</span>
							<span class="mls"> icon-lighter</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-london">
							
							</span>
							<span class="mls"> icon-london</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-map-1">
							
							</span>
							<span class="mls"> icon-map-1</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-map-2">
							
							</span>
							<span class="mls"> icon-map-2</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-map-3">
							
							</span>
							<span class="mls"> icon-map-3</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-map-4">
							
							</span>
							<span class="mls"> icon-map-4</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-map-marker">
							
							</span>
							<span class="mls"> icon-map-marker</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-motorcycle">
							
							</span>
							<span class="mls"> icon-motorcycle</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-mountain-2">
							
							</span>
							<span class="mls"> icon-mountain-2</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-mountain-3">
							
							</span>
							<span class="mls"> icon-mountain-3</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-mountain-1">
							
							</span>
							<span class="mls"> icon-mountain-1</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-mug">
							
							</span>
							<span class="mls"> icon-mug</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-off-road">
							
							</span>
							<span class="mls"> icon-off-road</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-opera-house">
							
							</span>
							<span class="mls"> icon-opera-house</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-palm-tree-2">
							
							</span>
							<span class="mls"> icon-palm-tree-2</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-palm-tree-1">
							
							</span>
							<span class="mls"> icon-palm-tree-1</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-parachute">
							
							</span>
							<span class="mls"> icon-parachute</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-paraglide">
							
							</span>
							<span class="mls"> icon-paraglide</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-passport">
							
							</span>
							<span class="mls"> icon-passport</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-picnic-table">
							
							</span>
							<span class="mls"> icon-picnic-table</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-pilot">
							
							</span>
							<span class="mls"> icon-pilot</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-pocket-knife">
							
							</span>
							<span class="mls"> icon-pocket-knife</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-rafting">
							
							</span>
							<span class="mls"> icon-rafting</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-road">
							
							</span>
							<span class="mls"> icon-road</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-rowing">
							
							</span>
							<span class="mls"> icon-rowing</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-sailboat">
							
							</span>
							<span class="mls"> icon-sailboat</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-ship">
							
							</span>
							<span class="mls"> icon-ship</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-sight-seeing">
							
							</span>
							<span class="mls"> icon-sight-seeing</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-signpost">
							
							</span>
							<span class="mls"> icon-signpost</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-silver-ware">
							
							</span>
							<span class="mls"> icon-silver-ware</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-ski-boot">
							
							</span>
							<span class="mls"> icon-ski-boot</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-ski-diving">
							
							</span>
							<span class="mls"> icon-ski-diving</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-ski-tour">
							
							</span>
							<span class="mls"> icon-ski-tour</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-suitcase">
							
							</span>
							<span class="mls"> icon-suitcase</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-sun">
							
							</span>
							<span class="mls"> icon-sun</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-suv">
							
							</span>
							<span class="mls"> icon-suv</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-tent-1">
							
							</span>
							<span class="mls"> icon-tent-1</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-icon-set-1_tent">
							
							</span>
							<span class="mls"> icon-icon-set-1_tent</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-tourist">
							
							</span>
							<span class="mls"> icon-tourist</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-train">
							
							</span>
							<span class="mls"> icon-train</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-zipline">
							
							</span>
							<span class="mls"> icon-zipline</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-instagram">
							
							</span>
							<span class="mls"> icon-instagram</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-youtube">
							
							</span>
							<span class="mls"> icon-youtube</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-cart-add">
							
							</span>
							<span class="mls"> icon-cart-add</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-user-add">
							
							</span>
							<span class="mls"> icon-user-add</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-download">
							
							</span>
							<span class="mls"> icon-download</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-remove-favourite">
							
							</span>
							<span class="mls"> icon-remove-favourite</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-heart">
							
							</span>
							<span class="mls"> icon-heart</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-reply">
							
							</span>
							<span class="mls"> icon-reply</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-level7">
							
							</span>
							<span class="mls"> icon-level7</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-acitivities">
							
							</span>
							<span class="mls"> icon-acitivities</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-africa">
							
							</span>
							<span class="mls"> icon-africa</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-angle-down">
							
							</span>
							<span class="mls"> icon-angle-down</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-arctic">
							
							</span>
							<span class="mls"> icon-arctic</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-arrow-left">
							
							</span>
							<span class="mls"> icon-arrow-left</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-arrow-down">
							
							</span>
							<span class="mls"> icon-arrow-down</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-angle-right">
							
							</span>
							<span class="mls"> icon-angle-right</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-arrow-right">
							
							</span>
							<span class="mls"> icon-arrow-right</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-asia">
							
							</span>
							<span class="mls"> icon-asia</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-beach">
							
							</span>
							<span class="mls"> icon-beach</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-big-cat">
							
							</span>
							<span class="mls"> icon-big-cat</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-bird">
							
							</span>
							<span class="mls"> icon-bird</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-boat">
							
							</span>
							<span class="mls"> icon-boat</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-boating">
							
							</span>
							<span class="mls"> icon-boating</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-budget">
							
							</span>
							<span class="mls"> icon-budget</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-bulb">
							
							</span>
							<span class="mls"> icon-bulb</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-bungee">
							
							</span>
							<span class="mls"> icon-bungee</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-camping">
							
							</span>
							<span class="mls"> icon-camping</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-cart">
							
							</span>
							<span class="mls"> icon-cart</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-cross">
							
							</span>
							<span class="mls"> icon-cross</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-culture">
							
							</span>
							<span class="mls"> icon-culture</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-culture1">
							
							</span>
							<span class="mls"> icon-culture1</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-cup">
							
							</span>
							<span class="mls"> icon-cup</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-desert">
							
							</span>
							<span class="mls"> icon-desert</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-diamond">
							
							</span>
							<span class="mls"> icon-diamond</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-distance">
							
							</span>
							<span class="mls"> icon-distance</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-dolphin-60">
							
							</span>
							<span class="mls"> icon-dolphin-60</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-dolphin-76">
							
							</span>
							<span class="mls"> icon-dolphin-76</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-dribble">
							
							</span>
							<span class="mls"> icon-dribble</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-drop">
							
							</span>
							<span class="mls"> icon-drop</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-duration">
							
							</span>
							<span class="mls"> icon-duration</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-egypt">
							
							</span>
							<span class="mls"> icon-egypt</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-email">
							
							</span>
							<span class="mls"> icon-email</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-europe">
							
							</span>
							<span class="mls"> icon-europe</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-facebook">
							
							</span>
							<span class="mls"> icon-facebook</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-family">
							
							</span>
							<span class="mls"> icon-family</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-favs">
							
							</span>
							<span class="mls"> icon-favs</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-fax-big">
							
							</span>
							<span class="mls"> icon-fax-big</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-fax">
							
							</span>
							<span class="mls"> icon-fax</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-filter">
							
							</span>
							<span class="mls"> icon-filter</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-fish-jumping">
							
							</span>
							<span class="mls"> icon-fish-jumping</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-food-wine">
							
							</span>
							<span class="mls"> icon-food-wine</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-foot-step">
							
							</span>
							<span class="mls"> icon-foot-step</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-foots">
							
							</span>
							<span class="mls"> icon-foots</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-globe">
							
							</span>
							<span class="mls"> icon-globe</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-google-plus">
							
							</span>
							<span class="mls"> icon-google-plus</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-grid">
							
							</span>
							<span class="mls"> icon-grid</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-group-large">
							
							</span>
							<span class="mls"> icon-group-large</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-group-medium">
							
							</span>
							<span class="mls"> icon-group-medium</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-group-small">
							
							</span>
							<span class="mls"> icon-group-small</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-hiking-camping">
							
							</span>
							<span class="mls"> icon-hiking-camping</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-home">
							
							</span>
							<span class="mls"> icon-home</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-hunting">
							
							</span>
							<span class="mls"> icon-hunting</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-jeep">
							
							</span>
							<span class="mls"> icon-jeep</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-jungle">
							
							</span>
							<span class="mls"> icon-jungle</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-level1">
							
							</span>
							<span class="mls"> icon-level1</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-level2">
							
							</span>
							<span class="mls"> icon-level2</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-level3">
							
							</span>
							<span class="mls"> icon-level3</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-level4">
							
							</span>
							<span class="mls"> icon-level4</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-level5">
							
							</span>
							<span class="mls"> icon-level5</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-level6">
							
							</span>
							<span class="mls"> icon-level6</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-level8">
							
							</span>
							<span class="mls"> icon-level8</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-linkedin">
							
							</span>
							<span class="mls"> icon-linkedin</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-list">
							
							</span>
							<span class="mls"> icon-list</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-locals">
							
							</span>
							<span class="mls"> icon-locals</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-lock">
							
							</span>
							<span class="mls"> icon-lock</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-luggage">
							
							</span>
							<span class="mls"> icon-luggage</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-middle-east">
							
							</span>
							<span class="mls"> icon-middle-east</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-minus-normal">
							
							</span>
							<span class="mls"> icon-minus-normal</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-plus-normal">
							
							</span>
							<span class="mls"> icon-plus-normal</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-minus">
							
							</span>
							<span class="mls"> icon-minus</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-mount">
							
							</span>
							<span class="mls"> icon-mount</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-mountain-biking">
							
							</span>
							<span class="mls"> icon-mountain-biking</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-mountain">
							
							</span>
							<span class="mls"> icon-mountain</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-music">
							
							</span>
							<span class="mls"> icon-music</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-north-america">
							
							</span>
							<span class="mls"> icon-north-america</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-panda">
							
							</span>
							<span class="mls"> icon-panda</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-peak-climbing">
							
							</span>
							<span class="mls"> icon-peak-climbing</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-peak">
							
							</span>
							<span class="mls"> icon-peak</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-penguin">
							
							</span>
							<span class="mls"> icon-penguin</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-person-budget">
							
							</span>
							<span class="mls"> icon-person-budget</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-person">
							
							</span>
							<span class="mls"> icon-person</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-tel">
							
							</span>
							<span class="mls"> icon-tel</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-pin">
							
							</span>
							<span class="mls"> icon-pin</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-plane">
							
							</span>
							<span class="mls"> icon-plane</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-plant">
							
							</span>
							<span class="mls"> icon-plant</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-plus">
							
							</span>
							<span class="mls"> icon-plus</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-rural">
							
							</span>
							<span class="mls"> icon-rural</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-scuba-diving">
							
							</span>
							<span class="mls"> icon-scuba-diving</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-search">
							
							</span>
							<span class="mls"> icon-search</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-share">
							
							</span>
							<span class="mls"> icon-share</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-snow-ice">
							
							</span>
							<span class="mls"> icon-snow-ice</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-star">
							
							</span>
							<span class="mls"> icon-star</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-step">
							
							</span>
							<span class="mls"> icon-step</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-sunny">
							
							</span>
							<span class="mls"> icon-sunny</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-tel-big">
							
							</span>
							<span class="mls"> icon-tel-big</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-tent">
							
							</span>
							<span class="mls"> icon-tent</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-tick">
							
							</span>
							<span class="mls"> icon-tick</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-trash">
							
							</span>
							<span class="mls"> icon-trash</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-tree">
							
							</span>
							<span class="mls"> icon-tree</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-hiking">
							
							</span>
							<span class="mls"> icon-hiking</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-twitter">
							
							</span>
							<span class="mls"> icon-twitter</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-urban">
							
							</span>
							<span class="mls"> icon-urban</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-vimeo">
							
							</span>
							<span class="mls"> icon-vimeo</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-water-sea">
							
							</span>
							<span class="mls"> icon-water-sea</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-water-spot">
							
							</span>
							<span class="mls"> icon-water-spot</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-water">
							
							</span>
							<span class="mls"> icon-water</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-weight">
							
							</span>
							<span class="mls"> icon-weight</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-wildlife">
							
							</span>
							<span class="mls"> icon-wildlife</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-world">
							
							</span>
							<span class="mls"> icon-world</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-link">
							
							</span>
							<span class="mls"> icon-link</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-copyright">
							
							</span>
							<span class="mls"> icon-copyright</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-order-history">
							
							</span>
							<span class="mls"> icon-order-history</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-signout">
							
							</span>
							<span class="mls"> icon-signout</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-update-billing">
							
							</span>
							<span class="mls"> icon-update-billing</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-update-profile">
							
							</span>
							<span class="mls"> icon-update-profile</span>
						</div>
					</div>
					<div class="glyph fs1">
						<div class="clearfix bshadow0 pbs">
							<span class="icon-user">
							
							</span>
							<span class="mls"> icon-user</span>
						</div>
					</div>
				</div>
			<div class="inner-main common-spacing container font-demo-wrapper">
				<h3>Material Icons</h3>
				<ul class="material-icons-list">
					<li><i class="material-icons">3d_rotation</i></li>
					<li><i class="material-icons">ac_unit</i></li>
					<li><i class="material-icons">access_alarm</i></li>
					<li><i class="material-icons">access_alarms</i></li>
					<li><i class="material-icons">access_time</i></li>
					<li><i class="material-icons">accessibility</i></li>
					<li><i class="material-icons">accessible</i></li>
					<li><i class="material-icons">account_balance</i></li>
					<li><i class="material-icons">account_balance_wallet</i></li>
					<li><i class="material-icons">account_box</i></li>
					<li><i class="material-icons">account_circle</i></li>
					<li><i class="material-icons">adb</i></li>
					<li><i class="material-icons">add</i></li>
					<li><i class="material-icons">add_a_photo</i></li>
					<li><i class="material-icons">add_alarm</i></li>
					<li><i class="material-icons">add_alert</i></li>
					<li><i class="material-icons">add_box</i></li>
					<li><i class="material-icons">add_circle</i></li>
					<li><i class="material-icons">add_circle_outline</i></li>
					<li><i class="material-icons">add_location</i></li>
					<li><i class="material-icons">add_shopping_cart</i></li>
					<li><i class="material-icons">add_to_photos</i></li>
					<li><i class="material-icons">add_to_queue</i></li>
					<li><i class="material-icons">adjust</i></li>
					<li><i class="material-icons">airline_seat_flat</i></li>
					<li><i class="material-icons">airline_seat_flat_angled</i></li>
					<li><i class="material-icons">airline_seat_individual_suite</i></li>
					<li><i class="material-icons">airline_seat_legroom_extra</i></li>
					<li><i class="material-icons">airline_seat_legroom_normal</i></li>
					<li><i class="material-icons">airline_seat_legroom_reduced</i></li>
					<li><i class="material-icons">airline_seat_recline_extra</i></li>
					<li><i class="material-icons">airline_seat_recline_normal</i></li>
					<li><i class="material-icons">airplanemode_active</i></li>
					<li><i class="material-icons">airplanemode_inactive</i></li>
					<li><i class="material-icons">airplay</i></li>
					<li><i class="material-icons">airport_shuttle</i></li>
					<li><i class="material-icons">alarm</i></li>
					<li><i class="material-icons">alarm_add</i></li>
					<li><i class="material-icons">alarm_off</i></li>
					<li><i class="material-icons">alarm_on</i></li>
					<li><i class="material-icons">album</i></li>
					<li><i class="material-icons">all_inclusive</i></li>
					<li><i class="material-icons">all_out</i></li>
					<li><i class="material-icons">android</i></li>
					<li><i class="material-icons">announcement</i></li>
					<li><i class="material-icons">apps</i></li>
					<li><i class="material-icons">archive</i></li>
					<li><i class="material-icons">arrow_back</i></li>
					<li><i class="material-icons">arrow_downward</i></li>
					<li><i class="material-icons">arrow_drop_down</i></li>
					<li><i class="material-icons">arrow_drop_down_circle</i></li>
					<li><i class="material-icons">arrow_drop_up</i></li>
					<li><i class="material-icons">arrow_forward</i></li>
					<li><i class="material-icons">arrow_upward</i></li>
					<li><i class="material-icons">art_track</i></li>
					<li><i class="material-icons">aspect_ratio</i></li>
					<li><i class="material-icons">assessment</i></li>
					<li><i class="material-icons">assignment</i></li>
					<li><i class="material-icons">assignment_ind</i></li>
					<li><i class="material-icons">assignment_late</i></li>
					<li><i class="material-icons">assignment_return</i></li>
					<li><i class="material-icons">assignment_returned</i></li>
					<li><i class="material-icons">assignment_turned_in</i></li>
					<li><i class="material-icons">assistant</i></li>
					<li><i class="material-icons">assistant_photo</i></li>
					<li><i class="material-icons">attach_file</i></li>
					<li><i class="material-icons">attach_money</i></li>
					<li><i class="material-icons">attachment</i></li>
					<li><i class="material-icons">audiotrack</i></li>
					<li><i class="material-icons">autorenew</i></li>
					<li><i class="material-icons">av_timer</i></li>
					<li><i class="material-icons">backspace</i></li>
					<li><i class="material-icons">backup</i></li>
					<li><i class="material-icons">battery_alert</i></li>
					<li><i class="material-icons">battery_charging_full</i></li>
					<li><i class="material-icons">battery_full</i></li>
					<li><i class="material-icons">battery_std</i></li>
					<li><i class="material-icons">battery_unknown</i></li>
					<li><i class="material-icons">beach_access</i></li>
					<li><i class="material-icons">beenhere</i></li>
					<li><i class="material-icons">block</i></li>
					<li><i class="material-icons">bluetooth</i></li>
					<li><i class="material-icons">bluetooth_audio</i></li>
					<li><i class="material-icons">bluetooth_connected</i></li>
					<li><i class="material-icons">bluetooth_disabled</i></li>
					<li><i class="material-icons">bluetooth_searching</i></li>
					<li><i class="material-icons">blur_circular</i></li>
					<li><i class="material-icons">blur_linear</i></li>
					<li><i class="material-icons">blur_off</i></li>
					<li><i class="material-icons">blur_on</i></li>
					<li><i class="material-icons">book</i></li>
					<li><i class="material-icons">bookmark</i></li>
					<li><i class="material-icons">bookmark_border</i></li>
					<li><i class="material-icons">border_all</i></li>
					<li><i class="material-icons">border_bottom</i></li>
					<li><i class="material-icons">border_clear</i></li>
					<li><i class="material-icons">border_color</i></li>
					<li><i class="material-icons">border_horizontal</i></li>
					<li><i class="material-icons">border_inner</i></li>
					<li><i class="material-icons">border_left</i></li>
					<li><i class="material-icons">border_outer</i></li>
					<li><i class="material-icons">border_right</i></li>
					<li><i class="material-icons">border_style</i></li>
					<li><i class="material-icons">border_top</i></li>
					<li><i class="material-icons">border_vertical</i></li>
					<li><i class="material-icons">branding_watermark</i></li>
					<li><i class="material-icons">brightness_1</i></li>
					<li><i class="material-icons">brightness_2</i></li>
					<li><i class="material-icons">brightness_3</i></li>
					<li><i class="material-icons">brightness_4</i></li>
					<li><i class="material-icons">brightness_5</i></li>
					<li><i class="material-icons">brightness_6</i></li>
					<li><i class="material-icons">brightness_7</i></li>
					<li><i class="material-icons">brightness_auto</i></li>
					<li><i class="material-icons">brightness_high</i></li>
					<li><i class="material-icons">brightness_low</i></li>
					<li><i class="material-icons">brightness_medium</i></li>
					<li><i class="material-icons">broken_image</i></li>
					<li><i class="material-icons">brush</i></li>
					<li><i class="material-icons">bubble_chart</i></li>
					<li><i class="material-icons">bug_report</i></li>
					<li><i class="material-icons">build</i></li>
					<li><i class="material-icons">burst_mode</i></li>
					<li><i class="material-icons">business</i></li>
					<li><i class="material-icons">business_center</i></li>
					<li><i class="material-icons">cached</i></li>
					<li><i class="material-icons">cake</i></li>
					<li><i class="material-icons">call</i></li>
					<li><i class="material-icons">call_end</i></li>
					<li><i class="material-icons">call_made</i></li>
					<li><i class="material-icons">call_merge</i></li>
					<li><i class="material-icons">call_missed</i></li>
					<li><i class="material-icons">call_missed_outgoing</i></li>
					<li><i class="material-icons">call_received</i></li>
					<li><i class="material-icons">call_split</i></li>
					<li><i class="material-icons">call_to_action</i></li>
					<li><i class="material-icons">camera</i></li>
					<li><i class="material-icons">camera_alt</i></li>
					<li><i class="material-icons">camera_enhance</i></li>
					<li><i class="material-icons">camera_front</i></li>
					<li><i class="material-icons">camera_rear</i></li>
					<li><i class="material-icons">camera_roll</i></li>
					<li><i class="material-icons">cancel</i></li>
					<li><i class="material-icons">card_giftcard</i></li>
					<li><i class="material-icons">card_membership</i></li>
					<li><i class="material-icons">card_travel</i></li>
					<li><i class="material-icons">casino</i></li>
					<li><i class="material-icons">cast</i></li>
					<li><i class="material-icons">cast_connected</i></li>
					<li><i class="material-icons">center_focus_strong</i></li>
					<li><i class="material-icons">center_focus_weak</i></li>
					<li><i class="material-icons">change_history</i></li>
					<li><i class="material-icons">chat</i></li>
					<li><i class="material-icons">chat_bubble</i></li>
					<li><i class="material-icons">chat_bubble_outline</i></li>
					<li><i class="material-icons">check</i></li>
					<li><i class="material-icons">check_box</i></li>
					<li><i class="material-icons">check_box_outline_blank</i></li>
					<li><i class="material-icons">check_circle</i></li>
					<li><i class="material-icons">chevron_left</i></li>
					<li><i class="material-icons">chevron_right</i></li>
					<li><i class="material-icons">child_care</i></li>
					<li><i class="material-icons">child_friendly</i></li>
					<li><i class="material-icons">chrome_reader_mode</i></li>
					<li><i class="material-icons">class</i></li>
					<li><i class="material-icons">clear</i></li>
					<li><i class="material-icons">clear_all</i></li>
					<li><i class="material-icons">close</i></li>
					<li><i class="material-icons">closed_caption</i></li>
					<li><i class="material-icons">cloud</i></li>
					<li><i class="material-icons">cloud_circle</i></li>
					<li><i class="material-icons">cloud_done</i></li>
					<li><i class="material-icons">cloud_download</i></li>
					<li><i class="material-icons">cloud_off</i></li>
					<li><i class="material-icons">cloud_queue</i></li>
					<li><i class="material-icons">cloud_upload</i></li>
					<li><i class="material-icons">code</i></li>
					<li><i class="material-icons">collections</i></li>
					<li><i class="material-icons">collections_bookmark</i></li>
					<li><i class="material-icons">color_lens</i></li>
					<li><i class="material-icons">colorize</i></li>
					<li><i class="material-icons">comment</i></li>
					<li><i class="material-icons">compare</i></li>
					<li><i class="material-icons">compare_arrows</i></li>
					<li><i class="material-icons">computer</i></li>
					<li><i class="material-icons">confirmation_number</i></li>
					<li><i class="material-icons">contact_mail</i></li>
					<li><i class="material-icons">contact_phone</i></li>
					<li><i class="material-icons">contacts</i></li>
					<li><i class="material-icons">content_copy</i></li>
					<li><i class="material-icons">content_cut</i></li>
					<li><i class="material-icons">content_paste</i></li>
					<li><i class="material-icons">control_point</i></li>
					<li><i class="material-icons">control_point_duplicate</i></li>
					<li><i class="material-icons">copyright</i></li>
					<li><i class="material-icons">create</i></li>
					<li><i class="material-icons">create_new_folder</i></li>
					<li><i class="material-icons">credit_card</i></li>
					<li><i class="material-icons">crop</i></li>
					<li><i class="material-icons">crop_16_9</i></li>
					<li><i class="material-icons">crop_3_2</i></li>
					<li><i class="material-icons">crop_5_4</i></li>
					<li><i class="material-icons">crop_7_5</i></li>
					<li><i class="material-icons">crop_din</i></li>
					<li><i class="material-icons">crop_free</i></li>
					<li><i class="material-icons">crop_landscape</i></li>
					<li><i class="material-icons">crop_original</i></li>
					<li><i class="material-icons">crop_portrait</i></li>
					<li><i class="material-icons">crop_rotate</i></li>
					<li><i class="material-icons">crop_square</i></li>
					<li><i class="material-icons">dashboard</i></li>
					<li><i class="material-icons">data_usage</i></li>
					<li><i class="material-icons">date_range</i></li>
					<li><i class="material-icons">dehaze</i></li>
					<li><i class="material-icons">delete</i></li>
					<li><i class="material-icons">delete_forever</i></li>
					<li><i class="material-icons">delete_sweep</i></li>
					<li><i class="material-icons">description</i></li>
					<li><i class="material-icons">desktop_mac</i></li>
					<li><i class="material-icons">desktop_windows</i></li>
					<li><i class="material-icons">details</i></li>
					<li><i class="material-icons">developer_board</i></li>
					<li><i class="material-icons">developer_mode</i></li>
					<li><i class="material-icons">device_hub</i></li>
					<li><i class="material-icons">devices</i></li>
					<li><i class="material-icons">devices_other</i></li>
					<li><i class="material-icons">dialer_sip</i></li>
					<li><i class="material-icons">dialpad</i></li>
					<li><i class="material-icons">directions</i></li>
					<li><i class="material-icons">directions_bike</i></li>
					<li><i class="material-icons">directions_boat</i></li>
					<li><i class="material-icons">directions_bus</i></li>
					<li><i class="material-icons">directions_car</i></li>
					<li><i class="material-icons">directions_railway</i></li>
					<li><i class="material-icons">directions_run</i></li>
					<li><i class="material-icons">directions_subway</i></li>
					<li><i class="material-icons">directions_transit</i></li>
					<li><i class="material-icons">directions_walk</i></li>
					<li><i class="material-icons">disc_full</i></li>
					<li><i class="material-icons">dns</i></li>
					<li><i class="material-icons">do_not_disturb</i></li>
					<li><i class="material-icons">do_not_disturb_alt</i></li>
					<li><i class="material-icons">do_not_disturb_off</i></li>
					<li><i class="material-icons">do_not_disturb_on</i></li>
					<li><i class="material-icons">dock</i></li>
					<li><i class="material-icons">domain</i></li>
					<li><i class="material-icons">done</i></li>
					<li><i class="material-icons">done_all</i></li>
					<li><i class="material-icons">donut_large</i></li>
					<li><i class="material-icons">donut_small</i></li>
					<li><i class="material-icons">drafts</i></li>
					<li><i class="material-icons">drag_handle</i></li>
					<li><i class="material-icons">drive_eta</i></li>
					<li><i class="material-icons">dvr</i></li>
					<li><i class="material-icons">edit</i></li>
					<li><i class="material-icons">edit_location</i></li>
					<li><i class="material-icons">eject</i></li>
					<li><i class="material-icons">email</i></li>
					<li><i class="material-icons">enhanced_encryption</i></li>
					<li><i class="material-icons">equalizer</i></li>
					<li><i class="material-icons">error</i></li>
					<li><i class="material-icons">error_outline</i></li>
					<li><i class="material-icons">euro_symbol</i></li>
					<li><i class="material-icons">ev_station</i></li>
					<li><i class="material-icons">event</i></li>
					<li><i class="material-icons">event_available</i></li>
					<li><i class="material-icons">event_busy</i></li>
					<li><i class="material-icons">event_note</i></li>
					<li><i class="material-icons">event_seat</i></li>
					<li><i class="material-icons">exit_to_app</i></li>
					<li><i class="material-icons">expand_less</i></li>
					<li><i class="material-icons">expand_more</i></li>
					<li><i class="material-icons">explicit</i></li>
					<li><i class="material-icons">explore</i></li>
					<li><i class="material-icons">exposure</i></li>
					<li><i class="material-icons">exposure_neg_1</i></li>
					<li><i class="material-icons">exposure_neg_2</i></li>
					<li><i class="material-icons">exposure_plus_1</i></li>
					<li><i class="material-icons">exposure_plus_2</i></li>
					<li><i class="material-icons">exposure_zero</i></li>
					<li><i class="material-icons">extension</i></li>
					<li><i class="material-icons">face</i></li>
					<li><i class="material-icons">fast_forward</i></li>
					<li><i class="material-icons">fast_rewind</i></li>
					<li><i class="material-icons">favorite</i></li>
					<li><i class="material-icons">favorite_border</i></li>
					<li><i class="material-icons">featured_play_list</i></li>
					<li><i class="material-icons">featured_video</i></li>
					<li><i class="material-icons">feedback</i></li>
					<li><i class="material-icons">fiber_dvr</i></li>
					<li><i class="material-icons">fiber_manual_record</i></li>
					<li><i class="material-icons">fiber_new</i></li>
					<li><i class="material-icons">fiber_pin</i></li>
					<li><i class="material-icons">fiber_smart_record</i></li>
					<li><i class="material-icons">file_download</i></li>
					<li><i class="material-icons">file_upload</i></li>
					<li><i class="material-icons">filter</i></li>
					<li><i class="material-icons">filter_1</i></li>
					<li><i class="material-icons">filter_2</i></li>
					<li><i class="material-icons">filter_3</i></li>
					<li><i class="material-icons">filter_4</i></li>
					<li><i class="material-icons">filter_5</i></li>
					<li><i class="material-icons">filter_6</i></li>
					<li><i class="material-icons">filter_7</i></li>
					<li><i class="material-icons">filter_8</i></li>
					<li><i class="material-icons">filter_9</i></li>
					<li><i class="material-icons">filter_9_plus</i></li>
					<li><i class="material-icons">filter_b_and_w</i></li>
					<li><i class="material-icons">filter_center_focus</i></li>
					<li><i class="material-icons">filter_drama</i></li>
					<li><i class="material-icons">filter_frames</i></li>
					<li><i class="material-icons">filter_hdr</i></li>
					<li><i class="material-icons">filter_list</i></li>
					<li><i class="material-icons">filter_none</i></li>
					<li><i class="material-icons">filter_tilt_shift</i></li>
					<li><i class="material-icons">filter_vintage</i></li>
					<li><i class="material-icons">find_in_page</i></li>
					<li><i class="material-icons">find_replace</i></li>
					<li><i class="material-icons">fingerprint</i></li>
					<li><i class="material-icons">first_page</i></li>
					<li><i class="material-icons">fitness_center</i></li>
					<li><i class="material-icons">flag</i></li>
					<li><i class="material-icons">flare</i></li>
					<li><i class="material-icons">flash_auto</i></li>
					<li><i class="material-icons">flash_off</i></li>
					<li><i class="material-icons">flash_on</i></li>
					<li><i class="material-icons">flight</i></li>
					<li><i class="material-icons">flight_land</i></li>
					<li><i class="material-icons">flight_takeoff</i></li>
					<li><i class="material-icons">flip</i></li>
					<li><i class="material-icons">flip_to_back</i></li>
					<li><i class="material-icons">flip_to_front</i></li>
					<li><i class="material-icons">folder</i></li>
					<li><i class="material-icons">folder_open</i></li>
					<li><i class="material-icons">folder_shared</i></li>
					<li><i class="material-icons">folder_special</i></li>
					<li><i class="material-icons">font_download</i></li>
					<li><i class="material-icons">format_align_center</i></li>
					<li><i class="material-icons">format_align_justify</i></li>
					<li><i class="material-icons">format_align_left</i></li>
					<li><i class="material-icons">format_align_right</i></li>
					<li><i class="material-icons">format_bold</i></li>
					<li><i class="material-icons">format_clear</i></li>
					<li><i class="material-icons">format_color_fill</i></li>
					<li><i class="material-icons">format_color_reset</i></li>
					<li><i class="material-icons">format_color_text</i></li>
					<li><i class="material-icons">format_indent_decrease</i></li>
					<li><i class="material-icons">format_indent_increase</i></li>
					<li><i class="material-icons">format_italic</i></li>
					<li><i class="material-icons">format_line_spacing</i></li>
					<li><i class="material-icons">format_list_bulleted</i></li>
					<li><i class="material-icons">format_list_numbered</i></li>
					<li><i class="material-icons">format_paint</i></li>
					<li><i class="material-icons">format_quote</i></li>
					<li><i class="material-icons">format_shapes</i></li>
					<li><i class="material-icons">format_size</i></li>
					<li><i class="material-icons">format_strikethrough</i></li>
					<li><i class="material-icons">format_textdirection_l_to_r</i></li>
					<li><i class="material-icons">format_textdirection_r_to_l</i></li>
					<li><i class="material-icons">format_underlined</i></li>
					<li><i class="material-icons">forum</i></li>
					<li><i class="material-icons">forward</i></li>
					<li><i class="material-icons">forward_10</i></li>
					<li><i class="material-icons">forward_30</i></li>
					<li><i class="material-icons">forward_5</i></li>
					<li><i class="material-icons">free_breakfast</i></li>
					<li><i class="material-icons">fullscreen</i></li>
					<li><i class="material-icons">fullscreen_exit</i></li>
					<li><i class="material-icons">functions</i></li>
					<li><i class="material-icons">g_translate</i></li>
					<li><i class="material-icons">gamepad</i></li>
					<li><i class="material-icons">games</i></li>
					<li><i class="material-icons">gavel</i></li>
					<li><i class="material-icons">gesture</i></li>
					<li><i class="material-icons">get_app</i></li>
					<li><i class="material-icons">gif</i></li>
					<li><i class="material-icons">golf_course</i></li>
					<li><i class="material-icons">gps_fixed</i></li>
					<li><i class="material-icons">gps_not_fixed</i></li>
					<li><i class="material-icons">gps_off</i></li>
					<li><i class="material-icons">grade</i></li>
					<li><i class="material-icons">gradient</i></li>
					<li><i class="material-icons">grain</i></li>
					<li><i class="material-icons">graphic_eq</i></li>
					<li><i class="material-icons">grid_off</i></li>
					<li><i class="material-icons">grid_on</i></li>
					<li><i class="material-icons">group</i></li>
					<li><i class="material-icons">group_add</i></li>
					<li><i class="material-icons">group_work</i></li>
					<li><i class="material-icons">hd</i></li>
					<li><i class="material-icons">hdr_off</i></li>
					<li><i class="material-icons">hdr_on</i></li>
					<li><i class="material-icons">hdr_strong</i></li>
					<li><i class="material-icons">hdr_weak</i></li>
					<li><i class="material-icons">headset</i></li>
					<li><i class="material-icons">headset_mic</i></li>
					<li><i class="material-icons">healing</i></li>
					<li><i class="material-icons">hearing</i></li>
					<li><i class="material-icons">help</i></li>
					<li><i class="material-icons">help_outline</i></li>
					<li><i class="material-icons">high_quality</i></li>
					<li><i class="material-icons">highlight</i></li>
					<li><i class="material-icons">highlight_off</i></li>
					<li><i class="material-icons">history</i></li>
					<li><i class="material-icons">home</i></li>
					<li><i class="material-icons">hot_tub</i></li>
					<li><i class="material-icons">hotel</i></li>
					<li><i class="material-icons">hourglass_empty</i></li>
					<li><i class="material-icons">hourglass_full</i></li>
					<li><i class="material-icons">http</i></li>
					<li><i class="material-icons">https</i></li>
					<li><i class="material-icons">image</i></li>
					<li><i class="material-icons">image_aspect_ratio</i></li>
					<li><i class="material-icons">import_contacts</i></li>
					<li><i class="material-icons">import_export</i></li>
					<li><i class="material-icons">important_devices</i></li>
					<li><i class="material-icons">inbox</i></li>
					<li><i class="material-icons">indeterminate_check_box</i></li>
					<li><i class="material-icons">info</i></li>
					<li><i class="material-icons">info_outline</i></li>
					<li><i class="material-icons">input</i></li>
					<li><i class="material-icons">insert_chart</i></li>
					<li><i class="material-icons">insert_comment</i></li>
					<li><i class="material-icons">insert_drive_file</i></li>
					<li><i class="material-icons">insert_emoticon</i></li>
					<li><i class="material-icons">insert_invitation</i></li>
					<li><i class="material-icons">insert_link</i></li>
					<li><i class="material-icons">insert_photo</i></li>
					<li><i class="material-icons">invert_colors</i></li>
					<li><i class="material-icons">invert_colors_off</i></li>
					<li><i class="material-icons">iso</i></li>
					<li><i class="material-icons">keyboard</i></li>
					<li><i class="material-icons">keyboard_arrow_down</i></li>
					<li><i class="material-icons">keyboard_arrow_left</i></li>
					<li><i class="material-icons">keyboard_arrow_right</i></li>
					<li><i class="material-icons">keyboard_arrow_up</i></li>
					<li><i class="material-icons">keyboard_backspace</i></li>
					<li><i class="material-icons">keyboard_capslock</i></li>
					<li><i class="material-icons">keyboard_hide</i></li>
					<li><i class="material-icons">keyboard_return</i></li>
					<li><i class="material-icons">keyboard_tab</i></li>
					<li><i class="material-icons">keyboard_voice</i></li>
					<li><i class="material-icons">kitchen</i></li>
					<li><i class="material-icons">label</i></li>
					<li><i class="material-icons">label_outline</i></li>
					<li><i class="material-icons">landscape</i></li>
					<li><i class="material-icons">language</i></li>
					<li><i class="material-icons">laptop</i></li>
					<li><i class="material-icons">laptop_chromebook</i></li>
					<li><i class="material-icons">laptop_mac</i></li>
					<li><i class="material-icons">laptop_windows</i></li>
					<li><i class="material-icons">last_page</i></li>
					<li><i class="material-icons">launch</i></li>
					<li><i class="material-icons">layers</i></li>
					<li><i class="material-icons">layers_clear</i></li>
					<li><i class="material-icons">leak_add</i></li>
					<li><i class="material-icons">leak_remove</i></li>
					<li><i class="material-icons">lens</i></li>
					<li><i class="material-icons">library_add</i></li>
					<li><i class="material-icons">library_books</i></li>
					<li><i class="material-icons">library_music</i></li>
					<li><i class="material-icons">lightbulb_outline</i></li>
					<li><i class="material-icons">line_style</i></li>
					<li><i class="material-icons">line_weight</i></li>
					<li><i class="material-icons">linear_scale</i></li>
					<li><i class="material-icons">link</i></li>
					<li><i class="material-icons">linked_camera</i></li>
					<li><i class="material-icons">list</i></li>
					<li><i class="material-icons">live_help</i></li>
					<li><i class="material-icons">live_tv</i></li>
					<li><i class="material-icons">local_activity</i></li>
					<li><i class="material-icons">local_airport</i></li>
					<li><i class="material-icons">local_atm</i></li>
					<li><i class="material-icons">local_bar</i></li>
					<li><i class="material-icons">local_cafe</i></li>
					<li><i class="material-icons">local_car_wash</i></li>
					<li><i class="material-icons">local_convenience_store</i></li>
					<li><i class="material-icons">local_dining</i></li>
					<li><i class="material-icons">local_drink</i></li>
					<li><i class="material-icons">local_florist</i></li>
					<li><i class="material-icons">local_gas_station</i></li>
					<li><i class="material-icons">local_grocery_store</i></li>
					<li><i class="material-icons">local_hospital</i></li>
					<li><i class="material-icons">local_hotel</i></li>
					<li><i class="material-icons">local_laundry_service</i></li>
					<li><i class="material-icons">local_library</i></li>
					<li><i class="material-icons">local_mall</i></li>
					<li><i class="material-icons">local_movies</i></li>
					<li><i class="material-icons">local_offer</i></li>
					<li><i class="material-icons">local_parking</i></li>
					<li><i class="material-icons">local_pharmacy</i></li>
					<li><i class="material-icons">local_phone</i></li>
					<li><i class="material-icons">local_pizza</i></li>
					<li><i class="material-icons">local_play</i></li>
					<li><i class="material-icons">local_post_office</i></li>
					<li><i class="material-icons">local_printshop</i></li>
					<li><i class="material-icons">local_see</i></li>
					<li><i class="material-icons">local_shipping</i></li>
					<li><i class="material-icons">local_taxi</i></li>
					<li><i class="material-icons">location_city</i></li>
					<li><i class="material-icons">location_disabled</i></li>
					<li><i class="material-icons">location_off</i></li>
					<li><i class="material-icons">location_on</i></li>
					<li><i class="material-icons">location_searching</i></li>
					<li><i class="material-icons">lock</i></li>
					<li><i class="material-icons">lock_open</i></li>
					<li><i class="material-icons">lock_outline</i></li>
					<li><i class="material-icons">looks</i></li>
					<li><i class="material-icons">looks_3</i></li>
					<li><i class="material-icons">looks_4</i></li>
					<li><i class="material-icons">looks_5</i></li>
					<li><i class="material-icons">looks_6</i></li>
					<li><i class="material-icons">looks_one</i></li>
					<li><i class="material-icons">looks_two</i></li>
					<li><i class="material-icons">loop</i></li>
					<li><i class="material-icons">loupe</i></li>
					<li><i class="material-icons">low_priority</i></li>
					<li><i class="material-icons">loyalty</i></li>
					<li><i class="material-icons">mail</i></li>
					<li><i class="material-icons">mail_outline</i></li>
					<li><i class="material-icons">map</i></li>
					<li><i class="material-icons">markunread</i></li>
					<li><i class="material-icons">markunread_mailbox</i></li>
					<li><i class="material-icons">memory</i></li>
					<li><i class="material-icons">menu</i></li>
					<li><i class="material-icons">merge_type</i></li>
					<li><i class="material-icons">message</i></li>
					<li><i class="material-icons">mic</i></li>
					<li><i class="material-icons">mic_none</i></li>
					<li><i class="material-icons">mic_off</i></li>
					<li><i class="material-icons">mms</i></li>
					<li><i class="material-icons">mode_comment</i></li>
					<li><i class="material-icons">mode_edit</i></li>
					<li><i class="material-icons">monetization_on</i></li>
					<li><i class="material-icons">money_off</i></li>
					<li><i class="material-icons">monochrome_photos</i></li>
					<li><i class="material-icons">mood</i></li>
					<li><i class="material-icons">mood_bad</i></li>
					<li><i class="material-icons">more</i></li>
					<li><i class="material-icons">more_horiz</i></li>
					<li><i class="material-icons">more_vert</i></li>
					<li><i class="material-icons">motorcycle</i></li>
					<li><i class="material-icons">mouse</i></li>
					<li><i class="material-icons">move_to_inbox</i></li>
					<li><i class="material-icons">movie</i></li>
					<li><i class="material-icons">movie_creation</i></li>
					<li><i class="material-icons">movie_filter</i></li>
					<li><i class="material-icons">multiline_chart</i></li>
					<li><i class="material-icons">music_note</i></li>
					<li><i class="material-icons">music_video</i></li>
					<li><i class="material-icons">my_location</i></li>
					<li><i class="material-icons">nature</i></li>
					<li><i class="material-icons">nature_people</i></li>
					<li><i class="material-icons">navigate_before</i></li>
					<li><i class="material-icons">navigate_next</i></li>
					<li><i class="material-icons">navigation</i></li>
					<li><i class="material-icons">near_me</i></li>
					<li><i class="material-icons">network_cell</i></li>
					<li><i class="material-icons">network_check</i></li>
					<li><i class="material-icons">network_locked</i></li>
					<li><i class="material-icons">network_wifi</i></li>
					<li><i class="material-icons">new_releases</i></li>
					<li><i class="material-icons">next_week</i></li>
					<li><i class="material-icons">nfc</i></li>
					<li><i class="material-icons">no_encryption</i></li>
					<li><i class="material-icons">no_sim</i></li>
					<li><i class="material-icons">not_interested</i></li>
					<li><i class="material-icons">note</i></li>
					<li><i class="material-icons">note_add</i></li>
					<li><i class="material-icons">notifications</i></li>
					<li><i class="material-icons">notifications_active</i></li>
					<li><i class="material-icons">notifications_none</i></li>
					<li><i class="material-icons">notifications_off</i></li>
					<li><i class="material-icons">notifications_paused</i></li>
					<li><i class="material-icons">offline_pin</i></li>
					<li><i class="material-icons">ondemand_video</i></li>
					<li><i class="material-icons">opacity</i></li>
					<li><i class="material-icons">open_in_browser</i></li>
					<li><i class="material-icons">open_in_new</i></li>
					<li><i class="material-icons">open_with</i></li>
					<li><i class="material-icons">pages</i></li>
					<li><i class="material-icons">pageview</i></li>
					<li><i class="material-icons">palette</i></li>
					<li><i class="material-icons">pan_tool</i></li>
					<li><i class="material-icons">panorama</i></li>
					<li><i class="material-icons">panorama_fish_eye</i></li>
					<li><i class="material-icons">panorama_horizontal</i></li>
					<li><i class="material-icons">panorama_vertical</i></li>
					<li><i class="material-icons">panorama_wide_angle</i></li>
					<li><i class="material-icons">party_mode</i></li>
					<li><i class="material-icons">pause</i></li>
					<li><i class="material-icons">pause_circle_filled</i></li>
					<li><i class="material-icons">pause_circle_outline</i></li>
					<li><i class="material-icons">payment</i></li>
					<li><i class="material-icons">people</i></li>
					<li><i class="material-icons">people_outline</i></li>
					<li><i class="material-icons">perm_camera_mic</i></li>
					<li><i class="material-icons">perm_contact_calendar</i></li>
					<li><i class="material-icons">perm_data_setting</i></li>
					<li><i class="material-icons">perm_device_information</i></li>
					<li><i class="material-icons">perm_identity</i></li>
					<li><i class="material-icons">perm_media</i></li>
					<li><i class="material-icons">perm_phone_msg</i></li>
					<li><i class="material-icons">perm_scan_wifi</i></li>
					<li><i class="material-icons">person</i></li>
					<li><i class="material-icons">person_add</i></li>
					<li><i class="material-icons">person_outline</i></li>
					<li><i class="material-icons">person_pin</i></li>
					<li><i class="material-icons">person_pin_circle</i></li>
					<li><i class="material-icons">personal_video</i></li>
					<li><i class="material-icons">pets</i></li>
					<li><i class="material-icons">phone</i></li>
					<li><i class="material-icons">phone_android</i></li>
					<li><i class="material-icons">phone_bluetooth_speaker</i></li>
					<li><i class="material-icons">phone_forwarded</i></li>
					<li><i class="material-icons">phone_in_talk</i></li>
					<li><i class="material-icons">phone_iphone</i></li>
					<li><i class="material-icons">phone_locked</i></li>
					<li><i class="material-icons">phone_missed</i></li>
					<li><i class="material-icons">phone_paused</i></li>
					<li><i class="material-icons">phonelink</i></li>
					<li><i class="material-icons">phonelink_erase</i></li>
					<li><i class="material-icons">phonelink_lock</i></li>
					<li><i class="material-icons">phonelink_off</i></li>
					<li><i class="material-icons">phonelink_ring</i></li>
					<li><i class="material-icons">phonelink_setup</i></li>
					<li><i class="material-icons">photo</i></li>
					<li><i class="material-icons">photo_album</i></li>
					<li><i class="material-icons">photo_camera</i></li>
					<li><i class="material-icons">photo_filter</i></li>
					<li><i class="material-icons">photo_library</i></li>
					<li><i class="material-icons">photo_size_select_actual</i></li>
					<li><i class="material-icons">photo_size_select_large</i></li>
					<li><i class="material-icons">photo_size_select_small</i></li>
					<li><i class="material-icons">picture_as_pdf</i></li>
					<li><i class="material-icons">picture_in_picture</i></li>
					<li><i class="material-icons">picture_in_picture_alt</i></li>
					<li><i class="material-icons">pie_chart</i></li>
					<li><i class="material-icons">pie_chart_outlined</i></li>
					<li><i class="material-icons">pin_drop</i></li>
					<li><i class="material-icons">place</i></li>
					<li><i class="material-icons">play_arrow</i></li>
					<li><i class="material-icons">play_circle_filled</i></li>
					<li><i class="material-icons">play_circle_outline</i></li>
					<li><i class="material-icons">play_for_work</i></li>
					<li><i class="material-icons">playlist_add</i></li>
					<li><i class="material-icons">playlist_add_check</i></li>
					<li><i class="material-icons">playlist_play</i></li>
					<li><i class="material-icons">plus_one</i></li>
					<li><i class="material-icons">poll</i></li>
					<li><i class="material-icons">polymer</i></li>
					<li><i class="material-icons">pool</i></li>
					<li><i class="material-icons">portable_wifi_off</i></li>
					<li><i class="material-icons">portrait</i></li>
					<li><i class="material-icons">power</i></li>
					<li><i class="material-icons">power_input</i></li>
					<li><i class="material-icons">power_settings_new</i></li>
					<li><i class="material-icons">pregnant_woman</i></li>
					<li><i class="material-icons">present_to_all</i></li>
					<li><i class="material-icons">print</i></li>
					<li><i class="material-icons">priority_high</i></li>
					<li><i class="material-icons">public</i></li>
					<li><i class="material-icons">publish</i></li>
					<li><i class="material-icons">query_builder</i></li>
					<li><i class="material-icons">question_answer</i></li>
					<li><i class="material-icons">queue</i></li>
					<li><i class="material-icons">queue_music</i></li>
					<li><i class="material-icons">queue_play_next</i></li>
					<li><i class="material-icons">radio</i></li>
					<li><i class="material-icons">radio_button_checked</i></li>
					<li><i class="material-icons">radio_button_unchecked</i></li>
					<li><i class="material-icons">rate_review</i></li>
					<li><i class="material-icons">receipt</i></li>
					<li><i class="material-icons">recent_actors</i></li>
					<li><i class="material-icons">record_voice_over</i></li>
					<li><i class="material-icons">redeem</i></li>
					<li><i class="material-icons">redo</i></li>
					<li><i class="material-icons">refresh</i></li>
					<li><i class="material-icons">remove</i></li>
					<li><i class="material-icons">remove_circle</i></li>
					<li><i class="material-icons">remove_circle_outline</i></li>
					<li><i class="material-icons">remove_from_queue</i></li>
					<li><i class="material-icons">remove_red_eye</i></li>
					<li><i class="material-icons">remove_shopping_cart</i></li>
					<li><i class="material-icons">reorder</i></li>
					<li><i class="material-icons">repeat</i></li>
					<li><i class="material-icons">repeat_one</i></li>
					<li><i class="material-icons">replay</i></li>
					<li><i class="material-icons">replay_10</i></li>
					<li><i class="material-icons">replay_30</i></li>
					<li><i class="material-icons">replay_5</i></li>
					<li><i class="material-icons">reply</i></li>
					<li><i class="material-icons">reply_all</i></li>
					<li><i class="material-icons">report</i></li>
					<li><i class="material-icons">report_problem</i></li>
					<li><i class="material-icons">restaurant</i></li>
					<li><i class="material-icons">restaurant_menu</i></li>
					<li><i class="material-icons">restore</i></li>
					<li><i class="material-icons">restore_page</i></li>
					<li><i class="material-icons">ring_volume</i></li>
					<li><i class="material-icons">room</i></li>
					<li><i class="material-icons">room_service</i></li>
					<li><i class="material-icons">rotate_90_degrees_ccw</i></li>
					<li><i class="material-icons">rotate_left</i></li>
					<li><i class="material-icons">rotate_right</i></li>
					<li><i class="material-icons">rounded_corner</i></li>
					<li><i class="material-icons">router</i></li>
					<li><i class="material-icons">rowing</i></li>
					<li><i class="material-icons">rss_feed</i></li>
					<li><i class="material-icons">rv_hookup</i></li>
					<li><i class="material-icons">satellite</i></li>
					<li><i class="material-icons">save</i></li>
					<li><i class="material-icons">scanner</i></li>
					<li><i class="material-icons">schedule</i></li>
					<li><i class="material-icons">school</i></li>
					<li><i class="material-icons">screen_lock_landscape</i></li>
					<li><i class="material-icons">screen_lock_portrait</i></li>
					<li><i class="material-icons">screen_lock_rotation</i></li>
					<li><i class="material-icons">screen_rotation</i></li>
					<li><i class="material-icons">screen_share</i></li>
					<li><i class="material-icons">sd_card</i></li>
					<li><i class="material-icons">sd_storage</i></li>
					<li><i class="material-icons">search</i></li>
					<li><i class="material-icons">security</i></li>
					<li><i class="material-icons">select_all</i></li>
					<li><i class="material-icons">send</i></li>
					<li><i class="material-icons">sentiment_dissatisfied</i></li>
					<li><i class="material-icons">sentiment_neutral</i></li>
					<li><i class="material-icons">sentiment_satisfied</i></li>
					<li><i class="material-icons">sentiment_very_dissatisfied</i></li>
					<li><i class="material-icons">sentiment_very_satisfied</i></li>
					<li><i class="material-icons">settings</i></li>
					<li><i class="material-icons">settings_applications</i></li>
					<li><i class="material-icons">settings_backup_restore</i></li>
					<li><i class="material-icons">settings_bluetooth</i></li>
					<li><i class="material-icons">settings_brightness</i></li>
					<li><i class="material-icons">settings_cell</i></li>
					<li><i class="material-icons">settings_ethernet</i></li>
					<li><i class="material-icons">settings_input_antenna</i></li>
					<li><i class="material-icons">settings_input_component</i></li>
					<li><i class="material-icons">settings_input_composite</i></li>
					<li><i class="material-icons">settings_input_hdmi</i></li>
					<li><i class="material-icons">settings_input_svideo</i></li>
					<li><i class="material-icons">settings_overscan</i></li>
					<li><i class="material-icons">settings_phone</i></li>
					<li><i class="material-icons">settings_power</i></li>
					<li><i class="material-icons">settings_remote</i></li>
					<li><i class="material-icons">settings_system_daydream</i></li>
					<li><i class="material-icons">settings_voice</i></li>
					<li><i class="material-icons">share</i></li>
					<li><i class="material-icons">shop</i></li>
					<li><i class="material-icons">shop_two</i></li>
					<li><i class="material-icons">shopping_basket</i></li>
					<li><i class="material-icons">shopping_cart</i></li>
					<li><i class="material-icons">short_text</i></li>
					<li><i class="material-icons">show_chart</i></li>
					<li><i class="material-icons">shuffle</i></li>
					<li><i class="material-icons">signal_cellular_4_bar</i></li>
					<li><i class="material-icons">signal_cellular_connected_no_internet_4_bar</i></li>
					<li><i class="material-icons">signal_cellular_no_sim</i></li>
					<li><i class="material-icons">signal_cellular_null</i></li>
					<li><i class="material-icons">signal_cellular_off</i></li>
					<li><i class="material-icons">signal_wifi_4_bar</i></li>
					<li><i class="material-icons">signal_wifi_4_bar_lock</i></li>
					<li><i class="material-icons">signal_wifi_off</i></li>
					<li><i class="material-icons">sim_card</i></li>
					<li><i class="material-icons">sim_card_alert</i></li>
					<li><i class="material-icons">skip_next</i></li>
					<li><i class="material-icons">skip_previous</i></li>
					<li><i class="material-icons">slideshow</i></li>
					<li><i class="material-icons">slow_motion_video</i></li>
					<li><i class="material-icons">smartphone</i></li>
					<li><i class="material-icons">smoke_free</i></li>
					<li><i class="material-icons">smoking_rooms</i></li>
					<li><i class="material-icons">sms</i></li>
					<li><i class="material-icons">sms_failed</i></li>
					<li><i class="material-icons">snooze</i></li>
					<li><i class="material-icons">sort</i></li>
					<li><i class="material-icons">sort_by_alpha</i></li>
					<li><i class="material-icons">spa</i></li>
					<li><i class="material-icons">space_bar</i></li>
					<li><i class="material-icons">speaker</i></li>
					<li><i class="material-icons">speaker_group</i></li>
					<li><i class="material-icons">speaker_notes</i></li>
					<li><i class="material-icons">speaker_notes_off</i></li>
					<li><i class="material-icons">speaker_phone</i></li>
					<li><i class="material-icons">spellcheck</i></li>
					<li><i class="material-icons">star</i></li>
					<li><i class="material-icons">star_border</i></li>
					<li><i class="material-icons">star_half</i></li>
					<li><i class="material-icons">stars</i></li>
					<li><i class="material-icons">stay_current_landscape</i></li>
					<li><i class="material-icons">stay_current_portrait</i></li>
					<li><i class="material-icons">stay_primary_landscape</i></li>
					<li><i class="material-icons">stay_primary_portrait</i></li>
					<li><i class="material-icons">stop</i></li>
					<li><i class="material-icons">stop_screen_share</i></li>
					<li><i class="material-icons">storage</i></li>
					<li><i class="material-icons">store</i></li>
					<li><i class="material-icons">store_mall_directory</i></li>
					<li><i class="material-icons">straighten</i></li>
					<li><i class="material-icons">streetview</i></li>
					<li><i class="material-icons">strikethrough_s</i></li>
					<li><i class="material-icons">style</i></li>
					<li><i class="material-icons">subdirectory_arrow_left</i></li>
					<li><i class="material-icons">subdirectory_arrow_right</i></li>
					<li><i class="material-icons">subject</i></li>
					<li><i class="material-icons">subscriptions</i></li>
					<li><i class="material-icons">subtitles</i></li>
					<li><i class="material-icons">subway</i></li>
					<li><i class="material-icons">supervisor_account</i></li>
					<li><i class="material-icons">surround_sound</i></li>
					<li><i class="material-icons">swap_calls</i></li>
					<li><i class="material-icons">swap_horiz</i></li>
					<li><i class="material-icons">swap_vert</i></li>
					<li><i class="material-icons">swap_vertical_circle</i></li>
					<li><i class="material-icons">switch_camera</i></li>
					<li><i class="material-icons">switch_video</i></li>
					<li><i class="material-icons">sync</i></li>
					<li><i class="material-icons">sync_disabled</i></li>
					<li><i class="material-icons">sync_problem</i></li>
					<li><i class="material-icons">system_update</i></li>
					<li><i class="material-icons">system_update_alt</i></li>
					<li><i class="material-icons">tab</i></li>
					<li><i class="material-icons">tab_unselected</i></li>
					<li><i class="material-icons">tablet</i></li>
					<li><i class="material-icons">tablet_android</i></li>
					<li><i class="material-icons">tablet_mac</i></li>
					<li><i class="material-icons">tag_faces</i></li>
					<li><i class="material-icons">tap_and_play</i></li>
					<li><i class="material-icons">terrain</i></li>
					<li><i class="material-icons">text_fields</i></li>
					<li><i class="material-icons">text_format</i></li>
					<li><i class="material-icons">textsms</i></li>
					<li><i class="material-icons">texture</i></li>
					<li><i class="material-icons">theaters</i></li>
					<li><i class="material-icons">thumb_down</i></li>
					<li><i class="material-icons">thumb_up</i></li>
					<li><i class="material-icons">thumbs_up_down</i></li>
					<li><i class="material-icons">time_to_leave</i></li>
					<li><i class="material-icons">timelapse</i></li>
					<li><i class="material-icons">timeline</i></li>
					<li><i class="material-icons">timer</i></li>
					<li><i class="material-icons">timer_10</i></li>
					<li><i class="material-icons">timer_3</i></li>
					<li><i class="material-icons">timer_off</i></li>
					<li><i class="material-icons">title</i></li>
					<li><i class="material-icons">toc</i></li>
					<li><i class="material-icons">today</i></li>
					<li><i class="material-icons">toll</i></li>
					<li><i class="material-icons">tonality</i></li>
					<li><i class="material-icons">touch_app</i></li>
					<li><i class="material-icons">toys</i></li>
					<li><i class="material-icons">track_changes</i></li>
					<li><i class="material-icons">traffic</i></li>
					<li><i class="material-icons">train</i></li>
					<li><i class="material-icons">tram</i></li>
					<li><i class="material-icons">transfer_within_a_station</i></li>
					<li><i class="material-icons">transform</i></li>
					<li><i class="material-icons">translate</i></li>
					<li><i class="material-icons">trending_down</i></li>
					<li><i class="material-icons">trending_flat</i></li>
					<li><i class="material-icons">trending_up</i></li>
					<li><i class="material-icons">tune</i></li>
					<li><i class="material-icons">turned_in</i></li>
					<li><i class="material-icons">turned_in_not</i></li>
					<li><i class="material-icons">tv</i></li>
					<li><i class="material-icons">unarchive</i></li>
					<li><i class="material-icons">undo</i></li>
					<li><i class="material-icons">unfold_less</i></li>
					<li><i class="material-icons">unfold_more</i></li>
					<li><i class="material-icons">update</i></li>
					<li><i class="material-icons">usb</i></li>
					<li><i class="material-icons">verified_user</i></li>
					<li><i class="material-icons">vertical_align_bottom</i></li>
					<li><i class="material-icons">vertical_align_center</i></li>
					<li><i class="material-icons">vertical_align_top</i></li>
					<li><i class="material-icons">vibration</i></li>
					<li><i class="material-icons">video_call</i></li>
					<li><i class="material-icons">video_label</i></li>
					<li><i class="material-icons">video_library</i></li>
					<li><i class="material-icons">videocam</i></li>
					<li><i class="material-icons">videocam_off</i></li>
					<li><i class="material-icons">videogame_asset</i></li>
					<li><i class="material-icons">view_agenda</i></li>
					<li><i class="material-icons">view_array</i></li>
					<li><i class="material-icons">view_carousel</i></li>
					<li><i class="material-icons">view_column</i></li>
					<li><i class="material-icons">view_comfy</i></li>
					<li><i class="material-icons">view_compact</i></li>
					<li><i class="material-icons">view_day</i></li>
					<li><i class="material-icons">view_headline</i></li>
					<li><i class="material-icons">view_list</i></li>
					<li><i class="material-icons">view_module</i></li>
					<li><i class="material-icons">view_quilt</i></li>
					<li><i class="material-icons">view_stream</i></li>
					<li><i class="material-icons">view_week</i></li>
					<li><i class="material-icons">vignette</i></li>
					<li><i class="material-icons">visibility</i></li>
					<li><i class="material-icons">visibility_off</i></li>
					<li><i class="material-icons">voice_chat</i></li>
					<li><i class="material-icons">voicemail</i></li>
					<li><i class="material-icons">volume_down</i></li>
					<li><i class="material-icons">volume_mute</i></li>
					<li><i class="material-icons">volume_off</i></li>
					<li><i class="material-icons">volume_up</i></li>
					<li><i class="material-icons">vpn_key</i></li>
					<li><i class="material-icons">vpn_lock</i></li>
					<li><i class="material-icons">wallpaper</i></li>
					<li><i class="material-icons">warning</i></li>
					<li><i class="material-icons">watch</i></li>
					<li><i class="material-icons">watch_later</i></li>
					<li><i class="material-icons">wb_auto</i></li>
					<li><i class="material-icons">wb_cloudy</i></li>
					<li><i class="material-icons">wb_incandescent</i></li>
					<li><i class="material-icons">wb_iridescent</i></li>
					<li><i class="material-icons">wb_sunny</i></li>
					<li><i class="material-icons">wc</i></li>
					<li><i class="material-icons">web</i></li>
					<li><i class="material-icons">web_asset</i></li>
					<li><i class="material-icons">weekend</i></li>
					<li><i class="material-icons">whatshot</i></li>
					<li><i class="material-icons">widgets</i></li>
					<li><i class="material-icons">wifi</i></li>
					<li><i class="material-icons">wifi_lock</i></li>
					<li><i class="material-icons">wifi_tethering</i></li>
					<li><i class="material-icons">work</i></li>
					<li><i class="material-icons">wrap_text</i></li>
					<li><i class="material-icons">youtube_searched_for</i></li>
					<li><i class="material-icons">zoom_in</i></li>
					<li><i class="material-icons">zoom_out</i></li>
					<li><i class="material-icons">zoom_out_map</i></li>
				</ul>
			</div>
		</main>
<?php
	endwhile;
get_footer(); ?>