<?php

namespace TudoClassificados\Services\Shortcodes\Anuncios\Gerenciar;

use WP_Query;

class Imoveis
{
    public function executar()
    {
        if (!is_user_logged_in()) {
            return acadp_login_form();
        }

        if (!acadp_current_user_can('edit_acadp_listings')) {
            return __('You do not have sufficient permissions to access this page.', 'advanced-classifieds-and-directory-pro');
        }

        $shortcode = 'acadp_manage_listings_imoveis';

        $general_settings = get_option('acadp_general_settings');
        $listings_settings = get_option('acadp_listings_settings');
        $page_settings = get_option('acadp_page_settings');
        $featured_listing_settings = get_option('acadp_featured_listing_settings');

        $can_show_images = empty($general_settings['has_images']) ? false : true;
        $can_renew = empty($general_settings['has_listing_renewal']) ? false : true;
        $has_location = empty($general_settings['has_location']) ? false : true;



        $can_promote = false;
        if (!empty($featured_listing_settings['enabled']) && $featured_listing_settings['price'] > 0) {
            $can_promote = true;
        }
        $can_promote = apply_filters('acadp_can_promote', $can_promote);



        wp_enqueue_script(ACADP_PLUGIN_NAME . '-validator');

        wp_enqueue_script(ACADP_PLUGIN_NAME);

        // Define the query
        $paged = acadp_get_page_number();

        $args = array(
            'post_type' => 'acadp_listings',
            'post_status' => 'any',
            'posts_per_page' => !empty($listings_settings['listings_per_page']) ? $listings_settings['listings_per_page'] : -1,
            'paged' => $paged,
            'author' => get_current_user_id(),
            's' => isset($_REQUEST['u']) ? sanitize_text_field($_REQUEST['u']) : '',
            'meta_value' => 'imoveis',
        );

        $acadp_query = new WP_Query($args);

        // Start the Loop
        global $post;

        // Process output
        ob_start();
        include TUDOCLASSIFICADOS_PATH . 'views/components/minha-conta/imoveis/edit-anuncio.php';
        wp_reset_postdata();
        return ob_get_clean();
    }
}