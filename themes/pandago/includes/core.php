<?php
/**
 * Theme setup, defines defaults and adds some Wordpress features.
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'pandago_setup' ) ):
  function pandago_setup() {
    // Load theme translations
    load_theme_textdomain( PANDAGO_TD, PATH_PANDAGO . '/languages' );

    // Add support for menus if not already enabled
    add_theme_support( 'menus' );

    // Add support for post thumbnails in posts and pages
    add_theme_support( 'post-thumbnails' );

    // Add support for title tag and let Wordpress manage it without hardcoded <title>
    add_theme_support( 'title-tag' );

    // Add support for widgets.
    add_theme_support( 'widgets' );

    // Add support for Block Styles.
    add_theme_support( 'wp-block-styles' );

    // Add support for full and wide align images.
    add_theme_support( 'align-wide' );

    // Add support for editor styles.
    add_theme_support( 'editor-styles' );

    // Add support for responsive embedded content.
    add_theme_support( 'responsive-embeds' );
  }
endif;
add_action( 'after_setup_theme', 'pandago_setup' );

/**
 * Removes WP injected embed scripts.
 * 
 * @since 1.0.0
 */
function remove_wp_scripts() {
  if ( ! is_admin() ) {
    wp_deregister_script( 'wp-embed' );
  }
}
add_action( 'init', 'remove_wp_scripts' );

/**
 * Removes WP dashicons stylesheet.
 * 
 * @since 1.0.0
 */
function pandago_deregister_styles()    { 
  if ( ! is_admin() ) {
    wp_deregister_style( 'dashicons' ); 
  }
}
add_action( 'wp_print_styles', 'pandago_deregister_styles', 100 );

/**
 * Remove invalid rel attribute values in the categorylist.
 * 
 * @since 1.0.0
 */
function remove_category_rel_from_category_list( $thelist ) {
  return str_replace( 'rel="category tag"', 'rel="tag"', $thelist );
}
add_filter( 'the_category', 'remove_category_rel_from_category_list' );

/**
 * Removes admin bar from frontpage.
 * 
 * @since 1.0.0
 */
function remove_admin_bar() {
  return false;
}
add_filter( 'show_admin_bar', 'remove_admin_bar' );

/**
 * Remove wp_head() injected recent Comment styles.
 * 
 * @since 1.0.0
 */
function theme_remove_recent_comments_style() {
  global $wp_widget_factory;

  remove_action( 'wp_head',
    array(
      $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
      'recent_comments_style'
    )
  );
}
add_action( 'widgets_init', 'theme_remove_recent_comments_style' );

/**
 * Remove 'text/css' from enqueued stylesheet.
 * 
 * @since 1.0.0
 */
function html5_style_remove( $tag ) {
  return preg_replace( '~\s+type=["\'][^"\']++["\']~', '', $tag );
}
add_filter( 'style_loader_tag', 'html5_style_remove' );

/**
 * Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail.
 * 
 * @since 1.0.0
 */
function remove_thumbnail_dimensions( $html ) {
  $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
  return $html;
}
add_filter( 'post_thumbnail_html',  'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

/**
 * Adds class to empty paragraphs from the_content() function.
 * 
 * @since 1.0.0
 */
function empty_paragraph_class( $content ) {
  return str_replace( '<p>&nbsp;</p>','<p class="empty-paragraph">&nbsp;</p>', $content );
}
add_filter( 'the_content','empty_paragraph_class', 100 );

/**
 * Wraps embeded iframes with <div> element for styling purposes.
 * 
 * @since 1.0.0
 */
function wrap_embed_with_div( $html, $url, $attr ) {
  return '<div class="embed-container-outer"><div class="embed-container">' . $html . '</div></div>';
}
add_filter( 'embed_oembed_html', 'wrap_embed_with_div', 10, 3 );

/**
 * Adds support for SVG upload 
 * 
 * @since 1.0.0
 */
function cc_mime_types( $mimes ) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

/**
 * Increase Gutenbers editors width in admin panel.
 * 
 * @since 1.0.0
 */
function gutenberg_width() {
  echo '<style>
    .wp-block { max-width: 1200px; }
  </style>';
}
add_action( 'admin_head', 'gutenberg_width' );

/**
 * Add blog id to body class if multisite.
 * 
 * @since 1.0.0
 */
function pandago_body_classes( $classes ) {
  if ( is_multisite() ) {
    $classes[] = 'multisite-enabled';
    $classes[] = 'multisite-site-' . get_current_blog_id();
  }

  return $classes;
}
add_filter( 'body_class', 'pandago_body_classes' );

// Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links_extra', 3 );

// Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'feed_links', 2 );

// Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'rsd_link' );

// Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'wlwmanifest_link' );

// Remove index link
remove_action( 'wp_head', 'index_rel_link' ); 

// Remove prev link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); 

// Remove start link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );

// Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );

// Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action( 'wp_head', 'wp_generator' );

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

// Remove emoji scripts and styles
remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); 
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Allow shortcodes in Dynamic Sidebar
add_filter( 'widget_text', 'do_shortcode' ); 

// Remove <p> tags in Dynamic Sidebars (better!)
add_filter( 'widget_text', 'shortcode_unautop' );

// Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter( 'the_excerpt', 'shortcode_unautop' );

// Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter( 'the_excerpt', 'do_shortcode' );

// Remove <p> tags from Excerpt altogether
remove_filter( 'the_excerpt', 'wpautop' );

// Disallows WP to convert quotes inside the_content() function. Removeing this because it breaks output from json_encode() inside the_content().
remove_filter( 'the_content', 'wptexturize' );

// Disable oEmbed API
function disable_embeds_code_init() {

  // Remove the REST API endpoint.
  remove_action( 'rest_api_init', 'wp_oembed_register_route' );
 
  // Turn off oEmbed auto discovery.
  add_filter( 'embed_oembed_discover', '__return_false' );
 
  // Don't filter oEmbed results.
  remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
 
  // Remove oEmbed discovery links.
  remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
 
  // Remove oEmbed-specific JavaScript from the front-end and back-end.
  remove_action( 'wp_head', 'wp_oembed_add_host_js' );
  add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );
 
  // Remove all embeds rewrite rules.
  add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
 
  // Remove filter of the oEmbed result before any HTTP requests are made.
  remove_filter( 'pre_oembed_result', 'wp_filter_pre_oembed_result', 10 );
}

if ( function_exists( 'get_field' ) && get_field( 'developers_disable_oembed_api', 'option' ) ) {
  add_action( 'init', 'disable_embeds_code_init', 9999 );
}
 
function disable_embeds_tiny_mce_plugin($plugins) {
    return array_diff($plugins, array('wpembed'));
}
 
function disable_embeds_rewrites($rules) {
    foreach($rules as $rule => $rewrite) {
        if(false !== strpos($rewrite, 'embed=true')) {
            unset($rules[$rule]);
        }
    }
    return $rules;
}
?>