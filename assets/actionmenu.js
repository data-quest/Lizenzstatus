/*jslint browser: true, indent: 4 */
/*global jQuery */

(function ($) {
    'use strict';

    // Open action menu on click on the icon
    $(document).on('click', '.action-menu-icon', function (event) {
        var menu = $(this).closest('.lizenzstatus-action-menu');

        // Close other menus (and remove contentbox overflow handling)
        if (!menu.is('.active')) {
            $('.lizenzstatus-action-menu').removeClass('active')
                .parents().removeClass('force-visible-overflow');
        }

        // Open menu (and force visibility on contentbox parent elements)
        $(this).closest('.lizenzstatus-action-menu').toggleClass('active')
            .filter('.active').parents().filter(function () {
                return $(this).is('p, section, div')
                    && $(this).parent().is('section.contentbox > article');
            }).addClass('force-visible-overflow');

        // Stop event so the following close event will not be fired
        event.stopPropagation();
    });

    // Close action menu on click outside
    $(document).on('click', function (event) {
        if ($(event.target).closest('.lizenzstatus-action-menu.active').length === 0) {
            $('.lizenzstatus-action-menu').removeClass('active')
                .parents().removeClass('force-visible-overflow');
        }
    });

}(jQuery));
