<?php

namespace TudoClassificados\Integracoes\Bling;

class Requisicao
{
    public function getProdutos($apiKey): array
    {
        $erro = '';
        $num_page = $_GET['page_bling'];
        if (!$num_page) $num_page = 1;

        $url = 'https://bling.com.br/Api/v2/produtos/page=' . $num_page . '/json';
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url . '&apikey=' . $apiKey . '&imagem=S');
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

        return ['produtos' => $resposta, 'erro' => $erro];
    }
}