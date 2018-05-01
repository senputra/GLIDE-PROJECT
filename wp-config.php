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

// ********** Dody put this one, so that can install plugin directly to localhost
// ********** and also adds https connectivity
define('FS_METHOD', 'direct');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '9}$]0GxjLw70K|y{hG2<nW`K.3~-`^Hd[IM??e!cbinKRK_]0awkZcQu<heKZO$y');
define('SECURE_AUTH_KEY',  '|LX]PdRsEpTI)ljEamFL/5R)q>#SOs-z4!C[&G(}?2jxHetVw]hr%^<.v<5A]pyL');
define('LOGGED_IN_KEY',    '75.#|pz^E/i@G&DS:ehN?)4S`hDQf4[Z2>k#+GgHMoc0tU&y`.hKGO}3JeUZdbGl');
define('NONCE_KEY',        'AM_xXI8PE9R?LM;/j5G$-F$*@|@AVvvyLp9u$XV[u76k;v= ^Tdl}sURs+WH1&kx');
define('AUTH_SALT',        '-*K%<vGK })/zI?Ou~C$;)2CJp>u#@<-eJ|ZdNfr;cCNAa<mK[e}I0n$YH-f[gX>');
define('SECURE_AUTH_SALT', 'B%-e!u6!9F?uJkUH]U!2{m?U}KKCs3smdAX_w32@wr@(uGGk,-sqq7?=k.tq#8Rd');
define('LOGGED_IN_SALT',   'njWMN??Wj%IJN3*4sZmh7!33)M4zpTQ`ArQc8gFv 4d:hw2_2wg0suCE{>Hcy5UC');
define('NONCE_SALT',       '30+=rHl!oj}0B*o|Yo[R#Q(WFX$hm]fY{~T$p~p0@[:H9c0 Jpgule7]Tki9MB+8');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
