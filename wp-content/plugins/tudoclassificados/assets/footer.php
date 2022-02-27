<?php
function tc_script_main()
{
    wp_enqueue_script('tc-script-1', TUDOCLASSIFICADOS_URL_ASSETS . 'bootstrap/js/bootstrap.min.js', [], false, true);
    wp_enqueue_script('tc-script-2', TUDOCLASSIFICADOS_URL_ASSETS . 'bootstrap/js/popper.min.js', [], false, true);
    wp_enqueue_script('tc-script-3', TUDOCLASSIFICADOS_URL_ASSETS . 'js/mask.js', [], false, true);
    wp_enqueue_script('tc-script-4', TUDOCLASSIFICADOS_URL_ASSETS . 'select2/js/select2.min.js', [], false, true);
    wp_enqueue_script('tc-script-5', TUDOCLASSIFICADOS_URL_ASSETS . 'spinners/slick.min.js', [], false, true);
    wp_enqueue_script('tc-script-6', TUDOCLASSIFICADOS_URL_ASSETS . 'spinners/spinner.js', [], false, true);
    wp_enqueue_script('tc-script-7', TUDOCLASSIFICADOS_URL_ASSETS . 'js/configs.js', [], false, true);
}

add_action('wp_enqueue_scripts', 'tc_script_main');
?>