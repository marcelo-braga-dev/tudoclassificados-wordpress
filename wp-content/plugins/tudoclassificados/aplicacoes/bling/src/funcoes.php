<?php

function setApiBling($user_id)
{   //$api_key_bling = '20e4109dc2eafabe7604443cf45d56b356d308c06c3b20af83a78eb4d6f80693be969184';
    global $wpdb;

    $table = 'class_awpcp_inte_apikey';

    $api_key_bling = trim($_POST['api-key-bling']);
    $api_key_bling = str_replace(' ', '', $api_key_bling);

    $info_table = $wpdb->get_results("SELECT id FROM $table WHERE user_id = $user_id AND origem = 'bling'");

    if ($info_table) {
        $data = ['api_key' => $api_key_bling];
        $where = ['user_id' => $user_id, 'origem' => 'bling'];
        $wpdb->update($table, $data, $where);

        return;
    }

    $wpdb->insert(
        $table,
        array(
            'user_id' => $user_id,
            'origem' => 'bling',
            'api_key' => $api_key_bling,
        )
    );
}

function getApiBling($user_id)
{
    global $wpdb;

    $table = 'class_awpcp_inte_apikey';

    if (empty($api_key_bling)) {
        $info_table = $wpdb->get_results("SELECT * FROM $table WHERE user_id = $user_id AND origem = 'bling'");
        $api_key_bling = $info_table[0]->api_key;
    }
    if (empty($api_key_bling)) $api_key_bling = '0';
    return $api_key_bling;
}

function comunicacaoBling($api_key_bling)
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

function pesquisaCategoria(array $categoriasCadastradas, array $term_taxonomys)
{
    // Verifica se é categoria de anuncios
    $termTaxonomy = [];
    foreach ($term_taxonomys as $term_taxonomy) {
        $termTaxonomy[$term_taxonomy->term_id] = $term_taxonomy->term_id;
    }


    foreach ($categoriasCadastradas as $categorias) {
        if (in_array($categorias->term_id, $termTaxonomy)) {
            
        }
    }
}
