<?php

namespace TudoClassificados\Integracoes;

class Bling
{
    public function getXMLProdutos(string $api_key_bling)
    {
        $num_page = $_GET['page_bling'];
        if (!$num_page) $num_page = 1;

        $url = 'https://bling.com.br/Api/v2/produtos/page=' . $num_page . '/json';
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url . '&apikey=' . $api_key_bling . '&imagem=S');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($curl_handle);
        curl_close($curl_handle);
        $resposta = json_decode($response);

        if ($resposta->retorno->erros) {
            if ($resposta->retorno->erros->erro) {
                $erro = $resposta->retorno->erros->erro;
                $erro = ['cod' => $erro->cod, 'msg' => $erro->msg];
            } else {
                $erro = $resposta->retorno->erros[0]->erro;
                $erro = ['cod' => $erro->cod, 'msg' => $erro->msg];
            }
        }

        $resposta = $resposta->retorno->produtos;
        $resposta = ['produtos' => $resposta, 'erro' => $erro];

        return $resposta;
    }

    public function salvarProdutos($produtosBling)
    {
        $user = wp_get_current_user();
        $userId = get_current_user_id();
        $infoSelecionados = $_POST['produto'];
        $dataExpiracao = date('Y-m-d H:i:s', strtotime('+60 days'));
        $jaCadastrados = 0;
        $qtdCadastrado = 0;

        foreach ($produtosBling['produtos'] as $var) {
            $produto = $var->produto;
            $infos = $infoSelecionados[$produto->id];

            if (in_array($produto->id, $_POST['checks'])) {

                if ($this->idEmpty($produto->id) && $this->required($infos)) {
                    $qtdCadastrado++;
                    // Salva Imagens
                    $idImagens = $this->salvaImagens($produto->imagem, $produto->descricao);

                    // Salva Anuncio
                    $this->salvaAnuncios($produto, $infos, $idImagens, $dataExpiracao, $user, $userId);
                } else {
                    $jaCadastrados++;
                    $alerta = "<br>Dentre os selecionados para integração, $jaCadastrados já está(ão) cadastrados.";
                }
            }
        }

        return ['sucesso' => "Foram cadastrados $qtdCadastrado anúncios com sucesso." . $alerta];
    }

    private function idEmpty($id)
    {
        global $wpdb;

        return empty($wpdb->get_results("SELECT meta_id FROM class_postmeta WHERE meta_key = 'id' AND meta_value = '$id'"));
    }

    private function salvaImagens($imagens, $titulo)
    {
        $origem = 'bling';
        $count_img = 0;
        foreach ($imagens as $argImg) {
            if ($count_img < 12) {

                $urlImgExterno = $argImg->link;
                $tituloArquivo = 'img'; //wp_strip_all_tags($titulo);

                include '/home/tudocl45/img.tudoclassificados.com/BaixarImg.php';

                $count_img++;

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

                $post_id = wp_insert_post($salvarImagens); //IMPORTANTE

                $idImagens[] = $post_id;
            }
        }

        return $idImagens;
    }

    private function salvaAnuncios($produto, $infoSelecionados, $idImagens, $dataExpiracao, $user, $userId)
    {
        $preco = number_format($infoSelecionados['preco'], 2, '.', '');
        $conteudoAnuncio = $produto->descricaoCurta;

        if ($_POST['integrar_marketplace_bling']) $tipo = 'marketplace';
        if ($_POST['integrar_filiado_bling']) {
            $tipo = 'filiado';
            $preco = number_format($produto->preco, 2, '.', '');
        }

        // Novo Anuncio
        $anuncio_imovel = array(
            'post_title' => wp_strip_all_tags($produto->descricao),
            'post_content' => wp_strip_all_tags($conteudoAnuncio),
            'comment_status' => 'closed',
            'post_status' => 'publish',
            'ping_status' => 'closed',
            'post_type' => 'acadp_listings',
            'post_author' => $userId,
            'meta_input' => array(
                'id' => wp_strip_all_tags($produto->id),
                'origem' => 'bling',
                'tipo' => $tipo,
                // '_thumbnail_externo_id' => $thumbnail_externo,
                'video' => wp_strip_all_tags($produto->urlVideo),
                'email' => wp_strip_all_tags($user->user_email),
                'website' => wp_strip_all_tags($produto->linkExterno),
                '366' => wp_strip_all_tags($produto->condicao),
                'images' => $idImagens,
                'images_externa' => $idImagens,
                'price' => wp_strip_all_tags($preco),

                'link_externo' => $infoSelecionados['link_externo'],
                'largura' => $infoSelecionados['largura'],
                'altura' => $infoSelecionados['altura'],
                'comprimento' => $infoSelecionados['profundidade'],
                'peso' => $infoSelecionados['peso'],
                'frete_gratis' => $produto->freteGratis,

                'featured' => '0',
                'views' => '1',
                'listing_status' => 'post_status',
                'expiry_date' => $dataExpiracao,
            ),
        );

        $post_id = wp_insert_post($anuncio_imovel);
        wp_set_object_terms($post_id, intval($infoSelecionados['categoria']), 'acadp_categories');
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
            $conteudoAnuncio .= "\n Peso líquido: " . round($produto->pesoLiq, 2)  . " kg \n\n";
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

    private function required($args)
    {
        if ($_POST['integrar_marketplace_bling']) {
            if (
                empty($args['largura']) ||
                empty($args['altura']) ||
                empty($args['profundidade']) ||
                empty($args['peso'])
                //empty($args['categoria']) 
            ) {
                return false;
            }
            return true;
        }

        if ($_POST['integrar_filiado_bling']) {
            if ($args['link_filiado']) {
                return false;
            }
            return true;
        }
    }
}
