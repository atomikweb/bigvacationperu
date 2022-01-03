(function($) {
    'use strict';

    var product_carousel = window.product_carousel;
    if ( typeof product_carousel !== 'undefined' && product_carousel ) { 
        var carousel_auto_play = false;
        
        if ( product_carousel.auto_play ) {    
            carousel_auto_play = true;
        }
        // Owl Carousel Carousels
        $("#entrada_product_carousel") 
        .owlCarousel({
            items: 3,
            navigation : true,
            slideSpeed: parseInt(product_carousel.slide_speed),
            itemsDesktop : [1199, 3],
            itemsDesktopSmall : [979, 2],
            itemsTablet : [768, 1],
            itemsMobile: [480, 1],
            autoPlay: carousel_auto_play,
            touchDrag: false,
            pagination: false,
            mouseDrag: false
        });
    }  

}(jQuery));    