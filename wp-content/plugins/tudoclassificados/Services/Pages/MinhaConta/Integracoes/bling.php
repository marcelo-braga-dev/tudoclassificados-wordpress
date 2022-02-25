<?php

use TudoClassificados\Integracoes\Bling\CadastrarProdutoBling;
use TudoClassificados\Integracoes\Bling\Requisicao;

function tc_get_produtos_bling()
{
    if (!empty($_GET['token_bling'])) {
        $clsBling = new Requisicao();
        return $clsBling->getProdutos($_GET['token_bling']);
    }
}

function tc_integrar_bling($produtos)
{
    $clsBling = new CadastrarProdutoBling();
    $clsBling->cadastrar($produtos);

    session('aba_minha_conta', 'classificados');
    wp_redirect('/minha-conta');
    exit();
}