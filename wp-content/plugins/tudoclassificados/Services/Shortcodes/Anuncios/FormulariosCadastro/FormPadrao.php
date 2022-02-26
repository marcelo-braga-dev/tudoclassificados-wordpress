<?php

namespace TudoClassificados\Services\Shortcodes\Anuncios\FormulariosCadastro;

class FormPadrao
{
    public function execute()
    {
        if (!is_user_logged_in()) {
            return acadp_login_form();
        }

        $post_id = 'edit' == get_query_var('acadp_action') ? get_query_var('acadp_listing', 0) : 0;
        $has_permission = true;

        if ($post_id > 0) {
            if (!acadp_current_user_can('edit_acadp_listing', $post_id)) {
                $has_permission = false;
            }
        } elseif (!acadp_current_user_can('edit_acadp_listings')) {
            $has_permission = false;
        }

        if (!$has_permission) {
            return __('You do not have sufficient permissions to access this page.', 'advanced-classifieds-and-directory-pro');
        }

        $shortcode = 'acadp_listing_form';

        $general_settings = get_option('acadp_general_settings');
        $locations_settings = get_option('acadp_locations_settings');
        $categories_settings = get_option('acadp_categories_settings');
        $recaptcha_settings = get_option('acadp_recaptcha_settings');

        // Enqueue style dependencies
        wp_enqueue_style(ACADP_PLUGIN_NAME);

        // Enqueue script dependencies
        wp_enqueue_script('jquery-form', array('jquery'), false, true);
        wp_enqueue_script('jquery-ui-sortable');
        wp_enqueue_script('jquery-touch-punch');

        if (wp_script_is(ACADP_PLUGIN_NAME . '-bootstrap', 'registered')) {
            wp_enqueue_script(ACADP_PLUGIN_NAME . '-bootstrap');
        }

        wp_enqueue_script(ACADP_PLUGIN_NAME . '-validator');
        wp_enqueue_script(ACADP_PLUGIN_NAME);
        wp_enqueue_script(ACADP_PLUGIN_NAME . '-google-map');

        if (isset($recaptcha_settings['forms']) && in_array('listing', $recaptcha_settings['forms'])) {
            wp_enqueue_script(ACADP_PLUGIN_NAME . "-recaptcha");
        }

        // ...
        $has_draft = 1;
        $category = 0;
        $default_location = '';

        $disable_parent_categories = empty($general_settings['disable_parent_categories']) ? false : true;
        $editor = !empty($general_settings['text_editor']) ? $general_settings['text_editor'] : 'wp_editor';

        $can_add_price = empty($general_settings['has_price']) ? false : true;
        $can_add_images = empty($general_settings['has_images']) ? false : true;
        $can_add_video = empty($general_settings['has_video']) ? false : true;
        $can_add_location = empty($general_settings['has_location']) ? false : true;
        $has_map = empty($general_settings['has_map']) ? false : true;
        $mark_as_sold = empty($general_settings['mark_as_sold']) ? false : true;

        $images_limit = apply_filters('acadp_images_limit', (int)$general_settings['maximum_images_per_listing'], $post_id);

        if ($can_add_location) {
            $location = ($general_settings['default_location'] > 0) ? $general_settings['default_location'] : $general_settings['base_location'];
            if ($location > 0) {
                $term = get_term_by('id', $location, 'acadp_locations');
                $default_location = $term->name;
            }
        }

        if ($post_id > 0) {
            $post = get_post($post_id);
            setup_postdata($post);

            $post_meta = get_post_meta($post_id);

            if ($post->post_status !== 'draft') {
                $has_draft = 0;
            }

            $category = wp_get_object_terms($post_id, 'acadp_categories', array('fields' => 'ids'));
            $category = $category[0];

            if ($can_add_location) {
                $location = wp_get_object_terms($post_id, 'acadp_locations', array('fields' => 'ids'));
                $location = !empty($location) ? $location[0] : -1;
            }
        }

        ob_start();
        include(acadp_get_template("user/acadp-public-edit-listing-display.php"));
        wp_reset_postdata(); // Restore global post data stomped by the_post()
        return ob_get_clean();
    }
}