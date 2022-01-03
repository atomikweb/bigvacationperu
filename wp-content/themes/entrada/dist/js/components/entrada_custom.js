(function($) {
  'use strict';

  $(document).ready(function() {
    var entrada_params = window.entrada_params;

    // Adds and removes body class depending on screen width.
    function screenClass() {
      $('a.entradaActiveLink').click(function() {
        var url = $(this).attr('href');
        $(location).attr('href', url);
      });
    }

    // Fire.
    if ($(window).width() > 991 && $(window).load()) {
      screenClass();
    }

    if ($(window).load()) {
      if ($(window).width() > 991) {
        screenClass();
        $('tr.addons-row td').attr('data-title', '');
      }
    }

    // And recheck when window gets resized.
    $(window).resize(function() {
      screenClass();
    });

    $('.default-widget').each(function(index) {
      var rand_str = get_rand_string();
      var this_title = $(this)
        .find($('h4.panel-title'))
        .text();
      var hyper_link = '<a role="button" data-toggle="collapse" href="#' + rand_str + '" aria-expanded="true" aria-controls="' + rand_str + '" >' + this_title + '</a>';
      $(this)
        .find('h4.panel-title')
        .html(hyper_link);
      $(this)
        .find('.default-widget-panel')
        .attr('id', rand_str);
      var className = $(this)
        .find('.panel-body ul')
        .attr('class');
      if (className === undefined || className === null) {
        $(this)
          .find('.panel-body ul')
          .addClass('side-list post-list hovered-list');
      }
    });

    var hash = window.location.hash;
    hash && $('.tab-add a[href="' + hash + '"]').tab('show');

    $('.book_now_dates').click(function() {
      $('ul.tab-add li.active').removeClass('active');
      $('div.trip-detail div.active').removeClass('active');
      $('.book_now_dates_li').addClass('active');
      $('.book_now_dates_href').attr('aria-expanded', 'true');
      $('#tab06').addClass('active');
      // store hash
      var hash = this.hash;

      // animate
      $('html, body').animate(
        {
          scrollTop: $(hash).offset().top - 180
        },
        800,
        function() {
          // when done, add hash to url
          // (default click behaviour)
          // window.location.hash = hash;
        }
      );
    });

    // Add styling for custom menu on sidebar
    $('.default-widget-panel')
      .find('.panel-body .menu')
      .addClass('side-list post-list hovered-list');

    /* Check if banner section exist */
    if ($('.banner').length > 0) {
      $('body').removeClass('default-page');
    }

    $('.read_full_review').click(function() {
      var comment_ID = $(this).attr('id');
      var link_name = $(this).html();
      $('#li-comment-' + comment_ID + ' .short-review').toggle('scroll');
      $('#li-comment-' + comment_ID + ' .full-review').toggle('scroll');
      if (link_name === entrada_params.read_full_review) {
        $(this).html(entrada_params.hide_full_review);
      } else {
        $(this).html(entrada_params.read_full_review);
      }
    });

    /* Mailchimp subscribe start here ............*/

    /* Register User start here........... */
    $('#entrada_register_form').validate({
      rules: {
        reg_fname: {
          required: true
        },
        reg_lname: {
          required: true
        },
        reg_username: {
          required: true
        },
        reg_email: {
          required: true,
          email: true
        },
        reg_password: {
          required: true
        }
      },

      messages: {
        reg_fname: {
          required: entrada_params.fname_mandatory_msg
        },
        reg_lname: {
          required: entrada_params.lname_mandatory_msg
        },
        reg_username: {
          required: entrada_params.uname_mandatory_msg
        },
        reg_email: {
          required: entrada_params.email_mandatory_msg,
          email: entrada_params.email_valid_msg
        },
        reg_password: {
          required: entrada_params.pass_mandatory_msg
        }
      },

      submitHandler: function() {
        var reg_fname = $('#reg_fname').val();
        var reg_lname = $('#reg_lname').val();
        var reg_username = $('#reg_username').val();
        var reg_email = $('#reg_email').val();
        var reg_password = $('#reg_password').val();

        $('#entrada_alert')
          .removeAttr('class')
          .attr('class', '');
        $('#entrada_alert').html(entrada_params.procesing_msg);
        $('#entrada_alert').addClass('alert alert-warning');

        $.ajax({
          type: 'POST',
          dataType: 'json',
          url: entrada_params.admin_ajax_url,
          data: {
            action: 'entrada_getRegister',
            reg_fname: reg_fname,
            reg_lname: reg_lname,
            reg_username: reg_username,
            reg_email: reg_email,
            reg_password: reg_password
          },
          success: function(data) {
            $('#entrada_alert')
              .removeAttr('class')
              .attr('class', '');
            if (data.response == 'success') {
              $('#entrada_alert').html(data.msg);
              $('#entrada_alert').addClass('alert alert-success');
              $('#entrada_register_form')[0].reset();
            } else {
              $('#entrada_alert').html(data.msg);
              $('#entrada_alert').addClass('alert alert-warning');
              return false;
            }
            return false;
          }
        });
      }
    });

    /* Shop page rating */
    star_rating();
    /* Shop page load more click */
    $('#load_more_shop_post').click(function() {
      $('#load_more_shop_post').html(entrada_params.load_more);
      filter_product('yes');
    });

    /* Cart */
    $('.woocommerce').on('click', 'a.minus', function() {
      var current_qty = $(this)
        .parent()
        .find('.qty_val')
        .val();
      if (parseInt(current_qty) > 1) {
        $(this)
          .parent()
          .find('.qty_val')
          .val(parseInt(current_qty) - 1);
        $("input[name='update_cart']").attr('disabled', false);
      }
    });
    $('.woocommerce').on('click', 'a.plus', function() {
      var current_qty = $(this)
        .parent()
        .find('.qty_val')
        .val();
      $(this)
        .parent()
        .find('.qty_val')
        .val(parseInt(current_qty) + 1);
      $("input[name='update_cart']").attr('disabled', false);
    });

    /* Toggle Variation Price*/
    $('.woocommerce').on('click', '.include_flight', function() {
      if ($(this).is(':checked')) {
        $(this)
          .parent()
          .siblings('.including-flight-price')
          .removeClass('hide');
        $(this)
          .parent()
          .siblings('.excluding-flight-price')
          .addClass('hide');
      } else {
        $(this)
          .parent()
          .siblings('.including-flight-price')
          .addClass('hide');
        $(this)
          .parent()
          .siblings('.excluding-flight-price')
          .removeClass('hide');
      }
    });

    $('.woocommerce').on('click', '.update_cart', function() {
      var inc_flight = '';
      $('input:checkbox[name=include_flight]:checked').each(function() {
        if (inc_flight !== '') {
          inc_flight = inc_flight + '-';
        }
        inc_flight = inc_flight + $(this).val();
      });
      setCookie('include_flight', inc_flight, 120);
    });

    if ($('div.wcv_shop_description').length) {
      $('div.wcv_shop_description')
        .prev()
        .addClass('wcv_shop_title');
      $('.wcv_shop_title, .wcv_shop_description').wrapAll('<div class="wcv_shop_detail"></div>');
    }

    $('.wc_vendor_shop').click(function() {
      $('.wcv_shop_detail').toggleClass('toggle-des');
    });

    /* Page Rating */
    if ($('.page-content').length) {
      //page_star_rating();

      $('.give_blog_rateYo').rateYo({
        onSet: function(rating, rateYoInstance) {
          $('.give_blog_rating').val(rating);
        },
        rating: 0,
        starWidth: '15px',
        numStars: 5,
        fullStar: true
      });

      comment_rating();
    }
  });

  function comment_rating() {
    $('.comment-slot').each(function(i, e) {
      var personal_rating = $(this)
        .find('.personal_rating')
        .val();
      $(this)
        .find('.personal_rateYo')
        .rateYo({
          rating: personal_rating,
          readOnly: true,
          spacing: '2px',
          starWidth: '15px'
        });
    });
  }

  FB.init({
    appId: entrada_params.facebook_appId,
    status: true,
    cookie: true,
    xfbml: true
  });
})(jQuery);

