<?php
/**
 * Theme defines.
 * All paths and URLs ends WITHOUT trailing slash.
 * 
 * @since 1.0.0
 */

// Path to parent (this) themes directory
define( 'PATH_PANDAGO', get_template_directory() );

// Path to themes classes
define( 'PATH_CLASSES', PATH_PANDAGO . '/classes' );

// Path to themes core includes
define( 'PATH_INCLUDES', PATH_PANDAGO . '/includes' );

// Path to child (current) themes directory
define( 'PATH_THEME',    get_stylesheet_directory() );

// URL to parent (this) themes directory
define( 'URL_PANDAGO', get_template_directory_uri() );

// URL to parent (this) themes assets javascript directory
define( 'URL_PANDAGO_JS', URL_PANDAGO . '/assets/js' );

// URL to parent (this) themes assets stylesheet directory
define( 'URL_PANDAGO_CSS', URL_PANDAGO . '/assets/css' );

// URL to themes included libraries / plugins
define( 'URL_PLUGINS', 'http://developers.sem.lv/pandago/plugins' );

// URL to child (current) themes directory
define( 'URL_THEME', get_stylesheet_directory_uri() );

// URL to child (current) theme images
define( 'URL_IMAGES', URL_THEME . '/assets/img' );

// Text domain
define( 'PANDAGO_TD', 'pandago' );

// Theme version
define( 'PANDAGO_V', wp_get_theme()->get( 'Version' ) );

/**
 * Whole theme setup relies on ACF plugin. Throw an error
 * if it's not enabled.
 * 
 * @since 1.0.0
 */
if ( ! is_admin() && $GLOBALS['pagenow'] != 'wp-login.php' && $GLOBALS['pagenow'] != 'wp-logout.php' && ! function_exists( 'get_field' ) ) {
  _e( 'Šim kažociņam nepieciešams ACF, lai tas darbotos :-)', PANDAGO_TD );
  die();
}

// Include all theme base files and classes
include_once( PATH_INCLUDES . '/vendor/TGM_Plugin_Activation.php');
include_once( PATH_INCLUDES . '/vendor/ThemeUpdateChecker.php' );

include_once( PATH_INCLUDES . '/core.php' );
include_once( PATH_INCLUDES . '/blocks.php' );
include_once( PATH_INCLUDES . '/languages.php' );
include_once( PATH_INCLUDES . '/menu.php' );
include_once( PATH_INCLUDES . '/options.php' );
include_once( PATH_INCLUDES . '/plugins.php' );
include_once( PATH_INCLUDES . '/scripts.php' );
include_once( PATH_INCLUDES . '/security.php' );
include_once( PATH_INCLUDES . '/styles.php' );
include_once( PATH_INCLUDES . '/usable.php' );

/**
 * Check for theme updates.
 * 
 * @since 1.0.0
 */
$update_checker = new ThemeUpdateChecker(
  'PandaGo',
  'http://developers.sem.lv/theme-update/update.json'
);
?>