<?php
require_once 'src/Produtos.php';
include_once 'assets/funcoes.php';

$classProdutos = new ProdutosAnuncio();
?>
<div class="container">
   <div class="row rounded m-md-0 mb-5 pt-3">
      <div class="col-md-8 order-md-1 order-2">
         <!--IMAGEM PRINCIPAL -->
         <?php require_once 'imagem-principal.php' ?>

         <!-- Icones -->
         <?php require_once 'icones.php' ?>

         <!-- Descrição -->
         <?php include 'desc-carac.php' ?>
         <?php include 'videos.php' ?>

         <!-- Comentarios -->
         <?php include 'comentarios.php' ?>
      </div>
      <div style="margin-top:50px"></div>

      <!-- LATERAL ESQUERDA PC-->
      <div class="col-md-4 order-md-2 order-1">
         <!-- Preco -->
         <?php require 'preco.php' ?>

         <!-- Lateral -->
         <?php require 'lateral.php' ?>
      </div>
   </div>
   <div class="row m-3">
      <div class="col-12">
         <?php echo do_shortcode('[acadp_listings view="grid" listings_per_page="20" header="0"]'); ?>
      </div>
   </div>
   <div class="row m-3">
      <div class="col-12">
         <!-- Horizontal-1 -->
         <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-5788964970631749" data-ad-slot="1820744055" data-ad-format="auto" data-full-width-responsive="true"></ins>
         <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
         </script>
      </div>
   </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalEscolhaFrete" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="TituloModalCentralizado">Escolha o Frete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form class="mb-0">
            <div class="modal-body pt-0">
               <div class="row">
                  <div class="col-12">
                      
                     <p>Escolha o tipo de entrega:</p>
                      <div id="inserir-tabela-frete"></div>
                      
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-success rounded">Incluir Frete</button>
            </div>
         </form>
      </div>
   </div>
</div>

<script src="/wp-content/plugins/tudoclassificados/pages/anuncio_unico/imoveis/assets/js/frete.js?id=<?= uniqid() ?>"></script>

<?php
function bs4t_nova_pergunta_produtos()
{
?>
   <script src="/wp-content/plugins/tudoclassificados/pages/anuncio_unico/imoveis/assets/js/nova_pergunta.js"></script>
   <script src="/wp-content/plugins/tudoclassificados/pages/anuncio_unico/imoveis/assets/js/videos.js"></script>
<?php
}
add_action('wp_footer', 'bs4t_nova_pergunta_produtos', 102);
?>