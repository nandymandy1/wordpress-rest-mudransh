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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'QQY3inCdtMCbcMwZkoQTICDPdY8wf/vkWzr4rwper4ajbRD8h/Dc6CgG4Tv0wdzaDwU7eEOQVlA5q7mi/+jVww==');
define('SECURE_AUTH_KEY',  'pzG2khpeemUhGpwbKiUjVPS/+UPawUmClrppHC8/ox7bmjW/5MA4qcGSDGCOqzPoCgeAKGBrZuZIFUVS2btqVQ==');
define('LOGGED_IN_KEY',    '7PXZi+KFu1C+KWMB2F1p/dKKaRmnNfjTJgoSYUw80RN6Yy9GOHS4jCMqrvBREjsq//XL7+nJgkmuxxrGLAX2XQ==');
define('NONCE_KEY',        'vZlZ3ck2xndHGhkhw1xZIkPFaR4LXYrCTGrGNn5m9wzJ4s09LcCcLtPPds1AIXK/dYFyASBSULSplY0LV6iVXA==');
define('AUTH_SALT',        'z+p6UoPcFRA+MfgjzATkeEAZ02ymmIOXNKrydB7/euJQ81bugI9eRamGJbCEptfM9Lx/vl6NtqV+9ChR0zp5lg==');
define('SECURE_AUTH_SALT', 'OLZd1FBzWHlg5Jnsq9JLXRz+Np3ujOBncrNhGSFqzBe/H7WH4g2q/u080ckfWa3ONzpBQleVDsWuAeZQCUR+oA==');
define('LOGGED_IN_SALT',   'Dum3yAFE1SuMqeydcKTWfqkVL/Od9RLt4z2908uPa1CX4spNRMZqvaMHkqW1cQ7wFMkxHD9O07QDNX8h64LW1Q==');
define('NONCE_SALT',       'ame9N0+a4c+seG1Zv3iGoLMkFggTAZdyapSLuu6IxNjG7crSO7PICB8dlWVEfPWXgJLpx6zP2fKJdvjScCninQ==');

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
