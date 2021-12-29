<?php

// if ($category->parent == '27'){
   include 'imoveis/index.php';
// } else {
//    include 'produtos/index.php';
// }
?>

<!-- SCRIPT -->
<?php
function bs4_script_page_unica_produtos()
{   ?>
    <!-- <script src="/wp-functions/pages/anuncio_unico/produtos/assets/js/default.js"></script> -->
    <script src="/wp-functions/pages/anuncio_unico/produtos/assets/js/carrocel_destaque.js"></script>
    <!-- <script src="/wp-functions/pages/anuncio_unico/produtos/assets/js/carrocel_rodape.js"></script> -->

<?php
}
add_action('wp_footer', 'bs4_script_page_unica_produtos', 101);
return;
?>