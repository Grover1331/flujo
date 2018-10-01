<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'flujo');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '=XX@Yk&oUYiD/ma}f~)Bz^_bn{!w<UyN&)b#P=iVll<,3D0QoPFbN[W?0eY`(K-i');
define('SECURE_AUTH_KEY',  'btk $O~I0$X24eXrKll>pt>Se:n:@lTa#A1.u}DMT2GVhmJNF;u55`05+ -i3|eX');
define('LOGGED_IN_KEY',    '2=Qi90Jp~dp/%BE;c4Np*m>U$CeTHxLsp!K,ss<Yj7*X<w{D)0euf,aL2?]_+i8b');
define('NONCE_KEY',        ';D0Rv7ss=GVm;*UhB!+kN]urDz1#.Reab~>Ql:37+ND(h~4Lxn%KNihe1>Nc_]1f');
define('AUTH_SALT',        'DSH6zc(U7!+q~$,1ExiB/=R:sxZ@193C^/&lUm[bZou7v7~}NXh:[V_8[ta$/P:<');
define('SECURE_AUTH_SALT', ')s1Lj#p8uwA%;Q5R+??W1(;&|fJg/H<=[>cG8{vje.ZUUrM(=l2Nz:EVF+UwEOX=');
define('LOGGED_IN_SALT',   'dzr/+oQ6%G)xPo-<7qYEhSX!jH_?5=~W&:6%}:ZK=&}/=^>%vzl9NaG};8h?W>~z');
define('NONCE_SALT',       'sX~Gu3D$eo(XW<`qV0M,IgIcBH[x34a)`Kv[}Gg@(NGOoAG9[FRfAw: 5/?/tCHO');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wtw_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
