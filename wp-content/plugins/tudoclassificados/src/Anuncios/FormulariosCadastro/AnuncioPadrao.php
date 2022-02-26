<?php

namespace TudoClassificados\Anuncios\FormulariosCadastro;

class AnuncioPadrao
{
    public function execute()
    {
        $is_initial_submission = 1;
        $is_listing_edited = 0;

        $general_settings = get_option('acadp_general_settings');

        $new_listing_status = apply_filters('acadp_new_listing_status', $general_settings['new_listing_status']);
        $post_status = $new_listing_status;

        if (isset($_POST['post_id'])) {
            $post_id = (int)$_POST['post_id'];

            $post_status = get_post_status($post_id);
            if ('pending' === $post_status) {
                // redirect
                wp_redirect($redirect_url);
                exit();
            } elseif ('draft' === $post_status) {
                $post_status = $new_listing_status;
            } else {
                $post_status = $general_settings['edit_listing_status'];
                $is_initial_submission = 0;
                $is_listing_edited = 1;
            }
        }

        if (isset($_POST['action']) && __('Save Draft', 'advanced-classifieds-and-directory-pro') == $_POST['action']) {
            $post_status = 'draft';
            $is_initial_submission = 0;
        }

        // Add the content of the form to $post as an array
        $post_array = array(
            'post_title' => wp_strip_all_tags($_POST['title']),
            'post_name' => sanitize_title($_POST['title']),
            'post_content' => isset($_POST['description']) ? $_POST['description'] : '',
            'post_status' => $post_status,
            'post_type' => 'acadp_listings'
        );

        if (isset($_POST['post_id'])) {
            //update the existing post
            $post_array['ID'] = $post_id;
            wp_update_post($post_array);
        } else {
            //save the new post
            $post_array['post_author'] = get_current_user_id();
            $post_id = wp_insert_post($post_array);
        }

        if ($post_id) {
            // insert category taxonomy
            $cat_ids = array_map('intval', (array)$_POST['acadp_category']);
            $cat_ids = array_unique($cat_ids);

            wp_set_object_terms($post_id, null, 'acadp_categories');
            wp_set_object_terms($post_id, $cat_ids, 'acadp_categories', true);

            // insert custom fields
            if (isset($_POST['acadp_fields'])) {
                foreach ($_POST['acadp_fields'] as $key => $value) {
                    $key = sanitize_key($key);
                    $type = get_post_meta($key, 'type', true);

                    switch ($type) {
                        case 'text' :
                            $value = sanitize_text_field($value);
                            break;
                        case 'textarea' :
                            $value = sanitize_textarea_field($value);
                            break;
                        case 'select' :
                        case 'radio'  :
                            $value = sanitize_text_field($value);
                            break;
                        case 'checkbox' :
                            $value = array_map('sanitize_text_field', $value);
                            $value = implode("\n", array_filter($value));
                            break;
                        case 'url' :
                            $value = esc_url_raw($value);
                            break;
                        default :
                            $value = sanitize_text_field($value);
                    }

                    update_post_meta($post_id, $key, $value);
                }
            }

            // insert images
            if (!empty($general_settings['has_images']) && isset($_POST['images'])) {
                // OK to save meta data
                $images = array_filter($_POST['images']);
                $images = array_map('intval', $images);

                if (count($images)) {
                    $images_limit = apply_filters('acadp_images_limit', (int)$general_settings['maximum_images_per_listing'], $post_id);
                    if ($images_limit > 0) $images = array_slice($images, 0, $images_limit);

                    update_post_meta($post_id, 'images', $images);
                    set_post_thumbnail($post_id, $images[0]);
                } else {
                    delete_post_meta($post_id, 'images');
                    delete_post_thumbnail($post_id);
                }
            } else {
                // Nothing received, all fields are empty, delete option
                delete_post_meta($post_id, 'images');
                delete_post_thumbnail($post_id);
            }

            // insert video
            if (!empty($general_settings['has_video']) && isset($_POST['video'])) {
                $video = esc_url_raw($_POST['video']);
                update_post_meta($post_id, 'video', $video);
            }

            // insert contact details
            if (!empty($general_settings['has_location'])) {
                $address = sanitize_textarea_field($_POST['address']);
                update_post_meta($post_id, 'address', $address);

                wp_set_object_terms($post_id, (int)$_POST['acadp_location'], 'acadp_locations');

                $zipcode = sanitize_text_field($_POST['zipcode']);
                update_post_meta($post_id, 'zipcode', $zipcode);

                $phone = sanitize_text_field($_POST['phone']);
                update_post_meta($post_id, 'phone', $phone);

                $email = sanitize_email($_POST['email']);
                update_post_meta($post_id, 'email', $email);

                $website = esc_url_raw($_POST['website']);
                update_post_meta($post_id, 'website', $website);

                $latitude = isset($_POST['latitude']) ? sanitize_text_field($_POST['latitude']) : '';
                update_post_meta($post_id, 'latitude', $latitude);

                $longitude = isset($_POST['longitude']) ? sanitize_text_field($_POST['longitude']) : '';
                update_post_meta($post_id, 'longitude', $longitude);

                $hide_map = isset($_POST['hide_map']) ? (int)$_POST['hide_map'] : 0;
                update_post_meta($post_id, 'hide_map', $hide_map);

                $cidade = sanitize_text_field($_POST['cidade']);
                update_post_meta($post_id, 'cidade', $cidade);

                $estado = sanitize_text_field($_POST['estado']);
                update_post_meta($post_id, 'estado', $estado);

                // Dimensionamento
                $altura = sanitize_text_field($_POST['altura']);
                update_post_meta($post_id, 'altura', $altura);

                $largura = sanitize_text_field($_POST['largura']);
                update_post_meta($post_id, 'largura', $largura);

                $comprimento = sanitize_text_field($_POST['comprimento']);
                update_post_meta($post_id, 'comprimento', $comprimento);

                $peso = sanitize_text_field($_POST['peso']);
                update_post_meta($post_id, 'peso', $peso);

                $freteGratis = sanitize_text_field($_POST['frete-gratis']);
                update_post_meta($post_id, 'frete_gratis', $freteGratis);

                session_start();
                $_SESSION['novo-anuncio'] = true;
            }

            if (!empty($general_settings['has_price'])) {
                $price = acadp_sanitize_amount($_POST['price']);
                update_post_meta($post_id, 'price', $price);
            }

            if (!empty($general_settings['mark_as_sold'])) {
                $sold = isset($_POST['sold']) ? (int)$_POST['sold'] : 0;
                update_post_meta($post_id, 'sold', $sold);
            }

            // redirect after save
            $redirect_url = home_url();

            if ('draft' == $post_status) {
                $redirect_url = acadp_get_listing_edit_page_link($post_id);
            } else {
                $featured_listing_settings = get_option('acadp_featured_listing_settings');

                $has_checkout_page = 0;

                if (!empty($featured_listing_settings['enabled']) && $featured_listing_settings['price'] > 0) {
                    $has_checkout_page = 1;
                }

                $has_checkout_page = apply_filters('acadp_has_checkout_page', $has_checkout_page, $post_id);

                $redirect_url = ($is_initial_submission && $has_checkout_page) ? acadp_get_checkout_page_link($post_id) : acadp_get_manage_listings_page_link();
            }

            // send emails
            if ($is_initial_submission) {
                update_post_meta($post_id, 'featured', 0);
                update_post_meta($post_id, 'views', 0);
                update_post_meta($post_id, 'listing_status', 'post_status');

                acadp_email_admin_listing_submitted($post_id);
                acadp_email_listing_owner_listing_submitted($post_id);

                if ('publish' == $post_status) {
                    $expiry_date = acadp_listing_expiry_date($post_id);
                    update_post_meta($post_id, 'expiry_date', $expiry_date);

                    acadp_email_listing_owner_listing_approved($post_id);
                }
            } elseif ($is_listing_edited) {
                acadp_email_admin_listing_edited($post_id);
            }

            do_action('acadp_listing_form_after_save', $post_id);

            // redirect
            $redirect_url = apply_filters('acadp_listing_form_redirect_url', $redirect_url, $post_id);
            wp_redirect($redirect_url);
            exit();
        }
    }
}