<?php

$data['nCdEmpresa'] = '';
$data['sDsSenha'] = '';

$data['sCepOrigem'] = $_POST['cep_origem'];
$data['sCepDestino'] = $_POST['cep_destino'];

$data['sCdMaoPropria'] = 'n';
$data['nVlValorDeclarado'] = '0';
$data['sCdAvisoRecebimento'] = 'n';


$data['nCdFormato'] = '1';
$data['nVlPeso'] = $_POST['peso_produto'] < 0.3 ? 0.3 : $_POST['peso_produto'];
$data['nVlComprimento'] = $_POST['comprimento_produto'] < 15 ? 15 : $_POST['comprimento_produto'];
$data['nVlLargura'] = $_POST['largura_produto'] < 10 ? 10 : $_POST['largura_produto'];
$data['nVlAltura'] = $_POST['altura_produto'] < 1 ? 1 : $_POST['altura_produto'];
$data['nVlDiametro'] = '0';

function comunicaApiCorreios($data)
{

    $data['StrRetorno'] = 'xml';

    $data = http_build_query($data);

    $url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx';

    $curl = curl_init($url . '?' . $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    $result = simplexml_load_string($result);

    return $result;
}

$resposta = [];

$codTipos[] = ['41106', '40010'];

for ($i = 0; $i < count($codTipos[0]); $i++) {

    $data['nCdServico'] = $codTipos[0][$i];
    $xml = comunicaApiCorreios($data);
    $resposta[$i] = $xml->cServico;

    if ($codTipos[0][$i] == 41106) $resposta[$i]->Tipo = 'PAC';
    if ($codTipos[0][$i] == 40010) $resposta[$i]->Tipo = 'SEDEX';
}

echo json_encode($resposta);
      
      //echo $row->MsgErro;
