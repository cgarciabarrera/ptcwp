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
define('DB_NAME', 'pruebatucochewp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'Carlos01');

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
define('AUTH_KEY',         '@1.)[8)onjPKa*G|S <qY.oW7;$Cmy+a5)1ZotzH%aCW98rb+RU(Pnx^0#|v](q ');
define('SECURE_AUTH_KEY',  '|d6K 4ZW3q:qLqiA5#6Fx5,T)ibGN)8t+82piNmr_JC)%RyhdGK1>hu-T=|<Zpzk');
define('LOGGED_IN_KEY',    '+P#K7^%(d`$uX D*ug[JPhDxA S@qo>/Pcl-=&B^hyhfJGoq_EEG<!MC6Yq|a`mT');
define('NONCE_KEY',        'H_^QBJLW]4HgM+*Ardk+f-_L5T_+eLoh0))hSiMsC}H4E!lXUL;G2:#4iZSHec{R');
define('AUTH_SALT',        'S[x,-+Ft m,ha?K~[>VDm<3cK!Lm~L9*D$k]@^(2^WsY;(2Tq1Ux[i62& dtk>|I');
define('SECURE_AUTH_SALT', 'qZ7&B$+4+*9XC+0]<b=6#{N*PC+:eeb!GNz/E/CoF_~m&o=4U@xo_Kh[T1Jrvfg.');
define('LOGGED_IN_SALT',   'Y*M|m<2ML.7&k?gj^k!RQU2,A1p1(cJq_#= (_Z6 3:Y84m,03X56;hi=uJN!Mh#');
define('NONCE_SALT',       ']45PG6Ah|+Y_2]a3|h&S!;P6^nwbc]aI_7rk8]b1A4g|fdb8Ryie%i?u}j8XebRv');

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

