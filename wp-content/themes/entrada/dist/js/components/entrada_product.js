jQuery(document).ready(function($) {
    'use strict';
    var entrada_params = window.entrada_params;

    /* Switch Listing View ................*/
    $(".list_grid_view .layout-action a").click(function() {
        var view_mode = $(this).attr("id");
        var views = view_mode.split('_');
        setCookie('view_mode', views[1], 1);
        location.reload();
    });

    /* -------  SIDE BAR FILTER ON CLICK -------- */
    /* Region /Destination Filter ................*/
    $(".list_grid_view .region-list li a").click(function() {
        $(this).parent().toggleClass('active');
        filter_product('no');
    });

    /* Activity Type Filter ................*/
    $(".list_grid_view .product-cat li a").click(function() {
        $(this).parent().toggleClass('active');
        filter_product('no');
    });

    /* Tag Filter ................*/
    $(".list_grid_view .product-tag li a").click(function() {
        $(this).parent().toggleClass('active');
        filter_product('no');
    });

    /* Activity Level Filter ................*/
    $(".list_grid_view .activity-level li a").click(function() {
        $(this).parent().toggleClass('active');
        filter_product('no');
    });

    /* Filter by Price Range ................*/
    $(".list_grid_view .filter_price_range").click(function() {
        filter_product('no');
    });

    /* ------- TOP SELECT ON CLICK -------- */
    /* Sort by Order ................*/
    $(".list_grid_view .filter_by_order").change(function() {
        filter_product('no');
    });

    /* Holiday select on change filter */
    $(".list_grid_view #filter_holiday_type").change(function() {
        filter_product('no');
    });

    /* Activity level select on change filter */
    $(".list_grid_view #filter_activity_level").change(function() {
        filter_product('no');
    });

    /* Price select on change filter */
    $(".list_grid_view #filter_price_range").change(function() {
        filter_product('no');
    });

    /* Destination select on change filter */
    $(".list_grid_view #filter_destination").change(function() {
        filter_product('no');
    });

    /* Popularity select on change filter */
    $(".list_grid_view #filter_popularity").change(function() {
        filter_product('no');
    });

    function get_selected_region() {
        var destination = '';
        $(".region-list li").each(function() {
            if ($(this).hasClass("active")) {
                if (destination != '') {
                    destination = destination + '%';
                }
                var names = $(this).attr("id");
                var name_of_des = names.split('region_');

                destination = destination + name_of_des[1];
            }
        });
        return destination;
    }

    function get_selected_product_cat() {
        var product_cat = '';
        $(".product-cat li").each(function() {
            if ($(this).hasClass("active")) {
                if (product_cat != '') {
                    product_cat = product_cat + '%';
                }
                var actype = $(this).attr("id");
                var name_of_actype = actype.split('actype_');
                product_cat = product_cat + name_of_actype[1];
            }
        });
        return product_cat;
    }

    function get_selected_product_tag() {
        var product_tag = '';
        $(".product-tag li").each(function() {
            if ($(this).hasClass("active")) {
                if (product_tag != '') {
                    product_tag = product_tag + '%';
                }
                var ptag = $(this).attr("id");
                var name_of_ptag = ptag.split('ptag_');
                product_tag = product_tag + name_of_ptag[1];
            }
        });
        return product_tag;
    }

    function get_selected_product_activity() {
        var product_activity = '';
        $(".activity-level li").each(function() {
            if ($(this).hasClass("active")) {
                if (product_activity != '') {
                    product_activity = product_activity + '%';
                }
                var aclevel = $(this).attr("id");
                var name_of_aclevel = aclevel.split('aclevel_');
                product_activity = product_activity + name_of_aclevel[1];
            }
        });
        return product_activity;
    }

    /* RateYo */
    if ($(".average_rating").length) {
        var average_rating = $('.average_rating').val();
        $(".average_rateYo").rateYo({
            rating: average_rating,
            spacing: "2px",
            starWidth: "15px",
            readOnly: true,
        });
        comment_rating();
        $("#load_more_reviews").click(function() {
            load_more_reviews();
        });
        $(".rateYo").rateYo({
            onSet: function(rating, rateYoInstance) {
                $('.product_rating').val(rating);
            },
            rating: 0,
            starWidth: "15px",
            numStars: 5,
            fullStar: true
        });
        $("#write_a_review").submit(function(event) {
            event.preventDefault();
            write_a_review();
        });
    } else {
        star_rating();
    }

    function star_rating() {
        var comment_count = 1;
        $('article.ratingview').each(function(i, e) {
            var product_rating = $(this).find('.product_rating').val();

            $(this).find(".product_rateYo").rateYo({
                rating: product_rating,
                readOnly: true,
                spacing: "2px",
                starWidth: "15px",
            });

            comment_count++;
        });
    }

    function comment_rating() {
        var comment_count = 1;
        $('.comment-slot').each(function(i, e) {
            var personal_rating = $(this).find('.personal_rating').val();
            $(this).find(".personal_rateYo").rateYo({
                rating: personal_rating,
                readOnly: true,
                spacing: "2px",
                starWidth: "15px",
            });
            comment_count++;
        });
    }

    /* write a review function for single product */
    function write_a_review() {    	
        var error = '';
        jQuery('#comment_message_box').removeAttr('class').attr('class', '');
        jQuery('#comment_message_box').addClass('alert alert-warning');
        jQuery('#comment_message_box').html(entrada_params.procesing_msg);
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        var comment_author_url = jQuery('#comment_author_url').val();

        if (jQuery('#comment_author').length && jQuery('#comment_author').val() != '') {
            var comment_author = jQuery('#comment_author').val();
            error = error.replace("<br />"+entrada_params.aname_mandatory_msg, "");
        } else {
            var comment_author = '';
            error = error + '<br />'+entrada_params.aname_mandatory_msg;
        }

        if (jQuery('#comment_author_email').length && jQuery('#comment_author_email').val() != '') {
            var comment_author_email = jQuery('#comment_author_email').val();
            error = error.replace("<br />"+entrada_params.email_mandatory_msg, "");
            /* Email Validation Check ........... */
            if (reg.test(comment_author_email) == false) {
                error = error + '<br />'+entrada_params.email_mandatory_msg;
            } else {
                error = error.replace("<br />"+entrada_params.email_valid_msg, "");
            }
        } else {
            var comment_author_email = '';
            error = error + '<br />'+entrada_params.email_mandatory_msg;
        }

        if (jQuery('.product_rating').length && jQuery('.product_rating').val() != '') {
            var product_rating = jQuery('.product_rating').val();
            error = error.replace("<br />"+entrada_params.rating_mandatory_msg, "");
        } else {
            var product_rating = '';
            error = error + '<br />'+entrada_params.rating_mandatory_msg;
        }

        if (jQuery('#comment_content').length && jQuery('#comment_content').val() != '') {
            var comment_content = jQuery('#comment_content').val();
            error = error.replace("<br />"+entrada_params.comment_mandatory_msg, "");
        } else {
            var comment_content = '';
            error = error + '<br />'+entrada_params.comment_mandatory_msg;
        }

        if (error == '') {
            var comment_post_id = $('#comment_post_id').val();
            jQuery.ajax({
                type: "POST",
                dataType: "json",
                url: entrada_params.admin_ajax_url,
                data: {
                    'action': 'entrada_product_write_review',
                    'comment_author': comment_author,
                    'comment_author_email': comment_author_email,
                    'comment_content': comment_content,
                    'comment_author_url': comment_author_url,
                    'rating': product_rating,
                    'comment_post_ID': comment_post_id,
                },
                success: function(data) {
                    jQuery('#comment_message_box').removeAttr('class').attr('class', '');
                    jQuery('#comment_message_box').addClass('alert alert-success');
                    jQuery('#comment_message_box').html(data.Msg);
                    jQuery('.product_rating').val('');
                    jQuery('#write_a_review')[0].reset();
                    return false;
                }
            });
            return false;
        } else {
            error = '<strong>ERROR : </strong>' + error;
            jQuery('#comment_message_box').removeAttr('class').attr('class', '');
            jQuery('#comment_message_box').addClass('alert alert-warning');
            jQuery('#comment_message_box').html(error);
            return false;
        }
    }

    function load_more_reviews() {
        alert( 'load more' );
        var comment_page = $('#comment_page').val();
        var comment_per_page = $('#comment_per_page').val();
        var comment_post_ID = $('#comment_post_ID').val();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: entrada_params.admin_ajax_url,
            data: {
                'action': 'entrada_load_comment_pagination',
                'comment_page': comment_page,
                'comment_per_page': comment_per_page,
                'comment_post_ID': comment_post_ID
            },
            success: function(data) {
                alert( data.Response );
                if (data.Msg == '') {
                    $('#comment_load_more a').html(entrada_params.no_more_comment_found);
                } else {
                    $('.comment-holder').append(data.Msg);
                    $('#comment_page').val(parseInt(comment_page) + 1);
                    comment_rating()
                }
                return false;
            }
        });
    }

    /* Load More Product
       ---------------------------------*/
    $("#load_more_post").click(function() {
    	var entrada_params = window.entrada_params;
        $('#load_more_post').html(entrada_params.loading);
        filter_product('yes');
    });

    /* Filter Main Product  
    ---------------------------------*/
    function filter_product(load_more) {
        var view_mode = $('.view_mode').val();
        var ajax_action = $('.ajax_action').val();
        var action_call = view_mode + "_" + ajax_action;
        if (load_more == 'no') {
            $('#paged').val(1);
        }
        var paged = ($('#paged').length) ? $('#paged').val() : 1;
        var posts_per_page = ($('#posts_per_page').length) ? $('#posts_per_page').val() : 6;
        var data_array;
        if ('sidebarleft' == ajax_action) {
            var destination = get_selected_region();
            var product_cat = get_selected_product_cat();
            var product_tag = get_selected_product_tag();
            var product_activity = get_selected_product_activity();
            var price_range = ($('#filter_range_slider').length) ? $('#filter_range_slider').val() : '';
            var filter_by_order = ($('.filter_by_order').length) ? $('.filter_by_order').val() : '';
            data_array = {
                'action': action_call,
                'destination': destination,
                'product_cat': product_cat,
                'product_tag': product_tag,
                'product_activity': product_activity,
                'price_range': price_range,
                'paged': paged,
                'filter_by_order': filter_by_order,
                'posts_per_page': posts_per_page
            }
        } else {
            var destination = ($('#filter_destination').length) ? $('#filter_destination').val() : '';
            var price_range = ($('#filter_price_range').length) ? $('#filter_price_range').val() : '';
            var holiday_type = ($('#filter_holiday_type').length) ? $('#filter_holiday_type').val() : '';
            var activity_level = ($('#filter_activity_level').length) ? $('#filter_activity_level').val() : '';
            var filter_by_order = ($('.filter_by_order').length) ? $('.filter_by_order').val() : '';

            data_array = {
                'action': action_call,
                'destination': destination,
                'price_range': price_range,
                'holiday_type': holiday_type,
                'activity_level': activity_level,
                'paged': paged,
                'filter_by_order': filter_by_order,
                'posts_per_page': posts_per_page
            }
        }

        $.ajax({
            type: "POST",
            dataType: "json",
            url: entrada_params.admin_ajax_url,
            data: data_array,
            success: function(data) {
                var wrapper_block;
                if ($(".post-wrapper-block").length) {
                    wrapper_block = '.post-wrapper-block';
                } else if ($("#entrada_content_loader").length) {
                    wrapper_block = '#entrada_content_loader';
                }
                if (load_more == 'yes') {
                    if (data.html_content == '') {
                        $('#load_more_post').html(entrada_params.no_more_record_found);
                    } else {
                        $('nav.loadmore-wrap').removeClass('hide');
                        $('.pagination-wrap').remove();
                        $(wrapper_block).append(data.html_content);
                        $('#paged').val(parseInt(paged) + 1);
                        $('#load_more_post').html(entrada_params.load_more);
                        star_rating();
                    }
                } else {
                    if ($('.result-info').length > 0) {
                        $('.result-info').html(data.record_count);
                    }
                    $('#paged').val(parseInt(paged) + 1);
                    if (data.html_content == '') {
                        $('nav.loadmore-wrap').addClass('hide');
                        $('.pagination-wrap').remove();
                        $(wrapper_block).empty();
                        if ('.post-wrapper-block' != wrapper_block && 'grid' == view_mode) {
                            $('.content-holder').after('<div class="pagination-wrap"><p>'+ entrada_params.no_trip_matches +' </p> </div>');
                        }
                    } else {
                        $('nav.loadmore-wrap').removeClass('hide');
                        $('.pagination-wrap').remove();
                        $(wrapper_block).html(data.html_content);
                        star_rating();
                    }
                }
                //addthis.toolbox('.addthis_toolbox');

                return false;
            }
        });
        return false;
    }
});