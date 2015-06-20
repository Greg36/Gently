<?php

/**
 * Register the required plugins for this theme.
 */
function my_theme_register_required_plugins() {

    $plugins = array(
        //
        array(
            'name'             => 'Kirki customizer',
            'slug'             => 'kirki',
            'required'         => true,
	        'force_activation' => true
        ),
		array(
			'name'     => 'Mailchimp for WordPress',
			'slug'     => 'mailchimp-for-wp',
			'required' => false
		),
	    array(
		    'name'     => 'RICG Responsive Images',
		    'slug'     => 'ricg-responsive-images',
		    'required' => false
	    ),
	    array(
		    'name'     => 'Contact Form 7',
		    'slug'     => 'contact-form-7',
		    'required' => false
	    )
    );

    $config = array(
        'message'      => '<div class="update-nag"><h4 style="color:#ce1714">Kirki is mandatory for theme functionality.</h4><p><strong>Other plugins install based on your needs.</strong></p></div>'
    );

    tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );