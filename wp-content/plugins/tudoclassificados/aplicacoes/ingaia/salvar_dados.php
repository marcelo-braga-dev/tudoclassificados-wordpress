<?php

//CODIGO DO IMOVEIS
$cod_imoveis = $_POST['check_cod_ingaia'];
$xml_integrar = $_POST['xml_ingaia'];
$i = 0;

if (!empty($_POST['apikey_ingaia'])) {

    //PUXA XML SALVAR
    $xml_integrar_ingaia = simplexml_load_file($_POST['apikey_ingaia']);
    $arrayImg = array();

    $imoveisIngaia = $xml_integrar_ingaia->Imoveis->Imovel;

    foreach ($imoveisIngaia as $imovelIngaia) {
        foreach ($cod_imoveis as $cod_imovel) {
            if ($cod_imovel == $imovelIngaia->CodigoImovel) {

                $caracImovel = preencheCaracteristicas($imovelIngaia);

                $imgImoveis = preencheImg($imovelIngaia->Fotos->Foto);



                $post_status = count($imgImoveis) >= 1 ? 'publish' : 'sem_imagens';

                $dataExpiracao = date('Y-m-d H:i:s', strtotime('+30 days'));

                // Novo Anuncio
                $anuncio_imovel = array(
                    'post_title' => wp_strip_all_tags($imovelIngaia->TituloImovel),
                    'post_content' => wp_strip_all_tags($imovelIngaia->Observacao) . $caracImovel,
                    'comment_status' => 'closed',
                    'post_status' => $post_status,
                    'ping_status' => 'closed',
                    'post_type' => 'acadp_listings',
                    'post_author' => get_current_user_id(),
                    'meta_input' => array(
                        'id' => wp_strip_all_tags($cod_imovel),
                        '_thumbnail_id' => $thumbnail,
                        'origem' => 'ingaia',
                        'tipo' => 'imoveis',
                        'images' => $imgImoveis,
                        'video' => '',
                        'address' => wp_strip_all_tags($imovelIngaia->Endereco),
                        'bairro' => wp_strip_all_tags($imovelIngaia->Bairro),
                        'cidade' => wp_strip_all_tags($imovelIngaia->Cidade),
                        'estado' => wp_strip_all_tags($imovelIngaia->Estado),
                        'pais' => wp_strip_all_tags($imovelIngaia->Pais),
                        'zipcode' => wp_strip_all_tags(''),
                        'phone' => wp_strip_all_tags($imovelIngaia->corretor->celular),
                        'email' => wp_strip_all_tags($imovelIngaia->corretor->email),
                        'website' => wp_strip_all_tags($imovelIngaia->URLGaiaSite),
                        'latitude' => wp_strip_all_tags($imovelIngaia->latitude),
                        'longitude' => wp_strip_all_tags($imovelIngaia->longitude),
                        'hide_map' => wp_strip_all_tags(''),

                        'price' => wp_strip_all_tags($imovelIngaia->PrecoVenda),
                        'preco_aluguel' => wp_strip_all_tags($imovelIngaia->PrecoLocacao),

                        'featured' => '0',
                        'views' => '1',
                        'listing_status' => 'post_status',
                        'expiry_date' => $dataExpiracao,
                        '505' => $carac_imovel,
                        '506' => wp_strip_all_tags($imovelIngaia->QtdDormitorios), //c1
                        '508' => wp_strip_all_tags($imovelIngaia->QtdBanheiros),
                        '509' => wp_strip_all_tags($imovelIngaia->QtdVagas),
                        '512' => wp_strip_all_tags($imovelIngaia->QtdSuites),
                        '510' => wp_strip_all_tags($imovelIngaia->AreaUtil), //c5
                        '511' => wp_strip_all_tags($imovelIngaia->AreaTotal)
                    ),
                );

                if ($imovelIngaia->TipoImovel[0] == 'Apartamento')  $idCategoria = 36;
                if ($imovelIngaia->TipoImovel[0] == 'Terreno')      $idCategoria = 95;
                if ($imovelIngaia->TipoImovel[0] == 'Casa')         $idCategoria = 35;
                if ($imovelIngaia->TipoImovel[0] == 'Prédio')       $idCategoria = '';
                if ($imovelIngaia->TipoImovel[0] == 'Sala')         $idCategoria = 165;
                if (!$idCategoria) $idCategoria = 166;

                $post_id = wp_insert_post($anuncio_imovel); // IMPORTANTE
                wp_set_object_terms($post_id, intval($idCategoria), 'acadp_categories'); // IMPORTANTE

                $caracImovel = ''; // IMPORTANTE
                unset($idCategoria);
                unset($arrayImg);
                unset($anuncio_imovel);
                $i++;
            }
        }
    }

    $atualizarPagina = true;
}


if ($i > 0) $alerta = 1;
return;

