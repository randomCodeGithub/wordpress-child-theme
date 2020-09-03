<?php
/**
 * Include core stylesheets.
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'pandago_styles' ) ) {
  function pandago_styles() {
    if ( $GLOBALS['pagenow'] != 'wp-login.php' && ! is_admin() ) {
      // Add normalize
      wp_register_style( 'normalize', URL_PANDAGO_CSS . '/normalize.css', array(), '8.0.1', 'all' );
      wp_enqueue_style( 'normalize' );

      // Add resets
      wp_register_style( 'reset', URL_PANDAGO_CSS . '/reset.css', array(),  PANDAGO_V, 'all' );
      wp_enqueue_style( 'reset' );

      // Add browser notification styling
      wp_register_style( 'browser-notification', URL_PANDAGO_CSS . '/browser-notification.css', array(),  PANDAGO_V, 'all' );
      wp_enqueue_style( 'browser-notification' );

      // Cookie consent
      wp_register_style( 'cookie-consent', URL_PANDAGO_CSS . '/cookie-consent.css', array(),  PANDAGO_V, 'all' );
      wp_enqueue_style( 'cookie-consent' );

      // 404 custom design
      wp_register_style( '404', URL_PANDAGO_CSS . '/404.css', array(),  PANDAGO_V, 'all' );
      wp_enqueue_style( '404' );

      // Add Bootstrap grid
      wp_register_style( 'bootstrap-grid', URL_PANDAGO_CSS . '/bootstrap-grid.css', array(), '4.1.3', 'all' );
      wp_enqueue_style( 'bootstrap-grid' );

      // Add global helpers
      wp_register_style( 'pandago-helpers', URL_PANDAGO_CSS . '/helpers.css', array(),  PANDAGO_V, 'all' );
      wp_enqueue_style( 'pandago-helpers' );

    
      // Add block styles
      wp_register_style( 'pdg-blocks', URL_PANDAGO_CSS . '/blocks.css', array(),  PANDAGO_V, 'all' );
      wp_enqueue_style( 'pdg-blocks' );
    }
  }
  add_action( 'wp_enqueue_scripts', 'pandago_styles', 2 );
}

/**
 * Show all enqueued stylesheets.
 * 
 * @since 1.0.0
 */
function pandago_styles_show() {
  global $wp_styles;

  foreach( $wp_styles->queue as $handle ) {
    echo $handle . "\n";
  }
}

/**
 * Since enqueued styles can only be shown after theme initialization,
 * make this function run only if user is logged in and 'pandago_styles_show'
 * $_GET parameter is set.
 * @TODO: make devbar
 * 
 * @since 1.0.0
 */
if ( is_user_logged_in() && isset( $_GET['pandago_styles_show'] ) ) {
  add_action( 'wp_print_scripts', 'pandago_styles_show' );
}
?>