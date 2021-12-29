<?php
//Salvar comentario
if (!empty($_POST['comentario_id']) && !empty($_POST['user_id']) && !empty($_POST['resposta'])) {
    global $wpdb;

    $data = date('d/m/Y');
    $comentario_id = $_POST['comentario_id'];
    $user_id = $_POST['user_id'];

    $table = 'class_imp_comentarios';
    
    $resposta = wp_strip_all_tags($_POST['resposta']);

    $wpdb->query($wpdb->prepare("UPDATE $table 
                                    SET resposta = '$resposta', data_resposta = '$data' 
                                    WHERE id = '$comentario_id' AND `anunciante_id` = '$user_id'"));

       
}
