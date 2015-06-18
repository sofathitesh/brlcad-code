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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'brlcad');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'sofat');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Zvq@=8mp,zbHE+n;-gs<ZCJ@<Z{AWdW(%<<&JUr>&}C< CuYRkEgE`FFff_C6-Tp');
define('SECURE_AUTH_KEY',  'h|.v~([{xo(v1|{=S`XY@.e`~Et*,38-?=JId|Yx3h4_RU`M2gZstceM!EtN!2).');
define('LOGGED_IN_KEY',    'qh^*qpjh~I5fK~CkKY3e)iyeI2a,Ita/.lz:@leSYwHwm=/Z|G-npEXEf4:og7F]');
define('NONCE_KEY',        '^k1yjZ?Zs&~p Ys9Rm0}NRojVL4}ccY?m|@TB$H f74>PoKLX6ckr^&Ablh5[=w+');
define('AUTH_SALT',        '+6jNNAL:d=t<7@}(-Q|4!G$Nxiz }=-E_*= k^K-rH!fT#?YK4?$t8u+tN:xf*i8');
define('SECURE_AUTH_SALT', 'LyBVwgHVY<j;_ 48n1F%a7[ +Q`>gBi#pD2FiO+>3x6%M=+}o1YTD3pkCu}|yi9 ');
define('LOGGED_IN_SALT',   '2xuYAmH`K=h[4t6;s?vuzM&ooI9+yL&0+b2}peuk:j=ddzt(4ifNUb`/5*iKvSjC');
define('NONCE_SALT',       '?&cF8t&:i[HWsa=XLX4-6T$<Dx#]S{T4*`oR]!7>4gQgPYYw^1@m?]3OX-7cM1Qv');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

