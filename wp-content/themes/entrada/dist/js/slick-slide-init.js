// Slick slider script
(function($) {
	'use strict';

	$('.partner-list').slick({
		slidesToShow: 6,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 2000,
		arrows: false,
		responsive: [
			{
				breakpoint: 1230,
				settings: {
					arrows: false,
					centerMode: true,
					centerPadding: '0',
					slidesToShow: 5
				}
			},
			{
				breakpoint: 992,
				settings: {
					arrows: false,
					centerMode: true,
					centerPadding: '0',
					slidesToShow: 4
				}
			},
			{
				breakpoint: 768,
				settings: {
					arrows: false,
					centerMode: true,
					centerPadding: '0',
					slidesToShow: 3
				}
			},
			{
				breakpoint: 480,
				settings: {
					arrows: false,
					centerMode: true,
					centerPadding: '0',
					slidesToShow: 1
				}
			}
		]
	});

	$('.slick-fade').slick({
		dots: false,
		infinite: true,
		speed: 2000,
		fade: true,
		cssEase: 'linear'
	});

	$('.testimonial-home-slide').slick({
		dots: true,
		arrows: false,
		infinite: false,
		speed: 500,
		fade: true,
		autoplay: false,
		slidesToShow: 1,
		cssEase: 'linear',
		responsive: [
			{
				breakpoint: 1025,
				settings: {
					dots: false,
					centerMode: true
				}
			}
		]
	});

}(jQuery));