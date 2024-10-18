<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'phn' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '{z6pkw8g9>tD!{h_oAC:*aaULntS=xb3x:C[;IjS4VfV%Y3W.^SS#Tl)+;iG$Tw%' );
define( 'SECURE_AUTH_KEY',  'y<[T&+p;;8$hUkSNMCp| ]/8dA]6.s?7+x~.tG%Li^TNbzYO@tG`?f6R4>S9kHBu' );
define( 'LOGGED_IN_KEY',    '!G60e?}Kid(v6{Bl1D;[|a+w=A_4.s}(9As,Zl27<J)`AxX8%te:>BR!BzWJS7#9' );
define( 'NONCE_KEY',        'U9SNjzTNt~UW-I|lDsOmd|I6^LnqSi4=WuO,rop97!|j3 J<El;sOSRP9cC#cZD>' );
define( 'AUTH_SALT',        '=s&gtTgv5kP|SUL`Y)j>,k&NubCMd&D#D0Px!uf_&A-Q0=Ix;y2#c3!VdpW ,Z=N' );
define( 'SECURE_AUTH_SALT', 'Tsc,?6L$n=!I^n4SvxEG5fvX*LUHGPk$~ _ls!Dq^{.yb?H^HDLMhjEel%;^YRZ=' );
define( 'LOGGED_IN_SALT',   '<<h;tjWeZ`H/KY@xx0!:Lbgs30JEi8km3>UQZwm+r,LEsRCKM&ZK`]{SP#dq#O1&' );
define( 'NONCE_SALT',       '3!G}K6+0KR3b%1{94tc[-g}zSxx~N<to ;w1WOH9t2V]XTW*Sl}RBfjUCLaNTkn.' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
