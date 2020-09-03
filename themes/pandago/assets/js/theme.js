/* Configuration for cookies plugin */
var gaTrackingID = pandago_php_vars.ga_tracking_id;
var messageText = pandago_php_vars.strings.cookies_message;
var allowText = pandago_php_vars.strings.cookies_allow;
var denyText = pandago_php_vars.strings.cookies_deny;
var linkText = pandago_php_vars.strings.cookies_learn_more;
var hrefToPrivacyPolicy = pandago_php_vars.strings.cookies_link;
var gaScriptAdded = false;

// enable cookies function
function enableCookies() {
  // add google analytics script if it has not been added before
  if( gaScriptAdded == false ) {
    var googleAnalytics = document.createElement("script");
    googleAnalytics.innerHTML = "(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');ga('create', '"+gaTrackingID+"', 'auto');ga('send', 'pageview');";
    document.head.appendChild(googleAnalytics);
  } else /* if google analytics script is already added, reload the page */ {
    location.reload();
  }
  gaScriptAdded = true;
}

// delete cookies function
window.cookieconsent.Popup.prototype.deleteCookies = function() {
  // list of essential cookies - set as an empty array to delete everything - i.e. var essential = [];
  var essential = ["cookieconsent_status"];

  // list of cookies with specific domain name that should be specified for deletion
  var cookiesWithDomain = ["_ga", "_gid", "_gat"];
  var theDomain = pandago_php_vars.host;

  // create array of cookies set
  var cookies = document.cookie.split(";");

  // loop through the cookies
  for (var i = 0; i < cookies.length; i++) {
    var cookie = cookies[i];

    // remove spaces at the beginning of cookie name
    while (cookie.charAt(0)==' ') {
        cookie = cookie.substring(1,cookie.length);
    }

    // get the cookie name
    var eqPos = cookie.indexOf("=");
    var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;

    // delete all cookies except those listed in essential
    if (essential === undefined || essential.length == 0 || essential.indexOf(name) == -1) {
      // note assuming path is always = '/'

      // set specific domain for previously defined cookies in "cookiesWithDomain". Do not set domain for others
      if (cookiesWithDomain === undefined || cookiesWithDomain.length == 0 || cookiesWithDomain.indexOf(name) == -1) {
          document.cookie = name + "=;  path=/; expires=Thu, 01 Jan 1970 00:00:00 GMT;";
      } else {
          document.cookie = name + "=;  path=/; domain="+theDomain+"; expires=Thu, 01 Jan 1970 00:00:00 GMT;";
      }
    }
  }

};

window.addEventListener("load", function() {
  window.cookieconsent.initialise({
      "position": pandago_php_vars.cookies_position,
      "type": "opt-in",
      "revokable": true,
      content: {
        message: messageText,
        allow: allowText,
        deny: denyText,
        link: linkText,
        href: hrefToPrivacyPolicy,
      },

      onInitialise: function (status) {
        var type = this.options.type;
        var didConsent = this.hasConsented();
          var x = document.cookie;
        if (type == 'opt-in' && didConsent) {
          enableCookies();
        }
      },

      onStatusChange: function(status, chosenBefore) {
        var type = this.options.type;
        var didConsent = this.hasConsented();
        if (type == 'opt-in' && didConsent) {
          enableCookies();
        }
      },

      onRevokeChoice: function() {
        var type = this.options.type;
        if (type == 'opt-in') {
          this.deleteCookies();
        }
      }
  });
});



/*
 * Browser checks
 */

