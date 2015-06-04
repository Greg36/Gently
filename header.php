<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Gently
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'gently' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<?php if ( get_header_image() ) : ?>
			<div class="header-image">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
				</a>
			</div>
		<?php endif; // End header image check. ?>

		<div class="top-bar">
			<div class="site-branding">
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php
						if ( kirki_get_option( 'logo_image' ) ) {
							echo '<img class="site-logo" src="' . kirki_get_option( 'logo_image' ) . '" alt=""/>';
						} else {
							bloginfo( 'name' );
						}
						?>
					</a>
				</h1>
			</div><!-- .site-branding -->

			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-bars"></i></button>

			<?php
			/* Kirki weirdly saves multicheck options, if there is a single check it's string if more, array. */
			if ( is_array( kirki_get_option( 'header_features' ) ) ){
				$header_social = in_array( 'social', kirki_get_option( 'header_features' ) );
				$header_search = in_array( 'search', kirki_get_option( 'header_features' ) );
			} else {
				$header_social = kirki_get_option( 'header_features' ) == 'social' ? true : false;
				$header_search = kirki_get_option( 'header_features' ) == 'search' ? true : false;
			}

			/* Search form */
			if ( $header_search ) {
				echo '<div class="header-search"><i class="btn fa fa-search" tabindex="0"></i><div>' . get_search_form( false ) . '</div></div>';
			}

			/* Social icons */
			if ( $header_social ){
				gently_social_links();
			}
			?>

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'walker' => new Gently_Menu_Walker(), ) ); ?>
			</nav><!-- #site-navigation -->

		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
