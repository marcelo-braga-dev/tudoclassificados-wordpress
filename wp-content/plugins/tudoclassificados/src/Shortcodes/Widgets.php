<?php

namespace TudoClassificados\Shortcodes;

use TudoClassificados\App\Views\Widgets\Categorias;

class Widgets
{
    public function __construct()
    {
        add_shortcode("tc_widgets", array($this, "run_shortcode_widgets"));
    }

    public function run_shortcode_widgets($atts)
    {
        if ($atts['chave'] == 'categorias') {
            $categorias = new Categorias();
            return $categorias->execute();
        }
    }
}