<?php

namespace TudoClassificados\Anuncios\Status;

class Deletar
{
    public function execute($post_id)
    {
        $images = get_post_meta($post_id, 'images', true);

        if (!empty($images)) {
            foreach ($images as $image) {
                wp_delete_attachment($image, true);
            }
        }

        wp_delete_post($post_id, true);

        // redirect
        $redirect_url = acadp_get_manage_listings_page_link();
        wp_redirect($redirect_url);
        exit();
    }
}