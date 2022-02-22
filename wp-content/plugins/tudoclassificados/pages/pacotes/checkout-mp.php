<?php

include_once ABSPATH . 'wp-content/plugins/tudoclassificados/pages/pacotes/src/MercadoPago.php';
include_once 'src/AlterarPremium.php';

?>
<?php if ($resposta) : ?>
    <div class="alert alert-success rounded">
        <?= $resposta ?>
    </div>
<?php endif ?>