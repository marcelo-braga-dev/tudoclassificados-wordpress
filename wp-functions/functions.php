<?php

function getQtdImoveis(string $user_id)
{
   global $wpdb;

   $qtdImoveis = 0;

   $table = $wpdb->prefix . 'posts';
   $dados_table_post = $wpdb->get_results("SELECT ID FROM $table WHERE post_author = $user_id AND post_type = 'acadp_listings' AND post_status = 'publish'");

   // Ver Qtd Imoveis
   foreach ($dados_table_post as $postId) {
      $postId = $postId->ID;
      $table = $wpdb->prefix . 'term_relationships';
      $table_object_id = $wpdb->get_results("SELECT term_taxonomy_id FROM $table WHERE `object_id` = $postId");

      foreach ($table_object_id as $taxonomyId) {

         $taxonomyId = $taxonomyId->term_taxonomy_id;

         $table = $wpdb->prefix . 'term_taxonomy';
         $parent = $wpdb->get_results("SELECT parent FROM $table WHERE `term_taxonomy_id` = $taxonomyId AND parent = '27'");

         $idParent = $parent[0]->parent;

         if ($idParent == '27') $qtdImoveis++;
      }
   }
   return $qtdImoveis;
}

function filtrar_texto(string $arg)
{
   $resposta = preg_replace(
      array(
         '/\w+(\.com)/i',
         '/\w+(@)/i',
         '/http(.+)\s/',
         '/@(.+)\s/'
      ),
      '[***]',
      $arg
   );

   return $resposta;
}

function bs4_limitar_texto($texto, $max_len)
{
   if (strlen($texto) > $max_len) {
      $texto = substr($texto, 0, strrpos(substr($texto, 0, $max_len), ' ')) . '...';
   }
   return $texto;
}

function bs4t_user_is_premium($tipo)
{
   global $wpdb;

   $user_id = get_current_user_id();
   $qtd_imoveis_premium = 0;

   $resultado = $wpdb->get_results("SELECT max_anuncios, tipo, `status` 
    FROM class_imp_contas_premium 
    WHERE `user_id` = '$user_id' AND `status` = 'approved' AND `tipo` = '$tipo'");

   foreach ($resultado as $arg) {
      if ($arg->tipo == $tipo) {
         $qtd_imoveis_premium += $arg->max_anuncios;
      }
   }

   return $qtd_imoveis_premium;
}

function get_id_categoria_imoveis()
{
   return '27';
}

function set_cep_usuario(string $cep)
{
   $cep = preg_replace('/\D/', '', $cep);

   if (strlen($cep) == 8) update_user_meta(get_current_user_id(), 'cep', $cep);

   wp_redirect(acadp_get_current_url());
   exit();
}

function is_imovel()
{
   $resposta = false;

   //if ($id == get_id_categoria_imoveis()) $resposta = true;

   return $resposta;
}

function get_qtd_premium_imovel()
{
   global $wpdb;

   // $user_id = get_current_user_id();
   // $qtd_imoveis_premium = 0;

   // $resultado = $wpdb->get_results("SELECT max_anuncios, tipo, `status` 
   //  FROM class_imp_contas_premium 
   //  WHERE `user_id` = '$user_id' AND `status` = 'approved' AND `tipo` = '$tipo'");


}

// Slice Carrocel
function bs4_script_carrocel_anuncios()
{   ?>
   <script src="/wp-functions/widgets/assets/js/principal.js"></script>
<?php
}
add_action('wp_footer', 'bs4_script_carrocel_anuncios', 101);
return;
?>