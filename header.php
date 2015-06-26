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
	<link rel="shortcut icon" href="<?php echo kirki_get_option( 'favicon' ); ?>"/>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'gently' ); ?></a>

	<?php if ( get_header_image() ) : ?>
		<div class="header-image">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
			</a>
		</div>
	<?php endif; // End header image check. ?>

	<header id="masthead" class="site-header" role="banner">
		<div class="top-bar">
			<div class="site-branding">
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php
						if ( kirki_get_option( 'logo_image' ) ) {
							printf( '<img class="site-logo" src="%1$s" srcset="%1$s 1x, %2$s 2x" alt="logo"/>',
								kirki_get_option( 'logo_image' ),
								kirki_get_option( 'logo_image_retina' )
							);
						} else {
							bloginfo( 'name' );
						}
						?>
					</a>
				</h1>
			</div>
			<!-- .site-branding -->

			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<i class="fa fa-bars"></i>
				<span class="screen-reader-text"><?php esc_html_e( 'Main menu', 'gently' ); ?></span>
			</button>

			<?php

			$header_features = kirki_get_option( 'header_features' );
			if ( is_string( $header_features ) || strpos( $header_features[0], ',' ) ) {
				$header_features = explode( ',', $header_features );
			}

			/* Search form */
			if ( in_array( 'search', $header_features ) ) {
				echo '<div class="header-search"><i class="btn fa fa-search" tabindex="0"></i><div>' . get_search_form( false ) . '</div></div>';
			}

			/* Social icons */
			if ( in_array( 'social', $header_features ) ) {
				gently_social_links();
			}
			?>

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'walker' => new Gently_Menu_Walker() ) );
				} else {
					wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) );
				}
				?>
			</nav>
			<!-- #site-navigation -->

		</div>
	</header>
	<!-- #masthead -->

	<div id="content" class="site-content">