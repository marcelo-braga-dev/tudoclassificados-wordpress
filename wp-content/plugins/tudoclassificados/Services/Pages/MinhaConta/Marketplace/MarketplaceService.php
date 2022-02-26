<?php

namespace TudoClassificados\Services\Pages\MinhaConta\Marketplace;

use TudoClassificados\Integracoes\Bling\Bling;

class MarketplaceService
{
    public function index()
    {
        $bling = new Bling();
        $bling->buscarPrudutos();
        $bling->cadastrarAnuncios('marketplace');

        return $bling->getProdutos();
    }
}