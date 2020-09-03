<?php
/**
 * Registers WP menu locations.
 * All locations should have -nav suffix.
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'register_theme_nav' )) {
  function register_theme_nav() {
    register_nav_menus(
      array(
        'header-nav' => __( 'Header Navigation', PANDAGO_TD )
      )
    );
  }
}
add_action( 'init', 'register_theme_nav' );

/**
 * Returns menu markup from given location.
 *
 * @since 1.0.0
 * @since 1.0.2.3 Added $walker parameter
 * 
 * @param string $location Previously defined WP menu location system name
 * @param string $class Class for <ul> element
 * @param int $depth Menu depth
 * @param mixed $walker Either an empty string or walker class instance
 *
 * @return string
 */
if ( ! function_exists( 'pandago_nav' ) ) {
  function pandago_nav( $location, $class = '', $depth = 0, $walker = '' ) {
    $items_wrap = '<ul>%3$s</ul>';

    if ( ! empty( $class ) ) {
      $items_wrap = '<ul class="' . $class . '">%3$s</ul>';
    }

    return wp_nav_menu(
      array(
        'theme_location'  => $location . '-nav',
        'menu'            => '',
        'container'       => '',
        'container_class' => '',
        'container_id'    => '',
        'menu_class'      => 'menu',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => $items_wrap,
        'depth'           => $depth,
        'walker'          => $walker
      )
    );
  }
}
?>