if ( pandago_php_vars.browsers.length > 0 ) {
  var condTests = {};

  for ( var i = 0; i < pandago_php_vars.browsers.length; i++ ) {
    condTests[pandago_php_vars.browsers[i]] = ['class'];

    if ( pandago_php_vars.browsers[i] == 'ie10' ) {
      conditionizr.add('ie10', !!(Function('/*@cc_on return document.documentMode===10@*/')()));
      continue;
    }
    if ( pandago_php_vars.browsers[i] == 'ie11' ) {
      conditionizr.add('ie11', /(?:\sTrident\/7\.0;.*\srv:11\.0)/i.test(navigator.userAgent));
      continue;
    }
    if ( pandago_php_vars.browsers[i] == 'edge' ) {
      conditionizr.add('edge', /edge\//i.test(navigator.userAgent));
      continue;
    }
    if ( pandago_php_vars.browsers[i] == 'chrome' ) {
      conditionizr.add('chrome', !!window.chrome && /google/i.test(navigator.vendor));
      continue;
    }
    if ( pandago_php_vars.browsers[i] == 'firefox' ) {
      conditionizr.add('firefox', 'InstallTrigger' in window);
      continue;
    }
    if ( pandago_php_vars.browsers[i] == 'opera' ) {
      conditionizr.add('opera', !!window.opera || /opera/i.test(navigator.vendor));
      continue;
    }
    if ( pandago_php_vars.browsers[i] == 'safari' ) {
      conditionizr.add('safari', function () {
        return (
          /Constructor/.test(window.HTMLElement) || 
          (function (root) {
            return (!root || root.pushNotification).toString() === '[object SafariRemoteNotification]';
          })(window.safari)
        );
      });
      continue;
    }
    if ( pandago_php_vars.browsers[i] == 'ios' ) {
      conditionizr.add('ios', /iP(ad|hone|od)/i.test(navigator.userAgent));
      continue;
    }
    if ( pandago_php_vars.browsers[i] == 'android' ) {
      conditionizr.add('android', /android/i.test(navigator.userAgent));
      continue;
    }
    if ( pandago_php_vars.browsers[i] == 'touch' ) {
      conditionizr.add('touch', 'ontouchstart' in window || !!navigator.msMaxTouchPoints);
      continue;
    }
  }

  conditionizr.config({
    tests: condTests
  });
}

function addBrowserNoticeClass() {
  if ( ! getCookie( 'hide_browser_notice' ) ) {
    jQuery( 'html' ).addClass( 'show-browser-notice' );
  }
}

if ( pandago_php_vars.browsers_notice.length > 0 ) {
  for ( var i = 0; i < pandago_php_vars.browsers_notice.length; i++ ) {

    switch ( pandago_php_vars.browsers_notice[i] ) {
      case 'ie6':
        conditionizr.add('ie6', !!(Function('/*@cc_on return (@_jscript_version == 5.6 || (@_jscript_version == 5.7 && /MSIE 6\.0/i.test(navigator.userAgent))); @*/')()));
        break;

      case 'ie7':
        conditionizr.add('ie7', !!(Function('/*@cc_on return (@_jscript_version == 5.7 && /MSIE 7\.0(?!.*IEMobile)/i.test(navigator.userAgent)); @*/')()));
        break;
      
      case 'ie8':
        conditionizr.add('ie8', !!(Function('/*@cc_on return (@_jscript_version > 5.7 && !/^(9|10)/.test(@_jscript_version)); @*/')()));
        break;

      case 'ie9':
        conditionizr.add('ie9', !!(Function('/*@cc_on return (/^9/.test(@_jscript_version) && /MSIE 9\.0(?!.*IEMobile)/i.test(navigator.userAgent)); @*/')()));
        break;

      case 'ie10':
        conditionizr.add('ie10', !!(Function('/*@cc_on return document.documentMode===10@*/')()));
        break;

      case 'ie11':
        conditionizr.add('ie11', /(?:\sTrident\/7\.0;.*\srv:11\.0)/i.test(navigator.userAgent));
        break;

      case 'edge':
        conditionizr.add('edge', /edge\//i.test(navigator.userAgent));
        break;
    }

    conditionizr.on( pandago_php_vars.browsers_notice[i], addBrowserNoticeClass );

  }
}

/**
 * Check if given string is an email.
 * 
 * @param {string} email
 * 
 * @returns {boolean}
 */
function isEmail( email ) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test( email );
}

/**
 * Check if given string is a phone number.
 * 
 * @param {string} phone
 * 
 * @returns {boolean}
 */
function isPhone( phone ) {
  var regex = /^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/;
  return regex.test( phone );
}

/**
 * Sets a browser cookie.
 * 
 * @param {string} name Cookie name
 * @param {mixed} value Cookie value
 * @param {number} days Days until cookie expires
 */
function setCookie(name, value, days) {
  var expires;

  if( days ) {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = '; expires=' + date.toGMTString();
  } else {
      expires = '';
  }

  document.cookie = name + '=' + value + expires + '; path=/';
}



/**
 * Gets info about chosen cookie.
 * 
 * @param {string} name Cookie name to retrieve
 * 
 * @returns {string} Cookies value
 */
function getCookie(name) {
  if( document.cookie.length > 0 ) {
      start = document.cookie.indexOf(name + '=');

      if( start != -1 ) {
          start = start + name.length + 1;
          end = document.cookie.indexOf(';', start);

          if( end == -1 ) {
              end = document.cookie.length;
          }
      
          return unescape(document.cookie.substring(start, end));
      }
  }

  return '';
}

/**
 * Global variables
 */
var $doc = jQuery( document );


jQuery(document).ready(function($) {

    var $d = $( document );

    /**
     * Reset form.
     */
    $d.on( 'click', '.js-pdg-reset-form', function() {
        var $form = $( this ).closest( 'form' );

        $( 'input', $form ).val( '' );
        $form.submit();
    } );

    /**
     * Lazy loading images.
     */
    $( '.js-lazy' ).lazy();

    $d.ajaxComplete( function( event, request, settings ) {
        $('.js-lazy').lazy();
    } );

    // Update browser notification close button
    $('body').on('click', '.js-ubn-close', function() {
        $(this).closest('.update-browser-notification').remove();
        setCookie( 'hide_browser_notice', 'yes', 365 );
    });

    // Load more
    $( 'body' ).on( 'click', '.js-pandago-load-more, .js-pdg-load-more', function( e ) {
        e.preventDefault();

        var button = this;
        var args = JSON.parse( button.dataset.load );
        var loadMoreId = ( this.hasAttribute( 'data-lm-id' ) ) ? $(this).attr( 'data-lm-id' ) : 'default';

        args.offset = $( '[data-id="' + button.dataset.target + '"] > *' ).length;

        // Prepare query args and some additional params
        var data = {
            args: args,
            template: button.dataset.template,
            wrap: '',
            wrap_class: '',
            action: 'pandago_load_more'
        };

        // If response items should be wrapped or not
        if ( button.dataset.wrap !== undefined ) {
            data.wrap = button.dataset.wrap;
        }

        if ( button.dataset.wrapclass !== undefined ) {
            data.wrap_class = button.dataset.wrapclass;
        }

        $( button ).addClass( 'loading' );

        $.ajax( {
            type: 'post',
            call_id: 'pdg-lm-' + loadMoreId,
            url: ajax_url,
            data: data,
            success: function( response ) {
                $( button ).removeClass( 'loading' );

                $response = $( '<div>' + response + '</div>' );
                $( '[data-id="' + button.dataset.target + '"]' ).append( $response.find( '> div' ).html() );

                // Check if response item count is less than posts_per_page parameter, if it is - remove the loading button
                if ( $response.find( '> div' ).hasClass( 'no-more-posts' ) ) {
                    $( button ).remove();
                }

                sameHeight();
            }
        } )
    } );

    /**
     * Datepicker.
     */
    if ( $().datepicker ) {
        $( '.pdg-datepicker' ).datepicker( {
            dateFormat: 'dd.mm.yy',
            prevText: '',
            nextText: ''
        } );
    }

    /**
     * Contact Form 7 related scripts.
     */
    var $cf7 = $( '[data-pdg-cf7] .wpcf7' );
    var cf7;

    if ( $cf7.length > 0 ) {
        cf7 = $cf7[0];

        /**
         * Create checkboxes for wpcf7 plugin.
         */
        $( '.wpcf7-checkbox', cf7 ).each( function( i, el ) {
            $( '<span class="checkbox-input"></span>' ).insertAfter( $( 'input', el ) );
        });

        /**
         * Add 'has-error' classs to invalid inputs wrap
         * for custom styling.
         */
        cf7.addEventListener( 'wpcf7invalid' , function( e ) {
            $cf7.find( '.has-error' ).removeClass( 'has-error' );

            $( '.wpcf7-not-valid', cf7 ).each( function( i, el ) {
                $( el ).closest( '.input-wrap, .checkbox-outer' ).addClass( 'has-error' );
            });
        });

        /**
         * Validate contact form inputs on blur event.
         */
        $doc.on( 'blur', '[data-pdg-cf7] .wpcf7 .input', function() {
            var $input = $( this );
            var $wrap = $input.closest( '.input-wrap' );

            if ( $input.hasClass( 'wpcf7-validates-as-required' ) ) {
                if ( this.value ) {
                    $wrap.removeClass( 'has-error' ).addClass( 'filled' ).find( '.wpcf7-not-valid-tip' ).remove();
                } else {
                    $wrap.removeClass( 'filled' ).addClass( 'has-error' );

                    if ( $wrap.find( '.wpcf7-not-valid-tip' ).length == 0 ) {
                        $( '<span class="wpcf7-not-valid-tip">' + pandago_php_vars.cf_messages.invalid_required + '</span>' ).insertAfter( $input );
                    }
                }
            }

            if ( $input.hasClass( 'wpcf7-validates-as-tel' ) ) {
                if ( isPhone( this.value ) ) {
                    $wrap.removeClass( 'has-error' ).addClass( 'filled' ).find( '.wpcf7-not-valid-tip' ).remove();
                } else {
                    $wrap.removeClass( 'filled' ).addClass( 'has-error' );

                    if ( $wrap.find( '.wpcf7-not-valid-tip' ).length == 0 ) {
                        $( '<span class="wpcf7-not-valid-tip">' + pandago_php_vars.cf_messages.invalid_tel + '</span>' ).insertAfter( $input );
                    }
                }
            }

            if ( $input.hasClass( 'wpcf7-validates-as-email' ) ) {
                if ( isEmail( this.value ) ) {
                    $wrap.removeClass( 'has-error' ).addClass( 'filled' ).find( '.wpcf7-not-valid-tip' ).remove();
                } else {
                    $wrap.removeClass( 'filled' ).addClass( 'has-error' );

                    if ( $wrap.find( '.wpcf7-not-valid-tip' ).length == 0 ) {
                        $( '<span class="wpcf7-not-valid-tip">' + pandago_php_vars.cf_messages.invalid_email + '</span>' ).insertAfter( $input );
                    }
                }
            }
        });

        /**
         * Form submission.
         */
        $doc.on( 'click', '.js-cf-submit', function() {
            $( this ).addClass( 'loading' );
        });

        cf7.addEventListener( 'wpcf7submit', function(e) {
            $( '.js-cf-submit' ).removeClass( 'loading' );
            $cf7.find( '.filled' ).removeClass( 'filled' );
        });
    }
    /** End of: Contact Form 7 related scripts */

    /**
     * Same height elements.
     */
    function sameHeight() {
        $( '[data-same-height]' ).each( function( i, el ) {
            var $block = $( el );
            var classes = $block.attr( 'data-same-height' ).split( ',' );
            var highest = {};

            for ( var i = 0, n = classes.length; i < n; i++ ) {
                var elClass = classes[ i ];

                highest[ elClass ] = 0;

                $block.find( '.' + elClass ).each( function( i, el ) {
                    $( el ).height( 'auto' );

                    var height = $( el ).height();

                    highest[ elClass ] = ( height > highest[ elClass ] ) ? height : highest[ elClass ];
                } );
            }

            $.each( highest, function( key, value ) {
                $block.find( '.' + key ).height( value );
            } );

        } );
    }

    $( window ).on( 'load resize', sameHeight );
});