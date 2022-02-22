<?php
global $wpdb;
if (is_user_logged_in()) :

    require_once ABSPATH . 'wp-content/plugins/tudoclassificados/pages/minha-conta/assets/funcoes.php';

    $user_id = get_current_user_id();
    $user_meta = get_user_meta($user_id);
    $abaMenu = $_GET['aba_menu'];
    $i = 1;

    $dataLocal = date('d/m/Y H:i:s', time());

    if ($_POST['editar-premium']) {
        update_post_meta($_POST['post_id'], 'featured', $_POST['valor']);
    }

    if (!empty($_POST['cep-usuario'])) {
        set_cep_usuario($_POST['cep-usuario']);
    }

    // $produtosBling = tc_get_produtos_bling();
    //$alerta = tc_integrar_bling($produtosBling);

?>
    <style>
        .seleciona-linha-table {
            cursor: pointer;
        }

        .text-main {
            /* color: var(--principal) !important; */
            color: #333;
            font-size: 14px;
            font-weight: 300 !important;
        }

        .text-main .active {
            color: red !important;
        }

        a.active {
            color: orange !important;
        }

        .text-sub-menu {
            font-size: 14px !important;
        }
    </style>

    <div class="card" style="background-color: #fcfcfc">
        <div class="row">
            <div class="col-md-3 card pt-4 pb-md-9 mb-md-9">
                <!-- Grupo de lista -->
                <div class="list-group navbar-nav" id="minhaLista" role="tablist" style="font-size: 13px;">

                    <!-- Perfil -->
                    <a class="text-main pl-1 mb-2 <?php if (empty($abaMenu)) echo 'active' ?>" id="resumo-tab" data-toggle="list" href="#resumo" role="tab">
                        <div class="row nav-item">
                            <div class="col-2 text-right">
                                <i class="fas fa-user-alt"></i>
                            </div>
                            <div class="col-10">
                                Perfil
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider pb-2"></div>
                    
                    <!-- Pagamentos -->
                    <a class="text-main mb-2" id="anuncios-classificados-tab" data-toggle="list" href="#anuncios-classificados" role="tab">
                        <div class="row nav-item">
                            <div class="col-2 text-right">
                                <i class="fab fa-dribbble"></i>
                            </div>
                            <div class="col-10">
                                Anúncios Classificados
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider pb-2"></div>

                    <!-- Filiado -->
                    <a class="text-main pl-1 mb-1" id="i ntegracoes-tab" data-toggle="list" role="tab">
                        <div class="row nav-item">
                            <div class="col-auto text-right">
                                <i class="fas fa-desktop"></i>
                            </div>
                            <div class="col-10 ">
                                Anunciar como Afiliado
                            </div>
                        </div>
                    </a>
                    <a class="text-main mb-2" id="anuncios_filiado-tab" data-toggle="list" href="#anuncios_filiado" role="tab">
                        <div class="row nav-item">
                            <div class="col-2 text-right"></div>
                            <div class="col-10 pl-4">
                                <span class="text-sub-menu">Anúncios como Afiliado</span>
                            </div>
                        </div>
                    </a>
                    <a class="text-main mb-2 <?= $abaMenu == 'filiado_bling' ? 'active' : '' ?>" id="filiado_bling-tab" data-toggle="list" href="#filiado_bling" role="tab">
                        <div class="row nav-item">
                            <div class="col-2 text-right"></div>
                            <div class="col-10 pl-4">
                                <span class="text-sub-menu">Integrar com Bling</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider pb-2"></div>

                    <!-- Imoveis -->
                    <a class="text-main pl-1 mb-1" id="imoveis-integracoes-tab" data-toggle="list" role="tab">
                        <div class="row nav-item">
                            <div class="col-2 text-right">
                                <i class="fas fa-home"></i>
                            </div>
                            <div class="col-10 ">
                                Imoveis
                            </div>
                        </div>
                    </a>
                    <a class="text-main mb-2" id="imoveis_anuncios-tab" data-toggle="list" href="#imoveis_anuncios" role="tab">
                        <div class="row nav-item">
                            <div class="col-2 text-right"></div>
                            <div class="col-10 pl-4">
                                <span class="text-sub-menu">Anúncios de Imóveis</span>
                            </div>
                        </div>
                    </a>
                    <a class="text-main mb-2 <?= $abaMenu == 'imoveis_ingaia' ? 'active' : '' ?>" id="imoveis_ingaia-tab" data-toggle="list" href="#imoveis_ingaia" role="tab">
                        <div class="row nav-item">
                            <div class="col-2 text-right"></div>
                            <div class="col-10 pl-4">
                                <span class="text-sub-menu">Integrar com inGaia</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider pb-2"></div>

                    <!-- Comentarios -->
                    <a class="text-main mb-2" id="comentarios-tab" data-toggle="list" href="#comentarios" role="tab">
                        <div class="row nav-item mb-2">
                            <div class="col-2 text-right">
                                <i class="fas fa-comment"></i>
                            </div>
                            <div class="col-10">
                                Comentários <span class="badge badge-danger mx-2" id="badge-comentarios"></span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider pb-2"></div>

                    <!-- Pagamentos -->
                    <a class="text-main mb-2" id="pagamentos-tab" data-toggle="list" href="#pagamentos" role="tab">
                        <div class="row nav-item">
                            <div class="col-2 text-right">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="col-10">
                                Pagamentos
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider pb-2"></div>

                    <!-- Perfil -->
                    <a class="text-main mb-3" id="editar-perfil-tab" data-toggle="list" href="#editar-perfil" role="tab">
                        <div class="row nav-item mb-2">
                            <div class="col-2 text-right">
                                <i class="fas fa-user-cog"></i>
                            </div>
                            <div class="col-10">
                                Editar Perfil
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-9">
                <!-- Painel de abas -->
                <div class="tab-content">
                    <!-- Resumo -->
                    <div class="tab-pane fade <?php if (empty($abaMenu)) echo 'active show' ?>" id="resumo" role="tabpanel">
                        <?php include 'resumo/resumo.php' ?>
                    </div>
                    
                    <!-- Anuncios Classificados -->
                    <div class="tab-pane fade" id="anuncios-classificados" role="tabpanel">
                        <?php include 'classificados/anuncios-classificados.php' ?>
                    </div>

                    <!-- Afiliado -->
                    <div class="tab-pane fade" id="anuncios_filiado" role="tabpanel">
                        <?php include 'afiliado/anuncios.php' ?>
                    </div>
                    <div class="tab-pane fade <?= $abaMenu == 'filiado_bling' ? 'active show' : '' ?>" id="filiado_bling" role="tabpanel">
                        <?php include 'afiliado/bling/index.php' ?>
                    </div>

                    <!-- Imoveis -->
                    <div class="tab-pane fade" id="imoveis_anuncios" role="tabpanel">
                        <?php include 'imoveis/anuncios.php'; ?>
                    </div>
                    <div class="tab-pane fade <?= $abaMenu == 'imoveis_ingaia' ? 'active show' : '' ?>" id="imoveis_ingaia" role="tabpanel">
                        <?php include ABSPATH . 'wp-content/plugins/tudoclassificados/aplicacoes/ingaia/principal.php'; ?>
                    </div>

                    <!-- Anuncios -->
