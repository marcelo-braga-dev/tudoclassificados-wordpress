<?php
$ACCESS_TOKEN = 'APP_USR-6272490303126334-040516-1da97f0319ca425795dea0794d7ea495-443790977';
$header = [];
$header[] = 'Authorization: Bearer '.$ACCESS_TOKEN;
$header[] = 'Accept-version: v2';
$header['query'] = "{ configuration(user_id: 427427465, service_type: \"lightweight\"){ adoption{ service_id status {id cause date} creation_date last_update penalty_status recover_date delivery_window } address{ id address_line zip_code city{ id name } } capacity{ availables selected current_count } cutoff{ availables{ value unit } selected{ week saturday sunday } } working_days training_time{ offset{ value unit } activation_date } zones{ id label price{ cents currency_id decimal_separator fraction symbol } is_mandatory selected neighborhoods } }}";




$url = "POST https://api.mercadolibre.com/shipping/flex/sites/MLB/configuration";
    

    $curl_handle = curl_init();
    curl_setopt($curl_handle, CURLOPT_URL, $url);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $header);
    $response = curl_exec($curl_handle);
    curl_close($curl_handle);
    $resposta = $response;


$resposta = json_decode($resposta);
echo '<pre>';
print_r($resposta);
echo '</pre>';



curl -i -H 'Content-Type: application/json' -H "Authorization: bearer myGithubAccessToken" -X POST -d '{"query": "query {repository(owner: \"wso2\", name: \"product-is\") {description}}"}' https://api.github.com/graphql

TESTE
curl -i -H 'Authorization: Bearer APP_USR-1384267185300661-062316-0fb461b2f83bb44e902c3319994536c2-731634047' -H 'Accept-version: v2' -X POST -d '{"query": "{ configuration(user_id: 184440086, service_type: \"lightweight\"){ adoption{ service_id status {id cause date} creation_date last_update penalty_status recover_date delivery_window } address{ id address_line zip_code city{ id name } } capacity{ availables selected current_count } cutoff{ availables{ value unit } selected{ week saturday sunday } } working_days training_time{ offset{ value unit } activation_date } zones{ id label price{ cents currency_id decimal_separator fraction symbol } is_mandatory selected neighborhoods } }}"}' https://api.mercadolibre.com/shipping/flex/sites/MLB/configuration

----
curl -X POST -H 'Authorization: Bearer APP_USR-1384267185300661-062316-0fb461b2f83bb44e902c3319994536c2-731634047' -H 'Accept-version: v2' curl -X POST https://api.mercadolibre.com/shipping/flex/sites/MLB/configuration

{
  "query": "{ configuration(user_id: 184440086, service_type: \"lightweight\"){ adoption{ service_id status {id cause date} creation_date last_update penalty_status recover_date delivery_window } address{ id address_line zip_code city{ id name } } capacity{ availables selected current_count } cutoff{ availables{ value unit } selected{ week saturday sunday } } working_days training_time{ offset{ value unit } activation_date } zones{ id label price{ cents currency_id decimal_separator fraction symbol } is_mandatory selected neighborhoods } }}"
}

?>
