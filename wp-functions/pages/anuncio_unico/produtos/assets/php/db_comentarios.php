<?php
global $wpdb;
$table = 'class_imp_comentarios';
$post_id = $post->ID;

$comentarios = $wpdb->get_results("SELECT * FROM $table WHERE post_id = $post_id ORDER BY id DESC");

//Salvar comentario
if(!empty($_POST['post_id']) && !empty($_POST['user_id']) && !empty($_POST['pergunta']))
{
    $data = date('d/m/Y');

    $wpdb->insert(
        $table,
        array(
            'post_id' => $_POST['post_id'],
            'user_id' => $_POST['user_id'],
            'anunciante_id' => $_POST['anunciante_id'],
            'pergunta' => wp_strip_all_tags($_POST['pergunta']),
            'data_pergunta' => $data,
        )
    );
}
?>


