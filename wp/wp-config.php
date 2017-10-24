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
define('DB_NAME', 'dotslash_wp');

/** MySQL database username */
define('DB_USER', 'dotslash_wp');

/** MySQL database password */
define('DB_PASSWORD', '_v3rY_pR3$s1nG_');

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
define('AUTH_KEY',         '/`G_c)2l;3Me$;)LO6z9o@(?)WIjYM%]%zb$>1f;PNd3kr7F6o@2d}i[.HS4(-kZ');
define('SECURE_AUTH_KEY',  '/]bjwMF!)ur>9)I O:}SUd&Da%lr{t(IBegB|**% W?r[;7sU^GK]6 :r)SuTme<');
define('LOGGED_IN_KEY',    'NAj~R`+DKP,iYnz]6>,n3ez<<)A[9JQ{LFxffgu-,u.a%Dvyli1+?^L8~n#]Nw>!');
define('NONCE_KEY',        'bJoK+X?5hH(qO,R10wN9=bqdx,$+MlMpYVO*XX~-WYuNcGR}o*4[~mL@RkZ^Z:yU');
define('AUTH_SALT',        ';ui=hZhjLsvE}vs5G@wK>cCUUzr^aUx/q2DPszm|oQn{pOzhH7RR5M%M[`T^>>fi');
define('SECURE_AUTH_SALT', 's;++g}Y.};s)yx=*mnK%mq1XxxAm44eTmQK<^*N=O(:;v>,z9qaAL[+z?l(d0s2F');
define('LOGGED_IN_SALT',   '3#)e}WG57MDr}5W#J*(<=g$H+EBE2[s?A$4 IH,w=lA$$-/Ywe&BlYTUuBSd.IEd');
define('NONCE_SALT',       'b][ACgDW[r#,(N)>;[+oDJ:3sZ*~|X/lLzq&9zlUj!E)5o3v!K;/_-2i1H=;(DQ9');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
