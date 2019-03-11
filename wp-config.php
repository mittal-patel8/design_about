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
define('DB_NAME', 'own_site');

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
define('AUTH_KEY',         '9+g-o[=~FKNv4`#O!N}6A!utrG+=UMn~e-H50i`X;D(9vW~hk;?80]]T+x4D1l!=');
define('SECURE_AUTH_KEY',  'Lu~K;}@5D0+cUj5KQ%rN~}NBt%o1!XdhaMFb^ZS iYR3,s$SC`kiEHq7|raopU/Y');
define('LOGGED_IN_KEY',    '+P(2g%1GTL8y[VU:$>JXiIDGa|*>WkF~58-g%CO)UA7}s^`2m7$_7`b@G{A0$){0');
define('NONCE_KEY',        '}n#+kx v9$M1C*&/%#LO[m5GEie[e_N8C:p;>7>p+aG>|b:iK4$+O_07.0c%wXhj');
define('AUTH_SALT',        '>9<oBRm3+N4OB[+D_Zl*@3^(Y/;U`U(]9q58~G?L?1hS3UTUBCl{-h6j`ltJiz/~');
define('SECURE_AUTH_SALT', 'N#:<tM9&{RB7R#,a[9z5GEK8hcFG:>w%fP0m#U&fsc HRII4-FPBIK10tUg-)rqX');
define('LOGGED_IN_SALT',   '0<l7THgg9GOhB6/]s!)O?^rAk,KPLU|#]r}cY^n}rU>Znfte4_.gQO{U9B@^)tYC');
define('NONCE_SALT',       '0o~eBo@5Ae1rsAIDt*Qb_-1wS%+-4z2EmmLBO|?ixo&TTPOFQ^jy7ZWUR@,cdl,<');

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
