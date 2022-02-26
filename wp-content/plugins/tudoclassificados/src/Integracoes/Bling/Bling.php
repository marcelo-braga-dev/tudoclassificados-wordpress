<?php

namespace TudoClassificados\Integracoes\Bling;

class Bling
{
    private $produtos;

    public function __construct()
    {
        $this->produtos = [];
    }

    public function buscarPrudutos()
    {
        if (!empty($_GET['token_bling'])) {
            $clsBling = new Requisicao();
            $this->produtos = $clsBling->getProdutos($_GET['token_bling']);
        }

        session('aba_minha_conta', 'marketplace-integrar-bling');
        return $this->produtos;
    }

    public function cadastrarAnuncios(string $tipo)
    {
        if (!empty($_POST['checks'])) {
            $clsBling = new CadastrarProdutoBling($tipo);
            $clsBling->cadastrar($this->produtos);

            session('aba_minha_conta', $tipo);
            wp_redirect('/minha-conta');
            exit();
        }
    }

    public function getProdutos()
    {
        return $this->produtos;
    }
}
