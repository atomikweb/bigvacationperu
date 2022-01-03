(function($) {
    'use strict';
    var entrada_params = window.entrada_params;
    $(document).ready(function($) {
        /* RateYo */

        if ($(".single_blog_rateYo").length) {
            $(".give_blog_rateYo").rateYo({
                onSet: function(rating, rateYoInstance) {
                    $('.give_blog_rating').val(rating);
                },
                rating: 0,
                starWidth: "15px",
                numStars: 5,
                fullStar: true
            });

            var single_blog_rating = $('.single_blog_rating').val();
            $(".single_blog_rateYo").rateYo({
                rating: single_blog_rating,
                spacing: "2px",
                starWidth: "15px",
                readOnly: true,
            });
            comment_rating();
        } else {
            blog_star_rating();
        }

        $("#blog_load_more_post").click(function() {
            loadmore_post();
        });

    });

    function comment_rating() {
        $('.comment-slot').each(function(i, e) {
            var personal_rating = $(this).find('.personal_rating').val();
            $(this).find(".personal_rateYo").rateYo({
                rating: personal_rating,
                readOnly: true,
                spacing: "2px",
                starWidth: "15px",
            });
        });
    }

    function blog_star_rating() {
        var comment_count = 1;
        $("article.blog-article").each(function(i, e) {
            var product_rating = $(this).find(".product_rating").val();
            $(this).find(".product_rateYo").rateYo({
                rating: product_rating,
                readOnly: true,
                spacing: "2px",
                starWidth: "15px",
            });
            comment_count++;
        });
    }

    function loadmore_post() {
         var entrada_params = window.entrada_params;
        $('#blog_load_more_post').html( entrada_params.loading );
       
        var action_call     = $('.blog_ajax_action').val();
        var paged           = ($('#paged').length) ? $('#paged').val() : 1;
        var posts_per_page  = ($('#posts_per_page').length) ? $('#posts_per_page').val() : 5;
        var category_type   = ($('#category_type').length) ? $('#category_type').val() : '';
        $.ajax({
            type: "POST",
            dataType: "json",
            url: entrada_params.admin_ajax_url,
            data: {
                'action': action_call,
                'paged': paged,
                'posts_per_page': posts_per_page,
                'category_type' : category_type,
            },
            success: function(data) {                
                if (data.html_content == '') {
                    $('#blog_load_more_post').html(entrada_params.no_more_record_found);
                } else {
                    $('.blog-list').append(data.html_content);
                    $('#paged').val(parseInt(paged) + 1);
                    $('#blog_load_more_post').html(entrada_params.load_more );
                    blog_star_rating();
                }
                return false;
            }
        });
        return false;
    }

}(jQuery));