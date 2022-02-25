<?php

$user_id = get_current_user_id();
$user_meta = get_user_meta($user_id);

require_once 'helpers.php';
require_once 'Integracoes/bling.php';

if ($_POST['editar-premium']) {
    update_post_meta($_POST['post_id'], 'featured', $_POST['valor']);
}

if (!empty($_POST['cep-usuario'])) {
    set_cep_usuario($_POST['cep-usuario']);
}

if (!empty($_GET['classificados-bling'])) {
    $produtosBling = tc_get_produtos_bling();
    session('aba_minha_conta', 'classificados-integrar-bling');

    if (!empty($_POST['checks'])) {
        tc_integrar_bling($produtosBling);
    }
}

$abaMenu = get_session('aba_minha_conta');