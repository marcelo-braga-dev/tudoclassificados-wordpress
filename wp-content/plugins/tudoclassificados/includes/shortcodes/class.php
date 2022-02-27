<?php
require_once 'classificados/include.php';

require_once TUDOCLASSIFICADOS_PATH . 'includes/classes/Anuncios/Templates/ListaImoveis.php';
require_once TUDOCLASSIFICADOS_PATH . 'includes/classes/Anuncios/Templates/Cards.php';
require_once TUDOCLASSIFICADOS_PATH . 'includes/classes/Anuncios/Templates/Marketplace/ListaAnunciosMarketplace.php';

new ListaImoveis();
new Cards();
new ListaAnunciosMarketplace();






