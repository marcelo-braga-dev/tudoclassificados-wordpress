<?php
/*
Plugin Name: Tudo Classificados
Plugin URI: #
Description: Plugin de classificados.
Version: 1.0
Author: Marcelo Braga
Author URI: #
Text Domain: Marcelo Braga
License: GPLv2 or later
*/

session_start();

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('TUDOCLASSIFICADOS__FILE__', __FILE__);
define('TUDOCLASSIFICADOS_PLUGIN_BASE', plugin_basename(TUDOCLASSIFICADOS__FILE__));
define('TUDOCLASSIFICADOS_PATH', plugin_dir_path(TUDOCLASSIFICADOS__FILE__));

define('TUDOCLASSIFICADOS_URL_PLUGIN', plugin_dir_url( __FILE__ ));
define('TUDOCLASSIFICADOS_URL_ASSETS', plugin_dir_url( __FILE__ ) . 'assets/');

require_once 'vendor/autoload.php';
require_once 'Helpers/geral.php';
require_once 'Helpers/anuncios-premium.php';

require_once 'includes/shortcodes/class.php';


require_once 'assets/footer.php';
require_once 'assets/header.php';