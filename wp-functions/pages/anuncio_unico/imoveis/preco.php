<?php
$tipo = $post_meta['tipo'][0];

if ($tipo == 'filiado') :
   include ABSPATH . 'wp-functions/pages/anuncio_unico/area-precos/filiado.php';
elseif ($tipo == 'marketplace') :
   include ABSPATH . 'wp-functions/pages/anuncio_unico/area-precos/marketplace.php';
else :
   function MontarLink($texto)
   {
      if (!is_string($texto))
         return $texto;

      $er = "/(https:\/\/(www\.|.*?\/)?|http:\/\/(www\.|.*?\/)?|www\.)([a-zA-Z0-9]+|_|-)+(\.(([0-9a-zA-Z]|-|_|\/|\?|=|&)+))+/i";

      $texto = preg_replace_callback($er, function ($match) {
         $link = $match[0];

         //coloca o 'http://' caso o link não o possua
         $link = (stristr($link, "https") === false && stristr($link, "http") === false) ? "https://" . $link : $link;

         //troca "&" por "&", tornando o link válido pela W3C
         $link = str_replace("&", "&amp;", $link);

         return strtolower($link);
      }, $texto);

      return $texto;
   }
?>

   <div class="card m-0 p-3 mb-4">
      <div class="d-block text-right">
         <?php the_acadp_social_sharing_buttons(); ?>
      </div>
      <div class="d-block m-0">
         <small><?= get_term($category->term_taxonomy_id)->name; ?></small>
         <small>
            <?php if ($post_meta['price'][0]) echo '| Venda'; ?>
            <?php if ($post_meta['preco_aluguel'][0]) echo '| Aluga'; ?>
         </small>
         <span class="d-block titulo-anuncio">
            <?php echo esc_html($post->post_title); ?>
         </span>
      </div>
      <div class="d-block mb-0">
         <?php the_acadp_listing_labels($post_meta); ?>
      </div>
      <?php if (!empty($post_meta['cidade'][0]) && $post_meta['estado'][0]) : ?>
         <div class="d-block">
            <small><?= $post_meta['cidade'][0] . ' - ' . $post_meta['estado'][0] ?></small>
         </div>
      <?php endif; ?>

      <!-- Precos -->
      <div class="d-block my-3">
         <div class="row">
            <div class="col-auto" style="font-size:30px">
               <?php
               $price = acadp_format_amount($post_meta['price'][0]);
               $precoAluguel = acadp_format_amount($post_meta['preco_aluguel'][0]);
               ?>
               <!-- venda -->
               <?php if ($post_meta['price'][0]) : ?>
                  <p class="lead acadp-no-margin font-weight-normal" style="font-size: 22px">
                     <?= esc_html(acadp_currency_filter($price)); ?>
                  </p>
               <?php endif ?>
               <!-- aluga -->
               <?php if ($post_meta['preco_aluguel'][0]) : ?>
                  <p class="lead acadp-no-margin font-weight-normal" style="font-size: 22px">
                     <?= esc_html(acadp_currency_filter($precoAluguel)) . '<small> /mês </small>'; ?>
                  </p>
               <?php endif ?>
            </div>
            <div class="col-1 align-self-center" style="font-size:24px">
               <span id="" class="acadp-favourites"><?php the_acadp_favourites_link(); ?></span>
            </div>
         </div>
      </div>

      <!-- SITE EXTERNO -->
      <?php if ($post_meta['website'][0]) : ?>
         <a href="<?= MontarLink($post_meta['website'][0]) ?>" target="_blank" style="text-decoration:none;">
            <div class="row rounded align-items-center mx-2 mb-4 text-center btn-info">
               <div class="col-2 p-2 m-0 rounded-left text-white" style="background: rgba(0,0,0,0.1);">
                  <i class="bi bi-box-arrow-up-right" style="font-size: 24px;"></i>
               </div>
               <div class="col-10 rounded-right text-white text-truncate">
                  <span style="font-size: 16px;">IR PARA O SITE DE VENDA</span>
               </div>
            </div>
         </a>
      <?php else : ?>

         <?php
         if ($category->parent != get_id_categoria_imoveis()) :
            if ($post_meta['frete_gratis'][0] != 'S') :

               $cep_anunciante = get_user_meta($post->post_author)['cep'][0];

               if (
                  !empty($cep_anunciante) &&
                  !empty($post_meta['peso'][0]) &&
                  !empty($post_meta['comprimento'][0]) &&
                  !empty($post_meta['altura'][0]) &&
                  !empty($post_meta['largura'][0])
               ) :
         ?>
                  <div class="d-block mb- 3">
                     <div class="row">
                        <div class="col-auto align-self-end">
                           <small>Consulte o valor do frete</small>
                           <div class="input-group">
                              <div class="input-group-prepend">
                                 <div class="input-group-text" for="consulta-frete">Cep</div>
                              </div>
                              <input style="width: 8rem;" type="text" class="form-control" id="consulta-frete" value="<?= $_GET['cep_pesquisado'] ?>" data-mask="00000-000" placeholder="00000-000">
                           </div>
                           <a class="small d-block" target="_blank" href="https://buscacepinter.correios.com.br/app/endereco/index.php">
                              Não sei o CEP
                           </a>
                           <input type="hidden" id="cep-origem" value="<?= $cep_anunciante ?>">
                           <input type="hidden" id="peso-produto" value="<?= $post_meta['peso'][0] ?>">
                           <input type="hidden" id="comprimento-produto" value="<?= $post_meta['comprimento'][0] ?>">
                           <input type="hidden" id="altura-produto" value="<?= $post_meta['altura'][0] ?>">
                           <input type="hidden" id="largura-produto" value="<?= $post_meta['largura'][0] ?>">
                        </div>
                     </div>
                     <div class="row">
                        <form class="mb-0">
                           <div class="col-11 mt-3 mb-1" id="tabela-frete"></div>
                           <button id="btn-add-frete" class="btn btn-link mt-1 mb-3" style="display: none;">
                              Adicionar Frete
                           </button>
                        </form>
                     </div>
                  </div>
               <?php endif ?>
            <?php else : ?>
               <div class="col-12">
                  <div class="alert alert-success">
                     FRETE GRÁTIS
                  </div>
               </div>
            <?php endif ?>
         <?php endif ?>

         <!-- Checkout Pro -->
         <?php
         if ($category->parent != get_id_categoria_imoveis()) :
            require_once ABSPATH . 'wp-functions/aplicacoes/mercado-pago/checkout-marktplace.php';
         endif; ?>

      <?php endif ?>


      <div class="d-block mb-2">
         <small>
            Anunciado por <?php echo '<a href="' . esc_url(acadp_get_user_page_link($post->post_author)) . '" style="color: #1e4b75">' . get_the_author() . '</a>'; ?>
         </small>
      </div>
   </div>

<?php endif; ?>