/* Custom Masonry File */
(function ($) {

    "use strict";

    jQuery(document).ready(function () {

        // MASONRY
        $(window).load(function () {
            $('#masonry-loop').masonry({
                // options
                itemSelector: '.masonry-post, .one-column, .two-column'
            });
        });
        //masonry end
    });

})(jQuery);