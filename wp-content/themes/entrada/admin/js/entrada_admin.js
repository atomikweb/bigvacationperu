// Entrada Admin custom js
(function($) {

    'use strict';
	

    /* Product Tab start here ... */
    $(document).ready(function($) {
        if ( $( "#prod_custom_tabs" ).length ) {
            $('#prod_custom_tabs')
                .tabs()
                .addClass('ui-tabs-vertical ui-helper-clearfix');
            }   
  
    });

    $(document).on('click', '.remove_itinery', function(e) {
       e.preventDefault();
       $(this).closest('.itinerary_wrap').remove();
       return false;
    });

    $('#add_itinerary_row').click(function() {
        var entrada_rand_integer = Math.floor(Math.random() * 100000) + 1;
        var entrada_itinerary_id = 'entrada_itinerary_' + entrada_rand_integer;
        var entrada_uri = window.entrada_uri;
        var admin_ajax_url = entrada_uri['admin_ajax_url'];
        var entrada_editor_settings =  tinyMCEPreInit.mceInit.content; 
        $.ajax({
            type: "POST",
            url: admin_ajax_url,
            data: {
                'action': 'entrada_add_itinerary',
                'default_text': 'Add Itinerary Description',
                'itinerary_id' : entrada_itinerary_id
            },
            success: function(response) {
                $('.itinerary_block').append(response);
                tinymce.init(entrada_editor_settings); 
                tinyMCE.execCommand('mceAddEditor', true, entrada_itinerary_id); 
                quicktags({id : entrada_itinerary_id });
                return false;
            }
        });

     function get_tinymce_content(id) {
        var content;
        var inputid = id;
        var editor = tinyMCE.get(inputid);
        var textArea = $('textarea#' + inputid);    
        if (textArea.length>0 && textArea.is(':visible')) {
            content = textArea.val();        
        } else {
            content = editor.getContent();
        }    
        return content;
    }

    });
	
	$('#add_product_addons').click(function() {
	    var add_element = '<tr>';
        var add_element = add_element + '<td> <input type="text" name="addons_label[]" value="" > </td>';
        var add_element = add_element + '<td> <input type="text" name="addons_price[]" value="" > </td>';
        var add_element = add_element + '<td> <a href="javascript:void(null);" class="button">X</a> </td>';
        var add_element = add_element + '</tr>';
        $('#product_addons_table tr:last').after(add_element);
       
    });

     $(document).on('click', '#product_addons_table .button', function(e) {
       e.preventDefault();
       $(this).closest('tr').remove();
       return false;
    });

    $(document).ready(function() {
        var add_post_gallery_images, add_itinerary_gallery_images;
        var template_url = entrada_uri.templateUrl;
        /* Post Galleries Images */
        $('#add_post_gallery_images').click(function(e) {
            e.preventDefault();
            /* If the uploader object has already been created, reopen the dialog */
            if (add_post_gallery_images) {
                add_post_gallery_images.open();
                return;
            }
            /* Extend the wp.media object */
            add_post_gallery_images = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Add to Gallery'
                },
                multiple: true
            });

            /* When a file is selected, grab the URL and set it as the text field's value */
            add_post_gallery_images.on('select', function() {
                var attachment = add_post_gallery_images.state().get('selection').toJSON();
                for (var i = 0; i < attachment.length; ++i) {
                    var img_block = '<li><div class="holder"><img src="' + attachment[i].url + '" width="150" height="150"> <input type="hidden" name="entrada_img_gal[]" value="' + attachment[i].id + '"> <a class="delete" href="javascript:void(null);"><img src="' + template_url + '/admin/img/delete.png"></a></div></li>';
                    $('#entrada_image_galleries').append(img_block);
                }
            });
            /* Open the uploader dialog */
            add_post_gallery_images.open();
        });

        /* Post Itinerary Images */
        $('#add_itinerary_gallery_images').click(function(e) {
            e.preventDefault();
            /* If the uploader object has already been created, reopen the dialog */
            if (add_itinerary_gallery_images) {
                add_itinerary_gallery_images.open();
                return;
            }
            /* Extend the wp.media object */
            add_itinerary_gallery_images = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Add to Gallery'
                },
                multiple: true
            });
            /* When a file is selected, grab the URL and set it as the text field's value */
            add_itinerary_gallery_images.on('select', function() {
                var attachment = add_itinerary_gallery_images.state().get('selection').toJSON();
                for (var i = 0; i < attachment.length; ++i) {
                    var img_block = '<li><div class="holder"><img src="' + attachment[i].sizes.thumbnail.url + '" width="150" height="150"> <input type="hidden" name="itinerary_gallery_img[]" value="' + attachment[i].id + '"> <a class="delete" href="javascript:void(null);"><img src="' + template_url + '/admin/img/delete.png"></a></div></li>';
                    jQuery('#itinerary_gallery').append(img_block);
                }
            });
            /* Open the uploader dialog */
            add_itinerary_gallery_images.open();
        });
    });

    /* Delete Thumb */
    $(function() {
        $("#entrada_image_galleries").on("click", "a", function(e) {
            e.preventDefault();
            jQuery(this).parent().parent().remove();
        });
    });
    $(function() {
        $("#itinerary_gallery").on("click", "a", function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });
    });

    /* Post Galleries sorting */
    $(function() {
        $("#entrada_image_galleries").sortable({
            placeholder: "ui-sortable-placeholder"
        });
    });
	
	/* Entrada Product Type */
    $(function() {
        if ( ( $( '#entrada_product_type' ).val() ) && $( '#entrada_product_type' ).val() === 'shop_item' ) {
				$( '.product_tab_attributes' ).hide();
				$( '#activity_level_radio' ).hide();
				$( '#holiday_typediv' ).hide();
				$( '#destinationdiv' ).hide();
				$( '#entrada-product-meta-box' ).hide();
				$( '#product_catdiv' ).hide();
		}
    });
	
	$(function() {
       	$('#entrada_product_type').on('change', function(e) {	
            e.preventDefault();
            var selected_val = $(this).find(":selected").val();
			if(selected_val === 'tour'){
				$( '.product_tab_attributes' ).show();
				$( '#activity_level_radio' ).show();
				$( '#holiday_typediv' ).show();
				$( '#destinationdiv' ).show();
				$( '#entrada-product-meta-box' ).show();
				$( '#product_catdiv' ).show();
			} else {
				$( '.product_tab_attributes' ).hide();
				$( '#activity_level_radio' ).hide();
				$( '#holiday_typediv' ).hide();
				$( '#destinationdiv' ).hide();
				$( '#entrada-product-meta-box' ).hide();
				$( '#product_catdiv' ).hide();
			}
        });
    });

}(jQuery));