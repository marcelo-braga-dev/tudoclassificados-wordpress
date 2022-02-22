<?php 
include_once 'ler_xml.php';
include_once 'salvar_dados.php';
// $qtdImoveis = getQtdImoveis($user_id);

$max_imoveis = intval($qtd_imoveis_premium) + 20;

$limiteIngaia = $max_imoveis - intval($qtdImoveis);
?>
<?php if ($atualizarPagina) : ?>
<div class="text-center p-5">
    Carregando...
</div>

<script>
    window.location.href = "/minha-conta?aba=bling";
</script>
<?php endif; ?>

<div class="row">
   <div class="col-12">
      <div class="card">
         <div class="card-header bg-white">
            <div class="row justify-content-between align-items-center px-3">
               <div>
                  <h3 class="mb-0">Integrar Imóveis pelo inGaia</h3>
               </div>
               <div>
                  <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                     <i class="fas fa-link"></i>
                  </div>
               </div>
            </div>
         </div>
         <div class="card-body">
             <div class="row justify-content-end">
                    <div class="col-md-5">
                        <a href="https://quin.to/drhpia?codigo=bpmGN" target="_blank" style="text-de coration:none;">
                            <div class="row rounded align-items-center mx-2 mb-4 text-center btn-primary">
                                <div class="col-3 p-2 m-0 rounded-left text-white" style="background: rgba(0,0,0,0.1);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="38" height="24"><path fill="#fff" fill-rule="evenodd" d="M4.903 4.892v6.366l.497.496 1.488-1.486v-4.15L4.903 4.89zm9.687-1.82H6.13c-.53.135-.9.434-1.107.896l1.865 1.1h6.97l.732-1.997zm-2.22 15.8H6.887l-1.576 1.542c.206.218.477.37.812.456h7.326l-.033-.093-1.048-1.905zm.832-5.114v4.873l1.143 2.08c.432-.215.712-.58.842-1.096V12.68l-.454-.453-1.53 1.53zm-7.01-1.495l.696.707h5.916l1.19-1.192-.792-.806H7.484l-1.29 1.29zm19.752 5.203l4.39 1.518c.21.054.327-.07.257-.277L26.07 5.253c-.07-.207-.183-.207-.252 0l-4.52 13.454c-.07.207.044.33.256.277l4.39-1.518zM2.134.106C1.043.105.158.99.158 2.08V21.86c0 1.09.885 1.976 1.978 1.976h31.64c1.094 0 1.98-.885 1.98-1.977V2.08c0-1.092-.886-1.977-1.98-1.977H2.136zm0 .79h31.642c.656 0 1.187.53 1.187 1.186V21.86c0 .654-.53 1.185-1.187 1.185H2.136c-.657 0-1.188-.53-1.188-1.186V2.08c0-.655.53-1.186 1.187-1.186zM55.478"></path></svg>
                                </div>
                                <div class="col-9 rounded-right text-white text-truncate">
                                    <span>Anuncie no QUINTO<b>ANDAR</b></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php
            if (empty($user_meta['cep'][0])) : ?>
               <form method="POST">
                  <div class="form-row justify-content-center">
                     <div class="col-10 col-md-auto mt-4">
                        <span>Por favor, insira o seu cep:</span>
                        <div class="input-group">
                           <div class="input-group-prepend">
                              <div class="input-group-text" for="cep-usuario">Cep</div>
                           </div>
                           <input type="text" class="form-control" name="cep-usuario" id="cep-usuario" data-mask="00000-000" pattern="[0-9]{5}-[0-9]{3}" placeholder="00000-000" required>
                        </div>
                     </div>
                  </div>
                  <div class="form-row justify-content-center">
                     <div class="col-10 col-md-auto">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                     </div>
                  </div>
               </form>
            <?php
            else :
            ?>
               <div class="card p-3 mb-3">
                  <span>
                     Você possui <b><?= $qtdImoveis ?></b> anúncios ativos na categoria Imóveis. O seu limite são <b><?= $max_imoveis ?></b> anúncios.<br>
                     Aumente a sua quantidade de anúncios de Imóveis contratando um pacote de <a href="/anuncios-premium/">Anúncios Premium</a>.
                  </span>
               </div>
               <?php if ($alerta) : ?>
                  <div class="alert alert-success" role="alert">
                     Seus anúncios de Imóveis foram publicados.
                  </div>
               <?php endif ?>
               <?php if (!count($infoImovel)) : ?>
                  <div class="card p-3 mb-3">
                     <form action="">
                        <div class="form-row align-items-end justify-content-center">
                           <span>
                              <b>Insira o link de integração do portal Ingaia:</b>
                           </span>
                           <div class="form-group col-md-9">
                              <label for="inputEmail4">Link:</label>
                              <input type="text" class="form-control" id="apikey_ingaia" name="apikey_ingaia" value="<?php echo $info_table[0]->api_key ?>" required>
                           </div>
                           <div class="form-group col-md-auto">
                              <input type="hidden" name="buscar-ingaia" value="pesquisar">
                              <input type="hidden" name="aba_menu" value="imoveis_ingaia">
                              <button type="submit" class="btn btn-primary btn-block rounded">Buscar</button>
                           </div>
                        </div>
                     </form>
                  </div>
               <?php else : ?>
                  <div class="row">
                     <div class="col-12">
                        <hr class="my-2">
                        <form method="post">
                           <div class="m-4">
                              <span class="d-block mb-1">
                                 Selecione os anúncios e em seguida,
                                 clique no botão abaixo para integrá-los.
                              </span>
                              <button type="submit" class="btn btn-primary rounded">Integrar Anúncios Selecionados</button>
                           </div>                           
                           <div class="table-responsive">
                              <table class="table align-items-center ">
                                 <!--table-flush-->
                                 <thead class="thead-light">
                                    <tr>
                                       <th scope="col">Integrar</th>
                                       <th scope="col">Imóvel</th>
                                       <th scope="col" class="sort" data-sort="status">Valor</th>
                                       <th scope="col" class="sort" data-sort="budget">Código</th>
                                    </tr>
                                 </thead>
                                 <tbody class="bg-white">
                                    <!--list -->
                                    <?php
                                    $qtd_linhas = 0;
                                    foreach ($infoImovel as $tag) :
                                       $qtd_linhas++;
                                    ?>
                                       <tr>
                                          <td>
                                             <label class="custom-toggle">
                                                <input type="checkbox" onchange="alterar_checkeds_ingaia();" id="customCheck<?= $qtd_linhas ?>" class="linha-table-ingaia custom-control-input" name="check_cod_ingaia[]" value="<?= $tag->CodigoImovel ?>">
                                                <span class="custom-toggle-slider rounded-circle" data-label-off="Não" data-label-on="Sim"></span>
                                             </label>
                                          </td>
                                          <td class="white-text-normal" style="white-space: normal !important;">
                                             <?= $tag->TituloImovel ?>
                                          </td>
                                          <td class="white-text-normal">
                                             <?php if ($tag->PrecoVenda) : ?>
                                                R$ <?= number_format(floatval($tag->PrecoVenda), 2, ',', '.') ?><br>
                                             <?php endif; ?>
                                             <?php if ($tag->PrecoLocacao) : ?>
                                                R$ <?= number_format(floatval($tag->PrecoLocacao), 2, ',', '.') ?> / mês
                                             <?php endif; ?>
                                          </td>
                                          <td class="white-text-normal">
                                             <?= $tag->CodigoImovel ?>
                                          </td>
                                       </tr>
                                    <?php endforeach; ?>
                                 </tbody>
                              </table>
                           </div>
                           <div class="form-row">
                              <div class="mx-auto">
                                 <input type="hidden" name="apikey_ingaia" value="<?= $info_table[0]->api_key ?>">
                                 <input type="hidden" name="integrar_ingaia" value="sim">
                                 <button type="submit" class="btn btn-primary rounded">Integrar Anúncios Selecionados</button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               <?php endif ?>
            <?php endif ?>
         </div>
      </div>
   </div>
</div>

<!-- MODAL -->
<!-- Modal Limie de Anuncios-->
<div class="modal fade" id="modalLimiteImoveis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alerta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Seu limite de anúncios de imóveis foi alcançado.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script>
   var limite_check = <?= $limiteIngaia ?>;
</script>

<?php
function bs4t_integracao_ingaia()
{
?>
   <script src="/wp-content/plugins/tudoclassificados/plugins/tudoclassificados/aplicacoes/ingaia/assets/main.js?id=<?= uniqid() ?>"></script>
<?php
}
add_action('wp_footer', 'bs4t_integracao_ingaia', 102);
?>

<script src="/wp-content/plugins/tudoclassificados/aplicacoes/ingaia/principal.js"></script>