(function($) {
  'use strict';
  jQuery(document).ready(function($) {
    /* Logo Text or Image */
    var logo_type;
    logo_type = $('input[type=radio][name=_customize-radio-logo_text_image]:checked').val();
    show_logo_li(logo_type);
    check_entrada_badge_images();
    entrada_searchbox_bg_option_control();

    /* Layout Wide or boxed if boxed show other options */
    var layout, options, new_options;
    layout = $('input[type=radio][name=_customize-radio-sitelayout_onoff]:checked').val();
    options = $('input[type=radio][name=_customize-radio-sitelayout_boxed_option]:checked').val();
    new_options = options;
    if ('wide' == layout) {
      $('li#customize-control-sitelayout_onoff')
        .nextAll('li')
        .hide();
    } else if ('boxed' == layout) {
      $('li#customize-control-sitelayout_boxed_option').show();
      $('li#customize-control-sitelayout_boxed_option')
        .nextAll('li')
        .hide();
      $('li#customize-control-bckgrd_' + options).show();
    }

    if ('colour' == options && 'boxed' == layout) {
      $('li#customize-control-bckgrd_colour').show();
      $('li#customize-control-bckgrd_colour')
        .nextAll('li')
        .hide();
    } else if ('image' == options && 'boxed' == layout) {
      $('li#customize-control-bckgrd_image')
        .prev('li')
        .hide();
      $('li#customize-control-bckgrd_image')
        .next('li')
        .hide();
      $('li#customize-control-bckgrd_image').show();
    } else if ('pattern' == options && 'boxed' == layout) {
      $('li#customize-control-bckgrd_colour').hide();
      $('li#customize-control-bckgrd_image').hide();
      $('li#customize-control-bckgrd_pattern').show();
    }

    /* background footer options image/color/pattern */
    var ft_options, ft_new_options;
    ft_options = $('input[type=radio][name=_customize-radio-footer_background_option]:checked').val();
    ft_new_options = ft_options;
    if ('ft_bckcolour' == ft_options) {
      $('li#customize-control-footer_ft_bckcolour').show();
      $('li#customize-control-footer_ft_bckimage').hide();
      $('li#customize-control-footer_ft_bckpattern').hide();
    } else if ('ft_bckimage' == ft_options) {
      $('li#customize-control-footer_ft_bckcolour').hide();
      $('li#customize-control-footer_ft_bckimage').show();
      $('li#customize-control-footer_ft_bckpattern').hide();
    } else if ('ft_bckpattern' == ft_options) {
      $('li#customize-control-footer_ft_bckcolour').hide();
      $('li#customize-control-footer_ft_bckimage').hide();
      $('li#customize-control-footer_ft_bckpattern').show();
    }

    /* View mode list/grid */
    var view_mode;
    view_mode = $('input[type=radio][name=_customize-radio-list_view_mode]:checked').val();
    if ('view_list' == view_mode) {
      $('li#customize-control-grid_layout').hide();
      $('li#customize-control-list_layout').show();
    } else if ('view_grid' == view_mode) {
      $('li#customize-control-grid_layout').show();
      $('li#customize-control-list_layout').hide();
    }

    /* radio change */
    $('input[type=radio]').change(function() {
      var $this, radio_value, this_li, closest_li;
      $this = $(this);
      radio_value = $this.val();
      if ('text' == radio_value || 'image' == radio_value) {
        show_logo_li(radio_value);
      } else if ('wide' == radio_value) {
        this_li = $this.closest('li').attr('id');

        $('li#' + this_li)
          .nextAll('li')
          .hide();
      } else if ('boxed' == radio_value) {
        this_li = $this.closest('li').attr('id');
        closest_li = $('li#' + this_li)
          .next('li')
          .attr('id');

        $('li#' + closest_li).show();
        $('li#' + closest_li)
          .nextAll('li')
          .hide();

        $('li#customize-control-bckgrd_' + new_options).show();
      } else if ('bckcolour' == radio_value) {
        new_options = 'bckcolour';

        this_li = $this.closest('li').attr('id');
        closest_li = $('li#' + this_li)
          .next('li')
          .attr('id');

        $('li#' + closest_li).show();
        $('li#' + closest_li)
          .nextAll('li')
          .hide();
      } else if ('bckimage' == radio_value) {
        new_options = 'bckimage';

        this_li = 'customize-control-bckgrd_' + new_options;

        $('li#' + this_li)
          .prev('li')
          .hide();
        $('li#' + this_li).show();
        $('li#' + this_li)
          .next('li')
          .hide();
      } else if ('bckpattern' == radio_value) {
        new_options = 'bckpattern';

        this_li = 'customize-control-bckgrd_' + new_options;

        $('li#customize-control-bckgrd_bckcolour').hide();
        $('li#customize-control-bckgrd_bckimage').hide();
        $('li#customize-control-bckgrd_bckpattern').show();
      } else if ('ft_bckcolour' == radio_value) {
        $('li#customize-control-footer_ft_bckcolour').show();
        $('li#customize-control-footer_ft_bckimage').hide();
        $('li#customize-control-footer_ft_bckpattern').hide();
      } else if ('ft_bckimage' == radio_value) {
        $('li#customize-control-footer_ft_bckcolour').hide();
        $('li#customize-control-footer_ft_bckimage').show();
        $('li#customize-control-footer_ft_bckpattern').hide();
      } else if ('ft_bckpattern' == radio_value) {
        $('li#customize-control-footer_ft_bckcolour').hide();
        $('li#customize-control-footer_ft_bckimage').hide();
        $('li#customize-control-footer_ft_bckpattern').show();
      }
    });

    /* Topbar show */
    if ($('#customize-control-navbar_top input').prop('checked')) {
      $('li#customize-control-topbar_links_colour').show();
      $('li#customize-control-topbar_links_hover_colour').show();
      $('li#customize-control-topbar_links_font_size').show();
      $('li#customize-control-topbar_phone').show();
      $('li#customize-control-topbar_email').show();
      $('li#customize-control-navbar_style select').prop('disabled', 'disabled');
    } else {
      $('li#customize-control-topbar_links_colour').hide();
      $('li#customize-control-topbar_links_hover_colour').hide();
      $('li#customize-control-topbar_links_font_size').hide();
      $('li#customize-control-topbar_phone').hide();
      $('li#customize-control-topbar_email').hide();
      $('li#customize-control-navbar_style select').prop('disabled', false);
    }

    /* Round border show */
    if ($('#customize-control-rounded_button_border input').prop('checked')) {
      $('li#customize-control-rounded_button_border')
        .nextAll('li')
        .show();
    } else {
      $('li#customize-control-rounded_button_border')
        .nextAll('li')
        .hide();
    }

    /* Square border show */
    if ($('#customize-control-square_button_border input').prop('checked')) {
      $('li#customize-control-square_button_border')
        .nextAll('li')
        .show();
    } else {
      $('li#customize-control-square_button_border')
        .nextAll('li')
        .hide();
    }

    /* Large border show */
    if ($('#customize-control-large_button_border input').prop('checked')) {
      $('li#customize-control-large_button_border')
        .nextAll('li')
        .show();
    } else {
      $('li#customize-control-large_button_border')
        .nextAll('li')
        .hide();
    }

    /* Full length on/off */
    var full_length;
    if ($('#customize-control-blog_full_onoff input').prop('checked')) {
      $('li#customize-control-blog_full_onoff')
        .nextAll('li')
        .hide();
    } else {
      $('li#customize-control-blog_full_onoff')
        .nextAll('li')
        .show();
    }

    /* Footer bottom show/hide */
    if ($('#customize-control-footer_bottom_onoff input').prop('checked')) {
      $('li#customize-control-footer_bottom_onoff')
        .nextAll('li')
        .show();
      add_more_image_button();
      check_payment_images();
    } else {
      $('li#customize-control-footer_bottom_onoff')
        .nextAll('li')
        .hide();
    }

    /* Footer social icon show/hide */
    if ($('#customize-control-footer_social_onoff input').prop('checked')) {
      $('li#customize-control-footer_social_onoff')
        .nextAll('li')
        .show();
      add_more_footer_social_button();
      check_social_media_icons();
    } else {
      $('li#customize-control-footer_social_onoff')
        .nextAll('li')
        .hide();
    }

    /* checkbox change */
    $('input[type=checkbox]').change(function() {
      var $this = $(this);
      var this_li_id = $this
        .parent()
        .parent()
        .attr('id');
      if ('customize-control-footer_bottom_onoff' == this_li_id) {
        if ($this.is(':checked')) {
          $('li#' + this_li_id)
            .next('li')
            .show();
          add_more_image_button();
          check_payment_images();
        } else {
          $('li#' + this_li_id)
            .nextAll('li')
            .hide();
        }
      } else if ('customize-control-custom_badge_onoff' == this_li_id) {
        check_entrada_badge_images();
      } else if ('customize-control-searchbox_bg_onoff' == this_li_id) {
        entrada_searchbox_bg_option_control();
      } else if ('customize-control-footer_social_onoff' == this_li_id) {
        if ($this.is(':checked')) {
          $('li#' + this_li_id)
            .nextAll('li')
            .show();
        } else {
          $('li#' + this_li_id)
            .nextAll('li')
            .hide();
        }
      } else if ('customize-control-blog_full_onoff' == this_li_id) {
        if ($this.is(':checked')) {
          $('li#' + this_li_id)
            .nextAll('li')
            .hide();
        } else {
          $('li#' + this_li_id)
            .nextAll('li')
            .show();
        }
      } else if ('customize-control-list_full_onoff' == this_li_id) {
        if ($this.is(':checked')) {
          $('li#' + this_li_id)
            .nextAll('li')
            .hide();
        } else {
          $('li#' + this_li_id)
            .nextAll('li')
            .show();
        }
      } else if ('customize-control-navbar_top' == this_li_id) {
        if ($this.is(':checked')) {
          $('li#customize-control-topbar_links_colour').show();
          $('li#customize-control-topbar_links_hover_colour').show();
          $('li#customize-control-topbar_links_font_size').show();
          $('li#customize-control-topbar_phone').show();
          $('li#customize-control-topbar_email').show();
          $('li#customize-control-navbar_style select').prop('disabled', 'disabled');
        } else {
          $('li#customize-control-topbar_links_colour').hide();
          $('li#customize-control-topbar_links_hover_colour').hide();
          $('li#customize-control-topbar_links_font_size').hide();
          $('li#customize-control-topbar_phone').hide();
          $('li#customize-control-topbar_email').hide();
          $('li#customize-control-navbar_style select').prop('disabled', false);
        }
      } else if ('customize-control-rounded_button_border' == this_li_id) {
        if ($this.is(':checked')) {
          $('li#' + this_li_id)
            .nextAll('li')
            .show();
        } else {
          $('li#' + this_li_id)
            .nextAll('li')
            .hide();
        }
      } else if ('customize-control-square_button_border' == this_li_id) {
        if ($this.is(':checked')) {
          $('li#' + this_li_id)
            .nextAll('li')
            .show();
        } else {
          $('li#' + this_li_id)
            .nextAll('li')
            .hide();
        }
      } else if ('customize-control-large_button_border' == this_li_id) {
        if ($this.is(':checked')) {
          $('li#' + this_li_id)
            .nextAll('li')
            .show();
        } else {
          $('li#' + this_li_id)
            .nextAll('li')
            .hide();
        }
      }
    });

    /* on google font change */
    $('select.entrada_google_font_select').on('change', function() {
      var this_li = $(this)
        .closest('li')
        .attr('id');
      if ('customize-control-main_heading_google_font_setting' == this_li) {
        var closest_li = $('li#' + this_li)
          .nextAll('li')
          .eq(1)
          .attr('id');
      } else {
        var closest_li = $('li#' + this_li)
          .next('li')
          .attr('id');
      }
      var font = $(this).val();
      var admin_ajax_url = entrada_uri['admin_ajax_url'];
      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: admin_ajax_url,
        data: {
          action: 'entrada_font_variant',
          font: font
        },
        success: function(data) {
          $('li#' + closest_li + ' select').html(data.variant);
        },
        error: function(e) {
          alert(e);
        }
      });
    });

    /* footer */
    $('li#accordion-section-section_footer_bottom_setting').on('click', '#customize-control-add_more_image_button', function() {
      var last_li_id = $('#accordion-section-section_footer_bottom_setting li.customize-control-image:visible:last').attr('id');
      $('#' + last_li_id)
        .next('li')
        .show();
    });

    $('li#accordion-section-section_footer_social_setting').on('click', '.customize-control-social_add_button', function() {
      var last_li_id = $('#accordion-section-section_footer_social_setting li.customize-control-text:visible:last').attr('id');
      $('#' + last_li_id)
        .next('li')
        .show();
      $('#' + last_li_id)
        .next('li')
        .next('li')
        .show();
    });
  });

  function add_more_image_button() {
    var add_new_image = $(
      '<li class="customize-control-custom_add_button"><input type="button" value="Add More Image" id="customize-control-add_more_image_button" class="button"/></li>'
    );
    $('li#customize-control-copyright_text').after(add_new_image);
  }

  function show_logo_li(logo_type) {
    var count = 1;
    $('li#customize-control-logo_text_image').show();
    if ('image' == logo_type) {
      $('li#customize-control-header_darkbg_logo').show();
      $('li#customize-control-header_whitebg_logo').show();
      $('li#customize-control-header_logo_padding').show();
      $('li#customize-control-header_logo_width').show();
      $('li#customize-control-header_logo_height').show();
      $('li#customize-control-logo_text').hide();
      $('li#customize-control-google_font_logo').hide();
      $('li#customize-control-logo_google_fontvariant_setting').hide();
      $('li#customize-control-logo_font_colour').hide();
      $('li#customize-control-logo_font_size').hide();
      $('li#customize-control-logo_font_style').hide();
    } else {
      $('li#customize-control-header_logo_width').hide();
      $('li#customize-control-header_logo_height').hide();
      $('li#customize-control-header_darkbg_logo').hide();
      $('li#customize-control-header_whitebg_logo').hide();
      $('li#customize-control-header_logo_padding').hide();
      $('li#customize-control-logo_text').show();
      $('li#customize-control-google_font_logo').show();
      $('li#customize-control-logo_google_fontvariant_setting').show();
      $('li#customize-control-logo_font_colour').show();
      $('li#customize-control-logo_font_size').show();
      $('li#customize-control-logo_font_style').show();
    }
    $('li#accordion-section-section_logo ul li:nth-child(2)').show();
  }

  function check_payment_images() {
    var count_image = 1;
    $('li#accordion-section-section_footer_bottom_setting li.customize-control-image').each(function(i) {
      var $this = $(this);
      var the_id = $this.attr('id');

      if ($this.find('img').length) {
        var src = $('img', this).attr('src');
        if ('' != src) {
          $this.show();
        }
      } else {
        $this.hide();
      }
      if (1 == count_image) {
        $this.show();
      }
      count_image++;
    });
  }

  function check_entrada_badge_images() {
    if ($('li#customize-control-custom_badge_onoff input').is(':checked')) {
      $('li#customize-control-custom_badge_image1').show();
      $('li#customize-control-custom_badge_image2').show();
      $('li#customize-control-custom_badge_image3').show();
      $('li#customize-control-custom_badge_image4').show();
      $('li#customize-control-custom_badge_image5').show();
    } else {
      $('li#customize-control-custom_badge_image1').hide();
      $('li#customize-control-custom_badge_image2').hide();
      $('li#customize-control-custom_badge_image3').hide();
      $('li#customize-control-custom_badge_image4').hide();
      $('li#customize-control-custom_badge_image5').hide();
    }
  }

  function entrada_searchbox_bg_option_control() {
    if ($('li#customize-control-searchbox_bg_onoff input').is(':checked')) {
      $('li#customize-control-entrada_search_block_background').show();
      $('li#customize-control-entrada_search_block_border').show();
      $('li#customize-control-entrada_search_block_box_shadow').show();
    } else {
      $('li#customize-control-entrada_search_block_background').hide();
      $('li#customize-control-entrada_search_block_border').hide();
      $('li#customize-control-entrada_search_block_box_shadow').hide();
    }
  }

  function add_more_footer_social_button() {
    var add_new_opt = $(
      '<li class="customize-control-social_add_button"><input type="button" value="Add More Option" id="customize-control-add_more_social_button" class="button"/></li>'
    );
    $('li#customize-control-footer_social_onoff').after(add_new_opt);
  }

  function check_social_media_icons() {
    var count_image = parseInt(1);
    $('li#accordion-section-section_footer_social_setting li.customize-control-text').hide();
    $('li#accordion-section-section_footer_social_setting li.customize-control-text').each(function(i) {
      var $this = $(this);
      var the_id = $this.attr('id');
      if (count_image % 2 != 0) {
        if ($this.find('input').val() != '') {
          $this.show();
          $this.next('li').show();
        } else {
          $this.hide();
          $this.next('li').hide();
        }
      }
      if (1 == count_image) {
        $this.show();
        $this.next('li').show();
      }
      count_image++;
    });
  }
})(jQuery);
