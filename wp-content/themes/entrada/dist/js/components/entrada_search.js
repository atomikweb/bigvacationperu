/* Entrada Search page filter
.............................. */
(function($) {
  'use strict';

  $(document).ready(function($) {
    var entrada_params = window.entrada_params;

    /* Common functions ..............*/
    $('.search-filter .layout-action a').click(function() {
      var view_mode = $(this).attr('id');
      var views = view_mode.split('_');
      setCookie('view_mode', views[1], 1);
      location.reload();
    });

    /* Region /Destination Filter ................*/
    $('.search-filter .region-list li').click(function() {
      $(this).toggleClass('active');
      search_product('no');
    });

    /* Region /Destination Filter ................*/
    $('.search-filter .product-cat li').click(function() {
      $(this).toggleClass('active');
      search_product('no');
    });

    /* Tag Filter ................*/
    $('.search-filter .product-tag li').click(function() {
      $(this).toggleClass('active');
      search_product('no');
    });

    /* Activity Filter ................*/
    $('.search-filter .activity-level li').click(function() {
      $(this).toggleClass('active');
      search_product('no');
    });

    /* Filter by Price Range ................*/
    $('.search-filter .filter_price_range').click(function() {
      search_product('no');
    });

    /* Sort by Order ................*/
    $('.search-filter #filter_by_order').change(function() {
      search_product('no');
    });

    /* Holiday Type ................*/
    $('.search-filter #filter_holiday_type').change(function() {
      search_product('no');
    });

    /* Filter Destination ................*/
    $('.search-filter #filter_destination').change(function() {
      search_product('no');
    });

    /* Filter Activity Level ................*/
    $('.search-filter #filter_activity_level').change(function() {
      search_product('no');
    });

    /* Filter Activities ................*/
    $('.search-filter #filter_activities').change(function() {
      search_product('no');
    });

    /* Filter Price Range ................*/
    $('.search-filter #filter_price_range').change(function() {
      search_product('no');
    });

    /* Load More Product
        ---------------------------------*/
    $('#search_load_more_post').click(function() {
      $('#search_load_more_post').html(entrada_params.loading);
      search_product('yes');
    });

    /* RateYo */
    star_rating();

    function star_rating() {
      var comment_count = 1;
      $('article.ratingview').each(function(i, e) {
        var product_rating = $(this)
          .find('.product_rating')
          .val();

        $(this)
          .find('.product_rateYo')
          .rateYo({
            rating: product_rating,
            readOnly: true,
            spacing: '2px',
            starWidth: '15px'
          });

        comment_count++;
      });
    }

    /* Suplimentry functions for selected sidebar
        .............................................. */
    function get_selected_region() {
      var destination = '';
      $('.region-list li').each(function() {
        if ($(this).hasClass('active')) {
          if (destination != '') {
            destination = destination + '%';
          }
          var names = $(this).attr('id');
          var name_of_des = names.split('region_');
          destination = destination + name_of_des[1];
        }
      });
      return destination;
    }

    function get_selected_product_cat() {
      var product_cat = '';
      $('.product-cat li').each(function() {
        if ($(this).hasClass('active')) {
          if (product_cat != '') {
            product_cat = product_cat + '%';
          }
          var actype = $(this).attr('id');
          var name_of_actype = actype.split('actype_');
          product_cat = product_cat + name_of_actype[1];
        }
      });
      return product_cat;
    }

    function get_selected_product_tag() {
      var product_tag = '';
      $('.product-tag li').each(function() {
        if ($(this).hasClass('active')) {
          if (product_tag != '') {
            product_tag = product_tag + '%';
          }
          var ptag = $(this).attr('id');
          var name_of_ptag = ptag.split('ptag_');
          product_tag = product_tag + name_of_ptag[1];
        }
      });
      return product_tag;
    }

    function get_selected_product_activity() {
      var product_activity = '';
      $('.activity-level li').each(function() {
        if ($(this).hasClass('active')) {
          if (product_activity != '') {
            product_activity = product_activity + '%';
          }
          var aclevel = $(this).attr('id');
          var name_of_aclevel = aclevel.split('aclevel_');
          product_activity = product_activity + name_of_aclevel[1];
        }
      });
      return product_activity;
    }

    /* Filter Main Product
        ---------------------------------*/
    function search_product(load_more) {
      var entrada_params = window.entrada_params;
      var view_mode = $('.view_mode').val();
      if (load_more == 'no') {
        $('#paged').val(1);
      }

      var search_layout = $('#search_layout').val();

      if (search_layout == 'sidebar') {
        var destination = get_selected_region();
        var product_cat = get_selected_product_cat();
        var product_tag = get_selected_product_tag();
        var product_activity = get_selected_product_activity();
        var price_range = $('#filter_range_slider').length ? $('#filter_range_slider').val() : '';
      } else {
        var destination = $('#filter_destination').val();
        var product_cat = $('#filter_activities').val();
        var product_tag = '';
        var product_activity = $('#filter_activity_level').val();
        var price_range = $('#filter_price_range').val();
      }

      var holiday_type = $('#filter_holiday_type').length ? $('#filter_holiday_type').val() : '';
      var filter_by_order = $('#filter_by_order').length ? $('#filter_by_order').val() : '';
      var paged = $('#paged').length ? $('#paged').val() : 1;
      var posts_per_page = $('#posts_per_page').length ? $('#posts_per_page').val() : 6;
      var load_start_date = $('#load_start_date').length ? $('#load_start_date').val() : '';
      var load_end_date = $('#load_end_date').length ? $('#load_end_date').val() : '';

      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: entrada_params.admin_ajax_url,
        data: {
          action: 'entrada_search_filter',
          destination: destination,
          product_cat: product_cat,
          product_tag: product_tag,
          holiday_type: holiday_type,
          product_activity: product_activity,
          price_range: price_range,
          view_mode: view_mode,
          paged: paged,
          filter_by_order: filter_by_order,
          load_start_date: load_start_date,
          load_end_date: load_end_date,
          posts_per_page: posts_per_page
        },
        success: function(data) {
          if ($('#have_no_record').length > 0) {
            $('#have_no_record').hide();
          }
          if (load_more == 'yes') {
            if (data.html_content == '') {
              $('#search_load_more_post').html(entrada_params.no_more_record_found);
            } else {
              $('#ajax_content_wrapper').append(data.html_content);
              $('#paged').val(parseInt(paged) + 1);
              $('#search_load_more_post').html(entrada_params.load_more);
              star_rating();
            }
          } else {
            if ($('.result-info').length > 0) {
              $('.result-info').html(data.record_count);
            }

            $('#paged').val('2');
            $('#search_load_more_post').html(entrada_params.load_more);

            if (data.html_content == '') {
              $('.loadmore-wrap').hide();
              $('#ajax_content_wrapper').empty();
              //$( '#ajax_content_wrapper' ).html( '<div class="pagination-wrap"><p>No Trip matches your search criteria. </p> </div>' );
              //$( '#ajax_content_wrapper .pagination-wrap' ).css( 'margin-top','50px' );
            } else {
              $('#ajax_content_wrapper').html(data.html_content);
              $('.loadmore-wrap').show();
              star_rating();
            }
          }
          return false;
        }
      });
      return false;
    }
  });
})(jQuery);
