<?php

namespace TudoClassificados\Anuncios\Status;

class Renovar
{
    public function execute($post_id)
    {
        // Disable featured
        update_post_meta($post_id, 'featured', 0);

        // Hook for developers
        do_action('acadp_before_renewal', $post_id);

        // ...
        $has_paid_submission = apply_filters('acadp_has_checkout_page', 0, $post_id, 'submission');

        if ($has_paid_submission) {
            $redirect_url = acadp_get_checkout_page_link($post_id);
        } else {
            $time = current_time('mysql');

            // Update post $post_id
            $post_array = array(
                'ID' => $post_id,
                'post_status' => 'publish',
                'post_date' => $time,
                'post_date_gmt' => get_gmt_from_date($time)
            );

            // Update the post into the database
            wp_update_post($post_array);

            // Update the post_meta into the database
            $old_listing_status = get_post_meta($post_id, 'listing_status', true);
            if ('expired' == $old_listing_status) {
                $expiry_date = acadp_listing_expiry_date($post_id);
            } else {
                $old_expiry_date = get_post_meta($post_id, 'expiry_date', true);
                $expiry_date = acadp_listing_expiry_date($post_id, $old_expiry_date);
            }
            update_post_meta($post_id, 'expiry_date', $expiry_date);
            update_post_meta($post_id, 'listing_status', 'post_status');

            // redirect
            $featured_listing_settings = get_option('acadp_featured_listing_settings');

            $has_checkout_page = 0;
            if (!empty($featured_listing_settings['enabled']) && $featured_listing_settings['price'] > 0) {
                $has_checkout_page = 1;
            }

            $has_checkout_page = apply_filters('acadp_has_checkout_page', $has_checkout_page, $post_id);

            if ($has_checkout_page) {
                $redirect_url = acadp_get_checkout_page_link($post_id);
            } else {
                $redirect_url = add_query_arg('renew', 'success', acadp_get_manage_listings_page_link());
            }
        }

        wp_redirect($redirect_url);
        exit();
    }
}