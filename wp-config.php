<?php
//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL
// define ('WP_MEMORY_LIMIT', '256M');
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */
// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/home/tudocl45/public_html/wp-content/plugins/wp-super-cache/' );
define( 'DB_NAME', 'tudocl45_tudoclassi1' );
/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'tudocl45_tudoclassceo' );
/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '^4)wW{]wQyjS' );
/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );
/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );
/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );
/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '}MbqM6X-`o$Fzfxw`)C{mFlT1hdn#3RNQheV||&`v*}i1Q;O#vI9A=CH%Y*2;TCm' );
define( 'SECURE_AUTH_KEY',  'F&mc^X0xt!?|o61Ua~fmD1lOi]NnRSffB7N<gV$L)PD@~=ks~Ug<Y7V-F4U/|~ #' );
define( 'LOGGED_IN_KEY',    'ZY`34|#c8{x;OYDEriW.0>2T3/{Epnt$NhVMs4*#{QlvMh.TA3%Q%.&0X^hdvh.X' );
define( 'NONCE_KEY',        '&WPgl_u%cU2QKer1]f*t}1^OR=vxn vjte=9P|r.h}KH#U]ZS:)]aU#r7~;6g+PP' );
define( 'AUTH_SALT',        '@d~T,;7NX>~uT:Ix`E^xD6Yc1hUh]|`YFMcw:RcFk+;55wrc4H?j0_wc^^tJ9Ks/' );
define( 'SECURE_AUTH_SALT', 'R{u:c{ex]/[-&Na:l#RyFIHNF0]dbE63]6t`gDK~};yE+?{[V6<9t6QG#hpEMYQ^' );
define( 'LOGGED_IN_SALT',   '9_5=-xT>f{E:@%~gixvIBNU48v~5=&d,KWmxEQBT}d!XA#Wu(Ahu`~B_/;EUhJ?D' );
define( 'NONCE_SALT',       'h@|9OBtj0e{c(z.NHX.tAR2~2w= OQM)2Td2Ur#QAx_M3}`ntYK801K^H3IiM1(2' );
/**#@-*/
/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'class_';
/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
define('WPLANG', 'pt_BR'); 


//define( 'WP_CONTENT_URL', 'https://img.tudoclassificados.com/wordpress' );
//define( 'WP_CONTENT_DIR', '/home/tudocl45/img.tudoclassificados.com/wordpress' );

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
if ( ! defined( 'ABSASSETS' ) ) {
	define( 'ABSASSETS', __DIR__ . '/wp-functions/assets/' );
}
/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
//Disable File Edits
define('DISALLOW_FILE_EDIT', true);