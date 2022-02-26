<?php

use TudoClassificados\Services\Pages\MinhaConta\Classificados\ClassificadosService;
use TudoClassificados\Services\Pages\MinhaConta\Imoveis\ImoveisService;
use TudoClassificados\Services\Pages\MinhaConta\Marketplace\MarketplaceService;

$userId = get_current_user_id();
$userMeta = get_user_meta($userId);

require_once 'helpers.php';

if ($_POST['editar-premium']) {
    update_post_meta($_POST['post_id'], 'featured', $_POST['valor']);
    print_pre($_POST);
}

if (!empty($_POST['cep-usuario'])) {
    set_cep_usuario($_POST['cep-usuario']);
}

// Classificados
if (!empty($_GET['classificados-bling'])) {
    $service = new ClassificadosService();
    $produtosBling = $service->index();
}

// Marketplace
if (!empty($_GET['marketplace-bling'])) {
    $service = new MarketplaceService();
    $produtosBling = $service->index();
}

// Imoveis
if (!empty($_GET['imoveis_ingaia'])) {
    $service = new ImoveisService();
    $imoveisIngaia = $service->index();
}

$limiteAnunciosPremium = get_limit_anuncios_premium($userId);
$anunciosImoveisAtivo = get_qtd_anuncios_imoveis_usuario($userId);
$limitesImovel = tc_limit_imoveis_usuario($limiteAnunciosPremium['imoveis'], $anunciosImoveisAtivo);

$abaMenu = get_session('aba_minha_conta');