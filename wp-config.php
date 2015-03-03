<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'gfMqGneRoj');

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
define('AUTH_KEY',         '2+t0+}^#fRiPV@b]EKBc+.B#~tTeJjz*q~cZX!>3!/Frrp#1p|E/LPl+TB( Bg2V');
define('SECURE_AUTH_KEY',  'gQ6{U`3 fyYPHL:T$R36Y&[GcjHK fQg@OaV 1Gg_X13eIRzUq=0Fw~^YjR}j/dl');
define('LOGGED_IN_KEY',    '32:ga+uWs-xQ+&t_i#v<%Dc+ux9Yp{=VCNw-9ZKr( Z3U+udn-2n$c23QC3Pmqe^');
define('NONCE_KEY',        'gNX8{niR@?9la2aQ/IeA6$:lDOqd_j0E;&d*Y*|9#0L8n+AHb8!a+gL./^m[5[l+');
define('AUTH_SALT',        'gZyLxISP!2n9A)_r|4w4za4F}<C=&T.~qq+$$F4YttK8o;}YB~<gik:$<em+<+{<');
define('SECURE_AUTH_SALT', 'Ev CXk,z;ah9%@e)ehmTl~X&|@9g7]!pqQPwhM)+uo_8[P!dlaMs#|B:fMKmw2/#');
define('LOGGED_IN_SALT',   '>ccg3C-vj8W]oz~wpUI7tFlkX|KF(J6BAX+.D%fy(16OD`PI[-iwh6Y=94UF+hf{');
define('NONCE_SALT',       '-6^ERpw=GZ:IW*G]],Ns P*-r#}n+-{ET~!e)l=sZ,jT%KhE$W{+carmjwa<%*in');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
