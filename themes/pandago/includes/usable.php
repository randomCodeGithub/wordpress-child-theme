<?php
/**
 * get_media_url
 *
 * Retrieves an url to given attachment.
 *
 * @since 1.0.0
 * 
 * @param mixed  $id attachment id
 * @param string $size attachment thumbnail size, defaults to 'full'
 *
 * @return string url to attachment
 */
function get_media_url( $id, $size = 'full' ) {
  if ( is_array( $id ) ) {
    $id = $id['ID'];
  }

  $image_array = wp_get_attachment_image_src( $id, $size );

  return $image_array[0];
}

/**
 * Outputs an excerpt from the current post (must be used inside loop).
 * Excerpt is either taken from excerpt field if provided or trimmed
 * from content itself.
 * 
 * @since 1.0.0
 *
 * @param string $length_callback Callback function for excerpt length
 * @param string $more_callback Callback function for read more after the excerpt
 */
function pandago_excerpt( $length_callback = 'sem_excerpt_length_short', $more_callback = 'sem_excerpt_more' ) {
  if ( function_exists( $length_callback ) )
    add_filter( 'excerpt_length', $length_callback );

  if ( function_exists($more_callback) )
    add_filter( 'excerpt_more', $more_callback );

  $output = trim( get_the_excerpt() );
  $output = apply_filters( 'wptexturize', $output );
  $output = apply_filters( 'convert_chars', $output );
  $output = '<p>' . $output . '</p>';

  echo $output;
}

/**
 * Default callback functions for sem_excerpt to set excerpt length, used like:
 * pandago_excerpt('pandago_excerpt_length_short')
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'pandago_excerpt_length_short' ) ) {
  // Returns 20 words from excerpt or content
  function pandago_excerpt_length_short( $length ) {
    return 20;
  }
}

if ( ! function_exists( 'pandago_excerpt_length_medium' ) ) {
  // Returns 30 words from excerpt or content
  function pandago_excerpt_length_medium( $length ) {
    return 30;
  }
}

if ( ! function_exists( 'pandago_excerpt_length_long' ) ) {
  // Returns 40 words from excerpt or content
  function sem_excerpt_length_long( $length ) {
    return 40;
  }
}

/**
 * Default callback functions for sem_excerpt to set read more style, used like:
 * pandago_excerpt('length_function', 'pandago_excerpt_more_none');
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'pandago_excerpt_more_none' ) ) {
  // Removes everything after excerpt
  function pandago_excerpt_more_none() {
    return '';
  }
}

if ( ! function_exists( 'pandago_excerpt_more_dots' ) ) {
  // Adds 3 dots after excerpt if excerpt word counts exceeds the one specified
  function pandago_excerpt_more_dots() {
    return '...';
  }
}

if ( ! function_exists( 'pandago_excerpt_more_link' ) ) {
  // Adds read more links after excerpt if excerpt word counts exceeds the one specified
  function pandago_excerpt_more_link() {
    return '<span class="read-more-wrap"><a class="read-more" href="' . get_the_permalink() . '">' . __('Lasīt vairāk', TD) . '</a></span>';
  }
}

/**
 * Outputs fully prepared img tag with needed attributes.
 * 
 * @since 1.0.0
 * @since 1.0.1.4 Added $title_attr argument.
 * @since 1.0.4 Added possibility to pass an URL as an argument
 * 
 * @param mixed $image Either image object array or image id.
 * @param string $size Previously defined WP image size, defaults to 'full'.
 * @param string $class Class to add to 'img' tag.
 * @param boolean $title_attr Whether to add title attribute to the image tag. Defaults to false.
 * @param boolean $echo Whether to output the tag or return it. Defaults to true.
 * 
 * @return string Image markup.
 */
if ( ! function_exists( 'pandago_img' ) ) {
  function pandago_img( $image, $size = 'full', $class = '', $title_attr = false, $echo = true ) {
    if ( ! is_array( $image ) ) {
      if ( filter_var($image, FILTER_VALIDATE_URL) === false ) {
        $id = $image;
        $image = array(
          'ID' => $id
        );
        $src_val = get_media_url( $image['ID'], $size );
      } else {
        $src_val = $image;
        $image = array(
          'title' => '',
          'alt' => ''
        );
      }
    } else {
      $src_val = get_media_url( $image['ID'], $size );
    }

    $src = 'src';

    if ( strpos( $class, 'js-lazy' ) !== false ) {
      $src = 'data-src';
    }

    if ( ! $title_attr ) {
      $image['title'] = '';
    }

    if ( $echo  ) {
      echo '<img class="' . $class . '" ' . $src . '="' . $src_val . '" title="' . $image['title'] . '" alt="' . $image['alt'] . '">';
    } else {
      return '<img class="' . $class . '" ' . $src . '="' . $src_val . '" title="' . $image['title'] . '" alt="' . $image['alt'] . '">';
    }
  }
}

/**
 * Outputs a pagination.
 * 
 * @since 1.0.0
 * 
 * @param object $custom_query Query to paginate.
 * @param array $strings Strings used for navigation.
 */
