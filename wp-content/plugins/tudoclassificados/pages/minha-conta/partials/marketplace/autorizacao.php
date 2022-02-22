<?php
require ABSPATH . 'vendor/autoload.php';

autenticar($_GET['code']);

// Autentica a conta no Mercado Livre
function autenticar(string $code)
{
    $client = new \GuzzleHttp\Client();

    try {
        $res = $client->request('POST', 'https://api.mercadolibre.com/oauth/token', [
            'headers' => [
                'accept' => 'application/json',
                'content-type' => 'application/x-www-form-urlencoded'
            ],
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => '3209148207298652',
                'client_secret' => 'wFkkBuz2l7VBx5FCIZNpV11sQXLzDyzc',
                'code' => $code,
                'redirect_uri' => 'https://www.tudoclassificados.com/redirect-mercado-pago/',
            ]
        ]);

        $json = $res->getBody();
        $resposta = json_decode($json, true);

        salvarDadosIntegracao($resposta);

    } catch (Exception $exception) {
        $_SESSION['erro'] = 'Ocorreu um erro no cadastro da conta Mercado Livre.';
        wp_redirect('/minha-conta?marketplace=ok&status=sucesso');
    }

    wp_redirect('/minha-conta?marketplace=ok&status=sucesso');
    exit();
}

// Retorna o link de integracao com o Mercado Livre
function urlAutorizacao()
{
    // $url =
    //     'https://auth.mercadolivre.com.br/authorization?response_type=code&client_id=' .
    //     $idCliente .
    //     '&redirect_uri=' .
    //     $urlRetorno;

    // return $url;
}

// Salva no banco de dados as chaves
function salvarDadosIntegracao(array $dados)
{
    global $wpdb;

    $table = 'class_imp_inte_mercadopago';
    $user_id = get_current_user_id();
    $conta_id = $dados['user_id'];

    $contaExist = $wpdb->get_results("SELECT * FROM $table 
                              WHERE user = '$user_id' AND user_id = '$conta_id'");

    if (!count($contaExist)) {
        $wpdb->insert(
            $table,
            [
                'user' => get_current_user_id(),
                'user_id' => $dados['user_id'],
                'access_token' => $dados['access_token'],
                'expires_in' => $dados['expires_in'],
                'refresh_token' => $dados['refresh_token'],
                'data' => date('d/m/y')
            ]
        );

        $_SESSION['sucesso'] = 'Conta Mercado Livre Sincronizada';
        return;
    }

    $_SESSION['erro'] = 'Essa conta já está registrada';
    return;

    //     $integracao->push();

    //     session()->flash('sucesso', 'Conta vinculada com sucesso.');
    //     return;
    // }

    // session()->flash('erro', 'Conta Mercado Livre #' . $dados['user_id'] . ' já está cadastrada.');
}

// Ronova as chaves de autenticacao
function renovarAutenticacao(string $sellerId)
{ /*
        $client = new Client();
        $integracao = new IntegracaoMercadoLivre();

        $chaves = $integracao->query()
            ->where('seller_id', '=', $sellerId)
            ->first();

        $res = $client->request(
            'POST',
            'https://api.mercadolibre.com/oauth/token?' .
                'grant_type=refresh_token' .
                '&client_id=' . $this->client_id .
                '&client_secret=' . $this->client_secret .
                '&refresh_token=' . $chaves->refresh_token
        );

        $json = $res->getBody();
        $dados = json_decode($json, true);

        $integracao
            ->where('seller_id', '=', $sellerId)
            ->update(
                [
                    'access_token' => $dados['access_token'],
                    'refresh_token' => $dados['refresh_token'],
                    'expires_in' => $dados['expires_in']
                ]
            );

        return $dados['access_token'];*/
}