function cart_addons_options(id) {
  'use strict';

  jQuery('.' + id).toggleClass('show-option');
  jQuery('#btn_' + id).toggleClass('active-more');
  if (jQuery('#btn_' + id).html() == entrada_params.more_option) {
    jQuery('#btn_' + id).html(entrada_params.hide_option);
  } else {
    jQuery('#btn_' + id).html(entrada_params.more_option);
  }
}

/*jQuery('.more-option-opener').click(function(){
    jQuery('.addons-row').toggleClass('show-option');
    jQuery(this).toggleClass('active-more');
});*/

function star_rating() {
  'use strict';

  jQuery('article.ratingview').each(function(i, e) {
    var product_rating = jQuery(this)
      .find('.product_rating')
      .val();
    jQuery(this)
      .find('.product_rateYo')
      .rateYo({
        rating: product_rating,
        readOnly: true,
        spacing: '2px',
        starWidth: '15px'
      });
  });
}

function page_star_rating() {
  'use strict';

  jQuery('article.ratingview').each(function(i, e) {
    var product_rating = jQuery(this)
      .find('.product_rating')
      .val();
    jQuery(this)
      .find('.product_rateYo')
      .rateYo({
        rating: product_rating,
        readOnly: true,
        spacing: '2px',
        starWidth: '15px'
      });
  });
}

