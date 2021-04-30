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
define( 'DB_NAME', 'wordpress_first_theme' );

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
define('FS_METHOD', 'direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '9/C9&3hkfa!?5t[sq-6&j$Wau8L6-Hu$+E5z9A(JNU48K~Smxby4]M`X-A/9`=IB' );
define( 'SECURE_AUTH_KEY',  'iM7C@-es8M$TEIag.ri0we^`LA#4gxRDIq)Y3axo~rG^7tv_<unr<T/t>QF7QMRi' );
define( 'LOGGED_IN_KEY',    '-iBc1!vPAUT6sl,5`yd|nbRW{{; Y3C9fdq;MpG %dz3_W<Mb[/gxmz[HJ;j7Yns' );
define( 'NONCE_KEY',        '~YGO0kMw%q^WS}W{Ep6gn1V+zq7:+7KE)&hvVKnB37xS%D}Q@ZTn#AWL3bne=9q4' );
define( 'AUTH_SALT',        'e|3&-&NUg}=m %KJ9=t[bC_aQa5rU2(bSpw/_A5tS^SIat2]F}^cz9Oaba2tx,>}' );
define( 'SECURE_AUTH_SALT', 'w<S[i7TBbo|:#?zw[919QCQHHewq4te`~7eah=2YhMJZZJSI>-9Bk3JfD*U.&<Lc' );
define( 'LOGGED_IN_SALT',   'iS,3y9jl<6IgfYekW%uQT9za DnaLMXJ!I!nolB,clxrh3OAs^)mZX>o!klp 2i2' );
define( 'NONCE_SALT',       'r<Nzr*-)@=L5!d*sTfP0xg?C}]uC,/*pO).o10!I5+/k 9^iYiL87u)S(%ZH/]_^' );

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
define( 'UPLOADS', 'wp-content/uploads' );
require_once ABSPATH . 'wp-settings.php';
