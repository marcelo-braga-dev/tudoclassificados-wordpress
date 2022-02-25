<?php

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