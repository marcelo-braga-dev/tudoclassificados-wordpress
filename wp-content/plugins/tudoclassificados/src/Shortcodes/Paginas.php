<?php

namespace TudoClassificados\Shortcodes;

class Paginas
{
    public function __construct()
    {
        add_shortcode("tc_paginas", array($this, "run_shortcode_paginas"));
    }

    public function run_shortcode_paginas($atts)
    {
        if ($atts['pagina'] == 'minha-conta') {
            require_once TUDOCLASSIFICADOS_PATH . 'pages/minha-conta/minha-conta.php';
        }
    }
}