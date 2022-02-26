<?php

namespace TudoClassificados\Integracoes\Ingaia;

use TudoClassificados\Anuncios\Imagens\BaixarImagens;
use TudoClassificados\Anuncios\Imagens\CadastrarImagem;
use TudoClassificados\Anuncios\Imoveis\CadastrarAnuncioImoveis;
use TudoClassificados\Anuncios\Imoveis\DadosImovel;

class CadastrarImoveisIngaia
{
    public function execute($imoveis)
    {
        $idSelecionados = $_POST['check_cod_ingaia'];

        foreach ($imoveis as $imovelIngaia) {

            if (in_array($imovelIngaia->CodigoImovel, $idSelecionados)) {

                $dados = new DadosImovel();
                $dados->dataExpiracao = date('Y-m-d H:i:s', strtotime('+60 days'));
                $dados->imagens = $this->preencheImg($imovelIngaia->Fotos->Foto);
                $dados->caracteristicas = $this->preencheCaracteristicas($imovelIngaia);
                $dados->infos = $imovelIngaia;

                $anuncio = new CadastrarAnuncioImoveis();
                $anuncio->store($dados);
            }
        }
    }

    function preencheImg($imagens)
    {
        $count_img = 0;
        $arrayImg = [];

        foreach ($imagens as $argImg) {
            if ($count_img < 8) {
                $count_img++;
                $url = wp_strip_all_tags($argImg->URLArquivo);
                $titulo = $argImg->NomeArquivo;

                $imagens = new BaixarImagens();
                $urlImg = $imagens->download($url, $titulo, 'ingaia');

                $imagem = new CadastrarImagem();
                $arrayImg[] = $imagem->cadastrar($titulo, $urlImg);
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
}