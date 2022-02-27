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
                                    <img src="<?= TUDOCLASSIFICADOS_URL_ASSETS . 'imagens/logos/logo-quintoandar.png' ?>">
                                </div>
                                <div class="col-9 rounded-right text-white text-truncate">
                                    <span>Anuncie no QUINTO<b>ANDAR</b></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="card p-3 mb-3">
                  <span>
                     Você possui <b><?= $anunciosImoveisAtivo ?></b> anúncios ativos na categoria Imóveis. O seu limite são <b><?= $limitesImovel['total'] ?></b> anúncios.<br>
                     Aumente a sua quantidade de anúncios de Imóveis contratando um pacote de <a
                              href="/anuncios-premium/">Anúncios Premium</a>.
                  </span>
                </div>

                <div class="card p-3 mb-3">
                    <form action="">
                        <div class="form-row align-items-end justify-content-center">
                           <span>
                              <b>Insira o link de integração do portal Ingaia:</b>
                           </span>
                            <div class="form-group col-md-9">
                                <label for="inputEmail4">Link:</label>
                                <input type="text" class="form-control" id="apikey_ingaia" name="apikey_ingaia"
                                       value="<?= $_GET['apikey_ingaia'] ?>" required>
                            </div>
                            <div class="form-group col-md-auto">
                                <input type="hidden" name="aba_minha_conta" value="imoveis-integrar-ingaia">
                                <input type="hidden" name="imoveis_ingaia" value="true">
                                <button type="submit" id="btn-integrar-ingaia"
                                        class="btn btn-primary btn-block rounded">Buscar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <?php if (!empty($imoveisIngaia)) : ?>
                    <div class="row">
                        <div class="col-12">
                            <hr class="my-2">
                            <form method="post">
                                <div class="m-4">
                              <span class="d-block mb-1">
                                 Selecione os anúncios e em seguida, clique no botão abaixo para integrá-los.
                              </span>
                                    <button type="submit" class="btn btn-primary rounded">
                                        Integrar Anúncios Selecionados
                                    </button>
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
                                        <?php
                                        $qtd_linhas = 0;
                                        foreach ($imoveisIngaia as $tag): ?>
                                            <tr>
                                                <td>
                                                    <label class="custom-toggle">
                                                        <input type="checkbox" onchange="alterar_checkeds_ingaia();"
                                                               id="customCheck<?= $qtd_linhas ?>"
                                                               class="linha-table-ingaia custom-control-input"
                                                               name="check_cod_ingaia[]"
                                                               value="<?= $tag->CodigoImovel ?>">
                                                        <span class="custom-toggle-slider rounded-circle"
                                                              data-label-off="Não" data-label-on="Sim"></span>
                                                    </label>
                                                </td>
                                                <td class="white-text-normal"
                                                    style="white-space: normal !important;">
                                                    <?= $tag->TituloImovel ?>
                                                </td>
                                                <td class="white-text-normal">
                                                    <?php if ($tag->PrecoVenda) : ?>
                                                        R$ <?= number_format(floatval($tag->PrecoVenda), 2, ',', '.') ?>
                                                        <br>
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
                                        <button type="submit" class="btn btn-primary rounded">
                                            Integrar Anúncios Selecionados
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- MODAL -->
<!-- Modal Limie de Anuncios-->
<div class="modal fade" id="modalLimiteImoveis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
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