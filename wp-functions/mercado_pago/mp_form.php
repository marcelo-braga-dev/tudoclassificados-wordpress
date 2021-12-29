<?php
// SDK de Mercado Pago
//require_once ABSPATH.'wp-functions/aplicacoes/sdk/vendor/autoload.php';// __DIR__ .  '/vendor/autoload.php';

echo ABSPATH.'wp-functions/aplicacoes/sdk/vendor/autoload.php';exit();/*
// Configura credenciais
MercadoPago\SDK::setAccessToken('TEST-3990540666149246-032702-380c9679cbdcad9309227da8b53f71b2-731634047');

    #Pacote Básico
// Cria um objeto de preferência
$pacoteBasico = new MercadoPago\Preference();

// Cria um item na preferência
$item = new MercadoPago\Item();
$item->title = 'Pacote BÁSICO - Mensal';
$item->quantity = 1;
$item->unit_price = 19.99;

$pacoteBasico->payment_methods = array(
  "excluded_payment_methods" => array(
    array("id" => "master")
  ),
  "excluded_payment_types" => array(
    array("id" => "ticket")
  ),
  "installments" => 12
);

$pacoteBasico->back_urls = array(
    "success" => "https://www.tudoclassificados.com/minha-conta",
    "failure" => "https://www.tudoclassificados.com/minha-conta",
    "pending" => "https://www.tudoclassificados.com/minha-conta"
);
$pacoteBasico->auto_return = "approved";
$pacoteBasico->external_reference = "PCT BASICO MENSAL";

$pacoteBasico->items = array($item);
$pacoteBasico->save();

    #Pacote Profi
// Cria um objeto de preferência
$pacoteProfi = new MercadoPago\Preference();

// Cria um item na preferência
$item = new MercadoPago\Item();
$item->title = 'Pacote PROFISSIONAL - Mensal';
$item->quantity = 1;
$item->unit_price = 49.99;

$pacoteProfi->payment_methods = array(   
);

$pacoteProfi->back_urls = array(
    "success" => "https://www.tudoclassificados.com/minha-conta",
    "failure" => "https://www.tudoclassificados.com/minha-conta",
    "pending" => "https://www.tudoclassificados.com/minha-conta"
);
$pacoteProfi->auto_return = "approved";
$pacoteProfi->external_reference = "PCT PROFI. MENSAL";

$pacoteProfi->items = array($item);
$pacoteProfi->save();

?>
<!----------------------->
<style>
    .mercadopago-button{
        background-color: #004DA9;
        border-radius:3px !important;
    }
</style>





