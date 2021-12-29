<?php
global $wpdb;

$user_id = get_current_user_id();

if ($_GET['status'] == 'approved') {
    $refExterna = $_GET['external_reference'];
    $registro = $_GET['preference_id'];

    $check = $wpdb->get_results("SELECT id FROM class_imp_contas_premium 
                                        WHERE registro = '$registro'");
 
    if (count($check) > 0) {
        $resposta = 'Pagamento já registrado.';
    } else {
        $info_table = $wpdb->get_results("SELECT * FROM class_imp_pacotes 
                                        WHERE referencia_externa = '$refExterna'");

        $max_anuncios = $info_table[0]->max_anuncios;
        $tipo = $info_table[0]->tipo;
        $pacote = $info_table[0]->titulo;
        $data_inicial =  date('d/m/Y H:i:s');
        $data_final = date('d/m/Y H:i:s', strtotime('+30 days'));

        $table = 'class_imp_contas_premium';

        $wpdb->insert(
            $table,
            array(
                'user_id' => $user_id,
                'pacote' => $pacote,
                'max_anuncios' => $max_anuncios,
                'tipo' => $tipo,
                'data_inicial' => $data_inicial,
                'data_final' => $data_final,
                'registro' => $registro,
                'collection_id' => $_GET['collection_id'],
                'collection_status' => $_GET['collection_status'],
                'payment_id' => $_GET['payment_id'],
                'status' => $_GET['status'],
                'payment_type' => $_GET['payment_type'],
                'merchant_order_id' => $_GET['merchant_order_id'],
            )
        );
        $resposta = 'Pagamento registrado<br>Em breve seus anúncios premium serão liberados.';
    }
}
