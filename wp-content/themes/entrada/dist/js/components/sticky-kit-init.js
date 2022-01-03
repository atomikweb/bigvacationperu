(function($) {
    'use strict';

    $("#sticky-tab").stick_in_parent({
		sticky_class: 'is-stuck',
		offset_top: 70
	});

	$("#sticky-tab2, .tab-container container").stick_in_parent({
		sticky_class: 'is-stuck',
		recalc_every: 1
	});
}(jQuery));