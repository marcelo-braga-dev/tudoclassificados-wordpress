<?php

/**
 * This template displays the listing form.
 *
 * @link    https://pluginsware.com
 * @since   1.0.0
 *
 * @package Advanced_Classifieds_And_Directory_Pro
 */

if ( $post_id > 0 ) {
	$email = '';

	if ( isset( $post_meta['email'] ) ) {
		$email = $post_meta['email'][0];
	}
} else {
	$current_user = wp_get_current_user();
	$email = $current_user->user_email;
}
require_once ABSPATH.'wp-functions/pages/novo_anuncio/index.php';
?>
