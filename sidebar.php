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
	<button class="toggle-sidebar">
		<i class="fa fa-caret-right" aria-hidden="true"></i>
		<span class="screen-reader-text"><?php esc_html_e( 'Toggle sidebar', 'gently' ); ?></span>
	</button>
	<div class="widget-area">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
		<button class="toggle-sidebar">
			<i class="fa fa-caret-right" aria-hidden="true"></i>
			<span class="screen-reader-text"><?php esc_html_e( 'Toggle sidebar',  'gently' ); ?></span>
		</button>
	</div>
</div><!-- #secondary -->