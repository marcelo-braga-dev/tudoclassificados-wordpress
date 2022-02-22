<?php

use TudoClassificados\Integracoes\Bling;

function tc_get_produtos_bling()
{
    if (!empty($_GET['token_bling'])) {
        $clsBling = new Bling();

        return $clsBling->getXMLProdutos($_GET['token_bling']);
    }    
}

// function tc_integrar_marketplace_bling($produtos)
// {//89268f9bd090d8c6bd9d399168d1045c59ddc345886c1c702404bb5892bc75fa7ae13562
// }

function tc_integrar_bling($produtos)
{
    if (!empty($_POST['integrar_marketplace_bling']) || !empty($_POST['integrar_filiado_bling'])) {
        $clsBling = new Bling();
    
        return $clsBling->salvarProdutos($produtos);        
    }
}

function tc_montar_url($texto)
{
    if (!is_string($texto))
        return $texto.'x';

    $er = "/(https:\/\/(www\.|.*?\/)?|http:\/\/(www\.|.*?\/)?|www\.)([a-zA-Z0-9]+|_|-)+(\.(([0-9a-zA-Z]|-|_|\/|\?|=|&)+))+/i";

    $texto = preg_replace_callback($er, function ($match) {
        $link = $match[0];

        //troca "&" por "&", tornando o link válido pela W3C
        $link = str_replace("&", "&amp;", $link);

        return strtolower($link);
    }, $texto);
    
    return (stristr($texto, "https") === false && stristr($texto, "http") === false) ? "https://" . $texto : $texto;
}

function tc_converter_money_float(string $valor)
{
    if (is_numeric($valor)) return $valor;

    $valor = str_replace('.', '', $valor);
    return str_replace(',', '.',$valor);
}

function tc_converter_float_money(string $valor)
{
    if (is_numeric($valor)) return number_format($valor, 2, ',', '.');
    return $valor;
}