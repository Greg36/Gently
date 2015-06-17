<?php

/**
 * Register the required plugins for this theme.
 */
function my_theme_register_required_plugins() {

    $plugins = array(
        //
        array(
            'name'     => 'Kirki customizer',
            'slug'     => 'kirki',
            'required' => true,
        ),
		array(
			'name'     => 'Mailchimp for WordPress',
			'slug'     => 'mailchimp-for-wp',
			'required' => false
		)
    );

    $config = array(
        'message'      => '<div class="update-nag"><h4 style="color:#ce1714">Kirki is mandatory for theme functionality.</h4><p><strong>All other recommended plugins are tested to use with theme, install that as you need.</strong></p></div>'
    );

    tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );