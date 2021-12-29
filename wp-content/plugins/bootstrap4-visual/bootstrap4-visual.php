<?php
/*
Plugin Name: 2. Visual Editor
Plugin URI: #
Description: Plugin para adição de ferramentas e visual do Bootstrap 4.
Version: 1.0
Author: Marcelo Braga
Author URI: #
Text Domain: Marcelo Braga
License: GPLv2 or later
*/


define('DIR_MAIN_PLUGIN_VISUAL', __DIR__ . '/');
require_once ABSPATH . 'vendor/autoload.php';

// Funcoes Gerais
require_once ABSPATH.'wp-functions/functions.php';

// Funcoes
require_once ABSPATH.'wp-functions/src/functions.php';


include 'include/menu_admin.php';
?>