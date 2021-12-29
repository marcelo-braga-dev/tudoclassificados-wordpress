<?php
// Configura credenciais
MercadoPago\SDK::setAccessToken('APP_USR-8347191981098114-070816-6978299c04fefce92bfb9776471d6211-465347382');

function backUrls()
{
   return array(
      "success" => "https://www.tudoclassificados.com/checkout-mercado-pago",
      "failure" => "https://www.tudoclassificados.com/checkout-mercado-pago",
      "pending" => "https://www.tudoclassificados.com/checkout-mercado-pago"
   );
}

#Pacote Anúncios Premium
$pctPremiumUnico = new MercadoPago\Preference();
$item = new MercadoPago\Item();

$item->title = 'Anúncio Premium Único';
$item->quantity = 1;
$item->unit_price = 9.99;

$pctPremiumUnico->back_urls = backUrls();
$pctPremiumUnico->auto_return = "approved";
$pctPremiumUnico->external_reference = "PCT PREMIUM UNICO - " . get_current_user_id();
$pctPremiumUnico->items = array($item);
$pctPremiumUnico->save();

#Pacote Anuncio Premium
$pctPremium = new MercadoPago\Preference();
$item = new MercadoPago\Item();

$item->title = 'Pacote de Anúncios Premium';
$item->quantity = 1;
$item->unit_price = 99.99;
$pctPremium->back_urls = backUrls();
$pctPremium->auto_return = "approved";
$pctPremium->external_reference = "PCT ANUNCIOS PREMIUM - " . get_current_user_id();
$pctPremium->items = array($item);
$pctPremium->save();
///

#Automoveis Profissional
$autoProfi = new MercadoPago\Preference();
$item = new MercadoPago\Item();

$item->title = 'Automoveis - Profissional';
$item->quantity = 1;
$item->unit_price = 99.99;
$autoProfi->back_urls = backUrls();
$autoProfi->auto_return = "approved";
$autoProfi->external_reference = "PCT AUTOMOVEIS PROFISSIONAL - " . get_current_user_id();
$autoProfi->items = array($item);
$autoProfi->save();

#Automoveis Ilimitado
$autoIli = new MercadoPago\Preference();
$item = new MercadoPago\Item();

$item->title = 'Automoveis - Ilimitado';
$item->quantity = 1;
$item->unit_price = 99.99;
$autoIli->back_urls = backUrls();
$autoIli->auto_return = "approved";
$autoIli->external_reference = "PCT AUTOMOVEIS ILIMITADO - " . get_current_user_id();
$autoIli->items = array($item);
$autoIli->save();
///

#Imoveis Basico
$imoveisBasico = new MercadoPago\Preference();
$item = new MercadoPago\Item();

$item->title = 'Imoveis - Básico';
$item->quantity = 1;
$item->unit_price = 299.99;
$imoveisBasico->back_urls = backUrls();
$imoveisBasico->auto_return = "approved";
$imoveisBasico->external_reference = "PCT IMOVEIS BASICO - " . get_current_user_id();
$imoveisBasico->items = array($item);
$imoveisBasico->save();

#Imoveis Ilimitado
$imoveisIli = new MercadoPago\Preference();
$item = new MercadoPago\Item();

$item->title = 'Imoveis - Profissional';
$item->quantity = 1;
$item->unit_price = 399.99;
$imoveisIli->back_urls = backUrls();
$imoveisIli->auto_return = "approved";
$imoveisIli->external_reference = "PCT IMOVEIS PROFISSIONAL - " . get_current_user_id();
$imoveisIli->items = array($item);
$imoveisIli->save();
