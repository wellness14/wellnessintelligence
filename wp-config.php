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
define('DB_NAME', 'wellness14');

/** MySQL database username */
define('DB_USER', 'wellness14');

/** MySQL database password */
define('DB_PASSWORD', 'dnpfsltm14');

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
define('AUTH_KEY',         '2;/RhrPs<{spS3B:`).jW?2+WW_GV%A?b(p({Y#z*6yn8F(*z<P.fhJX@YGk,RaO');
define('SECURE_AUTH_KEY',  '<FF<0C@yI{kFx?[C v,q@bXzIQ[sEuQ;draa&5-0bmL8yx[*5-a_&3WM=B<dbjk3');
define('LOGGED_IN_KEY',    'GX9yFO)AUbZ3h+.orq4S[Osr)KpJ?$#.Fh+&JD<q30%=r][Dj8B?Vo0rw{p5[%t~');
define('NONCE_KEY',        ' 3Q;=9oY0n#{gZ#h/[u6`JTdd{~4;[jQU$}fV[-T*Fq%w9}ug1GeMx6ew0m5w?Ew');
define('AUTH_SALT',        ':{=6EHosbAm{& jO]jDZcM^$=q<gT/P-I1-f*64LUaj-`~-qG~,3QA`V&IxR$z[B');
define('SECURE_AUTH_SALT', 'fF.PTy,ss%Bl4!EZ:>+xSU442!`!E^2q15e,`.+s1|).DRb[F}8|;uBQ_nRrH[*.');
define('LOGGED_IN_SALT',   '.ZA6t`@6u_xq,Jxy14$JE{Y)-)i$%aVcKUT9Zi[t7_BsJmIL5teb!MrF-vnt:zRG');
define('NONCE_SALT',       '7?uY yY&E,e2L&^VKyap;gXxrCFOb*1+`Eu8cG4$_:tU|frhV];qN+u#nYwWI;GX');

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
