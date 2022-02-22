<?php

$apikey = "";
$apikey = "e29821c3ec4b8655b7fca62700633cac025dc1c1174ff65e70212b5ce43e7700117cc202";
// $apikey = "46ce98b2ad08226ffe9419a2f2de96cf6bb0f62b482d062ae13be1d9a255758bab29524a";
// $apikey = "89268f9bd090d8c6bd9d399168d1045c59ddc345886c1c702404bb5892bc75fa7ae13562";


/*
$idCategoria = "3239955";

$outputType = "json";
$url = 'https://bling.com.br/Api/v2/categoria/' . $idCategoria . '/' . $outputType;
$retorno = executeGetCategories($url, $apikey);

function executeGetCategories($url, $apikey){
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, $url . '&apikey=' . $apikey);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($curl_handle);
    curl_close($curl_handle);
    return $response;
}*/



$outputType = "json";
$url = 'https://bling.com.br/Api/v2/categorias/' . $outputType;
$retorno = executeGetCategories($url, $apikey);


function executeGetCategories($url, $apikey){
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, $url . '&apikey=' . $apikey);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($curl_handle);
    curl_close($curl_handle);
    return $response;
}



$json = json_decode($retorno);
echo '<pre>';
print_r($json);
print_r($json->retorno->categorias[0]->categoria);
echo '</pre>';

// foreach ($retorno->retorno->produtos as $produto) {
    
//     foreach($produto->produto->imagem as $imgs){
//         $link = $imgs->link;
//         // echo '<pre>';
//         // echo $link;
//         // echo '</pre>';
//         // echo is_readable($link);
//         // print_r(file_exists($link));
//         echo '<img src="'.$link.'" width="50px">';
//     }
//     echo '<hr>';
// }
