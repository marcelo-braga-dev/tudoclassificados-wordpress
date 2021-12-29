<?php

global $wpdb;

$nomeCategoria = 'carros';
$categoriasCadastradas = $wpdb->get_results("SELECT * FROM `class_terms` WHERE `name` = '$nomeCategoria'");
$termTaxonomys = $wpdb->get_results("SELECT `term_id`, `parent` FROM `class_term_taxonomy` WHERE `taxonomy` = 'acadp_categories'");
pesquisaCategoria($categoriasCadastradas, $termTaxonomys);

?>

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

    if (empty($produtos_bling['produtos'])) :
        if ($produtos_bling['erro']['cod']) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $produtos_bling['erro']['msg'] ?>
            </div>
        <?php endif; ?>
        <form method="post">
            <div class="form-row align-items-end justify-content-center my-3">
                <div class="form-group col-md-8">
                    <label for="inputEmail4">API Key:</label>
                    <input type="text" class="form-control" id="api-key-bling" name="api-key-bling" value="<?php if ($api_key_bling) echo $api_key_bling ?>" required>
                </div>
                <div class="form-group col-md-auto">
                    <button type="submit" class="btn btn-primary btn-block rounded">Buscar</button>
                </div>
            </div>
        </form>
    <?php else : ?>

        <script>
            function errorImg(e) {
                $(e).parent().parent().parent().parent().find('input, select').attr('disabled', true);
                $(e).parent().after('<i class="h1 bi bi-x-circle-fill text-danger"></i>');
                $(e).parent().remove();
            }
        </script>

        <form method="POST">
            <hr class="my-2">
            <div class="form-row">
                <div class="m-3">
                    <span class="d-block p-1">
                        Selecione os anúncios e em seguida,
                        clique no botão abaixo para integrá-los.
                    </span>
                    <button type="submit" class="btn btn-primary rounded">Integrar Anúncios Selecionados</button>
                </div>
                <div class="col-12">
                    <!-- 
                    <span><b><?= $produto_bling->descricao ?><br></b></span>
                    Preço: <?= 'R$ ' . number_format($produto_bling->preco, 2, ',', '.') ?><br>
                    Código: <?= $produto_bling->codigo ?> |
                    Status: <?= $produto_bling->situacao ?>
                -->

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Integrar</th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Categoria</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php
                                $num_page = $_GET['page_bling'];
                                $k = 0;
                                if ($num_page > 1) $k = $num_page * 100;
                                foreach ($produtos_bling['produtos'] as $produto_bling) :
                                    $produto_bling = $produto_bling->produto;

                                    $i++;
                                    $j = $i + $k;

                                    $anuncioSemImagens = count($produto_bling->imagem) ? false : true;
                                ?>
                                    <tr>
                                        <td scope="row" style="width: 2rem;">
                                            <?= $j ?>.
                                        </td>
                                        <td>
                                            <label class="custom-toggle">
                                                <!-- <input type="checkbox" class="check-ingaia" name="check-bling[]" value="<?php echo $produto_bling->id ?>" <?= $anuncioSemImagens ? 'disabled' : '' ?>> -->
                                                <input type="checkbox" id="customCheck<?= $j ?>" class="check-ingaia custom-control-input" name="check-bling[]" value="<?php echo $produto_bling->id ?>" <?= $anuncioSemImagens ? 'disabled' : '' ?>">
                                                <span class="custom-toggle-slider rounded-circle check-ingaia" data-label-off="Não" data-label-on="Sim"></span>
                                            </label>
                                        </td>
                                        <td style="white-space: normal !important;">
                                            <?= $produto_bling->descricao ?>
                                            <div class="avatar-group d-block">
                                                <?php foreach ($produto_bling->imagem as $img) : ?>
                                                    <a href="#" class="avatar avatar-sm rounded-circle" data-toggle="tooltip">
                                                        <img src="<?= $img->link ?>" onerror="errorImg(this)">
                                                    </a>
                                                <?php endforeach ?>
                                            </div>
                                            <?php if ($anuncioSemImagens) : ?>
                                                <span class="text-danger">
                                                    Anúncio sem imagens.
                                                </span>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            R$ <?= number_format($produto_bling->preco, 2, ',', '.') ?>
                                        </td>
                                        <td style="width: 50rem;">
                                            <?= 
                                                bs4t_select_categorias(
                                                    $produto_bling->id, 
                                                    $produto_bling->descricaoCurta . ' ' . $produto_bling->descricao . ' ' . $produto_bling->categoria->descricao, 
                                                    $anuncioSemImagens) 
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="form-row align-items-end justify-content-center">
                <div class="mx-auto">
                    <input type="hidden" name="api-key-bling" value="<?= $_POST['api-key-bling'] ?>">
                    <button type="submit" class="btn btn-primary rounded">Integrar</button>
                </div>
            </div>
        </form>

        <?php include_once 'src/paginacao.php'; ?>

    <?php endif; ?>
<?php endif; ?>