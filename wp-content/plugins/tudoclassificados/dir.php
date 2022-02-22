Form Anuncio: /home/tudocl45/public_html/wp-content/plugins/advanced-classifieds-and-directory-pro/public/partials/user/acadp-public-edit-listing-display.php

C:\ftp_classi\wp-content\plugins\advanced-classifieds-and-directory-pro\public\partials\user\acadp-public-custom-fields-display.php

// Create post object
    $my_post = array(
      'post_title'    => wp_strip_all_tags( 'Titulo insert DB - 3 -' ),
      'post_content'  => 'Descrição no Insrt DB',
      'comment_status'   => 'closed',
      'post_status'   => 'publish',
      'ping_status'   => 'closed',
      'guid'   => 'publish',
      'post_type'   => 'acadp_listings',
      'post_author'   => get_current_user_id(),
      'meta_input'   => array(
                    'wc_video_url' => '$video_url',
                    'wc_product'   => '$video_product'
                ),
      
    );//guid => full url ||  
     
    // Insert the post into the database
    $post_id = wp_insert_post( $my_post );
    
    //add_post_meta( $post_id, $meta_key, $meta_value)
    add_post_meta( $post_id, 'id do post', 'xx', true );

<?php
function bs4t_adicionando_script_2()
{
?>
      
<?php
}
add_action('wp_footer', 'bs4t_adicionando_script_2', 101);
?>

wp_get_object_terms($post->ID, 'acadp_categories') // pegar categoria

$wpdb->query($wpdb->prepare("UPDATE $table 
                                    SET resposta = '$resposta', data_resposta = '$data' 
                                    WHERE id = '$comentario_id' AND `anunciante_id` = '$user_id'"));

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


