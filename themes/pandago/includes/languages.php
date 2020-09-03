<?php
/**
 * Outputs language switcher markup.
 * 
 * @since 1.0.0
 * @since 1.0.8 Added 'hreflang' attribute.
 */
if ( ! function_exists( 'language_switcher' ) ) {
  function language_switcher( $display = 'code', $active_first = false ) {
    $languages = icl_get_languages('skip_missing=0');

    echo '<ul class="language-switcher flex">';

    if ( $active_first ) {
      foreach ( $languages as $language ) {
        if ( $language['active'] == 1 ) {
          echo '<li class="active">';
          echo '<a href="' . $language[ 'url' ] . '" hreflang="' . $language['code'] . '">' . $language[ $display ] . '</a>';
          echo '</li>';
        }
      }
    
      foreach ( $languages as $language ) {
        if ( $language['active'] != 1 ) {
          echo '<li>';
          echo '<a href="' . $language[ 'url' ] . '" hreflang="' . $language['code'] . '">' . $language[ $display ] . '</a>';
          echo '</li>';
        }
      }
    } else {
      foreach ( $languages as $language ) {
        if ( $language['active'] == 1 ) {
          echo '<li class="active">';
          echo '<a href="' . $language[ 'url' ] . '" hreflang="' . $language['code'] . '">' . $language[ $display ] . '</a>';
          echo '</li>';
        } else {
          echo '<li>';
          echo '<a href="' . $language[ 'url' ] . '" hreflang="' . $language['code'] . '">' . $language[ $display ] . '</a>';
          echo '</li>';
        }
      }
    }
  
    echo '</ul>';
  }
}
?>