<?php

namespace TudoClassificados\Services\Shortcodes\Anuncios\FormulariosCadastro\CustomFields;

use WP_Query;

class FieldsPadrao
{
    public function execute($post_id)
    {
        $ajax = false;
        $terms = array();

        if (isset($_POST['terms'])) {
            check_ajax_referer('acadp_ajax_nonce', 'security');

            $ajax = true;
            $post_id = (int)$_POST['post_id'];
            $terms = is_array($_POST['terms']) ? array_map('intval', $_POST['terms']) : (int)$_POST['terms'];
        } else {
            $post_id = (int)$post_id;

            if ($post_id > 0) {
                $terms = wp_get_object_terms($post_id, 'acadp_categories', array('fields' => 'ids'));
            }
        }

        // Get post meta for the given post_id
        $post_meta = get_post_meta($post_id);

        // Get custom fields
        $custom_field_ids = acadp_get_custom_field_ids($terms);

        if (!empty($custom_field_ids)) {
            $args = array(
                'post_type' => 'acadp_fields',
                'post_status' => 'publish',
                'posts_per_page' => 500,
                'post__in' => $custom_field_ids,
                'meta_key' => 'order',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
            );

            $acadp_query = new WP_Query($args);

            // Start the Loop
            global $post;

            // Process output
            ob_start();
            include(acadp_get_template("user/acadp-public-custom-fields-display.php"));
            wp_reset_postdata(); // Restore global post data stomped by the_post()
            $output = ob_get_clean();

            print $output;
        }

        if ($ajax) {
            wp_die();
        }
    }
}