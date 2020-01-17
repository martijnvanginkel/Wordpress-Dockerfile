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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'mvan-gin' );

/** MySQL database password */
define( 'DB_PASSWORD', 'asdf' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define( 'FS_METHOD', 'direct' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'b3Y.X`}Ga}$+9[0H|[8t~<^Qyh~hPHNll;J%,Vljt*nEOp&_TrrkAuZ1.6E}[s_o' );
define( 'SECURE_AUTH_KEY',   '(GBQJiM;]mZ?yMnxpfLaJI9R|r&;1^)9}#v:;~lQt?Fo}TvNnT H^d19{2VRfsy{' );
define( 'LOGGED_IN_KEY',     'zYL#jdW}lYqx^b[q5(&$-B/TNts~UxZzRH8[}KWc~a`Fu z+eCKCM!:OO^hEJm$<' );
define( 'NONCE_KEY',         'o|~{l/@X!TzZig2GnRiw:6!j6oW}cQ`b@Ai0~RyU>De5f^[Rl~HbFC(uNv,{ -[m' );
define( 'AUTH_SALT',         'xZGFUhxe83,sDAe0Jp6ciM(Khk{s4 1Q??6:DVQ].<WRx6?6*z :n,vctjDI(rI,' );
define( 'SECURE_AUTH_SALT',  'XKyx7+e3D0`@>a6pn%tbtI8]BH]bri|iEbh=&oek%0y<+Mnz}rEOU[5e*brXMMq(' );
define( 'LOGGED_IN_SALT',    'rHY,)Ft02[rX2?Klx~4,[/o)9d8rMH;DpZ>T%`5Ac<Za1,.8:@nY[MgY5BlEU/%a' );
define( 'NONCE_SALT',        '&rnNO+DZM0.Tt.~KI061J7fi%!],(+Zfh(;QD=]UE33aUNU3u&lz|@QIzRi~_ek/' );
define( 'WP_CACHE_KEY_SALT', 'nQd9u5OuN)BA`En@qTM5[k_~=RW_NNSTFP:!$n.#A3BvmN=Hw<@ |evshxA;Z0V*' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';