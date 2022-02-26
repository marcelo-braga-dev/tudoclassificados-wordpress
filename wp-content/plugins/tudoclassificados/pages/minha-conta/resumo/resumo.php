<?php

$current_user = wp_get_current_user();

if (!empty($_POST['form-contato'])) {
    update_user_meta($user_id, 'email_contato', $_POST['email_contato']);
    update_user_meta($user_id, 'celular', $_POST['celular_contato']);
    update_user_meta($user_id, 'facebook', $_POST['facebook']);
    update_user_meta($user_id, 'instagram', $_POST['instagram']);
    update_user_meta($user_id, 'cep', preg_replace('/\D/', '', $_POST['cep_contato']));

    wp_redirect('/minha-conta');
}

?>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white">
                <div class="row justify-content-between align-items-center px-3">
                    <div>
                        <h3 class="mb-0">Seus Meios de Contato</h3>
                    </div>
                    <div>
                        <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                            <i class="fas fa-comments"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-control-label" for="email_contato">Seu email para contato:</label>
                                <input type="email" class="form-control" name="email_contato" id="email_contato" value="<?= $current_user->user_email ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="celular_contato">Celular (whatsapp):</label>
                                <input type="text" class="form-control" name="celular_contato" id="celular_contato" value="<?= get_user_meta($user_id, 'celular')[0] ?>" data-mask="(00) 0 0000-0000">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cep_contato">Cep para cálculo de frete:</label>
                                <input type="text" class="form-control" name="cep_contato" id="cep_contato" value="<?= get_user_meta($user_id, 'cep')[0] ?>" minlength="9" placeholder="00000-000" data-mask="00000-000" required>
                            </div>
                        </div>
                    </div>

                    <hr class="mb-2">

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="facebook">Facebook:</label>
                                <input type="text" class="form-control" name="facebook" id="facebook" value="<?= get_user_meta($user_id, 'facebook')[0] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="instagram">Instagram:</label>
                                <input type="text" class="form-control" name="instagram" id="instagram" value="<?= get_user_meta($user_id, 'instagram')[0] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="form-contato" value="true">
                            <button class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="col-md-6 order-xl-2">
        <?= do_shortcode("[uwp_users_item]"); ?>
        <div class="row">
            <div class="col">
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Seus Anúncios
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <small>Anúncios Ativos</small>
                        <span class="badge badge-light" style="font-size: 14px;"><?= acadp_get_user_total_active_listings(); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <small>Anúncios Publicados</small>
                        <span class="badge badge-light" style="font-size: 14px;"><?= acadp_get_user_total_listings(); ?></span>
                    </li>
                </ul>
            </div>
            <div class="col">
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Anúncios Premium
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <small>Produtos/Serviços</small>
                        <span class="badge badge-light" style="font-size: 14px;"><?= $limiteAnunciosPremium['geral']; ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <small>Imóveis</small>
                        <span class="badge badge-light" style="font-size: 14px;"><?= $limiteAnunciosPremium['imoveis']; ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <small>Automóveis</small>
                        <span class="badge badge-light" style="font-size: 14px;"><?= $limiteAnunciosPremium['automoveis']; ?></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>