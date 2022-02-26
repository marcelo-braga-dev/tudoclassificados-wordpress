<?php

namespace TudoClassificados\Anuncios\Imagens;

class CadastrarImagem
{
    public function cadastrar($titulo, $urlImg)
    {
        $salvarImagens = array(
            'post_author' => get_current_user_id(),
            'post_title' => urlencode(wp_strip_all_tags($titulo)),
            'guid' => $urlImg,
            'comment_status' => 'closed',
            'post_status' => 'inherit',
            'ping_status' => 'closed',
            'post_type' => 'attachment',
            'meta_input' => array(
                '_wp_attached_file' => wp_strip_all_tags($urlImg),
                '_url_externo' => wp_strip_all_tags($urlImg),
            )
        );

        return wp_insert_post($salvarImagens);
    }
}