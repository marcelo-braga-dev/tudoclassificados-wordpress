<?php

namespace TudoClassificados\Anuncios\Imagens;

class RepositorioExterno
{
    public function download(string $url, string $titulo,string $origem): string
    {
        $ano = date('Y');
        $mes = date('m');
        $dia = date('d');

        $path = TUDOCLASSIFICADOS_PATH . "../uploads/$origem/$ano/$mes/$dia/";

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $nomeArquivo = $titulo . '_tudo_classificados_' . uniqid();

        $dir = $path . $nomeArquivo;

        $content = file_get_contents($url);
        file_put_contents($dir, $content);

        return "/wp-content/plugins/uploads/$origem/$ano/$mes/$dia/$nomeArquivo";
    }
}