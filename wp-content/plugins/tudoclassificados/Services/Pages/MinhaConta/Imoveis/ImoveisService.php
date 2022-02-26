<?php

namespace TudoClassificados\Services\Pages\MinhaConta\Imoveis;

use TudoClassificados\Integracoes\Ingaia\Ingaia;

class ImoveisService
{
    public function index()
    {
        if (!empty($_GET['apikey_ingaia'])) {
            session('aba_minha_conta', 'imoveis-integrar-ingaia');

            $ingaia = new Ingaia();
            $imoveis = $ingaia->getImoveis();

            if (empty($_POST['check_cod_ingaia'])) return $imoveis;

            $this->cadastrar($ingaia, $imoveis);
        }
    }

    private function cadastrar(Ingaia $ingaia, $imoveis): void
    {
        $ingaia->cadastrar($imoveis);

        session('aba_minha_conta', 'imoveis');
        wp_redirect('/minha-conta');
        exit();
    }
}