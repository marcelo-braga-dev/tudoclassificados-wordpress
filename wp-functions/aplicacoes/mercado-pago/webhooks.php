<?php
// print_r($_GET);
// $ACCESS_TOKEN = 'TEST-3990540666149246-032702-380c9679cbdcad9309227da8b53f71b2-731634047';
// $idPagamento = $_GET['id'];

// $url = "https://api.mercadopago.com/v1/payments/" . $idPagamento;

// function executeGetProducts($url, $ACCESS_TOKEN)
// {
//     $curl_handle = curl_init();
//     curl_setopt($curl_handle, CURLOPT_URL, $url);
//     curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
//     curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $ACCESS_TOKEN));
//     $response = curl_exec($curl_handle);
//     curl_close($curl_handle);

//     return $response;
// }

// $resposta = executeGetProducts($url, $ACCESS_TOKEN);

// $resposta = json_decode($resposta);
// echo '<pre>';
// print_r($resposta);
// echo '</pre>';


class ConstantesDB
{
    protected const DB_HOST = 'localhost';
    protected const DB_USER = 'tudocl45_tudoclassceo';
    protected const DB_PASS = '^4)wW{]wQyjS';
    const DB_NAME = 'tudocl45_tudoclassi1';

    protected function conectaTabela()
    {
        $mysql = new mysqli(self::DB_HOST, self::DB_USER, self::DB_PASS, self::DB_NAME);
        $mysql->set_charset('utf8');

        if ($mysql == FALSE) {
            echo "Erro na conexão";
            exit();
        }

        $this->mysql = $mysql;
    }

    public function salvarWebhooks()
    {
        $this->conectaTabela();

        $salvar = $this->mysql->prepare("INSERT INTO `class_imp_contas_premium` 
                                          ( 
                                             `pacote`                                            
                                          ) 
                                       VALUES (?)");
        $salvar->bind_param(
            's',
            $_GET['topic']
        );
        echo $salvar->execute();
    }
}

$salvar = new ConstantesDB();
$salvar->salvarWebhooks();

// $wpdb->insert(
//     $table,
//     array(
//         'post_id' => $_POST['post_id'],
//         'user_id' => $_POST['user_id'],
//         'anunciante_id' => $_POST['anunciante_id'],
//         'pergunta' => wp_strip_all_tags($_POST['pergunta']),
//         'data_pergunta' => $data,
//     )
// );

/*
curl -X GET \
    'https://api.mercadopago.com/v1/payments/{id}' \
    -H 'Authorization: Bearer ACCESS_TOKEN_ENV' 


{
    "id": 1,
    "date_created": "2017-08-31T11:26:38.000Z",
    "date_approved": "2017-08-31T11:26:38.000Z",
    "date_last_updated": "2017-08-31T11:26:38.000Z",
    "money_release_date": "2017-09-14T11:26:38.000Z",
    "payment_method_id": "account_money",
    "payment_type_id": "credit_card",
    "status": "approved",
    "status_detail": "accredited",
    "currency_id": "BRL",
    "description": "Pago Pizza",
    "collector_id": 2,
    "payer": {
      "id": 123,
      "email": "afriend@gmail.com",
      "identification": {
        "type": "DNI",
        "number": 12345678
      },
      "type": "customer"
    },
    "metadata": {},
    "additional_info": {},
    "order": {},
    "transaction_amount": 250,
    "transaction_amount_refunded": 0,
    "coupon_amount": 0,
    "transaction_details": {
      "net_received_amount": 250,
      "total_paid_amount": 250,
      "overpaid_amount": 0,
      "installment_amount": 250
    },
    "installments": 1,
    "card": {}
  }
  */