function pandago_pager( $custom_query, $strings = false ) {
  if ( ! $strings ) {
    $strings = array(
      'first' => '&laquo;',
      'prev' => '&lsaquo;',
      'last' => '&raquo;',
      'next' => '&rsaquo;'
    );
  }

  $range = 2;
  $showitems = ( $range * 2 ) + 1;  

  global $paged;
  if ( empty( $paged ) ) $paged = 1;


  $pages = $custom_query->max_num_pages;
  if ( ! $pages ) {
    $pages = 1;
  }

  if ( 1 != $pages ) {
    echo '<ul class="pager">';

    if ( $paged > 1 ) {
      if ( isset( $strings['first'] ) && ! empty( $strings['first'] ) ) {
        echo '<li class="pager-arrow pager-first">';
        echo '<a href="' . get_pagenum_link( 1 ) . '">' . $strings['first'] . '</a>';
        echo '</li>';
      }

      if ( isset( $strings['prev'] ) && ! empty( $strings['prev'] ) ) {
        echo '<li class="pager-arrow pager-prev">';
        echo '<a href="' . get_pagenum_link( $paged - 1 ) . '">' . $strings['prev'] . '</a>';
        echo '</li>';
      }
    }

    for ( $i = 1; $i <= $pages; $i++ ) {
      if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
        echo ( $paged == $i ) ? '<li class="pager-item current"><span data-page="' . $i . '">' . $i . '</span></li>' : '<li class="pager-item"><a href="' . get_pagenum_link( $i ) . '" data-page="' . $i . '">' . $i . '</a></li>';
      }
    }

    if ($paged < $pages ) {
      if ( isset( $strings['next'] ) && ! empty( $strings['next'] ) ) {
        echo '<li class="pager-arrow pager-next">';
        echo '<a href="' . get_pagenum_link( $paged + 1 ) . '">' . $strings['next'] . '</a>';  
        echo '</li>';
      }

      if ( isset( $strings['last'] ) && ! empty( $strings['last'] ) ) {
        echo '<li class="pager-arrow pager-last">';
        echo '<a href="' . get_pagenum_link( $pages ) . '">' . $strings['last'] . '</a>';  
        echo '</li>';
      }
    }

    echo '</ul>';
  }
}

/**
 * Email validation.
 * 
 * @since 1.0.0
 * 
 * @param string $email
 * 
 * @return boolean
 */
if ( ! function_exists( 'pandago_validate_email' ) ) {
  function pandago_validate_email( $email ) {
    return filter_var( $email, FILTER_VALIDATE_EMAIL ) && preg_match( '/@.+\./', $email );
  }
}

/**
 * Phone number validation.
 * 
 * @since 1.0.0
 * 
 * @param string $phone
 * 
 * @return boolean
 */
if ( ! function_exists( 'pandago_validate_phone' ) ) {
  function pandago_validate_phone( $phone ) {
    return preg_match( '/^[\s()+-]*([0-9][\s()+-]*){6,20}$/', $phone );
  }
}

/**
 * Date validation.
 * 
 * @since 1.0.0
 * 
 * @param string $date
 * @param string $format
 * 
 * @return boolean
 */
if ( ! function_exists( 'pandago_validate_date' ) ) {
  function pandago_validate_date( $date, $format = 'd.m.Y' ) {
    $d = DateTime::createFromFormat($format, $date);

    return $d && $d->format($format) === $date;
  }
}

/**
 * URL validation.
 * 
 * @since 1.0.0
 * 
 * @param string $url
 * 
 * @return boolean
 */
if ( ! function_exists( 'pandago_validate_url' ) ) {
  function pandago_validate_url( $url ) {
    return filter_var( $url, FILTER_VALIDATE_URL );
  }
}

/**
 * Gets page template name from page ID.
 * 
 * @since 1.0.0
 * 
 * @param string|integer $id
 * 
 * @return string
 */
if ( ! function_exists( 'get_template_name' ) ) {
  function get_template_name( $id ) {
    return str_replace( '.php', '', basename( get_page_template_slug( $id ) ) );
  }
}

/**
 * Load more posts.
 * 
 * @since 1.0.0
 * @since 1.0.5 Fixed to not output wrap if it's not passed
 */
function pandago_load_more() {
  $check_args = $_POST['args'];
  $check_args['posts_per_page']++;
  $check_query = new WP_Query( $check_args );
  wp_reset_postdata();

  $args = $_POST['args'];
  $query = new WP_Query( $args );

  $wrap_class = '';

  if ( ! empty( $_POST['wrap_class'] ) ) {
    $wrap_class = 'class="' . $_POST['wrap_class'] . '"';
  }

  if ( $query->have_posts() ) {
    if ( $check_query->post_count <= $args['posts_per_page'] ) {
      echo '<div class="no-more-posts">';
    } else {
      echo '<div>';
    }

    while ( $query->have_posts() ) {
      $query->the_post();

      if ( !empty( $_POST['wrap'] ) )
        echo '<' . $_POST['wrap'] . ' ' . $wrap_class . '>';

      get_template_part( $_POST['template'] );

      if ( !empty( $_POST['wrap'] ) )
        echo '</' . $_POST['wrap'] . '>';
    }
    wp_reset_postdata();

    echo '</div>';
  }

  exit;
}
add_action('wp_ajax_nopriv_pandago_load_more', 'pandago_load_more');
add_action('wp_ajax_pandago_load_more', 'pandago_load_more');


