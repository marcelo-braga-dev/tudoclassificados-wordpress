<?php

global $wpdb;

$api_key_ingaia = $_GET['apikey_ingaia'];

$table = $wpdb->prefix . 'awpcp_inte_apikey';
if ($api_key_ingaia) {
    $info_table = $wpdb->get_results("SELECT * FROM $table WHERE user_id = $user_id AND origem = 'ingaia'");
    if ($info_table) {
        $data = ['api_key' => $api_key_ingaia];
        $where = ['user_id' => $user_id, 'origem' => 'ingaia'];
        $wpdb->update($table, $data, $where);
    } else {
        $wpdb->insert(
            $table,
            array(
                'user_id' => $user_id,
                'origem' => 'ingaia',
                'api_key' => $api_key_ingaia,
            )
        );
    }
}
$info_table = $wpdb->get_results("SELECT * FROM $table WHERE user_id = $user_id AND origem = 'ingaia'");
$xml = simplexml_load_file($api_key_ingaia);
$infoImovel = $xml->Imoveis->Imovel;

