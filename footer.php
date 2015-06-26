<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div, #page div and all content after
 *
 * @package Gently
 */
?>

<footer id="colophon" class="site-footer" role="contentinfo">
	<?php if ( has_nav_menu( 'secondary' ) ) { ?>
		<nav class="secondary-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu', 'depth' => 1 ) ); ?>
		</nav>
	<?php } ?>

	<div class="site-info">
		<?php echo wp_kses_post( kirki_get_option( 'footer_text' ) ); ?>
	</div>
	<!-- .site-info -->
</footer><!-- #colophon -->

</div><!-- #content -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
