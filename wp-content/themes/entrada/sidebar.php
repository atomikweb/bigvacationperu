<?php
/**
 * The sidebar containing the main widget area.
 *
 *
 * @package Entrada
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<aside id="sidebar" class="col-sm-4 col-md-3 sidebar">
	<div class="sidebar-holder">
		<div class="accordion">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>
	</div>
</aside>