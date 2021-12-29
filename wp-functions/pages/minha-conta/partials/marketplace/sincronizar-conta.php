<?php
global $wpdb;

$contasMP = $wpdb->get_results("SELECT * FROM `class_imp_inte_mercadopago` 
                              WHERE user = '$user_id' ORDER BY id DESC");
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <div class="row justify-content-between align-items-center px-3">
                    <div>
                        <h3 class="mb-0">Sua Conta Mercado Pago</h3>
                    </div>
                    <div>
                        <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                            <i class="fas fa-store"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <?php if ($_SESSION['sucesso']) : ?>
                    <div class="alert alert-success">
                        <?= $_SESSION['sucesso'];
                        unset($_SESSION['sucesso']) ?>
                    </div>
                <?php elseif ($_SESSION['erro']) : ?>
                    <div class="alert alert-danger">
                        <?= $_SESSION['erro'];
                        unset($_SESSION['erro']) ?>
                    </div>
                <?php endif ?>

                <?php if (count($contasMP)) : ?>
                    <div class="row mb-4">
                        <div class="col-12 mb-3">
                            <span>Contas Mercado Pago Integradas</span>
                        </div>

                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Número da Conta Mercado Pago</th>
                                            <th scope="col">Data da Integração</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        <?php foreach ($contasMP as $contaMP) : ?>
                                            <tr>
                                                <td>
                                                    <?= $contaMP->user_id ?>
                                                </td>
                                                <td>
                                                    <?= $contaMP->data ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                    </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col">
                        <p>
                            Faça suas vendas e receba o dinheiro diretamente na sua conta do
                            Mercado Pago, com toda a segurança, tanto para você, quanto para o seu
                            cliete.
                        </p>
                        <p>
                            Para sincronizar sua conta é muito simples, basta clicar no botão abaixo e realizar a
                            autorização e a partir daí, toda o dinheiro da venda cai direto na sua conta do Mercado Pago.
                        </p>
                        <a class="btn btn-primary" href="https://auth.mercadopago.com.br/authorization?client_id=3209148207298652&response_type=code&platform_id=mp&redirect_uri=https://www.tudoclassificados.com/redirect-mercado-pago/">
                            Sincronizar sua conta
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>