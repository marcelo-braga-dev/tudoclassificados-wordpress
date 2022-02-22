<?php
class ProdutosAnuncio
{
      private $tablePost = 'class_posts';

      private function conectarDB(string $table)
      {
            $mysql = new mysqli('localhost', DB_USER, DB_PASSWORD, DB_NAME);
            $mysql->set_charset('utf8'); //utf8mb4

            if ($mysql == FALSE) {
                  echo "Erro na conexão";
                  exit();
            }

            if ($table == $this->tablePost) {
                  $this->mysqlPost = $mysql;
                  return;
            }
      }

      public function produtosRelacionados()
      {
            $args = array(
                  'post_type' => 'acadp_listings',
                  'post_status' => 'publish',
                  'nopaging' => true,
            );

            $query = new WP_Query($args);

            return $query;
      }

      public function preencherTabela()
      {
            $table = 'class_posts';
            $this->conectarDB($table);

            $resultado = $this->mysqlPost->query("
                  SELECT `id`,`post_title` FROM `$table` WHERE `post_type` = 'acadp_fields'");

            $resposta = $resultado->fetch_all(MYSQLI_ASSOC);

            return $resposta;
      }
}
