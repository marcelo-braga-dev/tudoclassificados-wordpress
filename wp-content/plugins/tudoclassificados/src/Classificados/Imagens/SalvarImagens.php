<?php

namespace TudoClassificados\Classificados\Imagens;

class SalvarImagens
{
    public function salvarImagens($imagens): array
    {
        $count_img = 0;
        $idImagens = [];

        foreach ($imagens as $argImg) {
            if ($count_img < 12) {
                $count_img++;

                $repositorio = new RepositorioExterno();
                $urlImg = $repositorio->download($argImg->link, 'img', 'bling');

                $salvarImagens = array(
                    'post_author' => get_current_user_id(),
                    'post_title' => wp_strip_all_tags($argImg->NomeArquivo),
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

                $post_id = wp_insert_post($salvarImagens);
                $idImagens[] = $post_id;
            }
        }

        return $idImagens;
    }
}