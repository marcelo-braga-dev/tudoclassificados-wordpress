<?php
require_once TUDOCLASSIFICADOS_PATH . 'includes/classes/Anuncios/Templates/ListaImoveis.php';
new ListaImoveis();

require_once TUDOCLASSIFICADOS_PATH . 'includes/classes/Anuncios/Templates/Cards.php';
new Cards();

require_once TUDOCLASSIFICADOS_PATH . 'includes/classes/Anuncios/Templates/Marketplace/ListaAnunciosMarketplace.php';
new ListaAnunciosMarketplace();

require_once TUDOCLASSIFICADOS_PATH . 'includes/classes/Anuncios/Templates/Classificados/ListaAnunciosClassificados.php';
new ListaAnunciosClassificados();
