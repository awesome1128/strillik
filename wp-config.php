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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'strollik_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'qd<!Dxl#R1GC!jmshzj28Ghi1|$WXzUsj,*nVz:0Rpu#s#Q0TBZm#jY=(X1(,Uv-' );
define( 'SECURE_AUTH_KEY',  ')Ua`S<~{a0AjTjv4P_=5S FWNwtaqN&tOF:#T23X@W(V[,zf[4QM1G.:Ni/WT:!b' );
define( 'LOGGED_IN_KEY',    '|u-,PYdovLhOz96@%<{9L(Si`uWCq0nel)7)+PbqCPRtd`8oSgB#((*H<HgO%R(D' );
define( 'NONCE_KEY',        'd<WvNIa38]Z+|,az)ffx2DPhsJ_.,Qwo-02M@WTxrxgz&b66>$n[ag:rPR7WOkg1' );
define( 'AUTH_SALT',        'SIC6msZ<`rg>I*GO9(h?|zY8iFfMb;^[x*Ow)oXE[}5.$6^D2Nw1-?v+k;w9;AM/' );
define( 'SECURE_AUTH_SALT', '~b(fGItM.(}^8&Ob%j`beR;uFKl 4kK0^pl4`w~-6G:.X(/Pt.wAJL-t=$;jv9d}' );
define( 'LOGGED_IN_SALT',   ';GW_*Rs8@*D&Kg}maAG>RCw&qdd$UZCy=>LJ)DSfA5u=GbN``DB7JFXf2Q:*ypy1' );
define( 'NONCE_SALT',       'x8AKe{}cNrdhtH}X{T4q/8lQ[5 ZQve!x`$[v>$7rt]2PODSTTpfNGCj3/MO*E#U' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
