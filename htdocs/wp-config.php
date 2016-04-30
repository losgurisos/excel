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
define('DB_NAME', 'wp_excel');

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
define('AUTH_KEY',         'mfs76y)h=zEm+Ne~xA[< @A[qyx`Iui_,~y^8^68~fT-C_T/tvG{u:6_Qj:8-oU-');
define('SECURE_AUTH_KEY',  'e-$J^s_yC]wZQY.OEyY&Ntl&z0E;;~L<AYRJq9:)W}n7/pi22/9nMt9yidJdXXgy');
define('LOGGED_IN_KEY',    'n<$-x$8nC$z)o `1>;:dKn:jc;Jrp}Siq~%!9*!T0z;A{jcb/gCs?+$T_Jru`=HA');
define('NONCE_KEY',        'UsS[YR!j`yq8~Zs}8fF$Px0>NO9^#4baKstwO:SC(O8%Wn8NNZC+1G},F_-p`IoE');
define('AUTH_SALT',        '5KEE&#|049VqGaPa!lLVPDj;=DDD{Jp$#&nrm(e,Y}Vd6L2Se^3%bXZh =&V;7+Y');
define('SECURE_AUTH_SALT', 'B_tj{*yH[:G_Tn(9rhX[Vvbd^XXM.!NiBTEh/e3asslG,hHGi{A^.4`LDYDVmcc8');
define('LOGGED_IN_SALT',   'p5kY^[+)Q(XMu3C={yaP7&G+h.}13H0w8;HT9?q.hIo+,`7}U}h-!W)o,LYXCJ0y');
define('NONCE_SALT',       ',FC9M#w;,`Q$Z&prqx$C995C`|XYMf3k8IV4quL1fHB&];p+KQ:mXW{2+O+/I+3H');

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
