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
define( 'DB_NAME', 'wordpress1' );

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
define( 'AUTH_KEY',         'SlZ~Jw$yM*Pn*8nX6S!H^0V!Hl4 ,V8G{=NmrNs_v0E|Pw0l`-VMxb2gLH}L7b|#' );
define( 'SECURE_AUTH_KEY',  'E C$=9&;m(Qpv<hNg^7}qSWttBfs|*(6n1nAl*Gi` ^>P#WmV(NOks^/ddw|zO0e' );
define( 'LOGGED_IN_KEY',    'Ueh+{lB.L<;Zk8,Sx?|<gVVrvEfLO?)TWZo^[RX;]+0yRjh <$&#$+wx.5LnmhgV' );
define( 'NONCE_KEY',        '00x5lm#YQkuV/q/#?XK9cE}p*sX+_`9wgi_ma*r;R =L <oEa~GJ)[v#UK)cyE~X' );
define( 'AUTH_SALT',        'GXb[uJ^dukacM.wJ58i]Kh2.v6:bn}*R$<P2q}zr/xUWT%]aNyTZlXR_qQsj%&Ip' );
define( 'SECURE_AUTH_SALT', '+tQXx [eRG`}TQD@V0XgWG8[/UUjOm<N2)A0j])E>(y%){k2Rju2xJ&~/#`J/*?y' );
define( 'LOGGED_IN_SALT',   '6(Tni/ABzRqgx]yL,yJq9_<jBeJoz4Xp7fEkoZ3_O&_Qa2*N1j/I(`YXe%=ASD#.' );
define( 'NONCE_SALT',       'DmUfk|R1ujP.@5Hr913%BMkM1^s]t2Nv#Jh6/,,7<}k</*H}IXlI2HL|W,p.z9)Y' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
