<?php

namespace TudoClassificados\Shortcodes\Anuncios;

use TudoClassificados\Shortcodes\Anuncios\Classificados\Templates\AnuncioUnicoClassificados;
use TudoClassificados\Shortcodes\Anuncios\Imoveis\Templates\AnuncioUnicoImoveis;
use TudoClassificados\Shortcodes\Anuncios\Marketplaces\Templates\AnuncioUnicoMarketplace;

class AnuncioUnico
{
    public function execute($content)
    {
        if (is_singular('acadp_listings') && in_the_loop() && is_main_query()) {
            global $post;

            $postMeta = get_post_meta($post->ID);
            $tipo = $postMeta['tipo'][0];

            if ($tipo == 'classificados') {
                $anuncio = new AnuncioUnicoClassificados();
                return $anuncio->execute($post, $content);
            }

            if ($tipo == 'marketplace') {
                $anuncio = new AnuncioUnicoMarketplace();
                return $anuncio->execute($post, $content);
            }

            if ($tipo == 'imoveis') {
                $anuncio = new AnuncioUnicoImoveis();
                return $anuncio->execute($post, $content);
            }

        }

        return $content;
    }
}