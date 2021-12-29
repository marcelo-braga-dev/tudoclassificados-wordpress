<?php
        /*$credentials = "username:password";
        
        $url = "https://api.mercadolivre.com.br/items/MLB1701323268/shipping_options";
       
        $headers = 
            'Authorization: Bearer APP_USR-6272490303126334-040516-1da97f0319ca425795dea0794d7ea495-443790977'        ;
      
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        //curl_setopt($ch, CURLOPT_USERAGENT, $defined_vars['HTTP_USER_AGENT']);
       

        $data = curl_exec($ch);

        if (curl_errno($ch)) {
            print "Error: " . curl_error($ch);
        } else {
            // Show me the result
            var_dump($data);
            curl_close($ch);
        }
    
    /*$ch = curl_init();

    // set URL and other appropriate options
    curl_setopt($ch, CURLOPT_URL, 'https://api.mercadolibre.com/sites/MLB/categories');
    curl_setopt($ch, AUTHORIZATION, 'APP_USR-6272490303126334-040516-1da97f0319ca425795dea0794d7ea495-443790977');
    
    
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($ch);
    curl_close($ch);
    
    $resposta = json_decode($response);
    echo '<pre>';
    print_r($resposta);
    echo '</pre>';
    */
    
    //$url = "https://api.mercadolibre.com/orders/4451522205/billing_info";
    //$url = "https://api.mercadolibre.com/orders/search?seller=443790977";
    $url = "https://api.mercadolibre.com/shipments/40445515255";
    
    function executeGetProducts($url){
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('Authorization: Bearer APP_USR-6272490303126334-040516-1da97f0319ca425795dea0794d7ea495-443790977'));
        $response = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $response;
    }
    $resposta = executeGetProducts($url);
    
    $resposta = json_decode($resposta);
    echo '<pre>';
    print_r($resposta);
    echo '</pre>';
?>














