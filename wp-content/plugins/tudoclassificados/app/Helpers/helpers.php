<?php
function view(string $dir, array $vars = [])
{
    $a = '';

    foreach ($vars as $index=>$var) {
        $a = $index;
        $$a = $var;
    }

    return require_once TUDOCLASSIFICADOS_PATH_VIEW . $dir;
}