function filter_product(load_more) {
  'use strict';

  var view_mode = jQuery('.view_mode').val();
  var entrada_params = window.entrada_params;
  if (load_more == 'no') {
    jQuery('#paged').val(1);
  }
  var paged = jQuery('#paged').length ? jQuery('#paged').val() : 1;
  var posts_per_page = jQuery('#posts_per_page').length ? jQuery('#posts_per_page').val() : 6;
  var vendor_page = jQuery('#vendor_page').val();
  var vendor_name = jQuery('#vendor_shop').val();
  jQuery.ajax({
    type: 'POST',
    dataType: 'json',
    url: entrada_params.admin_ajax_url,
    data: {
      action: view_mode + '_shop_load_more',
      paged: paged,
      posts_per_page: posts_per_page,
      vendor_page: vendor_page,
      vendor_name: vendor_name
    },
    success: function(data) {
      if (load_more == 'yes') {
        if (data.html_content === '') {
          jQuery('#load_more_shop_post').html(entrada_params.no_more_record_found);
        } else {
          jQuery('#entrada_content_loader').append(data.html_content);
          jQuery('#paged').val(parseInt(paged) + 1);
          jQuery('#load_more_shop_post').html(entrada_params.load_more);
          star_rating();
        }
      } else {
        jQuery('#load_more_shop_post').html(entrada_params.load_more);
        jQuery('#paged').val(parseInt(paged) + 1);
        if (data.html_content === '') {
          jQuery('nav.loadmore-wrap').addClass('hide');
          jQuery('.pagination-wrap').remove();
          if ('grid' == view_mode) {
            jQuery('#entrada_content_loader').empty();
            jQuery('.content-holder').after('<div class="pagination-wrap"><p>' + entrada_params.no_trip_matches + '</p> </div>');
          } else {
            jQuery('#entrada_content_loader')
              .empty()
              .after('<div class="pagination-wrap">' + entrada_params.no_trip_matches + '</p> </div>');
          }
        } else {
          jQuery('nav.loadmore-wrap').removeClass('hide');
          jQuery('.pagination-wrap').remove();
          jQuery('#entrada_content_loader').html(data.html_content);
          star_rating();
        }
      }
      return false;
    }
  });
  return false;
}

function save_wishlist(post_id) {
  'use strict';

  var entrada_params = window.entrada_params;
  jQuery.ajax({
    type: 'POST',
    dataType: 'json',
    url: entrada_params.admin_ajax_url,
    data: {
      action: 'entrada_SaveToWishlist',
      post_id: post_id
    },
    success: function(data) {
      if (data.response == 'saved') {
        jQuery('#wishlistId_' + post_id).html('<span class="icon-remove-favourite"></span>');
      } else {
        jQuery('#wishlistId_' + post_id).html('<span class="icon-favs"></span>');
      }
      return false;
    }
  });
}

