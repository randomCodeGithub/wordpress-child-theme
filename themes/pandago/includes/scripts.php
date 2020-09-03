<?php
/**
 * Includes core JacaScript.
 * 
 * @since 1.0.0
 * @since 1.0.1 Added jQuery lazy load plugin
 * @since 1.0.2.2 Conditionizr non optional
 * @since 1.0.3 Added conditional plugins
 * @since 1.1 Added isOnScreen conditional plugin
 */
if ( ! function_exists( 'pandago_scripts' ) ) {
  function pandago_scripts() {
    if ( $GLOBALS['pagenow'] != 'wp-login.php' && ! is_admin() ) {
        // Conditionizr
        wp_register_script( 'conditionizr', URL_PANDAGO_JS . '/conditionizr.min.js', array(), '4.5.1', false );
        wp_enqueue_script( 'conditionizr' );

        // Cookie consent
        wp_register_script( 'cookie-consent', URL_PANDAGO_JS . '/cookie-consent.js', array(), '1.0.0', true );
        wp_enqueue_script( 'cookie-consent' );

        // Lazy load
        wp_enqueue_script( 'lazy', URL_PANDAGO_JS . '/jquery.lazy.min.js', array( 'jquery' ), '1.7.10', true );

        // Load conditional JS plugins
        // Fancybox
        if ( get_field( 'js_plg_fancybox', 'option' ) ) {
            wp_enqueue_style( 'fancybox', URL_PANDAGO . '/assets/vendor/fancybox/jquery.fancybox.min.css', array(), '3.5.7' );
            wp_enqueue_script( 'fancybox', URL_PANDAGO . '/assets/vendor/fancybox/jquery.fancybox.min.js', array( 'jquery' ), '3.5.7', true );
        }

        // Slick slider
        if ( get_field( 'js_plg_slick_slider', 'option' ) ) {
            wp_enqueue_style( 'slick', URL_PANDAGO . '/assets/vendor/slick/slick.css', array(), '1.8.1' );
            wp_enqueue_script( 'slick', URL_PANDAGO . '/assets/vendor/slick/slick.min.js', array( 'jquery' ), '1.8.1', true );
        }

        // Datepicker
        if ( get_field( 'js_plg_datepicker', 'option' ) ) {
            wp_enqueue_style( 'datepicker', URL_PANDAGO . '/assets/vendor/datepicker/jquery-ui.min.css', array(), '1.12.1' );
            wp_enqueue_script( 'datepicker', URL_PANDAGO . '/assets/vendor/datepicker/jquery-ui.min.js', array( 'jquery' ), '1.12.1', true );
        }

        // NiceScroll
        if ( get_field( 'js_plg_nicescroll', 'option' ) ) {
            wp_enqueue_script( 'nicescroll', URL_PANDAGO . '/assets/vendor/nicescroll/jquery.nicescroll.min.js', array( 'jquery' ), '3.7.6', true );
        }

        // SumoSelect
        if ( get_field( 'js_plg_sumoselect', 'option' ) ) {
            wp_enqueue_style( 'sumoselect', URL_PANDAGO . '/assets/vendor/sumoselect/sumoselect.min.css', array(), '3.0.2' );
            wp_enqueue_script( 'sumoselect', URL_PANDAGO . '/assets/vendor/sumoselect/jquery.sumoselect.min.js', array( 'jquery' ), '3.0.2', true );
        }

        // Modernizr
        if ( get_field( 'js_plg_modernizr', 'option' ) ) {
            wp_enqueue_script( 'modernizr', URL_PANDAGO . '/assets/vendor/modernizr/modernizr-3.6.0-custom.min.js', array( 'jquery' ), '3.6.0', true );
        }

        // isOnScreen
        if ( get_field( 'js_plg_isonscreen', 'option' ) ) {
            wp_enqueue_script( 'isonscreen', URL_PANDAGO . '/assets/vendor/isonscreen/jquery.isonscreen.min.js', array( 'jquery' ), '1', true );
        }

        // Google Maps
        if ( get_field( 'google_maps_api_key', 'option' ) && ! wp_script_is( 'google-maps' ) ) {
            $google_maps_url = 'https://maps.googleapis.com/maps/api/js?key=' . get_field( 'google_maps_api_key', 'option' );

            if ( get_field( 'google_maps_callback', 'option' ) ) {
              $google_maps_url .= '&callback=' . get_field( 'google_maps_callback', 'option' );
            }

            wp_enqueue_script( 'google-maps', $google_maps_url, array(), '3', true );
        }

        // Add global theme scripts
        wp_register_script( 'pandago', URL_PANDAGO_JS . '/theme.js', array( 'jquery' ),  PANDAGO_V, true );
        wp_enqueue_script( 'pandago' );

        $url = home_url();
        $parse = parse_url($url);
        $browsers = array();
        $browsers_notice = array();

        if ( ! is_null( get_field('browser_class', 'option') ) ) {
            $browsers = get_field('browser_class', 'option');
        }

        if ( ! is_null( get_field( 'browser_notice', 'option' ) ) ) {
            $browsers_notice = get_field( 'browser_notice', 'option' );
        }

        $php_vars = array(
            'host' => $parse['host'],
            'ga_tracking_id'   => ( get_field( 'ga_tracking_id', 'option' ) )   ? get_field( 'ga_tracking_id', 'option' )   : 'UA-000000000-0',
            'cookies_position' => ( get_field( 'cookies_position', 'option' ) ) ? get_field( 'cookies_position', 'option' ) : 'bottom-right',
            'browsers'         => $browsers,
            'browsers_notice'  => $browsers_notice,
            'strings' => array(
                'cookies_message'    => ( get_field( 'cookies_message', 'option' ) )    ? get_field( 'cookies_message', 'option' )    : __( 'Šajā vietnē tiek izmantotas sīkdatnes. Turpinot izmantot šo vietni, Jūs piekrītat mūsu sīkdatņu politikai.', 'cookies-consent' ),
                'cookies_allow'      => ( get_field( 'cookies_allow', 'option' ) )      ? get_field( 'cookies_allow', 'option' )      : __( 'Apstiprināt', 'cookies-consent' ),
                'cookies_deny'       => ( get_field( 'cookies_deny', 'option' ) )       ? get_field( 'cookies_deny', 'option' )       : __( 'Noraidīt', 'cookies-consent' ),
                'cookies_learn_more' => ( get_field( 'cookies_learn_more', 'option' ) ) ? get_field( 'cookies_learn_more', 'option' ) : __( 'Uzzināt vairāk', 'cookies-consent' ),
                'cookies_link'       => ( get_field( 'cookies_link', 'option' ) )       ? get_field( 'cookies_link', 'option' )       : get_privacy_policy_url()
            )
        );

        /**
         * Get error messages from main Contact Form 7 form defined in admin panel.
         */
        // Check if plugin exists and field has a value.
        if ( is_dir( ABSPATH . 'wp-content/plugins/contact-form-7/' ) && get_field( 'general_contact_form_id', 'option' ) ) {
            $form_id = false;

            /*
             * Check if entered value is a number
             * or a shortcode. If it's a shortcode, extract
             * form ID from it.
             */
            if ( has_shortcode( get_field( 'general_contact_form_id', 'option' ), 'contact-form-7' ) ) {
                preg_match( '/id="([^"]+)"/', get_field( 'theme_contact_form', 'option' ), $matches );

                if ( isset( $matches[1] ) ) {
                    $form_id = $matches[1];
                }
            } else {
                $form_id = get_field( 'general_contact_form_id', 'option' );
            }

            if ( $form_id ) {
                $php_vars['cf_messages'] = WPCF7_ContactForm::get_instance( $form_id )->get_properties()['messages'];
            }
        }

        wp_localize_script( 'pandago', 'pandago_php_vars', $php_vars );
    }
  }
  add_action( 'wp_enqueue_scripts', 'pandago_scripts', 1 );
}

/**
 * Show all enqueued scripts.
 * 
 * @since 1.0.0
 */
function pandago_scripts_show() {
  global $wp_scripts;

  foreach( $wp_scripts->queue as $handle ) {
    echo $handle . "\n";
  }
}

/**
 * Since enqueued scripts can only be shown after theme initialization,
 * make this function run only if user is logged in and 'pandago_scripts_show'
 * $_GET parameter is set.
 * @TODO: make devbar
 * 
 * @since 1.0.0
 */
if ( is_user_logged_in() && isset( $_GET['pandago_scripts_show'] ) ) {
  add_action( 'wp_print_scripts', 'pandago_scripts_show' );
}
?>