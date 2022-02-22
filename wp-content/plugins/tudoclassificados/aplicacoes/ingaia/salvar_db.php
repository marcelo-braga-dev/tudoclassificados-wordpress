<?php

//CODIGO DO IMOVEIS
$cod_imoveis = $_POST['check_cod_ingaia'];
$xml_integrar = $_POST['xml_ingaia'];

//PUXA XML SALVAR
$xml_integrar_ingaia = simplexml_load_file($_POST['apikey_ingaia']);


$imoveisIngaia = $xml_integrar_ingaia->Imoveis->Imovel;
foreach ($imoveisIngaia as $imovelIngaia) {

    foreach ($cod_imoveis as $cod_imovel){
        if ($cod_imovel == $imovelIngaia->CodigoImovel){
            
            
            if($imovelIngaia->JardimInverno) $caracImovel .= 'Jardim de Inverno<br>';
            if($imovelIngaia->ServicoCozinha) $caracImovel .= 'Serviço de Cozinha<br>';
            if($imovelIngaia->Sacada) $caracImovel .= 'Sacada<br>';
            if($imovelIngaia->ArmarioBanheiro) $caracImovel .= 'Armário no Banheiro<br>';
            if($imovelIngaia->ArmarioAreaServico) $caracImovel .= 'Armário na Área de Serviço<br>';
            
            if($imovelIngaia->QtdDormitorios) $caracImovel .= $imovelIngaia->QtdDormitorios.' Dormitórios<br>';
            if($imovelIngaia->QtdBanheiros) $caracImovel .= $imovelIngaia->QtdBanheiros.' Banheiros<br>';
            if($imovelIngaia->QtdSalas) $caracImovel .= $imovelIngaia->QtdSalas.' Salas<br>';
            if($imovelIngaia->QtdVagasCobertas) $caracImovel .= $imovelIngaia->QtdVagasCobertas.' Vagas Cobertas<br>';
            if($imovelIngaia->QtdVagas) $caracImovel .= $imovelIngaia->QtdVagas.' Vagas<br>';
            if($imovelIngaia->QtdAndar) $caracImovel .= $imovelIngaia->QtdAndar.' Andares<br>';
            if($imovelIngaia->QtdSuites) $caracImovel .= $imovelIngaia->QtdSuites.' Suítes<br>';
            if($imovelIngaia->QtdVagasDescobertas) $caracImovel .= $imovelIngaia->QtdVagasDescobertas.' Vagas Descobertas<br>';

            if($imovelIngaia->Quintal) $caracImovel .= 'Quintal<br>';
            if($imovelIngaia->Agua) $caracImovel .= 'Água<br>';
            if($imovelIngaia->ArCondicionado) $caracImovel .= 'Ar Condicionado<br>';
            if($imovelIngaia->ArmarioCozinha) $caracImovel .= 'Armário na Cozinha<br>';
            if($imovelIngaia->Churrasqueira) $caracImovel .= 'Churrasqueira<br>';
            if($imovelIngaia->Escritorio) $caracImovel .= 'Escritório<br>';
            if($imovelIngaia->Esgoto) $caracImovel .= 'Esgoto<br>';
            if($imovelIngaia->RuaAsfaltada) $caracImovel .= 'Rua Asfaltada<br>';
            if($imovelIngaia->EnergiaEletrica) $caracImovel .= 'Energia Elétrica<br>';
            if($imovelIngaia->PeDireitoDuplo) $caracImovel .= 'Pé Direito Duplo<br>';
            if($imovelIngaia->ArmarioCloset) $caracImovel .= 'Ármario Closet<br>';
            if($imovelIngaia->PisoPorcelanato) $caracImovel .= 'Piso Porcelanato<br>';
            if($imovelIngaia->AreaServico) $caracImovel .= 'Área de Serviço<br>';
            if($imovelIngaia->PisoCeramica) $caracImovel .= 'Piso Cerâmico<br>';
            if($imovelIngaia->Varanda) $caracImovel .= 'Varanda<br>';
            if($imovelIngaia->WCEmpregada) $caracImovel .= 'WC Empregada<br>';
            if($imovelIngaia->Despensa) $caracImovel .= 'Despensa<br>';
            if($imovelIngaia->ArmarioSala) $caracImovel .= 'Armário na Sala<br>';
            if($imovelIngaia->ArmarioEscritorio) $caracImovel .= 'Armário no Escritório<br>';
            if($imovelIngaia->Hidromassagem) $caracImovel .= 'Hidromassagem<br>';
            if($imovelIngaia->Mobiliado) $caracImovel .= 'Mobiliado<br>';
            if($imovelIngaia->AnoConstrucao) $caracImovel .= 'Construído em '.$imovelIngaia->AnoConstrucao.'<br>';
            if($imovelIngaia->PortaoEletronico) $caracImovel .= 'Portão Eletrônico<br>';
            if($imovelIngaia->CondominioFechado) $caracImovel .= 'Condomínio Fechado<br>';
            //if($imovelIngaia->) $caracImovel .= '<br>';
            
            echo 'Título do Imóvel: '.$imovelIngaia->TituloImovel.'<br>';
            echo 'Tipo de Imóvel: '.$imovelIngaia->TipoImovel.'<br>';
            echo 'Observacao: '.$imovelIngaia->Observacao.'<br>';
            
            echo 'Cidade: '.$imovelIngaia->Cidade.'<br>';
            echo 'Estado: '.$imovelIngaia->Estado.'<br>';
            // echo ': '.$imovelIngaia->.'<br>';
            // echo ': '.$imovelIngaia->.'<br>';
            // echo ': '.$imovelIngaia->.'<br>';

            echo $caracImovel.'<hr>';
            $caracImovel = '';
            // echo '<pre>';
            // print_r($imovelIngaia);
            // echo '</pre>';
        }
    }
}
     
    //$xml_integrar_ingaia = $xml_integrar_ingaia->Imoveis->Imovel;   
    /*
    foreach($xml_integrar_ingaia as $info_imovel){
        foreach($cod_imoveis as $cod){
            $cod_imovel = $info_imovel->CodigoImovel;
            if($cod == $cod_imovel){
                $carac_imovel = '';
                $post_id_img = '';
                $post_id_img = array();
                
                if($info_imovel->PortaoEletronico[0]) $carac_imovel .= "Portão Eletrônico"."\n";
                if($info_imovel->ServicoCozinha[0]) $carac_imovel .= "Serviço de Cozinha"."\n";
                if($info_imovel->Sacada[0]) $carac_imovel .= "Sacada"."\n";
                if($info_imovel->Lavabo[0]) $carac_imovel .= "Lavabo"."\n";
                if($info_imovel->ArmarioBanheiro[0]) $carac_imovel .= "Armário no banheiro"."\n";
                if($info_imovel->ArmarioAreaServico[0]) $carac_imovel .= "Armário área de serviço"."\n";
                if($info_imovel->ArmarioCozinha[0]) $carac_imovel .= "Armário na cozinha"."\n";
                if($info_imovel->Churrasqueira[0]) $carac_imovel .= "Churrasqueira"."\n";
                if($info_imovel->Sauna[0]) $carac_imovel .= "Sauna"."\n";
                if($info_imovel->TVCabo[0]) $carac_imovel .= "TV a cabo"."\n";
                if($info_imovel->Interfone[0]) $carac_imovel .= "Interfone"."\n";
                
                $anuncio_imovel = array(                    
                    'post_title' => wp_strip_all_tags($info_imovel->TituloImovel),
                    'post_content' => wp_strip_all_tags($info_imovel->Observacao),
                    'comment_status' => 'closed',
                    'post_status' => 'publish',
                    'ping_status' => 'closed',
                    'post_type' => 'acadp_listings',
                    'post_author' => get_current_user_id(),
                    'meta_input' => array(
                                '_thumbnail_id' => '513',
                                'codigo_imovel' => wp_strip_all_tags($cod_imovel),
                                'video' => '',
                                'address' => wp_strip_all_tags($info_imovel->Endereco),
                                'bairro' => wp_strip_all_tags($info_imovel->Bairro),
                                'cidade' => wp_strip_all_tags($info_imovel->Cidade),
                                'estado' => wp_strip_all_tags($info_imovel->Estado),
                                'pais' => wp_strip_all_tags($info_imovel->Pais),
                                'zipcode' => wp_strip_all_tags(''),
                                'phone' => wp_strip_all_tags($info_imovel->corretor->celular),
                                'email' => wp_strip_all_tags($info_imovel->corretor->email),
                                'website' => wp_strip_all_tags($info_imovel->URLGaiaSite),
                                'latitude' => wp_strip_all_tags($info_imovel->latitude),
                                'longitude' => wp_strip_all_tags($info_imovel->longitude),
                                'hide_map' => wp_strip_all_tags(''),
                                'price' => wp_strip_all_tags($info_imovel->PrecoVenda),
                                'featured' => '',
                                'views' => '',
                                'listing_status' => 'post_status',
                                'expiry_date' => '2021-06-02 17:07:16',
                                '505' => $carac_imovel,
                                '506' => wp_strip_all_tags($info_imovel->QtdDormitorios),//c1
                                '508' => wp_strip_all_tags($info_imovel->QtdBanheiros),
                                '509' => wp_strip_all_tags($info_imovel->QtdVagas),
                                '512' => wp_strip_all_tags($info_imovel->QtdSuites),
                                '510' => wp_strip_all_tags($info_imovel->AreaUtil),//c5
                                '511' => wp_strip_all_tags($info_imovel->AreaTotal),
                                
                            ),
                );
                    /*
                    [TipoImovel] => Apartamento
                    [CondominioFechado] => 1
                    [QtdSalas] => 2
                    [QtdVagasCobertas] => 2
                    [] => 20*/
                //$post_id = wp_insert_post($anuncio_imovel);
                /*
                foreach($info_imovel->Fotos->Foto as $img_ingaia){
                    $post_meta_img = array (
                        'post_author' => get_current_user_id(),
                        //'post_title' => uniqid(date()),
                        'post_status' => 'inherit',
                        'comment_status' => 'closed',
                        'ping_status' => 'closed',
                        //'post_name' => uniqid(date()),
                        'guid' => $img_ingaia->URLArquivo[0],
                        'post_type' => 'attachment',
                        'post_mime_type' => 'image/jpeg',
                        'meta_input'   => array(
                            '_wp_attached_file' => wp_strip_all_tags(';;;'.$img_ingaia->URLArquivo[0])
                            ),
                    );
                    //$post_id_img[] = wp_insert_post($post_meta_img);
                    
                    // if($img_ingaia->Principal[0]){
                    //     add_post_meta( $post_id, 'images', $post_id_img);
                    // }
                }
            }
            //add_post_meta( $post_id, 'images', $post_id_img);
        }
    }*/