function preencheImg($imagens)
{
    $count_img = 0;
    $origem = 'ingaia';

    foreach ($imagens as $argImg) {
        if ($count_img < 12) {
            $count_img++;

            $urlImg = wp_strip_all_tags($argImg->URLArquivo);

            // $urlImgExterno = wp_strip_all_tags($argImg->URLArquivo);
            // $tituloArquivo = 'x' . wp_strip_all_tags($argImg->NomeArquivo);

            // include '/home/tudocl45/img.tudoclassificados.com/BaixarImg.php';

            $salvarImagens = array(
                'post_author' => get_current_user_id(),
                'post_title' => wp_strip_all_tags($argImg->NomeArquivo),
                'guid' => $urlImg,
                'comment_status' => 'closed',
                'post_status' => 'inherit',
                'ping_status' => 'closed',
                'post_type' => 'attachment',
                'meta_input' => array(
                    '_wp_attached_file' => $urlImg,
                    '_url_externo' => $urlImg,
                )
            );

            $post_id = wp_insert_post($salvarImagens); //IMPORTANTE

            $arrayImg[] = $post_id;

            if (empty($thumbnail)) {
                $thumbnail = $post_id;
            }
        }
    }

    return $arrayImg;
}

function preencheCaracteristicas($imovelIngaia)
{
    $caracImovel = '<p><b>Principais Característica do Imóvel:</b></p>';

    if ($imovelIngaia->JardimInverno) $caracImovel .= 'Jardim de Inverno<br>';
    if ($imovelIngaia->ServicoCozinha) $caracImovel .= 'Serviço de Cozinha<br>';
    if ($imovelIngaia->Sacada) $caracImovel .= 'Sacada<br>';
    if ($imovelIngaia->ArmarioBanheiro) $caracImovel .= 'Armário no Banheiro<br>';
    if ($imovelIngaia->ArmarioAreaServico) $caracImovel .= 'Armário na Área de Serviço<br>';

    if ($imovelIngaia->QtdDormitorios > 0) $caracImovel .= $imovelIngaia->QtdDormitorios . ' Dormitórios<br>';
    if ($imovelIngaia->QtdBanheiros > 0) $caracImovel .= $imovelIngaia->QtdBanheiros . ' Banheiros<br>';
    if ($imovelIngaia->QtdSalas > 0) $caracImovel .= $imovelIngaia->QtdSalas . ' Salas<br>';
    if ($imovelIngaia->QtdVagasCobertas > 0) $caracImovel .= $imovelIngaia->QtdVagasCobertas . ' Vagas Cobertas<br>';
    if ($imovelIngaia->QtdVagas > 0) $caracImovel .= $imovelIngaia->QtdVagas . ' Vagas<br>';
    if ($imovelIngaia->QtdAndar > 0) $caracImovel .= $imovelIngaia->QtdAndar . ' Andares<br>';
    if ($imovelIngaia->QtdSuites > 0) $caracImovel .= $imovelIngaia->QtdSuites . ' Suítes<br>';
    if ($imovelIngaia->QtdVagasDescobertas > 0) $caracImovel .= $imovelIngaia->QtdVagasDescobertas . ' Vagas Descobertas<br>';

    if ($imovelIngaia->Quintal) $caracImovel .= 'Quintal<br>';
    if ($imovelIngaia->Agua) $caracImovel .= 'Água<br>';
    if ($imovelIngaia->ArCondicionado) $caracImovel .= 'Ar Condicionado<br>';
    if ($imovelIngaia->ArmarioCozinha) $caracImovel .= 'Armário na Cozinha<br>';
    if ($imovelIngaia->Churrasqueira) $caracImovel .= 'Churrasqueira<br>';
    if ($imovelIngaia->Escritorio) $caracImovel .= 'Escritório<br>';
    if ($imovelIngaia->Esgoto) $caracImovel .= 'Esgoto<br>';
    if ($imovelIngaia->RuaAsfaltada) $caracImovel .= 'Rua Asfaltada<br>';
    if ($imovelIngaia->EnergiaEletrica) $caracImovel .= 'Energia Elétrica<br>';
    if ($imovelIngaia->PeDireitoDuplo) $caracImovel .= 'Pé Direito Duplo<br>';
    if ($imovelIngaia->ArmarioCloset) $caracImovel .= 'Ármario Closet<br>';
    if ($imovelIngaia->PisoPorcelanato) $caracImovel .= 'Piso Porcelanato<br>';
    if ($imovelIngaia->AreaServico) $caracImovel .= 'Área de Serviço<br>';
    if ($imovelIngaia->PisoCeramica) $caracImovel .= 'Piso Cerâmico<br>';
    if ($imovelIngaia->Varanda) $caracImovel .= 'Varanda<br>';
    if ($imovelIngaia->WCEmpregada) $caracImovel .= 'WC Empregada<br>';
    if ($imovelIngaia->Despensa) $caracImovel .= 'Despensa<br>';
    if ($imovelIngaia->ArmarioSala) $caracImovel .= 'Armário na Sala<br>';
    if ($imovelIngaia->ArmarioEscritorio) $caracImovel .= 'Armário no Escritório<br>';
    if ($imovelIngaia->Hidromassagem) $caracImovel .= 'Hidromassagem<br>';
    if ($imovelIngaia->Mobiliado) $caracImovel .= 'Mobiliado<br>';
    if ($imovelIngaia->AnoConstrucao) $caracImovel .= 'Construído em ' . $imovelIngaia->AnoConstrucao . '<br>';
    if ($imovelIngaia->PortaoEletronico) $caracImovel .= 'Portão Eletrônico<br>';
    if ($imovelIngaia->CondominioFechado) $caracImovel .= 'Condomínio Fechado<br>';
    if ($imovelIngaia->TVCabo) $caracImovel .= 'TV a cabo<br>';
    if ($imovelIngaia->Lavabo) $caracImovel .= 'Lavabo<br>';

    return $caracImovel;
}