/**
 * Slugifies a word.
 * 
 * @since 1.0.0
 * 
 * @param string $str String to slugify.
 * @param array $options Additional options.
 * 
 * @return string
 */
function pandago_slugify( $str, $options = array() ) {
  $str = strip_tags($str);
	// Make sure string is in UTF-8 and strip invalid UTF-8 characters
	$str = mb_convert_encoding( (string) $str, 'UTF-8', mb_list_encodings() );
	
	$defaults = array(
		'delimiter' => '-',
		'limit' => null,
		'lowercase' => true,
		'replacements' => array(),
		'transliterate' => true,
	);
	
	// Merge options
	$options = array_merge($defaults, $options);
	
	$char_map = array(
		// Latin
		'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 
		'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 
		'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O', 
		'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH', 
		'ß' => 'ss', 
		'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 
		'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 
		'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o', 
		'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th', 
		'ÿ' => 'y',
		// Latin symbols
		'©' => '(c)',
		// Greek
		'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
		'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
		'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
		'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
		'Ϋ' => 'Y',
		'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
		'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
		'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
		'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
		'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
		// Turkish
		'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
		'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g', 
		// Russian
		'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
		'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
		'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
		'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
		'Я' => 'Ya',
		'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
		'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
		'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
		'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
		'я' => 'ya',
		// Ukrainian
		'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
		'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
		// Czech
		'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U', 
		'Ž' => 'Z', 
		'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
		'ž' => 'z', 
		// Polish
		'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z', 
		'Ż' => 'Z', 
		'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
		'ż' => 'z',
		// Latvian
		'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N', 
		'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
		'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
		'š' => 's', 'ū' => 'u', 'ž' => 'z'
	);
	
	// Make custom replacements
	$str = preg_replace( array_keys( $options['replacements']), $options['replacements'], $str );
	
	// Transliterate characters to ASCII
	if ( $options['transliterate'] ) {
		$str = str_replace( array_keys( $char_map ), $char_map, $str );
	}
	
	// Replace non-alphanumeric characters with our delimiter
	$str = preg_replace( '/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str );
	
	// Remove duplicate delimiters
	$str = preg_replace( '/(' . preg_quote( $options['delimiter'], '/') . '){2,}/', '$1', $str );
	
	// Truncate slug to max. characters
	$str = mb_substr( $str, 0, ( $options['limit'] ? $options['limit'] : mb_strlen( $str, 'UTF-8') ), 'UTF-8' );
	
	// Remove delimiter from ends
	$str = trim( $str, $options['delimiter'] );
	
	return $options['lowercase'] ? mb_strtolower( $str, 'UTF-8' ) : $str;
}



/**
 * Gets first X words from a string.
 * 
 * @since 1.0.2.4
 * @since 1.0.7 Added possibility to add dots at the end of the string via $dots parameter and possibility to choose mode
 * 
 * @param string $str
 * @param integer $count
 * @param string $dots
 * @param string $mode simple/smart/letters
 * 
 * @return string
 */

function pdg_get_words($str, $count = 10, $dots = false, $mode = 'simple') {
  $str = trim( strip_tags($str) );
  $words = '';

  /*
   * Determine mode:
   * - simple: returns first $count words which are simply separated with spaces
   * - smart: returns first $count words separated with spaces, commas and dots
   * - letters: returns first $count letters
   */

  switch ( $mode ) {

    case 'simple':
      $words = implode( ' ', array_slice( explode(' ', $str), 0, $count + 1) );
      break;

    case 'smart':
      preg_match("/(?:\w+(?:\W+|$)){0,$count}/", $str, $matches );
      $words = $matches[0];
      break;

    case 'letters':
      $words = mb_substr( $str, 0, $count );
      break;

  }

  $words = trim( $words );

  if ( $dots ) {
    $words .= $dots;
  }

  return $words;
}



/**
 * Splits given array in half.
 * 
 * @since 1.0.12
 * 
 * @param array $array
 * @param boolean $first_larger If array can't be split in equal parts, makes the first part larger if true
 * 
 * @return array Returns multidimensional array containing both parts
 */

function split_array_in_half( $array, $first_larger = true ) {
  $count = count( $array );
  $half_1 = ( $first_larger ) ? array_slice( $array, 0, round( $count / 2 ) ) : array_slice( $array, 0, floor( $count / 2 ) );
  $half_2 = array_slice( $array, count( $half_1 ) );

  $return = array(
      'first' => $half_1,
      'second' => $half_2
  );

  return $return;
}
?>