<!--                    <div class="tab-pane fade" id="meus-anuncios" role="tabpanel">-->
<!--                        --><?php //include 'partials/meus_anuncios.php' ?>
<!--                    </div>-->

                    <!-- Marketplace -->
<!--                    <div class="tab-pane fade" id="marketplace_anuncios" role="tabpanel">-->
<!--                        --><?php //include 'marketplace/anuncios.php' ?>
<!--                    </div>-->
<!--                    <div class="tab-pane fade --><?//= $abaMenu == 'marketplace_bling' ? 'active show' : '' ?><!--" id="marketplace_bling" role="tabpanel">-->
<!--                        --><?php //include 'marketplace/bling/index.php'; ?>
<!--                    </div>-->
<!--                    <div class="tab-pane fade" id="marketplace_mercadopago" role="tabpanel">-->
<!--                        --><?php //include 'partials/marketplace/sincronizar-conta.php' ?>
<!--                    </div>-->

                    <!-- Comentarios -->
                    <div class="tab-pane fade" id="comentarios" role="tabpanel">
                        <?php include 'comentarios/comentarios.php' ?>
                    </div>

                    <!-- Pagamentos -->
                    <div class="tab-pane fade" id="pagamentos" role="tabpanel">
                        <?php include 'pagamentos/pagamentos.php' ?>
                    </div>

                    <!-- Perfil -->
                    <div class="tab-pane fade" id="editar-perfil" role="tabpanel">
                        <?php include 'perfil/editar-perfil.php' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php if (!empty($alerta)) : ?>

    <!-- Modal -->
    <div class="modal fade" id="modalAlertSimples" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
        <div class="modal-dialog modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalCentralizado">Aviso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    if (!empty($alerta['sucesso'])) :
                        echo $alerta['sucesso'];
                    endif;
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $('#modalAlertSimples').modal('show');
        })
    </script>
<?php endif ?>



<script>
    let maxPremiumGeral = '<?= bs4t_user_is_premium('geral') ?>';
    let maxPremiumImovel = '<?= bs4t_user_is_premium('imoveis') ?>';
    const qtdImovelAtivo = '<?= $qtdImovelAtivo ?>';
    const qtdGeralAtivo = '<?= $qtdGeralAtivo ?>';

    const abaMeusAnuncios = <?= get_query_var('paged') ?>;
    const abaIntegracaoMinhaConta = '<?= $_POST['buscar-ingaia'] . $_POST['integrar_ingaia'] ?>';
    const abaIntegracaoBling = '<?= $_GET['page_bling'] . $_POST['api-key-bling'] ?>';
</script>

<script>
    $(function() {
        $('.input-check').change(function() {
            attrInput = false;

            if ($(this).is(':checked')) attrInput = true;

            $(this).parent().parent().parent().find('input').attr('required', attrInput);
        });
    })
</script>

<?php
function bs4_script_abas_minha_conta()
{   ?>
    <script src="/wp-content/plugins/tudoclassificados/pages/minha-conta/assets/js/main.js?id=<?= uniqid() ?>"></script>
    <script src="/wp-content/plugins/tudoclassificados/pages/minha-conta/assets/js/abas.js?id=<?= uniqid() ?>"></script>
<?php
}
add_action('wp_footer', 'bs4_script_abas_minha_conta', 103);
?>