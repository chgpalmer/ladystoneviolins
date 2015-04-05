<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'ladystoneviolins');

/** MySQL database username */
define('DB_USER', 'ladystoneviolins');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'msf!5Y @gvtMC`5AN4ec4qxeVIMd#L#Y Lp}_{#,5u68H~ls,`DLrHHJ^o/n;L1g');
define('SECURE_AUTH_KEY',  'Sbt|v(f|q);J-~i[3|+p-+O*UoLU66t:j[Gj yB#+#xb,89iM$/jiX-{tkn$EMAD');
define('LOGGED_IN_KEY',    'l**!%9HX)4(IW|0t6(d#TbOza$ogQ%h][/`AuA{08Y}7+~D.C#5XiDzg0Ymb,h4!');
define('NONCE_KEY',        '@4@ Wr-<+|iv6|Lq_UVJ[5tx`?.k6j+o9l!E(BfOo|V?gp`NN5;8%i{5(twuX89R');
define('AUTH_SALT',        'c}K$_U7gA6.[o~gb4Z|QKd7}.egJ-C59T]p%~ Pd!RiWfuQ;Zxsu[`iI-phhf2sv');
define('SECURE_AUTH_SALT', '-?]$9lk`&X^n+0#|m$jPbs%#?0Ola0O_sU Y* w^jK~>a:I;aqJV&dv%iCtg~TWW');
define('LOGGED_IN_SALT',   '&SavX?b%k:v:{rPCfgi>eYo}qT1h|i];h;YvGA7VZe*C~,j{YN -0W_w`jB9rWJw');
define('NONCE_SALT',       'bm![ [n|VR!?Aj#A_j$r6=l5EjfV8_-bIu)oNZ:4m:+xwY~3$Q&a/LL=P7wYnJeq');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
