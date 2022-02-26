<?php
function get_limit_anuncios_premium($userId): array
{
    global $wpdb;
    $qtd_geral_premium = 0;
    $qtd_imoveis_premium = 0;
    $qtd_automoveis_premium = 0;

    $resultado = $wpdb->get_results("SELECT max_anuncios, tipo, `status` 
                                FROM class_imp_contas_premium 
                                WHERE user_id = '$userId' AND `status` = 'approved'");

    foreach ($resultado as $anuncio) {
        if ($anuncio->tipo == 'geral') $qtd_geral_premium += $anuncio->max_anuncios;
        if ($anuncio->tipo == 'imoveis') $qtd_imoveis_premium += $anuncio->max_anuncios;
        if ($anuncio->tipo == 'automoveis') $qtd_automoveis_premium += $anuncio->max_anuncios;
    }

    return [
        'geral' => $qtd_geral_premium,
        'imoveis' => $qtd_imoveis_premium,
        'automoveis' => $qtd_automoveis_premium,
    ];
}

