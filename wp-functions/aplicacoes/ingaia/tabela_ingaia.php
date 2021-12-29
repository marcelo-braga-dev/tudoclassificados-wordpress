<?php
include_once 'ler_xml.php';
include_once 'salvar_db.php';
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
?>
<div class="card p-3">
   <span>
      Você possui <b><?= $qtdImoveis ?></b> anúncios ativos na categoria Imóveis dos <b>5</b> disponíveis.<br>
      Aumente a sua quantidade de anúncios de Imóveis contratando um pacote de <a href="/pacote-de-anuncios/">Anúncios Premium</a>.
   </span>

</div>
<div class="card p-3">
   <form method="post" action="">
      <div class="form-row align-items-end justify-content-center">
         <span class="col-md-8">
            <b>Insira o link de integração do portal Ingaia:</b>
         </span>
         <div class="form-group col-md-9">
            <label for="inputEmail4">Link:</label>
            <input type="text" class="form-control" id="api-key-ingaia" name="api-key-ingaia" value="<?php echo $info_table[0]->api_key ?>" required>
         </div>
         <div class="form-group col-md-auto">
            <input type="hidden" name="buscar-ingaia" value="pesquisar">
            <button type="submit" class="btn btn-primary btn-block rounded">Buscar</button>
         </div>
      </div>
   </form>
</div>
<?php if (count($text)) { ?>
   <form method="post">
      <div class="table-responsive">
         <table class="table table-sm rounded table-bordered">
            <thead class="thead-light">
               <tr>
                  <th></th>
                  <th>
                     <div class="form-check text-center">
                        <input class="form-controol" id="check-main-ingaia" type="checkbox" value="opcao1" aria-label="..." style="vertical-align: bottom !important;">
                     </div>
                  </th>
                  <th>
                     Informações do Imóvel
                  </th>
               </tr>
            </thead>
            <tbody>
               <?php
               $qtd_linhas = 0;
               foreach ($text as $tag) {
                  if ($qtd_linhas % 2) $bg_color = '#f3f3f3';
                  else $bg_color = '#fff';

                  $qtd_linhas++;
               ?>
                  <tr>
                     <td style="text-align:right; background-color: <?= $bg_color ?> !important">
                        <?= $qtd_linhas ?>&nbsp;.
                     </td>
                     <td style="background-color: <?= $bg_color ?> !important">
                        <div class="form-check text-center p-2">
                           <input type="checkbox" onchange="alterar_checkeds_ingaia();" class="linha-table-ingaia position-static" name="check_cod_ingaia[]" value="<?= $tag->CodigoImovel ?>">
                        </div>
                     </td>
                     <td style="background-color: <?= $bg_color ?> !important">
                        <b>Código do Imóvel:</b> <?= $tag->CodigoImovel ?><br>
                        <b>Titulo do Imóvel:</b> <?= $tag->TituloImovel ?><br>
                        <b>Site:</b> <a href="<?= $tag->URLGaiaSite ?>" target="_blank"><?= $tag->URLGaiaSite ?></a><br>
                        <b>Tipo:</b> <?= $tag->TipoImovel ?> | Sub Tipo: <?= $tag->SubTipoImovel ?><br>
                        <b>Endereço:</b> <?= $tag->Endereco ?> | Bairro: <?= $tag->Bairro ?><br>
                        <b>Cidade:</b> <?= $tag->Cidade ?> | Estado: <?= $tag->Estado ?> | País: <?= $tag->Pais ?><br>
                        <b>Preço de Venda:</b> R$ <?= number_format(floatval($tag->PrecoVenda), 2, ',', '.') ?> | <b>Preço Locação:</b> R$ <?= number_format(floatval($tag->PrecoLocacao), 2, ',', '.') ?><br>
                     </td>
                  </tr>
               <?php } ?>
            </tbody>
         </table>
      </div>
      <div class="form-row">
         <div class="mx-auto">
            <input type="hidden" name="apikey_ingaia" value="<?= $info_table[0]->api_key ?>">
            <input type="hidden" name="integrar_ingaia" value="sim">
            <button type="submit" class="btn btn-primary mb-2 rounded">Integrar</button>
         </div>
      </div>
   </form>
<?php } ?>

<script src="/wp-functions/aplicacoes/ingaia/principal.js"></script>