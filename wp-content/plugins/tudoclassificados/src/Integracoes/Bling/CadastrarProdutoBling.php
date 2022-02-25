<?php

namespace TudoClassificados\Integracoes\Bling;

use TudoClassificados\Classificados\DadosAnuncio;
use TudoClassificados\Classificados\Imagens\SalvarImagens;
use TudoClassificados\Classificados\Produtos\CadastrarProdutos;

class CadastrarProdutoBling extends CadastrarProdutos
{
    private $dataExpiracao;

    public function __construct()
    {
        $this->dataExpiracao = date('Y-m-d H:i:s', strtotime('+60 days'));
    }

    public function cadastrar($produtos)
    {
        $jaCadastrados = 0;
        $qtdCadastrado = 0;
        $infoSelecionados = $_POST['produto'];
        $idSelecionados = $_POST['checks'];

        foreach ($produtos['produtos'] as $var) {
            $produto = $var->produto;
            $infos = $infoSelecionados[$produto->id];

            if (in_array($produto->id, $idSelecionados)) {

                if ($this->idEmpty($produto->id) && !$this->required($infos)) {
                    $qtdCadastrado++;

                    $imagens = new SalvarImagens();
                    $idImagens = $imagens->salvarImagens($produto->imagem);

                    $dados = new DadosAnuncio();
                    $dados->preco = number_format($produto->preco, 2, '.', '');
                    $dados->origem = 'bling';
                    $dados->produto = $produto;
                    $dados->infos = $infos;
                    $dados->dataExpiracao = $this->dataExpiracao;
                    $dados->idImagens = $idImagens;

                    $this->salvaAnuncios($dados);

                    return ['sucesso' => "Foram cadastrados $qtdCadastrado anúncios com sucesso."];
                }

                $jaCadastrados++;
                $alerta = "<br>Dentre os selecionados para integração, $jaCadastrados já está(ão) cadastrados.";

            }
        }
    }


    private function idEmpty($id)
    {
        global $wpdb;

        return empty($wpdb->get_results("SELECT meta_id FROM class_postmeta WHERE meta_key = 'id' AND meta_value = '$id'"));
    }

    private function required($args)
    {
        if ($_POST['integrar_marketplace_bling']) {
            return empty($args['largura']) ||
                empty($args['altura']) ||
                empty($args['profundidade']) ||
                empty($args['peso']);
        }

        if ($_POST['integrar_filiado_bling']) {
            return empty($args['link_filiado']);
        }
    }

    private function descricaoAnuncio($produto)
    {
        $conteudoAnuncio = $produto->descricaoCurta;

        if ($produto->observacoes) {
            $conteudoAnuncio .= "\n\n Observações:\n" . $produto->observacoes . "\n\n";
        }

        if ($produto->pesoBruto) {
            $conteudoAnuncio .= "\n\n Peso bruto: " . round($produto->pesoBruto, 2) . ' kg';
        }
        if ($produto->pesoLiq) {
            $conteudoAnuncio .= "\n Peso líquido: " . round($produto->pesoLiq, 2) . " kg \n\n";
        }

        if ($produto->larguraProduto) {
            $conteudoAnuncio .= "\n\n Largura: " . $produto->larguraProduto . ' ' . $produto->unidadeMedida;
        }
        if ($produto->alturaProduto) {
            $conteudoAnuncio .= "\n Altura: " . $produto->alturaProduto . ' ' . $produto->unidadeMedida;
        }
        if ($produto->profundidadeProduto) {
            $conteudoAnuncio .= "\n Profundidade: " . $produto->profundidadeProduto . ' ' . $produto->unidadeMedida;
        }

        if ($produto->descricaoComplementar) {
            $conteudoAnuncio .= "\n\n" . $produto->descricaoComplementar;
        }

        if ($produto->freteGratis == 'S') {
            $conteudoAnuncio .= "\n\n Frete Grátis." . $produto->freteGratis;
        }
    }
}