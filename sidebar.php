<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Gently
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="main-sidebar" role="complementary">
	<button class="clear" id="toggle-sidebar"><i class="fa fa-caret-right"></i></button>
	<div class="widget-area">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</div><!-- #secondary -->
