<?php

/**
 * Register the required plugins for this theme.
 */
function gently_register_required_plugins() {

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

    tgmpa( $plugins );

}
add_action( 'tgmpa_register', 'gently_register_required_plugins' );