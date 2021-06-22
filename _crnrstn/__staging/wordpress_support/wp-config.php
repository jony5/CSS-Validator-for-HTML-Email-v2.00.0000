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

/*
// J5
// Code is Poetry */
require('../blog/_crnrstn.root.inc.php');
include_once(CRNRSTN_ROOT . '_crnrstn.config.inc.php');

//error_log(__LINE__.' wp-config wp_db_name='.$oCRNRSTN_USR->wp_db_name());
//error_log(__LINE__.' wp-config wp_db_user='.$oCRNRSTN_USR->wp_db_user());
//error_log(__LINE__.' wp-config wp_db_password='.$oCRNRSTN_USR->wp_db_password());
//error_log(__LINE__.' wp-config wp_db_host='.$oCRNRSTN_USR->wp_db_host());
//error_log(__LINE__.' wp-config wp_db_charset='.$oCRNRSTN_USR->wp_db_charset());
//error_log(__LINE__.' wp-config wp_db_collate='.$oCRNRSTN_USR->wp_db_collate());
//error_log(__LINE__.' wp-config wp_auth_key='.$oCRNRSTN_USR->wp_auth_key());
//error_log(__LINE__.' wp-config wp_secure_auth_key='.$oCRNRSTN_USR->wp_secure_auth_key());
//error_log(__LINE__.' wp-config wp_logged_in_key='.$oCRNRSTN_USR->wp_logged_in_key());
//error_log(__LINE__.' wp-config wp_nonce_key='.$oCRNRSTN_USR->wp_nonce_key());
//error_log(__LINE__.' wp-config wp_auth_salt='.$oCRNRSTN_USR->wp_auth_salt());
//error_log(__LINE__.' wp-config wp_secure_auth_salt='.$oCRNRSTN_USR->wp_secure_auth_salt());
//error_log(__LINE__.' wp-config wp_logged_in_salt='.$oCRNRSTN_USR->wp_logged_in_salt());
//error_log(__LINE__.' wp-config wp_table_prefix='.$oCRNRSTN_USR->wp_table_prefix());
//error_log(__LINE__.' wp-config wp_debug='.$oCRNRSTN_USR->wp_debug());

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', $oCRNRSTN_USR->wp_db_name());

/** MySQL database username */
define( 'DB_USER', $oCRNRSTN_USR->wp_db_user());

/** MySQL database password */
define( 'DB_PASSWORD', $oCRNRSTN_USR->wp_db_password());

/** MySQL hostname */
define( 'DB_HOST', $oCRNRSTN_USR->wp_db_host());

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', $oCRNRSTN_USR->wp_db_charset());

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', $oCRNRSTN_USR->wp_db_collate());

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         $oCRNRSTN_USR->wp_auth_key());
define( 'SECURE_AUTH_KEY',  $oCRNRSTN_USR->wp_secure_auth_key());
define( 'LOGGED_IN_KEY',    $oCRNRSTN_USR->wp_logged_in_key());
define( 'NONCE_KEY',        $oCRNRSTN_USR->wp_nonce_key());
define( 'AUTH_SALT',        $oCRNRSTN_USR->wp_auth_salt());
define( 'SECURE_AUTH_SALT', $oCRNRSTN_USR->wp_secure_auth_salt());
define( 'LOGGED_IN_SALT',   $oCRNRSTN_USR->wp_logged_in_salt());
define( 'NONCE_SALT',       $oCRNRSTN_USR->wp_nonce_salt());

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = $oCRNRSTN_USR->wp_table_prefix();

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
define( 'WP_DEBUG', $oCRNRSTN_USR->wp_debug());

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
