<?php
/*
e29821c3ec4b8655b7fca62700633cac025dc1c1174ff65e70212b5ce43e7700117cc202

89268f9bd090d8c6bd9d399168d1045c59ddc345886c1c702404bb5892bc75fa7ae13562

46ce98b2ad08226ffe9419a2f2de96cf6bb0f62b482d062ae13be1d9a255758bab29524a
*/
include_once 'src/funcoes.php';

$user_id = get_current_user_id();

if ($_POST['api-key-bling']) {
    setApiBling($user_id);
}

$api_key_bling = getApiBling($user_id);

if ($_POST['api-key-bling'] || $_GET['page_bling']) {
    if ($api_key_bling) {
        $produtos_bling = comunicacaoBling($api_key_bling);
    }
}

if (!empty($_POST['check-bling'])) {
    include_once 'src/salvar-produtos.php';

    salvarProdutos($user_id, $api_key_bling, $_POST, $produtos_bling);
}
?>
<div class="row">
    <div class="col-md-12 pb-3">
        <div class="main-content" id="panel">
            <!-- Page content -->
            <div class="container-fluid mt-2">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-white">
                                <div class="row justify-content-between align-items-center px-3">
                                    <div>
                                        <h3 class="mb-0">Bling</h3>
                                    </div>
                                    <div>
                                        <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                            <i class="fas fa-link"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php include_once 'tabela-produtos.php'; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
function bs4t_integracao_bling()
{ ?>
    <script src="/wp-content/plugins/tudoclassificados/aplicacoes/bling/assets/script.js"></script>
<?php }
add_action('wp_footer', 'bs4t_integracao_bling', 105);
?>