function get_rand_string() {
  'use strict';

  var text = '';
  var possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

  for (var i = 0; i < 10; i++) {
    text += possible.charAt(Math.floor(Math.random() * possible.length));
  }

  return text;
}

function read_full_review(comment_ID) {
  'use strict';

  jQuery('#li-comment-' + comment_ID + ' .short-review').slideToggle();
  jQuery('#li-comment-' + comment_ID + ' .full-review').slideToggle();

  if (jQuery('#li-comment-' + comment_ID + ' .short-review').is(':none')) {
    jQuery('#li-comment-' + comment_ID + ' .link-holder a').html(entrada_params.read_full_review);
  } else {
    jQuery('#li-comment-' + comment_ID + ' .link-holder a').html(entrada_params.hide_full_review);
  }
}

function reset_star_rating() {
  'use strict';

  var i;
  for (i = 1; i <= 5; i++) {
    jQuery('#rate_star_' + i)
      .removeAttr('class')
      .attr('class', '');
    jQuery('#rate_star_' + i).addClass('disable');
  }
}

function select_start_rating(rating) {
  'use strict';

  var i;
  for (i = 1; i <= 5; i++) {
    jQuery('#rate_star_' + i)
      .removeAttr('class')
      .attr('class', '');
    if (i <= rating) {
      jQuery('#rate_star_' + i).addClass('enable');
    } else {
      jQuery('#rate_star_' + i).addClass('disable');
    }
  }
}

/* Entrada Comment section functions */
function getCookie(c_name) {
  'use strict';

  var i,
    x,
    y,
    ARRcookies = document.cookie.split(';');
  for (i = 0; i < ARRcookies.length; i++) {
    x = ARRcookies[i].substr(0, ARRcookies[i].indexOf('='));
    y = ARRcookies[i].substr(ARRcookies[i].indexOf('=') + 1);
    x = x.replace(/^\s+|\s+$/g, '');
    if (x == c_name) {
      return decodeURI(y);
    }
  }
}

function setCookie(c_name, value, exdays) {
  'use strict';

  var this_c_name = c_name;
  var this_value = value;
  var this_exdays = exdays;
  var entrada_params = window.entrada_params;
  var exdate = new Date();
  exdate.setDate(exdate.getDate() + this_exdays);
  var this_c_value = encodeURI(this_value) + (this_exdays === null ? '' : '; expires=' + exdate.toUTCString());
  document.cookie = this_c_name + '=' + this_c_value + '; path=' + entrada_params.cookie_path;
}

/* ::::::::::  SOCIAL MEDIA SHARE :::::::::::::::::::::::  */
// Live APP ID : 302620276590592,  SVN APPID : 308257602649806
function postToFeed(url, picture, fb_title, fb_description) {
  'use strict';

  var obj = {
    method: 'feed',
    link: url,
    picture: picture,
    name: fb_title,
    caption: fb_title,
    description: fb_description
  };

  function callback(response) {
    //document.getElementById('msg').innerHTML = "Post ID: " + response['post_id'];
  }
  FB.ui(obj, callback);
}

// Load the SDK Asynchronously
function fb_callout(fb_url, picture, name, description) {
  'use strict';

  postToFeed(fb_url, picture, name, description);
}

function share_on_twitter(share_url, share_text) {
  'use strict';

  var sharethis_url = 'https://twitter.com/intent/tweet?url=' + share_url + '&text=' + share_text;
  window.open(sharethis_url, 'Twitter_share', 'width=650,height=530');
  return false;
}

function pin_it_now(p_url, image, share_text) {
  'use strict';

  // var pin_url = 'http://pinterest.com/pin/create/button/?url=' + p_url + '&media=' + image + '&description=' + share_text;
  // window.open(pin_url, 'Pin_Login', 'width=650,height=530');
  // return false;

}

function google_plus(g_url) {
  'use strict';

  // var google_url = 'https://plus.google.com/share?url=' + g_url;
  // window.open(google_url, 'Pin_Login', 'width=650,height=530');
  // return false;

}
