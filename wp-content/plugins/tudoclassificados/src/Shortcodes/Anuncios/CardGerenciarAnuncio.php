<?php

namespace TudoClassificados\Shortcodes\Anuncios;

use TudoClassificados\Services\Shortcodes\Anuncios\Gerenciar\Afiliado;
use TudoClassificados\Services\Shortcodes\Anuncios\Gerenciar\Classificados;
use TudoClassificados\Services\Shortcodes\Anuncios\Gerenciar\Imoveis;
use TudoClassificados\Services\Shortcodes\Anuncios\Gerenciar\Marketplace;
use TudoClassificados\Services\Shortcodes\Anuncios\Gerenciar\Padrao;

class CardGerenciarAnuncio
{
    public function __construct()
    {
        add_shortcode("tc_card_gerenciar_anuncios", array($this, "run_shortcode_card_gerenciar_anuncios"));
    }

    public function run_shortcode_card_gerenciar_anuncios($atts)
    {
        if ($atts['chave'] == 'marketplace') {
            $service = new Marketplace();
            return $service->executar();
        }

        if ($atts['chave'] == 'classificados') {
            $service = new Classificados();
            return $service->executar();
        }

        if ($atts['chave'] == 'imoveis') {
            $service = new Imoveis();
            return $service->executar();
        }

        if ($atts['chave'] == 'afiliado') {
            $service = new Afiliado();
            return $service->executar();
        }

        $service = new Padrao();
        return $service->execute();
    }
}