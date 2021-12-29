<?php
$apikey = "e29821c3ec4b8655b7fca62700633cac025dc1c1174ff65e70212b5ce43e7700117cc202";
$outputType = "json";
$url = 'https://bling.com.br/Api/v2/categorias/' . $outputType;
$retorno = executeGetCategories($url, $apikey);
$x = json_decode($retorno);

echo '<pre>';
print_r($x);
echo '</pre>';

function executeGetCategories($url, $apikey){
    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, $url . '&apikey=' . $apikey);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($curl_handle);
    curl_close($curl_handle);
    return $response;
}