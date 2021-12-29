<?php 
    require 'src/Requisicao.php';
    require 'src/Produtos.php';
    
    $api_key_bling = trim($_POST['api-key-bling']);
    $api_key_bling = str_replace(' ','',$api_key_bling);
    $num_page = $_GET['page_bling'];
    if(!$num_page) $num_page = 1;
    if (!$api_key_bling) $api_key_bling = '0';
    
    //$api_key_bling = '20e4109dc2eafabe7604443cf45d56b356d308c06c3b20af83a78eb4d6f80693be969184';
    
    $class_bling = new Requisicao($user_id, $api_key_bling);
    $produtos_bling = $class_bling->getBling($num_page);
    
    $class_produtos = new Produtos($user_id, $api_key_bling);
    if ($_POST['check-bling']) $class_produtos->salvarProdutos($_POST['check-bling']);   
    include 'seleciona_produtos.php';
?>










