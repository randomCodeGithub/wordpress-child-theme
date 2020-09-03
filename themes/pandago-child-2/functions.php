<?php

define('TD', 'pandago-child');

function my_styles()
{
  wp_enqueue_style('child-style', URL_THEME . '/assets/css/style.css', array(), wp_get_theme()->get('Version'));
}
add_action('wp_enqueue_scripts', 'my_styles');

function register_theme_nav()
{
  register_nav_menus(
    array(
      'header-nav'  => __('Header Navigation', TD),
      'sidebar-nav' => __('Sidebar Navigation', TD),
      'footer-nav'  => __('Footer Navigation', TD)
    )
  );
}


function themename_custom_logo_setup()
{
  $defaults = array(
    'height'      => 96,
    'width'       => 159,
    'flex-height' => false,
    'flex-width'  => false,
    'header-text' => array('site-title', 'site-description'),
  );
  add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'themename_custom_logo_setup');

add_action('wp_enqueue_scripts', 'sparkle_project_scripts_include');

function sparkle_project_scripts_include()
{
  wp_enqueue_style('bootstraps_css',   '//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
  wp_enqueue_script('bootstraps_script', '//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js');
  wp_enqueue_style('awesone.css', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('fonts_default', '//fonts.googleapis.com/css?family=Montserrat:400,700');
  wp_enqueue_style('fonts_oswald', 'https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap');
  wp_enqueue_style('style', get_stylesheet_directory_uri() . '/style.css');
  wp_enqueue_style('block-testimonial', get_stylesheet_directory_uri() . '/template-parts/block/testimonial.css');

  wp_enqueue_script('scripts_theme', get_stylesheet_directory_uri() . '/assets/theme.js',   array(), '20151215', true);
  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }
}

// ACF Custom Blocks **************************************************************************************
function register_acf_block_types()
{
  // register a testimonial block.
  acf_register_block_type(array(
    'name'              => 'testimonial',
    'title'             => __('Testimonial'),
    'description'       => __('A custom testimonial block.'),
    'render_template'   => 'template-parts/block/content-testimonial.php',
    'category'          => 'formatting',
    'align'             => 'full',
    'icon'              => 'admin-comments',
    'mode'              => 'preview',
    'keywords'          => array('testimonial', 'quote'),
  ));

  acf_register_block_type(array(
    'name'              => 'section-text',
    'title'             => __('Section text'),
    'description'       => __('A custom section text block.'),
    'render_template'   => 'template-parts/block/section-text/section-text.php',
    'category'          => 'formatting',
    'icon'              => 'admin-comments',
    'mode'              => 'preview',
    'keywords'          => array('section-text', 'quote'),
  ));

  acf_register_block_type(array(
    'name'              => 'preview',
    'title'             => __('Preview to video'),
    'description'       => __('Preview to video.'),
    'render_template'   => 'template-parts/block/preview/preview.php',
    'category'          => 'formatting',
    'icon'              => 'admin-comments',
    'keywords'          => array('preview', 'quote'),
  ));

  acf_register_block_type(array(
    'name'              => 'gallery-1',
    'title'             => __('Photo gallery 1'),
    'description'       => __('photo gallery'),
    'render_template'   => 'template-parts/block/gallery/first-gallery.php',
    'category'          => 'formatting',
    'icon'              => 'admin-comments',
    'keywords'          => array('gallery-1', 'quote'),
  ));

  acf_register_block_type(array(
    'name'              => 'gallery-2',
    'title'             => __('Photo gallery 2'),
    'description'       => __('photo gallery 2'),
    'render_template'   => 'template-parts/block/gallery/second-gallery.php',
    'category'          => 'formatting',
    'icon'              => 'admin-comments',
    'keywords'          => array('gallery-2', 'quote'),
  ));

  acf_register_block_type(array(
    'name'              => 'choice-section',
    'title'             => __('Choice section'),
    'description'       => __('Choice between links'),
    'render_template'   => 'template-parts/block/choice/choice.php',
    'category'          => 'formatting',
    'icon'              => 'admin-comments',
    'keywords'          => array('choice-section', 'quote'),
  ));

  acf_register_block_type(array(
    'name'              => 'choice-section-2',
    'title'             => __('Choice section 2'),
    'description'       => __('Choice between links with images'),
    'render_template'   => 'template-parts/block/choice/choice-2.php',
    'category'          => 'formatting',
    'icon'              => 'admin-comments',
    'keywords'          => array('choice-section-2', 'quote'),
  ));

  acf_register_block_type(array(
    'name'              => 'choice-section-3',
    'title'             => __('Choice section 3'),
    'description'       => __('Choice between links with images'),
    'render_template'   => 'template-parts/block/choice/choice-3.php',
    'category'          => 'formatting',
    'icon'              => 'admin-comments',
    'keywords'          => array('choice-section-3', 'quote'),
  ));

  acf_register_block_type(array(
    'name'              => 'supporters',
    'title'             => __('Supporters'),
    'description'       => __('supporters'),
    'render_template'   => 'template-parts/block/supporters/supporters.php',
    'category'          => 'formatting',
    'icon'              => 'admin-comments',
    'keywords'          => array('supporters', 'quote'),
  ));

  acf_register_block_type(array(
    'name'              => 'page-description',
    'title'             => __('Page description'),
    'description'       => __('Description for a page'),
    'render_template'   => 'template-parts/block/page-description/page-description.php',
    'category'          => 'formatting',
    'icon'              => 'admin-comments',
    'keywords'          => array('page-description', 'quote'),
  ));

  acf_register_block_type(array(
    'name'              => 'section-description',
    'title'             => __('Section description'),
    'description'       => __('Description for a section'),
    'render_template'   => 'template-parts/block/page-description/section-description.php',
    'category'          => 'formatting',
    'icon'              => 'admin-comments',
    'keywords'          => array('section-description', 'quote'),
  ));

  acf_register_block_type(array(
    'name'              => 'photo-and-text-section',
    'title'             => __('Photo & text section'),
    'description'       => __('Photo & text section'),
    'render_template'   => 'template-parts/block/text-with-photo/photo-and-text-section.php',
    'category'          => 'formatting',
    'icon'              => 'admin-comments',
    'keywords'          => array('photo-and-text-section', 'quote'),
  ));

  acf_register_block_type(array(
    'name'              => 'quote-section',
    'title'             => __('Quote section'),
    'description'       => __('Quote section'),
    'render_template'   => 'template-parts/block/quote/quote-section.php',
    'category'          => 'formatting',
    'icon'              => 'admin-comments',
    'keywords'          => array('quote-section', 'quote'),
  ));

  acf_register_block_type(array(
    'name'              => 'quote-section-2',
    'title'             => __('Quote section 2'),
    'description'       => __('Quote section 2'),
    'render_template'   => 'template-parts/block/quote/quote-section-2.php',
    'category'          => 'formatting',
    'icon'              => 'admin-comments',
    'keywords'          => array('quote-section-2', 'quote'),
  ));

  acf_register_block_type(array(
    'name'              => 'text-with-photo',
    'title'             => __('Text with photo'),
    'description'       => __('Text with photo'),
    'render_template'   => 'template-parts/block/text-with-photo/text-with-photo.php',
    'category'          => 'formatting',
    'icon'              => 'admin-comments',
    'keywords'          => array('text-with-photo', 'quote'),
  ));

  acf_register_block_type(array(
    'name'              => 'team-gallery',
    'title'             => __('Team gallery'),
    'description'       => __('Team gallery'),
    'render_template'   => 'template-parts/block/team-gallery/team-gallery.php',
    'category'          => 'formatting',
    'icon'              => 'admin-comments',
    'keywords'          => array('team-gallery', 'quote'),
  ));

  acf_register_block_type(array(
    'name'              => 'stories',
    'title'             => __('Stories'),
    'description'       => __('Stories block gallery'),
    'render_template'   => 'template-parts/block/stories/stories.php',
    'category'          => 'formatting',
    'icon'              => 'admin-comments',
    'keywords'          => array('stories', 'quote'),
  ));

  
}
// Check if function exists and hook into setup.
if (function_exists('acf_register_block_type')) {
  add_action('acf/init', 'register_acf_block_types');
}

function pandago_widgets_init()
{
  register_sidebar(array(
    'name' => esc_html('Sidebar', 'pandago-child'),
    'id' => 'sidebar-1',
    'description' => '',
    'before_widget' => '<div id="%1$s" class="widget sidebar-1 w-100 %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
  ));
  register_sidebar(array(
    'name' => 'Footer Sidebar 1',
    'id' => 'footer-sidebar-1',
    'description' => 'Footer logo',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ));
  register_sidebar(array(
    'name' => 'Footer Sidebar 2',
    'id' => 'footer-sidebar-2',
    'description' => 'Appears in the footer area',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ));
  register_sidebar(array(
    'name' => 'Footer Sidebar 3',
    'id' => 'footer-sidebar-3',
    'description' => 'Appears in the footer area',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ));
  register_sidebar(array(
    'name' => 'Footer copyright 1',
    'id' => 'footer-sidebar-4',
    'description' => 'Appears in the footer area',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ));
  register_sidebar(array(
    'name' => 'Footer copyright 2',
    'id' => 'footer-sidebar-5',
    'description' => 'Appears in the footer area',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ));
}

add_action('widgets_init', 'pandago_widgets_init');

function my_mce4_options($init)
{
  $custom_colours = '
      "000000", "Black",
      "993300", "Burnt orange",
      "333300", "Dark olive",
      "003300", "Dark green",
      "003366", "Dark azure",
      "000080", "Navy Blue",
      "333399", "Indigo",
      "333333", "Very dark gray",
      "800000", "Maroon",
      "FF6600", "Orange",
      "808000", "Olive",
      "008000", "Green",
      "008080", "Teal",
      "0000FF", "Blue",
      "666699", "Grayish blue",
      "808080", "Gray",
      "FF0000", "Red",
      "FF9900", "Amber",
      "99CC00", "Yellow green",
      "339966", "Sea green",
      "33CCCC", "Turquoise",
      "3366FF", "Royal blue",
      "800080", "Purple",
      "999999", "Medium gray",
      "FF00FF", "Magenta",
      "FFCC00", "Gold",
      "FFFF00", "Yellow",
      "00FF00", "Lime",
      "00FFFF", "Aqua",
      "00CCFF", "Sky blue",
      "993366", "Red violet",
      "FF99CC", "Pink",
      "FFCC99", "Peach",
      "FFFF99", "Light yellow",
      "CCFFCC", "Pale green",
      "CCFFFF", "Pale cyan",
      "99CCFF", "Light sky blue",
      "CC99FF", "Plum",

      "2F4858", "#2F4858", //custom
      "FFA800", "#FFA800", //custom
      "FFCB66", "#FFCB66", //custom
      "FFFFFF", "#FFFFFF",  //custom
    ';
  // build colour grid default+custom colors
  $init['textcolor_map'] = '[' . $custom_colours . ']';
  // change the number of rows in the grid if the number of colors changes
  // 8 swatches per row
  $init['textcolor_rows'] = 10;
  return $init;
}
add_filter('tiny_mce_before_init', 'my_mce4_options');
