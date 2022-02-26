<?php

namespace TudoClassificados\Anuncios\Status;

class RemoverFavoritos
{
    public function executar($post_id)
    {
        $favourites = (array)get_user_meta(get_current_user_id(), 'acadp_favourites', true);

        if (in_array($post_id, $favourites)) {
            if (($key = array_search($post_id, $favourites)) !== false) {
                unset($favourites[$key]);
            }
        }

        $favourites = array_filter($favourites);
        $favourites = array_values($favourites);

        delete_user_meta(get_current_user_id(), 'acadp_favourites');
        update_user_meta(get_current_user_id(), 'acadp_favourites', $favourites);

        // redirect
        $redirect_url = acadp_get_favourites_page_link();
        wp_redirect($redirect_url);
        exit();
    }
}