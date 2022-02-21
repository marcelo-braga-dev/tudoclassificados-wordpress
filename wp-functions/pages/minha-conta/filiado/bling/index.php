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
            
            
            <?php
                $num_page = $_GET['page_bling'];
                
                if(!$num_page) $num_page = 1;
            
                if ($num_page === 1) {
                    $num_page = 2;
                    $pag_disabled_ant = 'disabled';
                    $pag_disabled_1 = 'disabled';
                } else {
                    $pag_disabled_2 = 'disabled';
                }
                $p1 = $num_page - 1;
                $p2 = $num_page;
                $p3 = $num_page + 1;
            
                if (!$p1) {
                    $pag_esconder_1 = 'display:none;';
                    $pag_disabled_ant = 'disabled';
                }
                if ($i < 100) {
                    $esconder_pag = 'display:none;';
                    $pag_disabled_pro = ' disabled';
                }
                if ($erro_14 || $num_page === 2 && $i < 100) {
                    $esconder_opc_pag = 'style="display:none;"';
                    $bg3 = 'bg-primary text-white"';
                }
                
                if (empty($_GET['page_bling'])) $bg1 = 'bg-primary text-white"';
                else $bg2 = 'bg-primary text-white"';
                
                $query = '?' .
                    'token_bling=' . $_GET['token_bling'] . '&' .
                    'filiado=' . $_GET['filiado'] . '&' .
                    'aba_menu=' . $_GET['aba_menu'] . '&';
                    
                $url = $_SERVER['SCRIPT_URL'] . $query;
                ?>
                
            <nav <?= $esconder_opc_pag ?>>
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php echo $pag_disabled_ant ?>" style="margin:0px">
                        <a class="page-link" href="<?= $url ?>page_bling=<?php echo $p1 ?>" aria-label="Anterior">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Anterior</span>
                        </a>
                    </li>
                    <li class="page-item <?php echo $pag_disabled_1 ?>" style="margin:0px; <?php echo $pag_esconder_1 ?>">
                        <a class="page-link <?= $bg1 ?>" href="<?= $url ?>page_bling=<?php echo $p1 ?>"><?php echo $p1 ?></a>
                    </li>
                    <li class="page-item <?php echo $pag_disabled_2 ?>" style="margin:0px">
                        <a class="page-link <?= $bg2 ?>" href="<?= $url ?>page_bling=<?php echo $p2 ?>"><?php echo $p2 ?></a>
                    </li>
                    <li class="page-item <?php echo $pag_disabled_3 ?>" style="margin:0px;<?php echo $esconder_pag ?>">
                        <a class="page-link <?= $bg3 ?>" href="<?= $url ?>page_bling=<?php echo $p3 ?>"><?php echo $p3 ?></a>
                    </li>
                    <li class="page-item <?php echo $pag_disabled_pro ?>" style="margin:0px">
                        <a class="page-link" href="<?= $url ?>page_bling=<?php echo $p3 ?>" aria-label="Próximo">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Próximo</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            
        </div>
    </div>
</div>