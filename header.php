<?php
/**
 * The header for this theme.
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
							printf( '<img class="site-logo" src="%1$s" srcset="%1$s 1x, %2$s 2x" alt="%3$s"/>',
								kirki_get_option( 'logo_image' ),
								kirki_get_option( 'logo_image_retina' ),
								get_bloginfo( 'name' )
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
				<i class="fa fa-bars" aria-hidden="true"></i>
				<span class="screen-reader-text"><?php esc_html_e( 'Open Main menu', 'gently' ); ?></span>
			</button>

			<?php

			/* Get which header features to display */
			$header_features = kirki_get_option( 'header_features' );
			if ( is_string( $header_features ) || strpos( $header_features[0], ',' ) ) {
				$header_features = explode( ',', $header_features );
			}

			/* Search form */
			if ( in_array( 'search', $header_features ) ) {
				?>
				<div class="header-search">
					<button class="search-toggle" aria-controls="search-form" aria-expanded="false">
						<i class="btn fa fa-search" aria-hidden="true"></i>
						<span class="screen-reader-text"><?php esc_html_e( 'Open Search form', 'gently' ); ?></span>
					</button>
					<div><?php get_search_form(); ?></div>
				</div>
				<?php
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
				} else if (current_user_can('install_plugins'))  {
					printf('<div class="nav-admin-notice">%s</div>',
							esc_html__( 'There are no menus assigned to Primary Navigation. Create one in Appearance - Menus or in Customizer.', 'gently' )
						);
				}
				?>
			</nav>
			<!-- #site-navigation -->

		</div>
	</header>
	<!-- #masthead -->

	<div id="content" class="site-content">