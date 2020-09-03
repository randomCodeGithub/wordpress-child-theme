<?php
/**
 * Enables the HTTP Strict Transport Security (HSTS) header.
 *
 * @since 1.0.0
 */

function tgm_io_strict_transport_security() {
  header( 'Strict-Transport-Security: max-age=10886400' );
}
if ( function_exists( 'get_field' ) && get_field( 'developers_enable_strict_transport_security_headers', 'option' ) ) {
  add_action( 'send_headers', 'send_frame_options_header', 10, 0 );
  add_action( 'send_headers', 'tgm_io_strict_transport_security' );
}

/**
 * Disables XMLRPC.
 * 
 * @since 1.0.0
 */

function pandago_disable_xmlrpc() {
  return false;
}
if ( function_exists( 'get_field' ) && get_field( 'developers_disable_xmlrpc', 'option' ) ) {
  add_filter('xmlrpc_enabled', 'pandago_disable_xmlrpc');
}

/**
 * Disables WordPress JSON REST API
 * 
 * @since 1.0.0
 */
function pandago_disable_rest_api( $access ) {
  return new WP_Error( 'rest_disabled', __( 'REST API ir atslēgts.' ), array( 'status' => rest_authorization_required_code() ) );
}
if ( function_exists( 'get_field' ) && get_field( 'developers_disable_rest_api', 'option' ) ) {
  add_filter( 'rest_authentication_errors', 'pandago_disable_rest_api' );
}
?>