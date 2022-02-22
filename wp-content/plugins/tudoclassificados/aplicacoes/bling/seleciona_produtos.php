<form method="post">
    <div class="form-row align-items-end justify-content-center">
        <div class="form-group col-md-8">
            <label for="inputEmail4">API Key:</label>
            <input type="text" class="form-control" id="api-key-bling" name="api-key-bling" value="<?= $api_key_bling ?>" required>
        </div>
        <div class="form-group col-md-auto">
            <button type="submit" class="btn btn-primary btn-block rounded">Buscar</button>
        </div>
    </div>
</form>

<?php
if ($produtos_bling['erro']['cod'] || empty($produtos_bling['produtos'])) {
    if ($produtos_bling['erro']['cod']) {
        echo '
            <div class="alert alert-danger" role="alert">
                ' . $produtos_bling['erro']['msg'] . '
            </div>';
    }
} else { ?>
    <?php
    
    ?>

    <form method="POST">
        <div class="form-row align-items-end justify-content-center">
            <div class="col-12">
                <div class="table-responsive text-nowrap">
                    <table class="table table-sm rounded table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>
                                </th>
                                <th scope="col">
                                </th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Código</th>
                                <th scope="col">Preço</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $k = 0;
                            if ($num_page > 1) $k = $num_page * 100;
                            foreach ($produtos_bling['produtos'] as $produto_bling) :
                                $produto_bling = $produto_bling->produto;

                                $i++;
                                $j = $i + $k;
                            ?>
                                <tr>
                                    <td style="text-align:right;">
                                        <?php echo $j ?>&nbsp;
                                    </td>
                                    <td>
                                        <input type="checkbox" class="check-ingaia" name="check-bling[]" value="<?php echo $produto_bling->codigo ?>">
                                        <!-- <div class="form-check text-center">
                                            <input class="form-check-input linha-table position-static" type="checkbox" name="check-bling[]" id="check-<?php echo $i ?>">
                                        </div> -->
                                    </td>
                                    <td class="px-2"><?php echo $produto_bling->descricao ?></td>
                                    <td class="px-2"><?= bs4t_select_categorias($produto_bling->codigo, [27,32]) ?></td>
                                    <td class="px-2"><?php echo $produto_bling->codigo ?></td>
                                    <td class="px-2"><?php echo 'R$ ' . number_format($produto_bling->preco, 2, ',', '.') ?></td>
                                </tr>
                            <?php endforeach ?>
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

<?php } ?>

<script>
    var abaIntegracaoBling = '<?= $_GET['page_bling'] ?>';
</script>

<?php
function bs4t_integracao_bling()
{ ?>
    <script src="/wp-content/plugins/tudoclassificados/aplicacoes/bling/assets/script.js"></script>
<?php }
add_action('wp_footer', 'bs4t_integracao_bling', 105);
?>