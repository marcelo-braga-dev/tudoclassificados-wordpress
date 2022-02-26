<?php

namespace TudoClassificados\Integracoes\Ingaia;

class Ingaia
{
    public function getImoveis()
    {
        $xml_integrar_ingaia = simplexml_load_file($_GET['apikey_ingaia']);

        return $xml_integrar_ingaia->Imoveis->Imovel;
    }

    public function cadastrar($imoveis)
    {
        $ingaia = new CadastrarImoveisIngaia();
        $ingaia->execute($imoveis);
    }
}