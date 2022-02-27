<?php

use TudoClassificados\Services\Anuncios\ListaDeAnuncios;

class Cards
{
    public function __construct()
    {
        add_shortcode("acadp_listings", array($this, "run_shortcode_listings"));
    }

    /**
     * Run the shortcode [acadp_listings].
     *
     * @param array $atts An associative array of attributes.
     * @since 1.0.0
     */
    public function run_shortcode_listings($atts)
    {
        $service = new ListaDeAnuncios();
        return $service->execute($atts);
    }
}