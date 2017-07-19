<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */
 
// Include local configuration
if (file_exists(dirname(__FILE__) . '/local-config.php')) {
	include(dirname(__FILE__) . '/local-config.php');
}

// Global DB config
if (!defined('DB_NAME')) {
	define('DB_NAME', 'expediahotels.dev');
}
if (!defined('DB_USER')) {
	define('DB_USER', 'root');
}
if (!defined('DB_PASSWORD')) {
	define('DB_PASSWORD', 'root');
}
if (!defined('DB_HOST')) {
	define('DB_HOST', 'localhost');
}

/** Database Charset to use in creating database tables. */
if (!defined('DB_CHARSET')) {
	define('DB_CHARSET', 'utf8');
}

/** The Database Collate type. Don't change this if in doubt. */
if (!defined('DB_COLLATE')) {
	define('DB_COLLATE', '');
}

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '6BhNq!SAL%#$Ze;wMi}08?>CwC#6^7fS$yY<5~H9{+8K{hzOCS6hL%)FW*P]D91p');
define('SECURE_AUTH_KEY',  'NLWTOPp::RiF9M5_4VdS]X@rvzN+fBB,j+w%&EW9>88@ckn|3FKUX3kEufk[24)J');
define('LOGGED_IN_KEY',    'BE+ggAC6As08_9,kdBb`Oe_)j*nwt]e,S7;^KRU}r,F~1MV-u6z[QX7D{J5w|h.S');
define('NONCE_KEY',        'yIcA@=/WY9p3)F-SF1#]].WU=,soT_/1Tx-gGF+,tq~z3->ik/^Bh[]48Y7Y*p!d');
define('AUTH_SALT',        'RJs5bqdPz)a,>qWAo^&!akr^C|h+7j)NcOdJ$95a+,Jb`dtrRg{Y/9<)M!4jAeso');
define('SECURE_AUTH_SALT', '-T!v;|?@:+n+Gtj(+LZO?$%TmexB!+>.G/0IhiM+8.ryP(As-C&@^lYVE!+?G>I1');
define('LOGGED_IN_SALT',   'x+9%UWr%pStlF-QZE`[oBl7</_js~hG{y(]|;iR=?~>18T:y70;,nd-<^H(,{|A,');
define('NONCE_SALT',       'BuYyU}x-Rmn{|Z0lFBD&&ds0-Ey9f /p4kaN<(Eo8fU>63r2#x6[t&dn2J |g(3?');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
if (!defined('WP_DEBUG')) {
	define('WP_DEBUG', false);
}

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
