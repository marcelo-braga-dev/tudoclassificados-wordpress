<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <div class="row justify-content-between align-items-center px-3">
                    <div>
                        <h3 class="mb-0">Anúncios como Filiado</h3>
                    </div>
                    <div>
                        <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <label>Api Key Bling</label>
                            <input type="text" name="token_bling" class="form-control" value="<?= $_GET['token_bling'] ?>">
                        </div>
                        <div class="col-12  mb-2">
                            <input type="hidden" name="filiado" value="true">
                            <input type="hidden" name="aba_menu" value="filiado_bling">
                            <button type="submit" class="btn btn-primary rounded">Pesquisar</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-12">
                        <?php if ($produtosBling['erro']) : ?>
                            <div class="alert alert-danger">
                                <?= $produtosBling['erro']['msg'] ?>
                            </div>
                        <?php endif ?>
                        <? if (count($produtosBling['produtos']) && $_GET['filiado']) : ?>
                            <form method="POST">
                                <button type="submit" class="btn btn-success rounded my-3">Integrar Anúncios Selecionados</button>
                                <input type="hidden" name="integrar_filiado_bling" value="true">
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Integrar</th>
                                                <th scope="col">Descrição</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            <?php foreach ($produtosBling['produtos'] as $var) :
                                                $produto = $var->produto;
                                                $anuncioComImagens = count($produto->imagem) ? true : false; ?>
                                                <tr>
                                                    <td scope="row" style="width: 2rem;">
                                                        <?= $i++ ?>.
                                                    </td>
                                                    <td>
                                                        <label class="custom-toggle">
                                                            <input type="checkbox" id="customCheck<?= $j ?>" class="input-check custom-control-input" name="checks[]" value="<?= $produto->id ?>" <?= $anuncioComImagens ? '' : 'disabled' ?>>
                                                            <span class="custom-toggle-slider rounded-circle" data-label-off="Não" data-label-on="Sim"></span>
                                                        </label>
                                                    </td>
                                                    <td style="white-space: normal !important;">
                                                        <?= $produto->descricao; ?>

                                                        <div class="avatar-group d-block">
                                                            <?php foreach ($produto->imagem as $imagem) : ?>
                                                                <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip">
                                                                    <img src="<?= $imagem->link ?>" onerror="errorImg(this)">
                                                                </a>
                                                            <?php endforeach ?>
                                                        </div>

                                                        <?php if (!$anuncioComImagens) : ?>
                                                            <span class="text-danger">Anúncio sem imagens.</span>
                                                        <?php endif ?>

                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <small class="input-group-text" style="font-size: 13px !important;">Link Externo</small>
                                                            </div>
                                                            <input type="text" class="form-control" name="produto[<?= $produto->id ?>][link_externo]" placeholder="https://" aria-label="Link Externo" value="<?= $produto->linkExterno; ?>" <?= $anuncioComImagens ? '' : 'disabled' ?>>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>