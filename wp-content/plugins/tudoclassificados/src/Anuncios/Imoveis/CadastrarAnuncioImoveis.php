<?php

namespace TudoClassificados\Anuncios\Imoveis;

class CadastrarAnuncioImoveis
{
    public function store(DadosImovel $dados)
    {
        $anuncio_imovel = array(
            'post_title' => wp_strip_all_tags($dados->infos->TituloImovel),
            'post_content' => wp_strip_all_tags($dados->infos->Observacao) . $dados->caracteristicas,
            'comment_status' => 'closed',
            'post_status' => 'publish',
            'ping_status' => 'closed',
            'post_type' => 'acadp_listings',
            'post_author' => get_current_user_id(),
            'meta_input' => array(
                'id' => wp_strip_all_tags($dados->infos->id),
                '_thumbnail_id' => '$thumbnail',
                'origem' => 'ingaia',
                'tipo' => 'imoveis',
                'images' => $dados->imagens,
                'video' => '',
                'address' => wp_strip_all_tags($dados->infos->Endereco),
                'bairro' => wp_strip_all_tags($dados->infos->Bairro),
                'cidade' => wp_strip_all_tags($dados->infos->Cidade),
                'estado' => wp_strip_all_tags($dados->infos->Estado),
                'pais' => wp_strip_all_tags($dados->infos->Pais),
                'zipcode' => wp_strip_all_tags(''),
                'phone' => wp_strip_all_tags($dados->infos->corretor->celular),
                'email' => wp_strip_all_tags($dados->infos->corretor->email),
                'website' => wp_strip_all_tags($dados->infos->URLGaiaSite),
                'latitude' => wp_strip_all_tags($dados->infos->latitude),
                'longitude' => wp_strip_all_tags($dados->infos->longitude),
                'hide_map' => wp_strip_all_tags(''),

                'price' => wp_strip_all_tags($dados->infos->PrecoVenda),
                'preco_aluguel' => wp_strip_all_tags($dados->infos->PrecoLocacao),

                'featured' => '0',
                'views' => '1',
                'listing_status' => 'post_status',
                'expiry_date' => $dados->dataExpiracao,
                '505' => $dados->caracteristicas,
                '506' => wp_strip_all_tags($dados->infos->QtdDormitorios),
                '508' => wp_strip_all_tags($dados->infos->QtdBanheiros),
                '509' => wp_strip_all_tags($dados->infos->QtdVagas),
                '512' => wp_strip_all_tags($dados->infos->QtdSuites),
                '510' => wp_strip_all_tags($dados->infos->AreaUtil),
                '511' => wp_strip_all_tags($dados->infos->AreaTotal)
            ),
        );

        $idCategoria = 166;

        if ($dados->infos->TipoImovel[0] == 'Apartamento') $idCategoria = 36;
        if ($dados->infos->TipoImovel[0] == 'Terreno') $idCategoria = 95;
        if ($dados->infos->TipoImovel[0] == 'Casa') $idCategoria = 35;
        if ($dados->infos->TipoImovel[0] == 'Prédio') $idCategoria = '';
        if ($dados->infos->TipoImovel[0] == 'Sala') $idCategoria = 165;

        $post_id = wp_insert_post($anuncio_imovel);
        wp_set_object_terms($post_id, intval($idCategoria), 'acadp_categories');
    }
}