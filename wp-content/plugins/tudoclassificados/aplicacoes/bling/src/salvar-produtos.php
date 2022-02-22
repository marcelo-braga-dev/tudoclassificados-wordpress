<?php
function salvarProdutos($user_id, $api_key_bling, $args, $produtos_bling)
{
    global $wpdb;

    $current_user = wp_get_current_user();

    $origem = 'bling';
    // echo '<pre>';
    // print_r($produtos_bling);
    // echo '</pre>';exit();
    foreach ($produtos_bling['produtos'] as $produto) {

        $info_produto = $produto->produto;

        $id = $info_produto->id;

        $exist_id = $wpdb->get_results("SELECT meta_id FROM class_postmeta WHERE meta_key = 'id' AND meta_value = '$id'");

        if (empty($exist_id)) : 

            if (in_array($info_produto->id, $args['check-bling'])) {

                // Imagens
                $count_img = 0;
                foreach ($info_produto->imagem as $argImg) {
                    if ($count_img < 12) {

                        $urlImgExterno = $argImg->link;
                        $tituloArquivo = 'x'.wp_strip_all_tags($argImg->NomeArquivo);

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

                        $arrayImg[] = $post_id;

                        if (empty($thumbnail)) {
                            $thumbnail_externo = $post_id;
                        }
                    }
                }

                $status_anuncio = count($arrayImg) >= 1 ? 'publish' : 'sem_imagens';

                $conteudoAnuncio = $info_produto->descricaoCurta;

                if ($info_produto->observacoes) {
                    $conteudoAnuncio .= "\n\n Observações:\n" . $info_produto->observacoes . "\n\n";
                }

                if ($info_produto->pesoBruto) {
                    $conteudoAnuncio .= "\n\n Peso bruto: " . round($info_produto->pesoBruto, 2) . ' kg';
                }
                if ($info_produto->pesoLiq) {
                    $conteudoAnuncio .= "\n Peso líquido: " . round($info_produto->pesoLiq, 2)  . " kg \n\n";
                }

                if ($info_produto->larguraProduto) {
                    $conteudoAnuncio .= "\n\n Largura: " . $info_produto->larguraProduto . ' ' . $info_produto->unidadeMedida;
                }
                if ($info_produto->alturaProduto) {
                    $conteudoAnuncio .= "\n Altura: " . $info_produto->alturaProduto . ' ' . $info_produto->unidadeMedida;
                }
                if ($info_produto->profundidadeProduto) {
                    $conteudoAnuncio .= "\n Profundidade: " . $info_produto->profundidadeProduto . ' ' . $info_produto->unidadeMedida;
                }

                if ($info_produto->descricaoComplementar) {
                    $conteudoAnuncio .= "\n\n" . $info_produto->descricaoComplementar;
                }

                if ($info_produto->freteGratis == 'S') {
                    $conteudoAnuncio .= "\n\n Frete Grátis." . $info_produto->freteGratis;
                }


                $idCategoria = $_POST[$info_produto->id];


                $dataExpiracao = date('Y-m-d H:i:s', strtotime('+30 days'));
                $preco = number_format($info_produto->preco, 2, '.', '');

                // Novo Anuncio
                $anuncio_imovel = array(
                    'post_title' => wp_strip_all_tags($info_produto->descricao),
                    'post_content' => wp_strip_all_tags($conteudoAnuncio),
                    'comment_status' => 'closed',
                    'post_status' => $status_anuncio,
                    'ping_status' => 'closed',
                    'post_type' => 'acadp_listings',
                    'post_author' => get_current_user_id(),
                    'meta_input' => array(
                        'id' => wp_strip_all_tags($info_produto->id),
                        'origem' => 'bling',
                        '_thumbnail_externo_id' => $thumbnail_externo,
                        'video' => wp_strip_all_tags($info_produto->urlVideo),
                        'email' => wp_strip_all_tags($current_user->user_email),
                        'website' => wp_strip_all_tags($info_produto->linkExterno),
                        '366' => wp_strip_all_tags($info_produto->condicao),
                        'images' => $arrayImg,
                        'images_externa' => $arrayImg,
                        'price' => wp_strip_all_tags($preco),

                        'largura' => $info_produto->larguraProduto,
                        'altura' => $info_produto->alturaProduto,
                        'comprimento' => $info_produto->profundidadeProduto,
                        'peso' => $info_produto->pesoBruto,
                        'frete_gratis' => $info_produto->freteGratis,

                        'featured' => '0',
                        'views' => '1',
                        'listing_status' => 'post_status',
                        'expiry_date' => $dataExpiracao,
                    ),
                );

                $post_id = wp_insert_post($anuncio_imovel); // IMPORTANTE
                wp_set_object_terms($post_id, intval($idCategoria), 'acadp_categories'); // IMPORTANTE                


                $conteudoAnuncio = ''; // IMPORTANTE
                $thumbnail = '';
                unset($idCategoria);
                unset($arrayImg);
                unset($anuncio_imovel);
            }

        endif;
    }

    $redirect_url = '/minha-conta';
    wp_redirect($redirect_url);
    exit();
}