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
define('DB_NAME', 'wordpress');

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
define('AUTH_KEY',         '14?dUf.Pn6u;dtKy[E2p$u6KbUj`#QXjr[t.so&6 vlyoJZA~2;fnjJof[dW7oll');
define('SECURE_AUTH_KEY',  'n2O=OFzc&U!:gCbQUu6ZbS5B*~h$DIWr*G%:/=<x`Rx7hkH,Z@ pE-OPF>V25PMG');
define('LOGGED_IN_KEY',    'Jbsb*i/Lmn[0OSy%n4HiUa>s;w*wdA~wsD=WraKzzYG|.,#o1h::Z!<i$.Dq^Ll=');
define('NONCE_KEY',        '|8zvSU~yN>>ib/mzo*mXDie-O]x-F@P~|M)<kpW%N((Dsu7N0Y#H]P;WI^v4Wli)');
define('AUTH_SALT',        ' j$*D#jNxL8xWHf&DsY0{#_v6|g.UU@U-p*bJs^q=fI[:)CiMb,hw_v/t~1-]z+9');
define('SECURE_AUTH_SALT', 'fYj@y[J_W*J&[g*B86l+_,fC+:!)&|ZQ:+T``XH %aw|e::`]+-S<AX`H5nB>YlB');
define('LOGGED_IN_SALT',   ' vRXfgg$PzBKFG7%T*$U;20e@o/G%X-jU8XzUF,-NL!*%c|_/46dtOs#,Na dgl8');
define('NONCE_SALT',       ')Cf+2@XjK& !tsFT+YeFbT;KY[{Nh3mfTRJ4!y/CZI=)_TVePJ;.rA~%A`VQoIxR');

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
