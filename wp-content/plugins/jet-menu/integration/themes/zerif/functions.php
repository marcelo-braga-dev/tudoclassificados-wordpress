<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // disable direct access
}

add_action( 'wp_enqueue_scripts', 'jet_menu_zerif_styles', 0 );

/**
 * Enqueue zerif compatibility styles
 *
 * @return void
 */
function jet_menu_zerif_styles() {
	wp_enqueue_style(
		'jet-menu-zerif',
		jet_menu()->integration_manager->get_theme_url( 'assets/css/style.css' ),
		array(),
		jet_menu()->get_version()
	);
}
