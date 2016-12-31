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
define('DB_NAME', 'ryanbuisset');

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
define('AUTH_KEY',         'YBWe&w|A}&{Bl2m#a3*tO w$!ZW~A/5pQMWq)}(ND1}F&W/L$DMg|rnu1LI-7&r;');
define('SECURE_AUTH_KEY',  'dTtyor}e9:/E8!>HU=7BF+TesM-E!wq}XTB*C;6Zjpv6mDe37ZJM^s^}|ZT(WZcO');
define('LOGGED_IN_KEY',    '`?3fwyDt`kma[0D6fW*DlS3jr}/-c4pfNSj=C4au6T;2,^sD8>S;wH44G~K{@[-Y');
define('NONCE_KEY',        '~@~l]fv8>R6nCeM<{b-7S>Ak7XPNT6WAM)E;~8t-,1!Z@(~!$ 0{G<=-:oi>Ln+,');
define('AUTH_SALT',        '^b3BcTYK<V$s0#~tkk~_.f&Fnaq<3r*u*/&4p~/H/6_]&$KN:%#r[1L*zD}[b9Lt');
define('SECURE_AUTH_SALT', 's+*Z;}.NbQB>,2/)8R{#&A[Zi^ L+O9=/O,>ablr@Z*^}b#Kc-]dS4)j(DyV#>r3');
define('LOGGED_IN_SALT',   '9)h9O;9>!Y2,>3(WU@P;>LB:s!WN@rA lS1[ ]<m].x]aOJGcc7vhH&*M3=yon{F');
define('NONCE_SALT',       'hAK*]pH;.Uey}@A?^=q8*9!KM4rJv<o97.pE-s7uU9Gvqn6g9eKaH D2kqDS#zoa');

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
