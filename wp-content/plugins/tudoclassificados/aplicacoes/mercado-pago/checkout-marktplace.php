<?php

MercadoPago\SDK::setAccessToken('TEST-3209148207298652-092320-19c9437ebb0d2ccd99672d3ce0ed110e-465347382');

$preco = $post_meta['price'][0];


$preference = new MercadoPago\Preference();

$item = new MercadoPago\Item();
$item->title = esc_html($post->post_title);
$item->quantity = 1;
$item->currency_id = "BRL";
$item->unit_price = $preco;

if (!empty($_GET['frete_valor']))
{    
    $precoFrete = str_replace(',', '.', $_GET['frete_valor']);

    $shipments->cost = floatval($precoFrete);
    $shipments->mode = $_GET['frete_tipo'];
    $preference->shipments = $shipments;
}

$payer = new MercadoPago\Payer();

$preference->items = array($item);
$preference->payer = $payer;
$preference->marketplace_fee = 2.5;
$preference->notification_url = "https://www.tudoclassificados.com/mercadopago-notificacao/";

$preference->save();
?>

<script>
    $(function() {
        $('.valor-frete').change(function() {
            console.log('$(this).val()');
        });
    });

    $('#add_frete').click(function() {
        
        var emBase64 = btoa('string');

        window.location = window.location.pathname + '?res=' + emBase64;
    })
</script>


<script src="https://sdk.mercadopago.com/js/v2"></script>
<div class="cho-container mb-3"></div>

<script>
    // Adicione as credenciais do SDK
    const mp = new MercadoPago('TEST-18602958-2d02-45ba-bc9a-54e948b0134a', {
        locale: 'pt-BR'
    });

    // Inicialize o checkout
    mp.checkout({
        preference: {
            id: '<?= $preference->id ?>'
        },
        render: {
            container: '.cho-container',
            label: 'comprar',
        }
    });
    $('.mercadopago-button').removeClass('mercadopago-button')
        .addClass('btn btn-success btn-block py-1 rounded');
</script>