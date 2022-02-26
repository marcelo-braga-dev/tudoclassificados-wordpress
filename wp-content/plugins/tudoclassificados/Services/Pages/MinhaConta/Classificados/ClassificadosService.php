<?php

namespace TudoClassificados\Services\Pages\MinhaConta\Classificados;

use TudoClassificados\Integracoes\Bling\CadastrarProdutoBling;
use TudoClassificados\Integracoes\Bling\Requisicao;

class ClassificadosService
{
    public function index()
    {
        if (!empty($_GET['token_bling'])) {
            $clsBling = new Requisicao();
            $produtosBling = $clsBling->getProdutos($_GET['token_bling']);

            session('aba_minha_conta', 'classificados-integrar-bling');
            if (empty($_POST['checks'])) return $produtosBling;

            $this->cadastrarAnuncios($produtosBling);
        }
    }

    private function cadastrarAnuncios(array $produtosBling): void
    {
        $clsBling = new CadastrarProdutoBling('classificados');
        $clsBling->cadastrar($produtosBling);

        session('aba_minha_conta', 'classificados');
        wp_redirect('/minha-conta');
        exit();
    }
}