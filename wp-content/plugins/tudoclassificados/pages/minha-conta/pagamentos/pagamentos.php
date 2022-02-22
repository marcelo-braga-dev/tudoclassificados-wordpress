<?php
$pagamentos = $wpdb->get_results("SELECT * FROM class_imp_contas_premium 
                              WHERE user_id = '$user_id' ORDER BY id DESC");
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <div class="row justify-content-between align-items-center px-3">
                    <div>
                        <h3 class="mb-0">Pagamentos</h3>
                    </div>
                    <div>
                        <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php if (count($pagamentos)) : ?>
                    <div class="p-3">
                        <table class="table p-3">
                            <thead class="thead-light">
                            <tr>
                                <th class="text-center" scope="col">#</th>
                                <th scope="col">Data</th>
                                <th scope="col">Pacote</th>
                                <th scope="col">Válido até</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($pagamentos as $pagamento) : ?>
                                <tr>
                                    <th class="text-center" scope="row"><?= $pagamento->id ?></th>
                                    <td><?= preg_replace('/\s(.+)/', '', $pagamento->data_inicial) ?></td>
                                    <td><?= $pagamento->pacote ?></td>
                                    <td><?= preg_replace('/\s(.+)/', '', $pagamento->data_final) ?></td>
                                    <td><?= $pagamento->status ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                <?php else : ?>
                    <div class="m-3">
                        <span>Não há registros de pagamentos.</span>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>