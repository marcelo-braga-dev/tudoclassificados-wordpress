<?php

namespace TudoClassificados\Anuncios\Marketplace;


use TudoClassificados\Anuncios\DadosAnuncio;

class CadastrarAnuncioMarketplace
{
    protected function store(DadosAnuncio $dados, $terms)
    {
        $user = wp_get_current_user();
        $userId = get_current_user_id();

        $conteudoAnuncio = $dados->produto->descricaoCurta;

        // Novo Anuncio
        $anuncio_imovel = array(
            'post_title' => wp_strip_all_tags($dados->produto->descricao),
            'post_content' => wp_strip_all_tags($conteudoAnuncio),
            'comment_status' => 'closed',
            'post_status' => 'publish',
            'ping_status' => 'closed',
            'post_type' => 'acadp_listings',
            'post_author' => $userId,
            'meta_input' => array(
                'id' => wp_strip_all_tags($dados->produto->id),
                'tipo' => $dados->tipo,
                'origem' => $dados->origem,
                'video' => wp_strip_all_tags($dados->produto->urlVideo),
                'email' => wp_strip_all_tags($user->user_email),
                'website' => wp_strip_all_tags($dados->produto->linkExterno),
                '366' => wp_strip_all_tags($dados->produto->condicao),
                'images' => $dados->idImagens,
                'images_externa' => $dados->idImagens,
                'price' => wp_strip_all_tags($dados->preco),

                'link_externo' => $dados->infos['link_externo'],
                'largura' => $dados->infos['largura'],
                'altura' => $dados->infos['altura'],
                'comprimento' => $dados->infos['profundidade'],
                'peso' => $dados->infos['peso'],
                'frete_gratis' => $dados->produto->freteGratis,

                'featured' => '0',
                'views' => '0',
                'listing_status' => 'post_status',
                'expiry_date' => $dados->dataExpiracao,
            ),
        );

        $post_id = wp_insert_post($anuncio_imovel);
        wp_set_object_terms($post_id, $terms, 'acadp_categories');
    }
}