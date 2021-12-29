<?php
add_action('admin_menu', 'bs4v_wp_menu');

function bs4v_wp_menu(){
	
	add_menu_page('Bootstrap 4 - Visual', 'Editor de Visual', 'manage_options', 'bootstrap-4-visual','bs4v_menu_main'/*,plugins_url('/imagens/icone_menu.png',DIR_MAIN_PLUGIN_OS)*/);

	add_submenu_page('bootstrap-4-visual', 'Imagens', 'Carrocel', 'manage_options', 'bootstrap-4-visual','bs4v_menu_main');
	add_submenu_page('bootstrap-4-visual', 'Sub_menu_2_page', 'Clientes', 'manage_options', 'slug_page_2' ,'bs4v_sub_menu_2');	
	add_submenu_page('bootstrap-4-visual', 'Sub_menu_3_page', 'Kits Fotovoltaicos', 'manage_options', 'slug_page_3' ,'bs4v_sub_menu_3');
	add_submenu_page('bootstrap-4-visual', 'Sub_menu_4_page', 'Configurações', 'manage_options', 'slug_page_4' ,'bs4v_sub_menu_4');
   
    // Title of the page
    // Text to show on the menu link
    // Capability requirement to see the link
    // The 'slug' - file to display when clicking the link
    //Funcao a ser chamada
}
function bs4v_menu_main()
{
    include DIR_MAIN_PLUGIN_VISUAL . 'paginas/carrocel.php';
}
function bs4v_sub_menu_2()
{
	$abaAtivaMenuCli ='active';
	include(dirname(DIR_MAIN_PLUGIN_OS).'/paginas/tabela_leads.php');
}
function bs4v_sub_menu_3()
{
	$abaAtivaMenuKit ='active';
	include(dirname(DIR_MAIN_PLUGIN_OS).'/paginas/kits.php');
}
function bs4v_sub_menu_4()
{       
    $abaAtivaMenuConf ='active';
    include(dirname(DIR_MAIN_PLUGIN_OS).'/paginas/config.php');
}
?>