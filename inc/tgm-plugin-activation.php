<?php

/**
 * Register the required plugins for this theme.
 */
function my_theme_register_required_plugins() {

    $plugins = array(
        //
        array(
            'name'      => 'Kirki customizer',
            'slug'      => 'kirki',
            'required'  => true,
        ),
		array(
			'name'      => 'Mailchimp for WordPress',
			'slug'      => 'mailchimp-for-wp',
			'required'  => false
		)
    );

    $config = array(
        'message'      => '<h1>All recommended plugins.</h1>'
    );

    tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );