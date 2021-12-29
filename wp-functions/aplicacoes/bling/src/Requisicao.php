<?php /*
class Requisicao
{   
    private $user_id;

    public function __construct(string $user_id, string $api_key_bling)
    {
        global $wpdb;
        
        $this->user_id = $user_id;
        
        $table = $wpdb->prefix . 'awpcp_inte_apikey';
        $this->table_apikey = $table;
        $this->api_key_bling = $api_key_bling;
        
        if(empty($api_key_bling)){
            $info_table = $wpdb->get_results("SELECT * FROM $table WHERE user_id = $user_id AND origem = 'bling'");
            $info_table = $info_table[0]->api_key;
            $this->api_key_bling = $info_table;
        }
    }
    
    public function getApiKey()
    {
        return $this->api_key_bling;
    }
    
    public function getBling(string $num_page)
    {
        global $wpdb;
        $user_id = $this->user_id;
        $api_key_bling = $this->api_key_bling;
        $table = $wpdb->prefix . 'awpcp_inte_apikey';
        
        
        
        function executeGetProducts(string $apikey, string $num_page)
        {
            // $url = 'https://bling.com.br/Api/v2/produtos/page='.$num_page.'/json';
            // $curl_handle = curl_init();
            // curl_setopt($curl_handle, CURLOPT_URL, $url . '&apikey=' . $apikey);
            // curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
            // $response = curl_exec($curl_handle);
            // curl_close($curl_handle);
            // $response = json_decode($response);
            // return $response;
        }
        
        //$api_key_bling = $this->api_key_bling;
        
        // if ( ! empty($api_key_bling)){
        //     $resposta = executeGetProducts($api_key_bling, $num_page);
        // } 
        
        
        // if ($resposta->retorno->erros){
        //     if($resposta->retorno->erros->erro){
        //         $erro = $resposta->retorno->erros->erro;
        //         $erro = ['cod' => $erro->cod, 'msg' => $erro->msg];
        //     } else {
        //         $erro = $resposta->retorno->erros[0]->erro;
        //         $erro = ['cod' => $erro->cod, 'msg' => $erro->msg];
        //     }
            
        // }
    
        // $resposta = $resposta->retorno->produtos;
        // $resposta = ['produtos' => $resposta, 'erro' => $erro ];
        
        // return $resposta;
    }
}
?>*/




