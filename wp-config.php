<?php
/**
 * As configura��es b�sicas do WordPress
 *
 * O script de cria��o wp-config.php usa esse arquivo durante a instala��o.
 * Voc� n�o precisa usar o site, voc� pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo cont�m as seguintes configura��es:
 *
 * * Configura��es do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configura��es do MySQL - Voc� pode pegar estas informa��es com o servi�o de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', getenv('WORDPRESS_DB_NAME') );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', getenv('WORDPRESS_DB_USER') );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', getenv('WORDPRESS_DB_PASSWORD') );

/** Nome do host do MySQL */
define( 'DB_HOST', getenv('WORDPRESS_DB_HOST') );

/** Charset do banco de dados a ser usado na cria��o das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. N�o altere isso se tiver d�vidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */

define( 'AUTH_KEY',         getenv('WORDPRESS_AUTH_KEY') );
define( 'SECURE_AUTH_KEY',  getenv('WORDPRESS_SECURE_AUTH_KEY') );
define( 'LOGGED_IN_KEY',    getenv('WORDPRESS_LOGGED_IN_KEY') );
define( 'NONCE_KEY',        getenv('WORDPRESS_NONCE_KEY') );
define( 'AUTH_SALT',        getenv('WORDPRESS_AUTH_SALT') );
define( 'SECURE_AUTH_SALT', getenv('WORDPRESS_SECURE_AUTH_SALT') );
define( 'LOGGED_IN_SALT',   getenv('WORDPRESS_LOGGED_IN_SALT') );
define( 'NONCE_SALT',       getenv('WORDPRESS_NONCE_SALT') );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Voc� pode ter v�rias instala��es em um �nico banco de dados se voc� der
 * um prefixo �nico para cada um. Somente n�meros, letras e sublinhados!
 */
$table_prefix = getenv('WORDPRESS_TABLE_PREFIX');

/** Configura as vareiaveis para cache */
define('WP_REDIS_HOST', 		getenv('KEYDB_HOST'));
define('WP_REDIS_PORT', 		getenv('KEYDB_PORT'));
define('WP_REDIS_TIMEOUT', 		getenv('KEYDB_TIMEOUT'));
define('WP_REDIS_READ_TIMEOUT', getenv('KEYDB_READ_TIMEOUT'));
define('WP_REDIS_DATABASE', 	getenv('KEYDB_DB'));
define('WP_REDIS_PREFIX', 		getenv('KEYDB_PREFIX'));

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibi��o de avisos
 * durante o desenvolvimento. � altamente recomend�vel que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informa��es sobre outras constantes que podem ser utilizadas
 * para depura��o, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */

define('WP_DEBUG', getenv('WORDPRESS_DEBUG'));
define('WP_DEBUG_DISPLAY', getenv('WORDPRESS_DEBUG_DISPLAY'));

$cron_disabled = getenv('CRON_DISABLED');

if (
    !defined('DISABLE_WP_CRON') &&
    in_array(strtolower($cron_disabled), ['1', 'true', 'yes'], true)
) {
    define('DISABLE_WP_CRON', true);
}

define( 'MEDIA_TRASH', true );

@ini_set( 'upload_max_size' , '12M' );
@ini_set( 'post_max_size', '13M');

/* Isto � tudo, pode parar de editar! :) */

/** Caminho absoluto para o diret�rio WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Adicionado bloco para funcionamento do Proxy reverso Nginx SME  */

$site = getenv('WORDPRESS_SITE');

if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $list = explode(',',$_SERVER['HTTP_X_FORWARDED_FOR']);
    $_SERVER['REMOTE_ADDR'] = $list[0];
}

if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {	
    define( 'WP_HOME', 'https://' . $site );
    define( 'WP_SITEURL', 'https://'. $site );
    $_SERVER['HTTPS']='on';
    $_SERVER['HTTP_HOST'] = $site;
    $_SERVER['SERVER_ADDR'] = $site;
	}
else {
    define('WP_HOME', 'http://' . $site);
    define('WP_SITEURL', 'http://' . $site);
}

/** Configura as vari�veis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
