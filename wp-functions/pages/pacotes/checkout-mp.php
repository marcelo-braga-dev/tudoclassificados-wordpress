<?php

include_once ABSPATH . 'wp-functions/pages/pacotes/src/MercadoPago.php';
include_once 'src/AlterarPremium.php';

?>
<?php if ($resposta) : ?>
    <div class="alert alert-success rounded">
        <?= $resposta ?>
    </div>
<?php endif ?>